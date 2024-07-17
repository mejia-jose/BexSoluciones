<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitsController;
use App\Http\Controllers\UserController;

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
Route::post('/register-user', [UserController::class, 'registerUsers'])->name('register-user');
Route::post('/login-users', [UserController::class, 'loginUsers'])->name('login-users');

/* Rustas para el manejo de las Visitas */
    Route::post('/create-visits', [VisitsController::class, 'createAndUpdateVisits'])->name('create-visits');
    Route::put('/update-visits', [VisitsController::class, 'createAndUpdateVisits'])->name('update-visits');
    Route::get('/all-visits', [VisitsController::class, 'getVisits'])->name('all-visits');
    Route::get('/one-visits/{id}', [VisitsController::class, 'getVisits'])->name('one-visits');
    Route::delete('/delete-visits/{id}',[VisitsController::class, 'deleteVisits'])->name('delete-visits');
    Route::get('/all-users', [UserController::class, 'allUsers'])->name('all-users');

 