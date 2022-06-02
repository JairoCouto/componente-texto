<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Barryvdh\DomPDF\Facade as DOM;
use Barryvdh\DomPDF\Facade\Pdf as DOM;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    /**
     * 
     */
    public function index()
    {

        $variables = [
            'nome' => 'Jairo Couto',
            'email' => 'fake@teste.com.br',
            'telefone' => '(62)99999-9999'
        ];

        return view('index',[
            'variables' => $variables,
            'action' => route('create')
        ]);
    }



    /**
     * Gravar dados do Edital
     */
    public function create(Request $request)
    {
        DB::table('editais')
          ->insert([
             'dados_edital' => $request->componente
          ]);

          return redirect()
                ->route('test')
                ->with('success', 'Edital Gravado com Sucesso');
    }

    /**
     * Visualizar
     */
    public function view($id)
    {
        $edital = DB::table('editais')
          ->where('id_edital', '=', $id)
          ->first();

          return view('index', [
              'edital' => $edital,
              'action' => Route('update')
          ]);
    }

    /**
     * Atualizar
     */
    public function update(Request $request)
    {
        DB::table('editais')
          ->where('id_edital', $request->id_edital)
          ->update([
              'dados_edital' => $request->componente
          ]);

          return redirect()
            ->route('view', ['id' => $request->id_edital])
            ->with('success', 'Edital Atualizado com Sucesso');
    }

    /**
     * Modelo Final
     */
    public function model($id)
    {
        $edital = DB::table('edital_enviado')
          ->where('id_edital_enviado', '=', $id)
          ->first();

          return view('form', [
              'edital' => $edital,
          ]);
    }

    /**
     * Gerar Modelo Final
     */
    public function createModel()
    {

        $edital = DB::table('editais')
                    ->where('id_edital', '=', 1)
                    ->first();

        $text =  $edital->dados_edital;

        $variables = DB::table('variaveis')
                       ->select('nome', 'script_sql')
                       ->where('situacao', 1)
                       ->get();

        foreach($variables as $variable) {
            if(strpos($text,$variable->nome) !== false) {
                $text = str_replace($variable->nome, $variable->script_sql, $text);
            }
        }
        
        $insert = DB::table('edital_enviado')
                    ->insertGetId([
                        'texto_edital' => $text
                    ]);

        $editalSend = DB::table('edital_enviado')->where('id_edital_enviado', '=', $insert)->first();

          return view('form',[
              'editalSend' => $editalSend
          ]);
    }

    /**
     * Gerar - Modelo Final - Customizado SQL
     */
    public function generateModel()
    {
        $edital = DB::table('editais')
                    ->where('id_edital', '=', 1)
                    ->first();

        $text =  $edital->dados_edital;

        $variables = DB::table('variaveis')
                       ->select('nome', 'script_sql', 'campo_referenciado')
                       ->where('situacao', 1)
                       ->get();

        foreach($variables as $variable) {
            $field = $variable->campo_referenciado;
            if(strpos($text,$variable->nome) !== false && !empty($field)) {
                //dd($this->sqlToResultModel($variable->script_sql, 3)[0]->$field);
                $text = str_replace($variable->nome, $this->sqlToResultModel($variable->script_sql, 3)[0]->$field, $text);
            }
        }
        
        $insert = DB::table('edital_enviado')
                    ->insertGetId([
                        'texto_edital' => $text
                    ]);

        $editalSend = DB::table('edital_enviado')->where('id_edital_enviado', '=', $insert)->first();

          return view('form',[
              'editalSend' => $editalSend
          ]);
    }

    /**
     * Executa as consultas SQL
     */
    public function sqlToResultModel($sql = null, $parameter = null)
    {

        try {
            //$sql = str_replace('?', $parameter, [$parameter]);

            $sql = 'select nome from usuarios where id_usuario = ?';
            $parameter = 3;

            $sql = DB::select($sql, [$parameter]);

            return $sql;
        } catch (\Exception $ex) {
            dd('Ocorreu um erro: ' .$ex->getMessage());
        }
    }

    /**
     * Função PDF - View Blade
     */
    public function toPdf()
    {

        $html = DB::table('editais')->select('dados_edital')->where('id_edital', 2)->first();

        $html = $html->dados_edital;

        return view('tiny.pdf-view',[
            'html' => $html
        ]);

    }


    /**
     * Download PDF
     */
    public function downloadPdf()
    {
        $html = DB::table('editais')->select('dados_edital')->where('id_edital', 2)->first();

        $html = $html->dados_edital;

        $word = '<p>&nbsp;</p>';

        $arrayHtml = explode("\r\n", $html);
        $arrayHtmlReprocess = [];
        $arrayRemove = [];
        $arrayPageBreak = [];

        /**
         * Percorrer o Array de String do Formulário e caso sejam iguais em até 4 posições, informar as posições de cada um para serem removidas posteriormente e aplicar o page-break na próxima etapa.
         */
        foreach ($arrayHtml as $key => $item) {
            if(isset($arrayHtml[$key +1]) && isset($arrayHtml[$key +2])) {
                if($arrayHtml[$key] == $word && 
                isset($arrayHtml[$key +1]) ? $arrayHtml[$key +1] == $word : 1 == 2 && 
                isset($arrayHtml[$key +2]) ? $arrayHtml[$key +2] == $word : 1 == 2
                ) {

                    $arrayHtmlReprocess[$key] = $arrayHtml[$key];
                    $arrayRemove[$key] = $key;
                    
                } else {
                    $arrayHtmlReprocess[$key] = $arrayHtml[$key];

                }
            } else {
                $arrayHtmlReprocess[$key] = $arrayHtml[$key];
            }

        }

        /**
         * Percorrer o Array de itens a serem removidos, removendo posição a posição e depois aplicando o page-break;
         */
        
        foreach ($arrayRemove as $key => $remove) {
            if(array_key_exists($key+1, $arrayRemove)) {
                if($arrayRemove[$key+1] == $key+1) {
                    unset($arrayHtmlReprocess[$key]);
                }
            } else {
                $key > 10 ? $arrayHtmlReprocess[$key] = '<p class="page-break-after"></p>' : '';
            }
        }
        
        //dd($arrayHtmlReprocess, $arrayRemove);
        $arrayHtmlReprocess = implode("\r\n", $arrayHtmlReprocess);
        $html = $arrayHtmlReprocess;
       
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('tiny.pdf-view', compact('html'));
        return $pdf->stream();

    }
}
