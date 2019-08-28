@extends('pages.teacher.teacher_base')

@push('styles')

@endpush

@section('teacher_content')
    <div class="container">
        <div id="outer" class="container d-flex align-items-center justify-content-center">
                <div id="inner">
                    <p>No enrolled students yet.</p>
                </div>
            </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#student-tab').addClass('active');
	});
</script>
@endpush