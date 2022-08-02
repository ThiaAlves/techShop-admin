<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoque';
    use HasFactory;


    protected $fillable = [
        'produto_id',
        'quantidade',
    ];

    public static function readEstoque()
    {
        return Estoque::orderBy('produto_id', 'asc')
        ->select('produto_id', 'quantidade', 'created_at', 'updated_at')
        ->get();
    }

    public static function createEstoque($data)
    {
        return Estoque::create([
            'produto_id' => $data['produto_id'],
            'quantidade' => $data['quantidade'],
        ]);
    }


    public static function updateEstoque($data, $id)
    {
        return Estoque::where('id', $id)->update($data);
    }

    public static function deleteEstoque($id)
    {
        return Estoque::where('id', $id)->delete();
    }

    public static function readEstoqueById($id)
    {
        return Estoque::where('id', $id)->first();
    }





}
