@extends(config('template.homeTemplateBladeURL').'layout')
@section('content')
<div class="colour_grey ">
  <div class="container">
    <h1 class="page-header">{{ $categoryList->name }} <small></small></h1>    <div class="row">
      <div class="col-md-6" id="top_lead_hold">
            <p class="lead">{!! $categoryList->long_description !!}</p><p></p></div>
            @php
                $image_banner = json_decode($categoryList->image_banner_category);
            @endphp
            <div class="col-md-6"> 
                <img style="display: block; margin-left: auto; margin-top: 0px;" src="@if($image_banner->url){{ asset($image_banner->url) }}@else {{ asset('trang-chu/templates/serverware/images/server-product.png') }} @endif" id="top_lead_img">
            </div>
            <script>

                $(window).load(function() {
                    valign("top_lead_img", "top_lead_hold");
                });

            </script>  
        </div>
    </div>
    <!-- /.container -->
    <hr class="divider-blank">
</div>
<hr class="divider-blank">
<div class="container">
  <div class="tabbable" id="search_tabs">
    <ul class="nav nav-tabs"><li class="active"><a href="#pane1" data-toggle="tab">Server Model</a></li></ul>
    <div class="tab-content">
      <div id="pane1" class="tab-pane active">
        <div class="home_banner banner_light">
            <div class="home_banner_caption">
              <p class="home_banner_caption_h2">HPE ProLiant Gen10 Family</p>
              <p class="home_banner_caption_p">HPE's latest generation of ProLiant servers, powered by the Intel Xeon SP processor</p>
          </div>
      </div>
      <div class="row marketing height80">
        @if(!empty($subCategoryList))
            @foreach ($subCategoryList as $record)
            @php
            $record_image_cover = json_decode($record->cover_image);
            @endphp
            <div class="col-md-3" id="at50">
                <a class="marketing-image" href="{{ route('home.category-detail',$record->slug) }}"><img src="@if($record_image_cover->url){{ asset($record_image_cover->url) }}@else {{ asset('trang-chu/templates/serverware/images/server-product.png') }} @endif"  /></a>
                <h2><a href="{{ route('home.category-detail',$record->slug) }}">{{ $record->name }}</a></h2>
                <p class="red_price">Configure From $3,135</p>
                <p><a class="btn btn-primary" href="{{ route('home.category-detail',$record->slug) }}">View Range</a></p>
                <p>{!! $record->long_description !!}</p>
            </div>
            @endforeach
        @endif
    </div>
</div>
<div id="pane2" class="tab-pane">

</div>
<div id="pane3" class="tab-pane">

</div>

<div id="pane4" class="tab-pane">

</div>
</div>
<!-- /.tab-content --> 
</div>
<!-- /.tabbable --> 

</div>


