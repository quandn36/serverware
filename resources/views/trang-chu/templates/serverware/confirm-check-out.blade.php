@extends(config('template.homeTemplateBladeURL').'layout')
@section('content')
<div class="colour_grey">
    <div class="container">
       <h1 class="page-header">Secure Checkout</h1>
       <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li><a href="/checkout/basket.php">Basket</a></li>
          <li><a href="/checkout/index.php">Checkout</a></li>
          <li class="active">Confirm</li>
       </ol>
       <div class="row">
          <div class="col-md-4">
             <div class="panel panel-default">
                <div class="panel-heading">Personal Details <a href="{{ route('home.invoice.check-out') }}" class="btn btn-xs btn-default pull-right">Edit</a></div>
                @if(session('billingInvoice'))
                @php
                  $infor = session('billingInvoice');
                  $trade_email_account = $infor['email'];
                @endphp
                <div class="panel-body">
                   <div class="row">
                      <div class="col-md-12">
                         <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <div>{{ $infor['name'] }}</div>
                         </div>
                         <div class="form-group">
                            <label for="email">Email address <span class="text-danger">*</span></label>
                            <div>{{ $infor['email'] }}</div>
                         </div>
                         <div class="form-group">
                            <label for="company">Company <span class="text-danger">*</span></label>
                            <div>{{ $infor['company'] }}</div>
                         </div>
                         <div class="form-group">
                            <label for="tel">Telephone number <span class="text-danger">*</span></label>
                            <div>{{ $infor['telephone'] }}</div>
                         </div>
                         <div class="form-group">
                            <label for="comments">Comments</label>
                            <div>{{ $infor['comment'] }}</div>
                         </div>
                      </div>
                      <div class="col-md-12">
                         <!-- Billing Address Details. By default it will be hidden -->
                         <div class="form-group">
                            <label>Billing Address</label>
                            <div>{{ $infor['address_1'] }}</div>
                            <div>{{ $infor['address_2'] }}</div>
                            <div>{{ $infor['address_3'] }}</div>
                            <div>{{ $infor['city'] }}</div>
                            <div>{{ $infor['state'] }}</div>
                            <div>{{ $infor['zip'] }}</div>
                            @php 
                              $countries = [
                               'ABW' => 'Aruba',
                               'AFG' => 'Afghanistan',
                               'AGO' => 'Angola',
                               'AIA' => 'Anguilla',
                               'ALA' => 'Åland Islands',
                               'ALB' => 'Albania',
                               'AND' => 'Andorra',
                               'ARE' => 'United Arab Emirates',
                               'ARG' => 'Argentina',
                               'ARM' => 'Armenia',
                               'ASM' => 'American Samoa',
                               'ATA' => 'Antarctica',
                               'ATF' => 'French Southern Territories',
                               'ATG' => 'Antigua and Barbuda',
                               'AUS' => 'Australia',
                               'AUT' => 'Austria',
                               'AZE' => 'Azerbaijan',
                               'BDI' => 'Burundi',
                               'BEL' => 'Belgium',
                               'BEN' => 'Benin',
                               'BES' => 'Bonaire, Sint Eustatius and Saba',
                               'BFA' => 'Burkina Faso',
                               'BGD' => 'Bangladesh',
                               'BGR' => 'Bulgaria',
                               'BHR' => 'Bahrain',
                               'BHS' => 'Bahamas',
                               'BIH' => 'Bosnia and Herzegovina',
                               'BLM' => 'Saint Barthélemy',
                               'BLR' => 'Belarus',
                               'BLZ' => 'Belize',
                               'BMU' => 'Bermuda',
                               'BOL' => 'Bolivia, Plurinational State of',
                               'BRA' => 'Brazil',
                               'BRB' => 'Barbados',
                               'BRN' => 'Brunei Darussalam',
                               'BTN' => 'Bhutan',
                               'BVT' => 'Bouvet Island',
                               'BWA' => 'Botswana',
                               'CAF' => 'Central African Republic',
                               'CAN' => 'Canada',
                               'CCK' => 'Cocos (Keeling) Islands',
                               'CHE' => 'Switzerland',
                               'CHL' => 'Chile',
                               'CHN' => 'China',
                               'CIV' => "Côte d'Ivoire",
                               'CMR' => 'Cameroon',
                               'COD' => 'Congo, the Democratic Republic of the',
                               'COG' => 'Congo',
                               'COK' => 'Cook Islands',
                               'COL' => 'Colombia',
                               'COM' => 'Comoros',
                               'CPV' => 'Cape Verde',
                               'CRI' => 'Costa Rica',
                               'CUB' => 'Cuba',
                               'CUW' => 'Curaçao',
                               'CXR' => 'Christmas Island',
                               'CYM' => 'Cayman Islands',
                               'CYP' => 'Cyprus',
                               'CZE' => 'Czech Republic',
                               'DEU' => 'Germany',
                               'DJI' => 'Djibouti',
                               'DMA' => 'Dominica',
                               'DNK' => 'Denmark',
                               'DOM' => 'Dominican Republic',
                               'DZA' => 'Algeria',
                               'ECU' => 'Ecuador',
                               'EGY' => 'Egypt',
                               'ERI' => 'Eritrea',
                               'ESH' => 'Western Sahara',
                               'ESP' => 'Spain',
                               'EST' => 'Estonia',
                               'ETH' => 'Ethiopia',
                               'FIN' => 'Finland',
                               'FJI' => 'Fiji',
                               'FLK' => 'Falkland Islands (Malvinas)',
                               'FRA' => 'France',
                               'FRO' => 'Faroe Islands',
                               'FSM' => 'Micronesia, Federated States of',
                               'GAB' => 'Gabon',
                               'GBR' => 'United Kingdom',
                               'GEO' => 'Georgia',
                               'GGY' => 'Guernsey',
                               'GHA' => 'Ghana',
                               'GIB' => 'Gibraltar',
                               'GIN' => 'Guinea',
                               'GLP' => 'Guadeloupe',
                               'GMB' => 'Gambia',
                               'GNB' => 'Guinea-Bissau',
                               'GNQ' => 'Equatorial Guinea',
                               'GRC' => 'Greece',
                               'GRD' => 'Grenada',
                               'GRL' => 'Greenland',
                               'GTM' => 'Guatemala',
                               'GUF' => 'French Guiana',
                               'GUM' => 'Guam',
                               'GUY' => 'Guyana',
                               'HKG' => 'Hong Kong',
                               'HMD' => 'Heard Island and McDonald Islands',
                               'HND' => 'Honduras',
                               'HRV' => 'Croatia',
                               'HTI' => 'Haiti',
                               'HUN' => 'Hungary',
                               'IDN' => 'Indonesia',
                               'IMN' => 'Isle of Man',
                               'IND' => 'India',
                               'IOT' => 'British Indian Ocean Territory',
                               'IRL' => 'Ireland',
                               'IRN' => 'Iran, Islamic Republic of',
                               'IRQ' => 'Iraq',
                               'ISL' => 'Iceland',
                               'ISR' => 'Israel',
                               'ITA' => 'Italy',
                               'JAM' => 'Jamaica',
                               'JEY' => 'Jersey',
                               'JOR' => 'Jordan',
                               'JPN' => 'Japan',
                               'KAZ' => 'Kazakhstan',
                               'KEN' => 'Kenya',
                               'KGZ' => 'Kyrgyzstan',
                               'KHM' => 'Cambodia',
                               'KIR' => 'Kiribati',
                               'KNA' => 'Saint Kitts and Nevis',
                               'KOR' => 'Korea, Republic of',
                               'KWT' => 'Kuwait',
                               'LAO' => "Lao People's Democratic Republic",
                               'LBN' => 'Lebanon',
                               'LBR' => 'Liberia',
                               'LBY' => 'Libya',
                               'LCA' => 'Saint Lucia',
                               'LIE' => 'Liechtenstein',
                               'LKA' => 'Sri Lanka',
                               'LSO' => 'Lesotho',
                               'LTU' => 'Lithuania',
                               'LUX' => 'Luxembourg',
                               'LVA' => 'Latvia',
                               'MAC' => 'Macao',
                               'MAF' => 'Saint Martin (French part)',
                               'MAR' => 'Morocco',
                               'MCO' => 'Monaco',
                               'MDA' => 'Moldova, Republic of',
                               'MDG' => 'Madagascar',
                               'MDV' => 'Maldives',
                               'MEX' => 'Mexico',
                               'MHL' => 'Marshall Islands',
                               'MKD' => 'Macedonia, the former Yugoslav Republic of',
                               'MLI' => 'Mali',
                               'MLT' => 'Malta',
                               'MMR' => 'Myanmar',
                               'MNE' => 'Montenegro',
                               'MNG' => 'Mongolia',
                               'MNP' => 'Northern Mariana Islands',
                               'MOZ' => 'Mozambique',
                               'MRT' => 'Mauritania',
                               'MSR' => 'Montserrat',
                               'MTQ' => 'Martinique',
                               'MUS' => 'Mauritius',
                               'MWI' => 'Malawi',
                               'MYS' => 'Malaysia',
                               'MYT' => 'Mayotte',
                               'NAM' => 'Namibia',
                               'NCL' => 'New Caledonia',
                               'NER' => 'Niger',
                               'NFK' => 'Norfolk Island',
                               'NGA' => 'Nigeria',
                               'NIC' => 'Nicaragua',
                               'NIU' => 'Niue',
                               'NLD' => 'Netherlands',
                               'NOR' => 'Norway',
                               'NPL' => 'Nepal',
                               'NRU' => 'Nauru',
                               'NZL' => 'New Zealand',
                               'OMN' => 'Oman',
                               'PAK' => 'Pakistan',
                               'PAN' => 'Panama',
                               'PCN' => 'Pitcairn',
                               'PER' => 'Peru',
                               'PHL' => 'Philippines',
                               'PLW' => 'Palau',
                               'PNG' => 'Papua New Guinea',
                               'POL' => 'Poland',
                               'PRI' => 'Puerto Rico',
                               'PRK' => "Korea, Democratic People's Republic of",
                               'PRT' => 'Portugal',
                               'PRY' => 'Paraguay',
                               'PSE' => 'Palestinian Territory, Occupied',
                               'PYF' => 'French Polynesia',
                               'QAT' => 'Qatar',
                               'REU' => 'Réunion',
                               'ROU' => 'Romania',
                               'RUS' => 'Russian Federation',
                               'RWA' => 'Rwanda',
                               'SAU' => 'Saudi Arabia',
                               'SDN' => 'Sudan',
                               'SEN' => 'Senegal',
                               'SGP' => 'Singapore',
                               'SGS' => 'South Georgia and the South Sandwich Islands',
                               'SHN' => 'Saint Helena, Ascension and Tristan da Cunha',
                               'SJM' => 'Svalbard and Jan Mayen',
                               'SLB' => 'Solomon Islands',
                               'SLE' => 'Sierra Leone',
                               'SLV' => 'El Salvador',
                               'SMR' => 'San Marino',
                               'SOM' => 'Somalia',
                               'SPM' => 'Saint Pierre and Miquelon',
                               'SRB' => 'Serbia',
                               'SSD' => 'South Sudan',
                               'STP' => 'Sao Tome and Principe',
                               'SUR' => 'Suriname',
                               'SVK' => 'Slovakia',
                               'SVN' => 'Slovenia',
                               'SWE' => 'Sweden',
                               'SWZ' => 'Swaziland',
                               'SXM' => 'Sint Maarten (Dutch part)',
                               'SYC' => 'Seychelles',
                               'SYR' => 'Syrian Arab Republic',
                               'TCA' => 'Turks and Caicos Islands',
                               'TCD' => 'Chad',
                               'TGO' => 'Togo',
                               'THA' => 'Thailand',
                               'TJK' => 'Tajikistan',
                               'TKL' => 'Tokelau',
                               'TKM' => 'Turkmenistan',
                               'TLS' => 'Timor-Leste',
                               'TON' => 'Tonga',
                               'TTO' => 'Trinidad and Tobago',
                               'TUN' => 'Tunisia',
                               'TUR' => 'Turkey',
                               'TUV' => 'Tuvalu',
                               'TWN' => 'Taiwan, Province of China',
                               'TZA' => 'Tanzania, United Republic of',
                               'UGA' => 'Uganda',
                               'UKR' => 'Ukraine',
                               'UMI' => 'United States Minor Outlying Islands',
                               'URY' => 'Uruguay',
                               'USA' => 'United States',
                               'UZB' => 'Uzbekistan',
                               'VAT' => 'Holy See (Vatican City State)',
                               'VCT' => 'Saint Vincent and the Grenadines',
                               'VEN' => 'Venezuela, Bolivarian Republic of',
                               'VGB' => 'Virgin Islands, British',
                               'VIR' => 'Virgin Islands, U.S.',
                               'VNM' => 'Viet Nam',
                               'VUT' => 'Vanuatu',
                               'WLF' => 'Wallis and Futuna',
                               'WSM' => 'Samoa',
                               'YEM' => 'Yemen',
                               'ZAF' => 'South Africa',
                               'ZMB' => 'Zambia',
                               'ZWE' => 'Zimbabwe'
                              ]; 
                            @endphp
                            @foreach($countries as $code => $name)
                              @if($code == $infor['country'])
                              <div>{{ $name }}</div>
                              @endif
                            @endforeach
                            
                         </div>
                         <!-- Delivery Address Details. By default it will be hidden -->
                         <div class="form-group">
                            <label>Delivery Address</label>
                            <div>{{ $infor['address_1'] }}</div>
                            <div>{{ $infor['address_2'] }}</div>
                            <div>{{ $infor['address_3'] }}</div>
                            <div>{{ $infor['city'] }}</div>
                            <div>{{ $infor['state'] }}</div>
                            <div>{{ $infor['zip'] }}</div>
                            <div>{{ $infor['delivery_type'] }}</div>
                         </div>
                      </div>
                   </div>
                </div>
                @endif
             </div>
          </div>
          <div class="col-md-5">
             <div class="panel panel-default">
                <div class="panel-heading">
                   <div class="basket-system-name">Your Order <a href="{{ route('home.basket.view') }}" class="btn btn-xs btn-default pull-right">Edit</a></div>
                </div>
                @if(session('cart'))
                @php
                  $basket = session('cart');
                @endphp
                @foreach($basket as $id => $product)
                <div class="panel-body">
                   <div class="basket-system-name">
                      <strong>Your Configured {{ $product['name'] }}</strong>
                      <div class="basket-quote-source"></div>
                      <span class="basket-price">${{ $product['price_config'] }}</span>   
                   </div>
                   <div class="basket-table">
                      <div>
                        @php
                          $cover_image = json_decode($product['cover_image'])
                        @endphp
                        @isset($cover_image->url)
                        <img src="{{ $cover_image->url }}" style="display: block; max-width: 260px; max-height: 80px; margin: 25px auto 20px auto;">
                        @endisset
                        @empty($cover_image->url)
                        <img src="{{ asset(config('template.cmsTemplateURL'). 'assets/images/small/img-4.jpg') }}" style="max-width: 260px; max-height: 80px; margin-top: 25px;" alt="Not image">
                        @endempty
                      </div>
                      <div style="font-size: 11px;">
                         <table class="table table-condensed system-specs-overview">
                            <tbody>
                              @php
                                $accessories = $product['accessories'];
                              @endphp
                              @foreach($accessories as $json_accessory)
                                @php
                                $accessory = json_decode($json_accessory);
                                            $tdArr = '';
                                @endphp
                                  @if(!empty($accessory))
                                      @if(is_array($accessory))
                                      <tr>
                                          @foreach($accessory as $accessory)
                                          @if($loop->first)
                                          <td class="system-specs-overview-l">{{ $accessory->category_tree_name }}</td>
                                          @endif
                                          @if($accessory->accessory_qty>1)
                                          @php
                                           $tdArr.= $accessory->accessory_qty.'x'.$accessory->accessory_name.'<br>';
                                          @endphp
                                          @endif
                                          @php
                                           $tdArr.= $accessory->accessory_name.'<br>';
                                          @endphp
                                          @endforeach
                                          <td>{!! $tdArr !!}</td>
                                      </tr>
                                      @else
                                      <tr>
                                        <td class="system-specs-overview-l">{{ $accessory->category_tree_name }}</td>
                                        <td>
                                          @if($accessory->accessory_qty>1)
                                          {{ $accessory->accessory_qty }}x @endif
                                          {{ $accessory->accessory_name }}
                                        </td>
                                      </tr>
                                      @endif
                                @endif
                              @endforeach
                            </tbody>
                         </table>
                      </div>
                   </div>
                </div>
                @endforeach
                @endif
             </div>
          </div>
          <div class="col-md-3">
             <div class="panel panel-primary">
                <div class="panel-heading">Complete Purchase</div>
                <div class="list-group">
                   <!--<div class="list-group-item">
                      <form class="paypal" action="paypal/payments.php" method="post" id="paypal_form">
                         <input type="hidden" name="cmd" value="_xclick">
                         <input type="hidden" name="no_note" value="1">
                         <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">
                         <input type="hidden" name="first_name" value="ád">
                         <input type="hidden" name="last_name" value="Customer's Last Name">
                         <input type="hidden" name="payer_email" value="tintondaocode@gmail.com">
                         <input type="hidden" name="item_number" value="8395">
                         <input type="image" src="{{ asset(config('template.homeTemplateURL')  . 'images/paypal-button.png') }}" border="0" alt="Submit" class="img-responsive">
                      </form>
                   </div>-->
                   <!-- Mandatory Parameters 
                   <div class="list-group-item">
                      <form role="form" name="paymentToken" method="post" action="https://secure.worldpay.com/wcc/purchase">
                         <input type="hidden" name="name" value="ád">
                         <input type="hidden" name="email" value="tintondaocode@gmail.com">
                         <input type="hidden" name="company" value="">
                         <input type="hidden" name="tel" value="">
                         <input type="hidden" name="comments" value="">
                         <input type="hidden" name="address1" value="dá">
                         <input type="hidden" name="address2" value="">
                         <input type="hidden" name="address3" value="">
                         <input type="hidden" name="town" value="">
                         <input type="hidden" name="postcode" value="2311">
                         <input type="hidden" name="country" value="UK">
                         <input type="hidden" name="delvAddress1" value="dá">
                         <input type="hidden" name="delvAddress2" value="">
                         <input type="hidden" name="delvAddress3" value="">
                         <input type="hidden" name="delvTown" value="">
                         <input type="hidden" name="delvcountry" value="UK">
                         <input type="hidden" name="instId" value="1196305">
                         <input type="hidden" name="amount" id="payment_amount" value="8907.41">
                         <input type="hidden" name="cartId" value="BK8395">
                         <input type="hidden" name="currency" value="USD">
                         <input type="hidden" name="testMode" value="0">
                         <input type="hidden" name="desc" id="payment_description" value="Configured  HPE ProLiant DL360 Gen10 - 8 Bay SFF 8x 2.5,  HPE ProLiant DL360 Gen10 - 8 Bay SFF 8x 2.5,  HPE ProLiant DL360 Gen10 - 8 Bay SFF 8x 2.5">
                         <input type="hidden" name="authMode" value="A">
                         <input type="hidden" name="signature" value="7d6252571714d27d805f102fcfc2e081">
                         
                         <input type="hidden" name="fixContact" value="true">
                         <input type="hidden" name="hideContact" value="true">
                        
                         <input type="hidden" name="withDelivery" value="false">
                         
                         <input type="hidden" name="accId1" value="BROADBERRYDAECOMUSD2">
                         <button type="submit" name="checkout" class="btn btn-success btn-block btn-lg"><i class="fas fa-sm fa-credit-card" aria-hidden="true"></i> Checkout by Card</button>
                      </form>
                   </div> -->

                   <div class="list-group-item">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-success btn-block btn-lg" data-toggle="modal" data-target="#checkoutAccountModal"><i class="fas fa-user fa-sm" aria-hidden="true"></i> Checkout on Account</button>
                      <!-- Modal -->
                      <div class="modal fade" id="checkoutAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                         <div class="modal-dialog" role="document">
                            <div class="modal-content">
                               <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                  <h4 class="modal-title" id="myModalLabel">Checkout on Account</h4>
                               </div>
                               <div class="modal-body">
                                  <form id="invoice-store" method="post" action="{{ route('home.invoice.store') }}">
                                    @csrf
                                    <input id="user_id" type="hidden" name="user_id">
                                     <p class="text-info">If you have a Trade Account with us, please complete the below form to checkout</p>
                                     <div style="margin: 35px;">
                                        <div class="form-group">
                                           <label>ServerWarehouse Account Email Address:</label>
                                           <div class="input-group">
                                              <span class="input-group-addon"><i class="fas fa-user" aria-hidden="true"></i></span>
                                              <input id="trade_email_account" type="email" name="trade_email_account" value="@isset($trade_email_account) {{ $trade_email_account }}@endisset" class="form-control" required="" >
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <input type="hidden" name="method" value="account">
                                           <input id="submit_trade_account" type="button" name="submit_trade_account" value="Complete Checkout" class="btn btn-block btn-lg btn-success">
                                        </div>
                                        <div id="load-mess-error">
                                          
                                        </div>
                                     </div>
                                  </form>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="list-group-item">
                      <!-- <p class="red_price" style="display: block; margin-top: 10px; text-align: right;">Subtotal: ${{ $cart->total_price }}</p>
                      <p class="red_price" id="change_delivery" style="display: block; text-align: right;">Delivery: <span>$0</span></p>-->
                      <p class="red_price_total" id="change_total" style="display: block; text-align: right; font-size: 16px;">Total: <span>${{ number_format($cart->total_price,2) }}</span></p>
                   </div>
                </div>
                <!-- list group-->
             </div>
             <!-- eof panel-->
          </div>
          <!-- eof 4-->
       </div>
    </div>
</div>
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset(config('template.homeTemplateURL')  . 'css/basket-page.css') }}">
<link href="{{ asset(config('template.homeTemplateURL')  . 'css/styles-bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-js')
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/parsleyjs/parsley.min.js') }}"></script>
<script type="text/javascript">
  $("#submit_trade_account").click(function(){
    if ( $("#invoice-store").parsley().isValid() ) {
      var email = $("#trade_email_account").val();
      var token = "{{ csrf_token() }}";
      $.ajax({
          url : "{!! route('home.invoice.check-user') !!}",
          method: "POST",
          data: {_token:token, email : email}
      }).done(function(response) {
        if (response.msg == 'valid') {
          var user = response.user;
          $("#user_id").val(user.id);
          $( "#invoice-store" ).submit();
        }
        else {
          $("#load-mess-error").html('<span class="text-danger">'+response.msg+'</span>');
        }
        
      });
   }
  });
   
</script>
@endsection