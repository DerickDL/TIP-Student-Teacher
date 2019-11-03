@extends('pages.student.student_base')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/courses.css">
@endpush

@section('student_content')
    <h2 class="mb-1">{{$aCourse[0]['course_title']}}</h2>
    <p>{{$aCourse[0]['course_overview']}}</p>
    <div class="container">
        <h4 class="mb-3">Resources</h4>
        <ul class="list-group list-group-flush" id="list-files">
            @foreach($aFiles as $aFileData)
                <li class="list-group-item list-file">
                    <a href="/api/file/download/attachments/{{$aFileData['id']}}" target="_blank" class="btn-link">{{$aFileData['filename']}}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    var iSubCourse = {!! json_encode($aCourse[0]['id']) !!};
    $(document).ready(function () {
        $('#courses-tab').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/course.js"></script>
@endpush