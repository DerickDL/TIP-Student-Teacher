@extends('pages.teacher.teacher_base')
    <link rel="stylesheet" type="text/css" href="/css/courses.css">
@push('styles')

@endpush

@section('teacher_content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/teacher/courses">Courses</a></li>
            <li class="breadcrumb-item"><a href="/teacher/courses/{{$aCourse['id']}}">{{$aCourse['course_title']}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$aLesson[0]['lesson_title']}}</li>
        </ol>
    </nav>
    <h2 class="mb-1">{{$aLesson[0]['lesson_title']}}</h2>
    <p>{{$aLesson[0]['lesson_overview']}}</p>
    <div class="line"></div>
    <div class="text-right">
        <span><a class="btn-link" href="/teacher/courses/lesson/{{$aLesson[0]['id']}}/questions">Manage Questions</a></span>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#course-tab').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/add_course.js"></script>
@endpush