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
    /** @OA\Get(path="/api/v1/estoque",
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
    /** @OA\Post(path="/api/v1/estoque",
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
        try {
            $estoque = Estoque::createEstoque($request->all());
            return $estoque;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/v1/estoque/{id}",
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
    public function show($id)
    {
        $estoque = Estoque::readEstoque($id);
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
    /** @OA\Put(path="/api/v1/estoque/{id}",
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
        try {
            $data = $request->all();
            $estoque = Estoque::updateEstoque($estoque->id, $data);
            return $estoque;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/v1/estoque/{id}",
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
    public function destroy($id)
    {
        try {
            $estoque = Estoque::deleteEstoque($id);
            return $estoque;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
