<div class="container">
    <div id="top_left">
        <a href="{{ route('home.home') }}"><img src="{{ asset(config('template.homeTemplateURL')  . 'img/css/logo.jpg') }}" alt=""></a>
    </div>
    <div id="top_right">
        <ul class="list-inline">
            <li id="fixborder">
                <a href="{{ route('home.home') }}"><i class="fa fa-home" aria-hidden="true"></i></a>
            </li>
            <li id="fixborder">
                <a href="{{ route('home.about') }}">About</a>
            </li>
            <li id="fixborder">
                <a href="{{ route('home.account') }}">My Account</a>
            </li>
            <li id="fixborder">
                <a href="{{ route('home.contact') }}">Contact</a>
            </li>
            <li class="tel">Get A Quote: <strong>1 888 354 8549</strong></li>
        </ul>

        <form class="form-inline">

            <div class="btn-toolbar pull-right" role="toolbar">

            <!-- Split button -->
            
            <!-- Single button -->
            <div class="btn-group" id="national_button">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset(config('template.homeTemplateURL')  . 'system_files/images/site_flags/2.jpg') }}" height="13" /> <em>$</em> <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="https://www.serverwarehouse.co.uk"><img src="{{ asset(config('template.homeTemplateURL')  . 'system_files/images/site_flags/1.jpg') }}" height="13" /> UK Website (GBP)</a></li>
                  
                  <li><a href="https://www.serverwarehouse.de"><img src="{{ asset(config('template.homeTemplateURL')  . 'system_files/images/site_flags/3.jpg') }}" height="13" /> DE Website (EUR)</a></li>
              </ul>
            </div>
            
            <!-- Split button -->
            <div class="btn-group">
                <a href="{{ route('home.basket.view') }}" class="btn btn-primary">Cart <span class="label label-primary">@if(session('cart') != null){{ count(session('cart')) }} @else 0 @endif </span></a>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                                        <li role="separator" class="divider"></li>
                    <li><a href="{{ route('home.basket.view') }}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> View Cart</a></li>
                </ul>
            </div>

            </div>

        </form>
    </div>

</div>