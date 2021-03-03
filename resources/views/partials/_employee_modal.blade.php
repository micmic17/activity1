<div class="modal fade" id="{{ $type == 'add' ? 'addEmployeeModal' : "updateEmployee$employee->id" }}" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $company->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="{{ $type == 'add' ? 'add_employee_modal' : "update_employee_modal$employee->id" }}">
                <div class="modal-body">
                    <div class="input-group">
                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                        <input class="form-control" value="{{ $type == 'add' ? '' : $employee->first_name }}" type="text" name="first_name" placeholder="First Name" required>
                        <input class="form-control" value="{{ $type == 'add' ? '' : $employee->last_name  }}" type="text" name="last_name" placeholder="Last Name" required>
                    </div>
                    <div class="input-group">
                        {{ csrf_field() }}
                    </div>
                    <div class="col-auto px-0 mt-3">
                        <div class="input-group mb-2 mr-1">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="bi bi-mailbox"></i></div>
                            </div>
                            <input class="form-control" value="{{ $type == 'add' ? '' : $employee->email }}" type="email" name="email" placeholder="Email">
                            <div class="input-group-prepend ml-1">
                                <div class="input-group-text"><i class="bi bi-telephone"></i></div>
                            </div>
                            <input class="form-control" value="{{ $type == 'add' ? '' : $employee->phone }}" type="text" name="phone" placeholder="Phone Number">
                        </div>
                    </div>

                    <!-- Errors -->
                    <div class="d-none alert" id="{{ $type == 'add' ? 0 : $employee->id }}" role="alert">
                        <ul class="m-0">
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ $type == 'add' ? 'Add' : 'Update' }} Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>