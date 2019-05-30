@extends('pages.teacher.teacher_base')
    <link rel="stylesheet" type="text/css" href="/css/subjects.css">
@push('styles')

@endpush

@section('teacher_content')
    <div class="container">
        <div class="text-right mb-3">
            <a class="btn btn-secondary" href="/teacher/subject/add">Add Subject</a>
        </div>
        @if(count($aSubjects) > 0)
            <div class="row">
                @foreach($aSubjects as $aSubjectData)
                    <div class="col-sm mb-3 card-courses">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{$aSubjectData['course_code']}}</h5>
                            </div>
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2 strong">{{$aSubjectData['course_title']}}</h5>
                                <p class="card-text text-muted">{{$aSubjectData['course_overview']}}</p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="/teacher/subjects/{{$aSubjectData['id']}}" class="card-link stretched-link">Visit Subject</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div id="outer" class="container d-flex align-items-center justify-content-center">
                <div id="inner">
                    <p>No available subjects yet.</p>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#subject-tab').addClass('active');
    });
</script>
@endpush