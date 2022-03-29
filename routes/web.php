<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

// routes-employees
Route::get('/presence/list', 'App\Http\Controllers\PresencesListController@list')
    ->name('listar_presencas');
Route::post('/presence/register', 'App\Http\Controllers\AddPresenceController@add')
    ->name('registrar_presenca');

// routes-admin
Route::get('admin/presence/list', 'App\Http\Controllers\AdminPresencesListController@list')
    ->name('listar_presencas_admin')
    ->middleware('autenticador');
Route::patch('admin/presence/{id}/edit', 'App\Http\Controllers\AdminUpdatePresenceController@update')
    ->name('atualizar_presencas_admin')
    ->middleware('autenticador');
Route::delete('admin/presence/{id}', 'App\Http\Controllers\AdminRemovePresenceController@remove')
    ->name('deletar_presencas_admin')
    ->middleware('autenticador');

Route::post('/login', 'App\Http\Controllers\LoginController@login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});