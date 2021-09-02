<?php

class account extends config{
    
   
    

	public function logincheck(){
	
		
            
           

			$id=$_POST['username'];
			$id=mysqli_real_escape_string($this->mysqlConfig(),$id);
			$pw=$_POST['pass'];
			
			
			$query=mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_user WHERE (user_id_unique='$id' OR user_email='$id') AND user_password='$pw' AND user_status=1");
			
			$main = new indexcontroller();
			
			if(mysqli_num_rows($query)==1){
			
				$row = mysqli_fetch_array($query);
				
				require("config/session/session.php");
				$session = new session();
				$session -> create($row['user_id'],$row['user_username'],$row['user_email'],$row['user_city'],$row['user_taluk'],$row['user_town'],$row['user_lan'],$row['user_lon']);
				print "<script>";
				print "window.location.href = 'index.php'; ";
				print "</script>";
				
                                
                                
				
			}
			else{
			
			
				print "<script>";
				print "window.location.href = 'index.php?action=view&module=account&post=login_submit&error=yes'; ";
				print "</script>";
				
			}
		
		
	
	
	}
	
	public function emailvalidate(){
	
	$val = $_REQUEST['val'];
	
	$user_types=mysqli_query($this->mysqlConfig(),"select * from pic_user where email_val='$val' ");
	$row = mysqli_fetch_object($user_types);
	$utype = $row->user_type;
	
	$user_types_query=mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_user_type` where user_type='$utype'"); 
	$row_user_types = mysqli_fetch_object($user_types_query);
	$uType = $row_user_types->setoption;
	
	if(strpos($uType, 'auto approve') !== false){ 
	
	$user_status = 1;
	
	} else {
	
	$user_status = 0;
	
	}
		
	$query=mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_user WHERE email_val='$val'");
	if(mysqli_num_rows($query)==1){
	mysqli_query($this->mysqlConfig(),"UPDATE `pic_user` SET  `email_status` =  '1',`user_status` =  '$user_status' WHERE email_val='$val'");
	
		?>
		<div class="rows">
			<div class="container">
				<div class="bor">
					<div class="account-left">
		                    
			<h3>Email Validated Successfully!</h3>
			
					</div>
				</div>
			</div>
		</div>
		<?php
		
	}
	
	else{ ?>
	
		<div class="rows">
			<div class="container">
				<div class="bor">
					<div class="account-left">
		                    
			<h3>Invalid Validation Link!</h3>
			
					</div>
				</div>
			</div>
		</div>
	
	<?php
	
	}
	
	}
	
	public function smsValidated(){
	
	$val = $_REQUEST['smscode'];
	
	$user_types=mysqli_query($this->mysqlConfig(),"select * from pic_user where mobile_val='$val' ");
	$row = mysqli_fetch_object($user_types);
	$utype = $row->user_type;
	
	$user_types_query=mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_user_type` where user_type='$utype'"); 
	$row_user_types = mysqli_fetch_object($user_types_query);
	$uType = $row_user_types->setoption;
	
	if(strpos($uType, 'auto approve') !== false){ 
	
	$user_status = 1;
	
	} else {
	
	$user_status = 0;
	
	}
		
	$query=mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_user WHERE mobile_val='$val'");
	if(mysqli_num_rows($query)==1){
	mysqli_query($this->mysqlConfig(),"UPDATE `pic_user` SET  `mobile_status` =  '1',`user_status` =  '$user_status' WHERE mobile_val='$val'");
	
		?>
		<div class="rows">
			<div class="container">
				<div class="bor">
					<div class="account-left">
		                    
			<h3>Mobile Number Validated Successfully!</h3>
			
					</div>
				</div>
			</div>
		</div>
		<?php
		
	}
	
	else{ ?>
	
		<div class="rows">
			<div class="container">
				<div class="bor">
					<div class="account-left">
		                    
			<h3>Invalid Validation Code!</h3>
			
					</div>
				</div>
			</div>
		</div>
	
	<?php
	
	}
	
	}
	
	public function checkUserId(){
	
		$id=$_POST['id'];
		$query=mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_user WHERE user_id_unique='$id'");
		if(mysqli_num_rows($query)==1){ ?> <span style="color: #fff;background: #fb2106;padding: 2px;">Not Available</span> <?php } else {?> <span style="color: #fff;background: #135907;padding: 2px;">Available</span> <?php }
	
	}
	
