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

// Route::get('/article/{id}', function($id) {
//     $article = Article::findOrFail($id);
//     return view('article', ['article'=>$article]);
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create-article', [ArticleController::class, 'index']);
Route::post('store-article', [ArticleController::class, 'store']);
Route::get('/', [ArticleController::class, 'loadStart']);
Route::get('/article/{id}', [ArticleController::class, 'loadPage']);