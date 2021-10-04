<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <label>Cover image</label>
                @php 
                $cover_image = json_decode($category->cover_image);
                   // dd($cover_image);exit;
                @endphp
                <img class="rounded mr-2 mb-1" id="cover_image" alt="package thumbnail" style="width: 100%;" data-src="{{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }}" src="@if ($cover_image->url != null) {{ asset($cover_image->url) }} @else {{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }} @endif" data-holder-rendered="true">
                <input type="hidden" id="url_cover_image" name="url_cover_image" value="@isset($cover_image->url){{ $cover_image->url }}@endisset">
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