@extends('pages.course_home')

@push('styles')

@endpush

@section('course_home_content')
    <div id="container-quizzes">
        <h2>Recently added Quizzes</h2>
        <p>No quizzes yet.</p>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action">
                Cras justo odio
            </a>
            <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
            <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
        </div>
    </div>
    <div class="line"></div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#home-tab').addClass('active');
        });
    </script>
@endpush