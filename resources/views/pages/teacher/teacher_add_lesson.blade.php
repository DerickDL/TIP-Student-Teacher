@extends('pages.teacher.teacher_base')
    <link rel="stylesheet" type="text/css" href="/css/subjects.css">
@push('styles')

@endpush

@section('teacher_content')
    <h2 class="mb-3">Add Lesson</h2>
    <div class="container">
        <div class="form-group">
            <label for="lessonCode">Lesson Title</label>
            <input type="text" class="form-control" id="lessonTitle" placeholder="e.g. Data Types">
        </div>
        <div class="form-group">
            <label for="lessonOverview">Lesson Overview</label>
            <textarea class="form-control" id="lessonOverview" rows="3" placeholder="Brief overview of this lesson..."></textarea>
        </div>
        <div class="float-right">
            <button type="button" class="btn btn-info" id="add-lesson" data-value="{{$aSubject[0]['id']}}">Submit</button>
            <button type="button" class="btn btn-danger" id="cancel-lesson" data-value="{{$aSubject[0]['id']}}">Cancel</button>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#subject-tab').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/add_lesson.js"></script>
@endpush