<?php
class user extends config{

    
    public function usertype_list(){ 
    
    mysqli_query($this->mysqlConfig(),"UPDATE `pic_user_type`  set `status`=0");
    
    
    foreach ($_POST['usertype_allow'] as $usertype )
		{
		       
		        mysqli_query($this->mysqlConfig(),"UPDATE `pic_user_type`  set `status`=1 where `user_id`='$usertype'");
		}
    
    
    
   
    
	}
	
 public function usertype_add(){ 
    
    if(!empty($_POST['act']) and is_array($_POST['act'])) {
            $user_type.=implode(' | ',$_POST['act']);
          }
    $title = $_POST['title'];
    $status = $_POST['status'];
    
   mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_user_type` (`user_type`, `setoption`, `status`) VALUES ('$title', '$user_type', '$status')");
    
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
	
	if(!empty($_POST['cat_view']) and is_array($_POST['cat_view'])) {
	$cat_view.=implode(',',$_POST['cat_view']);
	}
		       
		        mysqli_query($this->mysqlConfig(),"UPDATE `pic_user_type`  set `setoption`='$user_type',`setcategory`='$user_category',`setcat_view`='$cat_view',user_type='$title' where `user_id`=$user_id");
    
	}
	


}
?>