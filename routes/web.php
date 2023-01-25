<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [HomeController::class, 'showTeams'])->name('index');
Route::get('getMembers', [HomeController::class, 'getMembers'])->name('getMembers');
Route::get('team_details/{id}', [HomeController::class, 'teamDetail'])->name('teamDetail');
Route::post('update_team_members', [HomeController::class, 'updateMembers'])->name('updateTeamMembers');