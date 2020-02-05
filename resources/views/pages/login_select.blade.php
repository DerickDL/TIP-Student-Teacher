@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
@endpush

@section('content')
    <div id="app" class="h-100">
        <div class="wrapper center-container bg">
            <div class="container text-center absolute-center">
                <figure class="logo">
                    <img src="/img/TIP-logo.png">
                </figure>
                <div class="row">
                    <div class="col-lg-4 text-center mt-5">
                        <div class="card mx-auto" style="width:18rem;">
                            <div class="card-body text-center">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <i class="fas fa-user-shield fa-5x"></i>
                                    </div>
                                </div>
                                <a href="/admin" class="stretched-link text-dark"><p class="h1">Admin</p></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mt-5">
                        <div class="card mx-auto" style="width:18rem;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <i class="fas fa-user-cog fa-5x"></i>
                                    </div>
                                </div>
                                <a href="/teacher" class="stretched-link text-dark"><p class="h1">Teacher</p></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mt-5">
                        <div class="card mx-auto" style="width:18rem;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <i class="fas fa-user fa-5x"></i>
                                    </div>
                                </div>
                                <a href="/student" class="stretched-link text-dark"><p class="h1">Student</p></a>
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
