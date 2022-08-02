<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Resposta;
use Faker\Factory as Faker;

class RespostaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt_BR');
        foreach(range(1, 487) as $index) {
            Resposta::create([
                'respostas' => $faker->numberBetween(1, 10) . ' | ' . $faker->numberBetween(1, 10). ' | ' . $faker->text(20),
                'pesquisa_id' => $faker->numberBetween(1, 10),
                'pessoa_id' => $faker->numberBetween(1, 500),
                'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ]);
        }

    }
}
