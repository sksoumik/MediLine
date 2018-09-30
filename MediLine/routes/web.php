<?php

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

Route::get('/', 'PagesController@index');
Auth::routes();

Route::resource('Dashboard', 'DashboardController');


Route::get('/checkout', [
    'uses' => 'medicineController@getCheckout',
    'as' => 'medicine.checkout'
]);

Route::resource('profile', 'ProfileController');
//facebook socialite
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
Route::resource('medicine', 'MedicineController');

Route::prefix('owner')->group(/**
 *
 */
    function (){

    Route::get('/register', 'Auth\OwnerRegistrerController@showRegisterForm')->name('owner.register');
    Route::post('/register', 'Auth\OwnerRegistrerController@register')->name('owner.register.submit');


    Route::get('/login', 'Auth\OwnerLoginController@showLoginForm')->name('owner.login');
    Route::post('/login', 'Auth\OwnerLoginController@login')->name('owner.login.submit');
    Route::get('/logout', 'Auth\OwnerLoginController@logout')->name('owner.logout');
    Route::get('/', 'OwnerController@index')->name('owner.dashboard');
    Route::get('/upload', 'OwnerController@upload')->name('owner.upload');

        Route::resource('owner', 'OwnerController');

    });

    Route::get('/add-to-cart/{id}', [
        'uses' => 'medicineController@getAddToCart',
        'as' => 'medicine.addToCart'
    ]);

Route::get('/shopping-cart', [
    'uses' => 'medicineController@getCart',
    'as' => 'medicine.shoppingCart'
]);

Route::get('/checkout', [
    'uses' => 'medicineController@getCheckout',
    'as' => 'medicine.checkout'
]);

Route::post('/checkout', [
    'uses' => 'medicineController@postCheckout',
    'as' => 'medicine.checkout'
]);






