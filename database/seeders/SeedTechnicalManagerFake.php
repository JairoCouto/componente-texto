<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedTechnicalManagerFake extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            
            $faker = \Faker\Factory::create('pt_BR');

            for($i=0; $i < 30; $i++) {
                DB::table('responsavel_tecnico')
                    ->insert([
                        'nome' => $faker->name,
                        'cpf'  => func_remove_mask_number($faker->cpf),
                        'rg'   => func_remove_mask_number($faker->rg),
                        'data_expedicao' => '2010-01-01',
                        'email' => $faker->unique->email
                    ]);
            }

            dd('Dados criados com sucesso');

        } catch (\Exception $ex) {
            dd('Ocorreu um erro: ' . $ex->getMessage());
        }
    }
}
