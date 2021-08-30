<?php
class Ads extends config{

	public function updatedate_1(){
	
		$id = $_POST['id'];
		$val = $_POST['val'];
  
		mysqli_query($this->mysqlConfig(),"UPDATE `pic_addpost` SET `pic_validity_auto` = $val,`pic_validity` = '' WHERE `pic_addpost`.`pic_ads_id` = $id");
		echo $val."sasa";
	
	}
	public function updatedate_2(){
	
		$id = $_POST['id'];
		$values = $_POST['values'];
  
		mysqli_query($this->mysqlConfig(),"UPDATE `pic_addpost` SET `pic_validity_auto` = '0',`pic_validity` = '$values' WHERE `pic_addpost`.`pic_ads_id` = $id");
		echo "<script>alert('Validity Set Successfully');</script>";
	
	}
	public function Ads_Add_tag_insert(){
	
		$tags = $_POST['search_tags'];
		mysqli_query($this->mysqlConfig(),"UPDATE  `pic_addpost` SET  `pic_admin_tag` =  '".$tags."' WHERE  `pic_addpost`.`pic_id` =".$_REQUEST['id']."");
		echo "<script>alert('Tags Set Successfully');
window.location.href='index.php?action=view&module=Ads&post=list';
</script>";
	
	}
	public function Ads_Add_picture(){
	
		$pic_no= $_POST['pic_no'];
		$id= $_POST['id'];
		for($i=1;$i<$pic_no;$i++){
		$j = $i+1;
		mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_addpost_images` (`addpost_id`, `ad_image_name`, `ad_image_url`, `ad_image_title`, `ad_image_desc`, `ad_image_order`) VALUES ('$id', '', '', '', '', '$j')");
		
		}
		echo "<script>alert('Tags Set Successfully');
window.location.href='index.php?action=view&module=Ads&post=list';
</script>";
		
	
	}
	
	 public function Ads_Add_active_insert(){
	
		
		mysqli_query($this->mysqlConfig(),"UPDATE  `pic_addpost` SET  `addpost_status` =  '0' WHERE  `pic_addpost`.`pic_id` =".$_REQUEST['id']."");
		echo "<script>alert('Ads Activated');
window.location.href='index.php?action=view&module=Ads&post=list';
</script>";
	
	} public function Ads_Add_deactive_insert(){
	
		
		mysqli_query($this->mysqlConfig(),"UPDATE  `pic_addpost` SET  `addpost_status` =  '1' WHERE  `pic_addpost`.`pic_id` =".$_REQUEST['id']."");
		echo "<script>alert('Ads De-Activated');
window.location.href='index.php?action=view&module=Ads&post=list';
</script>";


			
	
	} 
	public function update(){
	
		
		$ad_id_unique=$_POST['id'];
		$pro_title = $_POST['pro_title'];
		$pro_price = $_POST['pro_price'];
		$pro_description = $_POST['pro_description'];
		$pro_tag = $_POST['pro_tag'];
		
		$category_id = $_POST['category_id'];
		$postdate = date("Y-m-d H:i:s");
		
		if($_POST['scheme']==0){
			$scheme_free = $_POST['scheme'];
			$scheme_pay = 0;
		}
		else{
			$scheme_free = 0;
			$scheme_pay = $_POST['scheme'];
		}
		
		if(!empty($_SESSION['pic']['biscuit']['userid'])){
			$userid = $_SESSION['pic']['biscuit']['userid'];
			$email = $_SESSION['pic']['biscuit']['email'];
			
			$user_query = mysqli_query($this->mysqlConfig(),"select * from pic_user where user_id=$userid");
			$user_fetch = mysqli_fetch_object($user_query);
			
			$full_name = $user_fetch->user_username;
			$mobile_no = $user_fetch->user_mobile;
			$usertype = $user_fetch->user_type;
			$city = $user_fetch->user_city;
			$taluk_select= $user_fetch->user_taluk;
			$town= $user_fetch->user_town;
			$lan= $user_fetch->user_lan;
			$lon= $user_fetch->user_lon;
			
		}
		else{
			$userid = 0;
			$email = $_POST['email'];
			$full_name = $_POST['name'];
			$mobile_no = $_POST['mobile'];
			$usertype = $_POST['areYou'];
			$city = $_POST['city'];
			$taluk_select= $_POST['taluk_select'];
			$town= $_POST['town'];
			
			if(isset($taluk_select)){
				$location_query = mysqli_query($this->mysqlConfig(),"select * from pic_geometric where city2='".$taluk_select."' limit 1");
				$location_fetch = mysqli_fetch_object($location_query);
				$lan = $location_fetch->lan;
				$lon = $location_fetch->lon;
			}
			
			
		}
		
		
		// insert common field table
		mysqli_query($this->mysqlConfig(),"update pic_addpost set pic_title='$pro_title',pic_category='$category_id',pic_price='$pro_price',pic_discription='$pro_description',pic_postdate='$postdate',pic_is_freeads='$scheme_free',addpost_scheme_user_id='$scheme_pay' where pic_ads_id='$ad_id_unique' ");
		
		// update scheme table
		if($scheme_pay!=0){
		
			$select_scheme_user = mysqli_query($this->mysqlConfig(),"select pic_scheme_balance_qty from pic_scheme_user where pic_scheme_user_id = $scheme_pay");
			$scheme_user_row = mysqli_fetch_object($select_scheme_user);
			$scheme_balance_qty = $scheme_user_row->pic_scheme_balance_qty - 1;
			
			//mysqli_query($this->mysqlConfig(),"UPDATE `pic_scheme_user` SET `pic_scheme_balance_qty` = '$scheme_balance_qty' WHERE `pic_scheme_user_id` = $scheme_pay");
		}
		
		// insert multiple field table
		$temp="";
		$field_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=$category_id ORDER BY field_priority ASC");
		while($row=mysqli_fetch_object($field_query)){
		
		$value = str_replace(" ","_",$row->fields_title);
		if($temp!=$value){
		$fields_value = $_REQUEST[$value];
		
		//mysqli_query($this->mysqlConfig(),"update pic_addpost_field set addpost_fields_categories_id='$category_id',addpost_fields_title='$row->fields_title',addpost_fields_type='$row->fields_type',addpost_fields_value='$fields_value',field_id='$row->fields_id' where  addpost_uni_id='$ad_id_unique' ");
		
		$fields_value = "";
		}
		$temp = $value;
		}
		
		// insert multiple image field table & multiple upload
		$max_size = 2000*2000; // 200kb
		$extensions = array('jpeg', 'jpg', 'gif');
		$dir = '../media/';
		$dir_thum = '../media/thumnails/';
		$count = 0;
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_FILES['files']))
		{
		// loop all files
		foreach ( $_FILES['files']['name'] as $i => $name )
		{
		// if file not uploaded then skip it
		if ( !is_uploaded_file($_FILES['files']['tmp_name'][$i]) )
		continue;
		
		// skip large files
		if ( $_FILES['files']['size'][$i] >= $max_size )
		continue;
		
		// skip unprotected files
		if( !in_array(pathinfo($name, PATHINFO_EXTENSION), $extensions) )
		continue;
		
		// now we can move uploaded files
		$name = microtime().$name;
		$name = str_replace(" ","_",$name);
		
		if( move_uploaded_file($_FILES["files"]["tmp_name"][$i], $dir . $name) ){
		copy("../media/".$name."", "../media/thumnails/".$name."");
		copy("../media/".$name."", "../media/small/".$name."");
		$dateStart = date("d-m-Y", time());
		mysqli_query($this->mysqlConfig(),"update pic_addpost_images set ad_image_name='$name',ad_image_url='$name' where addpost_id='$ad_id_unique' ");
		
		}
		
		$add="media/thumnails/".$name."";
		
		$n_width=350;          // Fix the width of the thumb nail images
		$n_height=350;
		if ($_FILES["files"]['type'][$i]=="image/gif"){
		
			
			$im=ImageCreateFromGIF($add);
			$width=ImageSx($im);              // Original picture width is stored
			$height=ImageSy($im);                  // Original picture height is stored
			$n_height=($n_width/$width) * $height; // Add this line to maintain aspect ratio
			$newimage=imagecreatetruecolor($n_width,$n_height);
			imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
		
		if (function_exists("imagegif")) {
			Header("Content-type: image/gif");
			ImageGIF($newimage,$add);
		}
		elseif (function_exists("imagejpeg")) {
			Header("Content-type: image/jpeg");
			ImageJPEG($newimage,$add);
		}
		chmod("$add",0777);
		
		}
		
		////////////// starting of JPG thumb nail creation//////////
		if($_FILES["files"]['type'][$i]=="image/jpeg"){
			
			$im=ImageCreateFromJPEG($add); 
			$width=ImageSx($im);              // Original picture width is stored
			$height=ImageSy($im);             // Original picture height is stored
			$n_height=($n_width/$width) * $height; // Add this line to maintain aspect ratio
			$newimage=imagecreatetruecolor($n_width,$n_height);                 
			imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
			ImageJpeg($newimage,$add);
			chmod("$add",0777);
		}
		
		$add="../media/small/".$name."";
		
		$n_width=100;          // Fix the width of the thumb nail images
		$n_height=100;
		if ($_FILES["files"]['type'][$i]=="image/gif"){
		
			
			$im=ImageCreateFromGIF($add);
			$width=ImageSx($im);              // Original picture width is stored
			$height=ImageSy($im);                  // Original picture height is stored
			$n_height=($n_width/$width) * $height; // Add this line to maintain aspect ratio
			$newimage=imagecreatetruecolor($n_width,$n_height);
			imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
		
		if (function_exists("imagegif")) {
			Header("Content-type: image/gif");
			ImageGIF($newimage,$add);
		}
		elseif (function_exists("imagejpeg")) {
			Header("Content-type: image/jpeg");
			ImageJPEG($newimage,$add);
		}
		chmod("$add",0777);
		
		}
		
		////////////// starting of JPG thumb nail creation//////////
		if($_FILES["files"]['type'][$i]=="image/jpeg"){
			
			$im=ImageCreateFromJPEG($add); 
			$width=ImageSx($im);              // Original picture width is stored
			$height=ImageSy($im);             // Original picture height is stored
			$n_height=($n_width/$width) * $height; // Add this line to maintain aspect ratio
			$newimage=imagecreatetruecolor($n_width,$n_height);                 
			imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
			ImageJpeg($newimage,$add);
			chmod("$add",0777);
		}
		
		
		$count++;
		
		
		
		}
		}
		
		echo "<script>alert('Updated Succesfully');
window.location.href='index.php?action=view&module=Ads&post=list';
</script>";

		
		//notification mail to owner of the category
		$category_id = "|".$category_id."|";
		$city = "|".$city ."|";
		$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_user where privacy_category LIKE '%{$category_id}%' and privacy_location LIKE '%{$city }%'");
		
		require("helper/mailing/mailing.php");
	        $mailing= new mailing();
	       
			        
			       
				
		
		while($row=mysqli_fetch_object($categories_query )){
		
		 $sub = "Mr.".$full_name."";
		
		 $info = "Dear ".$row->user_username.",

Mr.".$full_name." Update Advertisment into your Category

Please Check the given information

Ads ID :  ".$ad_id_unique."

Contact Name : ".$full_name."

Contact No : ".$mobile_no."

kindly regards,
PIC Team";

			        
				//$mailing->mail_send($row->user_email,$sub,$info);
				
		
		}
		
		
	
	}
	
	public function update_field(){
	
	$vale = $_POST['value'];
	 
	mysqli_query($this->mysqlConfig(),"UPDATE  `pic_addpost_field` SET  `addpost_fields_value` =  '$vale' WHERE  `pic_addpost_field`.`addpost_field_id` =".$_REQUEST['id']."");
	
	}
	
	public function update_status(){
	
	 $vale = $_REQUEST['val'];
	if($vale==1 or $vale==0){ 
	
	mysqli_query($this->mysqlConfig(),"UPDATE `pic_addpost` SET  `addpost_status` =  '$vale' WHERE  `pic_id` =".$_REQUEST['id']."");
	
	echo '<script language="javascript">';
echo 'alert("message successfully sent")';
echo '</script>';

	}
	
	}
	
	public function delete(){
	
	$vale = $_POST['value'];
	 
	mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_addpost` WHERE `pic_ads_id` = ".$_REQUEST['id']."");
	mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_addpost_field` WHERE `addpost_uni_id` = ".$_REQUEST['id']."");
	mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_addpost_images` WHERE `addpost_id` = ".$_REQUEST['id']."");
	mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_likes` WHERE `likes_product_id` = ".$_REQUEST['id']."");
	
	echo "<script>alert('Success');
</script>";
	
	}
	public function deleterefund(){
	
		 
	
	
	$user_id = $_REQUEST['user_id'];
	
	
        $query_customer = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_addpost` where pic_ads_id=".$_REQUEST['id']."");
        $row_refer = mysqli_fetch_object($query_customer);
        
        
	$query = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_scheme_user` where pic_user_id=".$row_refer->pic_refer_id." and `payment_status`= 'Approved' and `pic_scheme_balance_qty`!= 0 ORDER BY  `pic_scheme_balance_qty` asc limit 1 ");
	
	$row = mysqli_fetch_object($query);
	
	$sum_total = $row->pic_scheme_balance_qty+1;
	
	mysqli_query($this->mysqlConfig(),"UPDATE  `pic_scheme_user` SET  `pic_scheme_balance_qty` =  '$sum_total' WHERE  `pic_scheme_user_id` =$row->pic_scheme_user_id");
	
	mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_addpost` WHERE `pic_addpost`.`pic_ads_id` = ".$_REQUEST['id']."");
	mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_addpost_field` WHERE `pic_addpost_field`.`addpost_uni_id` = ".$_REQUEST['id']."");
	mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_likes` WHERE `likes_product_id` = ".$_REQUEST['id']."");
	
	echo "<script>alert('Ads Successfully Removed and Refunded');
window.location.href='index.php?action=view&module=Ads&post=list';
</script>";

	
	}
	
	
}
?>
	