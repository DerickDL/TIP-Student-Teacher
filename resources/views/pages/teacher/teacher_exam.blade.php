@extends('pages.teacher.teacher_base')

@push('styles')

@endpush

@section('teacher_content')
    <div class="container">
        <div class="col-4 float-left justify-left pl-0 pr-0">
            <div class="input-group mb-3">
                <select class="custom-select" id="exam-type">
                    <option value="1" default>Preliminary</option>
                    <option value="2">Mid Term</option>
                    <option value="3">Final Term</option>
                </select>
                <div class="input-group-append">
                    <label class="input-group-text" for="inputGroupSelect02">Exam</label>
                </div>
            </div>
        </div>
        <div class="text-right mb-2">
                <a href="/teacher/exams/generate" class="btn btn-dark" id="generate-exam">Generate Exam</a>
        </div>
        <table class="table" id="exam-list">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-center">Integration Course</th>
                    <th scope="col" class="text-center">Items</th>
                    <th scope="col" class="text-center">Time Limit (minutes)</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            @if(array_key_exists('1', $aExams))
            <tbody>
                @foreach($aExams[1] as $aExamData)
                    <tr>
                        <td class="text-center"><a href="/teacher/exams/detail/{{ $aExamData['id'] }}">{{ $aExamData['parent_course']['integrated_course_name'] }}</a></td>
                        <td class="text-center">{{ $aExamData['items'] }}</td>
                        <td class="text-center">{{ $aExamData['time_limit'] }}</td>
                        <td class="text-center"><button class='btn btn-secondary btn-sm delete-exam'>Delete</button></td>
                    </tr>
                @endforeach
            </tbody>
            @endif
        </table>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    var aExams = {!! json_encode($aExams) !!}
    $(document).ready(function () {
        $('#exam-tab').addClass('active');
	});
</script>
<script type="text/javascript" src="/js/exam.js"></script>
@endpush