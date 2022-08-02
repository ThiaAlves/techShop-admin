<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcessoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acesso')->insert([
            [
                'tipo_id' => 1,
                'menu_id' => 1,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 1,
                'menu_id' => 2,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 1,
                'menu_id' => 3,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 1,
                'menu_id' => 4,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 1,
                'menu_id' => 5,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 1,
                'menu_id' => 6,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 1,
                'menu_id' => 7,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 1,
                'menu_id' => 8,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 1,
                'menu_id' => 9,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 1,
                'menu_id' => 10,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 1,
                'menu_id' => 11,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 2,
                'menu_id' => 1,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 2,
                'menu_id' => 2,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 2,
                'menu_id' => 3,
                'acesso' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 2,
                'menu_id' => 4,
                'acesso' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 2,
                'menu_id' => 5,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 2,
                'menu_id' => 6,
                'acesso' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 2,
                'menu_id' => 7,
                'acesso' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 2,
                'menu_id' => 8,
                'acesso' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 2,
                'menu_id' => 9,
                'acesso' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 2,
                'menu_id' => 10,
                'acesso' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_id' => 2,
                'menu_id' => 11,
                'acesso' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}
