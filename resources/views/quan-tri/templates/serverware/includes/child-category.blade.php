
@if (isset($child_category->categories))
<li id="{{ $child_category->id }}" class="item-li"><a onclick="accessories({{ $child_category->id }})" class="choose-category" >{{ $child_category->name }}</a><ul id="ul{{ $child_category->id }}" class="sub-menu2">@foreach ($child_category->categories as $childCategory)
        @include(config('template.cmsTemplateBladeURL') . 'includes.child-category',['child_category' => $childCategory,'id_group' => $id_group])
 @endforeach</ul></li>
@endif
