<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'endereco';
    use HasFactory;

    protected $fillable = [
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cliente_id',
        'ativo',
        'latitude',
        'longitude',
    ];

    public static function readEnderecos()
    {
        return Endereco::orderBy('cep', 'asc')
        ->select('id', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cliente_id', 'ativo', 'latitude', 'longitude', 'created_at', 'updated_at')
        ->get();
    }

    public static function createEndereco($data)
    {
        return Endereco::create([
            'cep' => $data['cep'],
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'estado' => $data['estado'],
            'cliente_id' => $data['cliente_id'],
            'ativo' => $data['ativo'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);
    }

    public static function updateEndereco($data, $id)
    {
        return Endereco::where('id', $id)->update($data);
    }

    public static function deleteEndereco($id)
    {
        return Endereco::where('id', $id)->delete();
    }

    public static function readEndereco($id)
    {
        return Endereco::where('id', $id)->first();
    }


}
