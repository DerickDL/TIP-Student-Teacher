@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/home.css">
@endpush

@section('content')
    @include('includes.navbar-narrow')
    <div id="content">
        <div class="container">
            <div class="row">
                @foreach($aData['courses'] as $aCourses)
                <div class="col-sm mb-3 card-courses">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{$aCourses['course_code']}}</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">{{$aCourses['course_start']}} - {{$aCourses['course_end']}}</h6>
                            <p class="card-text">{{$aCourses['course_title']}}</p>
                            <a href="/{{($aData['session']->getData()->user_type) === 0 ? 'student' : 'teacher'}}/course/{{$aCourses['id']}}" class="card-link">Launch Course</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#logout-link').on('click', function () {
               if (confirm('Are you sure you want to exit?')) {
                   window.location.replace('/logout');
               }
            });
        })
    </script>
@endpush
