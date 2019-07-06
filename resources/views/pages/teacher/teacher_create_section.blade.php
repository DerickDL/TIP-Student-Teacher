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
                        <label>Section Name</label>
                        <input type="text" class="form-control" id="section-name">
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
                        <label>Select Start Date</label>
                        <input type="text" class="form-control" id="start_date">
                    </div>
                </div>
                <div class="col-4">
                        <div class="form-group">
                            <label>Select End Date</label>
                            <input type="text" class="form-control" id="end_date">
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
                <button class="btn btn-primary mr-2" id="create-section" type="button">Create</button>
                <button class="btn btn-outline-secondary" id="cancel-section" type="button">Cancel</button>
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
<script type="text/javascript" src="/js/add_section.js"></script>
@endpush