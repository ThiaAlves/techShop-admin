<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/estoque",
     *   tags={"Estoque"},
     *   summary="Lista todos os estoques",
     *   description="Retorna todos os estoques",
     *   operationId="indexEstoque",
     *   @OA\Response(
     *     response=200,
     *     description="Retorna todos os estoques"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o estoque"
     *   )
     * )
     */
    public function index()
    {
        $estoques = Estoque::readEstoque();
        return $estoques;
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
    /** @OA\Post(path="/api/estoque",
     *   tags={"Estoque"},
     *   summary="Cria um novo estoque",
     *   description="Cria um novo estoque",
     *   operationId="storeEstoque",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="nome",
     *         description="Nome do estoque",
     *         type="string",
     *         example="Estoque 1"
     *       ),
     *       @OA\Property(
     *         property="descricao",
     *         description="Descrição do estoque",
     *         type="string",
     *         example="Estoque 1"
     *       ),
     *       @OA\Property(
     *         property="endereco_id",
     *         description="ID do endereço",
     *         type="integer",
     *         example="1"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o estoque criado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o estoque"
     *   )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $estoque = Estoque::createEstoque($data);
        return $estoque;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/estoque/{id}",
     *   tags={"Estoque"},
     *   summary="Lista um estoque",
     *   description="Retorna um estoque",
     *   operationId="showEstoque",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do estoque",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna um estoque"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o estoque"
     *   )
     * )
     */
    public function show(Estoque $estoque)
    {
        $estoque = Estoque::readEstoque($estoque->id);
        return $estoque;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function edit(Estoque $estoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    /** @OA\Put(path="/api/estoque/{id}",
     *   tags={"Estoque"},
     *   summary="Atualiza um estoque",
     *   description="Atualiza um estoque",
     *   operationId="updateEstoque",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do estoque",
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
     *       @OA\Property(
     *         property="nome",
     *         description="Nome do estoque",
     *         type="string",
     *         example="Estoque 1"
     *       ),
     *       @OA\Property(
     *         property="descricao",
     *         description="Descrição do estoque",
     *         type="string",
     *         example="Estoque 1"
     *       ),
     *       @OA\Property(
     *         property="endereco_id",
     *         description="ID do endereço",
     *         type="integer",
     *         example="1"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o estoque atualizado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o estoque"
     *   )
     * )
     */
    public function update(Request $request, Estoque $estoque)
    {
        $data = $request->all();
        $estoque = Estoque::updateEstoque($data, $estoque->id);
        return $estoque;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/estoque/{id}",
     *   tags={"Estoque"},
     *   summary="Deleta um estoque",
     *   description="Deleta um estoque",
     *   operationId="deleteEstoque",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do estoque",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o estoque deletado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o estoque"
     *   )
     * )
     */
    public function destroy(Estoque $estoque)
    {
        $estoque = Estoque::deleteEstoque($estoque->id);
        return $estoque;
    }
}
