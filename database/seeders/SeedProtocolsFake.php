<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedProtocolsFake extends Seeder
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
                DB::table('protocolos')
                    ->insert([
                        'protocolo' => 'SOL2022051300' . $i
                    ]);
            }



        } catch (\Exception $ex) {
            dd('Ocorreu um erro: ' . $ex->getMessage());
        }
    }
}
