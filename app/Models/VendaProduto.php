<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaProduto extends Model
{

    protected $table = 'venda_produto';
    use HasFactory;

    protected $fillable = [
        'venda_id',
        'produto_id',
        'quantidade',
        'valor'
    ];

    protected $primaryKey = null;

    public $incrementing = false;


    public static function readVendaProdutos()
    {
        return VendaProduto::orderBy('venda_id', 'asc')
        ->select('venda_id', 'produto_id', 'quantidade', 'valor', 'created_at', 'updated_at')
        ->get();
    }

    public static function createVendaProduto($data)
    {
        return VendaProduto::create([
            'venda_id' => $data['venda_id'],
            'produto_id' => $data['produto_id'],
            'quantidade' => $data['quantidade'],
            'valor' => $data['valor'],
        ]);
    }

    public static function updateVendaProduto($data, $id)
    {
        return VendaProduto::where('id', $id)->update($data);
    }

    public static function deleteVendaProduto($id)
    {
        return VendaProduto::where('id', $id)->delete();
    }

    public static function readVendaProduto($id)
    {
        return VendaProduto::where('id', $id)->first();
    }

    public static function destroyVendaProduto($id_venda, $id_produto)
    {
        return VendaProduto::where('venda_id', $id_venda)->where('produto_id', $id_produto)->delete();
    }

    public static function carrinho($id_venda)
    {
        return VendaProduto::where('venda_produto.venda_id', $id_venda)
        ->join('produto', 'produto.id', '=', 'venda_produto.produto_id')
        ->select('produto.id as id', 'produto.nome', 'produto.descricao', 'produto.imagem1', 'produto.preco', 'venda_produto.quantidade', 'venda_produto.valor')
        ->get();
    }

    public static function listaProdutosRelatorio($data_inicio, $data_fim)
    {
        //Retorna a lista de produtos vendidos no período com a quantidade vendida
        return VendaProduto::whereBetween('venda.data_venda', [$data_inicio, $data_fim])
        ->join('venda', 'venda.id', '=', 'venda_produto.venda_id')
        ->join('produto', 'produto.id', '=', 'venda_produto.produto_id')
        ->select('produto.nome', 'produto.descricao', 'produto.imagem1', 'produto.preco', DB::raw('SUM(venda_produto.quantidade) as quantidade'))
        ->groupBy('produto.nome', 'produto.descricao', 'produto.imagem1', 'produto.preco')
        ->get();
    }

}
