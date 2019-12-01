@extends('pages.student.student_base')

@push('styles')

@endpush

@section('student_content')
    <div class="container">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-center">Course</th>
                    <th scope="col" class="text-center">Items</th>
                    <th scope="col" class="text-center">Time Limit (minutes)</th>
                    <th scope="col" class="text-center">Score</th>
                    <th scope="col" class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aQuizzes as $aQuizData)
                    <tr>
                        <td class="text-center"><a class="btn-link {{ $aQuizData['status'] == 0 ? 'd-none' : '' }}" href="/student/class/{{ $aClass[0]['id'] }}/quiz/{{ $aQuizData['id'] }}">{{ $aQuizData['sub_course']['course_title'] }}</a>{{ $aQuizData['status'] == 1 ? '' : $aQuizData['sub_course']['course_title'] }}</td>
                        <td class="text-center">{{ $aQuizData['quiz_items'] }}</td>
                        <td class="text-center">{{ $aQuizData['quiz_timelimit'] }}</td>
                        <td class="text-center">{{ $aQuizData['score'] !== null ? $aQuizData['score'] . '/' . $aQuizData['quiz_items'] : '-' }}</td>
                        <td class="text-center">{{ $aQuizData['status'] === 0 ? 'Close' : 'Open' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#quizzes-tab').addClass('active');
	});
</script>
<script type="text/javascript" src="/js/add_quiz.js"></script>
@endpush