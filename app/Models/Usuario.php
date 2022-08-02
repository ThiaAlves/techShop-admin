<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'password',
        'tipo_usuario_id',
        'foto',
        'cpf',
        'status',
    ];

    public static function readUsuarios()
    {
        return Usuario::orderBy('nome', 'asc')
        ->select('id', 'nome', 'email', 'tipo_usuario_id', 'foto', 'cpf', 'status', 'created_at', 'updated_at')
        ->get();
    }

    public static function createUsuario($data)
    {
        return Usuario::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'password' => $data['password'],
            'tipo_usuario_id' => $data['tipo_usuario_id'],
            'foto' => $data['foto'],
            'cpf' => $data['cpf'],
            'status' => $data['status'],
        ]);
    }

    public static function updateUsuario($data, $id)
    {
        return Usuario::where('id', $id)->update($data);
    }

    public static function deleteUsuario($id)
    {
        return Usuario::where('id', $id)->delete();
    }

    public static function readUsuario($id)
    {
        return Usuario::where('id', $id)->first();
    }


}
