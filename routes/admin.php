<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('posts', PostController::class);