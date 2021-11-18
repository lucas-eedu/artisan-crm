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

Route::redirect('/', '/login');

Route::namespace('App\Http\Controllers')->group(function() {
    Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');

    Route::resource('user', 'UserController');
    Route::resource('permission', 'PermissionController');
    Route::resource('profile', 'ProfileController');
    Route::resource('company', 'CompanyController');

    Route::get('/myprofile', 'UserController@myProfile')->name('myProfile');
    Route::put('/myprofile', 'UserController@myProfileUpdate')->name('myProfileUpdate');
});

require __DIR__.'/auth.php';
