@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 mb-5">
            @include('company.index', $companies)
        </div>
    </div>
</div>
@endsection