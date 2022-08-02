<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            [
                'nome' => 'Categorias',
                'icone' => 'fas fa-list',
                'link' => 'cadastros/categorias',
                'tabela' => 'categoria',
                'submenu' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Clientes',
                'icone' => 'fas fa-users',
                'link' => 'cadastros/clientes',
                'tabela' => 'cliente',
                'submenu' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Acessos',
                'icone' => 'fas fa-key',
                'link' => 'cadastros/acessos',
                'tabela' => 'acesso',
                'submenu' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Menus',
                'icone' => 'fas fa-bars',
                'link' => 'cadastros/menus',
                'tabela' => 'menu',
                'submenu' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Produtos',
                'icone' => 'fas fa-box-open',
                'link' => 'cadastros/produtos',
                'tabela' => 'produto',
                'submenu' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Tipos de Usuários',
                'icone' => 'fas fa-tag',
                'link' => 'cadastros/tipos',
                'tabela' => 'tipo',
                'submenu' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Usuários',
                'icone' => 'fas fa-user',
                'link' => 'cadastros/usuarios',
                'tabela' => 'usuario',
                'submenu' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Vendas',
                'icone' => 'fas fa-shopping-cart',
                'link' => 'cadastros/vendas',
                'tabela' => 'venda',
                'submenu' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Logs',
                'icone' => 'fas fa-history',
                'link' => 'relatorios/logs',
                'tabela' => 'log',
                'submenu' => 'R',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Vendas',
                'icone' => 'fas fa-shopping-cart',
                'link' => 'relatorios/vendas',
                'tabela' => 'venda',
                'submenu' => 'R',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Clientes',
                'icone' => 'fas fa-users',
                'link' => 'relatorios/clientes',
                'tabela' => 'cliente',
                'submenu' => 'R',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
