<?php

use Illuminate\Support\Facades\DB;

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
    return view('index');
});

Route:: get('/Admin', 'ControladorForm@Admin');
Route:: post('/Admin', 'ControladorForm@InserDep');
Route:: get('/Admin/Eliminar/{id}', 'ControladorForm@DeleteDep');
Route:: get('/Admin/Editar/{id}', 'ControladorForm@UpdateDep');
Route:: post('/Admin/Update/{id}', 'ControladorForm@UpdateDep2');


Route:: get('/Usuario', 'ControladorForm@Usua');
Route:: post('/Cotizacion', 'ControladorForm@InserCot');
Route:: get('/Usuario/Editar/{id}', 'ControladorForm@UpdateCot');
Route:: post('/Usuario/Update/{id}', 'ControladorForm@Updatecot2');
Route:: get('/Usuario/Abonar/{id}', 'ControladorForm@UpdateAbo');
Route:: post('/Usuario/InseAbo/{id}', 'ControladorForm@InstAbo');

