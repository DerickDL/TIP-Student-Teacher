@extends('pages.teacher.teacher_base')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
@endpush

@section('teacher_content')

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#home-tab').addClass('active');
    });
</script>
@endpush