@extends('pages.teacher.teacher_base')
    <link rel="stylesheet" type="text/css" href="/css/questions.css">
@push('styles')

@endpush

@section('teacher_content')
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="easy-questions-tab">Easy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="average-questions-tab">Average</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="difficult-questions-tab">Difficult</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add Question</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="add-question-multiple" data-value="0">Multiple Choice</a>
                    <a class="dropdown-item" id="add-question-true-false" data-value="1">True or False</a>
                    <a class="dropdown-item" id="add-question-short" data-value="3">Short Answer</a>
                </div>
            </li>
        </ul>
        <div class="mt-3">
            <div id="question-area">

            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">1.) What is the safest type of loop?</li>
                <li class="list-group-item">1.) What is the safest type of loop?</li>
                <li class="list-group-item">1.) What is the safest type of loop?</li>
                <li class="list-group-item">1.) What is the safest type of loop?</li>
                <li class="list-group-item">1.) What is the safest type of loop?</li>
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#subject-tab').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/add_question.js"></script>
@endpush