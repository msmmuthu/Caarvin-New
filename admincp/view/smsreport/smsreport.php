<?php
class smsreport extends config{

	
	
	public function index(){ ?>
	
	    <div class="container">
		
        
		
                <div class="row">
                    
                <div class="col-12 pt-4">
		
                    <h4>SMS Reports</h4>
       
      
	
	<table id="myTable" class="table table-striped table-bordered">
	<thead>
  <tr>
   
    <th><strong>Liked Customer</strong></th>
     <th><strong>Message</strong></th>
      <th><strong>Date</strong></th>
   
  </tr>
  </thead>
  <tbody>
  <?php
  $id = $_REQUEST['id'];
  $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_sms` where sms_profile_id=".$id." ORDER BY `sms_id` DESC");
  while($row = mysqli_fetch_array($query)){
  
  ?>
  <tr>
    <td>PA00<?php echo $row['sms_from_id']; ?></td>
    <td><?php echo $row['sms_msg']; ?></td>
    <td><?php echo $row['sms_date']; ?></td>
  </tr>
  
  
 <?php 
 }
  ?>
  </tbody>
</table>


</div>
</div>
            </div>
	
    <?php
    }
	
	
	
	
	

}
?>

