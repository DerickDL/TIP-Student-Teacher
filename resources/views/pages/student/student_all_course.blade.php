@extends('pages.student.student_base')

@push('styles')
<link rel="stylesheet" type="text/css" href="/css/courses.css">
@endpush

@section('student_content')
    <div class="container">
        @if(count($aCourses) > 0)
            <div class="row">
                @foreach($aCourses as $aCourseData)
                    <div class="col-sm mb-3 card-courses">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{$aCourseData['course_code']}}<span class="float-right delete-course" data-value="">&#10005;</span></h5>
                            </div>
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2 strong">{{$aCourseData['course_title']}}</h5>
                                <p class="card-text text-muted">{{$aCourseData['course_overview']}}</p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="/student/class/{{ $aClass[0]['id'] }}/course/{{ $aCourseData['id'] }}" class="card-link stretched-link">Visit Course</a>
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
        $('#courses-tab').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/courses_list.js"></script>
@endpush