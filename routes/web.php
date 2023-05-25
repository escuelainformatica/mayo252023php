<?php

use App\View\Components\Alert;
use App\View\Components\Fila;
use App\View\Components\Tabla;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get("/ejemplo1",function() {
    return view("ejemplo1");
});
Route::get("/ejemplo2",function() {
    return view("ejemplo2");
});
Route::get("/ejemplo3",function() {
    Blade::component('comp-tabla', Tabla::class);
    Blade::component('package-alert', Alert::class);
    Blade::component('comp-fila', Fila::class);
    return view("ejemplo3",["paises"=>[
        ["nombre"=>"chile","id"=>1],
        ["nombre"=>"argentina","id"=>2],
        ["nombre"=>"peru","id"=>3],
    ],
    'productos'=>[
        ['nombre'=>'cocacola','precio'=>444,'cantidad'=>44],
        ['nombre'=>'fanta','precio'=>444,'cantidad'=>44],
        ['nombre'=>'sprite','precio'=>444,'cantidad'=>44],
        ['nombre'=>'sevenup','precio'=>444,'cantidad'=>44],
        ['nombre'=>'dew','precio'=>444,'cantidad'=>44],
    ]
]);
});