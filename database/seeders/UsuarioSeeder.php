<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuario')->insert([
            [
                'nome' => 'Administrador',
                'email' => 'admin@gmail.com',
                'cpf' => '123456789',
                'foto' => '',
                'password' => bcrypt('123456'),
                'tipo_usuario_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'status' => true,
            ],
        ]);
    }
}
