<?php
class postad extends config
{

	public function insert()
	{




		$query_ad_id = mysqli_query($this->mysqlConfig(), "select * from pic_addpost order by pic_id desc limit 1");		
		$ad_id = mysqli_fetch_object($query_ad_id);
		
		$userid = $_SESSION['pic']['biscuit']['userid'];
		$user_query = mysqli_query($this->mysqlConfig(), "select * from pic_user where user_id=$userid");
		$user_fetch = mysqli_fetch_object($user_query);		
		// echo "<pre>";
		// print_r($user_fetch);
		// print_r($_POST);
		// exit;

		// All Variables

		$ad_id_unique = time();
		$_SESSION['pic']['biscuit']['ads_id'] = $ad_id_unique;
		$ad_id_unique = $_SESSION['pic']['biscuit']['ads_id'];

		$pro_title = $_POST['pro_title'];
		$pro_price = $_POST['pro_price'];
		$pro_description = $_POST['pro_description'];
		$special = $_REQUEST['special'];
		$pro_tag = $_POST['pro_tag'];
		$lati = $_POST['lati'];
		$longi = $_POST['longi'];
		$multiLocChip = $_POST['multiLocChip'];

		$category_id = $_POST['category_id'];
		$postdate = date("Y-m-d H:i:s");

		if ($_POST['scheme'] == 0) {
			$scheme_free = $_POST['scheme'];
			$scheme_pay = 0;
		} else {
			$scheme_free = 0;
			$scheme_pay = $_POST['scheme'];
		}

		if (!empty($_SESSION['pic']['biscuit']['userid'])) {
			if ($_POST['contact_customer'] == $_SESSION['pic']['biscuit']['userid']) {
				$userid = $_SESSION['pic']['biscuit']['userid'];
				//$email = $_SESSION['pic']['biscuit']['email'];
				$referid = $_SESSION['pic']['biscuit']['userid'];
			} else {
				$userid = $_POST['contact_customer'];
				$referid = $_SESSION['pic']['biscuit']['userid'];
			}
			$user_query = mysqli_query($this->mysqlConfig(), "select * from pic_user where user_id=$userid");
			$user_fetch = mysqli_fetch_object($user_query);

			$full_name = $user_fetch->user_username;
			$email = $user_fetch->user_email;
			$mobile_no = $user_fetch->user_mobile;
			$usertype = $user_fetch->user_type;
			$city = $_POST['city_postadpost'] == "" ? $user_fetch->user_city : $_POST['city_postadpost'];
			$taluk_select = $user_fetch->user_taluk;
			$town = $_POST['townpostadpost'] == "" ? $user_fetch->user_town : $_POST['townpostadpost'];
			$lan = $_POST['lati'] == "" ? $user_fetch->user_lan : $_POST['lati'];
			$lon = $_POST['longi'] == "" ? $user_fetch->user_lon : $_POST['longi'];
			$sms = $_POST['sms'];
			$privacy = $_POST['privacy'];
		} else {
			$userid = 0;
			$email = $_POST['email'];
			$full_name = $_POST['name'];
			$mobile_no = $_POST['mobile'];
			$usertype = $_POST['areYou'];
			$city = $_POST['city'];
			$taluk_select = $_POST['taluk_select'];
			$town = $_POST['town'];
			$sms = $_POST['sms'];

			if (isset($taluk_select)) {
				$location_query = mysqli_query($this->mysqlConfig(), "select * from pic_geometric where city2='" . $taluk_select . "' limit 1");
				$location_fetch = mysqli_fetch_object($location_query);
				$lan = $location_fetch->lan;
				$lon = $location_fetch->lon;
			}
		}


		// insert common field table
		mysqli_query($this->mysqlConfig(), "insert into pic_addpost(pic_title,pic_category,pic_price,pic_discription,pic_postdate,pic_ads_id,pic_is_freeads,addpost_scheme_user_id,pic_user_email,pic_user_id,pic_user_mobile,pic_user_fullname,pic_post_city,pic_add_taluk,pic_add_town,pic_add_lan,pic_add_lon,pic_request,pic_sms,pic_privacy,pic_refer_id,pic_special,pic_tag,pic_map_lan,pic_map_lon,pic_multi_loc_chip) values('$pro_title',$category_id,$pro_price,'$pro_description','$postdate','$ad_id_unique','$scheme_free','$scheme_pay','$email','$userid','$mobile_no','$full_name','$city','$taluk_select','$town','$lan','$lon',0,'$sms','$privacy','$referid','$special','$pro_tag','$lati','$longi','$multiLocChip')");

		//insert multiple location
		$multiLocChipArr = json_decode($multiLocChip, true);
		if (!empty($multiLocChipArr)) {
			foreach ($multiLocChipArr as $val) {
				// echo "<pre>";
				// print_r($val);
				$multiLocQry = "insert into pic_addpost_locations (addpost_uni_id, loc_name, pic_add_lon, pic_add_lat) values ('$ad_id_unique', '" . $val['locName'] . "', '" . $val['lngpostad'] . "', '" . $val['latpostad'] . "')";
				mysqli_query($this->mysqlConfig(), $multiLocQry);
			}
		}else{
			$multiLocQry = "insert into pic_addpost_locations (addpost_uni_id, loc_name, pic_add_lon, pic_add_lat) values ('$ad_id_unique', '" . $user_fetch->user_taluk . "', '" . $user_fetch->user_lon . "', '" . $user_fetch->user_lan . "')";
			mysqli_query($this->mysqlConfig(), $multiLocQry);
		}



		// insert multiple field table
		$temp = "";
		$field_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_categories_id=$category_id and fields_type!='DropDown' and fields_type!='Chain' ORDER BY field_priority ASC");
		while ($row = mysqli_fetch_object($field_query)) {

			$value = str_replace(" ", "_", $row->fields_title);
			if ($temp != $value) {
				$fields_value = $_REQUEST[$value];

				mysqli_query($this->mysqlConfig(), "insert into pic_addpost_field(addpost_fields_categories_id,addpost_uni_id,addpost_fields_title,addpost_fields_type,addpost_fields_value,field_id,pots_field_DV_id,addpost_fields_lan,addpost_fields_lon) values($category_id,'$ad_id_unique','$row->fields_title','$row->fields_type','$fields_value','$row->fields_id','$row->field_DV_id','$lan','$lon')");

				$fields_value = "";
			}
			$temp = $value;
		}

		// insert multiple field table
		$temp = "";
		$field_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_categories_id=$category_id and fields_type='DropDown' group by `fields_title` ORDER BY field_priority ASC");
		while ($row = mysqli_fetch_object($field_query)) {

			$value = str_replace(" ", "_", $row->fields_title);
			if ($temp != $value) {
				$fields_value = $_REQUEST[$value];

				mysqli_query($this->mysqlConfig(), "insert into pic_addpost_field(addpost_fields_categories_id,addpost_uni_id,addpost_fields_title,addpost_fields_type,addpost_fields_value,field_id,pots_field_DV_id,addpost_fields_lan,addpost_fields_lon) values($category_id,'$ad_id_unique','$row->fields_title','$row->fields_type','$fields_value','$row->fields_id','$row->field_DV_id','$lan','$lon')");

				$fields_value = "";
			}
			$temp = $value;
		}

        // File Upload
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES['fileUpload'])) {
            $fileDirPath = 'media/files';
            if (!file_exists($fileDirPath)) {
                mkdir($fileDirPath, 0777, true);
            }
            $fileUploadArr = $_FILES['fileUpload'];
            $fileExt = substr(strrchr($fileUploadArr['name'][0], '.'), 1);
            $fileDirName = $fileDirPath . '/' . time() . '.' . $fileExt;
            if (move_uploaded_file($fileUploadArr['tmp_name'][0], $fileDirName)) {
                $fileUploadQry = "INSERT INTO pic_addpost_files (id, pic_ads_id, pic_file_url) VALUES (NULL, '{$ad_id_unique}', '{$fileDirName}')";
                mysqli_query($this->mysqlConfig(), $fileUploadQry);
            }
        }



         //Image with crop
        if (isset($_POST['img_data']) and $_POST['img_data'] != "") {
            $croped_image = $_POST['img_data'];
            $z = 1;
            foreach ($croped_image as $croped_images) {
                //list($type, $croped_image) = explode(';', $croped_image);
                list(, $croped_images) = explode(',', $croped_images);
                $croped_images = base64_decode($croped_images);
                ///$image_name = time().'.jpg';
                $name = microtime() . "_" . $z . '.jpg';
                $name = str_replace(' ', '_', $name);
               // upload cropped image to server 
                file_put_contents('media/' . $name, $croped_images);
                file_put_contents('media/small/' . $name, $croped_images);
                file_put_contents('media/thumnails/' . $name, $croped_images);

				$textfield = "textfield_" . $z;
				$ad_image_title = $_POST[$textfield];

				$textfield2 = "textfield2_" . $z;
				$ad_image_desc = $_POST[$textfield2];


				mysqli_query($this->mysqlConfig(), "insert into pic_addpost_images(addpost_id,ad_image_name,ad_image_url,ad_image_order,ad_image_title,ad_image_desc) values('$ad_id_unique','$name','$name',$z,'$ad_image_title','$ad_image_desc')");
				$z++;
			}
		}


		// insert multiple image field table & multiple upload
		/*
		$max_size = 10000*10000; // 200kb
		$extensions = array('jpeg', 'jpg', 'gif');
		$dir = 'media/';
		$dir_thum = 'media/thumnails/';
		$count = 0;
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_FILES['files']))
		{
		
		// loop all files
                $order = 1;
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
		copy("media/".$name."", "media/thumnails/".$name."");
		copy("media/".$name."", "media/small/".$name."");
		$dateStart = date("d-m-Y", time());
		mysqli_query($this->mysqlConfig(),"insert into pic_addpost_images(addpost_id,ad_image_name,ad_image_url,ad_image_order) values('$ad_id_unique','$name','$name',$order)");
		
		}
		else{
		
		mysqli_query($this->mysqlConfig(),"insert into pic_addpost_images(addpost_id,ad_image_name,ad_image_url) values('$ad_id_unique','','')");
		
		}
		
		$add="media/thumnails/".$name."";
		
		$n_width=350;          // Fix the width of the thumb nail images
		$n_height=350;
		if ($_FILES["files"]['type'][$i]=="image/gif"){
		
			echo "gif"; 
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
			echo "jpeg"; 
			chmod("$add",0777);
			
			$im=ImageCreateFromJPEG($add); 
			$width=ImageSx($im);              // Original picture width is stored
			$height=ImageSy($im);             // Original picture height is stored
			$n_height=($n_width/$width) * $height; // Add this line to maintain aspect ratio
			$newimage=imagecreatetruecolor($n_width,$n_height);                 
			imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
			ImageJpeg($newimage,$add);
			
		}
		
		$add="media/small/".$name."";
		
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
		
		$order++;
		
		}
		}
                */
		// update scheme table
		$acct_id = $_SESSION['pic']['biscuit']['userid'];


		$qry_counts = mysqli_query($this->mysqlConfig(), "SELECT * FROM `pic_scheme_user` WHERE `pic_user_id`=$acct_id and `pic_scheme_balance_qty`!= 0 and `payment_status`= 'Approved' order by `pic_scheme_balance_qty` asc limit 1");
		//echo "SELECT * FROM `pic_scheme_user` WHERE `pic_user_id`=$acct_id and `pic_scheme_balance_qty`!= 0 and `payment_status`= 'Approved' order by `pic_scheme_balance_qty` asc limit 1";
		$row_counts = mysqli_fetch_object($qry_counts);
		$result_counts = $row_counts->pic_scheme_balance_qty - 1;



		mysqli_query($this->mysqlConfig(), "UPDATE `pic_scheme_user` SET  `pic_scheme_balance_qty` =  '$result_counts' WHERE  `pic_scheme_user`.`pic_scheme_user_id` =$row_counts->pic_scheme_user_id");

		//notification sms for comapared ads


		require("helper/misc/misc.php");
		$misc = new misc();
		$misc->compareAds($ad_id_unique, $category_id, 0);


		//notification mail to owner of the category
		$category_id = "|" . $category_id . "|";
		$city = "|" . $city . "|";
		$categories_query = mysqli_query($this->mysqlConfig(), "select * from pic_user where privacy_category LIKE '%{$category_id}%' and privacy_location LIKE '%{$city}%'");

		require("helper/mailing/mailing.php");
		$mailing = new mailing();





		while ($row = mysqli_fetch_object($categories_query)) {

			$sub = "Mr." . $full_name . "";

			$info = "Dear " . $row->user_username . ",

Mr." . $full_name . " posted New Advertisment into your Category

Please Check the given information

Ads ID :  " . $ad_id_unique . "

Contact Name : " . $full_name . "

Contact No : " . $mobile_no . "

kindly regards,
PIC Team";


			// to enable mail
			$mailing->mail_send($row->user_email, $sub, $info);
		}


		$sms_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_user` where privacy_category LIKE '%{$category_id}%' and privacy_location LIKE '%{$city}%' and user_id!=$userid");
		//require("helper/sms/sms.php");
		$sms = new sms();
		while ($row_sms = mysqli_fetch_object($sms_query)) {

			$msg = "Mr/Mrs. " . $full_name . " are posted New Ads into your Category. Ads ID : " . $ad_id_unique . " , Mobile : " . $mobile_no . "";
			//msg = "Your OTP is ".$shuffled_mobile." for Validate the Mobile No.Please visit the link www.picads.in/validate"; 

			// to enable sms
			$sms->sms_send($row_sms->user_mobile, $msg);
		}




		// redirects

		//require("view/static/header.php");

		require("view/add_history/add_history.php");
		$callclass = new add_history();
		$callclass->index();

		//require("view/static/footer.php");



	}
	public function update()
	{


		$ad_id_unique = $_POST['id'];
		$pro_title = $_POST['pro_title'];
		$pro_price = $_POST['pro_price'];
		$pro_description = $_POST['pro_description'];
		$pic_tag = $_POST['pro_tag'];

		$category_id = $_POST['category_id'];
		$postdate = date("Y-m-d H:i:s");

		if ($_POST['scheme'] == 0) {
			$scheme_free = $_POST['scheme'];
			$scheme_pay = 0;
		} else {
			$scheme_free = 0;
			$scheme_pay = $_POST['scheme'];
		}
		
		$userid = $_SESSION['pic']['biscuit']['userid'];
		$user_query = mysqli_query($this->mysqlConfig(), "select * from pic_user where user_id=$userid");
		$user_fetch = mysqli_fetch_object($user_query);



		//$userid = 0;
		$email = $_POST['email'];
		$full_name = $_POST['name'];
		$mobile_no = $_POST['mobile'];
		$usertype = $_POST['areYou'];
		$city = $_POST['city'];
		$taluk_select = $_POST['taluk_select'];
		$town = $_POST['town'];
		$sms = $_POST['sms'];
		$privacy = $_POST['privacy'];
		$multiLocChip = $_POST['multiLocChip'];

		if (isset($taluk_select)) {
			$location_query = mysqli_query($this->mysqlConfig(), "select * from pic_geometric where city2='" . $taluk_select . "' limit 1");
			$location_fetch = mysqli_fetch_object($location_query);
			$lan = $location_fetch->lan;
			$lon = $location_fetch->lon;
		}

		// insert common field table
		mysqli_query($this->mysqlConfig(), "update pic_addpost set pic_title='$pro_title',pic_category='$category_id',pic_price='$pro_price',pic_discription='$pro_description',pic_postdate='$postdate',pic_is_freeads='$scheme_free',addpost_scheme_user_id='$scheme_pay',pic_user_fullname='$full_name',pic_user_email='$email',pic_user_mobile='$mobile_no',pic_sms='$sms',pic_privacy='$privacy',pic_tag='$pic_tag', pic_multi_loc_chip='$multiLocChip' where pic_ads_id='$ad_id_unique' ");

		// update scheme table
		/*if($scheme_pay!=0){
		
			$select_scheme_user = mysqli_query($this->mysqlConfig(),"select pic_scheme_balance_qty from pic_scheme_user where pic_scheme_user_id = $scheme_pay");
			$scheme_user_row = mysqli_fetch_object($select_scheme_user);
			$scheme_balance_qty = $scheme_user_row->pic_scheme_balance_qty - 1;
			
		}*/

		// update multiple location
		$multiLocChipArr = json_decode($multiLocChip, true);
		if (!empty($multiLocChipArr)) {
			mysqli_query($this->mysqlConfig(), "DELETE FROM pic_addpost_locations WHERE addpost_uni_id = '$ad_id_unique'");

			
			foreach ($multiLocChipArr as $val) {
				// echo "<pre>";
				// print_r($val);
				$multiLocQry = "insert into pic_addpost_locations (addpost_uni_id, loc_name, pic_add_lon, pic_add_lat) values ('$ad_id_unique', '" . $val['locName'] . "', '" . $val['lngpostad'] . "', '" . $val['latpostad'] . "')";
				mysqli_query($this->mysqlConfig(), $multiLocQry);
			}
		}else{
			mysqli_query($this->mysqlConfig(), "DELETE FROM pic_addpost_locations WHERE addpost_uni_id = '$ad_id_unique'");
			$multiLocQry = "insert into pic_addpost_locations (addpost_uni_id, loc_name, pic_add_lon, pic_add_lat) values ('$ad_id_unique', '" . $user_fetch->user_taluk . "', '" . $user_fetch->user_lon . "', '" . $user_fetch->user_lan . "')";
			mysqli_query($this->mysqlConfig(), $multiLocQry);
		}

        // File Upload
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES['fileUpload'])) {

            $getFIleQry = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_files where pic_ads_id = {$ad_id_unique}");
            $getFileArr = mysqli_fetch_object($getFIleQry);
            echo "<pre>";
            print_r($getFileArr);
            if (file_exists($getFileArr->pic_file_url)) {
                unlink($getFileArr->pic_file_url);
            }
            $delFileQry = "DELETE FROM pic_addpost_files where pic_ads_id = {$ad_id_unique}";
            mysqli_query($this->mysqlConfig(), $delFileQry);

            $fileDirPath = 'media/files';
            if (!file_exists($fileDirPath)) {
                mkdir($fileDirPath, 0777, true);
            }
            $fileUploadArr = $_FILES['fileUpload'];
            $fileExt = substr(strrchr($fileUploadArr['name'][0], '.'), 1);
            $fileDirName = $fileDirPath . '/' . time() . '.' . $fileExt;
            if (move_uploaded_file($fileUploadArr['tmp_name'][0], $fileDirName)) {
                $fileUploadQry = "INSERT INTO pic_addpost_files (id, pic_ads_id, pic_file_url) VALUES (NULL, '{$ad_id_unique}', '{$fileDirName}')";
                mysqli_query($this->mysqlConfig(), $fileUploadQry);
            }
        }

        // insert multiple field table
        $temp = "";
        $field_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_categories_id=$category_id ORDER BY field_priority ASC");
        while ($row = mysqli_fetch_object($field_query)) {

			$value = str_replace(" ", "_", $row->fields_title);
			if ($temp != $value) {
				$fields_value = $_REQUEST[$value];

				//mysqli_query($this->mysqlConfig(),"update pic_addpost_field set addpost_fields_categories_id='$category_id',addpost_fields_title='$row->fields_title',addpost_fields_type='$row->fields_type',addpost_fields_value='$fields_value',field_id='$row->fields_id' where  addpost_uni_id='$ad_id_unique' ");

				$fields_value = "";
			}
			$temp = $value;
		}

		// insert multiple image field table & multiple upload
		$max_size = 2000 * 2000; // 200kb
		$extensions = array('jpeg', 'jpg', 'gif');
		$dir = 'media/';
		$dir_thum = 'media/thumnails/';
		$count = 0;

		if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_FILES['files'])) {
			// loop all files
			foreach ($_FILES['files']['name'] as $i => $name) {
				// if file not uploaded then skip it
				if (!is_uploaded_file($_FILES['files']['tmp_name'][$i]))
					continue;

				// skip large files
				if ($_FILES['files']['size'][$i] >= $max_size)
					continue;

				// skip unprotected files
				if (!in_array(pathinfo($name, PATHINFO_EXTENSION), $extensions))
					continue;

				// now we can move uploaded files
				$name = microtime() . $name;
				$name = str_replace(" ", "_", $name);

				if (move_uploaded_file($_FILES["files"]["tmp_name"][$i], $dir . $name)) {
					copy("media/" . $name . "", "media/thumnails/" . $name . "");
					copy("media/" . $name . "", "media/small/" . $name . "");
					$dateStart = date("d-m-Y", time());
					mysqli_query($this->mysqlConfig(), "update pic_addpost_images set ad_image_name='$name',ad_image_url='$name' where addpost_id='$ad_id_unique' ");
				}

				$add = "media/thumnails/" . $name . "";

				$n_width = 350;          // Fix the width of the thumb nail images
				$n_height = 350;
				if ($_FILES["files"]['type'][$i] == "image/gif") {


					$im = ImageCreateFromGIF($add);
					$width = ImageSx($im);              // Original picture width is stored
					$height = ImageSy($im);                  // Original picture height is stored
					$n_height = ($n_width / $width) * $height; // Add this line to maintain aspect ratio
					$newimage = imagecreatetruecolor($n_width, $n_height);
					imageCopyResized($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);

					if (function_exists("imagegif")) {
						Header("Content-type: image/gif");
						ImageGIF($newimage, $add);
					} elseif (function_exists("imagejpeg")) {
						Header("Content-type: image/jpeg");
						ImageJPEG($newimage, $add);
					}
					chmod("$add", 0777);
				}

				////////////// starting of JPG thumb nail creation//////////
				if ($_FILES["files"]['type'][$i] == "image/jpeg") {

					$im = ImageCreateFromJPEG($add);
					$width = ImageSx($im);              // Original picture width is stored
					$height = ImageSy($im);             // Original picture height is stored
					$n_height = ($n_width / $width) * $height; // Add this line to maintain aspect ratio
					$newimage = imagecreatetruecolor($n_width, $n_height);
					imageCopyResized($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);
					ImageJpeg($newimage, $add);
					chmod("$add", 0777);
				}

				$add = "media/small/" . $name . "";

				$n_width = 100;          // Fix the width of the thumb nail images
				$n_height = 100;
				if ($_FILES["files"]['type'][$i] == "image/gif") {


					$im = ImageCreateFromGIF($add);
					$width = ImageSx($im);              // Original picture width is stored
					$height = ImageSy($im);                  // Original picture height is stored
					$n_height = ($n_width / $width) * $height; // Add this line to maintain aspect ratio
					$newimage = imagecreatetruecolor($n_width, $n_height);
					imageCopyResized($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);

					if (function_exists("imagegif")) {
						Header("Content-type: image/gif");
						ImageGIF($newimage, $add);
					} elseif (function_exists("imagejpeg")) {
						Header("Content-type: image/jpeg");
						ImageJPEG($newimage, $add);
					}
					chmod("$add", 0777);
				}

				////////////// starting of JPG thumb nail creation//////////
				if ($_FILES["files"]['type'][$i] == "image/jpeg") {

					$im = ImageCreateFromJPEG($add);
					$width = ImageSx($im);              // Original picture width is stored
					$height = ImageSy($im);             // Original picture height is stored
					$n_height = ($n_width / $width) * $height; // Add this line to maintain aspect ratio
					$newimage = imagecreatetruecolor($n_width, $n_height);
					imageCopyResized($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);
					ImageJpeg($newimage, $add);
					chmod("$add", 0777);
				}


				$count++;
			}
		}

		//notification mail to owner of the category
		$category_id = "|" . $category_id . "|";
		$city = "|" . $city . "|";
		$categories_query = mysqli_query($this->mysqlConfig(), "select * from pic_user where privacy_category LIKE '%{$category_id}%' and privacy_location LIKE '%{$city}%'");

		require("helper/mailing/mailing.php");
		$mailing = new mailing();





		while ($row = mysqli_fetch_object($categories_query)) {

			$sub = "Mr." . $full_name . "";

			$info = "Dear " . $row->user_username . ",

Mr." . $full_name . " Update Advertisment into your Category

Please Check the given information

Ads ID :  " . $ad_id_unique . "

Contact Name : " . $full_name . "

Contact No : " . $mobile_no . "

kindly regards,
PIC Team";


			$mailing->mail_send($row->user_email, $sub, $info);
		}
		print "<script>";
		print "window.location.href = 'index.php?action=view&module=product_detail&ads_id=$ad_id_unique'; ";
		print "</script>";
	}
	public function update_field()
	{

		$vale = $_POST['value'];

		mysqli_query($this->mysqlConfig(), "UPDATE `pic_addpost_field` SET  `addpost_fields_value` =  '$vale' WHERE  `pic_addpost_field`.`addpost_field_id` =" . $_REQUEST['fid'] . "");
	}
	public function update_image()
	{

		// insert multiple image field table & multiple upload

		$ad_id_unique = $_POST['adsid'];
		$title_img = $_POST['title_img'];
		$desc_img = $_POST['desc_img'];
		$rowid = $_POST['rowid'];

		$max_size = 10000 * 10000; // 200kb
		$extensions = array('jpeg', 'jpg', 'gif');
		$dir = 'media/';
		$dir_thum = 'media/thumnails/';
		$count = 0;

		echo "UPDATE `pic_addpost_images` SET `ad_image_title` = '$title_img', `ad_image_desc` = '$desc_img' WHERE `ad_image_id` = " . $rowid . "";


		echo $_FILES['files']['name'];
		if (isset($_FILES['files']) and !empty($_FILES['files']['name'][0])) {

			// loop all files
			foreach ($_FILES['files']['name'] as $i => $name) {
				// if file not uploaded then skip it
				if (!is_uploaded_file($_FILES['files']['tmp_name'][$i]))
					continue;

				// skip large files
				if ($_FILES['files']['size'][$i] >= $max_size)
					continue;

				// skip unprotected files
				if (!in_array(pathinfo($name, PATHINFO_EXTENSION), $extensions))
					continue;

				// now we can move uploaded files
				$name = microtime() . $name;
				$name = str_replace(" ", "_", $name);

				//echo "fdfd";

				if (move_uploaded_file($_FILES["files"]["tmp_name"][$i], $dir . $name)) {
					copy("media/" . $name . "", "media/thumnails/" . $name . "");
					copy("media/" . $name . "", "media/small/" . $name . "");
					$dateStart = date("d-m-Y", time());

					//mysqli_query($this->mysqlConfig(),"DELETE FROM`pic_addpost_images` WHERE `pic_addpost_images`.`ad_image_id` = $rowid");


					//mysqli_query($this->mysqlConfig(),"insert into pic_addpost_images(addpost_id,ad_image_name,ad_image_url) values('$ad_id_unique','$name','$name')");
					//echo "UPDATE `pic_addpost_images` SET  `addpost_id` =  '$ad_id_unique',`ad_image_name` =  '$name',`ad_image_url` =  '$name', `ad_image_title` = '$title_img', `ad_image_desc` = '$desc_img' WHERE `ad_image_id` = ".$rowid."";

					mysqli_query($this->mysqlConfig(), "UPDATE `pic_addpost_images` SET `ad_image_name` =  '$name',`ad_image_url` =  '$name', `ad_image_title` = '$title_img', `ad_image_desc` = '$desc_img' WHERE `ad_image_id` = " . $rowid . "");
				}

				$add = "media/thumnails/" . $name . "";

				$n_width = 350;          // Fix the width of the thumb nail images
				$n_height = 350;
				if ($_FILES["files"]['type'][$i] == "image/gif") {


					$im = ImageCreateFromGIF($add);
					$width = ImageSx($im);              // Original picture width is stored
					$height = ImageSy($im);                  // Original picture height is stored
					$n_height = ($n_width / $width) * $height; // Add this line to maintain aspect ratio
					$newimage = imagecreatetruecolor($n_width, $n_height);
					imageCopyResized($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);

					if (function_exists("imagegif")) {
						Header("Content-type: image/gif");
						ImageGIF($newimage, $add);
					} elseif (function_exists("imagejpeg")) {
						Header("Content-type: image/jpeg");
						ImageJPEG($newimage, $add);
					}
					chmod("$add", 0777);
				}

				////////////// starting of JPG thumb nail creation//////////
				if ($_FILES["files"]['type'][$i] == "image/jpeg") {

					$im = ImageCreateFromJPEG($add);
					$width = ImageSx($im);              // Original picture width is stored
					$height = ImageSy($im);             // Original picture height is stored
					$n_height = ($n_width / $width) * $height; // Add this line to maintain aspect ratio
					$newimage = imagecreatetruecolor($n_width, $n_height);
					imageCopyResized($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);
					ImageJpeg($newimage, $add);
					chmod("$add", 0777);
				}

				$add = "media/small/" . $name . "";

				$n_width = 100;          // Fix the width of the thumb nail images
				$n_height = 100;
				if ($_FILES["files"]['type'][$i] == "image/gif") {


					$im = ImageCreateFromGIF($add);
					$width = ImageSx($im);              // Original picture width is stored
					$height = ImageSy($im);                  // Original picture height is stored
					$n_height = ($n_width / $width) * $height; // Add this line to maintain aspect ratio
					$newimage = imagecreatetruecolor($n_width, $n_height);
					imageCopyResized($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);

					if (function_exists("imagegif")) {
						Header("Content-type: image/gif");
						ImageGIF($newimage, $add);
					} elseif (function_exists("imagejpeg")) {
						Header("Content-type: image/jpeg");
						ImageJPEG($newimage, $add);
					}
					chmod("$add", 0777);
				}

				////////////// starting of JPG thumb nail creation//////////
				if ($_FILES["files"]['type'][$i] == "image/jpeg") {

					$im = ImageCreateFromJPEG($add);
					$width = ImageSx($im);              // Original picture width is stored
					$height = ImageSy($im);             // Original picture height is stored
					$n_height = ($n_width / $width) * $height; // Add this line to maintain aspect ratio
					$newimage = imagecreatetruecolor($n_width, $n_height);
					imageCopyResized($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);
					ImageJpeg($newimage, $add);
					chmod("$add", 0777);
				}


				$count++;
			}
		} else {

			mysqli_query($this->mysqlConfig(), "UPDATE `pic_addpost_images` SET `ad_image_title` = '$title_img', `ad_image_desc` = '$desc_img' WHERE `ad_image_id` = " . $rowid . "");
		}
	}
}