<?php
class customer extends config{

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
          <a class="nav-link" href="customer_export.php">Export Customer</a>
        
      </li>
    
     
    </ul>
  </div>
</nav>
<?php
    }
	
	public function customerList(){ ?>
	
	    <div class="container">
		
        
		
		
		<div class="row">
       <div class="col-12 pt-4">
      <?php $this->header('Customer Management'); ?>
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
	#circle_green {
	width: 10px;
	height: 10px;
	background: green;
	-moz-border-radius: 50px;
	-webkit-border-radius: 50px;
	border-radius: 50px;
	float:left;
	margin: 2px;
	}
	#circle_red {
	width: 10px;
	height: 10px;
	background: red;
	-moz-border-radius: 50px;
	-webkit-border-radius: 50px;
	border-radius: 50px;
	float:left;
	margin: 2px;
	}

   </style>
	<table id="myTable" class="table table-striped table-bordered">
	<thead>
  <tr>
<!--   <th><div align="center"><strong><input type="checkbox" id="selectAll" class="main"></strong></div></th>-->
    <th><strong>Unique ID</strong></th>
    <th width="10%"><strong>Customer Details</strong></th>
    <th width="5%"><strong>Location</strong></th>
    <th width="5%"><strong>Refered</strong></th>
	<th width="10%" align="center"><strong>User Type</strong></th>
	<th width="10%" align="center"><strong>Privacy</strong></th>
    <th width="10%" align="center"><strong>SMS</strong></th>
    <th width="10%" align="center"><strong>Status</strong></th>
    <th width="15%"  align="center"><strong>Action</strong></th>
    <th width="15%"  align="center"><strong>Action</strong></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $customer_query = mysqli_query($this->mysqlConfig(),"select * from pic_user ORDER BY `user_id` DESC");
  $no = 1;
  while($row = mysqli_fetch_array($customer_query)){
  $id_agent = $row['user_id'];
  ?>
  <tr id="tr_<?php echo $id_agent; ?>">

    <td>PA00<?php echo $row['user_id']; ?></td>
    <td>
    <div><img style="border:5px solid #ccc;" class=""  src="<?php echo $row['user_pic']; ?>" ></div>
    <div><?php echo $row['user_username']; ?></div>
      <div><?php if($row['email_status']==1){ ?> <div id="circle_green"></div> <?php } else { ?><div id="circle_red"></div> <?php } ?>&nbsp;<strong>Email :</strong> <?php echo $row['user_email']; ?></div>
      <div><?php if($row['mobile_status']==1){ ?> <div id="circle_green"></div> <?php } else { ?><div id="circle_red"></div> <?php } ?>&nbsp;<strong>Mobile :</strong> <?php echo $row['user_mobile']; ?></div>
      <div><strong>Password :</strong> <?php echo $row['user_password']; ?></div></td>
      <td><?php echo $row['user_taluk']; ?></td>
   <td><a href="index.php?action=view&module=reference&id=<?php echo $row['user_id']; ?>"><?php echo $row['user_refer']; ?></a></td><td><?php echo $row['user_type']; ?></td>
	<td align="center"><div class="link_href"><a href="index.php?action=view&module=customers&id=<?php echo $row['user_id']; ?>">Set</a></div></td>
     <td align="center"><div style="background: #333333;border-radius:2px;padding:2px;margin: 5px 0px;"><a style="color: #fff;" href="index.php?action=view&module=smsreport&id=<?php echo $row['user_id']; ?>">REPORTS</a></span></div><div style="background: #333333;border-radius:2px;padding:2px;margin: 5px 0px;"><a style="color: #fff;" href="index.php?action=view&module=sms&id=<?php echo $row['user_id']; ?>">SETTING</a></span></div><?php if($row['user_sms']==0){ ?><div style="background:#FF0000;border-radius:2px;padding:2px;"><a style="color: #fff;" href="index.php?action=model&module=customers&id=<?php echo $id_agent; ?>&smspost=1">OFF</a></span></div>  <?php } else { ?> <div style="background:#00CC33;border-radius:2px;padding:2px;"><a style="color: #fff;" href="index.php?action=model&module=customers&id=<?php echo $id_agent; ?>&smspost=0">ON</a></div><?php } ?></td>
    
    <td  align="center"><?php if($row['user_status']==1){ ?><div style="background:#00CC33;border-radius:2px;padding:2px;color: #fff;">Active</span></div>  <?php } else { ?> <div style="background:#FF0000;border-radius:2px;padding:2px;color: #fff;">Idle!</div><?php } ?></td>
     <td align="center"><div class="link_href"><a href="#"><?php if($row['user_status']==1){ ?> <div class="link_href">
     <a href="javascript:void(0)" id="<?php echo $id_agent; ?>" name="0" onclick="updateAjax(this);">Cancel</a></div>  <?php } else { ?> <div class="link_href"><a href="javascript:void(0)" id="<?php echo $id_agent; ?>" name="1" onclick="updateAjax(this);">Accept</a></div><?php } ?></a></div></td>
     
    <td align="center"><div class="link_href"><a href="#"><?php if($row['user_status']==1){ ?> <div class="link_href"><a href="javascript:void(0)" id="<?php echo $id_agent; ?>" name="2" onclick="updateAjax(this);">Delete</a></div>  <?php } else { ?> <div class="link_href"><a href="javascript:void(0)" id="<?php echo $id_agent; ?>" name="2" onclick="updateAjax(this);">Decline</a></div><?php } ?></a></div></td>
  </tr>
  
  
 <?php 
 $no++;
 }
  ?>
  </tbody>
</table>

</div>
</div>
</div>
	
    <?php
    }
	
	public function customerList_privacy(){ ?>
	
	    <div class="content">
		
		<div class="nav">
		Customer Management Privacy Setting
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:100%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px;">
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
	<table id="rows" width="100%" border="0">
  <tr>
    <td ><strong>Category</strong></td>
    <td >
	<?php $customer_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories");
	?>
	<select name="cat" class="form_txt" id="cat"  >
	<?php 
	while($row = mysqli_fetch_array($customer_query)){?>
	
                    <option value="<?php echo $row['categories_name']; ?>" ><?php echo $row['categories_name']; ?></option>
<?php 
	}
	?>
					</select>
				</td></tr><tr>
    <td ><strong>Location</strong></td>
	<td ><?php $customer_query1 = mysqli_query($this->mysqlConfig(),"select * from pic_location");
	?>
	<select name="loc" class="form_txt" id="loc"  >
	<?php 
	while($row1 = mysqli_fetch_array($customer_query1)){?>
	
                     <option value="<?php echo $row1['location_name']; ?>" ><?php echo $row1['location_name']; ?></option>
<?php 
	}
	?>
					</select></td></tr><tr>
	<td colspan="2"><input type="submit" name="save_cat" id="save_cat" value="Submit" class="form_btn" ></td></tr>
 
</table>
</form>
</div>
</div>
</div>
	
    <?php
    }
	
	
	

}
?>

