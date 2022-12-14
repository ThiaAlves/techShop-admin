<?php

namespace App\Http\Controllers;

use App\Models\VendaProduto;
use App\Models\Venda;
use App\Models\Produto;
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
    public function destroy(Request $request)
    {
        try{
            $vendaProduto = VendaProduto::destroyVendaProduto($request->venda_id, $request->produto_id);
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
            $vendaProduto = VendaProduto::destroyVendaProduto($request->venda_id, $request->produto_id);
            return $vendaProduto;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function novoProduto(Request $request)
    {
        try{

            //Verifica se o produto já está na venda
            $vendaProduto = VendaProduto::where('venda_id', $request->venda_id)
                ->where('produto_id', $request->produto_id)
                ->first();

            if(isset($vendaProduto) && empty($request->quantidade)){
    
                //Se já estiver na venda, atualiza a quantidade soma mais 1 somente no produto            
                $vendaProduto->quantidade = $vendaProduto->quantidade + 1;

                VendaProduto::where('venda_id', $request->venda_id)
                    ->where('produto_id', $request->produto_id)
                    ->update(['quantidade' => $vendaProduto->quantidade]);
            
            }else if(isset($vendaProduto) && !empty($request->quantidade)){
                //Se já estiver na venda, atualiza a quantidade soma mais 1 somente no produto            
                $vendaProduto->quantidade = $request->quantidade;

                VendaProduto::where('venda_id', $request->venda_id)
                    ->where('produto_id', $request->produto_id)
                    ->update(['quantidade' => $vendaProduto->quantidade]);
                
            } else {
                //Converte valor para inteiro
                $valor = str_replace(',', '.', str_replace('.', '', $request->valor));

                //se valor contém .00 ou .99, retira
                if(substr($valor, -3) == '.00' || substr($valor, -3) == '.99'){
                    $valor = substr($valor, 0, -3);
                }
                //Se não estiver na venda, cria um novo produto na venda
                $data = array(
                    'venda_id' => $request->venda_id,
                    'produto_id' => $request->produto_id,
                    'quantidade' => $request->quantidade,
                    'valor' => $valor,
                );
                $vendaProduto = VendaProduto::createVendaProduto($data);
            }

            //Agrega todas as informações do produto no carrinho
            $produto_carrinho = Produto::find($request->produto_id);
            
            return $produto_carrinho;



        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function diminuirProduto(Request $request){
        try{

            //Verifica se o produto já está na venda
            $vendaProduto = VendaProduto::where('venda_id', $request->venda_id)
                ->where('produto_id', $request->produto_id)
                ->first();

            if($vendaProduto){
                //Se já estiver na venda, atualiza a quantidade
                $vendaProduto->quantidade = $vendaProduto->quantidade - 1;

                VendaProduto::where('venda_id', $request->venda_id)
                ->where('produto_id', $request->produto_id)
                ->update(['quantidade' => $vendaProduto->quantidade]);

                if($vendaProduto->quantidade == 0){
                    VendaProduto::destroyVendaProduto($request->venda_id, $request->produto_id);
                }


                //Retorna mensagem de sucesso
                return response()->json(['success' => "Sucesso ao diminuir o produto"], 200);

            }
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

    public static function carrinhoCliente($id) {
        try{

            $carrinho = Venda::carrinhoCliente($id);
            //Verifica se a venda já passou de 24 horas e se o status é 1 (Aguardando pagamento)
            if($carrinho->status == 'A' && $carrinho->data_atualizacao->diffInHours() > 24){
                //Se sim, atualiza o status para E (Expirado)
                $carrinho->status = 'E';
                $carrinho->save();

                return response()->json(['error' => 'Carrinho expirado'], 500);
            } else {
                $carrinho->produtos = VendaProduto::carrinho($carrinho->venda_id);
                return $carrinho;
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
