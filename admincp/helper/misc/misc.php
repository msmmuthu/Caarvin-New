<?php
class misc extends config{
    
   
    public function option_value($type,$selected) {
        $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `helper_data` where helper_data_type = ".$type."");
        while($row = mysqli_fetch_array($query)){
            ?>
        <option <?php if($row['helper_data_id']==$selected){ echo "selected"; } else {  } ?> value="<?php echo $row['helper_data_id']; ?>"><?php echo $row['helper_data_values']; ?></option>
        <?php
        }
     }
     
     public function radio_value($type,$checked,$company_type) {
          $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `helper_data` where helper_data_type = ".$type."");
        while($row = mysqli_fetch_array($query)){
         ?>
        <input <?php if($row['helper_data_id']==$checked){ echo "checked"; } else {  } ?> class="form-check-input" type="radio" name="<?php echo $company_type; ?>" id="exampleRadios<?php echo $row['helper_data_id']; ?>" value="<?php echo $row['helper_data_id']; ?>" checked>
                <label class="form-check-label" for="exampleRadios<?php echo $row['helper_data_id']; ?>">
                  <?php echo $row['helper_data_values']; ?>
                </label>
        </br>
        <?php
        }
     }
     
     public function modal() {
         ?>
         <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-body">
                        <div id="upload-demo" class="center-block"></div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
                        </div>
                        </div>
                        </div>
                        </div>
        
        <div id="alertmodal" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-body tx-center pd-y-10 pd-x-10">
        <div class="d-flex flex-row-reverse">
            <div class="">
                <a style="color: #dd1c1c;padding: 0px;cursor: pointer;" class="btn btn-az-danger btn-rounded btn-block" data-dismiss="modal"><i style="font-size: 18px;" class="fa fa-times-circle"></i></a>
            </div>
        </div>
            
        <div id="dynamicalert"></div><!-- modal-body -->
        </div>
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div>
        <div id="displayprofile" class="modal">
      <div class="modal-dialog modal-lg" role="document">
      
      
        <div class="modal-content">
        <div class="modal-body tx-center pd-y-20 pd-x-30">
        
        <div class="d-flex flex-row-reverse">
        
        <div class="">
            <a style="color: #dd1c1c;padding: 0px;cursor: pointer;" class="btn btn-az-danger btn-rounded btn-block" data-dismiss="modal"><i style="font-size: 18px;" class="fa fa-times-circle"></i></a>
                      
                 
                    </div>
                    
                    <div class="pr-3">
                    <!--<button id="save" class="btn btn-az-primary btn-rounded btn-block"><i class="fa fa-save"></i> Update</button>-->
                    
                    </div>
                    
                    
         </div>
                    
          <div  id="dynamicdisplay">
          
     
    </div><!-- modal-body -->
    </div>
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div>
        <?php
     }
     
     
    
}

        ?>