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
Route::get('/forbidden', function() {
    return view('forbidden');
});

Route::get('/teacher', 'Teacher\frontTeacher@index')->middleware('check.session', 'check.teacher');
Route::get('/teacher/course/{course_id}', 'Teacher\frontTeacher@courseHomePage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/course/{course_id}/quizzes', 'Teacher\frontTeacher@quizPage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/course/{course_id}/quizzes/add', 'Teacher\frontTeacher@addQuizPage')->middleware('check.session', 'check.teacher');

Route::get('/student', 'Student\frontStudent@index')->middleware('check.session', 'check.student');
Route::get('/student/course/{course_id}', 'Student\frontStudent@courseHomePage')->middleware('check.session', 'check.student');
Route::get('/student/course/{course_id}/quizzes', 'Student\frontStudent@quizPage')->middleware('check.session', 'check.student');


Route::post('/quizzes/insert', 'Quizzes\controllerQuizzes@insertQuiz');
Route::get('/quizzes/get/{quiz_id}', 'Quizzes\controllerQuizzes@getQuiz');

Route::get('/session', 'App\controllerUsers@getSession');
Route::get('/logout', 'App\controllerUsers@logoutUser');

// Post methods
Route::post('/login', 'App\controllerUsers@loginUser');
Route::post('/register', 'App\controllerUsers@registerUser');