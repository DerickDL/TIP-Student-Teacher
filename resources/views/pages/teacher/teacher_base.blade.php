@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="/css/courses.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" integrity="sha256-IvM9nJf/b5l2RoebiFno92E5ONttVyaEEsdemDC6iQA=" crossorigin="anonymous" />
@endpush

@section('content')
    <div class="wrapper">
        <!-- Sidebar  -->
    @include('includes.teacher_sidebar')

    <!-- Page Content  -->
        <div id="content">

            @include('includes.navbar')

            @yield('teacher_content')
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush

