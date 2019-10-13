@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/sections.css">
@endpush

@section('content')
<div id="content">
    
    <!-- Nav Bar -->
    @include('includes.navbar-narrow')
     
    <div class="container mt-2">
        <button class="btn btn-dark float-right" data-toggle="modal" data-target="#modal-enroll">Enroll Class</button>
        <div class="row">
            <div class="col-sm mb-3 card-courses">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Section Name</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">10</p>
                        <p class="card-text">Podium</p>
                        <p class="card-text">East Bldg. Rm 2</p>
                    </div>
                    <div class="card-footer text-center">
                        <h6 class="card-subtitle mb-2 text-muted">09/10/2019 - 03/10/2020</h6>
                        <a href="#" class="card-link">Visit Class</a>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>

<div class="modal fade" id="modal-enroll" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong>Class Code</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" class="form-control" id="code">
                                </div>
                                <div class="col-3">
                                <button type="button" class="btn btn-dark" id="enroll">Enroll</button>
                                </div>
                            </div>
                        </div>
                    </form>
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

