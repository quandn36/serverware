<!DOCTYPE html>
<html lang="en-US">
<head>
  <!--<meta charset="utf-8">-->
  <META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Multinational -->
  <link rel="alternate" hreflang="en-GB" href="https://www.serverwarehouse.co.uk/" />
  <link rel="alternate" hreflang="de" href="https://www.serverwarehouse.de/" />
  <meta http-equiv="Content-Language" content="en-US">
  @yield('title')
  <title>HPE Server Configurator - Configure your HP ProLiant Server</title>
  <meta name="description" content="ServerWarehouse boasts the world's best HPE server configurator. Build your HPE ProLiant server today.">
  <meta name="keywords" content="hpe, hp, server configurator, ProLiant, DL Server">

  <link rel="stylesheet" href="{{ asset(config('template.homeTemplateURL'). 'css/styles-bootstrap.css') }}">
  <link rel="canonical" href="index.html" />
  <link rel="stylesheet" href="{{ asset(config('template.homeTemplateURL'). 'css/product_finder-bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset(config('template.homeTemplateURL'). 'js/bootstrap/bootstrap-3.3.2/css/bootstrap.3.3.2.less.css') }}">

  <link rel="stylesheet" href="{{ asset(config('template.homeTemplateURL'). 'js/bootstrap/bootstrap-3.3.2/css/bootstrap.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="">
  @yield('seo-meta')
  <!-- Bootstrap -->
  <script src="{{ asset(config('template.homeTemplateURL')  . 'js/bootstrap/bootstrap-3.3.2/js/jquery.js') }}"></script>
  <script src="{{ asset(config('template.homeTemplateURL')  . 'js/bootstrap/bootstrap-3.3.2/js/respond.js') }}"></script>
  <link href="{{ asset(config('template.homeTemplateURL')  . 'js/bootstrap/bootstrap-3.3.2/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset(config('template.homeTemplateURL')  . 'css/serverwarehouse.css') }}" rel="stylesheet">
  <script src="{{ asset(config('template.homeTemplateURL')  . 'js/bootstrap/bootstrap-3.3.2/js/bootstrap.min.js') }}"></script>

  <!-- Broadberry -->
  <link href="{{ asset(config('template.homeTemplateURL')  . 'css/broadberry_bootstrap.css') }}" rel="stylesheet">

  <!-- Other Modules -->
  <script src="{{ asset(config('template.homeTemplateURL')  . 'js/broadberry_theme.js') }}"></script>
  <script src="{{ asset(config('template.homeTemplateURL')  . 'js/modules/scrollto/jquery.scrollTo-1.4.3.1-min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset(config('template.homeTemplateURL')  . 'js/modules/yamm3/yamm/yamm.css') }}">
  <script src="https://kit.fontawesome.com/289c9f3fa9.js"></script>

  <link href="{{ asset(config('template.homeTemplateURL')  . 'css/styles-bootstrap.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset(config('template.homeTemplateURL')  . 'css/serverwarehouse.css') }}" rel="stylesheet" type="text/css" />

  <!--parseley js-->
  <script src="{{ asset(config('template.homeTemplateURL'). 'js/parseleyjs/parsley.min.js') }}"></script>
  
  @yield('page-css')
</head>

<body>
  <!--header-->
  @include(config('template.homeTemplateBladeURL'). 'includes.header')
  <!--End header-->

  <!--mennu-->
  @include(config('template.homeTemplateBladeURL'). 'includes.menu')
  <!--End menu-->

  <div class="corona_popup" id="corona_popup">
    <div class="container">
      <strong><i class="fas fa-virus text-muted"></i> We're working hard throughout Coronavirus to deliver as normal</strong> -{{ now()->format('d/m/Y')  }}   <a href="Javascript: close_corona_message();" class="text-white" style="margin-left: 10px;"><i class="fas fa-times-circle"></i></a>
    </div>
  </div>

  <script>

    function close_corona_message()
    {
      $("#corona_popup").hide();

        //Create Cookie
        var expires;
        var date = new Date();
        date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
        document.cookie = "corona_closed=1"+ expires + "; path=/";
      }

    </script>

    <!--Content-->
    @yield('content')
    <!-- End content-->

    <!--noti message-->
    @include(config('template.homeTemplateBladeURL'). 'includes.notification-message')

    <!--footer-->
    @include(config('template.homeTemplateBladeURL'). 'includes.footer')
    <!--End footer-->

    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-99230108-2']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>

    <script>
      !function ($) {
       $(function(){
		// carousel demo
		$('#homeCarousel').carousel({
			interval: 10000,
			pause: "hover"
		})
	})
     }(window.jQuery)
   </script> 
   <script>

    function menServers()
    {
      $("#menuCollapseServers").collapse('toggle');

      if($("#menuCollapseStorage").attr("aria-expanded")) {
        $("#menuCollapseStorage").collapse('hide');
      }
    }

    function menStorage()
    {
      $("#menuCollapseStorage").collapse('toggle');

      if($("#menuCollapseServers").attr("aria-expanded")) {
        $("#menuCollapseServers").collapse('hide');
      }
    }

    //Add open class to manu headings
    $("#menuCollapseStorage").on('show.bs.collapse', function () {
      $("#menuStorage_heading").addClass('open');
    }).on('hide.bs.collapse', function () {
      $("#menuStorage_heading").removeClass('open');
    })

    $("#menuCollapseServers").on('show.bs.collapse', function () {
      $("#menuServers_heading").addClass('open');
    }).on('hide.bs.collapse', function () {
      $("#menuServers_heading").removeClass('open');
    })
    
  </script>



  <!--custom notification message-->
  <script src="{{ asset(config('template.homeTemplateURL'). 'js/custom-noti.js') }}"></script>
  

  @yield('page-js')
  @yield('page-custom-js')
</body>
</html>