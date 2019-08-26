@if (count($aSection) > 0)
<nav id="sidebar">
    <ul class="list-unstyled components">
        <li id="home-tab">
            <a href="/teacher/section/{{$aSection[0]['id']}}">Home</a>
        </li>
        <li id="course-tab">
            <a href="#coursesSub" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle dropdown-toggle-sidebar" id="dropdown-sidebar-integ">Courses</a>
            <ul class="collapse list-unstyled" id="coursesSub">
                <li id="integ-course-1">
                    <a href="/teacher/section/{{$aSection[0]['id']}}/courses/1">Integration Course 1</a>
                </li>
                <li id="integ-course-2">
                    <a href="/teacher/section/{{$aSection[0]['id']}}/courses/2">Integration Course 2</a>
                </li>
                <li id="integ-course-3">
                    <a href="/teacher/section/{{$aSection[0]['id']}}/courses/3">Integration Course 3</a>
                </li>
            </ul>
        </li>
        <li id="quiz-tab">
            <a href="/teacher/quizzes/list">Quizzes</a>
        </li>
        <li id="exam-tab">
            <a href="/teacher/exams">Exams</a>
        </li>
    </ul>
</nav>
@endif