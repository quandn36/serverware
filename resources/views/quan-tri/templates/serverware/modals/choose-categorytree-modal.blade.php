<form method="POST" action="{{ route('product-categories.store') }}">
    @csrf
    <div id="choose-categorytree-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Category </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row modal-body">

                    <div class="col-md-6 form-group">
                        <label>Choose Category tree</label>
                        <select id="select-categorytrees" name="category_tree_id"  class="form-control" >
                        </select>     
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Category Name </label>
                        <input type="text" name="name" class="form-control">   
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" id="accept-status" class="btn btn-primary">Accept</button>
                    <button type="button" id="btn-cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
            </div>
        </div>
    </div>
</form>
