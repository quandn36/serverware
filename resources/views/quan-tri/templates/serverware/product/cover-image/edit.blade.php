<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <label>Cover image <span class="required">*</span></label>
                @php 
                $cover_image = json_decode($product->cover_image);
                @endphp
                @isset ($cover_image->url)
                <img class="rounded mr-2 mb-1" id="image-cover" alt="package thumbnail" style="width: 100%;" data-src="{{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }}" src=" {{ asset($cover_image->url) }}" data-holder-rendered="true">
                @endisset
                @empty ($cover_image->url)
                <img class="rounded mr-2 mb-1" id="image-cover" alt="package thumbnail" style="width: 100%;" src="{{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }}" data-holder-rendered="true">
                @endempty
                <input type="hidden" id="image-url-cover" required name="cover_image" value="@isset($cover_image->url){{ $cover_image->url }}@endisset">
                <input type="text" name="alt_text_cover" class="form-control mb-1" placeholder="Enter alternate text" value="@isset($cover_image->url){{ $cover_image->alt_text_image }}@endisset"/>
                <div class="button-group">
                    <button type="button" id="choose-image-cover" class="btn btn-outline-primary waves-effect waves-light">
                        Choose image
                    </button>
                    <button type="button" id="remove_cover_image" class="btn btn-outline-primary waves-effect waves-light">Remove</button>
                </div>
            </div>
        </div>
    </div>
</div>