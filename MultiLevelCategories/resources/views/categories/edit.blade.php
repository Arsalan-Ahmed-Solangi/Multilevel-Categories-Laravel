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

                    <form action="{{ route('categories.update',[$category->category_id])  }}"  method="patch">
                        {{csrf_field()}}

                        <div class="form-group mb-3">
                            <strong>Category Name <span class="text-danger">*</span></strong>
                            {!! Form::text('category_name',null, ['placeholder'=>'Enter Category Name',
                            'class'=>'form-control','required'=>'required']) !!}
                        </div>

                        {{-- <div class="form-group mb-3">
                            <strong>Category Images <span class="text-danger">*</span></strong>
                            {!! Form::file('category_images', ['class'=>'form-control','multiple']) !!}
                            <span class="text-success">You can select multiple images | Images only allowed when you don't select parent category</span>
                        </div> --}}


                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Select parent category*</label>
                                <select type="text" name="parent_id" class="form-control">

                                    @if($category)
                                        @foreach($category as $item)

                                            <option value="{{$category->category_id}}" @if($category->parent_category == $category->category_id ) selected @endif>{{$category->category_name}}</option>
                                            @if(count($category->childCategories))
                                                @include('categories.options_update',['childCategories' => $category->childCategories])
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
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
