@extends('pages.admin.admin_base')
    <link rel="stylesheet" type="text/css" href="/css/subjects.css">
@push('styles')

@endpush

@section('admin_content')
    <div class="container">
        <div>Assign Module</div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#assign-module').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/add_lesson.js"></script>
@endpush