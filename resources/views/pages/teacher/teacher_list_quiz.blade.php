@extends('pages.teacher.teacher_base')

@push('styles')

@endpush

@section('teacher_content')
    <div class="container">
        <div class="text-right mb-2">
            <a href="/teacher/quizzes/generate" class="btn btn-dark">Generate Quiz</a>
        </div>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-center">Integration Course</th>
                    <th scope="col" class="text-center">Course</th>
                    <th scope="col" class="text-center">Items</th>
                    <th scope="col" class="text-center">Time Limit (minutes)</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aQuizzes as $aQuizData)
                    <tr>
                        <td class="text-center">{{ $aQuizData['parent_course']['integrated_course_name'] }}</td>
                        <td class="text-center">{{ $aQuizData['sub_course']['course_title'] }}</td>
                        <td class="text-center">{{ $aQuizData['quiz_items'] }}</td>
                        <td class="text-center">{{ $aQuizData['quiz_timelimit'] }}</td>
                        <td class="text-center"><a href="/teacher/quizzes/list/{{ $aQuizData['id'] }}">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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