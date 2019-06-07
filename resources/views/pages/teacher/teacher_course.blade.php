@extends('pages.teacher.teacher_base')
    <link rel="stylesheet" type="text/css" href="/css/courses.css">
@push('styles')

@endpush

@section('teacher_content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/teacher/courses">Courses</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$aCourse[0]['course_title']}}</li>
        </ol>
    </nav>
    <h2 class="mb-1">{{$aCourse[0]['course_title']}}</h2>
    <p>{{$aCourse[0]['course_overview']}}</p>
    <div class="line"></div>
    <div class="float-right">
        <a class="btn btn-secondary"  href="/teacher/courses/{{$aCourse[0]['id']}}/lesson/add">Add Lesson</a>
    </div>
    <div class="container">
        <h4 class="mb-3">Lessons</h4>
        @if(count($aLessons) < 1)
            <div id="outer" class="container d-flex align-items-center justify-content-center">
                <div id="inner">
                    <p>No available lessons yet.</p>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-sm-8">
                    <div class="list-group">
                        @foreach($aLessons as $aLessonData)
                            <li class="list-group-item list-group-item-action">
                                <a class="btn-link" href="/teacher/courses/lesson/{{$aLessonData['id']}}">{{$aLessonData['lesson_title']}}</a><span class="float-right delete-lesson" data-value="{{$aLessonData['id']}}">&#10005;</span>
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#course-tab').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/course.js"></script>
@endpush