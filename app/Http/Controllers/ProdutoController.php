<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/produto",
     *   tags={"Produto"},
     *   summary="Lista todos os produtos",
     *   description="Retorna todos os produtos",
     *   operationId="indexProduto",
     *   @OA\Response(
     *     response=200,
     *     description="Retorna todos os produtos"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o produto"
     *   )
     * )
     */
    public function index()
    {
        $produtos = Produto::readProdutos();
        return $produtos;
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
    /** @OA\Post(path="/api/produto",
     *   tags={"Produto"},
     *   summary="Cria um novo produto",
     *   description="Cria um novo produto",
     *   operationId="storeProduto",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="nome",
     *         description="Nome do produto",
     *         type="string",
     *         example="Produto Teste"
     *       ),
     *       @OA\Property(
     *         property="descricao",
     *         description="Descrição do produto",
     *         type="string",
     *         example="Produto Teste"
     *       ),
     *       @OA\Property(
     *         property="valor",
     *         description="Valor do produto",
     *         type="number",
     *         example="10.00"
     *       ),
     *       @OA\Property(
     *         property="quantidade",
     *         description="Quantidade do produto",
     *         type="number",
     *         example="10"
     *       ),
     *       @OA\Property(
     *         property="id_estoque",
     *         description="ID do estoque",
     *         type="number",
     *         example="1"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o produto criado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o produto"
     *   )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $produto = Produto::createProduto($data);
        return $produto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/produto/{id}",
     *   tags={"Produto"},
     *   summary="Mostra um produto",
     *   description="Mostra um produto",
     *   operationId="showProduto",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do produto",
     *     required=true,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o produto"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o produto"
     *   )
     * )
     */
    public function show(Produto $produto)
    {
        $produto = Produto::readProduto($produto->id);
        return $produto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */

    /** @OA\Put(path="/api/produto/{id}",
     *   tags={"Produto"},
     *   summary="Atualiza um produto",
     *   description="Atualiza um produto",
     *   operationId="updateProduto",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do produto",
     *     required=true,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="nome",
     *         description="Nome do produto",
     *         type="string",
     *         example="Produto Teste"
     *       ),
     *       @OA\Property(
     *         property="descricao",
     *         description="Descrição do produto",
     *         type="string",
     *         example="Produto Teste"
     *       ),
     *       @OA\Property(
     *         property="valor",
     *         description="Valor do produto",
     *         type="number",
     *         example="10.00"
     *       ),
     *       @OA\Property(
     *         property="quantidade",
     *         description="Quantidade do produto",
     *         type="number",
     *         example="10"
     *       ),
     *       @OA\Property(
     *         property="id_estoque",
     *         description="ID do estoque",
     *         type="number",
     *         example="1"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o produto atualizado"
     *   )
     * )
     */
    public function update(Request $request, Produto $produto)
    {
        $data = $request->all();
        $produto = Produto::updateProduto($data, $produto->id);
        return $produto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/produto/{id}",
     *   tags={"Produto"},
     *   summary="Remove um produto",
     *   description="Remove um produto",
     *   operationId="deleteProduto",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do produto",
     *     required=true,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o produto removido"
     *   )
     * )
     */
    public function destroy(Produto $produto)
    {
        $produto = Produto::deleteProduto($produto->id);
        return $produto;
    }
}
