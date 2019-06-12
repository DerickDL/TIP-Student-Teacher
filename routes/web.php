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
Route::get('/teacher/courses/{integ_course_id}', 'Teacher\frontTeacher@integCoursePage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/courses/{integ_course_id}/sub/{course_id}', 'Teacher\frontTeacher@subCourseDetailPage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/courses/{course_id}/add', 'Teacher\frontTeacher@addCoursePage')->middleware('check.session', 'check.teacher');
Route::post('/teacher/course/add', 'Teacher\restTeacher@addCourse');
Route::post('teacher/course/lesson/delete', 'Teacher\restTeacher@deleteLesson');

Route::get('/teacher/courses/{course_id}/lesson/add', 'Teacher\frontTeacher@addLessonPage')->middleware('check.session', 'check.teacher');
Route::post('/teacher/courses/{course_id}/lesson/add', 'Teacher\restTeacher@addLesson');
Route::post('/teacher/course/delete/{course_id}', 'Teacher\restTeacher@removeLesson');
Route::get('/teacher/courses/lesson/{lesson_id}', 'Teacher\frontTeacher@lessonPage')->middleware('check.session', 'check.teacher');

Route::get('/teacher/courses/lesson/{lesson_id}/questions', 'Teacher\frontTeacher@questionsPage')->middleware('check.session', 'check.teacher');
Route::post('/teacher/courses/lesson/{lesson_id}/questions/add', 'Questions\restQuestions@addQuestion');
Route::get('/teacher/courses/lesson/{lesson_id}/questions/load', 'Questions\restQuestions@loadQuestion');

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