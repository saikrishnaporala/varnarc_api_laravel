<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\RowsController;
use App\Http\Controllers\FilesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected group
Route::middleware('auth:api')->group(function () {
    // Files
    Route::post('/files/{id}/upload', [FilesController::class, 'upload']);

    // Tables
    Route::get('/tables', [TablesController::class, 'index']);
    Route::get('/tables/{table}/columns', [TablesController::class, 'columns']);
    Route::get('/tables/{table}/preview', [TablesController::class, 'preview']);
    Route::delete('/tables/{table}', [TablesController::class, 'destroy']);

    // Rows
    Route::get('/tables/{table}/rows', [RowsController::class, 'index']);
    Route::post('/tables/{table}/rows', [RowsController::class, 'store']);
    Route::get('/tables/{table}/rows/{id}', [RowsController::class, 'show']);
    Route::put('/tables/{table}/rows/{id}', [RowsController::class, 'update']);
    Route::delete('/tables/{table}/rows/{id}', [RowsController::class, 'destroy']);
    Route::post('/tables/{table}/rows/{id}/toggle-active', [RowsController::class, 'toggleActive']);
});
