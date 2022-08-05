<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/venda",
     *   tags={"Venda"},
     *   summary="Lista todos as vendas",
     *   description="Retorna todos as vendas",
     *   operationId="indexVenda",
     *   @OA\Response(
     *     response=200,
     *     description="Retorna todos as vendas"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a venda"
     *   )
     * )
     */
    public function index()
    {
        $vendas = Venda::readVendas();
        return $vendas;
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

    /** @OA\Post(path="/api/venda",
     *   tags={"Venda"},
     *   summary="Cria uma nova venda",
     *   description="Cria uma nova venda",
     *   operationId="storeVenda",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="cliente_id", type="integer", description="ID do cliente"),
     *       @OA\Property(property="categoria_id", type="integer", description="ID da categoria"),
     *       @OA\Property(property="valor", type="number", description="Valor da venda"),
     *       @OA\Property(property="data", type="string", description="Data da venda")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a venda criada"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a venda"
     *   )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $venda = Venda::createVenda($data);
        return $venda;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/venda/{id}",
     *   tags={"Venda"},
     *   summary="Lista uma venda",
     *   description="Retorna uma venda",
     *   operationId="showVenda",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID da venda",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a venda"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a venda"
     *   )
     * )
     */
    public function show(Venda $venda)
    {
        $venda = Venda::readVenda($venda->id);
        return $venda;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function edit(Venda $venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    /** @OA\Put(path="/api/venda/{id}",
     *   tags={"Venda"},
     *   summary="Atualiza uma venda",
     *   description="Atualiza uma venda",
     *   operationId="updateVenda",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID da venda",
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
     *       @OA\Property(property="cliente_id", type="integer", description="ID do cliente"),
     *       @OA\Property(property="categoria_id", type="integer", description="ID da categoria"),
     *       @OA\Property(property="valor", type="number", description="Valor da venda"),
     *       @OA\Property(property="data", type="string", description="Data da venda")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a venda atualizada"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a venda"
     *   )
     * )
     */
    public function update(Request $request, Venda $venda)
    {
        $data = $request->all();
        $venda = Venda::updateVenda($data, $venda->id);
        return $venda;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/venda/{id}",
     *   tags={"Venda"},
     *   summary="Deleta uma venda",
     *   description="Deleta uma venda",
     *   operationId="destroyVenda",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID da venda",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a venda deletada"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a venda"
     *   )
     * )
     */
    public function destroy(Venda $venda)
    {
        $venda = Venda::deleteVenda($venda->id);
        return $venda;
    }
}
