@extends('pages.teacher.teacher_base')

@push('styles')

@endpush

@section('teacher_content')
    <div class="container">
        <div class="float-right mb-2">
            <a class="btn btn-primary" href="/teacher/section/create">Create Section</a>
        </div>
        @if(count($aSections) > 0)
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="text-center">Section Name</th>
                        <th scope="col" class="text-center">No. of Students</th>
                        <th scope="col" class="text-center">Class Room</th>
                        <th scope="col" class="text-center">Activity Room</th>
                        <th scope="col" class="text-center">Start Date</th>
                        <th scope="col" class="text-center">End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aSections as $aSection)
                        <tr>
                            <td class="text-center"><a href="/teacher/section/{{ $aSection['id'] }}" class="btn-link">{{ $aSection['name'] }}</a></td>
                            <td class="text-center">{{ $aSection['num_stud'] }}</td>
                            <td class="text-center">{{ ($aSection['class_room'] === null) ? 'N/A' : $aSection['class_room']}}</td>
                            <td class="text-center">{{ ($aSection['act_room'] === null) ? 'N/A' : $aSection['act_room']}}</td>
                            <td class="text-center">{{ $aSection['start_date'] }}</td>
                            <td class="text-center">{{ $aSection['end_date'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        <div id="outer" class="container d-flex align-items-center justify-content-center">
            <div id="inner">
                <p>No available sections yet.</p>
            </div>
        </div>
        @endif
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#section-tab').addClass('active');
    });
</script>
@endpush