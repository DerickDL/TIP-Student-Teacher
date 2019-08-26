@extends('pages.teacher.teacher_section_base')

@section('teacher_section_content')   
    <div class="container mt-2">
        <div class="row">
            <div class="col-sm mb-3 card-courses">
                <div class="card parent-center">
                    <div class="card-body child-center">
                        <a href="/teacher/section-create">Create Section</a>
                    </div>
                </div>
            </div>
            @if (count($aSections) > 0)
                @for($i = 0; $i < count($aSections); $i++)
                    <div class="col-sm mb-3 card-courses">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{$aSections[$i]['name']}}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Number of Students: {{$aSections[$i]['num_stud']}}</p>
                                <p class="card-text">Class Room: {{$aSections[$i]['class_room']}}</p>
                                <p class="card-text">Activity Room: {{$aSections[$i]['act_room']}}</p>
                            </div>
                            <div class="card-footer text-center">
                                <h6 class="card-subtitle mb-2 text-muted">{{$aSections[$i]['start_date']}} - {{$aSections[$i]['end_date']}}</h6>
                                <a href="/{{($aSession->getData()->user_type) === 0 ? 'student' : 'teacher'}}/section/{{$aSections[$i]['id']}}" class="card-link">Launch Section</a>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>    
@endsection

@push('scripts')
    
@endpush
