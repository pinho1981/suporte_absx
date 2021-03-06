<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VendedoresController;

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

Route::get('/', function () {
    return view('home');
});
Route::get('/cadastro-vendedor', function (){
    return view('cadastro-vendedor');
});
Route::get('/cadastro-chamado', function (){
    return view('cadastro-chamado');
});
Route::get('/crud-chamado', function (){
    return view('crud-chamado');
});
Route::get('/meus-chamados', function (){
    return view('meus-chamados');
});
Route::get('/meus-chamados/{id}', 'App\Http\Controllers\Api\ChamadosController@meusChamados');
Route::get('/atrasados', 'App\Http\Controllers\Api\ChamadosController@atrasados' );

Auth::routes();
Route::group(['middleware' => ['web']], function () {
    Route::post('post-vendedor', 'App\Http\Controllers\Api\VendedoresController@store');
    Route::post('update-vendedor', 'App\Http\Controllers\Api\VendedoresController@updateview');
    Route::post('post-chamado', 'App\Http\Controllers\Api\ChamadosController@store');
    Route::post('update-chamado', 'App\Http\Controllers\Api\ChamadosController@updateView');
    Route::post('delete-vendedor','App\Http\Controllers\Api\VendedoresController@deleteView');
    Route::post('delete-chamado', 'App\Http\Controllers\Api\ChamadosController@deleteView');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
