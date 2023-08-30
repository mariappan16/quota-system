<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SportController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OverallQuotaController;
use App\Http\Controllers\StateQuotaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [StateQuotaController::class, 'index'])->name('state-quotas.index');


Route::get('/sports', [SportController::class, 'index'])->name('sports.index');
Route::get('/genders', [GenderController::class, 'index'])->name('genders.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/overall-quotas/create', [OverallQuotaController::class, 'create'])->name('overall-quotas.create');
Route::post('/overall-quotas', [OverallQuotaController::class, 'store'])->name('overall-quotas.store');
Route::get('/overall-quotas', [OverallQuotaController::class, 'index'])->name('overall-quotas.index');
Route::get('/state-quotas', [StateQuotaController::class, 'index'])->name('state-quotas.index');
Route::get('/state-quotas/create', [StateQuotaController::class, 'create'])->name('state-quotas.create');
Route::post('/state-quotas', [StateQuotaController::class, 'store'])->name('state-quotas.store');
Route::get('/get-categories/{sportId}/{genderId}', [OverallQuotaController::class, 'getCategories']);
Route::get('/get-states/{sportId}/{genderId}/{cartegoryId}', [StateQuotaController::class, 'getStatesForCategory']);
Route::get('/get-overall-quota/{sportId}/{genderId}/{cartegoryId}', [OverallQuotaController::class, 'getOverallQuota']);

