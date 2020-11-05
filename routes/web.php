<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource( 'users', 'UserController' )->except( 'show' );
Route::get( '/profile', ['uses' => 'UserController@profile', 'as' => 'user.profile'] );
Route::get( '/search-user', ['uses' => 'UserController@search', 'as' => 'user.search'] );

Route::patch( '/user-basic-data-update', [
    'as'   => 'user_basic_data.update',
    'uses' => 'UsersController@user_basic_data_update',
] );
Route::patch( '/user-account-data-update', [
    'as'   => 'user_account_data.update',
    'uses' => 'UsersController@user_account_data_update',
] );


Route::get('/str',function(){
    echo Storage::url("nibir.txt");
});