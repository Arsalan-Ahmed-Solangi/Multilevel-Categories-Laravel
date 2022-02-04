@foreach($childCategories as $subcategory)
    @if($category->category_id != $subcategory->category_id )
        <option value="{{$subcategory->category_id}}" @if($category->parent_category == $subcategory->category_id ) selected @endif >
        {{$subcategory->category_name}}
        </option>
    @endif
    @if(count($subcategory->childCategories) > 0)
        @include('categories.options_update',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach
