<?php

namespace App\Http\Controllers;

use App\Models\Acesso;
use Illuminate\Http\Request;

/** @OA\Info(title="Tech-Admin-Api", version="0.1",
 *  @OA\Contact(
 *     email="  @gmail.com",
 *    name="Tech-Admin",
 *   url="  http://tech-admin.com"
 * ),
 * ) */

class AcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /** @OA\Get(path="/api/acesso",
     *   tags={"Acesso"},
     *   summary="Lista todos os acessos",
     *   description="Retorna todos os acessos",
     *   operationId="index",
     *   @OA\Response(
     *     response=200,
     *     description="Retorna todos os acessos"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o acesso"
     *   )
     * )
     */
    public function index()
    {
        $acessos = Acesso::readAcessos();
        return $acessos;
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
    /** @OA\Post(path="/api/acesso",
     *   tags={"Acesso"},
     *   summary="Cria um novo acesso",
     *   description="Cria um novo acesso",
     *   operationId="store",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="nome",
     *           description="Nome do acesso",
     *           type="string"
     *         ),
     *         @OA\Property(
     *           property="descricao",
     *           description="Descrição do acesso",
     *           type="string"
     *         ),
     *         @OA\Property(
     *           property="status",
     *           description="Status do acesso",
     *           type="string"
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o acesso criado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o acesso"
     *   )
     * )
     */
    public function store(Request $request)
    {
        try {
            $acesso = Acesso::createAcesso($request->input());
            return response()->json(['success' => true,
                'message' => 'Acesso criado com sucesso!',
                'data' => $acesso], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'Erro ao criar acesso!',
                'data' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acesso  $acesso
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/acesso/{id}",
     *   tags={"Acesso"},
     *   summary="Mostra um acesso",
     *   description="Mostra um acesso",
     *   operationId="show",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do acesso",
     *     required=true,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o acesso"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o acesso"
     *   )
     * )
     */
    public function show($id)
    {
        try {
            $acesso = Acesso::readAcesso($id);
            return $acesso;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Acesso não encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acesso  $acesso
     * @return \Illuminate\Http\Response
     */
    public function edit(Acesso $acesso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acesso  $acesso
     * @return \Illuminate\Http\Response
     */
    /** @OA\Put(path="/api/acesso/{id}",
     *   tags={"Acesso"},
     *   summary="Atualiza um acesso",
     *   description="Atualiza um acesso",
     *   operationId="update",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do acesso",
     *     required=true,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="nome",
     *           description="Nome do acesso",
     *           type="string"
     *         ),
     *         @OA\Property(
     *           property="descricao",
     *           description="Descrição do acesso",
     *           type="string"
     *         ),
     *         @OA\Property(
     *           property="status",
     *           description="Status do acesso",
     *           type="string"
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o acesso atualizado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o acesso"
     *   )
     * )
     */
    public function update(Request $request, Acesso $acesso)
    {
        try {
            $acesso = Acesso::updateAcesso($request->input(), $acesso->id);
            return response()->json(['success' => true,
                'message' => 'Acesso atualizado com sucesso!',
                'data' => $acesso], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'Erro ao atualizar acesso!',
                'data' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acesso  $acesso
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/acesso/{id}",
     *   tags={"Acesso"},
     *   summary="Deleta um acesso",
     *   description="Deleta um acesso",
     *   operationId="destroy",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do acesso",
     *     required=true,
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o acesso deletado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o acesso"
     *   )
     * )
     */
    public function destroy($id)
    {
        try {
            $acesso = Acesso::deleteAcesso($id);
            return response()->json(['success' => true,
                'message' => 'Acesso deletado com sucesso!',
                'data' => $acesso], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'Erro ao deletar acesso!',
                'data' => $e->getMessage()], 500);
        }
    }
}
