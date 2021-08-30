<?php
class scheme extends config{

    
	public function approved(){ ?>
	
	    <div class="content">
		
		<div class="nav">
		Approve Scheme
		</div>
		
		<div class="main" style="padding:25px; " >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:100%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px;height:100px">
        <div align="left"><a class="btn_sub" href="index.php?action=view&module=scheme&post=request_list">Requested Scheme</a></div>
       <div align="left"><a class="btn_sub" href="index.php?action=view&module=scheme&post=add">Add New Scheme</a></div>
       <div align="left"><a class="btn_sub_active" href="index.php?action=view&module=scheme&post=list">List All Scheme</a></div>
       <?php
	   $amt = $_REQUEST['amt'];
	   $qty = $_REQUEST['qty'];
	   $id = $_REQUEST['id'];
	   $payment_status= $_REQUEST['payment_status'];
	   $remarks= $_REQUEST['remarks'];
           $photo_limit= $_REQUEST['photo_limit'];
           $ads_valid= $_REQUEST['ads_valid'];
           $scheme_purchased_date = date('Y-m-d');
           $ads_valid_exp= $_REQUEST['ads_valid']+1;
           $expiry = date('Y-m-d', strtotime("+".$ads_valid_exp." days"));
           
	   mysqli_query($this->mysqlConfig(),"UPDATE `pic_scheme_user` SET `total_ads` = '$qty',`pic_scheme_balance_qty` = '$qty', `cost_scheme` = '$amt', `payment_status` = '$payment_status',`photo_limit` = '$photo_limit', `ads_valid` = '$ads_valid',`scheme_approval_date` = '$scheme_purchased_date',`scheme_expiry` = '$expiry' WHERE `pic_scheme_user`.`pic_scheme_user_id` = $id")
	   ?>
        
        
       </div>
       <div style="border-bottom:1px dotted #666;" align="center"><h2>Scheme Approved &nbsp;&nbsp;<a href="index.php?action=view&module=scheme&post=request_list"> &lArr; Back</a></h2>
       
       </div>
        
</div>
</div>
	
    <?php
    }
	
	public function activate(){ ?>
	
	    <div class="content">
		
		<div class="nav">
		Listing All Schemes
		</div>
		
		<div class="main" style="padding:25px; " >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:100%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px;height:100px">
        <div align="left"><a class="btn_sub" href="index.php?action=view&module=scheme&post=request_list">Requested Scheme</a></div>
       <div align="left"><a class="btn_sub" href="index.php?action=view&module=scheme&post=add">Add New Scheme</a></div>
       <div align="left"><a class="btn_sub_active" href="index.php?action=view&module=scheme&post=list">List All Scheme</a></div>
       <?php
	   $post = $_REQUEST['post'];
	   $id = $_REQUEST['id'];
	   mysqli_query($this->mysqlConfig(),"UPDATE `pic_scheme` SET `scheme_status` = '$post' WHERE `pic_scheme`.`scheme_id` = $id")
	   ?>
        
        
       </div>
       <div style="border-bottom:1px dotted #666;" align="center"><h2>Updated Successfully &nbsp;&nbsp;<a href="index.php?action=view&module=scheme&post=list"> &lArr; Back</a></h2>
       
       </div>
        
</div>
</div>
	
    <?php
    }
	
	
	public function Delete(){ ?>
	
	    <div class="content">
		
		<div class="nav">
		Listing All Schemes
		</div>
		
		<div class="main" style="padding:25px; " >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:100%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px;height:100px">
        <div align="left"><a class="btn_sub" href="index.php?action=view&module=scheme&post=request_list">Requested Scheme</a></div>
       <div align="left"><a class="btn_sub" href="index.php?action=view&module=scheme&post=add">Add New Scheme</a></div>
       <div align="left"><a class="btn_sub_active" href="index.php?action=view&module=scheme&post=list">List All Scheme</a></div>
       <?php
	   $id = $_REQUEST['id'];
	   mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_scheme` WHERE `pic_scheme`.`scheme_id` = $id")
	   ?>
        
       </div>
       <div style="border-bottom:1px dotted #666;" align="center"><h2>Deleted Successfully &nbsp;&nbsp;<a href="index.php?action=view&module=scheme&post=list"> &lArr; Back</a></h2>
       
       </div>
        
</div>
</div>
	
    <?php
    }
	
	public function insert(){ ?>
	
	    <div class="content">
		
		<div class="nav">
		Listing All Schemes
		</div>
		
		<div class="main" style="padding:25px; " >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:100%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px;height:100px">
        <div align="left"><a class="btn_sub" href="index.php?action=view&module=scheme&post=request_list">Requested Scheme</a></div>
       <div align="left"><a class="btn_sub" href="index.php?action=view&module=scheme&post=add">Add New Scheme</a></div>
       <div align="left"><a class="btn_sub_active" href="index.php?action=view&module=scheme&post=list">List All Scheme</a></div>
       <?php
	   $scheme_name = $_POST['name'];
	   $scheme_desc = $_POST['desc'];
	   $scheme_ads_qty = $_POST['qty'];
	   $scheme_price =  $_POST['price'];
	   $scheme_date =  date('Y-m-d');
           $scheme_photo =  $_POST['scheme_photo'];
	   
	   mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_scheme` (`scheme_name`, `scheme_desc`, `scheme_ads_qty`, `scheme_price`, `scheme_date`, `scheme_status`, `scheme_photo`) VALUES ('$scheme_name', '$scheme_desc', '$scheme_ads_qty', '$scheme_price', '$scheme_date', '1','$scheme_photo')");
	   
	   ?>
        
       </div>
       <div style="border-bottom:1px dotted #666;" align="center"><h2>Scheme Added Successfully &nbsp;&nbsp;<a href="index.php?action=view&module=scheme&post=list"> &lArr; Back</a></h2>
       
       </div>
        
</div>
</div>
	
    <?php
    }
	
}
?>