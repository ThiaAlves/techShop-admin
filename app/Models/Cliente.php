<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'data_nascimento',
        'telefone',
        'senha',
        'status',
    ];

    public static function readClientes()
    {
        return Cliente::orderBy('nome', 'asc')
        ->select('id', 'nome', 'cpf', 'email', 'data_nascimento', 'telefone', 'status' , 'created_at', 'updated_at')
        ->get();
    }

    public static function createCliente($data)
    {
        return Cliente::create([
            'nome' => $data['nome'],
            'cpf' => $data['cpf'],
            'email' => $data['email'],
            'data_nascimento' => $data['data_nascimento'],
            'telefone' => $data['telefone'],
            'senha' => $data['senha'],
            'status' => $data['status'],
        ]);
    }

    public static function updateCliente($data, $id)
    {
        return Cliente::where('id', $id)->update($data);
    }

    public static function deleteCliente($id)
    {
        return Cliente::where('id', $id)->delete();
    }


    public static function readCliente($id)
    {
        return Cliente::where('id', $id)->first();
    }

}
