<?php
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('pages.index');
    });

    Route::get('/transactions', function () {
        return view('pages.transactions');
    });

    Route::get('/banque', function () {
        return view('pages.banque.index');
    });
    
    Route::get('/users', function () {
        return view('pages.users');
    });

    Route::get('/show/{slug}', function () {
        return view('pages.show');
    });

    Route::get('/cartes', function () {
        return view('pages.cartes');
    });

    Route::post('/new/user/register', 'App\Http\Controllers\UserController@store')->name('user.register');
    Route::get('/delete/user/{id}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');
    Route::get('/show/user/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');
    Route::get('/edit/user/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');
    //CRUD BANK
    Route::post('/new/bank/account', 'App\Http\Controllers\BankController@store')->name('bank.store');
    Route::get('/bank/account', 'App\Http\Controllers\BankController@index')->name('bank.index');
    Route::get('/bank/delete/user/{id}', 'App\Http\Controllers\BankController@destroy')->name('bank.delete');
    Route::patch('/bank/show/user/{id}', 'App\Http\Controllers\BankController@show');
    // Route::get('/bank/edit/user/{id}', 'App\Http\Controllers\BankController@edit')->name('bank.edit');
    Route::put('/bank/account', 'App\Http\Controllers\BankController@update')->name('bank.deposit');
    Route::patch('/user/banque/{id}', 'App\Http\Controllers\BankController@getAmount');


    // BANK GROUP
    Route::post('/new/bank/group/account', 'App\Http\Controllers\BankController@storeGroup')->name('bank.group.store');
    Route::get('/bank/group/account', 'App\Http\Controllers\BankController@indexGroup')->name('bank.group.index');
    Route::get('/bank/group/delete/user/{id}', 'App\Http\Controllers\BankController@destroyGroup')->name('bank.group.delete');
    Route::patch('/bank/group/show/user/{id}', 'App\Http\Controllers\BankController@showGroup');
    Route::get('/bank/group/edit/user/{id}', 'App\Http\Controllers\BankController@editGroup')->name('bank.group.edit');
    Route::put('/bank/group/account', 'App\Http\Controllers\BankController@updateGroup')->name('bank.group.deposit');
    Route::put('/bank/group/account/withdrawl', 'App\Http\Controllers\BankController@updateGroup')->name('bank.group.withdrawl');
    Route::patch('/bank/group/user/{id}', 'App\Http\Controllers\BankController@getGroupAmount');
    
    
    //CRUD SCORECARD
    Route::get('/scorecard/delete/account/{id}', 'App\Http\Controllers\CarteController@destroy')->name('scorecard.delete');
    Route::get('/scorecard/edit/user/{id}', 'App\Http\Controllers\CarteController@edit')->name('scorecard.edit');
    Route::put('/update/carte/deposit', 'App\Http\Controllers\CarteController@update')->name('carte.deposit');
    Route::put('/update/carte/withdrawl', 'App\Http\Controllers\CarteController@update')->name('carte.withdrawl');
    Route::get('/all/carte/account', 'App\Http\Controllers\CarteController@index')->name('carte.index');
    Route::post('/create/carte', 'App\Http\Controllers\CarteController@store')->name('carte.store');
    Route::patch('/user/carte/{id}', 'App\Http\Controllers\CarteController@getAmount');
    Route::patch('/scorecard/show/account/{id}', 'App\Http\Controllers\CarteController@show');
    
    //SCORECARD Group
    Route::get('/scorecard/all/account/group','App\Http\Controllers\CarteController@indexGroup')->name('carte.group.index');
    Route::get('/scorecard/delete/account/group/{id}','App\Http\Controllers\CarteController@destroyGroup')->name('carte.group.detroy');
    Route::post('/scorecard/create/group', 'App\Http\Controllers\CarteController@storeGroup')->name('carte.group.store');
    Route::put('/scorecard/update/group', 'App\Http\Controllers\CarteController@updateGroup')->name('carte.group.deposit');
    Route::patch('/user/carte/group/{id}', 'App\Http\Controllers\CarteController@getGroupAmount');
    
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
