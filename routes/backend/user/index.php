<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\AdminController;
use App\Http\Controllers\frontend\ViewController;

Route::get('/dashboard', [ViewController::class, 'contact']);