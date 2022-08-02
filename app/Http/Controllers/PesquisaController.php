<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesquisa;

class PesquisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pesquisas = Pesquisa::readPesquisas();
        return $Pesquisas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(empty($request->id)) {
        try {
            $Pesquisa = Pesquisa::createPesquisa($request->input());
            return response()->json(['success' => true,
                'message' => 'Pesquisa criada com sucesso!',
                'data' => $Pesquisa], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'Erro ao criar pesquisa!',
                'data' => $e->getMessage()], 500);
        }
        } else {
            $pergunta = $request->pergunta1 .'|'. $request->pergunta2 .'|'. $request->pergunta3;
            $data = array(
                'tema' => $request->tema,
                'descricao' => $request->descricao,
                'perguntas' => $pergunta,
                'status' => $request->status,
            );
            try {
                $Pesquisa = Pesquisa::updatePesquisa($data, $request->id);
                return response()->json(['success' => true,
                    'message' => 'Pesquisa atualizada com sucesso!',
                    'data' => $Pesquisa], 200);
            } catch (\Exception $e) {
                return response()->json(['success' => false,
                    'message' => 'Erro ao atualizar pesquisa!',
                    'data' => $e->getMessage()], 500);
            }
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
        return Pesquisa::readPesquisa($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            $Pesquisa = Pesquisa::updatePesquisa($request->input(), $id);
            return response()->json(['success' => true,
                'message' => 'Pesquisa atualizada com sucesso!',
                'data' => $Pesquisa], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'Erro ao atualizar pesquisa!',
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
            $Pesquisa = Pesquisa::deletePesquisa($id);
            return response()->json(['success' => true,
                'message' => 'Pesquisa excluída com sucesso!',
                'data' => $Pesquisa], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'Erro ao excluir pesquisa!',
                'data' => $e->getMessage()], 500);
        }
    }
}
