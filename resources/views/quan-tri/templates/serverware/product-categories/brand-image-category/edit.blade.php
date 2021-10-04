<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <label>Image brand logo</label>
                @php 
                $brand_image_logo = json_decode($category->brand_image_logo);
                @endphp
                <img class="rounded mr-2 mb-1" id="brand_image_logo" alt="package thumbnail" style="width: 100%;" data-src="{{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }}" src="@if ($brand_image_logo->url != null) {{ asset($brand_image_logo->url) }} @else {{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }} @endif" data-holder-rendered="true">
                <input type="hidden" id="url_image_logo"  name="url_image_logo" value="@isset($brand_image_logo->url){{ $brand_image_logo->url }}@endisset">
                <input type="text" name="alt_text_cover" class="form-control mb-1" placeholder="Enter alternate text" value="@isset($brand_image_logo->url){{ $brand_image_logo->alt_text_image }}@endisset"/>
                <div class="button-group">
                    <button type="button" id="choose-image-logo" class="btn btn-outline-primary waves-effect waves-light">
                        Choose image
                    </button>
                    <button type="button" id="remove_brand_image" class="btn btn-outline-primary waves-effect waves-light">Remove</button>
                </div>
            </div>
        </div>
    </div>
</div>