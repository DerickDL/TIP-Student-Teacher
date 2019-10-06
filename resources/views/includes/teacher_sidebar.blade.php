
<nav id="sidebar">
    <ul class="list-unstyled components">
        <li id="home-tab">
            <a href="/teacher">Home</a>
        </li>
        <li id="course-tab">
            <a href="#coursesSub" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle dropdown-toggle-sidebar" id="dropdown-sidebar-integ">Courses</a>
            <ul class="collapse list-unstyled" id="coursesSub">
                @foreach($aIntegrations as $aIntegration)
                <li id="integ-course-{{$aIntegration}}">
                    <a href="/teacher/courses/{{$aIntegration}}">Integration Course {{$aIntegration}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li id="quiz-tab">
            <a href="/teacher/quizzes/list">Quizzes</a>
        </li>
        <li id="exam-tab">
            <a href="/teacher/exams">Exams</a>
        </li>
        <li id="section-tab">
            <a href="/teacher/sections">Sections</a>
        </li>
    </ul>
</nav>
