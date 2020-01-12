@extends('pages.teacher.teacher_base')

@push('styles')
    <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
@endpush

@section('teacher_content')
    <div class="container">
    <canvas id="quizzes" width="400" height="100"></canvas>
    <br/>
    <canvas id="prelims" width="400" height="100"></canvas>
    <br/>
    <canvas id="midterms" width="400" height="100"></canvas>
    <br/>
    <canvas id="finals" width="400" height="100"></canvas>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#home-tab').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/graph.js"></script>
@endpush