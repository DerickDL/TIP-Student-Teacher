@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/home.css">
@endpush

@section('content')
    @include('includes.navbar-narrow')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm mb-3 card-courses">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">CISCO-0909</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">DSP-901</h6>
                            <p class="card-text">Data Signal Processing</p>
                            <a href="#" class="card-link">Launch Course</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-3 card-courses">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">WEB-1</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">February 2, 2019 - August 6, 2019</h6>
                            <p class="card-text">Static Webpages</p>
                            <a href="#" class="card-link">Launch Course</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-3 card-courses">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">CISCO-1</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">February 2, 2019 - August 6, 2019</h6>
                            <p class="card-text">Cisco Fundamentals</p>
                            <a href="#" class="card-link">Launch Course</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-3 card-courses">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">DBMS-2209</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">February 2, 2019 - August 6, 2019</h6>
                            <p class="card-text">Database Management and Systems</p>
                            <a href="#" class="card-link">Launch Course</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-3 card-courses">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">PROG-2</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">February 2, 2019 - August 6, 2019</h6>
                            <p class="card-text">Advance Java</p>
                            <a href="#" class="card-link">Launch Course</a>
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
