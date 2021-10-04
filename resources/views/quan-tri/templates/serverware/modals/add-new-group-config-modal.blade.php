<form id="form-new-config">
<div id="add-new-group-config-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add new config</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="load-list-config">
                    <div id="config-row-0">
                        <div class="col-md-12">
                             <div class="form-group">
                                <div class="fix-title-config" style="display: flex; justify-content: space-between;">
                                     <label>name config 1</label>
                                     <a class="del-row-config">
                                        <!--thẻ p lưu id-->
                                        <p style="display: none;">0</p>
                                        <i class="fas fa-eraser" style="font-size: 20px;"></i>
                                    </a>
                                </div>
                                <input id="name-config-0" type="text" name="configurations[]" class="form-control" required>   
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" id="btn-a-cofig" class="btn btn-success waves-effect waves-light mb-4">+add a config</button>
                                <div id="load-list-item-config">
                                </div>
                            </div>
                            <div class="invalid-form-error-message"></div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-accept-config" class="btn btn-primary">Accept
                </button>
                <button type="button" id="btn-cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
        </div>
    </div>
</div>
</form>
