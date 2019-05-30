@extends('pages.teacher.teacher_base')
    <link rel="stylesheet" type="text/css" href="/css/subjects.css">
@push('styles')

@endpush

@section('teacher_content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/teacher/subjects">Subjects</a></li>
            <li class="breadcrumb-item"><a href="/teacher/subjects/{{$aSubject['id']}}">{{$aSubject['course_title']}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$aLesson[0]['lesson_title']}}</li>
        </ol>
    </nav>
    <h2 class="mb-1">{{$aLesson[0]['lesson_title']}}</h2>
    <p>{{$aLesson[0]['lesson_overview']}}</p>
    <div class="line"></div>
    <div class="float-right">
        <a class="btn btn-secondary"  href="/teacher/subjects/{{$aSubject[0]['id']}}/lesson/add">Add Question</a>
    </div>
    <div class="container">
        <h4 class="mb-3">Questions</h4>
        <div id="outer" class="container d-flex align-items-center justify-content-center">
            <div id="inner">
                <p>No available questions yet.</p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#subject-tab').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/add_subject.js"></script>
@endpush