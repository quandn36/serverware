@extends(config('template.homeTemplateBladeURL').'layout')

@section('content')

<div class="colour_grey">
  <div class="container">
    <div class="row">
      <div class="col-md-6" id="top_lead_hold">
        <div class="page-header">
          <h1>My Account <small>Saved Quotes</small></h1>
        </div>
        <ol class="breadcrumb">
          <li><a href="{{ route('home.home') }}">Home</a></li>
          <li class="active">My Account</li>
        </ol>
        <p class="lead">Use this area to manage your account and view past quotes you've either emailed to yourself or saved. If you have any queries don't hesitate to get in contact with your Account Manager.</p>
        <p><a href="{{ route('home.contact') }}" class="btn btn-success">Contact</a></p>
      </div>
      <div class="col-md-6"> <img src="{{ asset(config('template.homeTemplateURL'). 'img/menu-includes/2u.png') }}" class="img-responsive" /> </div>
    </div>
  </div>
  <!-- /.container --> 
</div>
<hr class="divider-blank" />
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-light">
          <caption>Order detail <span>({{ $order_detail_id->invoice_id }})</span> - <button class="btn btn-warning"><a href="javascript:history.go(-1)" style=" color: white; text-decoration: none; ">Back</a></button></caption>
          <thead class="thead-light">
            <tr>
              <th scope="col" style=" font-size: 15px; ">Images</th>
              <th scope="col" style=" font-size: 15px; ">Name</th>
              <th scope="col" style=" font-size: 15px; ">Price</th>
              <th scope="col" style=" font-size: 15px; ">Quantity</th>
              <th scope="col" style=" font-size: 15px; " colspan="2">Accessories</th>
            </tr>
          </thead>
          @php
          $order_detail = json_decode($order_detail_id->detail);
          $tdArr = '';
          // dd($order_detail);
          @endphp
          @foreach($order_detail as $record)
          @php
          $cover_image = json_decode($record->cover_image);
          @endphp
          <tbody>
            <tr></tr>
            <tr>
              <td rowspan="50"><img src="@if($cover_image->url !='') {{ $cover_image->url }} @else {{ asset(config('template.homeTemplateURL'). 'img/menu-includes/2u.png') }} @endif" alt="" style="width: 100px;"></td>
              <td rowspan="50" style="word-wrap: break-word;">{{ $record->name }}</td>
              <td rowspan="50">${{ number_format($record->price_config,2) }}</td>
              <td rowspan="50" style=" text-align: center; "><strong>{{ $record->quantity }}</strong></td>
              @php
              $accessories = $record->accessories;
              // dd($accessories);
              @endphp
              @foreach($accessories as $sub_record_accessories)


                @php
                $item_accessories = json_decode($sub_record_accessories);
                // dd($item_accessories);
                @endphp
                @if(!empty($item_accessories))
                  @if(is_array($item_accessories))
                      @foreach($item_accessories as $sub_item_accessories)
                      
                      @if($loop->first)
                        <td>{{ $sub_item_accessories->category_tree_name }}</td>
                      @endif
                      @if($sub_item_accessories->accessory_qty>1)
                      @php
                        $tdArr.= '<strong>'.$sub_item_accessories->accessory_qty.'</strong> x '.$sub_item_accessories->accessory_name.'<hr>';
                      @endphp
                      @endif
                      @php
                        $tdArr.= $sub_item_accessories->accessory_name.'<hr>';
                      @endphp
                      @endforeach

                      <td >{!! $tdArr !!}</td>
                      </tr>
                  @else
                    <tr>
                      <td >{{ $item_accessories->category_tree_name }}</td>
                      <td >
                        @if($item_accessories->accessory_qty>1)
                        <strong>{{ $item_accessories->accessory_qty }}</strong> x 
                        @endif
                        {{ $item_accessories->accessory_name }}
                      </td>
                    </tr>
                  @endif
                @endif

              @endforeach
              
            </tr>
          </tbody>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>

<hr>
@endsection
@section('page-css')
<!--custom css-->
@endsection

@section('page-js')
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/alertify/js/alertify.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/pages/alertify-init.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection


@section('page-custom-js')
<!--custom js-->
<script>
  $(document).ready(function(){
    //
  });

  $(".confirm_cancel_order").ready(function(){
    $(".confirm_cancel_order").click(function(){

      var cancel_order_id_  = $(this).data('id');
      var url_              = $(this).data('url');

      alertify.confirm('Are you sure you want to cancel this order "'+cancel_order_id_+'" ?',function() {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:url_,
          method:"PUT",
          data:{
            cancel_order_id:cancel_order_id_
          }
        }).done(function(response) {
          alertify.success(response.message);
          location.reload();
        });
      },function(){
        //
      });
    });
  });
</script>
@endsection
