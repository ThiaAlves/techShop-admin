<?php

use App\Http\Controllers\EntrarController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\VendaProdutoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

    // Route::get('/', [HomeController::class, 'home']);
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/categorias', [CategoriaController::class, 'indexAdmin'])->name('categorias.index');
Route::post('/categorias', [CategoriaController::class, 'storeAdmin'])->name('categorias');
Route::post('/categorias/{id}', [CategoriaController::class, 'mudaStatus']);
// Route::delete('/categorias/{id}', [CategoriaController::class, 'destroyAdmin']);

// Rotas para produto
Route::get('/produto', [ProdutoController::class, 'indexAdmin'])->name('produtos.index');
Route::get('/produto/novo', [ProdutoController::class, 'createAdmin'])->name('produtos.create');
//Rota editar produto
Route::get('/produto/editar/{id}', [ProdutoController::class, 'editAdmin'])->name('produtos.editar');
Route::get('/produto/{id}', [ProdutoController::class, 'showAdmin'])->name('produtos.show');
Route::post('/produto', [ProdutoController::class, 'storeAdmin'])->name('produtos');
Route::post('/produto/{id}', [ProdutoController::class, 'mudaStatus']);
Route::delete('/produto/{id}', [ProdutoController::class, 'destroyAdmin']);
//Rota para deletar imagem
Route::delete('/produto/{id}/imagem/{nomeImagem}', [ProdutoController::class, 'destroyImageAdmin'])->name('produtos.imagem');


// Rotas para clientes
Route::get('/cliente', [ClienteController::class, 'indexAdmin'])->name('clientes.index');
Route::get('/cliente/novo', [ClienteController::class, 'createAdmin'])->name('cliente.create');
//Rota editar cliente
Route::get('/cliente/editar/{id}', [ClienteController::class, 'editAdmin'])->name('cliente.editar');
Route::post('/cliente', [ClienteController::class, 'storeAdmin'])->name('clientes');
// Route::delete('/cliente/{id}', [ClienteController::class, 'destroyAdmin']);
Route::post('/cliente/{id}', [ClienteController::class, 'mudaStatus']);

// Rotas para endereços
Route::post('/endereco', [EnderecoController::class, 'storeAdmin'])->name('enderecos');
Route::delete('/endereco/{id}', [EnderecoController::class, 'destroyAdmin']);

// Rotas para usuario 
Route::get('/usuario', [UsuarioController::class, 'indexAdmin'])->name('usuario.index');
Route::post('/usuario', [UsuarioController::class, 'storeAdmin'])->name('usuarios');
Route::delete('/usuario/{id}', [UsuarioController::class, 'destroyAdmin']);

//Rotas do Perfil
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/perfil', [PerfilController::class, 'store'])->name('perfil.store');




//Rotas para venda
Route::get('/vendas', [VendaController::class, 'listAdmin'])->name('vendas.index');
Route::get('/vendas/{id}', [VendaController::class, 'indexAdmin'])->name('vendas.create');
Route::post('/vendas', [VendaController::class, 'storeAdmin'])->name('vendas.store');
Route::post('/venda_produto', [VendaProdutoController::class, 'storeAdmin'])->name('venda.addProduto');
Route::post('/venda_produto/remove/', [VendaProdutoController::class, 'destroyAdmin'])->name('venda.removeProduto');
Route::post('/venda_produto/update/', [VendaProdutoController::class, 'updateAdmin'])->name('venda.updateProduto');

//Rotas para relatorios
Route::match(['post', 'get'], '/relatorio/vendas', [VendaController::class, 'relatorioVendas'])->name('relatorios.vendas');
Route::match(['post', 'get'], '/relatorio/vendedores', [VendaController::class, 'relatorioVendedores'])->name('relatorios.vendedores');
Route::match(['post', 'get'], '/relatorio/produtos', [ProdutoController::class, 'relatorioProdutos'])->name('relatorios.produtos');

Route::match(['get', 'post'], '/log_activity', [LogController::class, 'index'])->name('logs.index');

Route::post('/sair', [SessionsController::class, 'destroy']);
Route::get('/login', function () {
	return view('dashboard');
})->name('sign-up');
	
});

Route::get('/entrar', [EntrarController::class, 'index'])->name('login');
Route::post('/entrar', [EntrarController::class, 'entrar'])->name('login');
Route::get('/login', function () {
    return view('auth/login');
});
