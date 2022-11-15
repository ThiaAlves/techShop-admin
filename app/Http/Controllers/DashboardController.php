<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\VendaProduto;
use App\Models\Venda;
use stdClass;

class DashboardController extends Controller
{
    public function index()
    {

        $dashboard = new stdClass;

        $dashboard->total_clientes = Cliente::where('status', 1)->count();
        //Nome do Produto mais vendido este mes
        $dashboard->mais_vendido = VendaProduto::select('produto.nome', 'produto.id')
            ->join('produto', 'produto.id', '=', 'venda_produto.produto_id')
            ->whereMonth('venda_produto.created_at', date('m'))
            ->groupBy('produto.nome', 'produto.id')
            ->orderByRaw('COUNT(*) DESC')
            ->first();
        $dashboard->mais_vendido = $dashboard->mais_vendido ? $dashboard->mais_vendido->nome : 'Nenhum produto vendido este mês';

        //Total de vendas este mes
        $dashboard->vendas_mes = VendaProduto::whereMonth('created_at', date('m'))->count();

        //Total de Rentabilidade este mes
        $dashboard->renda_mes = VendaProduto::whereMonth('created_at', date('m'))->sum('valor');

        //Formata renda_mes
        $dashboard->renda_mes = number_format($dashboard->renda_mes, 2, ',', '.');

        //Gráfico de vendas por dia
        $dashboard->vendas_dia = VendaProduto::selectRaw('DATE_FORMAT(created_at, "%d/%m") as dia, COUNT(*) as vendas')
            ->whereMonth('created_at', date('m'))
            ->groupBy('dia')
            ->get();

        $ultimas_vendas = Venda::select('venda.id', 'venda.created_at', 'cliente.nome','venda.status')
            ->join('cliente', 'cliente.id', '=', 'venda.cliente_id')
            ->orderBy('venda.id', 'DESC')
            ->limit(5)->get();

        
            //Sql para pegar o total de vendas por dia em timestamp para o gráfico
            //SELECT UNIX_TIMESTAMP(created_at) as dia, COUNT(*) as vendas FROM venda_produto WHERE MONTH(created_at) = 10 GROUP BY dia

        return view('home', compact('dashboard', 'ultimas_vendas'));
    }

}