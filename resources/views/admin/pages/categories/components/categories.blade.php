@foreach($category_list->children as $category_list)
    <option value="{{ $category_list->id }}" @if($category_list->id == $category->parent_id) selected @endif>{{ $dilimiter }}{{ $category_list->ru_title }}</option>
    @if($category_list->hasChildren())
        @include('admin.pages.categories.components.categories', ['dilimiter' => $dilimiter . '---'])
    @endif
@endforeach