<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    protected $table = 'acesso';
    use HasFactory;

    protected $fillable = [
        'tipo_id',
        'menu_id',
        'acesso',
    ];

    public static function readAcessos()
    {
        return Acesso::orderBy('tipo_id', 'asc')
        ->rightjoin('tipo_usuario as t', 't.id', '=', 'acesso.tipo_id')
        ->rightjoin('menu as m', 'm.id', '=', 'acesso.menu_id')
        ->select('t.id', 't.nome', 'm.id', 'm.nome', 'acesso.acesso', 'acesso.created_at', 'acesso.updated_at')
        ->groupBy('t.id', 't.nome', 'm.id', 'm.nome', 'acesso.acesso', 'acesso.created_at', 'acesso.updated_at')
        ->get();
    }

    public static function createAcesso($data)
    {
        return Acesso::create([
            'tipo_id' => $data['tipo_id'],
            'menu_id' => $data['menu_id'],
            'acesso' => $data['acesso'],
        ]);
    }

    public static function updateAcesso($data, $id)
    {
        return Acesso::where('id', $id)->update($data);
    }

    public static function deleteAcesso($id)
    {
        return Acesso::where('id', $id)->delete();
    }

    public static function readAcesso($id)
    {
        return Acesso::where('id', $id)->first();
    }

}
