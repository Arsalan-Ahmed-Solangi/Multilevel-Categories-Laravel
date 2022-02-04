@extends('layouts.app')

@section('content')
{{-- Start of Navigation --}}
@include('navbar');
{{-- End of Navigation --}}

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
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
                <div class="card-header bg-dark text-light"><i class="fa fa-eye"></i> {{ __('VIEW MULTILEVEL CATEGORIES') }}</div>

                <div class="card-body">
                    {{-- Start of Table --}}
                    <table class="table table-striped table-bordered table-hover" id="table">
                        <thead>
                            <tr>

                                <th>Category Images</th>
                                <th>Category Name</th>
                                <th>Parent Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                                $a = 0;
                            @endphp
                            @if (count($categories ?? array()) > 0)

                                @foreach ($categories ?? array() as $key => $values)
                                    <tr>
                                        <td>{{ $values->category_name }}</td>
                                        <td>{{ $values->category_name }}</td>
                                        <td>
                                            {{-- {{ $values->parent_category ??  $values->childCategories->category_name }} --}}
                                            @isset($values->parent_category)
                                               <b> {{ $values->childCategories->category_name }}</b>
                                            @endisset
                                        </td>
                                        <td>
                                            <a href="{{Route('categories.show', $values->category_id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> Show</a>

                                            <a href="{{Route('categories.edit', $values->category_id)}}" class="btn btn-success mb-2"><i class="fa fa-edit"></i> Edit</a>

                                            <form action="{{route('categories.destroy',[$values->category_id])}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>  Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Start of Check If ChildCategories Exits Then Show  --}}
                                    @if (count($values->childCategories) > 0)
                                        @include('categories.childCategories',['nested' => $values->childCategories,'keys'=>$a])
                                    @endif
                                    {{-- End of Check If ChildCategories Exits Then Show  --}}
                                @endforeach

                            @else
                                <tr>
                                    <th colspan="4">No MultiCategories Found</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{-- End of Table --}}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
