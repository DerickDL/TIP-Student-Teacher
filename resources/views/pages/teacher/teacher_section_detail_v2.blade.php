@extends('pages.teacher.teacher_base')

@push('styles')

@endpush

@section('teacher_content')
    <div class="float-right mb-2">
        <a class="btn btn-dark" href="/teacher/sections">Back</a>
    </div>
    <h2 class="mb-1">{{$aSection[0]['name']}}</h2>
    <p>Enrollment Key: {{$aSection[0]['key']}}</p>
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="true">Summary</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="students-tab" data-toggle="tab" href="#students" role="tab" aria-controls="students" aria-selected="false">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="activities-tab" data-toggle="tab" href="#activities" role="tab" aria-controls="activities" aria-selected="false">Activities</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                <div class="m-3">
                    <div class="row">
                        <div class="col-3">
                            <p class="text-dark"><strong>Start Date: </strong></p>
                            <p class="text-dark"><strong>End Date: </strong></p>
                            <p class="text-dark"><strong>Number of Students: </strong></p>
                            <p class="text-dark"><strong>Class Room: </strong></p>
                            <p class="text-dark"><strong>Activity Room: </strong></p>
                        </div>
                        <div class="col-8">
                            <p>{{$aSection[0]['start_date']}}</p>
                            <p>{{$aSection[0]['end_date']}}</p>
                            <p>{{$aSection[0]['num_stud']}}</p>
                            <p>{{$aSection[0]['class_room']}}</p>
                            <p>{{$aSection[0]['act_room']}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="students" role="tabpanel" aria-labelledby="students-tab">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="text-center">No.</th>
                        <th scope="col" class="text-center">Student Id</th>
                        <th scope="col" class="text-center">Username</th>
                        <th scope="col" class="text-center">First Name</th>
                        <th scope="col" class="text-center">Last Name</th>
                        <th scope="col" class="text-center">Status</th>
                    </tr>
                    @for ($i = 0; $i < count($aStudents); $i++)
                        <tr>
                            <td scope="col" class="text-center">{{ $i + 1 }}</td>
                            <td scope="col" class="text-center">{{ $aStudents[$i]['student_id'] }}</td>
                            <td scope="col" class="text-center">{{ $aStudents[$i]['username'] }}</td>
                            <td scope="col" class="text-center">{{ $aStudents[$i]['first_name'] }}</td>
                            <td scope="col" class="text-center">{{ $aStudents[$i]['last_name'] }}</td>
                            <td scope="col" class="text-center" data-value="{{ $aStudents[$i]['id'] }}">
                                @if($aStudents[$i]['pivot']['status'] === 0)
                                    <button class="btn btn-primary btn-accept">Accept</button>
                                    <button class="btn btn-danger btn-decline">Decline</button>
                                @else
                                    <button class="btn btn-danger btn-delete">Delete</button>
                                @endif
                            </td>
                        </tr>
                    @endfor
                </thead>
            </table>
            </div>
            <div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-tab">
                @ Dashboard here
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    var iSectionId = {!! json_encode($aSection[0]['id']) !!}
    $(document).ready(function () {
        $('#section-tab').addClass('active');
    });
    $('#start_date').datepicker();
    $('#end_date').datepicker();
</script>
<script type="text/javascript" src="/js/section_detail.js"></script>
@endpush