	public function register(){
                            if(empty($_POST['refer'])){
                                $refer1=$_POST['usr'];
                            }
                            else{
                                $refer1=$_POST['refer'];
                            }
			
                        
			$text = strtolower($refer1);
			$refer= str_replace('pa00', '', $text);
	
			$areYou1=$_POST['areYou'];
			foreach ($areYou1 as $areYous){

$areYou=$areYous;

}
			$name=$_POST['name'];
			$id=$_POST['email'];
			$pw=$_POST['pass'];
			$mobile=$_POST['mobile'];
			$city=$_POST['city_header_profile'];
			$taluk_select=$_POST['taluk_select'];
			$town=$_POST['townreg'];
			$userid=$_POST['userid'];
			
			// $location_query = mysqli_query($this->mysqlConfig(),"select * from pic_geometric where city1='".$city."' and city2='".$taluk_select."' limit 1");
			// $location_fetch = mysqli_fetch_object($location_query);
			
			$lan = $_POST['latreg'] == "" ? $location_fetch->lan: $_POST['latreg'];;
			$lon = $_POST['lonreg'] == "" ? $location_fetch->lon : $_POST['lonreg'];;
				
			$city=$_POST['city_header_profile'];
			
			$query_username=mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_user WHERE user_email='$id'");
			$query_mobile=mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_user WHERE user_mobile='$mobile'");
			
			$query_ref=mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_user WHERE user_status=1 and user_id=$refer and user_type='Appraiser'");
			
			
			
			if(mysqli_num_rows($query_mobile)==1 or mysqli_num_rows($query_username)==1 or mysqli_num_rows($query_ref)==0){
			if(mysqli_num_rows($query_username)==1){
			
				
				print "<script>";
				print "window.location.href = 'index.php?action=view&module=user_list&post=add&error_username=yes'; ";
				print "</script>";
			
			}
			
			elseif(mysqli_num_rows($query_mobile)==1){
			
				print "<script>";
				print "window.location.href = 'index.php?action=view&module=user_list&post=add&error_mobile=yes'; ";
				print "</script>";
			
			}
			elseif(mysqli_num_rows($query_ref)==0){
			
				print "<script>";
				print "alert('$refer1 is not Appraiser');";
				print "window.location.href = 'index.php?action=view&module=user_list&post=add'; ";
				print "</script>";
			
			}
			}
			else{
				
				//require("config/session/session.php");
				//$session = new session();
				//$session -> create("",$name,$id);
				//$main->myaccount();
				$milliseconds = microtime(true);
				$serial_no = "PI".$milliseconds."A";
				
				
				$validate_email = $milliseconds."mls".$serial_no."khsfjsdbjfsdD";
				$shuffled_email = str_shuffle($validate_email);
				
				$validate_mobile = "PIC".time()."ADS";
				$shuffled_mobile = str_shuffle($validate_mobile);


				
				// File Upload start
				$fileName = '';
				if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES['fileUpload'])) {
					$fileDirPath = 'media/uploadfiles';
					if (!file_exists($fileDirPath)) {
						mkdir($fileDirPath, 0777, true);
					}
					$fileUploadArr = $_FILES['fileUpload'];
					$fileExt = substr(strrchr($fileUploadArr['name'][0], '.'), 1);
					$fileDirName = $fileDirPath . '/' . time() . '.' . $fileExt;
					$fileName = time() . '.' . $fileExt;
					if (move_uploaded_file($fileUploadArr['tmp_name'][0], $fileDirName)) {
						
					}
				}
				// File upload End
		
                mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_user`( `user_username`, `user_password`, `user_email`, `user_mobile`, `user_city`, `user_type`, `user_status`, `user_taluk`, `user_town`, `user_lan`, `user_lon`,`user_refer`, `email_val`,`mobile_val`,`user_id_unique`, `user_document`) VALUES ('$name','$pw','$id','$mobile','$city','$areYou','0','$taluk_select','$town','$lan','$lon','$refer1','$shuffled_email','$shuffled_mobile','$userid', '$fileName')");
			        




			        require("helper/mailing/mailing.php");
			        $mailing= new mailing();
			        $sub = "Abocarz - Account Created";
			        
			        $info = "Welcome to Abocarz Products & Classified and thank you for registering.

Dear ".$name.",

Your Abocarz Account Details is given Below,
 
User ID  : ".$name."
Password : ".$pw."

Please Click to Validate your Email Address

http://www.picagri.com/index.php?action=model&module=account&post=email&val=".$shuffled_email."

Regards,
Npic Team";

			        
				$mailing->mail_send($id,$sub,$info);
				
				//SMS
				require("helper/sms/sms.php");
			        $sms= new sms();
			        $msg = "Your OTP is ".$shuffled_mobile." for Validate the Mobile No.Please visit the link www.picagri.com/validate"; 
				$sms->sms_send($mobile,$msg);
				
			        ?>
                <div class="alert alert-success" role="alert">
  User added successfully
</div>
                <?php
                               
			}
			
	
	}

}
?>