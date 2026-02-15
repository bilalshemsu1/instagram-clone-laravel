<?php

use App\Livewire\Login;
use App\Livewire\Profile;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/login', Login::class)->name('login');
Route::get('/', Register::class)->name('register');
Route::get('/register', Register::class)->name('register');

Route::middleware(['auth'])->group(function(){
    Route::get("/profile", Profile::class)->name('profile');
});