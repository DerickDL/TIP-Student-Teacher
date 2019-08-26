@extends('pages.teacher.teacher_base')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
@endpush

@section('teacher_content')
    <div class="container">
        @if (count($aSection) > 0)
            <h3>{{$aSection[0]['name']}}</h3>
        <div class="row">
            <div class="col-2">
                <p>Start Date:</p>
            </div>
            <div class="col-8">
                <p>{{$aSection[0]['start_date']}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <p>End Date:</p>
            </div>
            <div class="col-8">
                <p>{{$aSection[0]['end_date']}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <p>Class Room:</p>
            </div>
            <div class="col-8">
                <p>{{$aSection[0]['class_room']}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <p>Activity Room:</p>
            </div>
            <div class="col-8">
                <p>{{$aSection[0]['act_room']}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <p>Number of Students:</p>
            </div>
            <div class="col-8">
                <p>{{$aSection[0]['num_stud']}}</p>
            </div>
        </div>
        @endif
        
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#home-tab').addClass('active');
    });
</script>
@endpush