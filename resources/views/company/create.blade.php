@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\CompanyController@store', 'files' => true, 'class' => 'w-100']) !!}
        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-at"></i></span>
                </div>
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Company name']) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-mailbox"></i></span>
                </div>
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Company Email']) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-link-45deg"></i></span>
                </div>
                {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Company Webiste']) !!}
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-file-image"></i></span>
                </div>
                {!! Form::file('image', ['class' => 'form-control h-auto font-12']) !!}
            </div>
        </div>
        @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {!! Form::submit('Create Company', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection