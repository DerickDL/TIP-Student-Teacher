@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
@endpush

@section('content')
    @stack('styles')
    <div class="wrapper">
        <!-- Sidebar  -->
    @include('includes.teacher_sidebar')

    <!-- Page Content  -->
        <div id="content">

            @include('includes.navbar')

            @yield('course_home_content')
        </div>
    </div>
    @stack('scripts')
@endsection

@push('scripts')

@endpush

