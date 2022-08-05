<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/endereco",
     *   tags={"Endereco"},
     *   summary="Lista todos os endereços",
     *   description="Retorna todos os endereços",
     *   operationId="indexEndereco",
     *   @OA\Response(
     *     response=200,
     *     description="Retorna todos os endereços"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o endereço"
     *   )
     * )
     */
    public function index()
    {
        $enderecos = Endereco::readEnderecos();
        return $enderecos;
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
    /** @OA\Post(path="/api/endereco",
     *   tags={"Endereco"},
     *   summary="Cria um novo endereço",
     *   description="Cria um novo endereço",
     *   operationId="storeEndereco",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"logradouro", "numero", "bairro", "cidade", "estado", "cep"},
     *       @OA\Property(property="logradouro", type="string", description="Logradouro do endereço"),
     *       @OA\Property(property="numero", type="string", description="Número do endereço"),
     *       @OA\Property(property="bairro", type="string", description="Bairro do endereço"),
     *       @OA\Property(property="cidade", type="string", description="Cidade do endereço"),
     *       @OA\Property(property="estado", type="string", description="Estado do endereço"),
     *       @OA\Property(property="cep", type="string", description="CEP do endereço")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o endereço criado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o endereço"
     *   )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $endereco = Endereco::createEndereco($data);
        return $endereco;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/endereco/{id}",
     *   tags={"Endereco"},
     *   summary="Mostra um endereço",
     *   description="Mostra um endereço",
     *   operationId="showEndereco",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do endereço",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o endereço"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o endereço"
     *   )
     * )
     */
    public function show(Endereco $endereco)
    {
        $endereco = Endereco::readEndereco($endereco->id);
        return $endereco;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function edit(Endereco $endereco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    /** @OA\Put(path="/api/endereco/{id}",
     *   tags={"Endereco"},
     *   summary="Atualiza um endereço",
     *   description="Atualiza um endereço",
     *   operationId="updateEndereco",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do endereço",
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
     *       required={"logradouro", "numero", "bairro", "cidade", "estado", "cep"},
     *       @OA\Property(property="logradouro", type="string", description="Logradouro do endereço"),
     *       @OA\Property(property="numero", type="string", description="Número do endereço"),
     *       @OA\Property(property="bairro", type="string", description="Bairro do endereço"),
     *       @OA\Property(property="cidade", type="string", description="Cidade do endereço"),
     *       @OA\Property(property="estado", type="string", description="Estado do endereço"),
     *       @OA\Property(property="cep", type="string", description="CEP do endereço")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o endereço atualizado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o endereço"
     *   )
     * )
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Endereco $endereco)
    {
        $data = $request->all();
        $endereco = Endereco::updateEndereco($data, $endereco->id);
        return $endereco;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/endereco/{id}",
     *   tags={"Endereco"},
     *   summary="Deleta um endereço",
     *   description="Deleta um endereço",
     *   operationId="deleteEndereco",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do endereço",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o endereço deletado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o endereço"
     *   )
     * )
     */
    public function destroy(Endereco $endereco)
    {
        $endereco = Endereco::deleteEndereco($endereco->id);
        return $endereco;
    }
}
