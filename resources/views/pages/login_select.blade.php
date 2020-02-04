@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
@endpush

@section('content')
    <div id="app" class="h-100">
        <div class="wrapper center-container">
            <div class="container text-center absolute-center">
                <figure class="logo">
                    <img src="/img/TIP-logo.png">
                </figure>
                <div class="row">
                    <div class="col-sm-4 text-white text-center mt-5">
                        <div class="card mx-auto" style="width:80%">
                            <div class="card-body">
                                <a href="/admin" class="stretched-link">Admin</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-white text-center mt-5">
                        <div class="card mx-auto" style="width:80%;">
                            <div class="card-body">
                                <a href="/teacher" class="stretched-link">Teacher</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-white text-center mt-5">
                        <div class="card mx-auto" style="width:80%;">
                            <div class="card-body">
                                <a href="/student" class="stretched-link">Student</a>
                            </div>
                        </div>
                    </div>
                </div>
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
