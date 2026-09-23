<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InternalArticleController;
use App\Http\Middleware\VerifyContentBotToken;

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

// Internal Telegram Bot Content API
Route::prefix('internal')->middleware([VerifyContentBotToken::class, 'throttle:60,1'])->group(function () {
    Route::post('/articles', [InternalArticleController::class, 'store']);
    Route::get('/articles/{id}', [InternalArticleController::class, 'show']);
    Route::put('/articles/{id}', [InternalArticleController::class, 'update']);
    Route::post('/articles/{id}/publish', [InternalArticleController::class, 'publish']);
    Route::post('/articles/{id}/schedule', [InternalArticleController::class, 'schedule']);
});
