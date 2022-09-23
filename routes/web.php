<?php

use Illuminate\Support\Facades\Route;
// 🔽 追加
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;

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
// 🔽 追加

Route::group(['middleware' => 'auth'], function () {
    // 🔽 追加（検索画面）
    Route::get('/tweet/search/input', [SearchController::class, 'create'])->name('search.input');
    // 🔽 追加（検索処理）
    Route::get('/tweet/search/result', [SearchController::class, 'index'])->name('search.result');
    Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
    Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');
    Route::get('/tweet/timeline', [TweetController::class, 'timeline'])->name('tweet.timeline');
    Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');

    Route::post('tweet/{tweet}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('tweet/{tweet}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');
    Route::get('/tweet/mypage', [TweetController::class, 'mydata'])->name('tweet.mypage');
    Route::resource('tweet', TweetController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
