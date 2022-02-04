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

                    {!! Form::open(array('route' => 'categories.store','method'=>'POST','id'=>'validate')) !!}

                        <div class="form-group mb-3">
                            <strong>Category Name <span class="text-danger">*</span></strong>
                            {!! Form::text('category_name',null, ['placeholder'=>'Enter Category Name',
                            'class'=>'form-control','required'=>'required']) !!}
                        </div>

                        <div class="form-group mb-3">
                            <strong>Category Images <span class="text-danger">*</span></strong>
                            <input type="file" name="category_images[]" multiple class="form-control"/>
                            <span class="text-success">You can select multiple images | Images only allowed when you don't select parent category</span>
                        </div>


                        <div class="form-group mb-3">
                            <strong>Select Parent Category  <span class="text-success">(Optional)</span></strong>
                            <select name="parent_category" class="form-control">
                                <option value="">--SELECT PARENT CATEGORY ----</option>
                                        @if($categories)
                                            @foreach($categories as $key => $values)

                                                <option value="{{$values->category_id}}">{{$values->category_name}}</option>
                                                @if(count($values->childCategories) > 0)
                                                    @include('categories.options',['childCategories' => $values->childCategories])
                                                @endif
                                            @endforeach
                                        @endif
                            </select>
                        </div>

                </div>

                <div class="card-footer text-center">
                    <button class="btn btn-dark"><i class="fa fa-plus-circle"></i> Create</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>
@endsection
