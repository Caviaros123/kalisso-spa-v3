<?php

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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::any('/{vue_capture?}', function () {
    return view('layouts.app');
})->where('vue_capture', '(?!api).*$')
->where('vue_capture', '^(?!admin).*$')
->where('vue_capture', '^(?!broadcasting).*$')
->where('vue_capture', '^(?!laravel-websockets).*$')
->where('vue_capture', '^(?!tasks/members).*$')
->where('vue_capture', '^(?!tasks/products).*$')
->where('vue_capture', '^(?!notify).*$');

Route::group(['prefix' => 'broadcasting'], function () {
    Broadcast::routes();
});

// 	// EXPORT CSV FROM DB
Route::get('/tasks/members', 'TaskController@exportCsv');
Route::get('/tasks/products', 'TaskController@exportCsvProducts');
Route::get('/payment/callback', 'PaymentController@Callback');

Route::get('/notify', function (){
    $product= Product::first();
    $user= User::first();
    // dd($user);
    Broadcast(new ProductLiked($product, $user));
});
