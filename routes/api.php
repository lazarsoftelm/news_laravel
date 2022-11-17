<?php

use App\Http\Controllers\ApiControllers\CategoryApiController;
use App\Http\Controllers\ApiControllers\CommentApiController;
use App\Http\Controllers\ApiControllers\EmojiApiController;
use App\Http\Controllers\ApiControllers\NewsApiController;
use App\Http\Controllers\ApiControllers\ReactionApiController;
use App\Http\Controllers\ApiControllers\TagApiController;
use App\Http\Controllers\ApiControllers\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('users', [UserApiController::class, 'index']);
Route::get('users/{id}', [UserApiController::class, 'show']);
Route::post('user', [UserApiController::class, 'store']);
Route::post('/users/withImage', [UserApiController::class, 'storeWithImage']);
Route::post('/users/update', [UserApiController::class, 'update']);
Route::post('users/saveNews', [UserApiController::class, 'saveNews']);
Route::post('users/detachSavedNews', [UserApiController::class, 'detachSavedNews']);

Route::get('tags', [TagApiController::class, 'index']);
Route::get('tags/{id}', [TagApiController::class, 'show']);
Route::get('tags/name/{name}', [TagApiController::class, 'showByName']);
Route::post('tags', [TagApiController::class, 'store']);

Route::get('categories', [CategoryApiController::class, 'index']);
Route::get('categories/{id}', [CategoryApiController::class, 'show']);
Route::post('category', [CategoryApiController::class, 'store']);

Route::get('news', [NewsApiController::class, 'index']);
Route::post('news', [NewsApiController::class, 'store']);

Route::get('reactions', [ReactionApiController::class, 'index']);
Route::post('reactions', [ReactionApiController::class, 'store']);

Route::get('emoji', [EmojiApiController::class, 'index']);
Route::post('emoji', [EmojiApiController::class, 'store']);

Route::get('comment', [CommentApiController::class, 'index']);
Route::post('comment', [CommentApiController::class, 'store']);

Route::post('/tokens/create', [UserApiController::class, 'createToken']);

Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::get('authUser', [UserApiController::class, 'index']);
});