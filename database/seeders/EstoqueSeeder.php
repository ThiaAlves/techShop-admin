<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstoqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estoque')->insert([
            [
                'produto_id' => 1,
                'quantidade' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
