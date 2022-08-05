<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/cliente",
     *   tags={"Cliente"},
     *   summary="Lista todos os clientes",
     *   description="Retorna todos os clientes",
     *   operationId="indexCliente",
     *   @OA\Response(
     *     response=200,
     *     description="Retorna todos os clientes"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o cliente"
     *   )
     * )
     */
    public function index()
    {
        $clientes = Cliente::readClientes();
        return $clientes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /** @OA\Post(path="/api/cliente",
     *   tags={"Cliente"},
     *   summary="Cria um novo cliente",
     *   description="Cria um novo cliente",
     *   operationId="storeCliente",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"nome","email","telefone"},
     *       @OA\Property(property="nome", type="string", description="Nome do cliente"),
     *       @OA\Property(property="email", type="string", description="Email do cliente"),
     *       @OA\Property(property="telefone", type="string", description="Telefone do cliente"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o cliente criado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o cliente"
     *   )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $cliente = Cliente::createCliente($data);
        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/cliente/{id}",
     *   tags={"Cliente"},
     *   summary="Mostra um cliente",
     *   description="Mostra um cliente",
     *   operationId="showCliente",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do cliente",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o cliente"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o cliente"
     *   )
     * )
     */
    public function show(Cliente $cliente)
    {
        $cliente = Cliente::readCliente($cliente->id);
        return $cliente;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    /** @OA\Put(path="/api/cliente/{id}",
     *   tags={"Cliente"},
     *   summary="Atualiza um cliente",
     *   description="Atualiza um cliente",
     *   operationId="updateCliente",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do cliente",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"nome","email","telefone"},
     *       @OA\Property(property="nome", type="string", description="Nome do cliente"),
     *       @OA\Property(property="email", type="string", description="Email do cliente"),
     *       @OA\Property(property="telefone", type="string", description="Telefone do cliente"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o cliente atualizado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o cliente"
     *   )
     * )
     */
    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->all();
        $cliente = Cliente::updateCliente($data, $cliente->id);
        return $cliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/cliente/{id}",
     *   tags={"Cliente"},
     *   summary="Deleta um cliente",
     *   description="Deleta um cliente",
     *   operationId="destroyCliente",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do cliente",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o cliente deletado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o cliente"
     *   )
     * )
     */
    public function destroy(Cliente $cliente)
    {
        $cliente = Cliente::deleteCliente($cliente->id);
        return $cliente;
    }
}
