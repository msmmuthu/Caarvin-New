<?php
class ajax extends misc{
    
    
    public function ajax_select_introduce_id() {
        $id = str_replace("AWM","",strtoupper($_REQUEST['txt']));  
        if (strpos(strtoupper($_REQUEST['txt']), 'AWM') !== false and is_numeric($id)) {
           

      
      $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `members` where member_id = ".$id." and members_entry_id=2");
      $row = mysqli_fetch_array($query);
     if(!empty($row['member_id']) and $_REQUEST['id']!=$row['member_id']){
         ?>
<span class="badge badge-success">Available</span> <?php echo $row['member_name']; ?>
<input required="" type="hidden" name="members_introduce_id" value="<?php echo $row['member_id']; ?>">
        
        <?php
     }
     else{
         ?>
       <span class="badge badge-danger">Introduce ID not available</span>
       <input style="display: none;" required="" type="text" name="members_introduce_id" value="">
       <?php
     }
    }
    else{
        ?>
       <span class="badge badge-danger">Invalid introduce id format</span>
       <?php
    }
     } 
     public function business_details() {
        $id = $_REQUEST['id'];
        $query = mysqli_query($this->mysqlConfig(),"SELECT * from business where business_id=".$id."");
        $row = mysqli_fetch_array($query);
        //$title = 'Add Business Entry';

        //$business_name = $row['business_name'];
        $business_code = $row['business_code'];
        $business_type_id = $row['business_type_id'];
        $business_value = $row['business_value'];
        $business_pts = $row['business_pts'];
         ?>
       
       <div class="form-row">
              <label for="business_code">Business Code</label>
              <input type="text" class="form-control" id="business_code" name="business_code" value="<?php echo $business_code; ?>" disabled="">
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
       
       <div class="form-row">
              <label for="business_type_id">Business Type</label>
              <select class="custom-select" id="business_type_id" name="business_type_id" disabled="">
                <option selected disabled value="">Choose Type</option>
                <?php
                $misc = new misc();
                $misc->business_type($business_type_id,'','','business_type_name','business_type_id');
                ?>
              </select>
              <div class="invalid-feedback">
                Please select a valid state.
              </div>
            </div>
            
            <div class="form-row">
              <label for="name">Business Value</label>
              <input type="text" class="form-control" id="name" name="business_value" value="<?php echo $business_value; ?>" disabled="">
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="form-row">
              <label for="name">Business Points</label>
              <input type="text" class="form-control" id="name" name="business_pts" value="<?php echo $business_pts; ?>" disabled="">
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
       <div class="form-row">
            <label for="be_qty">Quantity</label>
            <input type="number" class="form-control" id="be_qty" name="be_qty" value="" required="" onchange="total_point(this,<?php echo $business_pts; ?>,<?php echo $business_value; ?>);">
            <div class="valid-feedback">
            Looks good!
            </div>
            </div>
       <div class="form-row">
            <label for="name">Total Point</label>
            <input type="text" class="form-control" id="be_total_point2" name="be_total_point2" value="" required="">
            <div class="valid-feedback">
            Looks good!
            </div>
            </div>
                    
            <div class="form-row">
            <label for="name">Total Values</label>
            <input type="text" class="form-control" id="be_value2" name="be_value2" value="" required="">
            <div class="valid-feedback">
            Looks good!
            </div>
            </div>
         
         <?php
     }
     public function label_select_full($id,$members_label_id,$members_level_id) {
     //echo $id.",".$members_label_id.",".$members_level_id;
         ?>
        <div class="form-row pt-2">
        <label for="members_label_id">Label</label>
              <select class="custom-select" id="members_label_id_2" name="members_label_id" required onchange="upline_select(this);">
                <option selected disabled value="">Choose Label</option>
                <?php
                $this->label_select_for_managers($members_label_id,$id);
                ?>
              </select>
              <div class="invalid-feedback">
                Please select a valid level.
              </div>
         </div>
        
        <?php
     }
      public function label_select_mapping() {
          $id = $_REQUEST['id'];
         ?>
<label class="pt-2" for="members_label_id">Mapping Label</label>
        <div class="form-row">
        
        <select data-style="btn-secondary" multiple="" class="selectpicker" data-live-search="true" id="members_label_id" name="members_label_id[]" >
                
                <?php
                $this->label_select_mapping_misc($id);
                ?>
              </select>
              <div class="invalid-feedback">
                Please select a valid level.
              </div>
         </div>
        
        <?php
     }
     
     public function upline_select_full() {
     
         ?>
         <form class="needs-validation" novalidate method="post" action="index.php">
        <input type="hidden" name="module" value="member">
        <input type="hidden" name="action" value="view">
        <input type="hidden" name="post" value="map">
        <input type="hidden" name="mid" value="<?php echo $_REQUEST['mid'];?>">
        <div class="form-row pt-2">
        <label for="members_label_id">Mapping up line ID</label>
              <select class="custom-select" id="members_mapping_up_line_id" name="members_mapping_up_line_id" required>
                <option selected disabled value="">Choose Manager</option>
                <?php
                $this->manager_select();
                ?>
              </select>
              <div class="invalid-feedback">
                Please select a valid level.
              </div>
         </div>
        <div class="form-row pt-2">
            <button class="btn btn-primary btn-sm " type="submit">Save</button>
        </div>
        
         </form>
        <?php
     }
     
   
}

        ?>