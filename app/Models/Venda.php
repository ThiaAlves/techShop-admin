<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'venda';
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'usuario_id',
        'data_venda',
        'status',
    ];

    public static function readVendas()
    {
        return Venda::orderBy('data_venda', 'asc')
        ->select('id', 'cliente_id', 'usuario_id', 'data_venda', 'status', 'created_at', 'updated_at')
        ->get();
    }

    public static function createVenda($data)
    {
        return Venda::create([
            'cliente_id' => $data['cliente_id'],
            'usuario_id' => $data['usuario_id'],
            'data_venda' => $data['data_venda'] ?? date('Y-m-d'),
            'status' => $data['status'],
        ]);
    }

    public static function updateVenda($data, $id)
    {
        return Venda::where('id', $id)->update($data);
    }

    public static function deleteVenda($id)
    {
        return Venda::where('id', $id)->delete();
    }

    public static function readVenda($id)
    {
        return Venda::where('id', $id)->first();
    }






}
