<hr class="divider-blank">

<div class="container"></div>
<div class="container">
    <div class="row" style="position: relative;">
    <div class="col-md-9">
      <div class="tabbable" id="configurator_tabs">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#pane1" data-toggle="tab">Configure</a></li>
          <li><a href="#pane2" data-toggle="tab">Specifications</a></li>
          <li><a href="#pane3" data-toggle="tab">Features</a></li>
          <li><a href="#pane4" data-toggle="tab">Resources</a></li>
          <li><a href="#pane5" data-toggle="tab">Order</a></li>
        </ul>
        <div class="tab-content">
          <div id="pane1" class="tab-pane active">
            
<form method="get" id="cform">
	<div id="change_configurator">
		<p align="center"> <img src="{{ asset(config('template.homeTemplateURL')  . 'img/ajax_loaders/bar.gif') }}" /> <br /> <b>Loading Configurator... </b> </p>
	</div>
	<div class="disclaimer"><p class="disclaimer">Prices for products are subject to change without notice and Prices do not include shipping and/or handling charges or applicable taxes.</p></div>
</form>          </div>
          
          <div id="pane2" class="tab-pane">
            <h3>HPE ProLiant DL360 Gen10 - 4 Bay LFF 4x 3.5 Specifications</h3>
            <div id="change_system_specs"></div>
          </div>
          
          <div id="pane3" class="tab-pane">
            <h2 class="page-header">HPE ProLiant DL360 Gen10 - 4 Bay LFF 4x 3.5<sup>&reg;</sup> Features <small>The HPE ProLiant DL360 Gen10 - 4 Bay LFF 4x 3.5 explained:</small></h2><div class="row marketing height100">
	<div class="col-md-3"> 
		<a class="marketing-image"><img src="{{ asset(config('template.homeTemplateURL')  . 'img/featurette_images/warranty.jpg') }}" /></a>
		<h2>3 Years Warranty as Standard</h2>
		<p>Buy with confidence knowing all Broadberry CyberServe rack servers are backed up by our 3 year warranty, with further warranty upgrade options available.</p>
    </div></div><hr class="featurette-divider" />          </div>
          
           <div id="pane4" class="tab-pane" style="min-height: 500px;">
           	<h3><a name="RESOURCES" id="RESOURCES"></a>Product Datasheets and Resources</h3>
			           </div>
           
            <div id="pane5" class="tab-pane" style="min-height: 500px;">
            	
				<a id="price_guarantee" name="PRICE_GUARANTEE"></a>
				<img src="{{ asset(config('template.homeTemplateURL')  . 'img/icons/price_guarantee.png') }}" class="pull-right-pad" /><h3>ServerWarehouse Price Guarantee</h3>
				<p>We're so confident in our great value solutions, If you find a cheaper genuine price for the same specifications elsewhere we'll match it.</p>
				 <hr class="featurette-divider" />
				<h3>How to order</h3>
<p>You can order by either calling us and speaking to one of our experienced  US technical sales team, or pressing <a href="Javascript: email_system_specs(\'ask_email\', \'graham\');">"Email Quote"</a>.</p>

<p><img src="{{ asset(config('template.homeTemplateURL')  . 'img/boxes/full_row2_half/viewAllProductType/servers_us_full.html') }}" /></p>
           </div>
          
          
        </div>
        <!-- /.tab-content --> 
        
      </div>
      <!-- /.tabbable --> 
      <div id="close_sticky_anchor"></div>
      
      
      
      
    </div>
    <!-- /.9 col -->
    
    <div class="col-md-3">

        <div id="rightCol" class="bs-docs-sidebar">
          <div id="change_prices"></div>

            

        </div>


        <script type="text/javascript">

            // Right Col Stick =================================================================================================
            rightCol_offset_top = $('#rightCol').offset().top - 1;

            //alert(stop_offset_top);

            $('.logoHold').tooltip();

            function check_filter_scroll()
            {
                stop_offset_top = $('#close_sticky_anchor').offset().top - $('#rightCol').outerHeight();

                if( $(window).scrollTop() > rightCol_offset_top && $(window).scrollTop() < stop_offset_top )
                {
                    $('#rightCol').attr("class", "stick-right");
                    //console.log("Add Class Stick Right");
                }
                else if($(window).scrollTop() > stop_offset_top)
                {
                    $('#rightCol').attr("class", "stick-right-bottom");
                }
                else
                {
                    $('#rightCol').attr("class", "");
                }

                console.log("Stop offset top: "+ stop_offset_top);
            }

            // Sockets Stick =======================================================================================================
            /* Some systems dont have sockets therefore there is no change_sockets_repeat*/
            if($('#change_sockets_repeat').length){
                sockets_offset_top = $('#change_sockets_repeat').offset().top - 50;
            } else {
                sockets_offset_top = 0;
            }


            function check_sockets_scroll()
            {
                if( $(window).scrollTop() > sockets_offset_top )  {
                    $('#change_sockets_repeat').addClass("stick-top");
                } else {
                    $('#change_sockets_repeat').removeClass("stick-top");
                }
            }

            //Aslo update stop offset top on tab change
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                stop_offset_top = $('#close_sticky_anchor').offset().top - $('#rightCol').outerHeight();
                check_filter_scroll();
            })

            // Generic on Scroll to control ===========================================================================================
            $(window).on("scroll", function(){
                if ($(window).width() > 992) {
                    check_filter_scroll();
                }
                check_sockets_scroll();
            });



        </script>
      
      
      
      
      <!-- /.3 col --> 
    </div>
    <!-- /.#rightcol --> 
  </div>
  <!-- /.row --> 
  
  </div>