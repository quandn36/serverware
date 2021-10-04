@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')
@php
  $infor = $invoice;
  $option = ['Mới đặt', 'Đã duyệt', 'Đang giao', 'Đã giao', 'Huỷ']; 
@endphp
<form action="{{ route('invoice.update', $infor->id) }}" method="POST">
    @csrf
    <div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-3">
                 <div class="form-group">
                    <label for="name">Status <span class="text-danger">*</span></label>
                    @if($infor->status == 3)
                      <p>{{  $option[3] }}</p>
                    @else
                    <select name="status" class="form-control form-control-sm select-status">
                      @foreach ($option as $key => $status) 
                          @if($key == $infor->status)
                           <option selected value="{{ $key }}">{{ $status }}</option>;
                          @else 
                            <option  value="{{ $key }}">{{ $status }}</option>
                          @endif
                      @endforeach
                      </select>

                    @endif
                 </div>
            </div>
            <div class="col-lg-12">
             <div class="panel panel-default">
                <div class="panel-heading">Personal Details</div>
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
                         <div class="form-group">
                            <label>Total price:</label>
                            <div>${{ number_format( $infor['total_price'],2) }}</div>
                         </div>
                      </div>
                   </div>
                </div>  
             </div>
            </div>
            <div class="col-lg-12">
                 <div class="panel panel-default">
                    <div class="panel-heading">
                       <div class="basket-system-name">Orders </div>
                    </div>
                    @php
                      $orders = json_decode($invoiceDetail->detail);
                    @endphp
                    @foreach($orders as $product)
                    <div class="panel-body">
                       <div class="basket-system-name">
                          <strong>Order Configured {{ $product->name }}</strong>
                          <div class="basket-quote-source"></div>
                          <span class="basket-price">${{ number_format( $product->price_config,2) }} x {{ $product->quantity }}</span>   
                       </div>
                       <div class="basket-table">
                          <div>
                            @php
                              $cover_image = json_decode($product->cover_image)
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
                                    $accessories = $product->accessories;
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
                 </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">
                            Save
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary waves-effect waves-light btn-block">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

@endsection

@section('page-css')
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/bootstrap4-tagsinput/tagsinput.css') }}
" rel="stylesheet" />
<link href="{{ asset(config('template.cmsTemplateURL'). 'assets/css/custom-cms-accessory.css') }}" rel="stylesheet" />
@endsection

@section('page-js')
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/bootstrap4-tagsinput/tagsinput.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/js/custom.js') }}"></script>
@endsection

@section('page-custom-js')
<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley({
            excluded: 'input[type=button], input[type=submit], input[type=reset]',
            inputs: 'input, textarea, select, input[type=hidden], :hidden',
        });
    });
</script>

@endsection