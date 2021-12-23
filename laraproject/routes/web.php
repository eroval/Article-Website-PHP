<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Articles

    // Create
    Route::get('/create-article/', [ArticleController::class, 'index']);
    Route::post('store-article', [ArticleController::class, 'store']);

    // View
    Route::get('/', [ArticleController::class, 'loadStart']);
    Route::get('/article/{id}', [ArticleController::class, 'loadPage']);

    // Update
    Route::get('/edit-article/{id}', [ArticleController::class, 'editPage']);
    Route::patch('/update-article/{id}', [ArticleController::class, 'updateArticle']);

    // Delete
    Route::get('/confirm-delete-article/{id}', [ArticleController::class, 'deletePage']);
    Route::delete('/delete-article/{id}',[ArticleController::class, 'delete']);

    // Search
    Route::get('/search-article/', [ArticleController::class, 'search']);