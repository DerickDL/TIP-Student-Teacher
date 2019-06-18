@extends('pages.teacher.teacher_base')

@push('styles')

@endpush

@section('teacher_content')
    <h2 class="mb-3">Add Course</h2>
    <div class="container">
        <div class="form-group">
            <label for="courseCode">Course Code</label>
            <input type="text" class="form-control" id="courseCode" aria-describedby="emailHelp" placeholder="e.g. PROG-104">
        </div>
        <div class="form-group">
            <label for="courseTitle">Course Title</label>
            <input type="text" class="form-control" id="courseTitle" placeholder="e.g. Advanced Java">
        </div>
        <div class="form-group">
            <label for="courseOverview">Course Overview</label>
            <textarea class="form-control" id="courseOverview" rows="3" placeholder="Brief overview of this course..."></textarea>
        </div>
        <div class="float-right">
            <button type="button" class="btn btn-info" id="add-course" data-value="{{$aSession->getData()->id}}">Submit</button>
            <button type="button" class="btn btn-danger" id="cancel-course">Cancel</button>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    var iIntegratedCourse = {!! json_encode($aIntegCourse['id']) !!};
    $(document).ready(function () {
        $('#integ-course-' + iIntegratedCourse).addClass('active');
        $('#dropdown-sidebar-integ').attr('aria-expanded', 'true');
        $('#coursesSub').show();
    });
</script>
<script type="text/javascript" src="/js/add_course.js"></script>
@endpush