@extends('templates.layout')

@push('alerts')
    @include('templates.alerts')
@endpush

@section('body')
    <div class="card">
        <div class="card-header">
            Teste Componente
        </div>
        <div class="card-body">
            <form action="{{ $action }}" method="post">
                @csrf
                <input type="hidden" name="id_edital" value="{{ isset($edital->id_edital) ? $edital->id_edital : '' }}">

                <div class="">
                    <textarea id="editor" name="componente" class="form-control" >{{ isset($edital->dados_edital) ? $edital->dados_edital : ''  }}</textarea>
                </div>
    
                <br/>
    
             
                    <div class="float-right mr-4 mb-4">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                    <div class="float-left">
                        <a href="{{ route('download') }}" class="btn btn-success" target="_blank" rel="noopener noreferrer">Download PDF</a>
                    </div>

            </form>
        </div>
    </div>

    
@endsection

