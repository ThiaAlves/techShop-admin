<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cliente')->insert([
            [
                'nome' => 'Fulano de Tal',
                'cpf' => '123456789',
                'email' => 'fulano@gmail.com',
                'senha' => bcrypt('123456'),
                'data_nascimento' => '2020-01-01',
                'telefone' => '123456789',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
