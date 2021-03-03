<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-titl m-0">Employees</div>
        <div class="d-flex">
            @if (request()->route('company'))
            {!! Form::open(['method' => 'GET', 'action' => ['App\Http\Controllers\CompanyController@show', $company->id], 'class' => 'form-inline mr-3']) !!}
            @else
            {!! Form::open(['method' => 'GET', 'action' => ['App\Http\Controllers\EmployeeController@index'], 'class' => 'form-inline mr-3']) !!}
            @endif
            {!! Form::text('search_employee', null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Company name']) !!}
            {!! Form::button('<i class="bi bi-search"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-success my-2 my-sm-0'] ) !!}
            {!! Form::close() !!}
            @if (request()->route('company'))
            <button class="btn btn-primary" data-target="#addEmployeeModal" data-toggle="modal" data-rel="tooltip" data-placement="top" title="Add an employee"><i class="bi bi-plus-circle"></i></button>
            @include('partials._employee_modal', ['type' => 'add'])
            @endif
        </div>
    </div>
    <table class="table mb-0">
        <thead class="thead-light">
            <tr>
                @if (request()->route('company'))
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
                @else
                <th>Full Name</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Phone</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (count($employees) > 0)
            @foreach ($employees as $employee)
            <tr>
                @if (request()->route('company'))
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td class="d-flex">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['App\Http\Controllers\EmployeeController@destroy', $employee->id]]) !!}
                    {!! Form::button('<i class="bi bi-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-sm', 'data-rel' => 'tooltip', 'data-placement' => 'top', 'title' => 'Delete ' . $employee->first_name . ' ' . $employee->last_name] ) !!}
                    {!! Form::close() !!}
                    <a data-target="#updateEmployee{{ $employee->id }}" data-id="{{ $employee->id }}" data-toggle="modal" data-rel="tooltip" data-placement="top" title="Edit {{ $employee->first_name }} {{ $employee->last_name }}" class="btn btn-outline-success btn-sm ml-2"><i class="bi bi-pencil-square"></i></a>

                    @include('partials._employee_modal', ['type' => 'update'])
                </td>
                @else
                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td>{{ $employee->company->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                @endif
            </tr>
            @endforeach
            @else
            <tr class="text-center">
                <th colspan="5">No data</th>
            </tr>
            @endif
        </tbody>
    </table>
</div>
{{-- Pagination --}}
<div class="d-flex justify-content-center">
    {!! $employees->links() !!}
</div>