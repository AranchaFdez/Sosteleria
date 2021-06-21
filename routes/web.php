<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\HTTP;
use GuzzleHttp\Client;
use App\Http\Controllers\ZonasBasicasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\clientController;
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


//muestra los datos que le pasamos de la api y las busquedas de destacados
//Route::resource('sosteleria',ZonasBasicasController::class);
//Route::post('/sosteleria/local', 'App\Http\Controllers\ZonasBasicasController@datos');
//Route::post('/sosteleria/local', 'App\Http\Controllers\ZonasBasicasController@datos');
Route::get('/sosteleria', [App\Http\Controllers\ZonasBasicasController::class, 'index'])->name('sosteleria.index');
Route::post('sosteleria/local','App\Http\Controllers\ZonasBasicasController@recibirForm')->name('sosteleria.form');
Route::get('sosteleria/local','App\Http\Controllers\ZonasBasicasController@recibirForm')->name('sosteleria.form');
Route::post('local/restaurante/{nif}',  [App\Http\Controllers\ZonasBasicasController::class,'visita'])->name('sosteleria.restaurant');
Route::post('local/bar/{nif}',  [App\Http\Controllers\ZonasBasicasController::class,'visita'])->name('sosteleria.bar');

//Route::resource('sosteleria/local/bar/{nif}',LocalController::class);

Route::get('local/bar/{nif}',  [App\Http\Controllers\LocalController::class,'index']);
Route::get('local/restaurante/{nif}',  [App\Http\Controllers\LocalController::class,'index']);
Route::post('local/bar/{nif}',  [App\Http\Controllers\LocalController::class,'carta']);
Route::post('local/restaurante/{nif}',  [App\Http\Controllers\LocalController::class,'carta']);



Route::get('/about', function () {
    return view('layouts.about');
});
/*Route::get('/contact', function () {
    $correo= new ContactMailalble;
    Mail::to('arantzazu_fdez@outlook.com')->send($correo);
    return  "mensaje enviado";
    //view('layouts.contact');
})->name('contact.index');*/
Route::get('/contact',  [App\Http\Controllers\ContactController::class,'index'])->name('contact.index');

Route::post('/contact',  [App\Http\Controllers\ContactController::class,'store'])->name('contact.store');

Route::get('/restaurant', function () {
    return view('layouts.restaurante');
});
Route::get('/bar', function () {
    return view('layouts.bar');
});


//rutas de client
Route::group(['middleware'=>'auth'],function() {
    Route::resource('client',clientController::class);

});


Auth::routes();

Route::group(['middleware'=>'auth'],function() {
    Route::resource('admin',AdminController::class);
    Route::post('admin/activar/{nif}',  [App\Http\Controllers\AdminController::class,'activar'])->name('admin.activar');
    Route::delete('admin/activar/{nif}',  [App\Http\Controllers\AdminController::class,'borrar'])->name('admin.borrar');
});



