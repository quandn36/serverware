<form id="form-new-config">
<div id="choose-accessories-product" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                <div id="mainnav" >
                                    <label>Choose category <span class="required">*</span></label>
                                    <ul id="load-category" >
                                      
                                           @foreach ($accessoryCategories as $category)
                                                <li id="{{ $category->id }}" class="item-li" >
                                                    <a  class="choose-category"   onclick="accessories({{ $category->id }});" >
                                                      {{ $category->name }}
                                                    </a>
                                                    <ul id="ul{{ $category->id }}" class="sub-menu">
                                                    @foreach ($category->childrenCategories as $childCategory)
                                                         @include(config('template.cmsTemplateBladeURL') . 'includes.child-category',['child_category' => $childCategory, 'id_group'=> 0])
                                                    @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                    </ul> 
                                </div>
                                <div id="alert-erros-category" class="row form-row" style="display: none;">
                                </div>
                               
                                <div id="load-table-accessory" class="row form-row">
                                    
                                    
                                </div>
                            </div>
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
