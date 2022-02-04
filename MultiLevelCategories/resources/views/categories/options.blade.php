{{-- Start of Showing Child Categories IF Exits in Select Option to Add Heriechy Categories --}}
@foreach($childCategories as $subcategory)
    <option value="{{$subcategory->category_id}}"> {{$subcategory->category_name}}</option>
    @if(count($subcategory->childCategories) > 0)
        @include('categories.option',['childCategories' => $subcategory->childCategory])
    @endif
@endforeach
{{-- End of Showing Child Categories IF Exits in Select Option to Add Heriechy Categories --}}
