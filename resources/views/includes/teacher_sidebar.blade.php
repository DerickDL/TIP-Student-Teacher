<nav id="sidebar">
    <div class="sidebar-header">
        <h3>{{$aData['courses'][0]['course_title']}}</h3>
    </div>
    <ul class="list-unstyled components">
        <p>{{$aData['courses'][0]['course_code']}}</p>
        <li class="active">
            <a class="/teacher/course/{{$aData['courses'][0]['id']}}">Home</a>
        </li>
        <li>
            <a href="#">Quizzes</a>
        </li>
        <li>
            <a href="#">Students</a>
        </li>
    </ul>
</nav>