<hr class="divider-blank" />
<div class="container"  id="create_account">
	<div class="row">

		<div class="col-md-4">

			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title">Why Sign Up?</h3></div>

				<div class="list-group">
					<div class="list-group-item">
						<h4 class="list-group-item-heading">Save Quotes</h4>
						<p class="list-group-item-text">Whilst using our online configurator you can save configured quotes for reviewing later</p>
					</div>

					<div class="list-group-item">
						<h4 class="list-group-item-heading">Fast and Free</h4>
						<p class="list-group-item-text">We just need a few details to get started straight away!</p>
					</div>



				</div>
			</div>

		</div>
		<div class="col-md-8">

			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Create Account</h3>
				</div>
				
				<div class="panel-body">
					<div class="panel-body">
						<form role="form" id="register_form" method="POST" action="{{ route('home.send-mail') }}" data-parsley-validate>
							{{ csrf_field() }}

							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									{{-- notification when succesfully registration --}}
									@if(session('success'))
									<div class="alert alert-success">
										{{ session('success') }}
									</div>
									@endif

									@if(session('error_create'))
									<div class="alert alert-danger">
										{{ session('error_create') }}
									</div>
									@endif

									<td width="49%">
										<div class="form-group">
											<label for="name">Name</label>
											<input type="text" name="name" required maxlength="40" data-parsley-trigger="keyup" class="form-control" id="name" placeholder="Enter name">
											@if($errors->has('name'))
											<p class="vali-error" style=" color:#fc5454; font-size: 12px; ">{{ $errors->first('name') }}</p>
											@endif
										</div>

										<div class="form-group">
											<label for="email">Email address</label>
											<input type="email" class="form-control" maxlength="50"  name="email" id="email" required data-parsley-type="email" data-parsley-trigger="keyup" data-parsley-error-message="Incorrect email format" placeholder="Enter email">
											@if($errors->has('email'))
											{{-- <p class="vali-error" style=" color:#fc5454; font-size: 12px; ">{{ $errors->first('email') }}</p> --}}
											@endif
										</div>

									</td>
									<td width="2%"></td>
									<td width="49%">
										<div class="form-group">
											<label for="company">Company</label>
											<input type="text" class="form-control" name="company" maxlength="191" id="company" required data-parsley="[a-zA-Z]+$" data-parsley-error-message="This value length is invalid" data-parsley-trigger="keyup" placeholder="Enter company">
											@if($errors->has('company'))
											<p class="vali-error" style=" color:#fc5454; font-size: 12px; ">{{ $errors->first('company') }}</p>
											@endif
										</div>

										<div class="form-group">
											<label for="tel">Telephone number</label>
											<input type="tel" class="form-control" name="tel" minlength="10" maxlength="11" id="tel" required data-parsley-pattern="[0-9]+$" data-parsley-trigger="keyup" placeholder="Enter tel">
											@if($errors->has('tel'))
											<p class="vali-error" style=" color:#fc5454; font-size: 12px; ">{{ $errors->first('tel') }}</p>
											@endif
										</div>

									</td>
								</tr>
							</table>

							<div>
								<button type="submit" name="CreateAccount" value="CreateAccount" class="btn btn-success" style="display: inline;">Create Account</button>
								{{-- <span class="text-danger invalid-form-error-message1"></span> --}}
							</div>
							

						</form>


					</div>

				</div>
			</div>
		</div>

	</div>  
</div>