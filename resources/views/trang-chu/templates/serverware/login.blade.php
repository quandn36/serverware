@extends(config('template.homeTemplateBladeURL').'layout')
@section('content')
<div class="container-fuild login-background">
	<div class="container">
		<div class="row">
			<div class="col-md-6" id="top_lead_hold">
				<h1 class="header-create">
					Login <small>Access Your Quotes</small>
				</h1>
		        <p >Login to your account to save quotes and use the advanced features of the website.</p>
		        <p>
		        	<strong>Don't have an Account?</strong>
		        </p>
		        <p align="center">
		        	<button class="btn btn-lg btn-success">
			        	Create Account
			        </button>
		        </p>
		    </div>
			<div  class="col-md-6 thumbnail-login">
				<div class="titile-form-contact">Log in</div>
				<form id="form-login" action="/action_page.php" >
				    <div class="row thumbnail-contact-form">
				        <div class="col-md-12">
					        <div class="form-group has-warning">
			                      <label class="control-label" for="company">Email address</label>
			                      <input type="email" class="form-control validate" name="company" placeholder="Enter email" value="">
		                    </div>
				        </div>
				        <div class="col-md-12">
					        <div class="form-group has-warning">
			                      <label class="control-label" for="company">Password</label>
			                      <input type="password" class="form-control validate" name="company" placeholder="Enter password" value="">
		                    </div>
				        </div>
				        <div class="checkbox">
					        <label>
					          <input type="checkbox"> Remember me
					        </label>
					     </div>
				    </div>
				    <button type="submit" class="btn btn-success  mt-3 col-md-2">login</button>
				    <button id="btn-fogot" type="submit" class="btn mt-3 col-md-3">Fogot password</button>
			    </form>
			</div>
		</div>
	</div>
</div>
<div id="create-account-backround" class="container">
	<div class="content-form-contact">
		<div class="row">
			<div class="col-md-5">
				<div class="titile-info-contact">
					Why Sign Up?
				</div>
				<div class="content-info-contact contact-content">
					 <div class="info border-info-item-contact">
					 	<p >Save Quotes</p>
						<p >Whilst using our online configurator you can save configured quotes for reviewing later </p>
						<p>Fast and Free</p>
						<p>We just need a few details to get started straight away!</p>
						<p>FL 33896</p>
					 </div>
					 <div class="tel border-info-item-contact">
					 	 <p>Fast and Free<p>
					 	 <p>We just need a few details to get started straight away!</p>
					 </div>
					 
				</div>
			</div>
			<div class="col-md-7 thumbnail-login">
				<div class="titile-form-create">CREATE ACCOUNT</div>
				<form id="form-create" action="/action_page.php" >
				    <div class="row thumbnail-contact-form">
				      <div class="col-md-6">
				        <div class="form-group has-warning">
		                    <label class="control-label" for="name">Name</label>
		                    <input type="text" class="form-control validate" name="name" placeholder="Enter name" value="">
		                </div>
				      </div>
				      <div class="col-md-6">
					        <div class="form-group has-warning">
			                      <label class="control-label" for="company">Company</label>
			                      <input type="text" class="form-control validate" name="company" placeholder="Enter company name" value="">
		                    </div>
				      </div>
				      <div class="col-md-6">
					        <div class="form-group has-warning">
			                      <label class="control-label" for="company">Email address</label>
			                      <input type="email" class="form-control validate" name="company" placeholder="Enter email" value="">
		                    </div>
				      </div>
				      <div class="col-md-6">
					        <div class="form-group has-warning">
			                      <label class="control-label" for="company">Telephone number</label>
			                      <input type="tel" class="form-control validate" name="company" placeholder="Enter tel" value="">
		                    </div>
				      </div>
				    </div>
				    <button type="submit" class="btn btn-success mt-3 col-md-3">Create Account</button>
			    </form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset(config('template.homeTemplateURL')  . 'css/login-page.css') }}">
@endsection