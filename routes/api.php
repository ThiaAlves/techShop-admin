<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\PesquisaController;
use App\Http\Controllers\RespostaController;
use App\Http\Controllers\AcessoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\VendaProdutoController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {


    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/me', 'AuthController@me');

});
Route::post('/login', [AuthController::class, 'login']);

Route::post('/registro', [PessoaController::class, 'register']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'jwt.verify'], function () {

    Route::post('/logout', [AuthController::class, 'logout']);


//Rotas API para Pessoa
Route::get('/pessoas', [PessoaController::class, 'index']);
Route::post('/pessoas', [PessoaController::class, 'store']);
Route::get('/pessoas/{id}', [PessoaController::class, 'show']);
Route::put('/pessoas/{id}', [PessoaController::class, 'update']);
Route::delete('/pessoas/{id}', [PessoaController::class, 'destroy']);

//Rotas API para Pesquisa
Route::get('/pesquisas', [PesquisaController::class, 'index']);
Route::get('/pesquisas/{id}', [PesquisaController::class, 'show']);
Route::post('/pesquisas', [PesquisaController::class, 'store']);
Route::put('/pesquisas/{id}', [PesquisaController::class, 'update']);
Route::delete('/pesquisas/{id}', [PesquisaController::class, 'destroy']);

//Rotas API para Resposta
Route::get('/respostas', [RespostaController::class, 'index']);
Route::get('/respostas/{id}', [RespostaController::class, 'show']);
Route::post('/respostas', [RespostaController::class, 'store']);
Route::put('/respostas/{id}', [RespostaController::class, 'update']);
Route::delete('/respostas/{id}', [RespostaController::class, 'destroy']);

//Rotas Adicionais
//Busca Respostas por Pessoa
Route::get('/respostasPorPessoa/{id}', [RespostaController::class, 'respostasPorPessoa']);
//Busca Respostas por Pesquisa
Route::get('/respostasPorPesquisa/{id}', [RespostaController::class, 'respostasPorPesquisa']);

Route::post('/atualizaResposta/{id}', [RespostaController::class, 'atualizaResposta']);

});

//Rotas para teste

//Tabela Acesso
Route::get('/v1/acesso', [AcessoController::class, 'index']);
Route::get('/v1/acesso/{id}', [AcessoController::class, 'show']);
Route::post('/v1/acesso', [AcessoController::class, 'store']);
Route::put('/v1/acesso/{id}', [AcessoController::class, 'update']);
Route::delete('/v1/acesso/{id}', [AcessoController::class, 'destroy']);

//Tabela Categoria
Route::get('/v1/categoria', [CategoriaController::class, 'index']);
Route::get('/v1/categoria/{id}', [CategoriaController::class, 'show']);
Route::post('/v1/categoria', [CategoriaController::class, 'store'])->name('categoria.store');
Route::put('/v1/categoria/{id}', [CategoriaController::class, 'update']);
Route::delete('/v1/categoria/{id}', [CategoriaController::class, 'destroy']);

//Tabela Cliente
Route::get('/v1/cliente', [ClienteController::class, 'index']);
Route::get('/v1/cliente/{id}', [ClienteController::class, 'show']);
Route::post('/v1/cliente', [ClienteController::class, 'store']);
Route::put('/v1/cliente/{id}', [ClienteController::class, 'update']);
Route::delete('/v1/cliente/{id}', [ClienteController::class, 'destroy']);

//Tabela Endereco
Route::get('/v1/endereco', [EnderecoController::class, 'index']);
Route::get('/v1/endereco/{id}', [EnderecoController::class, 'show']);
Route::post('/v1/endereco', [EnderecoController::class, 'store']);
Route::put('/v1/endereco/{id}', [EnderecoController::class, 'update']);
Route::delete('/v1/endereco/{id}', [EnderecoController::class, 'destroy']);
Route::get('/v1/enderecoCliente/{id}', [EnderecoController::class, 'listaEnderecosByCliente']);
Route::post('/v1/enderecoPrincipal/{id}', [EnderecoController::class, 'enderecoPrincipal']);

