<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToursController;
use Illuminate\Support\Facades\Auth;


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
    return view('auth.login');
});

Route::get('/tours', function () {
    return view('tours.index');
});

Route::get('/tours/create',[ToursController::class,'create']);

Route::resource('tours',ToursController::class)->middleware('auth');
Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [ToursController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/',[ToursController::class, 'index'])->name('home');
});