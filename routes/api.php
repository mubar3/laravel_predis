<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Broadcast_controller;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/send_koordinat', [Broadcast_controller::class, 'send_koordinat']);
Route::get('/git_pull', [App\Http\Controllers\Controller::class, 'git_pull']);
Route::any('/auto-git-pull', '\MichelMelo\MMAutoGitPull\MMAutoGitPullController@pull');
