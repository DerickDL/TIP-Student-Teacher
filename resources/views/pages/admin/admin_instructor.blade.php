@extends('pages.admin.admin_base')
    
@push('styles')

@endpush

@section('admin_content')
    <div class="container">
        <div class="float-right mb-2">
            <button class="btn btn-dark" data-toggle="modal" data-target="#exampleModalScrollable">Create Instructor</button>
            </div>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Id</th>
                            <th scope="col" class="text-center">First Name</th>
                            <th scope="col" class="text-center">Last Name</th>
                            <th scope="col" class="text-center">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">jd01</td>
                                <td class="text-center">John</td>
                                <td class="text-center">Dy</td>
                                <td class="text-center">jd@gmail.com</td>
                            </tr>
                        
                    </tbody>
                </table>
        
            <!-- <div id="outer" class="container d-flex align-items-center justify-content-center">
                <div id="inner">
                    <p>No available sections yet.</p>
                </div>
            </div> -->
        
        </div>
    </div>

    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#instructor-module').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/add_lesson.js"></script>
@endpush