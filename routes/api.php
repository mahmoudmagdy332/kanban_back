<?php

use App\Http\Controllers\MemberController;
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

Route::get('allMembers',[MemberController::class, 'all'] );

Route::post('createMember',[MemberController::class, 'create'] );

Route::post('editStatus',[MemberController::class, 'editStatus'] );

Route::get('deleteMember/{id}',[MemberController::class, 'deleteMember'] );

Route::post('editMember/{id}',[MemberController::class, 'editMember'] );
