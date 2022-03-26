<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

// The Email Verification Notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// The Email Verification Handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resending The Verification Email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Login
Route::redirect('/', '/login');

// App Routes
Route::namespace('App\Http\Controllers')->middleware('verified')->group(function() {
    Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');

    Route::resource('user', 'UserController');
    Route::resource('permission', 'PermissionController');
    Route::resource('profile', 'ProfileController');
    Route::resource('company', 'CompanyController');
    Route::resource('product', 'ProductController');
    Route::resource('origin', 'OriginController');

    Route::get('/myprofile', 'UserController@myProfile')->name('myProfile');
    Route::put('/myprofile', 'UserController@myProfileUpdate')->name('myProfileUpdate');

    Route::get('/mycompany', 'CompanyController@myCompany')->name('myCompany');
    Route::put('/mycompany', 'CompanyController@myCompanyUpdate')->name('myCompanyUpdate');
});

require __DIR__.'/auth.php';
