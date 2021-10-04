<!--Product Detail -->
<div class="colour_grey ">
  <div class="container">

	@if(!empty($server))
	<h1 class="page-header">{{ $server->name }}<small></small></h1> 
	
	<ol class="breadcrumb">
      <li><a href="index.html">Home</a></li>
      <li><a href="hpe-rack-servers.html">HPE ProLiant Rack Servers</a></li>
      <li class="active">{{ $server->name }}</li>
    </ol>    
    <div class="row">
      <div class="col-md-6" id="top_lead_hold">
        {!! $server->features !!}
        @php
          $image_cover = json_decode($server->cover_image);
          $image_brand = json_decode($server->brand_image);
        @endphp
        @empty($image_brand)
    		<img src="{{ asset(config('template.homeTemplateURL')  . 'img/broadberry_brand_logos/50.png') }}" style="margin-top: 15px;" />
        @endempty
        @isset($image_brand)
        <img src="{{ $image_brand->url }}" style="margin-top: 15px;" />
        @endisset                    
      </div>
      <div class="col-md-6 z_index_98">
        @empty($image_cover)    
        <img style="display: block; margin-left: auto; margin-top: 0px;" src="{{ asset(config('template.homeTemplateURL')  . 'img/system_attribute_value_trans/dl-1u-gen10.png') }}" id="top_lead_img"> 
        @endempty

        @isset($image_cover)    
        <img style="display: block; margin-left: auto; margin-top: 0px;" src="{{ $image_cover->url }}" id="top_lead_img"> 
        @endisset     
      </div>
      
  @endif 
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