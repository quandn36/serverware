<!--log in -->
<div class="colour_grey">
	<div class="container">
		<div class="row">
			<div class="col-md-6" id="top_lead_hold">
				<h1 class="page-header">Login <small>Access Your Quotes</small></h1>
				<p class="lead">Login to your account to save quotes and use the advanced features of the website.</p>

				<p><strong>Don't have an Account?</strong></p>
				<p align="center"><button class="btn btn-lg btn-success" onClick="scroll_to('#create_account');">Create Account</button></p>
			</div>

			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Login</div>

					<div class="panel-body">
						<form id="login_form" role="form" action="{{ route('home.postlogin') }}" method="POST">
							{{ csrf_field() }}
							
							@if(session('login_success'))
							<div class="alert alert-success">
								{{ session('login_success') }}
							</div>
							@endif

							@if(session('failed_login'))
							<div class="alert alert-danger">
								{{ session('failed_login') }}
							</div>
							@endif

							<div class="form-group">
								<label for="email">Email address</label>
								<input type="email" class="form-control"  name="email" id="email" required data-parsley-type="email" data-parsley-trigger="keyup"  placeholder="Enter email">
							</div>

							<div class="form-group">
								<label for="password">Password</label>
								<input name="password" type="password" class="form-control" id="password" required maxlength="191" placeholder="Enter password">
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember_token" value="Remember_me"> Remember me
								</label>
							</div>
							<div>
								<input name="Login" type="submit" class="btn btn-success error_message_inline_form_login" value="Login"/>
								<input name="ForgotLogin" type="submit" class="btn btn-default error_message_inline_form_login" value="Forgot Password" />
								<p class=" error_message_inline_form_login"></p>
								<span class="text-danger invalid-form-error-message"></span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.container -->
</div>

<script type="text/javascript">
	$(function () {
		$('#login_form').parsley().on('form:validate', function (formInstance) {
			var ok = formInstance.isValid({group: 'block1', force: true});
			$('.invalid-form-error-message')
			.html(ok ? '' : 'Email address or password is incorrect.')
			.toggleClass('filled', !ok);
			if (!ok)
				formInstance.validationResult = false;
		});
	});
</script>