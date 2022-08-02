<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_usuario')->insert([
            [
                'nome' => 'Administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Funcionário',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
