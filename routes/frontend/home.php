<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\ViewController;

Route::get('/', [ViewController::class, 'index'])->name('index');

Route::get('/about-us', [ViewController::class, 'about'])->name('about');

Route::get('/product', [ViewController::class, 'product'])->name('product');

Route::get('/contact', [ViewController::class, 'contact'])->name('contact');

Route::get('/login', [ViewController::class, 'login'])->name('login');

Route::get('/register', [ViewController::class, 'register'])->name('register');