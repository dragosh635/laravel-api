<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollsController;

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

Route::middleware( 'auth:api' )->get( '/user', function ( Request $request ) {
    return $request->user();
} );

Route::get( 'polls', [ PollsController::class, 'index' ] );
Route::get( 'polls/{id}', [ PollsController::class, 'show' ] );
Route::post( 'polls', [ PollsController::class, 'store' ] );
Route::put( 'polls/{poll}', [ PollsController::class, 'update' ] );
Route::delete( 'polls/{poll}', [ PollsController::class, 'delete' ] );
Route::any( 'errors', [ PollsController::class, 'errors' ] );

Route::apiResource( 'questions', \App\Http\Controllers\QuestionsController::class );
Route::get( 'polls/{poll}/questions', [ PollsController::class, 'questions' ] );
Route::get( 'files/get', [ \App\Http\Controllers\FilesController::class, 'show' ] );
Route::post( 'files/create', [ \App\Http\Controllers\FilesController::class, 'create' ] );
