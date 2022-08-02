<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    use HasFactory;


    protected $fillable = [
        'nome',
        'icone',
        'status',
    ];

    public static function readCategorias()
    {
        return Categoria::orderBy('nome', 'asc')
        ->select('id', 'nome', 'icone', 'status', 'created_at', 'updated_at')
        ->get();
    }

    public static function createCategoria($data)
    {
        return Categoria::create([
            'nome' => $data['nome'],
            'icone' => $data['icone'],
            'status' => $data['status'],
        ]);
    }

    public static function updateCategoria($data, $id)
    {
        return Categoria::where('id', $id)->update($data);
    }

    public static function deleteCategoria($id)
    {
        return Categoria::where('id', $id)->delete();
    }

    public static function readCategoria($id)
    {
        return Categoria::where('id', $id)->first();
    }

}
