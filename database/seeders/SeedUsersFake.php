<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedUsersFake extends Seeder
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
                DB::table('usuarios')
                  ->insert([
                      'nome'  => $faker->name,
                      'email' => $faker->email
                  ]);
            }

            dd('Usuários criados com sucesso');

        } catch (\Exception $ex) {
            dd('Ocorreu um erro: ' . $ex->getMessage());
        }
    }
}
