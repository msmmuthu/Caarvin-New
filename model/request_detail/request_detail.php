<?php

class request_detail extends config{


    public function details() {
    
    }
    
     public function like() {
     
     $ipadr = $this->get_client_ip();
     $cus_name = $_POST['cus_name'];
     $cus_mobileno= $_POST['cus_mobileno'];
     $cus_email= $_POST['cus_email'];
     $ads_id= $_POST['ads_id'];
     $ads_user_id = $_POST['ads_user_id'];
	 $cus_conatctno = $_POST['cus_conatctno'];
	 $ads_type = $_POST['ads_type'];
	 
     
     
     if(!empty($_SESSION['pic']['biscuit']['userid'])){
     
     $cus_id = $_SESSION['pic']['biscuit']['userid'];
     
     }
     else{
     
     $cus_id = "UNKNOWN";
      
     }
      
     
     $like_insert_query = mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_likes` (`likes_product_id`, `likes_cus_id`, `likes_cus_ip`, `likes_cus_name`, `likes_cus_mobile`, `likes_cus_email`,`likes_ads_user_id`,`contact_no`) VALUES ('$ads_id', '$cus_id', '$ipadr', '$cus_name', '$cus_mobileno', '$cus_email', '$ads_user_id','$cus_conatctno')");
	 
	$this->smslike($ads_id,$cus_name,$cus_mobileno);
	
     
     //todo
	 if($ads_type == "product_detail"){
	 print "<script>";
     print "window.location.href = 'index.php?action=view&module=product_detail&ads_id=$ads_id'; ";
     print "</script>";
	 }elseif($ads_type == "request_detail") {
	 print "<script>";
     print "window.location.href = 'index.php?action=view&module=request_detail&ads_id=$ads_id'; ";
     print "</script>";
	 }
    
    }
	
	function smslike($adsid,$cus_name,$cus_mobileno){
	
	$query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_addpost` where pic_ads_id='".$adsid."'");
	$row = mysqli_fetch_object($query);
	
	
	
	$query_sms = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_sms` WHERE  `sms_profile_id`=".$row->pic_user_id." and DATE(`sms_date`) = DATE(NOW())");
	$sms_count = mysqli_num_rows($query_sms);
	
	$query_user = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_user` where user_id=".$row->pic_user_id." and user_sms=1");
	$row_user = mysqli_fetch_object($query_user);
	
	$from_id = $_SESSION['pic']['biscuit']['userid'];
	
	$user_sms_total = $row_user->user_sms_total;
	
	//echo $row_user->user_sms_day;
		if($row_user->user_sms_day > $sms_count){
		
			require("helper/sms/sms.php");
			$sms= new sms();
			
			$msg = "Your Ads are Liked by ".$cus_name."(".$cus_mobileno."). Please your check the Ads Id is ".$adsid."";
			$sms->sms_send($row->pic_user_mobile,$msg);
			$dates = date('Y-m-d');
			
			mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_sms` (`sms_from_id`,`sms_msg`,`sms_profile_id`,`sms_date`) VALUES (".$from_id.",'".$msg."',".$row->pic_user_id.",'".$dates."')");
			
			$user_sms_total = $user_sms_total-1;
			
			mysqli_query($this->mysqlConfig(),"UPDATE `pic_user` SET `user_sms_total` = '$user_sms_total' WHERE `user_id` = $row->pic_user_id;");
		
		}
		elseif($row_user->user_sms_day == $sms_count and $row_user->user_sms==1){
		
			require("helper/sms/sms.php");
			$sms= new sms();
			
			$msg = "Your Ads are Liked. Please check your LIKE Report in your Account";
			$sms->sms_send($row->pic_user_mobile,$msg);
			$dates = date('Y-m-d');
			
			mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_sms` (`sms_from_id`,`sms_msg`,`sms_profile_id`,`sms_date`) VALUES (".$from_id.",'".$msg."',".$row->pic_user_id.",'".$dates."')");
			
			$user_sms_total = $user_sms_total-1;
			
			mysqli_query($this->mysqlConfig(),"UPDATE `pic_user` SET `user_sms_total` = '$user_sms_total' WHERE `user_id` = $row->pic_user_id;");
		
		}
	
	}
    
    function get_client_ip() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

}
?>