<div class="footer">   
    <div class="container">
    
     <p align="right" style="padding-top: 30px;"><img src="{{ asset(config('template.homeTemplateURL')  . 'img/icons/payment-methods-compact/2.png') }}" />
    <div class="row" style="margin-top: 30px;">
      <div class="col-md-3">
          <img src="{{ asset(config('template.homeTemplateURL')  . 'img/ipad/footer_2.jpg') }}" class="img-responsive" />
      </div>
        <div class="col-md-3">
        <h4><i class="fa fa-sitemap"></i> Links</h4>
        <div class="list-group list-group-nobord">
            <a href="{{ route('home.privacy-policy') }}" class="list-group-item">Privacy</a>
            <a href="{{ route('home.contact') }}" class="list-group-item">Contact</a>
        </div>
      </div>
      @isset($categoriesFooter)
      @foreach($categoriesFooter as $productParentCate)
        @if($loop->index <= 1)
        <div class="col-md-3">
          <h4>Top {{ $productParentCate->name }}</h4>
            @if($productParentCate->childrenCategories->isNotEmpty())
              @foreach($productParentCate->childrenCategories as $category)
                @if($loop->index < 10)
                @php
                  $images = json_decode($category->brand_image_logo);
                @endphp
                <div class="list-group list-group-nobord">
                  <li class="list-group-item">
                    <a href="{{ route('home.category-detail',$category->slug)}}"><img src="@if($images->url != null){{ $images->url }} @else {{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }} @endif" class="img-responsive" /></a>
                  </li> 
                </div>
                @endif
              @endforeach
            @endif
        </div>
        @endif
        @endforeach
      @endisset
    </div>
  </div>
  <!-- /.container -->
  <div class="bottom-tel">
    <div class="container">
      <div class="row">
        <div class="col-md-4"> <a href="{{ route('home.contact') }}" class="btn btn-success btn-lg btn-block" style="margin-top: 30px;">Contact Us</a> </div>
        <div class="col-md-8">
          <div class="big-tel">
            <h3>Call Our US Sales Team Now!</h3>
            1 888 354 8549 </div>
        </div>
      </div>
    </div>
    <!-- /.container --> 
  </div>
  <div class="container"> 
    <footer>
      <p class="pull-right"><a id="scroll-top" href="Javascript: scroll_to('body');">Back To Top</a></p>
      <script type="text/javascript">
        $('#scroll-top').click(function(){
          $(window).scrollTop(0);
        });
      </script>
     &nbsp;&nbsp;&nbsp;  &copy; 2020 Server Warehouse</p>
    </footer>
  </div>
</div>