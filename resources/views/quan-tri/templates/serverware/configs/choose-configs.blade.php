@extends(config('template.cmsTemplateBladeURL') . 'layout')
@section('main-content')

<form action="{{ route('configs.store') }}" method="POST" onsubmit="return CheckSoluong()">
	@csrf
	<div class="row">
		<div class="col-lg-8">
			<div class="card m-b-30">
				<div class="card-body">
					<div class="form-group row">
						<label for="select__document" class="col-sm-3 mr-0 col-form-label ">Product's categories</label>
						<div class="col-sm-12">
							<div class="multiselect">
								<div id="document__arrow" class="selectBox" onclick="showMultiCheckbox()">
									<select id="select__document" class="form-control select__file mb-3 "
									style="border-radius: 0px;padding-left: 10px;">
									<option class="filename">Choose parent category display into homepage
									</option>
								</select>
								<div class="overSelect">
									<img id="document__arrow3" class="document__arrow" src="../assets/img/Polygon 1.svg" alt="">
								</div>

							</div>
							<div id="multicheckbox" style="display: none;border: 1px solid #ced4da;border-top:none;margin-top: -35px;padding: 5px 10px;">
								<?php $i = 1; foreach($allParentCate as $value){ ?>
								<div class="custom-control custom-checkbox document__block-checkbox" >
									<input type="checkbox" name="check[]" class="custom-control-input" id='customCheck<?=$i?>'
									value="{{ $value->id }}" hidden>
									<label class="custom-control-label document__checkbox-name"
									for='customCheck<?=$i?>'>{{ $value->name }}</label>
								</div>
								<?php $i++; } ?>

							</div>
						</div>
					</div>
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
<link href="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('page-js')
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/alertify/js/alertify.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'assets/pages/alertify-init.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset(config('template.cmsTemplateURL'). 'plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('page-custom-js')
<script type="text/javascript">
      // show message
      @if (session('status'))
      alertify.success("Choose parent category successfully");
      @endif

      // Show name input checked
      var strp = '';
      var select = 0;
      $(".custom-control-input").change(function () {
      	var pid = this.id;
      	var text = $("label[for='" + pid + "']").text();
      	var item = '<p class="' + pid + '">' + text + ', </p>';
      	if ($(this).is(':checked') === true) {
      		strp += item;
      		select++;
      	}
      	if ($(this).is(':checked') === false) {
      		var start = strp.lastIndexOf(item);
      		var start2 = item.length + start;
      		var tmp = '';
      		tmp = strp.slice(0, start);
      		tmp += strp.slice(start2)
      		strp = tmp;
      		$('p').remove("." + pid);
      		select--;
      	}

      	if (strp.length < 150) {
      		$(".filename").html(strp);
      	} else {
      		$(".filename").html("There are " + select + " selected parent categories");
      	}
      });

      var expanded = false;
      function showMultiCheckbox() {
      	var multicheckbox = document.getElementById("multicheckbox");
      	if (!expanded) {
      		multicheckbox.style.display = "block";
      		expanded = true;
      	} else {
      		multicheckbox.style.display = "none";
      		expanded = false;
      	}
      }
      // limit checkbox list menu

      $("input:checkbox").click(function() {
      	var bol = $("input:checkbox:checked").length == 3;     
      	$("input:checkbox").not(":checked").attr("disabled",bol);
      });

      function CheckSoluong()
      {
      	var numberOfChecked = $('input:checkbox:checked').length;
      	if (numberOfChecked == 3) {
      		return true;
      	}else{
      		alertify.alert('Choose at least 3 parent categories', 'Alert Message!', function(){ alertify.success('Ok'); });
      		return false;
      	}
      }
</script>
@endsection