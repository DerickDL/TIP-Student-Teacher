@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
@endpush

@section('content')
    <div class="wrapper">
        <!-- Sidebar  -->
        @include('includes.teacher_sidebar')

        <!-- Page Content  -->
        <div id="content">

            @include('includes.navbar')

            <div id="container-quizzes">
                <h2>Recently added Quizzes</h2>
                <p>No quizzes yet.</p>
            </div>

            <div class="line"></div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush

