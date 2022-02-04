
@foreach($nested as $rows)

    <tr>

        <td>{{ $values->category_id ?? null }}</td>
        <td>{{ $rows->category_name ?? null }}</td>
        <td>
            {{-- {{ $rows->parent_category ??  $rows->childCategories->category_name }} --}}
            @isset($rows->parent_category)
                <b>{{ $rows->parentCategories->category_name ?? null }}</b>
            @endisset
        </td>
        <td>
            <a href="" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
            <a href="" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
        </td>
    </tr>

    {{-- Start of Check If ChildCategories Exits Then Show  --}}
    @if (count($rows->childCategories) > 0)
        @include('categories.childCategories',['nested' => $rows->childCategories])
    @endif
    {{-- End of Check If ChildCategories Exits Then Show  --}}
@endforeach
