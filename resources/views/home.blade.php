@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 mb-5">
            @include('partials.admin._company')
        </div>
        <div class="col-12">
            @include('partials.admin._employee')
        </div>
    </div>
</div>
@endsection