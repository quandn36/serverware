<hr class="divider-blank">
<div class="container hidden-xs">
    <div class="row">
        <div class="col-md-12">
            @if(!empty($products))
                @foreach($products as $parentCateId => $listProduct)
                <div class="top_products_hold">
                    @php
                    $categoryParent = \App\Models\Category::find($parentCateId);
                    
                    @endphp
                    <h2 class="page-header">Our Most Popular @isset($categoryParent->name) {{ $categoryParent->name }} @endisset <a href="{{ route('home.category-list',[$categoryParent->slug,$categoryParent->id]) }}" class="btn btn-primary pull-right">View All</a></h2>
                    <div class="row marketing">
                        @foreach($listProduct as $key => $product)
                            @php
                             $category    = App\Models\Category::find($product->category_id);
                             $slugProduct = $category->slug.'/'.$product->slug;
                             $imageBrand = json_decode($category->brand_image_logo);
                             $key = $key + 1;
                            @endphp
                            <div class="col-md-4 top_products_hold_product">
                                <span class="badge">{{ $key }}</span>
                                @php
                                  $cover_image =json_decode($product->cover_image);
                                @endphp
                                <div id="pop40" class="pop40">
                                    <div class="marketing-image"><a href="{{ url($slugProduct) }}"><img src="@isset($cover_image->url) {{ $cover_image->url }} @endisset" class="img-responsive popular_image_homepage" /></a>
                                    </div>
                                </div>
                                <img src="@isset($imageBrand->url) {{ $imageBrand->url }} @endisset" class="img-responsive top_products_hold_product_brand custom_css_image_banner" style="margin-bottom: 10px;" />
                                <p><strong>{{ $product->name }}</strong></p>
                                <p class="red_price_norm">Configure From ${{ $product->price + $product->price_config }}</p>
                                
                                <a href="{{ url($slugProduct) }}" class="btn btn-success">Configure</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            @endif
            <script type="text/javascript">
                $(".pop40").popover({
                    content: "<div class=\"popup_specs\"><ul class=\"features_ul\"><li>Redundant Power Supply Option</li><li>HPE iLO Standard with Intelligent Provisioning</li><li>3-year parts, 3-year labor, 3-year onsite support with next business day response.</li><li>3 x USB3 Ports</li><li>Powered by 2x  Intel Xeon Scalable Processor Gen2  Processors</li><li>Supports up to 24 modules of Registered 2933Mhz DIMMs (RDIMMs) Memory</li><li>3x PCI Expansion Slots configurable with </li></ul></div>", 
                    html: true,
                    trigger: "hover",
                    title: "<i class=\"fa fa-list-ul greyed-icon\"></i> &nbsp;Quick Specs:",
                    template: '<div class="popover" role="tooltip" style="width: 500px;"><div class="arrow"></div><h4 class="popover-title"></h4><div class="popover-content"><div class="data-content"></div></div></div>'
                });
                
            </script>
            <script type="text/javascript">
                $(".ttip").tooltip();
            </script>       
        </div>
    </div>
</div>