<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Venda extends Model
{
    protected $table = 'venda';
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'usuario_id',
        'data_venda',
        'status',
    ];

    protected $dates = [
        'data_venda',
        'data_atualizacao',
    ];

    public static function readVendas()
    {
        return Venda::orderBy('data_venda', 'asc')
        ->select('id', 'cliente_id', 'usuario_id', 'data_venda', 'status', 'created_at', 'updated_at')
        ->get();
    }

    public static function readVendaById($id)
    {
        return Venda::where('id', $id)->first();
    }

    public static function createVenda($data)
    {
        return Venda::create([
            'cliente_id' => $data['cliente_id'],
            'usuario_id' => $data['usuario_id'],
            'data_venda' => $data['data_venda'] ?? date('Y-m-d'),
            'status' => $data['status'],
        ]);
    }

    public static function updateVenda($data, $id)
    {
        return Venda::where('id', $id)->update($data);
    }

    public static function deleteVenda($id)
    {
        return Venda::where('id', $id)->delete();
    }

    public static function readVenda($id)
    {
        return Venda::where('id', $id)->first();
    }

    public static function listaVendas()
    {   
        //Retorna venda com o valor_total 
        return Venda::orderBy('venda.created_at', 'desc')
        ->leftjoin('venda_produto', 'venda.id', '=', 'venda_produto.venda_id')
        ->join('cliente', 'venda.cliente_id', '=', 'cliente.id')
        ->select('venda.id', 'cliente.nome as cliente', db::raw('sum(venda_produto.valor * venda_produto.quantidade) as valor_total'), 'venda.updated_at  as data_atualizacao', 'venda.status')
        ->groupBy('venda.id', 'cliente.nome', 'venda.updated_at', 'venda.status')
        ->get();
    }

    public static function listaVendasRelatorio($dataInicial, $dataFinal, $status, $cliente_id)
    {   
        //Retorna venda com o valor_total 
        return Venda::orderBy('venda.created_at', 'desc')
        ->leftjoin('venda_produto', 'venda.id', '=', 'venda_produto.venda_id')
        ->join('cliente', 'venda.cliente_id', '=', 'cliente.id')
        ->select('venda.id', 'cliente.nome as cliente', db::raw('sum(venda_produto.valor * venda_produto.quantidade) as valor_total'), 'venda.updated_at  as data_atualizacao', 'venda.status')
        ->groupBy('venda.id', 'cliente.nome', 'venda.updated_at', 'venda.status')
        ->where(function($query) use ($dataInicial, $dataFinal, $status, $cliente_id) {
            if($dataInicial != null && $dataFinal != null) {
                $query->whereBetween('venda.updated_at', [$dataInicial, $dataFinal]);
            }
            if($status != null) {
                $query->where('venda.status', $status);
            }
            if($cliente_id != null) {
                $query->where('venda.cliente_id', $cliente_id);
            }
        })
        ->get();
    }

    public static function listaVendedoresRelatorio($dataInicial, $dataFinal, $status)
    {

        //Retorn Ranking de Vendas realizadas por vendedores
        return Venda::orderBy('data_venda', 'asc')
        ->leftjoin('venda_produto', 'venda.id', '=', 'venda_produto.venda_id')
        ->join('usuario', 'venda.usuario_id', '=', 'usuario.id')
        ->select('usuario.nome as vendedor', db::raw('sum(venda_produto.valor * venda_produto.quantidade) as valor_total'),
        db::raw('count(venda.id) as quantidade_vendas'))
        ->groupBy('usuario.nome')
        ->where(function($query) use ($dataInicial, $dataFinal, $status) {
            if($dataInicial != null && $dataFinal != null) {
                $query->whereBetween('venda.updated_at', [$dataInicial, $dataFinal]);
            }
            if($status != null) {
                $query->where('venda.status', $status);
            }
            // if($vendedor_id != null) {
            //     $query->where('venda.usuario_id', $vendedor_id);
            // }
        })
        ->get();
    }

    public static function rankingVendedores($dataInicial, $dataFinal, $status)
    {
        return Venda::orderBy('data_venda', 'asc')
        ->leftjoin('venda_produto', 'venda.id', '=', 'venda_produto.venda_id')
        ->join('cliente', 'venda.cliente_id', '=', 'cliente.id')
        ->join('usuario', 'venda.usuario_id', '=', 'usuario.id')
        ->select('usuario.id as vendedor_id', 'usuario.nome as vendedor', db::raw('sum(venda_produto.valor * venda_produto.quantidade) as valor_total'))
        ->groupBy('vendedor_id', 'usuario.nome')
        ->where(function($query) use ($dataInicial, $dataFinal, $status) {
            if($dataInicial != null && $dataFinal != null) {
                $query->whereBetween('venda.updated_at', [$dataInicial, $dataFinal]);
            }
            if($status != null) {
                $query->where('venda.status', $status);
            }
        })
        ->get();
    }


    public static function finalizarVenda($venda_id, $status)
    {
        return Venda::where('id', $venda_id)->update(['status' => $status]);
    }

    public static function carrinhoCliente($cliente_id)
    {
        return Venda::orderBy('venda.updated_at', 'desc')
        ->leftjoin('venda_produto', 'venda.id', '=', 'venda_produto.venda_id')
        ->join('cliente', 'venda.cliente_id', '=', 'cliente.id')
        ->join('produto', 'venda_produto.produto_id', '=', 'produto.id')
        ->select('venda.id as venda_id', db::raw('sum(venda_produto.valor * venda_produto.quantidade) as valor_total'),
        'venda.status', 'venda.updated_at as data_atualizacao', 'cliente.nome as cliente')
        ->where('venda.cliente_id', $cliente_id)
        ->where('venda.status', 'A')
        ->groupBy('venda.id', 'venda.status', 'venda.updated_at', 'cliente.nome')
        ->first();
    }

    public static function listaProdutosRelatorio($data_inicial, $data_final, $categoria_id)
    {
        return Venda::orderBy('venda.created_at', 'desc')
        ->leftjoin('venda_produto', 'venda.id', '=', 'venda_produto.venda_id')
        ->join('produto', 'venda_produto.produto_id', '=', 'produto.id')
        ->select('produto.imagem1 as imagem', 'produto.nome as produto', db::raw('sum(venda_produto.valor * venda_produto.quantidade) as valor_total'),
        db::raw('count(venda.id) as quantidade_vendas'))
        ->groupBy('produto.imagem1', 'produto.nome')
        ->where(function($query) use ($data_inicial, $data_final, $categoria_id) {
            if($data_inicial != null && $data_final != null) {
                $query->whereBetween('venda.updated_at', [$data_inicial, $data_final]);
            }
            if($categoria_id != null) {
                $query->where('produto.categoria_id', $categoria_id);
            }
        })
        ->get();
    }

    public static function rankingProdutos($data_inicial, $data_final, $categoria_id){
        return Venda::orderBy('data_venda', 'asc')
        ->leftjoin('venda_produto', 'venda.id', '=', 'venda_produto.venda_id')
        ->join('produto', 'venda_produto.produto_id', '=', 'produto.id')
        ->select('produto.id as produto_id', 'produto.nome as produto', db::raw('sum(venda_produto.valor * venda_produto.quantidade) as valor_total'))
        ->groupBy('produto.id', 'produto.nome')
        ->where(function($query) use ($data_inicial, $data_final, $categoria_id) {
            if($data_inicial != null && $data_final != null) {
                $query->whereBetween('venda.updated_at', [$data_inicial, $data_final]);
            }
            if($categoria_id != null) {
                $query->where('produto.categoria_id', $categoria_id);
            }
        })
        ->get();
    }
}
