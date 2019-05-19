<nav id="sidebar">
    <div class="sidebar-header">
        <h3>{{$aData['courses'][0]['course_title']}}</h3>
    </div>
    <ul class="list-unstyled components">
        <p>{{$aData['courses'][0]['course_code']}}</p>
        <li id="home-tab">
            <a href="/student/course/{{$aData['courses'][0]['id']}}">Home</a>
        </li>
        <li id="quiz-tab">
            <a href="/student/course/{{$aData['courses'][0]['id']}}/quizzes">Quizzes</a>
        </li>
        <li id="students-tab">
            <a href="#">Grades</a>
        </li>
    </ul>
</nav>