<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AuthController;

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


Route::post('/register', [AuthController:: class ,"register"] );
Route::post('/login', [AuthController:: class ,"login"] );
Route::post('/loggingout', [AuthController:: class ,"logout"] )->middleware('auth');




Route::get('/users', [UserController:: class ,"show"] );
Route::get('/users/{id}', [UserController:: class ,"detail"] );
Route::delete('/users/{id}', [UserController:: class ,"delete"] );




Route::get('/expense', [ExpenseController:: class ,"show"] );
Route::get('/expense/{id}', [ExpenseController:: class ,"detail"] );
Route::get('/expense/select/{user_id}', [ExpenseController:: class ,"select"] );
Route::get('/expense/countAmount/{user_id}', [ExpenseController:: class ,"countAmount"] );
Route::delete('/expense/{id}', [ExpenseController:: class ,"delete"] );
Route::post('/expense', [ExpenseController:: class ,"store"] );
