<?php

// use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\InfoUserController;
// use App\Http\Controllers\RegisterController;
// use App\Http\Controllers\ResetController;
use App\Http\Controllers\EntrarController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AcessoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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
	Route::get('/', function () {
		return view('home');
	})->name('dashboard');

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
