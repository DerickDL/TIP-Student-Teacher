@extends('pages.teacher.teacher_base')

@push('styles')

@endpush

@section('teacher_content')
    <div class="container">
        <form>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>Section Name</label>
                        <input type="text" class="form-control" id="section-name" value="{{ $aSection[0]['name'] }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Select Start Date</label>
                        <input type="text" class="form-control" id="start_date" value="{{ $aSection[0]['start_date'] }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Select End Date</label>
                        <input type="text" class="form-control" id="end_date" value="{{ $aSection[0]['end_date'] }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Number of Students</label>
                        <input type="text" class="form-control" id="no-stud" value="{{ $aSection[0]['num_stud'] }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Class Room(Optional)</label>
                        <input type="text" class="form-control" id="class-room" value="{{ $aSection[0]['class_room'] }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Activity Room(Optional)</label>
                        <input type="text" class="form-control" id="act-room" value="{{ $aSection[0]['act_room'] }}">
                    </div>
                </div>
            </div>
        </form>
        <div class="text-right mb-2">
            <a class="btn btn-outline-secondary" style="min-width:100px" id="delete-section">Delete</a>
            <a class="btn btn-secondary text-white" style="min-width:100px" id="cancel-section">Cancel</a>
            <a class="btn btn-dark text-white" style="min-width:100px" id="update-section">Update</a>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    var iSectionId = {!! json_encode($aSection[0]['id']) !!}
    $(document).ready(function () {
        $('#section-tab').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/section_detail.js"></script>
@endpush