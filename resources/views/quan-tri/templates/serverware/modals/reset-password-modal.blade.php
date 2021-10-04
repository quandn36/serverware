<form id="form-reset-password" method="POST" action="{{ route('customers.reset-password') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div id="reset-password-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"></h5>
                    <input type="hidden" id="form-reset-password-input-id-customer" name="id">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input id="password" type="password" name="password" class="form-control" 
                                                                              data-parsley-trigger="keyup" 
                                                                              required data-parsley-pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" 
                                                                              data-parsley-pattern-message="Password must contain at least 8 characters, include UPPER/lowercaseand number" 
                                                                              placeholder="Password" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="re_password" required 
                                                                                  onpaste="return false;" 
                                                                                  data-parsley-trigger="keyup" 
                                                                                  data-parsley-pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" 
                                                                                  data-parsley-pattern-message="Password must contain at least 8 characters, include UPPER/lowercaseand number" 
                                                                                  data-parsley-equalto="#password" 
                                                                                  data-parsley-equalto-message="This value not be the same as password" 
                                                                                  placeholder="Confirm Password" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-add" class="btn btn-primary">Save</button>
                    <button type="button" id="btn-cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
            </div>
        </div>
    </div>
</form>
