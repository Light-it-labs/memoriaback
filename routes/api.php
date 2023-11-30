<?php

use App\Chats\Controllers\CreateChatController;
use App\Users\Controllers\DeleteUserController;
use App\Users\Controllers\GetUserController;
use App\Users\Controllers\ListUserController;
use App\Users\Controllers\LoginController;
use App\Users\Controllers\StoreUserController;
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
    // Route::get('/', 'ChatController@index');
    // Route::get('/{chat}', 'ChatController@show');
    Route::post('/', CreateChatController::class);
    // Route::put('/{chat}', 'ChatController@update');
    // Route::delete('/{chat}', 'ChatController@destroy');
});
