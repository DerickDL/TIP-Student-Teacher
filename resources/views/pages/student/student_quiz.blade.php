@extends('pages.student.student_base')

@push('styles')

@endpush

@section('student_content')
	<div class="row">
		<div class="col-sm-8">
			<h2  id="quiz-title">{{ $aQuizData['quiz'][0]['quiz_title'] }}</h2>
		</div>
		<div class="col-sm-4" id="score-div" style="display: {{$aQuizData['score'] === null ? 'none' : 'block'}}">
			<h2 class="text-right font-weight-bold">Score: <span id="score-area">{{$aQuizData['score']}}</span><span>/</span><span id="item-area">{{count($aQuizData['questions'])}}</span></h2>
		</div>
		<div class="col-sm-4" id="timer-div">
			<h2 class="text-right font-weight-bold" id="timer"></h2>
		</div>
	</div>
	@for ($i = 0; $i < count($aQuizData['questions']); $i++)
		<div class="questions mb-2" data-type="{{ $aQuizData['questions'][$i]['question_type'] }}" data-id="{{ $aQuizData['questions'][$i]['id'] }}">
	        <div class="card p-2">
	            <div class="input-group">
	                <textarea class="form-control" rows="3" readonly style="resize: none">{{ $i + 1 }}. {{ $aQuizData['questions'][$i]['question'] }}</textarea>
	            </div>
				@if($aQuizData['questions'][$i]['image_attachment'] !== null)
					<div class="col-12 text-center">
						<img src="/storage/uploads/{{ $aQuizData['questions'][$i]['image_attachment'] }}" id="question-image" width="350" height="150" class="rounded">
					</div>
				@endif
	            @if($aQuizData['questions'][$i]['question_type'] !== 2)
	            	@if($aQuizData['questions'][$i]['question_type'] === 1)
	                <ul class="list-group list-group-flush" id="question-choices{{ $aQuizData['questions'][$i]['id'] }}">
		                <li class="list-group-item">
		                    <div class="input-group">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text">
		                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question{{$i}}" data-value=1 {{ ($aQuizData['score'] !== null && $aQuizData['questions'][$i]['question_answer'] === 1) ? 'checked' : ''  }}>
		                            </div>
		                        </div>
		                        <input type="text" class="form-control" aria-label="Text input with radio button" value="True" readonly>
		                    </div>
		                </li>
		                <li class="list-group-item">
		                    <div class="input-group">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text">
		                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question{{$i}}" data-value=0 {{ ($aQuizData['score'] !== null && $aQuizData['questions'][$i]['question_answer'] === 0) ? 'checked' : ''  }}>
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
				                                <input type="radio" class="radio-choice" name="question{{$i}}" data-value={{ $aChoicesData['id'] }} {{ ($aQuizData['score'] !== null && $aChoicesData['is_correct']) ? 'checked' : ''  }} }}>
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
	<div class="text-right">
			<a class="btn btn-secondary text-white" id="cancel-quiz" href="/student/class/{{ $aClass[0]['id'] }}/quizzes">{{ $aQuizData['score'] === null ? 'Cancel' : 'Exit' }}</a>
			@if($aQuizData['score'] === null)
				<button class="btn btn-primary" id="submit-quiz" data-value="{{ $aQuizData['quiz'][0]['id'] }}">Submit</button>
			@endif
		</div>
	
@endsection

@push('scripts')
	<script type="text/javascript">
		var iTimeLimit = {!! json_encode($aQuizData['score'] === null ? $aQuizData['quiz'][0]['quiz_timelimit'] : null) !!}
        $(document).ready(function () {
           $('#quizzes-tab').addClass('active');
        });
    </script>
	<script type="text/javascript" src="/js/submit_quiz.js"></script>
@endpush