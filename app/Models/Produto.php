<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produto';
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'imagem1',
        'imagem2',
        'imagem3',
        'imagem4',
        'imagem5',
        'estoque',
        'preco',
        'preco_promocional',
        'categoria_id',
        'status',
    ];

    public static function readProdutos()
    {
        return Produto::select('id', 'nome', 'descricao', 'imagem1', 'imagem2', 'imagem3', 'imagem4', 'imagem5', 'estoque', 'preco', 'preco_promocional', 'categoria_id', 'status', 'created_at', 'updated_at')
        ->inRandomOrder()->limit(10)->get();
    }

    public static function createProduto($data)
    {
        return Produto::create([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'imagem1' => $data['imagem1'],
            'imagem2' => $data['imagem2'],
            'imagem3' => $data['imagem3'],
            'imagem4' => $data['imagem4'],
            'imagem5' => $data['imagem5'],
            'estoque' => $data['estoque'],
            'preco' => $data['preco'],
            'preco_promocional' => $data['preco_promocional'],
            'categoria_id' => $data['categoria_id'],
            'status' => $data['status'],
        ]);
    }

    public static function updateProduto($data, $id)
    {
        return Produto::where('id', $id)->update($data);
    }

    public static function deleteProduto($id)
    {
        return Produto::where('id', $id)->delete();
    }

    public static function readProduto($id)
    {
        return Produto::where('id', $id)->first();
    }

    public static function readProdutoByCategory($id)
    {
        return Produto::where('categoria_id', $id)
        ->orderBy('nome', 'asc')
        ->select('id', 'nome', 'descricao', 'imagem1', 'imagem2', 'imagem3', 'imagem4', 'imagem5', 'estoque', 'preco', 'preco_promocional', 'categoria_id', 'status', 'created_at', 'updated_at')
        ->get();
    }

    public static function readProdutoSemelhantes($id)
    {
        return Produto::where('categoria_id', $id)
        ->select('id', 'nome', 'descricao', 'imagem1', 'imagem2', 'imagem3', 'imagem4', 'imagem5', 'estoque', 'preco', 'preco_promocional', 'categoria_id', 'status', 'created_at', 'updated_at')
        ->inRandomOrder()
        ->limit(5)
        ->get();
    }
}
