<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'usuario';

    protected $fillable = [
        'nome',
        'email',
        'password',
        'tipo',
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

    public static function adminlte_profile_url()
    {
        return 'profile/username';
    }

    public static function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    public static function adminlte_desc()
    {
        return Auth::user()->nome;
    }


}
