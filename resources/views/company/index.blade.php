<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-titl m-0">Companies</div>
        <div class="d-flex">
            <form class="form-inline mr-3">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="bi bi-search"></i></button>
            </form>
            <a href="{{ url('/company/create') }}" class="btn btn-primary" data-rel="tooltip" data-placement="top" title="Add a company"><i class="bi bi-plus-circle"></i></a>
        </div>
    </div>

    <table class="table mb-0">
        <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($companies) > 0)
            @foreach($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>Logo</td>
                <td>{{ $company->website }}</td>
                <td class="d-flex">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['App\Http\Controllers\CompanyController@destroy', $company->id]]) !!}
                    {!! Form::button('<i class="bi bi-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-sm', 'data-rel' => 'tooltip', 'data-placement' => 'top', 'title' => 'Delete ' . $company->name] ) !!}
                    {!! Form::close() !!}
                    <a href="{{ route('company.show', $company->id) }}" data-rel="tooltip" data-placement="top" title="Edit {{ $company->name }}" class="btn btn-outline-success btn-sm ml-2"><i class="bi bi-pencil-square"></i></a>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="text-center">
                <td colspan="5">No data found!</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center">
    {!! $companies->links() !!}
</div>