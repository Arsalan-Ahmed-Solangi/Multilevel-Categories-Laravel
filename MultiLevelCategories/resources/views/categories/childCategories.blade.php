
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
    @if (count($rows->childCategories) > 0)
        @include('categories.childCategories',['nested' => $rows->childCategories])
    @endif
    {{-- End of Check If ChildCategories Exits Then Show  --}}
@endforeach
