<?php

use App\Chats\Controllers\CreateChatController;
use App\Chats\Controllers\GetChatController;
use App\Chats\Controllers\GetChatsController;
use App\Comments\Controllers\CreateCommentController;
use App\Comments\Controllers\GetCommentController;
use App\Comments\Controllers\GetCommentsController;
use App\Users\Controllers\DeleteUserController;
use App\Users\Controllers\GetUserController;
use App\Users\Controllers\ListUserController;
use App\Users\Controllers\LoginController;
use App\Users\Controllers\StoreUserController;
use App\Users\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
*/
Route::prefix('users')
    ->middleware([])
    ->group(static function () {
        Route::get('/', ListUserController::class);
        Route::get('/{user}', GetUserController::class);
        Route::post('/', StoreUserController::class);
        Route::delete('/{user}', DeleteUserController::class);
    });

Route::post('/login', LoginController::class);

Route::group(['prefix' => 'chats'], function () {
    Route::get('/', GetChatsController::class);
    Route::get('/{chat}', GetChatController::class);
    Route::post('/', CreateChatController::class)->middleware('auth:sanctum');
});

Route::group(['prefix' => 'comments'], function () {
    Route::get('/', GetCommentsController::class);
    Route::get('/{comment}', GetCommentController::class);
    Route::post('/', CreateCommentController::class)->middleware('auth:sanctum');
});

Route::get('/user', function (Request $request) {
    return responder()->success($request->user(), UserTransformer::class)->respond();
})->middleware('auth:sanctum');
