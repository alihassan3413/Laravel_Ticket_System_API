<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\AuthorTicketsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/tickets', TicketController::class)->except(['update']);
    Route::put('tickets/{ticket}', [TicketController::class,'replace']);
    Route::patch('tickets/{ticket}',[TicketController::class,'update']);

    Route::apiResource('/users', UserController::class)->except(['update']);
    Route::put('users/{user}', [UserController::class,'replace']);
    Route::patch('users/{user}',[UserController::class,'update']);

    Route::apiResource('/authors', AuthorController::class)->except(['store','update','delete']);
    Route::apiResource('authors.tickets', AuthorTicketsController::class)->except(['update']);
    Route::put('authors/{author}/tickets/{ticket}', [AuthorTicketsController::class, 'replace']);
    Route::patch('authors/{author}/tickets/{ticket}', [AuthorTicketsController::class, 'update']);
});
