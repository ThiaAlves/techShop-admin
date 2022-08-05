<?php

namespace App\Http\Controllers;

use App\Models\VendaProduto;
use Illuminate\Http\Request;

class VendaProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        /** @OA\Get(path="/api/venda-produto",
     *   tags={"Carrinho"},
     *   summary="Lista todos os produtos na venda",
     *   description="Retorna todos os produtos na venda",
     *   operationId="indexVendaProduto",
     *   @OA\Response(
     *     response=200,
     *     description="Retorna todos os produtos na venda"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o produto na venda"
     *   )
     * )
     */
    public function index()
    {
        $vendaProdutos = VendaProduto::readVendaProdutos();
        return $vendaProdutos;
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
    /** @OA\Post(path="/api/venda-produto",
     *   tags={"Carrinho"},
     *   summary="Cria um novo produto na venda",
     *   description="Cria um novo produto na venda",
     *   operationId="storeVendaProduto",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="id_venda",
     *         description="ID da venda",
     *         type="integer",
     *         format="int64"
     *       ),
     *       @OA\Property(
     *         property="id_produto",
     *         description="ID do produto",
     *         type="integer",
     *         format="int64"
     *       ),
     *       @OA\Property(
     *         property="quantidade",
     *         description="Quantidade do produto",
     *         type="integer",
     *         format="int64"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o produto na venda"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o produto na venda"
     *   )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $vendaProduto = VendaProduto::createVendaProduto($data);
        return $vendaProduto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendaProduto  $vendaProduto
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/venda-produto/{id}",
     *   tags={"Carrinho"},
     *   summary="Mostra um produto na venda",
     *   description="Mostra um produto na venda",
     *   operationId="showVendaProduto",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do produto na venda",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o produto na venda"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o produto na venda"
     *   )
     * )
     */
    public function show(VendaProduto $vendaProduto)
    {
        $vendaProduto = VendaProduto::readVendaProduto($vendaProduto->id);
        return $vendaProduto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendaProduto  $vendaProduto
     * @return \Illuminate\Http\Response
     */
    public function edit(VendaProduto $vendaProduto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendaProduto  $vendaProduto
     * @return \Illuminate\Http\Response
     */
    /** @OA\Put(path="/api/venda-produto/{id}",
     *   tags={"Carrinho"},
     *   summary="Atualiza um produto na venda",
     *   description="Atualiza um produto na venda",
     *   operationId="updateVendaProduto",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do produto na venda",
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
     *         property="id_venda",
     *         description="ID da venda",
     *         type="integer",
     *         format="int64"
     *       ),
     *       @OA\Property(
     *         property="id_produto",
     *         description="ID do produto",
     *         type="integer",
     *         format="int64"
     *       ),
     *       @OA\Property(
     *         property="quantidade",
     *         description="Quantidade do produto",
     *         type="integer",
     *         format="int64"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o produto na venda"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o produto na venda"
     *   )
     * )
     */
    public function update(Request $request, VendaProduto $vendaProduto)
    {
        $data = $request->all();
        $vendaProduto = VendaProduto::updateVendaProduto($data, $vendaProduto->id);
        return $vendaProduto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendaProduto  $vendaProduto
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/venda-produto/{id}",
     *   tags={"Carrinho"},
     *   summary="Remove um produto na venda",
     *   description="Remove um produto na venda",
     *   operationId="destroyVendaProduto",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do produto na venda",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o produto na venda"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o produto na venda"
     *   )
     * )
     */
    public function destroy(VendaProduto $vendaProduto)
    {
        $vendaProduto = VendaProduto::deleteVendaProduto($vendaProduto->id);
        return $vendaProduto;
    }
}
