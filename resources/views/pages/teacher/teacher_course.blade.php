@extends('pages.teacher.teacher_course_home')

@push('styles')

@endpush

@section('course_home_content')
    <div id="container-quizzes">
        <h2>Recently added Quizzes</h2>
        @if(count($aQuiz) < 1)
            <p>No quizzes yet.</p>
        @else
            <div class="list-group">
                @foreach($aQuiz as $aQuizData)
                    <a href="#" class="list-group-item list-group-item-action">{{$aQuizData['quiz_title']}}</a>
                @endforeach
            </div>
        @endif
    </div>
    <div class="line"></div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#home-tab').addClass('active');
        });
    </script>
@endpush