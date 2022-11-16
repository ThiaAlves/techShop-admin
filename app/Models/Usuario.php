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
        ->select('id', 'nome', 'email', 'tipo', 'foto', 'cpf', 'status', 'created_at', 'updated_at')
        ->get();
    }

    public static function createUsuario($data)
    {
        return Usuario::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'password' => $data['password'],
            'tipo' => $data['tipo'],
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
        return '/perfil';
    }

    public function adminlte_image(){

        $usuario = Auth::user()->nome;
        $background = "&background=3F88C5&color=fff";

         return "https://ui-avatars.com/api/?name=$usuario?rounded=true$background";
     }

    public static function adminlte_desc()
    {
        return Auth::user()->nome;
    }

    public static function buscaUsuarioMesmoEmail($email)
    {
        return Usuario::where('email', $email)->get();
    }


    public static function buscaUsuarioMesmoEmailUpdate($id, $email)
    {
        return Usuario::where('id', '!=', $id)->where('email', $email)->get();
    }


}
