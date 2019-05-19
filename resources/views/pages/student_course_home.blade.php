@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
@endpush

@section('content')
    <div class="wrapper">
        <!-- Sidebar  -->
        @include('includes.student_sidebar')
        

        <!-- Page Content  -->
        <div id="content">

            @include('includes.navbar')

            @yield('course_home_content')
        </div>
    </div>
@endsection

@push('scripts')

@endpush

