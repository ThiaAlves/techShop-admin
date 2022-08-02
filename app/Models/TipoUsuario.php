<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = 'tipo_usuario';
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public static function readTiposUsuario()
    {
        return TipoUsuario::orderBy('nome', 'asc')
        ->select('id', 'nome', 'created_at', 'updated_at')
        ->get();
    }

    public static function createTipoUsuario($data)
    {
        return TipoUsuario::create([
            'nome' => $data['nome'],
        ]);
    }

    public static function updateTipoUsuario($data, $id)
    {
        return TipoUsuario::where('id', $id)->update($data);
    }

    public static function deleteTipoUsuario($id)
    {
        return TipoUsuario::where('id', $id)->delete();
    }

    public static function readTipoUsuario($id)
    {
        return TipoUsuario::where('id', $id)->first();
    }


}
