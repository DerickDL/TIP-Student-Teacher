@extends('pages.teacher.teacher_base')

@push('styles')

@endpush

@section('teacher_content')
    <div class="container">
        <a class="btn btn-secondary" href="/teacher/exams">Go back</a>
        <p><strong>Integration Course:</strong> {{ $aExam['integ_course']['integrated_course_name'] }}</p>
        <p><strong>Items:</strong> {{ $aExam[0]['items'] }}</p>
        <p><strong>Time Limit (minutes):</strong> {{ $aExam[0]['time_limit'] }}</p>
        <p><strong>Questions:</strong></p>
        <div class="ml-4">
            @for ($i = 0; $i < count($aQuestions); $i++)
                <div class="mb-3">
                    <p><strong>{{ $i + 1 }}). {{ $aQuestions[$i]['question'] }}</strong></p>
                    @if($aQuestions[$i]['question_type'] === 0)
                        @foreach($aChoices[$i] as $aChoice)
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" class="radio-choice" {{ ($aChoice['is_correct'] === 1 ? 'checked' : '') }} readonly>
                                    </div>
                                </div>
                                <input type="text" class="form-control" value="{{ $aChoice['choice'] }}" readonly>
                            </div>
                        @endforeach
                    @elseif ($aQuestions[$i]['question_type'] === 1)
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" class="radio-choice" {{ ($aQuestions[$i]['question_answer'] === 1 ? 'checked' : '') }} readonly>
                                </div>
                            </div>
                            <input type="text" class="form-control" value="True" readonly>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" class="radio-choice" {{ ($aQuestions[$i]['question_answer'] === 0 ? 'checked' : '') }} readonly>
                                </div>
                            </div>
                            <input type="text" class="form-control" value="False" readonly>
                        </div>
                    @elseif ($aQuestions[$i]['question_type'] === 3)
                        <input type="text" class="form-control" value="{{ ($aChoices[$i][0]['choice']) }}" readonly>
                    @endif
                </div>
            @endfor
        </div>
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