<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Categoria;
use App\Models\VendaProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/v1/venda",
     *   tags={"Venda"},
     *   summary="Lista todos as vendas",
     *   description="Retorna todos as vendas",
     *   operationId="indexVenda",
     *   @OA\Response(
     *     response=200,
     *     description="Retorna todos as vendas"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a venda"
     *   )
     * )
     */
    public function index()
    {
        $vendas = Venda::readVendas();
        return $vendas;
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

    /** @OA\Post(path="/api/v1/venda",
     *   tags={"Venda"},
     *   summary="Cria uma nova venda",
     *   description="Cria uma nova venda",
     *   operationId="storeVenda",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="cliente_id", type="integer", description="ID do cliente"),
     *       @OA\Property(property="categoria_id", type="integer", description="ID da categoria"),
     *       @OA\Property(property="valor", type="number", description="Valor da venda"),
     *       @OA\Property(property="data", type="string", description="Data da venda")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a venda criada"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a venda"
     *   )
     * )
     */
    public function store(Request $request)
    {
        try{
            $venda = Venda::createVenda($request->all());
            return $venda;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/v1/venda/{id}",
     *   tags={"Venda"},
     *   summary="Lista uma venda",
     *   description="Retorna uma venda",
     *   operationId="showVenda",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID da venda",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a venda"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a venda"
     *   )
     * )
     */
    public function show($id)
    {
        $venda = Venda::readVenda($id);
        return $venda;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function edit(Venda $venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    /** @OA\Put(path="/api/v1/venda/{id}",
     *   tags={"Venda"},
     *   summary="Atualiza uma venda",
     *   description="Atualiza uma venda",
     *   operationId="updateVenda",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID da venda",
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
     *       @OA\Property(property="cliente_id", type="integer", description="ID do cliente"),
     *       @OA\Property(property="categoria_id", type="integer", description="ID da categoria"),
     *       @OA\Property(property="valor", type="number", description="Valor da venda"),
     *       @OA\Property(property="data", type="string", description="Data da venda")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a venda atualizada"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a venda"
     *   )
     * )
     */
    public function update(Request $request, Venda $venda)
    {
        try{
            $venda = Venda::updateVenda($request->all(), $venda->id);
            return $venda;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/v1/venda/{id}",
     *   tags={"Venda"},
     *   summary="Deleta uma venda",
     *   description="Deleta uma venda",
     *   operationId="destroyVenda",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID da venda",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna a venda deletada"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre a venda"
     *   )
     * )
     */
    public function destroy(Venda $venda)
    {
        try{
            $venda = Venda::deleteVenda($venda->id);
            return $venda;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function listAdmin()
    {
        //Retorna Todas as vendas com os dados do cliente, valor total e data
        $count_vendas = new stdClass;
        $count_vendas->total = Venda::count();
        $count_vendas->aguardando_pagamento = Venda::where('status', 'A')->count();
        $count_vendas->pago = Venda::where('status', 'P')->count();

        $vendas = Venda::listaVendas();

        //Formata Valor Total
        foreach ($vendas as $venda) {

            if(!empty($venda->valor_total)) {
            //Remove .00 do valor
                $venda->valor_total = str_replace('0.00', '', $venda->valor_total);
                //$venda->valor_total = number_format($venda->valor_total, 2, ',', '.');
            } else {
                $venda->valor_total = '0,00';
            }
        }

        return view('vendas.index', compact('vendas', 'count_vendas'));
    }


    public function indexAdmin($id)
    {
        //Listar todos os clientes
        $clientes = Cliente::all();
        //Listar todos os produtos
        $produtos = Produto::all();
        //Listar todos os vendedores
        $vendedores = Usuario::all();  


        if($id == 'novo') {
            $venda = $carrinho = $valor_total ='';
        } else {
            $venda = Venda::readVendaById($id);
            $venda->cliente_nome = Cliente::find($venda->cliente_id)->nome;
            $carrinho = VendaProduto::carrinho($id);
            $valor_total = DB::table('venda_produto')->where('venda_id', $id)->sum('valor');
        }
        return view('vendas.create', compact('clientes', 'produtos', 'vendedores', 'venda', 'valor_total', 'carrinho'));
    }

    public function novaVenda(Request $request)
    {
        try{
            //Verifica se usuário já tem venda criada com status A
            $venda = Venda::where('cliente_id', $request->cliente_id)->where('status', 'A')->first();

            if(isset($venda)){
                return $venda;
            } else {

                $venda = Venda::createVenda($request->all());
                activity()->on($venda)->event('create')->withProperties($venda)->log("Venda criada");
                return $venda;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function finalizarVenda(Request $request)
    {
        try{
            //Verifica se o carrinho está vazio 
            $carrinho = VendaProduto::carrinho($request->venda_id);
            if(count($carrinho) == 0) {
                return response()->json(['error' => 'Carrinho vazio'], 500);
            }
            //Verifica se contém estoque suficiente para cada produto
            foreach($carrinho as $item) {
                $produto = Produto::find($item->id);

                if($produto->estoque < $item->quantidade) {
                    return response()->json(['error' => 'Estoque insuficiente para o produto '.$produto->nome], 500);
                } 
            }

            //Verifica se a venda foi paga para atualizar o estoque
            if($request->status == 'P') {
                $venda_produtos = VendaProduto::where('venda_id', $request->venda_id)->get();
                foreach($venda_produtos as $venda_produto) {
                    $produto = Produto::find($venda_produto->produto_id);
                    $produto->estoque = $produto->estoque - $venda_produto->quantidade;
                    $produto->save();
                    activity()->on($produto)->event('update')->withProperties($produto)->log("Estoque atualizado para ".$produto->estoque ." no produto ".$produto->nome);
                }
            }
            $venda = Venda::finalizarVenda($request->venda_id, $request->status);
            activity()->event('update')->withProperties($venda)->log("Venda finalizada");

            return $venda;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function relatorioVendas(Request $request)
    {
        //Retorna Todas as vendas com os dados do cliente, valor total e data
        $count_vendas = new stdClass;

        $clientes = Cliente::all();
        //Intervalo de datas
        $data_inicio = $request->data_inicio;
        $data_fim = $request->data_final;
        $status = $request->status;
        $cliente_id = explode(' - ', $request->cliente);
        $cliente_id = $cliente_id[0];

        $filtro = new stdClass;
        $filtro->data_inicio = $data_inicio;
        $filtro->data_fim = $data_fim;
        $filtro->status = $status;
        $filtro->cliente = $request->cliente;

        $vendas = Venda::listaVendasRelatorio($data_inicio, $data_fim, $status, $cliente_id);

        //Formata Valor Total
        foreach ($vendas as $venda) {

            if(!empty($venda->valor_total)) {
                //Remove .00 do valor
                    $venda->valor_total = str_replace('0.00', '', $venda->valor_total);
                    //$venda->valor_total = number_format($venda->valor_total, 2, ',', '.');
                } else {
                    $venda->valor_total = '0,00';
                }
        }

        //Contagem de vendas com o filtro aplicado
        $count_vendas->total = $vendas->count();
        $count_vendas->aguardando_pagamento = $vendas->where('status', 'A')->count();
        $count_vendas->pago = $vendas->where('status', 'P')->count();



        return view('relatorios.vendas', compact('vendas', 'count_vendas', 'clientes', 'filtro'));
    }

    public function relatorioVendedores(Request $request)
    {
        //Retorna Todas as vendas com os dados do cliente, valor total e data
        $ranking = new stdClass;

        $vendedores = Usuario::all();
        //Intervalo de datas 
        // Se data_inicio for nulo, retorna o a data atual no mes anterior
        $data_inicio = $request->data_inicio ?? date('Y-m-d', strtotime('-1 month'));
        $data_fim = $request->data_final ?? date('Y-m-d');
        $status = $request->status ?? 'P';
        $vendedor_id = $request->vendedor ?? 2;

        $filtro = new stdClass;
        $filtro->data_inicio = $data_inicio;
        $filtro->data_fim = $data_fim;
        $filtro->status = $status;
        $filtro->vendedor = $request->vendedor;

        $vendas = Venda::listaVendedoresRelatorio($data_inicio, $data_fim, $status);
        //Ranking de vendedores pelo período selecionado
        $ranking->primeiro = Venda::rankingVendedores($data_inicio, $data_fim, $status)->first();
        $ranking->primeiro = $ranking->primeiro->vendedor ?? 'Não Há';
        $ranking->segundo = Venda::rankingVendedores($data_inicio, $data_fim, $status)->skip(1)->first();
        $ranking->segundo = $ranking->segundo->vendedor ?? 'Não há';
        $ranking->terceiro = Venda::rankingVendedores($data_inicio, $data_fim, $status)->skip(2)->first();
        $ranking->terceiro = $ranking->terceiro->vendedor ?? 'Não há';
        return view('relatorios.vendedores', compact('vendas', 'ranking', 'vendedores', 'filtro'));
    }

    public static function relatorioProdutos(Request $request){
        //Retorna a listagem de produtos mais vendidos com a quantidade vendida
        $ranking = new stdClass;

        $categorias = Categoria::all();
        //Intervalo de datas
        $data_inicio = $request->data_inicio ?? date('Y-m-d', strtotime('-1 month'));
        $data_fim = $request->data_final ?? date('Y-m-d');

        $filtro = new stdClass;
        $filtro->data_inicio = $data_inicio;
        $filtro->data_fim = $data_fim;

        $produtos = VendaProduto::listaProdutosRelatorio($data_inicio, $data_fim);

        //Ranking de produtos pelo período selecionado
        $ranking->primeiro = $produtos->first();
        $ranking->primeiro = $ranking->primeiro->produto ?? 'Não Há';
        $ranking->segundo = $produtos->skip(1)->first();
        $ranking->segundo = $ranking->segundo->produto ?? 'Não há';
        $ranking->terceiro = $produtos->skip(2)->first();
        $ranking->terceiro = $ranking->terceiro->produto ?? 'Não há';

        return view('relatorios.produtos', compact('produtos', 'ranking', 'categorias', 'filtro'));
        
    }
}
