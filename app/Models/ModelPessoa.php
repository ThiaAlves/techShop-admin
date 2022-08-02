<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resposta;
use Illuminate\Support\Facades\DB;


class ModelPessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'endereco',
        'estado',
        'cidade',
        'bairro',
        'numero',
        'cep',
        'password',
        'tipo',
        'status',
    ];

    protected $hidden = ['password'];

    public static function readPessoas()
    {
        return Resposta::orderBy('p.created_at', 'asc')
        ->rightjoin('pessoa as p', 'p.id', '=', 'respostas.pessoa_id')
        ->select('p.id', 'p.nome', 'p.cpf', 'p.telefone', 'p.email', 'p.endereco', 'p.estado', 'p.cidade', 'p.bairro', 'p.numero', 'p.cep', 'p.tipo',  'p.status', 'p.created_at', 'p.updated_at', DB::raw('count(respostas.id) as total_pesquisas_respondidas'))
        ->groupBy('p.id', 'p.nome', 'p.cpf', 'p.telefone', 'p.email', 'p.endereco', 'p.estado', 'p.cidade', 'p.bairro', 'p.numero', 'p.cep', 'p.tipo',  'p.status', 'p.created_at', 'p.updated_at')
        ->get();
    }

    public static function createPessoa($data)
    {
        return ModelPessoa::create([
            'nome' => $data['nome'],
            'cpf' => $data['cpf'],
            'telefone' => $data['telefone'],
            'email' => $data['email'],
            'endereco' => $data['endereco'],
            'estado' => $data['estado'],
            'cidade' => $data['cidade'],
            'bairro' => $data['bairro'],
            'numero' => $data['numero'],
            'cep' => $data['cep'],
            'password' => bcrypt($data['password']),
            'tipo' => $data['tipo'],
            'status' => $data['status'],
        ]);
    }

    public static function updatePessoa($id, $data)
    {
        return ModelPessoa::where('id', $id)->update($data);
    }

    public static function deletePessoa($id)
    {
        return ModelPessoa::where('id', $id)->delete();
    }

    public static function readPessoa($id)
    {
        return ModelPessoa::find($id);
    }
}
