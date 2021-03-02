@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/profile.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if ($company)
        <div class="col-md-9 mb-5">
            <div class="card">
                <div class="card-body text-center">
                    {!! Form::model($company, ['method' => 'PATCH', 'id' => 'update_company','files' => true, 'action' => ['App\Http\Controllers\CompanyController@update', $company->id]]) !!}
                    {{ csrf_field() }}
                    <div class="company-logo">
                        <button type="button" id="upload_logo">Upload file</button>
                        <input name="image" type="file" id="my_file" class="d-none">

                        @if ($company->logo == null || file_exists(asset('/storage/company' .
                        $company->logo)))
                        <img id="test" class="card-img-top" src="{{ asset('/storage/default_profile_image.png') }}" alt="default image logo">
                        @else
                        <img id="test" class="card-img-top" src="{{ asset('/storage/images/' . $company->image_path) }}" alt="{{ $company->name }}'s logo">
                        @endif
                    </div>
                    <div class="pt-3" id="file_name"></div>
                    {!! Form::text('name', null, ['class' => 'form-control text-center', 'required' => 'true','placeholder' => 'Company name', 'value' => $company->name]) !!}
                    {!! Form::text('email', null, ['class' => 'form-control text-center', 'placeholder' => 'Company email', 'value' => $company->email]) !!}
                    {!! Form::text('website', null, ['class' => 'form-control text-center', 'placeholder' => 'Company website', 'value' => $company->website]) !!}
                    {!! Form::submit('Update Company', ['class' => 'btn btn-primary']) !!}

                    @if (count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {!! Form::close() !!}
                </div>

                <div class="card-footer text-muted text-right">
                    Last edited {{ $company->updated_at->diffForHumans() }}
                </div>
            </div>
        </div>
        <div class="col-md-9 mb-5">
            @include('partials.admin._employee', $employees = $company->employees)
        </div>
        @else
        <h1>Company not found</h1>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/admin/profile.js') }}"></script>
<script src="{{ asset('js/admin/employees.js') }}"></script>
@stop