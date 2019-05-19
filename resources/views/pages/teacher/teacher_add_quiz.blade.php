@extends('pages.teacher.teacher_course_home')

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
            <button class="btn btn-info" type="button" id="btn-save-quiz" data-value="{{$aData['courses'][0]['id']}}">Save</button>
            <button class="btn btn-danger" type="button" id="btn-cancel-quiz" data-value="{{$aData['courses'][0]['id']}}">Cancel</button>
        </div>
    </div>
    <div id="add-quiz" class="mb-3 mt-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Quiz Title" aria-label="Text input with dropdown button" id="question">
            <div class="input-group-append">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add Question</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="add-question-multiple" data-value=0>Multiple Choice</a>
                    <a class="dropdown-item" id="add-question-true-false" data-value=1>True or False</a>
                    <a class="dropdown-item" id="add-question-essay" data-value=2>Essay</a>
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
    <script type="text/javascript" src="/js/add_quiz.js"></script>
@endpush