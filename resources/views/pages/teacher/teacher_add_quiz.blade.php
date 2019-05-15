@extends('pages.course_home')

@push('styles')
    <style>
        .dropdown-item {
            cursor: pointer;
        }
    </style>
@endpush

@section('course_home_content')
    <div>
        <div class="text-right">
            <button class="btn btn-info" type="button">Save</button>
            <button class="btn btn-danger" type="button">Cancel</button>
        </div>
    </div>
    <div id="add-quiz" class="mb-3 mt-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Quiz Title" aria-label="Text input with dropdown button">
            <div class="input-group-append">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add Question</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="add-question-multiple">Multiple Choice</a>
                    <a class="dropdown-item" id="add-question-true-false">True or False</a>
                    <a class="dropdown-item" id="add-question-essay">Essay</a>
                </div>
           </div>
        </div>
    </div>
    <div id="quiz-questions">

    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
           $('#quiz-tab').addClass('active');
        });
    </script>
@endpush