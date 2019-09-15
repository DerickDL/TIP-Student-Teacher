@extends('pages.admin.admin_base')
 
@push('styles')

@endpush

@section('admin_content')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link integration active" id="integ-course-1" data-value="1">Integration Course 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link integration" id="integ-course-2" data-value="2">Integration Course 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link integration" id="integ-course-3" data-value="3">Integration Course 3</a>
        </li>
        <li class="nav-item ml-auto">
            <button class="btn btn-dark" data-toggle="modal" data-target="#modal-assign">Assign Instructor</button>
        </li>
    </ul>    
    <div class="container">
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
                <tbody id="instructors-list">
                    
                </tbody>
            </table>
        </div> 
    </div>
    <div class="modal fade" id="modal-assign" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form>
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label for="message-text" class="col-form-label">Username:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" id="username">
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-dark" id="assign-instructor">Assign</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#assign-module').addClass('active');
    });
</script>
<script type="text/javascript" src="/js/assign_module.js"></script>
@endpush