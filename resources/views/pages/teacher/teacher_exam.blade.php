@extends('pages.teacher.teacher_base')

@push('styles')

@endpush

@section('teacher_content')
    <div class="container">
        <div class="text-right mb-2">
                <a href="/teacher/exams/generate" class="btn btn-dark">Generate Exam</a>
        </div>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-center">Integration Course</th>
                    <th scope="col" class="text-center">Items</th>
                    <th scope="col" class="text-center">Time Limit (minutes)</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aExams as $aExamData)
                    <tr>
                        <td class="text-center">{{ $aExamData['parent_course']['integrated_course_name'] }}</td>
                        <td class="text-center">{{ $aExamData['items'] }}</td>
                        <td class="text-center">{{ $aExamData['time_limit'] }}</td>
                        <td class="text-center"><a href="/teacher/exams/detail/{{ $aExamData['id'] }}">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#exam-tab').addClass('active');
	});
</script>
<script type="text/javascript" src="/js/add_quiz.js"></script>
@endpush