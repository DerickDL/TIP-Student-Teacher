@extends('pages.teacher.teacher_base')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/datepicker.css">
@endpush

@section('teacher_content')
    <div class="container">
        <form>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>Batch Name</label>
                        <input type="text" class="form-control" id="batch-name">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Number of Students</label>
                        <input type="text" class="form-control" id="no-stud">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Select Date</label>
                        <input type="text" class="form-control" id="date">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Class Room(Optional)</label>
                        <input type="text" class="form-control" id="class-room">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Activity Room(Optional)</label>
                        <input type="text" class="form-control" id="act-room">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary mr-2">Create</button>
                <button class="btn btn-outline-secondary">Cancel</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#section-tab').addClass('active');
        $('#date').datepicker();
    });
</script>
<script type="text/javascript" src="/js/course.js"></script>
@endpush