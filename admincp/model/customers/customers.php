<?php
class customers extends config{

public function inserts(){

	$cat = $_POST['cat'];
	$register = $_POST['register'];
	$cat_privacy="";
	foreach ($cat as $cats)
		{
		        $cat_privacy.="|".$cats;
		}
	$cat_privacy.="|";
	
	$loc = $_POST['loc'];
	$loc_privacy="";
	foreach ($loc as $locs)
		{
		        $loc_privacy.="|".$locs;
		}
	$loc_privacy.="|";
	
	$id = $_POST['idd'];
	
	mysqli_query($this->mysqlConfig(),"UPDATE `pic_user`  set `privacy_category`='$cat_privacy', `privacy_location`='$loc_privacy', `privacy_register`=$register where `user_id`='$id'");
	
	  echo "<script>alert('Updated Successfully');
window.location.href='index.php?action=view&module=customer';
</script>";
	
	
}

public function agentDelete(){ 

 $id_agent = $_REQUEST['id'];
  $post = $_REQUEST['post'];
  
  mysqli_query($this->mysqlConfig(),"DELETE pic_addpost , pic_addpost_field FROM pic_addpost INNER JOIN pic_addpost_field ON pic_addpost_field.addpost_uni_id = pic_addpost.pic_ads_id WHERE pic_addpost.pic_user_id = $id_agent");
  
  mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_user` WHERE `pic_user`.`user_id` = $id_agent");
  
  mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_scheme_user` WHERE `pic_user_id` = $id_agent"); 
	?>
    
     
    <td colspan="11" align="center"><div style="background:#FF0000;border-radius:2px;color: #fff;width: auto;text-align: center;padding: 15px;">Deleted</div></td>
     
     <?php

    }
    

public function agentAccept(){
	
  $id_agent = $_REQUEST['id'];
  $post = $_REQUEST['post'];
  mysqli_query($this->mysqlConfig(),"UPDATE `pic_user` SET  `user_status`=$post WHERE  `pic_user`.`user_id`=$id_agent");
  ?>
 
  <?php if($post==1){ ?>
    <div style="background:#00CC33;border-radius:2px;color: #fff;width: 100%;text-align: center;padding: 15px;">Accepted</div>
     <?php } else { ?>
     <div style="background:#FF0000;border-radius:2px;color: #fff;width: 100%;text-align: center;padding: 15px;">Rejected</div>
     <?php } ?>
     
  <?php
  

    }
    
    public function smsAccept(){ ?>
	
	    <div class="content">
		
		<div class="nav" align="center">
		SMS Accepted
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:100%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px;">
	
  <?php
  $id_agent = $_REQUEST['id'];
  $post = $_REQUEST['smspost'];
  mysqli_query($this->mysqlConfig(),"UPDATE `pic_user` SET  `user_sms`=$post WHERE  `pic_user`.`user_id`=$id_agent");
  ?>
 
</div>
</div>
</div>
	
    <?php
    echo "<script>alert('Updated Successfully!');
window.location.href='index.php?action=view&module=customer';
</script>";

    }

}
?>