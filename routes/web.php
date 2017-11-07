<?php

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

Route::get('/ejemplo', function () {
    return view('ejemplo');
});

Route::get('ejemplo/submit', function () {
    return $_GET["nombre"];
});

Route::get('/ejercicio1', function () {
    return view('ejercicio1');
});

Route::get('ejercicio1/submit', function () {
    $nombreFichero = $_GET["fichero"];
    //$rutaFichero = "/home/zubiri/"+$nombreFichero;
    $rutaFichero = $nombreFichero;
    $fichero = fopen("$rutaFichero", "r");
    $contenidoFichero = fread($fichero, filesize($rutaFichero));
    return $contenidoFichero;
});