<div class="container">
    <div class="top_products_hold">
        <h2 class="page-header">Most Popular @isset($categoryList) {{ $categoryList->name }} @endisset <small>Our most often configured HPE ProLiant Rack Servers systems over the past year</small></h2>
        <div class="row marketing">
           @if(!empty($popularProducts))
               @foreach($popularProducts as $parentId => $products)
                    @if($parentId == $parentCategoryId && !empty($products))
                        @php
                            $index = 1;
                        @endphp
                        @foreach($products as $product)
                        @php
                            $image_cover = json_decode($product->cover_image);
                            $category = App\Models\Category::find($product->category_id);
                            $image_cover_cate = json_decode($category->brand_image_logo);
                            $slugProduct = $category->slug.'/'.$product->slug;
                        @endphp
                        <div class="col-md-2 top_products_hold_product">
                            <span class="badge">{{ $index }}</span>
                            <div id="pop41">
                                <div class="marketing-image"><a href="{{ url($slugProduct) }}"><img src="@if($image_cover->url){{ asset($image_cover->url) }}@else {{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }} @endif" class="img-responsive" /></a></div>
                            </div>
                            <img src="@if($image_cover_cate->url){{ asset($image_cover_cate->url) }}@else {{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }} @endif" class="img-responsive top_products_hold_product_brand" style="margin-bottom: 10px;" />
                            <p><strong>{{ $product->name }} </strong></p>
                            <p class="red_price_norm">Configure From ${{ $product->price + $product->price_config }}</p>

                            <a href="{{ url($slugProduct) }}" class="btn btn-success">Configure</a>
                        </div>
                        @php
                            $index++;
                        @endphp
                        @endforeach
                    @endif
               @endforeach
           @endif
        </div>
    </div>
    <script type="text/javascript">

        $("#pop41").popover({
            content: "<div class=\"popup_specs\"><ul class=\"features_ul\"><li>Redundant Power Supply Option</li><li>HPE iLO Standard with Intelligent Provisioning</li><li>3-year parts, 3-year labor, 3-year onsite support with next business day response.</li><li>3 x USB3 Ports</li><li>Powered by 2x  Intel Xeon Scalable Processor Gen2  Processors</li><li>Supports up to 24 modules of Registered 2933Mhz DIMMs (RDIMMs) Memory</li><li>3x PCI Expansion Slots configurable with </li></ul></div>", 
            html: true,
            trigger: "hover",
            title: "<i class=\"fa fa-list-ul greyed-icon\"></i> &nbsp;Quick Specs:",
            template: '<div class="popover" role="tooltip" style="width: 500px;"><div class="arrow"></div><h4 class="popover-title"></h4><div class="popover-content"><div class="data-content"></div></div></div>'
        });


        $("#pop45").popover({
            content: "<div class=\"popup_specs\"><ul class=\"features_ul\"><li>Redundant Power Supply Option</li><li>HPE iLO Standard with Intelligent Provisioning</li><li>3-year parts, 3-year labor, 3-year onsite support with next business day response.</li><li>3 x USB3 Ports</li><li>Powered by 2x  Intel Xeon Scalable Processor Gen2 2nd Generation Intel Xeon-Platinum Processor, 2nd Generation Intel Xeon-Gold Processor, 2nd Generation Intel Xeon-Silver Processor and 2nd Generation Intel Xeon-Bronze Processor Processors</li><li>Supports up to 24 modules of Registered 2933Mhz DIMMs (RDIMMs) Memory</li><li>2x PCI Expansion Slots configurable with </li></ul></div>", 
            html: true,
            trigger: "hover",
            title: "<i class=\"fa fa-list-ul greyed-icon\"></i> &nbsp;Quick Specs:",
            template: '<div class="popover" role="tooltip" style="width: 500px;"><div class="arrow"></div><h4 class="popover-title"></h4><div class="popover-content"><div class="data-content"></div></div></div>'
        });


        $("#pop40").popover({
            content: "<div class=\"popup_specs\"><ul class=\"features_ul\"><li>Redundant Power Supply Option</li><li>HPE iLO Standard with Intelligent Provisioning</li><li>3-year parts, 3-year labor, 3-year onsite support with next business day response.</li><li>3 x USB3 Ports</li><li>Powered by 2x  Intel Xeon Scalable Processor Gen2  Processors</li><li>Supports up to 24 modules of Registered 2933Mhz DIMMs (RDIMMs) Memory</li><li>3x PCI Expansion Slots configurable with </li></ul></div>", 
            html: true,
            trigger: "hover",
            title: "<i class=\"fa fa-list-ul greyed-icon\"></i> &nbsp;Quick Specs:",
            template: '<div class="popover" role="tooltip" style="width: 500px;"><div class="arrow"></div><h4 class="popover-title"></h4><div class="popover-content"><div class="data-content"></div></div></div>'
        });


        $("#pop42").popover({
            content: "<div class=\"popup_specs\"><ul class=\"features_ul\"><li>Redundant Power Supply Option</li><li>HPE iLO Standard with Intelligent Provisioning</li><li>3-year parts, 3-year labor, 3-year onsite support with next business day response.</li><li>3 x USB3 Ports</li><li>Powered by 2x  Intel Xeon Scalable Processor Gen2  Processors</li><li>Supports up to 24 modules of Registered 2933Mhz DIMMs (RDIMMs) Memory</li><li>3x PCI Expansion Slots configurable with </li></ul></div>", 
            html: true,
            trigger: "hover",
            title: "<i class=\"fa fa-list-ul greyed-icon\"></i> &nbsp;Quick Specs:",
            template: '<div class="popover" role="tooltip" style="width: 500px;"><div class="arrow"></div><h4 class="popover-title"></h4><div class="popover-content"><div class="data-content"></div></div></div>'
        });


        $("#pop44").popover({
            content: "<div class=\"popup_specs\"><ul class=\"features_ul\"><li>Redundant Power Supply Option</li><li>HPE iLO Standard with Intelligent Provisioning</li><li>3-year parts, 3-year labor, 3-year onsite support with next business day response.</li><li>3 x USB3 Ports</li><li>Powered by 2x  Intel Xeon Scalable Processor Gen2 2nd Generation Intel Xeon-Platinum Processor, 2nd Generation Intel Xeon-Gold Processor, 2nd Generation Intel Xeon-Silver Processor and 2nd Generation Intel Xeon-Bronze Processor Processors</li><li>Supports up to 24 modules of Registered 2933Mhz DIMMs (RDIMMs) Memory</li><li>2x PCI Expansion Slots configurable with </li></ul></div>", 
            html: true,
            trigger: "hover",
            title: "<i class=\"fa fa-list-ul greyed-icon\"></i> &nbsp;Quick Specs:",
            template: '<div class="popover" role="tooltip" style="width: 500px;"><div class="arrow"></div><h4 class="popover-title"></h4><div class="popover-content"><div class="data-content"></div></div></div>'
        });


        $("#pop46").popover({
            content: "<div class=\"popup_specs\"><ul class=\"features_ul\"><li>Redundant Power Supply Option</li><li>HPE iLO Standard with Intelligent Provisioning</li><li>3-year parts, 3-year labor, 3-year onsite support with next business day response.</li><li>3 x USB3 Ports</li><li>Powered by 2x  Intel Xeon Scalable Processor Gen2 2nd Generation Intel Xeon-Platinum Processor, 2nd Generation Intel Xeon-Gold Processor, 2nd Generation Intel Xeon-Silver Processor and 2nd Generation Intel Xeon-Bronze Processor Processors</li><li>Supports up to 24 modules of Registered 2933Mhz DIMMs (RDIMMs) Memory</li><li>2x PCI Expansion Slots configurable with </li></ul></div>", 
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
<hr class="divider-blank">
<hr class="featurette-divider">

<!-- Featurette divider-->
    @include(config('template.homeTemplateBladeURL'). 'includes.featurette-divider')
    <!-- End Featurette divider -->
@endsection