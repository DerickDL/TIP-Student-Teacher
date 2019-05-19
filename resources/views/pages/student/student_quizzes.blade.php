@extends('pages.student.student_course_home')

@push('styles')

@endpush

@section('course_home_content') 
    <div id="container-quizzes">
        <h2>Quizzes</h2>
         @if(count($aQuiz) < 1)
            <p>No quizzes yet.</p>
        @else
            <div class="list-group">
                @foreach($aQuiz as $aQuizData)
                    <a href="/student/course/{{ $aData['courses'][0]['id'] }}/quiz/{{ $aQuizData['id'] }}" class="list-group-item list-group-item-action">{{$aQuizData['quiz_title']}}</a>
                @endforeach
            </div>
        @endif
    </div>
    <div class="line"></div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
           $('#quiz-tab').addClass('active');
        });
    </script>
@endpush