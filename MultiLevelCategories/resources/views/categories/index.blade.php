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
                                <th>SR#</th>
                                <th>Category Name</th>
                                <th>Parent Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <x-view-categories data= {{ $categories ?? array() }} />

                            @if (count($categories ?? array()) > 0)

                                @foreach ($categories ?? array() as $key => $values)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $values->category_name }}</td>
                                        <td>
                                            {{-- {{ $values->parent_category ??  $values->childCategories->category_name }} --}}
                                            @isset($values->parent_category)
                                                {{ $values->childCategories->category_name }}
                                            @endisset
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>

                                    {{-- Start of Check If ChildCategories Exits Then Show  --}}
                                    @if (count($values->childCategories) > 0)
                                        @include('childCategories',['childCategories' => $$values->childCategories])
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
