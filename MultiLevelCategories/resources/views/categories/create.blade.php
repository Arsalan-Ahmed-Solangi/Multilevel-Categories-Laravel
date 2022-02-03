@extends('layouts.app')

@section('content')
{{-- Start of Navigation --}}
@include('navbar');
{{-- End of Navigation --}}
<div class="container">
    {!! Form::open(array('route' => 'categories.store','method'=>'POST')) !!}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm bg-white">
                <div class="card-header bg-dark text-light">{{ __('Welcome '.Auth::user()->name) }}</div>

                <div class="card-body">
                    <div class="form-group">
                        <label>Category Name <span class="text-danger">*</span><label>
                        {!! Form::text('category_name',null, ['placeholder'=>'Enter Category Name','class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="card-footer text-center">
                    <button class=""></button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection
