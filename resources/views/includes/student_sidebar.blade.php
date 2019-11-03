<nav id="sidebar">
    <div class="sidebar-header">
        <h3>{{$aClass[0]['name']}}</h3>
    </div>
    <ul class="list-unstyled components">
        <li id="courses-tab">
            <a href="/student/class/{{$aClass[0]['id']}}/courses">Courses</a>
        </li>
        <li id="quizzes-tab">
            <a href="/student/class/{{$aClass[0]['id']}}/quizzes">Quizzes</a>
        </li>
        <li id="exams-tab">
            <a href="/student/class/{{$aClass[0]['id']}}/exams">Exams</a>
        </li>
    </ul>
    <ul class="list-unstyled line">
        <li id="exams-tab">
            <a href="/classes">Go to Classes</a>
        </li>
    </ul>
</nav>