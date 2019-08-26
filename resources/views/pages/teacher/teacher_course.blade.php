@extends('pages.teacher.teacher_base')

@push('styles')

@endpush

@section('teacher_content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/teacher/section/{{$aSection[0]['id']}}/courses/{{$aIntegCourse['id']}}">{{$aIntegCourse['integrated_course_name']}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$aCourse[0]['course_title']}}</li>
        </ol>
    </nav>
    <h2 class="mb-1">{{$aCourse[0]['course_title']}}</h2>
    <p>{{$aCourse[0]['course_overview']}}</p>
    <div class="container">
        <h4 class="mb-3">Resources</h4>
        <form id="file-form" enctype="multipart/form-data">
            <div class="form-group">
                <div class="row">
                    <div class="col-8">
                        <input type="file" class="form-control-file" id="input-file" name="attached-file">
                    </div>
                    <div class="col-4">
                        <div class="text-right">
                            <button class="btn btn-sm btn-success" type="submit" id="upload-file">
                                <span id="upload-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <ul class="list-group list-group-flush" id="list-files">
            @foreach($aFiles as $aFileData)
                <li class="list-group-item list-file">
                    <a href="/api/file/download/attachments/{{$aFileData['id']}}" target="_blank" class="btn-link">{{$aFileData['filename']}}</a>
                    <span class="float-right delete-file" data-value="{{$aFileData['id']}}"><i class="fa fa-trash"></i></span>
                </li>
            @endforeach
        </ul>
        <div class="text-right mt-3">
            <a href="/teacher/section/{{$aSection[0]['id']}}/courses/{{$aIntegCourse['id']}}/sub/{{$aCourse[0]['id']}}/questions" class="badge badge-info">Manage Questions</a>
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
<script type="text/javascript" src="/js/course.js"></script>
@endpush