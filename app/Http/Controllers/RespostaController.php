<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resposta;

class RespostaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Respostas = Resposta::readRespostas();
        return $Respostas;
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
    public function store(Request $request)
    {
       try {
            $Resposta = Resposta::createResposta($request->input());
            return response()->json(['success' => true,
                'message' => 'Resposta criada com sucesso!',
                'data' => $Resposta], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'Erro ao criar resposta!',
                'data' => $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Resposta::readResposta($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $Resposta = Resposta::updateResposta($request->input(), $id);
            return response()->json(['success' => true,
                'message' => 'Resposta atualizada com sucesso!',
                'data' => $Resposta], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'Erro ao atualizar resposta!',
                'data' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $Resposta = Resposta::deleteResposta($id);
            return response()->json(['success' => true,
                'message' => 'Resposta excluída com sucesso!',
                'data' => $Resposta], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'Erro ao excluir resposta!',
                'data' => $e->getMessage()], 500);
        }
    }

    public function respostasPorPessoa($id)
    {
        return Resposta::readRespostabByPessoa($id);
    }

    public function respostasPorPesquisa($id)
    {
        return Resposta::readRespostaByPesquisa($id);
    }
    //Método para atualizar status das respostas
    public function atualizaResposta($id, Request $request)
    {
        try {
            $Resposta = Resposta::verificaResposta($id, $request->input('status'));
            return response()->json(['success' => true,
                'message' => 'successo',
                'data' => $Resposta], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'Erro ao atualizar resposta!',
                'data' => $e->getMessage()], 500);
        }
    }
}
