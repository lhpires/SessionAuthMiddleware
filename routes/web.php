<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Http\Request;

require_once "admin/admin.routes.php";
require_once "master/master.routes.php";

Route::get('/', function () {
    return redirect()->route('admin.login');
});

//Route::get('session',function(\Illuminate\Http\Request $request){
//    \Illuminate\Support\Facades\Session::put("name","Lucas");
//    \Illuminate\Support\Facades\Session::increment('views',1);
//    dump(\Illuminate\Support\Facades\Session::all());
//});
//
//Route::get('userSpa',function (){
//    return view('userSpa');
//});

// Migrado para Web devido a requisição SPA (ESTUDOS)
Route::middleware('auth:sanctum')->get('api/user', function (Request $request) {
    return $request->user();
});

// Gerará log em Storage/logs/laravel.log
Route::get('mid',function (){
    \Illuminate\Support\Facades\Log::debug("Estou na requisição");
})->middleware(['logPiresKernel:true']);

// Gerará log em Storage/logs/laravel.log
Route::middleware(['logPiresKernel'])->get('mid2',function (){
    \Illuminate\Support\Facades\Log::debug("Estou na req mid2 e não vou executar nada depois pq n vou passar parêmetro true");
});
