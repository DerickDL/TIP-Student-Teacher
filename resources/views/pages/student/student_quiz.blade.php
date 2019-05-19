@extends('pages.student.student_course_home')

@push('styles')

@endpush

@section('course_home_content')
	<h2>{{ $aQuizData['quiz'][0]['quiz_title'] }}</h2>
	@for ($i = 0; $i < count($aQuizData['questions']); $i++)
		<div class="questions mb-2" data-value="${iQuestionType}">
	        <div class="card p-2">
	            <div class="input-group">
	                <textarea class="form-control" rows="3" value="{{ $aQuizData['questions'][$i]['question'] }}" readonly style="resize: none">{{ $i + 1 }}. {{ $aQuizData['questions'][$i]['question'] }}</textarea>
	            </div>
	            @if($aQuizData['questions'][$i]['question_type'] !== 2)
	            	@if($aQuizData['questions'][$i]['question_type'] === 1)
	                <ul class="list-group list-group-flush" id="question-choices{{ $aQuizData['questions'][$i]['id'] }}">
		                <li class="list-group-item">
		                    <div class="input-group">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text">
		                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question{{$i}}" value=1>
		                            </div>
		                        </div>
		                        <input type="text" class="form-control" aria-label="Text input with radio button" value="True" readonly>
		                    </div>
		                </li>
		                <li class="list-group-item">
		                    <div class="input-group">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text">
		                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question{{$i}}" value=1>
		                            </div>
		                        </div>
		                        <input type="text" class="form-control" aria-label="Text input with radio button" value="False" readonly>
		                    </div>
		                </li>
		            </ul>
		            @elseif($aQuizData['questions'][$i]['question_type'] === 0)
		            	@foreach($aQuizData['choices'][$i] as $aChoicesData)
		            		<ul class="list-group list-group-flush" id="question-choices{{ $aQuizData['questions'][$i]['id'] }}">
				                <li class="list-group-item">
				                    <div class="input-group">
				                        <div class="input-group-prepend">
				                            <div class="input-group-text">
				                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question{{$i}}" value={{ $aChoicesData['id'] }}>
				                            </div>
				                        </div>
				                        <input type="text" class="form-control" aria-label="Text input with radio button" value="{{ $aChoicesData['choice'] }}" readonly>
				                    </div>
				                </li>
				            </ul>
		            	@endforeach
		            @endif
	            @endif
	        </div>
	    </div>
	@endfor

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
           $('#quiz-tab').addClass('active');
        });
    </script>
@endpush