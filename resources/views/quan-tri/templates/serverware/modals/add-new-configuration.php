<form method="GET" action="{{ route('configuration.create') }}">
    @csrf
    <div id="add-new-product" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add new config product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Choose Product </label>
                        <select id="select-product" name="product" class="form-control">
                                
                        </select>     
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-add" class="btn btn-primary">Add</button>
                    <button type="button" id="btn-cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
            </div>
        </div>
    </div>
</form>
