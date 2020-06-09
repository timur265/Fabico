@foreach($category_list->children as $category_list)
    <option value="{{ $category_list->id }}" @if($category_list->id == $product->category_id) selected @endif>{{ $dilimiter }}{{ $category_list->ru_title }}</option>
    @if($category_list->hasChildren())
        @include('admin.pages.products.categories', ['dilimiter' => $dilimiter . '---'])
    @endif
@endforeach
