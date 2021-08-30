<?php
class scheme extends config{

	public function request_list(){ ?>
	
	<script>
$(document).ready(function() {
$('#example1').DataTable({
"order": [[ 0, "desc" ]]
});
} );
</script>
	
	    <div class="container">
		
		
		
		<div class="row">
        
        
        <div class="col-12 pt-4">
        <?php $this->header('Scheme Request'); ?>
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
  
	<table id="myTable" class="table table-striped table-bordered">
    <thead>
  <tr>
   
    <th width="2%"><strong>No</strong></th>
    <th width="10%"><strong>Date</strong></th>
    <th width="10%"><strong>Location</strong></th>
	<th width="10%" align="center"><strong>Introducer ID</strong></th>
	<th width="10%" align="center"><strong>Customer ID</strong></th>
    <th width="10%" align="center"><strong>Balance Ads</strong></th>
   
    <th width="20%" align="center"><strong>Scheme</strong></th>
    <th width="10%" align="center"><strong>Sending Details</strong></th>
    <th width="10%" align="center"><strong>Mobile</strong></th>
    <th width="10%" align="center"><strong>Email</strong></th>
    <th width="10%" align="center"><strong>Status</strong></th>
    <th width="10%" align="center"><strong>Cash ID</strong></th>

  </tr>
  </thead>
  <tbody>
  <?php
  $customer_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_scheme_user` ORDER BY `pic_scheme_user_id` DESC");
  
  while($row = mysqli_fetch_array($customer_query)){
  
  $id_user = $row['pic_user_id'];
  
  $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_user` where user_id=$id_user");
  
  $list = mysqli_fetch_object($query)
  
  
  ?>
  <tr>
   
    <td><?php echo $row['pic_scheme_user_id']; ?></td>
    <td><?php echo date('d-m-Y', strtotime($row['scheme_purchased_date'])); ?></td>
    <td><?php echo $list->user_town.", ".$list->user_taluk.", ".$list->user_city; ?></td>
     
    <td><?php echo $list->user_refer; ?><?php //echo "PACID".$id_user; ?></td>
    <td><?php echo $list->user_id_unique; ?></td>
     
    <td><?php echo $row['pic_scheme_balance_qty']; ?></td>
    <td><?php echo $row['pic_scheme_name']; ?>, <?php echo $row['pic_scheme_desc']; ?></td>
     
    <td><?php echo $row['payment_method']; ?></td>
    <td><?php echo $list->user_mobile; ?></td>
    <td><?php echo $list->user_email; ?></td>
    <td><?php echo $row['payment_status']; ?></td>

    <td><a href="index.php?action=view&module=scheme&post=approve&id=<?php echo $row['scheme_cash_id']; ?>"><?php echo $row['scheme_cash_id']; ?></a></td>
    
	
    
     
    
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
	
	public function approve(){ ?>
	
	    <div class="container">
		
		
		
		<div class="row">
        
                    <div  class="col-12 pt-4">
        
       <?php
	   $id = $_REQUEST['id'];
	    $customer_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_scheme_user` where scheme_cash_id='$id'");
		$row = mysqli_fetch_array($customer_query);
                $this->header('Scheme Request');
	   ?>
	<form  name="add_scheme" method="post" action="index.php">
       <input type="hidden" name="module" value="scheme" />
       <input type="hidden" name="action" value="model" />
       <input type="hidden" name="id" value="<?php echo $row['pic_scheme_user_id'] ?>" />
       <input type="hidden" name="post" value="approved" />
       
       <table class="table" width="100%" border="0">
           <tr>
             <td><div align="right">Received Date</div></td>
             <td><label>
                     <input class="form-control" readonly="readonly" type="text" name="dates" id="dates" value="<?php echo date('d-m-Y', strtotime($row['scheme_purchased_date'])); ?>" />
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Payment Details</div></td>
             <td><label>
               <input class="form-control" readonly="readonly" type="text" name="payment_details" id="payment_details" value="<?php echo $row['payment_details']; ?>" />
             </label></td>
           </tr>
            <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
            <tr>
             <td><div align="right">Payment Remarks</div></td>
             <td><label>
               <textarea class="form-control" name="remarks" id="remarks" placeholder="Entering Remarks here to Customers"><?php echo $row['payment_remarks'] ?></textarea>
             </label></td>
           </tr>
            <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           
           <tr>
             <td><div align="right">Amount</div></td>
             <td><label>
               <input class="form-control" type="text" name="amt" id="amt" value="<?php echo $row['cost_scheme'] ?>" />
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Allocate Qty</div></td>
             <td><input class="form-control" type="text" name="qty" id="qty" value="<?php echo $row['pic_scheme_balance_qty'] ?>" /></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Photo limit</div></td>
             <td><input class="form-control" type="text" name="photo_limit" id="photo_limit" value="<?php echo $row['photo_limit'] ?>" /></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Ads Valid Days</div></td>
             <td><input class="form-control" type="text" name="ads_valid" id="ads_valid" value="<?php echo $row['ads_valid'] ?>" /></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Status</div></td>
             <td>
                 <select class="form-control" name="payment_status">
             <option value="Approved" <?php if($row['payment_status']=="Approved") { ?> selected <?php } ?>>Approved</option>
             <option value="Pending" <?php if($row['payment_status']=="Pending") { ?> selected <?php } ?>>Pending</option>
             <option value="Cancelled" <?php if($row['payment_status']=="Cancelled") { ?> selected <?php } ?>>Cancelled</option>
             
             </select>
             </td>
           </tr>
           
           
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td></td>
             <td>
               <div align="left">
                 <input type="submit" name="save" id="save" value="Save" class="btn btn-primary">
               </div></td>
           </tr>
           
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
         </table>
       </form>
	

</div>
</div>
</div>
	
    <?php
    }
	
	public function add(){ ?>
	
	    <div class="container">
		
		
		
		<div class="row">
        
                    <div  class="col-6 pt-4" >
     <?php $this->header('Adding New Scheme'); ?>
       <form  name="add_scheme" method="post" action="index.php">
       <input type="hidden" name="module" value="scheme" />
       <input type="hidden" name="action" value="model" />
       <input type="hidden" name="post" value="insert" />
       
       <table class="table" width="100%" border="0">
           <tr>
             <td><div align="right">Scheme Name</div></td>
             <td><label>
                     <input class="form-control" type="text" name="name" id="name" />
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Scheme Description</div></td>
             <td><label>
               <textarea class="form-control" name="desc" id="desc" cols="45" rows="5"></textarea>
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Qty</div></td>
             <td><input class="form-control" type="text" name="qty" id="qty" /></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Price</div></td>
             <td><input class="form-control" type="text" name="price" id="price" /></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Photo Limit</div></td>
             <td><input class="form-control" type="number" name="scheme_photo" id="scheme_photo" /></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Ads Valid Days</div></td>
             <td><input class="form-control" type="number" name="scheme_valid" id="scheme_photo" /></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td></td>
             <td>
               <div align="left">
                 <input type="submit" name="save" id="save" value="Save" class="btn btn-primary">
               </div></td>
           </tr>
           
         
         </table>
       </form>
       </div>
</div>
</div>
	
    <?php
    }
	public function header($txt) {
       
	
        ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <a class="navbar-brand" href="#"><?php echo $txt; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
          
        <a class="nav-link" href="customer_scheme.php">Export Scheme</a>
      </li>
   
     
    </ul>
  </div>
</nav>
<?php
    }
	public function list_scheme(){ ?>
	
	    <div class="container">
		
		
		
		<div class="row">
        
                    <div class="col-12 pt-4">
                        
                        <h4>Listing All Schemes</h4>
        
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
	<table id="myTable" class="table table-striped table-bordered">
    <thead>
  <tr>
   
    <th width="10%"><strong>Date</strong></th>
    <th width="10%"><strong>Scheme Name</strong></th>
	<th width="10%" align="center"><strong>Description</strong></th>
	<th width="10%" align="center"><strong>Qty</strong></th>
    <th width="10%" align="center"><strong>Price</strong></th>
    <th width="10%" align="center"><strong>Action</strong></th>
    <th width="10%" align="center"><strong>Action</strong></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_scheme`");
  
  while($row = mysqli_fetch_array($query)){
  
  ?>
  <tr>
   
    <td><?php echo date('d-m-Y', strtotime($row['scheme_date'])); ?></td>
    <td><?php echo $row['scheme_name']; ?></td>
     
    <td><?php echo $row['scheme_desc']; ?></td>
    <td><?php echo $row['scheme_ads_qty']; ?></td>
     
    <td><?php echo $row['scheme_price']; ?></td>
    <td align="center"><?php if($row['scheme_status']==1){ ?><a class="btn" href="index.php?action=model&module=scheme&post=0&process=activate&id=<?php echo $row['scheme_id']; ?>"><div style="background:#00CC33;border-radius:2px;padding:2px;">Active</div></a><?php } else { ?> <a class="btn" href="index.php?action=model&module=scheme&post=1&process=activate&id=<?php echo $row['scheme_id']; ?>"><div style="background:#FF0000;border-radius:2px;padding:2px;">Idle!</div></a><?php } ?></td><td>
        <a class="btn btn-danger" href="index.php?action=model&module=scheme&post=delete&id=<?php echo $row['scheme_id']; ?>">Delete</a>
    </td>
     
   
    
	
    
     
    
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