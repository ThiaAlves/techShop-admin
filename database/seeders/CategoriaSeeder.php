<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria')->insert([
            [
            'nome' => 'Smartphones',
            'icone' => 'fa fa-mobile',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nome' => 'Notebooks',
            'icone' => 'fa fa-laptop',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nome' => 'Tablets',
            'icone' => 'fa fa-tablet',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nome' => 'Computadores',
            'icone' => 'fa fa-desktop',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
