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
    <div class="col-md-8">
      <div class="page-header"><h2>Placed<span class="badge">@if($list_order) {{ count($list_order) }} @else 0 @endif</span></h2></div>
      <!--start all orders-->
      <form method="post">
        <table id="" class="results" cellspacing="0">
          <thead>
            <tr class="topHead">
              <td colspan="2">Order ID</td>
              <td>Order Time</td>
              <td>Order Total</td>
              <td>Status Order</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            @if(count($list_order)!=0)
            @foreach ($list_order as $record_list_order)
            <!--single order-->
            <tr>
              <td colspan="2"> {{ $record_list_order->id }} </td>
              <td> {{ date('d-m-Y', strtotime($record_list_order->created_at)) }} </td>
              <td>${{ number_format($record_list_order->total_price,2) }}</td>
              <td>
                @if($record_list_order->status == 0)
                <span class="badge badge-danger">Processing</span>
                @elseif($record_list_order->status == 1)
                <span class="badge badge-danger">Processed</span>
                @elseif($record_list_order->status == 2)
                <span class="badge badge-danger">Shipping</span>
                @else
                <span class="badge badge-danger">To receive</span>
                @endif
              </td>
              <td>
                <div class="button-group" style="padding-top: 10px;">
                  <button type="button" class="btn btn-success" ><a href="{{ route('home.order-detail',$record_list_order->id) }}" style=" color: white; text-decoration: none; ">Detail</a></button>
                  @if($record_list_order->status == 0)
                  <button type="button" data-url="{{ route('home.cancel-order') }}" data-id="{{ $record_list_order->id }}" class="btn btn-warning confirm_cancel_order" >Cancel order</button>
                  @endif
                </div>
              </td>
            </tr>
            <!--single order-->
            @endforeach
            @else
            <tr><td>No orders</td></tr>
            @endif 
            
          </tbody>
        </table>
      </form>
      <!--end all orders-->
      <hr class="featurette-divider" />

      <div class="page-header"><h2>Cancelled<span class="badge">@if($cancelled_order) {{ count($cancelled_order) }} @else 0 @endif </span></h2></div>
      <!--start canceled order-->
      <form method="post">
        <table id="" class="results" cellspacing="0">
          <thead>
            <tr class="topHead">
              <td colspan="2">Order ID</td>
              <td>Order Time</td>
              <td>Order Total</td>
              <td>Status Order</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            @if(count($cancelled_order)!=0)
            @foreach ($cancelled_order as $record_cancelled_order)
            <!--single order cancelled-->
            <tr>
              <td colspan="2">{{ $record_cancelled_order->id }}</td>
              <td>{{ date('d-m-Y', strtotime($record_cancelled_order->created_at)) }}</td>
              <td>${{ number_format($record_cancelled_order->total_price,2) }} </td>
              <td><span class="badge badge-danger">Cancelled</span></td>
              <td>
                <div class="button-group" style="padding-top: 10px;">
                  <button type="button" class="btn btn-success" ><a href="{{ route('home.order-detail',$record_cancelled_order->id) }}" style=" color: white; text-decoration: none; ">Detail</a></button>
                  <button type="button" data-url="{{ route('home.re-order') }}" data-id="{{ $record_cancelled_order->id }}" class="btn btn-secondary buy_again_order" >Re-Order</button>
                </div>
              </td>
            </tr>
            <!--single order cancelled-->
            @endforeach
            @else
            <tr><td>No orders cancelled</td></tr>
            @endif
          </tbody>
        </table>
      </form>
      <!--end canceled order-->
    </div>
    <div class="col-md-4">
      <div class="panel panel-primary panel-center">
        <div class="panel-heading">
          <h3 class="panel-title">Account Manager</h3>
        </div>
        <li class="list-group-item">
         <strong>No Account Manager Assigned</strong><br>
         -
       </li>
     </div>
     <div class="panel panel-info panel-center">
      <div class="panel-heading">
        <h3 class="panel-title">Your Details</h3>
      </div>
      <li class="list-group-item"><strong> {{ Auth::guard('homepage')->user()->name }}</strong><br> Customer ID: {{ Auth::guard('homepage')->user()->id }}</li>
      <li class="list-group-item"><abbr title="Phone Number" class="text-muted">Tel:</abbr> {{ Auth::guard('homepage')->user()->tel }}</li>
      <li class="list-group-item"><abbr title="Phone Number" class="text-muted">Email:</abbr> {{ Auth::guard('homepage')->user()->email }}</li>
      <li class="list-group-item"><abbr title="Phone Number" class="text-muted">Company:</abbr> {{ Auth::guard('homepage')->user()->company }}</li>
      <li class="list-group-item"><a href="{{ route('home.logout') }}" class="btn btn-block btn-lg btn-warning">Log Out</a></li>
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

  $('.buy_again_order').ready(function(){
    $('.buy_again_order').click(function(){
      var re_order_id_     = $(this).data('id');
      var url_             = $(this).data('url');
      alertify.confirm('Are you sure you want to re-order this order "'+re_order_id_+'"?',function() {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:url_,
          method:"PUT",
          data:{
            re_order_id:re_order_id_
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
