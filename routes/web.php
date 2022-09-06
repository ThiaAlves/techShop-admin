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
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroyAdmin']);

// Rotas para produto
Route::get('/produto', [ProdutoController::class, 'indexAdmin'])->name('produtos.index');
Route::get('/produto/novo', [ProdutoController::class, 'createAdmin'])->name('produtos.create');
//Rota editar produto
Route::get('/produto/editar/{id}', [ProdutoController::class, 'editAdmin'])->name('produtos.editar');
Route::get('/produto/{id}', [ProdutoController::class, 'showAdmin'])->name('produtos.show');
Route::post('/produto', [ProdutoController::class, 'storeAdmin'])->name('produtos');
Route::post('/produto/{id}', [ProdutoController::class, 'mudaStatus']);

// Rotas para clientes
Route::get('/cliente', [ClienteController::class, 'indexAdmin'])->name('cliente.index');
Route::post('/cliente', [ClienteController::class, 'storeAdmin'])->name('clientes');
Route::delete('/cliente/{id}', [ClienteController::class, 'destroyAdmin']);

//Rota para deletar imagem
Route::delete('/produto/{id}/imagem/{nomeImagem}', [ProdutoController::class, 'destroyImageAdmin'])->name('produtos.imagem');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');

	
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/entrar', [EntrarController::class, 'index'])->name('login');
Route::post('/entrar', [EntrarController::class, 'entrar'])->name('login');




Route::get('/login', function () {
    return view('auth/login');
});
