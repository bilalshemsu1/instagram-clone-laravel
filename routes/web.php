<?php

use App\Livewire\CreatePost;
use App\Livewire\Feed;
use App\Livewire\Login;
use App\Livewire\Profile;
use App\Livewire\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::middleware(['auth'])->group(function(){
    // Route::get("/profile", Profile::class)->name('profile');
    Route::get('/profile/{username?}', Profile::class)->name('profile');
    Route::get("/feed", Feed::class)->name('feed');
    Route::get('/create-post', CreatePost::class)->name('create-post');
    Route::post("/logout", function(){
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});

Route::get('/', function(){
    return redirect()->route('register');
})->middleware('auth');