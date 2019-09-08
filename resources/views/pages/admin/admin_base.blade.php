@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
@endpush

@section('content')
    <div class="wrapper">
        <!-- Sidebar  -->
    @include('includes.admin_sidebar')

    <!-- Page Content  -->
        <div id="content">

            @include('includes.navbar_admin')

            @yield('admin_content')
        </div>
    </div>
@endsection

