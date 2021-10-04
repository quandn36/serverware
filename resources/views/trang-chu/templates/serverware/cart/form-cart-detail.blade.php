<form method="post">
    @for($i=0; $i<6; $i++)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="basket-system-name">Your Configured HPE ProLiant DL380 Gen10 - 24 Bay SFF 24x 2.5  </div>
        </div>
        <div class="panel-body">
            <div class="row basket-table">
                    <div class="col-md-3">
                        <img src="{{ asset(config('template.homeTemplateURL')  . 'img/system_images/dl380-g10-sff-24.jpg') }}" style="max-width: 260px; max-height: 80px; margin-top: 25px;">
                    </div>
                    <div class="col-md-7">
                        <div class="basket-quote-source"></div>   
                        <div>
                            <table class="table table-condensed system-specs-overview">
                                <tbody>
                                    <tr>
                                        <td class="system-specs-overview-l">HP Base Server</td>
                                        <td>HPE ProLiant DL380 Gen10 24 SFF Base Server</td>
                                    </tr>
                                    <tr>
                                        <td class="system-specs-overview-l">Power Supplies</td>
                                        <td>HPE 500W Flex Slot Platinum Hot Plug Low Halogen Power Supply</td>
                                    </tr>
                                    <tr>
                                        <td class="system-specs-overview-l">Processors</td>
                                        <td>HPE DL380 Gen10 Intel Xeon-Bronze 3204 (1.9GHz/6-core/85W) Processor Kit</td>
                                    </tr>
                                    <tr>
                                        <td class="system-specs-overview-l">Memory</td>
                                        <td>HPE 8GB (1x8GB) Single Rank x8 DDR4-2933 CAS-21-21-21 Registered Smart Memory Kit</td>
                                    </tr>
                                    <tr>
                                        <td class="system-specs-overview-l">Storage Controllers</td>
                                        <td>HPE Smart Array P408i-a SR Gen10 (8 Internal Lanes/2GB Cache) 12G SAS Modular Controller</td>
                                    </tr>
                                    <tr>
                                        <td class="system-specs-overview-l">Expander</td>
                                        <td>HP 12Gb SAS Expander Card with Cables for DL380 Gen10</td>
                                    </tr>
                                    <tr>
                                        <td class="system-specs-overview-l">Embedded Management</td>
                                        <td>HPE iLO Standard with Intelligent Provisioning</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-2">
                        
                        <div class="basket-price">$4,491.72</div>                        
                        
                        <div class="input-group">
                            <input type="text" class="form-control" name="update_qty[47344]" value="1" style="text-align:center;">
                            <span class="input-group-btn">
                                <a href="basket.php?delete=47344" class="btn btn-default"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </span>
                        </div>
                        
                        <div style="margin-top: 5px;"><a href="/system_items.php?system_id=dl380-g10-sff-24&amp;basket=47344" class="btn btn-success btn-block">Re-Configure</a></div>                           
                                                
                    </div>
            </div> 
        </div>
    </div>
    @endfor
    <div class="basket-total">Subtotal: <strong>$4,491.72</strong></div><div class="well clearfix"><input type="submit" name="update_cart" value="Update Cart" class="btn btn-primary pull-left"><a href="index.php" class="btn btn-primary pull-right"><i class="fa fa-arrow-right" aria-hidden="true"></i> Checkout</a></div>
</form>