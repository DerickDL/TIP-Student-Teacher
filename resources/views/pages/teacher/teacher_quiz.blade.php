@extends('pages.teacher.teacher_course_home')

@push('styles')

@endpush

@section('course_home_content')
    <div class="float-right">
        <button class="btn btn-secondary" id="add-quiz">Add Quiz</button>
    </div>
    <div id="container-quizzes">
        <h2>Quizzes</h2>
        <div class="list-group">
            @foreach($aQuiz as $aQuizData)
                <a href="#" class="list-group-item list-group-item-action">{{$aQuizData['quiz_title']}}</a>
            @endforeach
        </div>
    </div>
    <div class="line"></div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
           $('#quiz-tab').addClass('active');
           $('#add-quiz').on('click', function () {
               window.location.replace(window.location.href + '/add');
           });
        });
    </script>
@endpush