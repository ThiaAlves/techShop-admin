<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use stdClass;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/v1/produto",
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
    /** @OA\Post(path="/api/v1/produto",
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
        try{
            $produto = Produto::createProduto($request);
            return $produto;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/v1/produto/{id}",
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
    public function show($id)
    {
        $produto = Produto::readProduto($id);
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

    /** @OA\Put(path="/api/v1/produto/{id}",
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
        try{
            $produto = Produto::updateProduto($request, $produto->id);
            return $produto;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/v1/produto/{id}",
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
    public function destroy($id)
    {
        try{
            $produto = Produto::deleteProduto($id);
            return $produto;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //Rota mostra produto pela categoria
    /** @OA\Get(path="/api/v1/produto/categoria/{id}",
     *   tags={"Produto"},
     *   summary="Mostra um produto pela categoria",
     *   description="Mostra um produto pela categoria",
     *   operationId="showProdutoCategoria",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID da categoria",
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

    public function showByCategory($id)
    {
        $produtos = Produto::readProdutoByCategory($id);
        return $produtos;
    }

    public function showProdutoSemelhantes($id)
    {
        $produtos = Produto::readProdutoSemelhantes($id);
        return $produtos;
    }

    public function indexAdmin(Request $request)
    {
        $count_produtos = new stdClass;
        $count_produtos->total = Produto::count();
        $count_produtos->ativos = Produto::where('status', 1)->count();
        $count_produtos->inativos = Produto::where('status', 0)->count();

        $mensagem = $request->session()->get('mensagem');
        $produtos = Produto::all();
        return view('produtos/index', compact('produtos', 'mensagem', 'count_produtos'));
    }

    public function createAdmin(Request $request)
    {
        $categorias = Categoria::all();
        $mensagem = $request->session()->get('mensagem');
        return view('produtos.create', compact('categorias', 'mensagem'));
    }


    public function storeAdmin(Request $request)
    {
        if($request->hasFile('imagem')){

            //Pega array de imagens
            $imagens = $request->file('imagem');
            $imagensArray = [];
            //faz o upload de cada imagem

            foreach($imagens as $imagem){
                $nomeImagem = $imagem->getClientOriginalName();
                $novoNome = time().$nomeImagem;
                $imagem->move(public_path('produtos'), $novoNome);

                $imagensArray[] = $novoNome;
            }

            $imagem1 = $imagensArray[0] ?? "";
            $imagem2 = $imagensArray[1] ?? "";
            $imagem3 = $imagensArray[2] ?? "";
            $imagem4 = $imagensArray[3] ?? "";
            $imagem5 = $imagensArray[4] ?? "";
        }

        //Se o ID for nulo, então é um novo produto
        if($request->id == null){
            $produto = new Produto();
            $produto->nome = $request->nome;
            $produto->categoria_id = $request->id_categoria;
            $produto->descricao = $request->descricao;
            $produto->preco = $request->preco;
            $produto->preco_promocional = $request->preco_promocional;
            $produto->estoque = $request->estoque;
            $produto->status = $request->status;
            $produto->imagem1 = $imagem1;
            $produto->imagem2 = $imagem2;
            $produto->imagem3 = $imagem3;
            $produto->imagem4 = $imagem4;
            $produto->imagem5 = $imagem5;
            $produto->estoque = $request->estoque;
            $produto->save();
            $request->session()->flash('mensagem', "Produto {$produto->nome} criado com sucesso!");
        } else {
            $produto = Produto::find($request->id);
            $produto->nome = $request->nome;
            $produto->categoria_id = $request->id_categoria;
            $produto->descricao = $request->descricao;
            $produto->preco = $request->preco;
            $produto->preco_promocional = $request->preco_promocional;
            $produto->estoque = $request->estoque;
            $produto->status = $request->status;
            $produto->imagem1 = $imagem1 ?? $produto->imagem1;
            $produto->imagem2 = $imagem2 ?? $produto->imagem2;
            $produto->imagem3 = $imagem3 ?? $produto->imagem3;
            $produto->imagem4 = $imagem4 ?? $produto->imagem4;
            $produto->imagem5 = $imagem5 ?? $produto->imagem5;
            $produto->estoque = $request->estoque;
            $produto->save();
            $request->session()->flash('mensagem', "Produto {$produto->nome} atualizado com sucesso!");
        }
        //Mensagem de sucesso
        return redirect()->route('produtos.index');
    }
    
    public function editAdmin($id) {

        $produto = Produto::find($id);
        $categorias = Categoria::all();
        return view('produtos.create', compact('produto','categorias'));
    }

    public function mudaStatus($id, Request $request)
    {
        $produto = Produto::find($id);

        if($produto->status == 1){
            $produto->status = 0;
            $produto->save();
            $request->session()->flash('mensagem', "Produto {$produto->nome} desativado com sucesso!");
        } else {
            $produto->status = 1;
            $produto->save();
            $request->session()->flash('mensagem', "Produto {$produto->nome} ativado com sucesso!");
        }
        //Mensagem de sucesso
        return redirect()->route('produtos.index');
    }

    public function destroyImageAdmin($idProduto, $nomeImagem)
    {

        function deletaImagem($nomeImagem){
            $caminhoImagem = public_path('produtos/'.$nomeImagem);
            if(file_exists($caminhoImagem)){
                unlink($caminhoImagem);
            }
        }

        $produto = Produto::find($idProduto);
        switch ($nomeImagem) {
            case 'imagem1':
                deletaImagem($produto->imagem1);
                $produto->imagem1 = "";
                break;
            case 'imagem2':
                deletaImagem($produto->imagem2);
                $produto->imagem2 = "";
                break;
            case 'imagem3':
                deletaImagem($produto->imagem3);
                $produto->imagem3 = "";
                break;
            case 'imagem4':
                deletaImagem($produto->imagem4);
                $produto->imagem4 = "";
                break;
            case 'imagem5':
                deletaImagem($produto->imagem5);
                $produto->imagem5 = "";
                break;
        }
        $produto->save();

        return response()->json(['mensagem' => 'Imagem removida com sucesso!']);
    }

    public function buscaValorProduto($idProduto)
    {
        //verifica se o produto está em promoção
        $produto = Produto::find($idProduto);
        if($produto->preco_promocional != null){
            $valor = $produto->preco_promocional;
        } else {
            $valor = $produto->preco;
        }
        return response()->json(['valor' => $valor]);

    }


}
