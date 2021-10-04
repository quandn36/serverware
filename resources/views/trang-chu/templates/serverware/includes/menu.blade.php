{{-- {{ dd($allCate) }} --}}

@if(!empty($allCate))
<div class="container">
    <div class="masthead">
        <nav>
            <ul class="nav nav-justified yamm">
                <li @if(empty($allCate[0]->name) && !isset($allCate[0])) style="display: none;" @else '' class="dropdown yamm-fw" id="menuServers_heading"><a href="Javascript: menServers();"> @if(!empty($allCate[0]->name) && isset($allCate[0]->name)) {{ $allCate[0]->name }} @endif @endif <b class="caret"></b></a></li>
                <li @if(empty($allCate[1]->name) && !isset($allCate[1]->name)) style="display: none;"  @else '' class="dropdown yamm-fw" id="menuStorage_heading"><a href="Javascript: menStorage();"> @if(!empty($allCate[1]->name) && isset($allCate[1]->name)) {{ $allCate[1]->name }} @endif @endif <b class="caret"></b></a></li>
                <li class="dropdown" @if(empty($allCate[2]->name) && !isset($allCate[2]->name)) style="display: none;" @else ''> <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $allCate[2]->name }} @endif<b class="caret"></b></a>
                    <ul class="dropdown-menu" style="width:390px">
                        @if(isset($data[2]))
                        {{-- <?php echo '<pre>',var_dump($data[2]),'<pre>' ?> --}}
                        @foreach($data[2] as $dataValue_2)
                        <li><a href="{{ route('home.category-detail',$slug=$dataValue_2->slug)}}">{{ $dataValue_2->name }}</a></li>
                        @endforeach
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
@else

{{-- menu sample --}}
@include(config('template.homeTemplateBladeURL'). 'includes.menu-sample.parent-category-sample')

@endif

{{-- ton tai menu thu 1 --}}
@if(!empty($allCate) && !empty($data[0]))
<div class="collapse menu newNav" id="menuCollapseServers" role="tabpanel" aria-labelledby="menuServers_heading">
        <div class="container">

            <div class="row">
                <div class="col-md-8">
                    @if(isset($data[0]))
                    @php
                    $row = 0;
                    $i = 1;
                    if(count($data[0]) % 4 == 0)
                    {
                        $row = (int)(count($data[0])/4);
                    }else {
                        $row = (int)(count($data[0])/4) + 1;
                    }
                    @endphp

                    @foreach($data[0] as $value)

                    @if($i <= count($data[0]))

                    @if($i % 4 == 1)

                    @if($row != 1)
                    <div class="row height60" style="border-bottom: solid 1px #d3d1b6;">
                        @else
                        <div class="row height60" style="border-bottom: 0;">
                            @endif  
                            @endif  

                            <div class="col-xs-12 col-md-3  yamm-hover" style="height: 250px;">

                                @php
                                $images = json_decode($value->cover_image);
                                @endphp

                                <a class="marketing-image" href="{{ route('home.category-detail',$slug= $value->slug)}}"><img src="@if($images->url != null){{ $images->url }} @else {{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }} @endif" class="img-responsive" /></a>
                                <a class="he he-double" href="{{ route('home.category-detail',$slug= $value->slug)}}"><small>{{ $value->short_name }}</small> {{ $value->code }}</a>
                                <div class="yamm_red_price">Configure From $4,295</div>
                                <div class="yamm-desc" ><small>{!! $value->short_name_description !!}</small></div>
                            </div>

                            @if($i % 4 == 0 || $i == count($data[0]))
                            @php
                            $row--;
                            @endphp
                        </div>
                        @endif

                        @php
                        $i+=1;
                        @endphp
                        @endif
                        @endforeach
                        @endif
                    </div>
                    @php
                    if(isset($allCate[0]))
                    {

                        $images = json_decode($allCate[0]->cover_image);
                        @endphp
                        <div class="col-md-4 yamm-hover">
                            <div class="cat_listing">
                                <a href="{{ route('home.category-list',[$slug= $allCate[0]->slug,$slug= $allCate[0]->id]) }}" class="cat cat-brown" style="background-image: url('@if($images!=null)@if($images->url != null){{ $images->url }} @else {{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }} @endif @endif'); height: 450px;">
                                    <div class="cat_box">
                                        <h3>{{ $allCate[0]->name }}</h3>
                                        <p>{!! $allCate[0]->short_name_description !!}</p>
                                        <div class="btn btn-default">View Range</div> 
                                    </div>
                                </a>
                            </div>
                        </div>
                        @php
                    }
                    @endphp
                </div>
            </div>
        </div>
    </div>
