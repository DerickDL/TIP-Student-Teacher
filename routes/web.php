<?php

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

// Get Methods
Route::get('/', function () {
    return view('pages.login');
});
Route::get('/logout', 'App\controllerUsers@logoutUser');
Route::get('/teacher', 'Teacher\frontTeacher@index')->middleware('check.session', 'check.teacher');
Route::get('/student', 'Student\frontStudent@index')->middleware('check.session', 'check.student');
Route::get('/courses', 'controllerCommon@getCourses');
Route::get('/session', 'App\controllerUsers@getSession');
Route::get('/forbidden', function() {
	return view('forbidden');
});

// Post methods
Route::post('/login', 'App\controllerUsers@loginUser');
Route::post('/register', 'App\controllerUsers@registerUser');