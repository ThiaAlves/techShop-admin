<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('venda_produto')->insert([
            [
                'venda_id' => 1,
                'produto_id' => 1,
                'quantidade' => 1,
                'valor' => 1000,
                'quantidade' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