//Tabela Estoque
Route::get('/v1/estoque', [EstoqueController::class, 'index']);
Route::get('/v1/estoque/{id}', [EstoqueController::class, 'show']);
Route::post('/v1/estoque', [EstoqueController::class, 'store']);
Route::put('/v1/estoque/{id}', [EstoqueController::class, 'update']);
Route::delete('/v1/estoque/{id}', [EstoqueController::class, 'destroy']);

//Tabela Menu
Route::get('/v1/menu', [MenuController::class, 'index']);
Route::get('/v1/menu/{id}', [MenuController::class, 'show']);
Route::post('/v1/menu', [MenuController::class, 'store']);
Route::put('/v1/menu/{id}', [MenuController::class, 'update']);
Route::delete('/v1/menu/{id}', [MenuController::class, 'destroy']);

//Tabela Produto
Route::get('/v1/produto', [ProdutoController::class, 'index']);
Route::get('/v1/produto/{id}', [ProdutoController::class, 'show']);
Route::post('/v1/produto', [ProdutoController::class, 'store']);
Route::put('/v1/produto/{id}', [ProdutoController::class, 'update']);
Route::delete('/v1/produto/{id}', [ProdutoController::class, 'destroy']);

//Get Admin Produtos
Route::get('/produtos/{id}', [ProdutoController::class, 'buscaValorProduto']);

//Tabela TipoUsuario
Route::get('/v1/tipoUsuario', [TipoUsuarioController::class, 'index']);
Route::get('/v1/tipoUsuario/{id}', [TipoUsuarioController::class, 'show']);
Route::post('/v1/tipoUsuario', [TipoUsuarioController::class, 'store']);
Route::put('/v1/tipoUsuario/{id}', [TipoUsuarioController::class, 'update']);
Route::delete('/v1/tipoUsuario/{id}', [TipoUsuarioController::class, 'destroy']);

//Tabela Usuario
Route::get('/v1/usuario', [UsuarioController::class, 'index']);
Route::get('/v1/usuario/{id}', [UsuarioController::class, 'show']);
Route::post('/v1/usuario', [UsuarioController::class, 'store']);
Route::put('/v1/usuario/{id}', [UsuarioController::class, 'update']);
Route::delete('/v1/usuario/{id}', [UsuarioController::class, 'destroy']);

//Tabela Venda
Route::get('/v1/venda', [VendaController::class, 'index']);
Route::get('/v1/venda/{id}', [VendaController::class, 'show']);
Route::post('/v1/venda', [VendaController::class, 'store']);
Route::put('/v1/venda/{id}', [VendaController::class, 'update']);
Route::delete('/v1/venda/{id}', [VendaController::class, 'destroy']);

//Tabela VendaProduto
Route::get('/v1/vendaProduto', [VendaProdutoController::class, 'index']);
Route::get('/v1/vendaProduto/{id}', [VendaProdutoController::class, 'show']);
Route::post('/v1/vendaProduto', [VendaProdutoController::class, 'store']);
Route::put('/v1/vendaProduto/{id}', [VendaProdutoController::class, 'update']);
Route::delete('/v1/vendaProduto/{id}', [VendaProdutoController::class, 'destroy']);

//Admin Nova Venda
Route::post('/nova_venda', [VendaController::class, 'novaVenda']);
Route::post('/venda/novo_produto', [VendaProdutoController::class, 'novoProduto']);
Route::post('/venda/remover_produto', [VendaProdutoController::class, 'removerProduto']);
Route::get('/venda/carrinho/{id}', [VendaProdutoController::class, 'carrinho']);

//Rota Lista de Produtos por Categoria
Route::get('/v1/produto/categoria/{id}', [ProdutoController::class, 'showByCategory']);
//Rota Lista de Produtos Randomicos da mesma categoria
Route::get('/v1/produto/categoria/{id}/random', [ProdutoController::class, 'showProdutoSemelhantes']);


Route::post('/v1/loginCliente', [ClienteController::class, 'logar']);