@else

{{-- sub menu sample --}}
@include(config('template.homeTemplateBladeURL'). 'includes.menu-sample.sub-parent-1')

@endif

{{-- ton tai menu thu 3 --}}
@if(!empty($allCate) && !empty($data[1]))
<div class="collapse menu newNav" id="menuCollapseStorage" role="tabpanel" aria-labelledby="menuStorage_heading">
    <div class="container">

       <div class="row">
        <div class="col-md-8">
            @if(isset($data[1]))
            @php
            $row = 0;
            $i = 1;
            if(count($data[1]) % 4 == 0)
            {
                $row = (int)(count($data[1])/4);
            }else {
                $row = (int)(count($data[1])/4) + 1;
            }
            @endphp

            @foreach($data[1] as $value)

            @if($i <= count($data[1]))

            @if($i % 4 == 1)

            @if($row != 1)
            <div class="row height60" style="border-bottom: solid 1px #d3d1b6;">
                @else
                <div class="row height60" style="border-bottom: 0;">
                    @endif  
                    @endif  

                    <div class="col-xs-12 col-md-3  yamm-hover" style="height: 250px;">

                        @php
                        $images = json_decode($value->cover_image);
                        @endphp

                        <a class="marketing-image" href="{{ route('home.category-detail',$slug= $value->slug)}}"><img src="@if($images->url != null){{ $images->url }} @else {{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }} @endif" class="img-responsive" /></a>
                        <a class="he he-double" href="{{ route('home.category-detail',$slug= $value->slug)}}"><small>{{ $value->short_name }}</small> {{ $value->code }}</a>
                        <div class="yamm_red_price">Configure From $4,295</div>
                        <div class="yamm-desc"><small>{!! $value->short_name_description !!}</small></div>
                    </div>

                    @if($i % 4 == 0 || $i == count($data[1]))
                    @php
                    $row--;
                    @endphp
                </div>
                @endif

                @php
                $i+=1;
            // print_r($i);
                @endphp
                @endif
                @endforeach
                @endif
            </div>
            @php
            $images = json_decode($allCate[1]->cover_image);
            @endphp
            <div class="col-md-4 yamm-hover">
                <div class="cat_listing">
                    <a href="{{ route('home.category-list',[$slug= $allCate[1]->slug,$slug= $allCate[1]->id]) }}" class="cat cat-brown" style="background-image: url('@if($images->url != null){{ $images->url }} @else {{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }} @endif'); height: 450px;">
                        <div class="cat_box">
                            <h3>{{ $allCate[1]->name }}</h3>
                            <p>{!! $allCate[1]->short_name_description !!}</p>
                            <div class="btn btn-default">View Range</div> 
                        </div>
                    </a>
                </div>
            </div>
        </div>           
    </div>
</div>
@else

{{-- sub menu sample --}}
@include(config('template.homeTemplateBladeURL'). 'includes.menu-sample.sub-parent-2')

@endif

{{-- <script>
    var name = $('.yamm-desc').text();
    if (name.length > 100) {
        var shortname = name.substring(0, 20) + " ...";
        $('.yamm-desc').replaceWith(shortname);
    }
</script> --}}