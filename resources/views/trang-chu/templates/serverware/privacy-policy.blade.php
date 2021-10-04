@extends(config('template.homeTemplateBladeURL').'layout')

@section('title')
	<title>HPE Server Configurator - Configure your HP ProLiant Server</title>
@endsection

@section('seo-meta')
	<!--SEO-->
@endsection

@section('content')

	<div class="colour_grey">
	   <div class="container">
	      <div class="row">
	         <div class="col-md-6" id="top_lead_hold">
	            <div class="page-header">
	               <h1>Privacy Policy</h1>
	            </div>
	            <p class="lead">Server Warehouse are providing this statement to   demonstrate our commitment to your privacy.</p>
	         </div>
	         <div class="col-md-6">
	            <img src="{{ asset(config('template.homeTemplateURL')  . '/system_files/images/system_type_trans/1.png') }}" class="img-responsive" style="margin-top: 37px;">
	         </div>
	      </div>
	   </div>
	   <!-- /.container -->
	</div>

	<hr class="divider-blank" />
	<div class="container">
    <div class="row">
      <div class="col-md-8" id="top_lead_hold">
         <h2 class="page-header"> Disclosure of Gathering and Dissemination Practices</h2>
         <h4> Server Warehouse privacy   statement </h4>
         <p>Server Warehouse has long recognised that   individuals with whom we conduct business value their privacy. However,   in order to conduct global business in this increasingly electronic   economy, the collection of personal information is often necessary and   desirable. It is Server Warehouse goal to balance the benefits of   e-commerce with the right of individuals to prevent the misuse of their   personal information.</p>
         <hr class="featurette-divider">
         <h4>The collection of personal information </h4>
         <p>In some circumstances, Server Warehouse may   request personal information from you, like your name, e-mail address,   company name, or telephone number. Your response to these inquiries is   strictly voluntary. Server Warehouse uses this information to   customise your experience on our Web site. In addition, Broadberry Data   systems may use this information for other business purposes, such as to   alerting you to products and services that can assist you in your   business, promoting site registration, and assisting in order   processing.</p>
         <p>In general, you can visit our site without divulging   any personal information. However, there are areas of this site that   require this information to complete their customisation functions, and   may not be available to those choosing not to reveal the information   requested.</p>
         <hr class="featurette-divider">
         <h4>Collecting domain information </h4>
         <p>Server Warehouse also collects domain   information as part of its analysis of the use of this site. This data   enables us to become more familiar with which customers visit our site,   how often they visit, and what parts of the site they visit most often.   Server Warehouse uses this information to improve its Web site   offerings. This information is collected automatically and requires no   action on your part.</p>
         <hr class="featurette-divider">
         <h4>Disclosure to third parties </h4>
         <p>Broadberry never sell on or disclose any of the email   addresses or personal data collected on our customers. The information   collected is used only for sending out occasional emails promoting our   special offers and new products. To unsubscribe from our mailing list   members can follow the link placed at the bottom of every email shot   sent out, and they will be removed within 7 working days.</p>
         <hr class="featurette-divider">
         <h4>Use of cookies </h4>
         <p>Some pages on this site use "cookies," which are small   files that the site places on your hard drive for identification   purposes. These files are used for site registration and customisation   the next time you visit us. You should note that cookies cannot read   data off of your hard drive. Your Web browser may allow you to be   notified when you are receiving a cookie, giving you the choice to   accept it or not. By not accepting cookies, some pages may not fully   function and you may not be able to access certain information on this   site.</p>
         <p>Server Warehouse reserves the right to change,   modify, or update this statement at any time without notice.</p>
      </div>
      <div class="col-md-4">
      </div>
	   </div>
	</div>
	<!--Cat list -->
	
    <!--End cat list-->
	<!-- Featurette divider-->
	<hr class="featurette-divider" />
	
	<!-- End Featurette divider -->
	@include(config('template.homeTemplateBladeURL'). 'includes.featurette-divider')
@endsection

@section('page-css')
	<!--custom css-->
@endsection
@section('page-js')
	<!--custom js-->
@endsection
