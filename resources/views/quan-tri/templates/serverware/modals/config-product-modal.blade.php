<form id="form-new-config">
<div id="config-product-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add new group config type</h5>
                    <input id="myRowConfigModal" type="hidden" >
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="my-group">
                        <div id="group-config-row-0-modal" class="row fix-config-group">
                            <div  class="col-md-12">
                                <a  class="del-row-group-config" onclick="del_row_group(0);">X</a>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Attribute name </label>
                                    <input id="name-group-0" type="text" name="name_group_0" class="form-control">   
                                </div>
                            </div>
                           
                            <div id="load-item" class="col-md-12">
                                <!-- Load item-->
                            </div>
                            <button type="button" class="btn btn-primary" id="btn-add-item-group-cofig" onclick="addItem(0);">
                                 +add item 
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" id="btn-add-group-cofig" >+add item group</button>
                        <div id="group-item-config">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-accept-config" class="btn btn-primary">
                    <p style="display: none;"></p>
                    Accept</button>
                    <button type="button" id="btn-cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
            </div>
    </div>
</div>
</form>
