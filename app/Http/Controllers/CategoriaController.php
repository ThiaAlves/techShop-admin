<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /** @OA\Get(path="/api/v1/categoria",
     *   tags={"Categoria"},
     *   summary="Lista todas as categorias",
     *   description="Retorna todas as categorias",
     *   operationId="indexCategoria",
     *   @OA\Response(
     *     response=200,
     *     description="Retorna todas as categorias"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a categoria"
     *   )
     * )
     */
    public function index()
    {
        $categorias = Categoria::readCategorias();
        return $categorias;
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
    /** @OA\Post(path="/api/v1/categoria",
     *   tags={"Categoria"},
     *   summary="Cria uma nova categoria",
     *   description="Cria uma nova categoria",
     *   operationId="storeCategoria",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"nome"},
     *       @OA\Property(property="nome", type="string", description="Nome da categoria"),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a categoria criada"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a categoria"
     *   )
     * )
     */
    public function store(Request $request)
    {
        try {
            $categoria = Categoria::createCategoria($request->input());
            return response()->json(['success' => true,
                'message' => 'Categoria criada com sucesso!',
                'data' => $categoria], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/v1/categoria/{id}",
     *   tags={"Categoria"},
     *   summary="Lista uma categoria",
     *   description="Retorna uma categoria",
     *   operationId="showCategoria",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID da categoria",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a categoria"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a categoria"
     *   )
     * )
     */
    public function show($id)
    {
        $categoria = Categoria::readCategoria($id);
        return $categoria;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    /** @OA\Put(path="/api/v1/categoria/{id}",
     *   tags={"Categoria"},
     *   summary="Atualiza uma categoria",
     *   description="Atualiza uma categoria",
     *   operationId="updateCategoria",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID da categoria",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"nome"},
     *       @OA\Property(property="nome", type="string", description="Nome da categoria"),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a categoria atualizada"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a categoria"
     *   )
     * )
     */
    public function update(Request $request, Categoria $categoria)
    {
        try{
            $categoria = Categoria::updateCategoria($request->input(), $categoria->id);
            return response()->json(['success' => true,
                'message' => 'Categoria atualizada com sucesso!',
                'data' => $categoria], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/v1/categoria/{id}",
     *   tags={"Categoria"},
     *   summary="Deleta uma categoria",
     *   description="Deleta uma categoria",
     *   operationId="destroyCategoria",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID da categoria",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a categoria deletada"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a categoria"
     *   )
     * )
     */
    public function destroy($id)
    {
        try{
            $categoria = Categoria::deleteCategoria($id);
            return response()->json(['success' => true,
                'message' => 'Categoria deletada com sucesso!',
                'data' => $categoria], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
