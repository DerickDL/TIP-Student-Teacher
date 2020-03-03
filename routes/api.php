<?php

use Illuminate\Http\Request;

use App\Mail\SendDefaultPassword;
use Illuminate\Support\Facades\Mail;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/file/download/attachments/{file_id}', 'Teacher\restTeacher@downloadFile');
Route::get('/send/default-password/{password}', function ($sPassword){
    Mail::to('johnderickdeleon@gmail.com')->send(new SendDefaultPassword($sPassword));
});
