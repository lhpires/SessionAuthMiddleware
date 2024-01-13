<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\AuthController;

Route::group(["prefix" => "master", "as" => "master."],function(){
    //por causa do as o nome da rota seria admin.login
    Route::get('/',[AuthController::class,'login'])->name('login');
    Route::post('/login/do',[AuthController::class,'attempt'])->name('login.do');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

    Route::group(["middleware" => ["auth:sanctum","VerifyIsMaster"]],function (){
        Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    });
});
