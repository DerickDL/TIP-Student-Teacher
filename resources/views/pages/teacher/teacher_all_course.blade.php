@extends('pages.teacher.teacher_base')
    <link rel="stylesheet" type="text/css" href="/css/courses.css">
@push('styles')

@endpush

@section('teacher_content')
    <div class="container">
        <h2>{{$aIntegCourse['integrated_course_name']}}</h2>
        <div class="text-right mb-3">
            <a class="btn btn-secondary" href="/teacher/course/add">Add Course</a>
        </div>
        @if(count($aCourses) > 0)
            <div class="row">
                @foreach($aCourses as $aCourseData)
                    <div class="col-sm mb-3 card-courses">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{$aCourseData['course_code']}}</h5>
                            </div>
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2 strong">{{$aCourseData['course_title']}}</h5>
                                <p class="card-text text-muted">{{$aCourseData['course_overview']}}</p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="/teacher/courses/{{$aCourseData['id']}}" class="card-link stretched-link">Visit Course</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div id="outer" class="container d-flex align-items-center justify-content-center">
                <div id="inner">
                    <p>No available courses yet.</p>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $(`#integ-course-${ {{$aIntegCourse['id']}} }`).addClass('active');
        $('#dropdown-sidebar-integ').attr('aria-expanded', 'true');
    });
</script>
@endpush