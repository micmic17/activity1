<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-titl m-0">Employees</div>
        <div class="d-flex">
            @if (Request::is('home'))
            {!! Form::open(['method' => 'GET', 'route' => 'home', 'class' => 'form-inline mr-3']) !!}
            {!! Form::text('search_employee', null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Company name']) !!}
            {!! Form::button('<i class="bi bi-search"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-success my-2 my-sm-0'] ) !!}
            {!! Form::close() !!}
            @else
            {!! Form::open(['method' => 'GET', 'action' => ['App\Http\Controllers\CompanyController@show', $company->id], 'class' => 'form-inline mr-3']) !!}
            {!! Form::text('search_employee', null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Company name']) !!}
            {!! Form::button('<i class="bi bi-search"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-success my-2 my-sm-0'] ) !!}
            {!! Form::close() !!}
            @endif
            @if (!Request::is('home'))
            <button class="btn btn-primary" data-target="#exampleModal" data-toggle="modal" data-rel="tooltip" data-placement="top" title="Add an employee"><i class="bi bi-plus-circle"></i></button>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ $company->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="add_employee_modal">
                            <div class="modal-body">
                                <div class="input-group">
                                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                                    <input class="form-control" type="text" name="first_name" placeholder="First Name" required>
                                    <input class="form-control" type="text" name="last_name" placeholder="Last Name" required>
                                </div>
                                <div class="input-group">
                                    {{ csrf_field() }}
                                </div>
                                <div class="col-auto px-0 mt-3">
                                    <div class="input-group mb-2 mr-1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="bi bi-mailbox"></i></div>
                                        </div>
                                        <input class="form-control" type="email" name="email" placeholder="Email">
                                        <div class="input-group-prepend ml-1">
                                            <div class="input-group-text"><i class="bi bi-telephone"></i></div>
                                        </div>
                                        <input class="form-control" type="text" name="phone" placeholder="Phone Number">
                                    </div>
                                </div>

                                <!-- Errors -->
                                <div id="validationField" class="d-none alert" role="alert">
                                    <ul class="m-0">
                                    </ul>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add Employee</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <table class="table mb-0">
        <thead class="thead-light">
            <tr>
                @if (Request::is('home'))
                <th>Full Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                @else
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (count($employees) > 0)
            @foreach ($employees as $employee)
            <tr>
                @if (Request::is('home'))
                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td>{{ $employee->company->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                @else
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td class="d-flex">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['App\Http\Controllers\EmployeeController@destroy', $employee->id]]) !!}
                    {!! Form::button('<i class="bi bi-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-sm', 'data-rel' => 'tooltip', 'data-placement' => 'top', 'title' => 'Delete ' . $employee->first_name . ' ' . $employee->last_name] ) !!}
                    <a href="{{ route('employee.show', $employee->id) }}" data-rel="tooltip" data-placement="top" title="Edit {{ $employee->first_name }} {{ $employee->last_name }}" class="btn btn-outline-success btn-sm ml-2"><i class="bi bi-pencil-square"></i></a>
                    {!! Form::close() !!}
                </td>
                @endif
            </tr>
            @endforeach
            @else
            <tr class="text-center">
                <th colspan="4">No data</th>
            </tr>
            @endif
        </tbody>
    </table>
</div>