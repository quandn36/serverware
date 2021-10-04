<hr class="divider-blank" />
<div class="container">
  <div class="row">
    <div class="col-md-7">
        <div class="panel panel-primary">
          <div class="panel-heading">Contact Form</div>
          <div class="panel-body">
            <form role="form" method="post">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="49%">

                  <div class="form-group">
                      <label class="control-label" for="name">Name</label>
                      <input type="text" class="form-control validate" name="name" placeholder="Enter name" value="" >
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="email">Email address</label>
                      <input type="email" class="form-control validate" name="email" placeholder="Enter email" value="">
                    </div>

                    </td>
                  <td width="2%"></td>
                  <td width="49%">
                  <div class="form-group">
                      <label class="control-label" for="company">Company</label>
                      <input type="text" class="form-control validate" name="company" placeholder="Enter company name" value="">
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="tel">Telephone number</label>
                      <input type="tel" class="form-control validate" name="tel" placeholder="Enter tel" value="">
                    </div>

                   </td>
                </tr>
              </table>

              <div class="form-group">
                <label class="control-label" for="comments">Comments</label>
                <textarea name="comments" class="form-control validate" placeholder="Your enquiry..." rows="3"></textarea>
              </div>

              <button type="submit" class="btn btn-success" name="submit" id="send_button">Submit Enquiry</button>
              <input type="hidden" name="captcha" id="captcha" />
                          </form>

         <script>

		// On unfocus of all inputs
		$('input.validate').on({
			keyup: function() { validate(); },
			blur:  function() { validate(); },
			focus: function() { validate(); }
		});

		function validate()
		{
			has_error = 0;

			// For each input
			$("input.validate").each(function() {
				if( $(this).val()!='' )
				{
					$(this).closest( ".form-group" ).addClass("has-success");
				}
				else
				{
					$(this).closest( ".form-group" ).addClass("has-warning");
					has_error = 1;
				}
			});

			//alert(has_error);
			if(has_error==1)
			{
				//alert("has_error");
				$("#send_button").attr("disabled", true);
			}
			else
			{
				//alert("no error");
				$("#captcha").val("Monday341");
				$("#send_button").attr("disabled", false);
			}
		}

		 </script>


          </div>
        </div>
      </div>
    <div class="col-md-5">
      <div class="panel panel-default panel-center">
        <div class="panel-heading">
          <h3 class="panel-title">Contact Server Warehouse</h3>
        </div>
        <li class="list-group-item">
          <strong>Broadberry USA LLC</strong><br>
          8297 Champions Gate Blvd<br>
          Suite 391<br>
          Champions Gate<br>
          FL 33896
          </address>
        </li>
        <li class="list-group-item"><abbr title="Phone Number"  class="text-muted">Tel:</abbr> (+1)800-496-9918</li>
        <li class="list-group-item"><a href="mailto: sales@serverwarehouse.co.uk">sales@serverwarehouse.com</a></li>
      </div>
    </div>
    <div class="col-md-4">

    </div>
  </div>
</div>