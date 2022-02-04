@extends('layouts.app')

@section('content')
{{-- Start of Navigation --}}
@include('navbar');
{{-- End of Navigation --}}

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">
              {{-- Start of Show Message --}}
              @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>

                @elseif($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                {{-- End of Show Message --}}
            <div class="card shadow-sm bg-white">
                <div class="card-header bg-dark text-light"><i class="fa fa-plus-circle"></i> {{ __('ADD NEW CATEGORY') }}</div>

                <div class="card-body">

                    {{-- Start of Show Form Error Messages --}}
                    @include('errors')
                    {{-- End of Show Form Error Messages --}}

                    {{ $data }}

                </div>

            </div>
        </div>
    </div>

</div>
@endsection
