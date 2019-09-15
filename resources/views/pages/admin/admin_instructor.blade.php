@extends('pages.admin.admin_base')
    
@push('styles')

@endpush

@section('admin_content')
    <div class="container">
        <div class="float-right mb-2">
            <button class="btn btn-dark" data-toggle="modal" data-target="#modal-assign">Create Instructor</button>
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
        
            <!-- <div id="outer" class="container d-flex align-items-center justify-content-center">
                <div id="inner">
                    <p>No available sections yet.</p>
                </div>
            </div> -->
        
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
                    <label for="recipient-name" class="col-form-label">First Name:</label>
                    <input type="text" class="form-control" id="first-name">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Last Name:</label>
                    <input type="text" class="form-control" id="last-name">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Email:</label>
                    <input type="text" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Username:</label>
                    <input type="text" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Password:</label>
                    <input type="text" class="form-control" id="password">
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-dark" id="add-instructor">Add</button>
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
<script type="text/javascript" src="/js/instructor_module.js"></script>
@endpush