@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card shadow-sm bg-white">
                <div class="card-header bg-dark text-light text-center"><i class="fa fa-user-cog"></i> {{ __('USER LOGIN') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="validate">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end"><b>{{ __('Email Address') }}</b><span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end"><b>{{ __('Password') }}</b><span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                           <label class="text-danger">Note :: Run User Seeder (php artisan db:seed --class=UserSeeder)</label>
                        </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-5">
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fa fa-sign-in"></i> {{ __('Login') }}
                                    </button>
                                </div>
                            </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
