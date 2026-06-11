@php
    $value = null;
    // for ($i=0; $i < $child_category->level; $i++){
    //     $value .= '--';
    // }
if($child_category->level == 0){
$value = $child_category->getTranslation('name');
}elseif($child_category->level == 1){
    $data = App\Models\Category::find($child_category->parent_id);
    $value = $data->name.' / '.$child_category->getTranslation('name');
}elseif($child_category->level == 2){
    $data = App\Models\Category::find($child_category->parent_id);
    if($data)
    {$data1 = App\Models\Category::find($data->parent_id);}
    
    if($data1){
    $value = $data1->name.' / '.$data->name.' / '.$child_category->getTranslation('name');  
    }
}elseif($child_category->level == 3){
    $data = App\Models\Category::find($child_category->parent_id);
    if($data)
    {$data1 = App\Models\Category::find($data->parent_id);}
    
    if($data1)
    {$data2 = App\Models\Category::find($data1->parent_id);}
    
    if($data2)
    {$value = $data2->name.' / '.$data1->name.' / '.$data->name.' / '.$child_category->getTranslation('name');}
}
@endphp
<option value="{{ $child_category->id }}"
@if(isset($product) && $product->categories->contains('id', $child_category->id)) selected @endif>
    {{ $value}}</option>
@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @include('categories.child_category', ['child_category' => $childCategory])
    @endforeach
@endif