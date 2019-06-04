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

Route::get('/teacher', 'Teacher\frontTeacher@homePage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/subjects', 'Teacher\frontTeacher@subjectPage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/subjects/{course_id}', 'Teacher\frontTeacher@subjectDetailPage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/subject/add', 'Teacher\frontTeacher@addSubjectPage')->middleware('check.session', 'check.teacher');
Route::post('/teacher/subject/add', 'Teacher\restTeacher@addSubject');
Route::post('teacher/subject/lesson/delete', 'Teacher\restTeacher@deleteLesson');

Route::get('/teacher/subjects/{course_id}/lesson/add', 'Teacher\frontTeacher@addLessonPage')->middleware('check.session', 'check.teacher');
Route::post('/teacher/subjects/{course_id}/lesson/add', 'Teacher\restTeacher@addLesson');
Route::get('/teacher/subjects/lesson/{lesson_id}', 'Teacher\frontTeacher@lessonPage')->middleware('check.session', 'check.teacher');

Route::get('/teacher/subjects/lesson/{lesson_id}/questions', 'Teacher\frontTeacher@questionsPage')->middleware('check.session', 'check.teacher');
Route::post('/teacher/subjects/lesson/{lesson_id}/questions/add', 'Questions\restQuestions@addQuiz');

Route::get('/teacher/course/{course_id}/quizzes', 'Teacher\frontTeacher@quizPage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/course/{course_id}/quizzes/add', 'Teacher\frontTeacher@addQuizPage')->middleware('check.session', 'check.teacher');

Route::get('/student', 'Student\frontStudent@index')->middleware('check.session', 'check.student');
Route::get('/student/course/{course_id}', 'Student\frontStudent@courseHomePage')->middleware('check.session', 'check.student');
Route::get('/student/course/{course_id}/quizzes', 'Student\frontStudent@quizPage')->middleware('check.session', 'check.student');
Route::get('/student/course/{course_id}/quiz/{quiz_id}', 'Student\frontStudent@visitQuiz')->middleware('check.session', 'check.student');

Route::post('/quizzes/insert', 'Quizzes\controllerQuizzes@insertQuiz');
Route::post('/quizzes/submit', 'Student\controllerStudent@submitQuiz');

Route::get('/session', 'App\controllerUsers@getSession');
Route::get('/logout', 'App\controllerUsers@logoutUser');

// Post methods
Route::post('/login', 'App\controllerUsers@loginUser');
Route::post('/register', 'App\controllerUsers@registerUser');