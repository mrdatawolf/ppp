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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
})->name('welcome');

Route::get('/mailing_list_signup', function () {
    return view('welcome');
})->name('mailing_list_signup');

Route::get('/rewards_signup', function () {
    return view('welcome');
})->name('rewards_signup');

Route::get('/free_shipping', function () {
    return view('free_shipping');
})->name('free_shipping');

Route::get('/men_landing', function () {
    return view('men_landing');
})->name('men_landing');

Route::get('/women_landing', function () {
    return view('women_landing');
})->name('women_landing');

Route::get('/shoes_landing', function () {
    return view('shoes_landing');
})->name('shoes_landing');

Route::get('/shopping_cart', function () {
    return view('shopping_cart');
})->name('shopping_cart');






Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');
