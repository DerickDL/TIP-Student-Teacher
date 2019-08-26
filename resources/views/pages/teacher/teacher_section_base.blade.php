@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/sections.css">
@endpush

@section('content')
<div id="content">
    
    <!-- Nav Bar -->
    @include('includes.navbar-narrow')
    
    @yield('teacher_section_content')
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
