@extends('pages.teacher.teacher_base')

@push('styles')
    <link rel="stylesheet" href="/css/bootstrap-multiselect.css" type="text/css"/>
@endpush

@section('teacher_content')
    <div class="container">
        <div id="form-generate">
            <div class="float-right">
                    <a class="btn btn-outline-secondary" id="btn-cancel" href="/teacher/exams">Cancel</a>
                    <button class="btn btn-dark" id="btn-generate">Generate</button>
            </div>
            <form>
                <div class="row">
                  <div class="col-8">
                  <div class="form-group">
                        <label>Exam Type</label>
                        <select class="form-control" id="exam-type">
                            <option selected hidden id="type-default">Select Exam Type</option>
                            <option value="1">Preliminary</option>
                            <option value="2">Mid Term</option>
                            <option value="3">Final Term</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Integration Course</label>
                        <select class="form-control" id="integ-courses">
                            <option selected hidden id="integ-default">Select Integration Course</option>
                            <option value="1">Integration Course 1</option>
                            <option value="2">Integration Course 2</option>
                            <option value="3">Integration Course 3</option>
                        </select>
                    </div>
                    <div>
                    <label>Courses: </label>
                        <select class="form-control" id="sub-courses" multiple="multiple">

                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label>No. of Items</label>
                            <input type="text" class="form-control" id="no-items">
                        </div>
                        <div class="form-group col-6">
                            <label>Time Limit (minutes)</label>
                            <input type="text" class="form-control" id="time-limit">
                        </div>
                    </div>
                  </div>
                </div>
              </form>
        </div>
        <p class="text-center mt-3" id="tooltip-generated">Generated Questions will be shown below</p>
        <div class="mt-3" id="questions-area" style="display: none">
            <div class="float-right">
                <button class="btn btn-outline-secondary" id="clear-exam">Clear</button>
                <button class="btn btn-dark" id="save-exam">Save</button>
            </div>
            <h5>Questions:</h5>
            <div id="questions-list">

            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    aSubCourses = {!! json_encode($aSubCourses) !!}
    $(document).ready(function () {
        $('#exam-tab').addClass('active');
	});
</script>
<script type="text/javascript" src="/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/js/add_exam.js"></script>
@endpush