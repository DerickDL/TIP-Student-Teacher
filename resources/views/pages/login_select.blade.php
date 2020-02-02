@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
@endpush

@section('content')
    <div id="app">
        <div class="wrapper">
             
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
