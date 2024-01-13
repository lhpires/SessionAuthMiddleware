<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

Route::group(["as" => "api."],function(){
    //por causa do as o nome da rota seria admin.login
    Route::post('/login',[AuthController::class,'attempt'])->name('login');
    Route::get('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum')->name('logout');
});

//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
