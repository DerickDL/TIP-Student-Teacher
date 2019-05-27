@extends('pages.student.student_course_home')

@push('styles')

@endpush

@section('course_home_content')
	<div class="row">
		<div class="col-sm-8">
			<h2  id="quiz-title">{{ $aQuizData['quiz'][0]['quiz_title'] }}</h2>
		</div>
		<div class="col-sm-4" id="score-div" style="display: {{$aQuizData['score'] === null ? 'none' : 'block'}}">
			<h2 class="text-right font-weight-bold">Score: <span id="score-area">{{$aQuizData['score']['pivot']['score']}}</span><span>/</span><span id="item-area">{{count($aQuizData['questions'])}}</span></h2>
		</div>
	</div>
	@for ($i = 0; $i < count($aQuizData['questions']); $i++)
		<div class="questions mb-2" data-type="{{ $aQuizData['questions'][$i]['question_type'] }}" data-id="{{ $aQuizData['questions'][$i]['id'] }}">
	        <div class="card p-2">
	            <div class="input-group">
	                <textarea class="form-control" rows="3" readonly style="resize: none">{{ $i + 1 }}. {{ $aQuizData['questions'][$i]['question'] }}</textarea>
	            </div>
	            @if($aQuizData['questions'][$i]['question_type'] !== 2)
	            	@if($aQuizData['questions'][$i]['question_type'] === 1)
	                <ul class="list-group list-group-flush" id="question-choices{{ $aQuizData['questions'][$i]['id'] }}">
		                <li class="list-group-item">
		                    <div class="input-group">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text">
		                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question{{$i}}" data-value=1>
		                            </div>
		                        </div>
		                        <input type="text" class="form-control" aria-label="Text input with radio button" value="True" readonly>
		                    </div>
		                </li>
		                <li class="list-group-item">
		                    <div class="input-group">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text">
		                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question{{$i}}" data-value=0>
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
				                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question{{$i}}" data-value={{ $aChoicesData['id'] }}>
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
	@if($aQuizData['score'] === null)
		<div class="text-right">
			<button class="btn btn-primary" id="submit-quiz" data-value="{{ $aQuizData['quiz'][0]['id'] }}">Submit</button>
		</div>
	@endif
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
           $('#quiz-tab').addClass('active');
        });
    </script>
	<script type="text/javascript" src="/js/submit_quiz.js"></script>
@endpush