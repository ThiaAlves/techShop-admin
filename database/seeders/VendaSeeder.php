<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('venda')->insert([
            [
                'cliente_id' => 1,
                'usuario_id' => 1,
                'data_venda' => '2020-01-01',
                'status' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ]);
    }
}
