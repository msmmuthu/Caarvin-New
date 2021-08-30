<?php
class customers extends config{

public function customerList_privacy(){ 

?>
	
	    <div class="container">
		
		
		
		<div class="row">
        
                    <div class="col-12 pt-4">
                        <h4>Customer Management Privacy Setting</h4>
	<style type="text/css">
   #rows tr>th{
	padding:5px;
	border-style:solid;
	border-width:thin;
	border-color:#999999;
   }
   #rows tr>td{
	padding:5px;
	border-style:solid;
	border-width:thin;
	border-color:#999999;
   }
   a{
	text-decoration:none;
	}
   </style>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="cat_pri" id="cat_pri" method="post" >
    <?php 
    $query = mysqli_query($this->mysqlConfig(),"select * from pic_user where user_id=".$_GET['id']." limit 1");
	$row_user = mysqli_fetch_array($query );
	?>
	
    <?php
   
    ?>
        <table class="table" id="rows" width="100%" border="0">
  <tr>
    <td ><strong>Category</strong></td>
    <td >
	<?php 
	 $customer_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_parent=0");
	?>
	<select name="cat[]" size="10" multiple class="form-control" id="cat"  >
	<?php 
	while($row = mysqli_fetch_array($customer_query)){?>
	?>
                    <option <?php if(strpos($row_user ['privacy_category'], $row['categories_id']) !== false){ ?> selected="selected" <?php } ?> value="<?php echo $row['categories_id']; ?>" ><?php echo $row['categories_name']; ?></option>
<?php 
	}
	?>
			  </select>
			</td></tr>
			
              <tr>
    <td ><strong>Taluk</strong></td>
	<td ><?php $customer_query1 = mysqli_query($this->mysqlConfig(),"select distinct city2 from pic_geometric");
	?>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-select.min.css" />
    
  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap-select.min.js"></script>
    
            
            
            <div class="form-group">
            <select data-live-search="true" class="selectpicker form-control" name="loc[]" size="10" multiple="multiple" id="loc">
				<?php 
                while($row1 = mysqli_fetch_array($customer_query1)){?>
                ?>
                <option  data-tokens="<?php echo $row1['city2']; ?>" <?php if(strpos($row_user ['privacy_location'], $row1['city2']) !== false){ ?> selected="selected" <?php } ?> value="<?php echo $row1['city2']; ?>" > <?php echo $row1['city2']; ?></option>
                <?php 
                }
                ?>
            </select>
            </div>


            
	</td></tr>
    <tr>
   <td ><strong>Allow Signup</strong></td>
	<td>
             
            
           
            <input id="exampleRadios1" class="form-check-input" type="radio" name="register" id="register"  <?php if($row_user['privacy_register']==1){ ?> checked="checked" <?php } ?> value="1" /> <label class="form-check-label" for="exampleRadios1"> Yes</label>
            <input id="exampleRadios2" class="form-check-input" type="radio" name="register" id="register"  <?php if($row_user['privacy_register']==0){ ?> checked="checked" <?php } ?> value="0" /> <label class="form-check-label" for="exampleRadios2"> No</label>
                       </td>
    </tr>
             
					<tr>
	<td colspan="2"><input style="display:none;" type="text" name="idd" id="idd" value="<?php echo $_GET['id']; ?>"  ><input type="hidden" name="action" value="model" />
             <input type="hidden" name="module" value="customers" /></td></tr>
					
					<tr>
	<td colspan="2"><input type="submit" name="save_cat" id="save_cat" value="Submit" class="btn btn-primary" ></td></tr>
	
</table>
</form>
</div>
</div>
</div>
	
    <?php
    }
	
	

}
?>