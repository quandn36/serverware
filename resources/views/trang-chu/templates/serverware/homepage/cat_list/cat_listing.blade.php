<hr class="divider-blank">
<div class="container">

    <div class="cat_listing">

        <div class="row">
            @foreach($categories as $category)
            @php
                $cover_image = json_decode($category->cover_image);
            @endphp
            <div class="col-md-6">
                <a href="{{ route('home.category-detail',$slug= $category->slug) }}" class="cat cat-blue" style="background-image: url(@if($cover_image->url){{ asset($cover_image->url) }}@else {{ asset('trang-chu/templates/serverware/images/server-product.png') }} @endif)">
                    <div class="cat_box">
                        <h3>{{  $category->name }}</h3>
                        <p>{!!  $category->short_name_description !!}</p>
                    </div>
                </a>
            </div>
            @if($loop->index == 3)
                @break
            @endif
            @endforeach
        </div>
    </div>
    

</div>