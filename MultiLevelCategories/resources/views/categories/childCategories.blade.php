<?php $dash.='-- '; ?>
@foreach($childCategories as $subcategory)
    <?php $_SESSION['i']=$_SESSION['i']+1; ?>
    <tr>
        <td>{{$_SESSION['i']}}</td>
        <td>{{$dash}}{{$childCategories->category_name}}</td>

        <td>{{$childCategories->parentCategories->category_name}}</td>
    </tr>
    @if(count($childCategories->subcategory))
        @include('childCategories',['childCategories' => $subcategory->subcategory])
    @endif
@endforeach
