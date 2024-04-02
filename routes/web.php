<?php

// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\JobController;
// use App\Http\Controllers\TaskController;
use App\Livewire\Tasks\Tasks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', Tasks::class)->name('home');
    Route::get('/tasks', Tasks::class)->name('tasks');
});