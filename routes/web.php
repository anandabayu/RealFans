<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Follower\FollowerController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
})->middleware('auth');

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(GoogleAuthController::class)->group(function () {
   Route::get('/auth/google/redirect', 'redirect')->name('google-auth-redirect');
   Route::get('/auth/google/callback', 'callback')->name('google-auth-callback');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'index')->name('profile');
    Route::post('/profile/change-avatar', 'changeAvatar')->name('change-avatar');
    Route::post('/profile/change-info', 'changeInfo')->name('change-info');
    Route::get('/profile/followers', 'followers')->name('followers');
})->middleware('auth');

Route::controller(FollowerController::class)->group(function () {
   Route::get('/follow/{username}', 'follow')->name('follow');
   Route::get('/unfollow/{username}', 'unfollow')->name('unfollow');
})->middleware('auth');

Route::controller(UserController::class)->group(function () {
    Route::get('/user/{username}', 'index')->name('user-info');
    Route::get('/user/{username}/subscribe', 'subscribe')->name('subscribe');
    Route::post('/user/{username}/subscribe', 'payment')->name('payment');
})->middleware('auth');

Route::controller(PostController::class)->group(function () {
   Route::post('/post', 'post')->name('post');
})->middleware('auth');
