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
        /** @OA\Get(path="/api/v1/venda-produto",
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
    /** @OA\Post(path="/api/v1/venda-produto",
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
        try{
            $vendaProduto = VendaProduto::createVendaProduto($request);
            return $vendaProduto;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendaProduto  $vendaProduto
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/v1/venda-produto/{id}",
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
    public function show($id)
    {
        $vendaProduto = VendaProduto::readVendaProduto($id);
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
    /** @OA\Put(path="/api/v1/venda-produto/{id}",
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
        try{
            $vendaProduto = VendaProduto::updateVendaProduto($request, $vendaProduto);
            return $vendaProduto;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendaProduto  $vendaProduto
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/v1/venda-produto/{id}",
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
        try{
            $vendaProduto = VendaProduto::destroyVendaProduto($vendaProduto);
            return $vendaProduto;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeProduto(Request $request)
    {
        $data = array(
            'id_venda' => $request->id_venda,
            'id_produto' => $request->id_produto,
            'quantidade' => $request->quantidade,
            'valor' => $request->valor,
        );
        try{
            $vendaProduto = VendaProduto::createVendaProduto($data);
            return $vendaProduto;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroyAdmin(Request $request)
    {
        try{
            $vendaProduto = VendaProduto::destroyVendaProduto($request->produto_id);
            return $vendaProduto;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function novoProduto(Request $request)
    {
        try{
            $produto = VendaProduto::createVendaProduto($request);
            return $produto;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function removerProduto(Request $request)
    {
        try{
            $produto = VendaProduto::destroyVendaProduto($request->venda_id ,$request->produto_id);
            return $produto;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function carrinho($id_venda)
    {
       try{
         $produtos = VendaProduto::carrinho($id_venda);
         return $produtos;
       } catch (\Exception $e) {
           return response()->json(['error' => $e->getMessage()], 500);
       }
    }
}
