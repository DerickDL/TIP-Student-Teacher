@extends('index')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bulma-customization.css">
@endpush

@section('content')
    <div class="wrapper">
        <login-component></login-component>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src=""></script>
@endpush
