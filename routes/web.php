<?php

use App\Http\Controllers\HomeController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

Route::get( '/', function () {
    return view( 'welcome' );
} );

Auth::routes();

Route::get( '/home', [App\Http\Controllers\HomeController::class, 'index'] )->name( 'home' );

Route::group( ['auth', 'role:Admin'], function () {
    Route::resource( 'users', 'UserController' )->except( 'show' );

    Route::get( '/search-user', ['uses' => 'UserController@search', 'as' => 'user.search'] );

    Route::patch( '/user-basic-data-update', [
        'as'   => 'user_basic_data.update',
        'uses' => 'UserController@user_basic_data_update',
    ] );
    Route::patch( '/user-account-data-update', [
        'as'   => 'user_account_data.update',
        'uses' => 'UserController@user_account_data_update',
    ] );

} );
Route::get( '/profile', ['uses' => 'UserController@profile', 'as' => 'user.profile'] );

Route::get( 'setup', function () {
    User::insert( [
        'name'    => 'Admin',
        'email'    => 'admin@admin.com',
        'cell_no'    => '123456',
        'nid'    => '123456',
        'division'    => 'Dhaka',
        'district'    => 'Dhaka',
        'subdistrict'    => 'Dhaka',
        'password'=> Hash::make('password'),
        'role_id' => 1,
    ] );

    Role::insert( [
        ['id' => 1, 'name' => 'Super Admin'],
        ['id' => 2, 'name' => 'Admin'],
        ['id' => 3, 'name' => 'Dealer'],
        ['id' => 4, 'name' => 'Shop Owner'],
        ['id' => 5, 'name' => 'Service Center'],
        ['id' => 6, 'name' => 'Sales Representative'],
        ['id' => 7, 'name' => 'Divisional Manager'],
    ] );

    echo "Setup Successful";
} );
