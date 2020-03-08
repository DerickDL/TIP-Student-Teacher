@extends('index')

@push('styles')
    <!-- <link rel="stylesheet" type="text/css" href="/css/app.css"> -->
    <link rel="stylesheet" type="text/css" href="/css/login.css">
@endpush

@section('content')
    <div id="app" class="h-100">
        <div class="wrapper jumbotron  bg-black">
            <div class="row mx-auto">
                <div class="col-4 mx-auto">
                    <div class="card card-select my-4">
                        <div class="card-body">
                            <div class="text-white mt-2">      
                                <form>
                                    <div class="form-group">
                                        <label for="current-password">Password</label>
                                        <input type="password" class="form-control" id="current-password">
                                    </div>
                                    <div class="form-group">
                                        <label for="new-password">New Password</label>
                                        <input type="password" class="form-control" id="new-password">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm-password">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm-password">
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block btn-change-pass">Change Password</button>
                                </form>
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
        var aSession = {!! json_encode($aSession) !!};
    </script>
    <script type="text/javascript" src="/js/change-pass.js"></script>
@endpush
