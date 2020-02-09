@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
@endpush

@section('content')
    <div id="app" class="h-100">
        <div class="wrapper jumbotron center-container bg text-center">
            <div class="row text-center mx-auto">
                <div class="col-sm-9 col-md-7 col-lg-8 mx-auto">
                    <figure class="logo-big">
                        <img src="/img/TIP-logo-big.jpg">
                    </figure>
                    <div class="card card-select my-4">
                        <div class="card-body">
                            <div class="login-select mt-2">
                                <a href="/admin" class="btn btn-primary btn-lg text-white text-uppercase my-2"><i class="fas fa-user-shield mr-4"></i>Login as Admin</a>                      
                                <a href="/teacher" class="btn btn-primary btn-lg text-white text-uppercase my-2"><i class="fas fa-user-cog mr-4"></i>Login as Teacher</a>
                                <a href="/student" class="btn btn-primary btn-lg text-white text-uppercase my-2"><i class="fas fa-user mr-4"></i>Login as Student</a>
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
