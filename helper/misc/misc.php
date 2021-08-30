<?php

class misc extends config{

	public function compareAds($adid_unique,$categoryid,$post){
	
	
	
	
	$query = mysqli_query($this->mysqlConfig(),"SELECT field_value FROM `pic_categories_fields` WHERE `fields_categories_id`=".$categoryid." and `fields_type`='chain'");
	$row = mysqli_fetch_object($query);
	
	$array = explode(',', $row->field_value);
	
	$value1 = str_replace("from:","",$array[0]);
	$value2 = str_replace("to:","",$array[1]);
	
	$query1 = mysqli_query($this->mysqlConfig(),"SELECT addpost_fields_value FROM `pic_addpost_field` WHERE `addpost_uni_id`='".$adid_unique."' and `field_id`=$value1");
	$row1 = mysqli_fetch_array($query1);
	
	$value1 = $row1['addpost_fields_value'];
			
	$query2 = mysqli_query($this->mysqlConfig(),"SELECT addpost_fields_value FROM `pic_addpost_field` WHERE `addpost_uni_id`='".$adid_unique."' and `field_id`=$value2");
	$row2 = mysqli_fetch_array($query2);
	
	$value2 = $row2['addpost_fields_value'];
	
	$query_adid = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_addpost_field` WHERE `addpost_uni_id`!='".$adid_unique."' and `addpost_fields_value` in ($value1,$value2) and addpost_fields_categories_id = $categoryid group by addpost_uni_id");
	require("helper/sms/sms.php");
	while($row_adid = mysqli_fetch_object($query_adid)){
	
	
	$this->smssent2($this->smssent($row_adid->addpost_uni_id,$post));
	
	
	}
	
	
	}
	public function smssent($id,$post) { 
	
	$query_userid = mysqli_query($this->mysqlConfig(),"SELECT pic_user_id FROM `pic_addpost` WHERE `pic_ads_id`='".$id."' and pic_request=$post");
	
	$row_userid = mysqli_fetch_object($query_userid);
	
	if(empty($row_userid->pic_user_id)){
	return "";
	}
	else{
	
	return $row_userid->pic_user_id;
	}
	
	}
	public function smssent2($id){
	$query_sms = mysqli_query($this->mysqlConfig(),"SELECT user_sms,user_mobile FROM `pic_user` WHERE `user_id`='".$id."' and `user_id`!='".$_SESSION['pic']['biscuit']['userid']."' and user_sms=1 and user_status=1");
	
	while($row_sms = mysqli_fetch_object($query_sms)){
	

	$sms= new sms();
	
	$msg = "Your Ads Matched. Please check the Ads Id is ".$adid_unique."";
	$sms->sms_send($row_sms->user_mobile,$msg);
	//echo $row_sms->user_mobile." ".$adid_unique."</br>";
	
	$query_sender = mysqli_query($this->mysqlConfig(),"SELECT user_mobile FROM `pic_user` WHERE `user_id`='".$_SESSION['pic']['biscuit']['userid']."' and user_sms=1 and user_status=1");
	$row_sender = mysqli_fetch_object($query_sender);
	$msg = "Your Ads Matched. Please check the Ads Id is ".$row_adid_final->addpost_uni_id."";
	$sms->sms_send($row_sender->user_mobile,$msg);
	//echo $row_sender->user_mobile." ".$row_adid_final->addpost_uni_id."</br>";
	
	}
	
	}
	public function selectSub() { ?>
			
			<h4>
				<?php
				$title_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `fields_id`=".$_REQUEST['sub']." limit 1");
				$title_row = mysqli_fetch_object($title_query);
				echo "Choose ".$title_row->fields_title;
				?>
				</h4>
				<?php
				
				?>
			<select class="filter_chain filter_sub" name="<?php echo $_REQUEST['sub'];?>" id="<?php echo $_REQUEST['sub']; ?>" onChange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);"  style="padding: 3%;width: 100%;font-size: 15px;">
											   
										 
				<?php
				$strr = ",".$_REQUEST['parent'];
				$chain_value = $_POST['chain_value'];
				foreach($chain_value as $chainValues){
				$chainValues = explode(':', $chainValues);
					if($chainValues[0]==$_REQUEST['sub']){
					
					$chainValues=$chainValues[1];
					
					}
				}
				
				$sub_quick_filter_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `field_chain_value` LIKE '%{$strr}%' ");
				?>
				<option value="0">All</option>
				<?php
				while($row = mysqli_fetch_object($sub_quick_filter_query)){
				?>
					<option <?php if($chainValues==$row->fields_id){ ?> selected="selected" <?php } ?> value="<?php echo $row->fields_id;?>"><?php echo $row->field_value; ?></option>
					
				<?php
				}
				?>	
				</select>
				<?php
}

	public function likeForm() { ?>
    
        <?php
        $moduleview = $_REQUEST['moduleview'];
		$user_email = $_REQUEST['user_email'];
		$user_mob = $_REQUEST['user_mob'];
		$user_name = $_REQUEST['user_name'];
		$ads_uid = $_REQUEST['ads_uid'];
		$ads_id = $_REQUEST['ads_id'];
        ?>
    
            <form name="like_save_form" method="post" action="index.php" >
            <input type="hidden" name="post" value="like">
            <input type="hidden" name="action" value="model" >
            <input type="hidden" name="module" id="module" value="<?php echo $moduleview; ?>" >
            <input type="hidden" name="ads_type" id="ads_type" value="<?php echo $moduleview; ?>" >
            <input type="hidden" name="ads_user_id" id="ads_user_id" value="<?php echo $ads_uid; ?>" >
            <input type="hidden" name="ads_id" id="ads_id" value="<?php echo $ads_id; ?>" >
            
            <div class="form-label-group">    
            <input class="form-control" type="text" name="cus_name" id="cus_name" value="<?php echo $user_name; ?>" required>
            <label for="cus_mobileno">Your Name</label>
            </div>
            
            <div class="form-label-group">
            <input class="form-control" readonly="readonly"  type="text" pattern="[789][0-9]{9}" maxlength="10" name="cus_mobileno" id="cus_mobileno" required value="<?php echo $user_mob; ?>" >
            <label for="cus_mobileno">Mobile No *</label>
            </div>
        
            <div class="form-label-group">
            <input readonly="readonly" class="form-control" type="email" name="cus_email" id="cus_email"  value="<?php echo $user_email; ?>">
            <label for="cus_mobileno">Your Email ID *</label>
            </div>
            
            <div class="form-label-group">
            <input class="form-control"  type="text" pattern="[789][0-9]{9}" maxlength="10" name="cus_conatctno" id="cus_conatctno" required value="" >
            <label for="cus_conatctno">Your Contact No (Optional)</label>
            </div>
            <div class="form-label-group">
            <button class="btn btn-primary btn-lg" type="submit" name="save_like">Like</button>
            </div>
       
    </form>
    
   
	
	<?php
    }
	
	public function getUser($id) {
	$queryuser = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_user` where user_id = $id limit 1");
	$rowuser = mysqli_fetch_object($queryuser);
	
	}
	

	
}
?>