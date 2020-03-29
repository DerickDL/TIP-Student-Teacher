@extends('pages.teacher.teacher_base')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
@endpush

@section('teacher_content')
    <div class="container">
        <canvas id="quizzes_graph" width="400" height="200"></canvas>
    </div> 
@endsection
v  
@push('scripts')
<script type="text/javascript">
    var iTeacherId = {!! json_encode($aSession->getData()->id) !!}
    $(document).ready(function () {
        $('#home-tab').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/quizzes_graph.js"></script>
@endpush