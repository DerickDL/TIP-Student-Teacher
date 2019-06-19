@extends('pages.teacher.teacher_base')
    <link rel="stylesheet" type="text/css" href="/css/questions.css">
@push('styles')

@endpush

@section('teacher_content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/teacher/courses/{{$aIntegCourse['id']}}">{{$aIntegCourse['integrated_course_name']}}</a></li>
            <li class="breadcrumb-item"><a href="/teacher/courses/{{$aIntegCourse['id']}}/sub/{{$aCourse[0]['id']}}">{{$aCourse[0]['course_title']}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Questions</li>
        </ol>
    </nav>
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="easy-questions-tab" data-value="0">Easy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="average-questions-tab" data-value="1">Average</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="difficult-questions-tab" data-value="2">Difficult</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add Question</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="add-question-multiple" data-value="0">Multiple Choice</a>
                    <a class="dropdown-item" id="add-question-true-false" data-value="1">True or False</a>
                    <a class="dropdown-item" id="add-question-short" data-value="3">Short Answer</a>
                </div>
            </li>
        </ul>
        <div class="mt-3">
            <div id="question-area">

            </div>
            <h5>Questions:</h5>
            <ul class="list-group list-group-flush" id="list-questions">
                
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    var iIntegratedCourse = {!! json_encode($aIntegCourse['id']) !!};
    var iSubCourse = {!! json_encode($aCourse[0]['id']) !!};
    $(document).ready(function () {
        $('#integ-course-' + iIntegratedCourse).addClass('active');
        $('#dropdown-sidebar-integ').attr('aria-expanded', 'true');
        $('#coursesSub').show();
    });
</script>
<script type="text/javascript" src="/js/add_question.js"></script>
@endpush