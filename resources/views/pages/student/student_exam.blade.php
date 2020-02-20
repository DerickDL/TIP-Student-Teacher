@extends('pages.student.student_base')

@push('styles')

@endpush

@section('student_content')
	<div class="row">
		<div class="col-sm-8">
			<h2  id="quiz-title">
			@if ($aExam[0]['type'] === 1)
				Preliminary Exam
			@elseif ($aExam[0]['type'] === 2)
				Mid Term Exam
			@else
				Final term Exam
			@endif
			</h2>
		</div>
		<div class="col-sm-4" id="score-div" style="display: {{$aExam['score'] === null ? 'none' : 'block'}}">
			<h2 class="text-right font-weight-bold">Score: <span id="score-area">{{$aExam['score']}}</span><span>/</span><span id="item-area">{{count($aExam['questions'])}}</span></h2>
		</div>
		<div class="col-sm-4" id="timer-div">
			<h2 class="text-right font-weight-bold" id="timer"></h2>
		</div>
	</div>
	@for ($i = 0; $i < count($aExam['questions']); $i++)
		<div class="questions mb-2" data-type="{{ $aExam['questions'][$i]['question_type'] }}" data-id="{{ $aExam['questions'][$i]['id'] }}">
	        <div class="card p-2">
	            <div class="input-group">
	                <textarea class="form-control" rows="3" readonly style="resize: none">{{ $i + 1 }}. {{ $aExam['questions'][$i]['question'] }}</textarea>
	            </div>
				@if($aExam['questions'][$i]['image_attachment'] !== null)
					<div class="col-12 text-center">
						<img src="/storage/uploads/{{ $aExam['questions'][$i]['image_attachment'] }}" id="question-image" width="350" height="150" class="rounded">
					</div>
				@endif
	            @if($aExam['questions'][$i]['question_type'] !== 2)
	            	@if($aExam['questions'][$i]['question_type'] === 1)
	                <ul class="list-group list-group-flush" id="question-choices{{ $aExam['questions'][$i]['id'] }}">
		                <li class="list-group-item">
		                    <div class="input-group">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text">
		                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question{{$i}}" data-value=1 {{ ($aExam['score'] !== null && $aExam['questions'][$i]['question_answer'] === 1) ? 'checked' : ''  }}>
		                            </div>
		                        </div>
		                        <input type="text" class="form-control" aria-label="Text input with radio button" value="True" readonly>
		                    </div>
		                </li>
		                <li class="list-group-item">
		                    <div class="input-group">
		                        <div class="input-group-prepend">
		                            <div class="input-group-text">
		                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question{{$i}}" data-value=0 {{ ($aExam['score'] !== null && $aExam['questions'][$i]['question_answer'] === 0) ? 'checked' : ''  }}>
		                            </div>
		                        </div>
		                        <input type="text" class="form-control" aria-label="Text input with radio button" value="False" readonly>
		                    </div>
		                </li>
		            </ul>
		            @elseif($aExam['questions'][$i]['question_type'] === 0)
		            	@foreach($aExam['choices'][$i] as $aChoicesData)
		            		<ul class="list-group list-group-flush" id="question-choices{{ $aExam['questions'][$i]['id'] }}">
				                <li class="list-group-item">
				                    <div class="input-group">
				                        <div class="input-group-prepend">
				                            <div class="input-group-text">
				                                <input type="radio" class="radio-choice" name="question{{$i}}" data-value={{ $aChoicesData['id'] }} {{ ($aExam['score'] !== null && $aChoicesData['is_correct']) ? 'checked' : ''  }}>
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
			<a class="btn btn-secondary text-white" href="/student/class/{{ $aClass[0]['id'] }}/exams" id="cancel-exam">{{ $aExam['score'] === null ? 'Cancel' : 'Exit' }}</a>
			@if($aExam['score'] === null)
				<button class="btn btn-primary" id="submit-exam" data-value="{{ $aExam[0]['id'] }}">Submit</button>
			@endif
		</div>
@endsection

@push('scripts')
	<script type="text/javascript">
		var iTimeLimit = {!! json_encode($aExam['score'] === null ? $aExam[0]['time_limit'] : null) !!};
        $(document).ready(function () {
           $('#exams-tab').addClass('active');
        });
    </script>
	<script type="text/javascript" src="/js/submit_exam.js"></script>
@endpush