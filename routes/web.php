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

/**TEACHER LOGIN**/
Route::get('/teacher', function () {
    return view('pages.teacher.login');
});

/**TEACHER HOME PAGE**/
Route::get('/teacher/home', 'Teacher\frontTeacher@homePage')->middleware('check.session', 'check.teacher');

/**MAIN COURSE PAGE**/
Route::get('/teacher/courses/{integ_course_id}', 'Teacher\frontTeacher@integCoursePage')->middleware('check.session', 'check.teacher');

/**SUB COURSES PAGE**/
Route::get('/teacher/courses/{integ_course_id}/sub/{course_id}', 'Teacher\frontTeacher@subCourseDetailPage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/courses/{integ_course_id}/add', 'Teacher\frontTeacher@addCoursePage')->middleware('check.session', 'check.teacher');
Route::post('/teacher/course/add', 'Teacher\restTeacher@addCourse');
Route::post('teacher/courses/file/add/{course_id}', 'Teacher\restTeacher@addFile');
Route::delete('teacher/courses/file/delete/{file_id}', 'Teacher\restTeacher@removeFile');
Route::delete('teacher/course/delete/{course_id}', 'Teacher\restTeacher@removeCourse');

/**QUESTIONS PAGE**/
Route::get('/teacher/courses/{integ_course_id}/sub/{course_id}/questions', 'Teacher\frontTeacher@questionsPage')->middleware('check.session', 'check.teacher');
Route::post('/teacher/courses/sub/{course_id}/questions/add', 'Questions\restQuestions@addQuestion');
Route::get('/teacher/courses/sub/{course_id}/questions/load', 'Questions\restQuestions@loadQuestion');
 
/**QUIZZESS PAGE**/
Route::get('/teacher/quizzes', 'Teacher \frontTeacher@quizPage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/quizzes/generate', 'Teacher\frontTeacher@generateQuizPage')->middleware('check.session', 'check.teacher');
Route::post('/teacher/quizzes/generate', 'Questions\restQuestions@generateQuestions')->middleware('check.session', 'check.teacher');
Route::post('/teacher/quizzes/save', 'Quizzes\controllerQuizzes@insertQuiz');
Route::get('/teacher/quizzes/list', 'Teacher\frontTeacher@listQuizPage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/quizzes/list/{quiz_id}', 'Teacher\frontTeacher@viewQuizPage')->middleware('check.session', 'check.teacher');

/**SECTION PAGE**/
Route::get('/teacher/sections', 'Teacher\frontTeacher@sectionPage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/sections/{section_id}', 'Teacher\frontTeacher@sectionDetailPage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/section/create', 'Teacher\frontTeacher@createSectionPage')->middleware('check.session', 'check.teacher');
Route::post('/teacher/section/save', 'Sections\restSections@saveSection');
Route::delete('/teacher/section/delete/{section_id}', 'Sections\restSections@removeSection');

/**EXAM PAGE**/
Route::get('/teacher/exams', 'Teacher\frontTeacher@examPage')->middleware('check.session', 'check.teacher');
Route::get('/teacher/exams/generate', 'Teacher\frontTeacher@generateExamPage')->middleware('check.session', 'check.teacher');
Route::post('/teacher/exams/generate', 'Questions\restQuestions@generateExam');
Route::post('/teacher/exams/save', 'Exams\controllerExams@insertExam');
Route::get('/teacher/exams/detail/{exam_id}', 'Teacher\frontTeacher@viewExamPage')->middleware('check.session', 'check.teacher');
Route::delete('/teacher/exams/delete/{exam_id}', 'Exams\controllerExams@deleteExam');


/**STUDENT LIST PAGE**/
Route::get('/teacher/students', 'Teacher\frontTeacher@studentListPage')->middleware('check.session', 'check.teacher');

Route::get('/student', 'Student\frontStudent@index')->middleware('check.session', 'check.student');
Route::get('/student/course/{course_id}', 'Student\frontStudent@courseHomePage')->middleware('check.session', 'check.student');
Route::get('/student/course/{course_id}/quizzes', 'Student\frontStudent@quizPage')->middleware('check.session', 'check.student');
Route::get('/student/course/{course_id}/quiz/{quiz_id}', 'Student\frontStudent@visitQuiz')->middleware('check.session', 'check.student');
Route::get('/student/class/{id}/courses', 'Student\frontStudent@coursesPage')->middleware('check.session', 'check.student');
Route::get('/student/class/{class_id}/course/{course_id}', 'Student\frontStudent@courseDetailPage')->middleware('check.session', 'check.student');
Route::get('/student/class/{id}/quizzes', 'Student\frontStudent@quizzesPage')->middleware('check.session', 'check.student');
Route::get('/student/class/{id}/exams', 'Student\frontStudent@examsPage')->middleware('check.session', 'check.student');
Route::get('/student/class/{id}/quiz/{quiz_id}', 'Student\frontStudent@visitQuiz')->middleware('check.session', 'check.student');
Route::get('/student/class/{id}/exam/{exam_id}', 'Student\frontStudent@examPage')->middleware('check.session', 'check.student');

Route::post('/quizzes/insert', 'Quizzes\controllerQuizzes@insertQuiz');
Route::post('/quizzes/submit', 'Student\controllerStudent@submitQuiz');

Route::get('/classes', 'Student\frontStudent@classes')->middleware('check.session', 'check.student');

Route::post('/enroll', 'Sections\restSections@enrollClass');
Route::post('/remove/student', 'Sections\restSections@removeStudent');
Route::post('/update/status', 'Sections\restSections@updateStatus');

Route::get('/session', 'App\controllerUsers@getSession');
Route::get('/logout', 'App\controllerUsers@logoutUser');

Route::post('/login', 'App\controllerUsers@loginUser');
Route::post('/register', 'App\controllerUsers@registerUser');

/**ADMIN**/
Route::prefix('/admin')->group(function () {
    Route::middleware(['check.admin'])->group(function (){
        Route::get('/instructors', 'Admin\frontAdmin@instructorsPage');
        Route::get('/instructor/assign', 'Admin\frontAdmin@assignPage');
    });
    Route::get('/', 'Admin\frontAdmin@loginPage'); 
});

Route::get('/instructors', 'App\controllerUsers@getUsers');
Route::post('/assign', 'App\controllerUsers@assignTeacherIntegration');
Route::get('/assigned/instructors', 'IntegratedCourses\controllerIntegratedCourses@getAssignedInstructors');