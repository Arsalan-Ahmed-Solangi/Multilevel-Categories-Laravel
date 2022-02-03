<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;



//***Start of Default Route Redirect to Login*********//
Route::get('/', function () {
    return redirect(route('login'));
});
//***End of Default Route Redirect to Login*********//

//***Start of Auth Routes Login*****//
Auth::routes(['register'=>false]);
//***End of Auth Routes Login*******//

//**Start of Auth User Routes*******//
Route::group(['middleware' => 'auth'],function () {

    //***Home Route******//
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //*****Categories Route*******//
    Route::resource('categories', CategoryController::class);

    //***Logut Route*******//
    Route::get('/logout',[HomeController::class,'logout'])->name('logout');

});
//**End of Auth User Routes********//

