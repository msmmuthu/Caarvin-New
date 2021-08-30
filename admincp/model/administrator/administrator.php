<?php
class administrator extends config{


 	public function validity_add(){ 
			$title= $_POST['title'];
			$dates= $_POST['dates'];
			mysqli_query($this->mysqlConfig(),"UPDATE `pic_validity` SET `pic_validity_label` = '$title', `pic_validity_date` = '$dates' WHERE `pic_validity_id` = 1;");
    	}

    
    public function edit(){ 
    
	if(!empty($_POST['mod']) and is_array($_POST['mod'])) {
	$user_type.=implode(' | ',$_POST['mod']);
	}
	$id = $_POST['id'];
	$title= $_POST['title'];
	$password= $_POST['password'];
	mysqli_query($this->mysqlConfig(),"UPDATE `pic_admin`  set `admin_sets`='$user_type',`admin_username`='$title',`admin_password`='$password' where `admin_id`=$id");
       	}
	
 public function add(){ 
    
	if(!empty($_POST['mod']) and is_array($_POST['mod'])) {
	$user_type.=implode(' | ',$_POST['mod']);
	}
	$title= $_POST['title'];
	$password= $_POST['password'];
       	mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_admin` (`admin_sets`, `admin_username`, `admin_password`) VALUES ('$user_type', '$title', '$password')");
    	}
	
	public function usertype_edit(){ 
    
    //mysqli_query($this->mysqlConfig(),"UPDATE `pic_user_type`  set `status`=0");
    
    $user_id = $_POST['id'];
    $title= $_POST['title'];
    
	if(!empty($_POST['act']) and is_array($_POST['act'])) {
	$user_type.=implode(' | ',$_POST['act']);
	}
          
	if(!empty($_POST['cat']) and is_array($_POST['cat'])) {
	$user_category.=implode(',',$_POST['cat']);
	}
		       
		        mysqli_query($this->mysqlConfig(),"UPDATE `pic_user_type`  set `setoption`='$user_type',`setcategory`='$user_category',user_type='$title' where `user_id`=$user_id");
    
	}
	


}
?>