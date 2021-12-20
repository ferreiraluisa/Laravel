<?php

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

// Route::get('/', function () {
//     //return view('welcome');
//     return()
// });
// Route::get('/sobre-nos', function () {
//     return view('welcome');
// });

// Route::get('/contato', function () {
//     return "fala aeee manolo ";
// });

//versao 7 laravel
Route::get('/','PrincipalController@principal');

//versao 8 laravel
Route::get('/',[\App\Http\Controllers\PrincipalController::class, 'principal'])->name('site.index'); 
//name('nome_da_aplicacao') : apelidar uma rota para usar DENTRO da aplicação, isso evita dependencia em relacao ao nome longo da rota, porque pode mudar ao longo da implementação do projeto
Route::get('/sobre-nos',[\App\Http\Controllers\SobreNosController::class, 'sobreNos'])->name('site.sobrenos');
Route::get('/contato',[\App\Http\Controllers\ContatoController::class, 'contato'])->name('site.contato');
Route::get('/login',[\App\Http\Controllers\ContatoController::class, 'contato'])->name('site.login');

Route::prefix('/app')->group(function() {
    Route::get('/clientes',[\App\Http\Controllers\ContatoController::class, 'contato'])->name('app.clientes');
    Route::get('/fornecedores',[\App\Http\Controllers\ContatoController::class, 'contato'])->name('app.fornecedores');
    Route::get('/produtos',[\App\Http\Controllers\ContatoController::class, 'contato'])->name('site.produtos');
});

Route::redirect('/principal','/');

Route::fallback(function() {
    echo 'A rota acessada não existe. <a href="'.route('site.index').   '"> Clique aqui</a> para acessar a página principal!';
});

//passando parametros nas rotas...
//tem uma limitação, não se pode deixar o nome ser opcional e o categoria obrigatório, porque o laravel se perde nos parametros
// Route::get('/contato/{nome}/{categoria?}', function (string $nome, string $categoria = 'chocolate' /*precisa setar um valor padrao para o parametro opcional*/ ) {
//     return "ola,".$nome."! Gostaria de saber mais sobre ".$categoria."?";
// });

//tratando parametros de rotas com expressoes regulares
Route::get('/contato/{nome}/{categoria}', function (string $nome, int $categoria_id = 1) {
    return "ola,".$nome."! - ".$categoria_id;
})->where('categoria_id', '[0-9]+')->where('nome','[A-Za-z]+');


/* principais verbos http utilizados para controlar as requisições feitas pro servidor
    get($uri, $callback)
    post
    put
    patch
    delete
    options
*/
