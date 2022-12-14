<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);

Route::get('/tags', [TagController::class, 'index']);
Route::get('/tags/{tag}', [TagController::class, 'show']);

Route::get('/categories', [CategorieController::class, 'index']);
Route::get('/categories/{categorie}', [CategorieController::class, 'show']);

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{news}', [NewsController::class, 'show']);


Route::group(['middleware' => ['guest', 'web']], function () {
    Route::get('login', [SessionController::class, 'create'])->name('login');
    Route::post('login', [SessionController::class, 'store']);

    // Da ne pravim novi Controller samo za dve funkcije
    Route::get('register', function () {
        return view('register.create');
    });
    Route::post('register', [UserController::class, 'register']);
});

Route::group(['middleware' => ['auth', 'admin', 'web']], function () {

    Route::get('/addUser', [UserController::class, 'create']);
    Route::post('/addUser', [UserController::class, 'store']);

    Route::get('/addTag', [TagController::class, 'create']);
    Route::post('/addTag', [TagController::class, 'store']);

    Route::get('/addCategorie', [CategorieController::class, 'create']);
    Route::post('/addCategorie', [CategorieController::class, 'store']);

    Route::get('/addNews', [NewsController::class, 'create']);
    Route::post('/addNews', [NewsController::class, 'store']);
    Route::get('/editNews/{news}', [NewsController::class, 'edit']);
    Route::patch('/updateNews/{news}', [NewsController::class, 'update']);
});

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::post('/logout', [SessionController::class, 'destroy']);

    Route::get('/subscribe', [UserController::class, 'showSubscribe']);
    Route::post('/subscribe/{user}', [UserController::class, 'storeSubscribe']);
});

