@extends('pages.teacher.teacher_base')

@push('styles')

@endpush

@section('teacher_content')
    <div class="container">
        <div class="float-right mb-2">
            <a class="btn btn-primary" href="/teacher/section/create">Create Section</a>
        </div>
        <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="text-center">Section Name</th>
                        <th scope="col" class="text-center">No. of Students</th>
                        <th scope="col" class="text-center">Class Room</th>
                        <th scope="col" class="text-center">Activity Room</th>
                        <th scope="col" class="text-center">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aSections as $aSection)
                        <tr>
                            <td class="text-center">{{ $aSection['name'] }}</td>
                            <td class="text-center">{{ $aSection['num_stud'] }}</td>
                            <td class="text-center">{{ ($aSection['class_room'] === null) ? 'N/A' : $aSection['class_room']}}</td>
                            <td class="text-center">{{ ($aSection['act_room'] === null) ? 'N/A' : $aSection['act_room']}}</td>
                            <td class="text-center">{{ $aSection['date'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#section-tab').addClass('active');
    });
</script>
@endpush