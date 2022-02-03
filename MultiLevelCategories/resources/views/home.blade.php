@extends('layouts.app')

@section('content')
{{-- Start of Navigation --}}
@include('navbar');
{{-- End of Navigation --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm bg-white">
                <div class="card-header bg-dark text-light">{{ __('Welcome '.Auth::user()->name) }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <div class="card-footer text-center">
                    <a href="{{ route('logout')  }}" class="btn btn-danger"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
