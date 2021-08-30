<?php

class requestad extends config{

    public function notifyForm() {
	
	if(isset($_REQUEST['id'])){
	$ads = $_REQUEST['id'];
	
	$user_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_ads_id=$ads");
	$user_fetch = mysqli_fetch_object($user_query);
	
	$pic_sms = $user_fetch->pic_sms;
	$pic_privacy = $user_fetch->pic_privacy;
	}
	else{
	$pic_sms = "";
	$pic_privacy = "";
	
	}
	
	?>
	<div class="row">
    
    <div class="col-sm-12 col-md-12 col-lg-6 pb-0">
    
	<div class="mylabel pb-1">SMS Notification *</div>
    
    <div class="form-check">
	<input name="sms" id="sms" class="form-check-input"  type="radio" value="1" <?php if($pic_sms==1){ ?> checked="checked" <?php } ?>>
	<label class="form-check-label" for="sms">Yes</label>
    </div>
    
    
    <div class="form-check">
    <input  <?php if($pic_sms==0){ ?> checked="checked" <?php } ?> type="radio" class="form-check-input" value="0" id="sms2"  name="sms">
    <label class="form-check-label" for="sms2">No</label>
    </div>
    
    </div>
	<div class="col-sm-12 col-md-12 col-lg-6 pb-0">
	<div class="mylabel pb-1">Privacy *</div>
    <div class="form-check">
	<input  <?php if($pic_privacy==1){ ?> checked="checked" <?php } ?> name="privacy"  type="radio" value="1" class="form-check-input" id="privacy1"/>
    <label class="form-check-label" for="privacy1">Public</label>
    </div>
    <div class="form-check">
	<input type="radio"  value="0"  name="privacy" <?php if($pic_privacy==0){ ?> checked="checked" <?php } ?> class="form-check-input" id="privacy2">
    <label class="form-check-label" for="privacy2">Private</label>
    </div>
    </div>
	
	<?php
	}
	public function index() {
        ?>
        
        <div class="container">
            <form  id="requestad" name="requestad" method="post" action="index.php" enctype="multipart/form-data">
               <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 pb-0">
                     <h4>Request Ads</h4>
                    </div>
                    </div>
                    <hr />
                    <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 pb-0">

                        
                             <input type="hidden" name="action" value="model" />
                            <input type="hidden" name="module" value="requestad" />
<?php
if(isset($_REQUEST['id'])){
$categories_querys = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_ads_id=".$_REQUEST['id']."");
$rows=mysqli_fetch_object($categories_querys);
$id_check = $rows->pic_ads_id;
$str = "and  addpost_uni_id=".$_REQUEST['id']."";
?>
<input type="hidden" name="post" value="requestad update" />
<input type="hidden" name="id" value="<?php echo $rows->pic_ads_id; ?>" />
<?php
} else {
$id_check = "";
$str = "";
?>
<input type="hidden" name="post" value="requestad insert" />
<?php }  ?>
                 

<?php
if(!empty($_SESSION['pic']['biscuit']['userid'])){
$scheme_query = mysqli_query($this->mysqlConfig(),"select *,SUM(pic_scheme_balance_qty) AS sum_ads from pic_scheme_user where payment_status='Approved' and pic_user_id=".$_SESSION['pic']['biscuit']['userid']."");
$scheme_row = mysqli_fetch_object($scheme_query);

?>
<div class="form-group">
<div class="list-group">
<div class="list-group-item list-group-item-light">
<input name="scheme" type="hidden" value="<?php echo $scheme_row->pic_scheme_user_id; ?>"> 
Your Scheme : <strong><?php echo $scheme_row->sum_ads; ?></strong> Available
</div>
</div>
</div>
                        
                            
                             
                        
<?php
if($scheme_row->sum_ads==0 and !isset($_REQUEST['id'])){
print "<script>";
print "alert('Please Purchase Scheme');";
print "window.location.href = 'index.php?action=view&module=myaccount&task=scehmelist'; ";
print "</script>";
}
}
?>
</div>
<div class="col-sm-12 col-md-12 col-lg-6 pb-0">

<?php
if(isset($_REQUEST['sub'])){
$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id=".$_REQUEST['sub']."");
$row=mysqli_fetch_object($categories_query);
$desc_label = $row->categories_desc_label;
}
?>
<div class="form-group">
<div class="list-group">
<div class="list-group-item list-group-item-light">
<input type="hidden"  class="form-control" id="category_id" name="category_id" value="<?php echo $row->categories_id; ?>"> 
<input type="hidden"  class="form-control" id="pro_category" name="pro_category" value="<?php echo $row->categories_name; ?>" readonly>
Category : <strong><?php echo $row->categories_name; ?></strong>
</div>
</div>
</div>
</div>
</div>
       <div class="row">
           <div class="col-sm-12 col-md-12 col-lg-6 pb-0">                      
<div class="form-group">
<label class="mylabel pb-1" for="inputtitle">Title *</label>
<?php if($id_check==""){ ?>
<input required type="text"  class="form-control" id="pro_title" name="pro_title">
<?php } else{ ?><input required type="text"  class="form-control" id="pro_title" name="pro_title" value="<?php echo $rows->pic_title; ?>"><?php }  ?>
</div>
                                    
                                
                                
<div class="form-group">
<label class="mylabel pb-1" for="pro_price"><?php echo $row->categories_price_label; ?> *</label>
<?php if($id_check==""){ ?>
<input type="number"  required class="form-control" id="pro_price" name="pro_price">
<?php } else{ ?><input type="number"  required class="form-control" id="pro_price" name="pro_price" value="<?php echo $rows->pic_price; ?>"><?php }  ?>
</div>
                                
                                 <?php
								 $temp="";
								 $field_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and fields_type='Chain' order by field_priority,fields_id ASC");
								 ?>
								 <?php
								 while($row=mysqli_fetch_object($field_query)){
								 ?>
                                <div class="col-sm-12 col-md-12 col-lg-12 p-3 bg-primary mb-4 rounded-lg">
                                <div class="form-group">
                                    <?php 
									$field_value_trim = trim($row->field_value, "from:");
									$field_value_trim = str_replace('to:', '', $field_value_trim);
									$field_value_trim = explode(',', $field_value_trim);
									?>
                                    <div class="mylabel pb-1 text-white">
									<?php 
                                    $title_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_id=$field_value_trim[0]");
                                    $maintitle = mysqli_fetch_array($title_query);
                                    echo $name =  $maintitle['fields_title']; 
									$name = str_replace(" ","_",$maintitle['fields_title']);
                                    ?>
								    </div>
                                  
                                  
                                    
					<?php $placeholder = $row->field_sample; ?>
<?php 
$values_query1 = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where field_id='$field_value_trim[0]' ".$str."");
$row_value1=mysqli_fetch_object($values_query1);
?>
                                        
<select <?php if($_REQUEST['post']=="request") { ?> onchange="fieldChain_add(this,<?php echo $field_value_trim[1]; ?>,<?php echo $field_value_trim[0]; ?>,<?php echo $_REQUEST['sub']; ?>);" <?php } else { ?>  onchange="fieldChain(this,<?php echo $field_value_trim[1]; ?>,<?php echo $field_value_trim[0]; ?>,<?php echo $_REQUEST['sub']; ?>,<?php echo $_REQUEST['id']; ?>);" <?php } ?> name="<?php echo $name;?>" id="<?php echo $row_value1->addpost_field_id;?>"  class="form-control">
<?php
$stringcond=",".$field_value_trims;
$droplist_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and field_DV_id='$field_value_trim[0]' order by field_priority asc");

while($list = mysqli_fetch_array($droplist_query)){
$values_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and addpost_fields_value=".$list['fields_id']." and pots_field_DV_id!=0");

$row_value=mysqli_fetch_object($values_query);
?>
<option data-tokens="<?php echo $list['field_value']; ?>" <?php if($list['fields_id'] == $row_value1->addpost_fields_value){ ?> selected="selected" <?php } ?> value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>
<?php
}
?>
                                        </select>
    
 </div>
   <img style="display:none;" class="gif_cls" src="css/images/745.gif" />
    <div id="ajax_select" style="display:none;">
    <div class="text-white">
    <?php 
	$title_query_1 = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_id=$field_value_trim[1]");
	$maintitle_1 = mysqli_fetch_array($title_query_1);
    echo $name_1 = $maintitle_1['fields_title']; 
	$name_1 = str_replace(" ","_",$maintitle_1['fields_title']);
    ?>
    <?php 
	$title_query_0 = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_id=$field_value_trim[0]");
	$maintitle_0 = mysqli_fetch_array($title_query_0);
	$name_0 = str_replace(" ","_",$maintitle_0['fields_title']);
    ?>
   </div>
     
    <select onblur="fieldUpdated_2(this,<?php echo $name_0; ?>);" name="<?php echo $name_1;?>"  class="form-control" style="width:78%;">
                                        <?php
                                        $stringcond=",".$field_value_trims;
                                        $droplist_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and field_DV_id='$field_value_trim[1]'");
                                        while($list = mysqli_fetch_array($droplist_query)){
                                        $values_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and addpost_fields_value=".$list['fields_id']."");
                                        $row_value=mysqli_fetch_object($values_query);
										?>
                                       
                                        <option <?php if($list['fields_id'] == $row_value->addpost_fields_value){ ?> selected="selected" <?php } ?> value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>
                                        
                                        <?php
                                        }
                                        ?>
                                        <option value="" selected="selected">--Select--</option>
                                        </select>
    
    </div>
    </div>
    <?php
	}
	?>
                                

                                <div class="form-group">
                                <label class="mylabel pb-1" for="pro_description"><?php echo $desc_label; ?> *</label>
<?php if($id_check==""){ ?>
                            <textarea  required class="form-control" id="pro_description" name="pro_description"></textarea>
                             <?php } else{ ?><textarea  required class="form-control" id="pro_description" name="pro_description"><?php echo $rows->pic_discription; ?></textarea><?php }  ?>
                                        
                                    
                                </div>
                                
                                
                                
                                <?php
                                       if(isset($_REQUEST['sub'])){
									
										$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id=".$_REQUEST['sub']."");
										$row=mysqli_fetch_object($categories_query);
										
										$chk_row = mysqli_num_rows($categories_query );
										
										if($chk_row==1 and $row->cat_search_title!=""){
										
										
									?>
									
                               <div class="form-group">
                                <label for="pro_tag" class="mylabel pb-1">
                                    <?php if($row->cat_search_title!=""){ echo $row->cat_search_title."*"; } else { echo "Serach Tags *"; } ?>
                                   </label>
                                   
                                    <?php if($id_check==""){ ?>
                            <textarea placeholder="This <?php echo $row->cat_search_title; ?> has a character limit of <?php echo $row->cat_search_limit; ?>." required maxlength="<?php echo $row->cat_search_limit; ?>" class="form-control" id="pro_tag" name="pro_tag"></textarea>
                             <?php } else{ ?><textarea placeholder="This <?php echo $row->cat_search_title; ?> has a character limit of <?php echo $row->cat_search_limit; ?>." required maxlength="<?php echo $row->cat_search_limit; ?>" class="form-control" id="pro_tag" name="pro_tag"><?php echo $rows->pic_tag; ?></textarea><?php }  ?>
									
                                        
                                   
                                </div>
                                <?php
                                
                                }
                                }
                                ?>
                                <style>
                                .img-thumbnail{
                                max-width:180px;
                                }
                               
                                </style>
                               <?php if($id_check==""){ ?>
								<label class="mylabel pb-1" for="files">Image *</label>
                                <div class="form-group">
                                <img id="blah" src="http://placehold.it/1000x1000" class="img-thumbnail" alt="your image" />
                                </div>
                                 <div class="form-group">
                            <input class="form-control-file" type="file" name="files[]" accept="image/*"  id="files" onchange="readURL(this);">
                            </div>
                             
                              
                           
                             <?php } else{ ?>
                             <div class="form-group">
                             <a href="#editroute" data-toggle="modal"  ads-id="<?php echo $_REQUEST['id']; ?>"  class="editroute btn btn-light btn-block"><i class="fa fa-camera"></i> Pictures</a>
                             </div>
                             <?php
							 
							 }  ?>
                                
<div class="form-check">

<?php if($id_check==""){ ?>

<input required  type="checkbox" value="true" class="form-check-input"  id="confirm" name="ageConfirmChk">
<?php } else{ ?><input required  type="checkbox" value="true"  id="confirm" name="ageConfirmChk" class="form-check-input" checked><?php }  ?>
<label class="form-check-label" for="confirm">&nbsp;I confirm that I am 18 years or older</label>
</div>
                               
                              <link rel="stylesheet" href="dist/ladda.min.css">
                             
                             <div class="form-group">
                                <button  type="submit" name="posting_ad" id="submit_final_btn" class="btn btn-lg btn-primary btn-block text-uppercase ladda-button" data-color="blue" data-style="expand-left"><span class="ladda-label">Submit</span></button>
                                
                            </div>
                            
                        
                    </div>
                    
                                        <script src="dist/spin.min.js"></script>
		<script src="dist/ladda.min.js"></script>

		<script>
			Ladda.bind( '#submit_final_btn' );
		</script>
        <div class="col-sm-12 col-md-12 col-lg-6 pb-0">
        <div class="row p-4 bg-secondary rounded-lg">

                             
   
    
                            <h5 class="default">Contact Details</h5>
                            
                            <div class="col-sm-12 col-md-12 col-lg-12 pb-0">
                            <hr>



                            <?php
							if(!empty($_SESSION['pic']['biscuit']['userid'])){
							
							$this->conatctDetails();
							$this->notifyForm();
							
							}
							else{
							
							$this->conatctForm();
							$this->notifyForm();
							
							}
							?>
                            
                            </div>
                            
                        
                    </div>
                    </div>
                    
                    </form>
        
                  <div class="modal fade bd-example-modal-lg" id="editroute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Picture</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body" id="dynamicedit">

	<?php 
    if($id_check!=""){             
    $categories_query2 = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_images where addpost_id=".$id_check." ORDER BY `ad_image_order` ASC ");
	$i=1;
    while($row1=mysqli_fetch_object($categories_query2)){
    
    ?>

   <div class="container bg-light p-2 mb-2" style="border:1px dashed #ccc;">
   <h5 class="">Picture <?php echo $i; ?></h5>
   <hr />
   <form id="uploadimage_<?php echo $row1->ad_image_id; ?>" action="" method="post" enctype="multipart/form-data">
   <div class="row img_preview">
   
   <div class="col-sm-6 col-md-6 col-lg-6 pb-0">
    <div class="content_div form-group"> 
   <?php
   if($row1->ad_image_url!=""){ ?>
   <img  id="blah_files_<?php echo $row1->ad_image_id; ?>" class="img-thumbnail" src="media/small/<?php echo $row1->ad_image_url; ?>">
   <?php
   }
   else{
   ?>
   <img id="blah_files_<?php echo $row1->ad_image_id; ?>" class="img-thumbnail" src="http://placehold.it/1000x1000">
   <?php 
   }
   ?>
    </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 pb-0">
   
    <div class="form-group">
        <label for="files_<?php echo $row1->ad_image_id; ?>">Browse to upload</label>
        <input class="form-control-file" type="file" accept="image/*" name="files[]" id="files_<?php echo $row1->ad_image_id; ?>" onchange="readURL_more(this);" >
        </div>
   
   </div>
   		
        
        <input type="hidden" name="adsid" value="<?php echo $row1->addpost_id; ?>"  />
        <input type="hidden" name="rowid" value="<?php echo $row1->ad_image_id; ?>"  />
       
        <div class="col-sm-6 col-md-6 col-lg-6 pb-0">
        <div class="form-group">
        <label for="textfield_<?php echo $row1->ad_image_id; ?>">Title</label>
       <input type="text" name="title_img" id="textfield_<?php echo $row1->ad_image_id; ?>" value="<?php echo $row1->ad_image_title; ?>" class="form-control" />
       </div>
       </div>
      
       
       <div class="col-sm-6 col-md-6 col-lg-6 pb-0">
       <div class="form-group">
       <label for="textfield2_<?php echo $row1->ad_image_id; ?>">Description</label>
       <input type="text" name="desc_img" id="textfield2" value="<?php echo $row1->ad_image_desc; ?>" class="form-control" />
       </div>
       </div>
       <div class="col-sm-12 col-md-12 col-lg-12 pb-0">
    <div class="form-group">
      <input type="button" name="button" id="<?php echo $row1->ad_image_id; ?>" value="Update" onclick="update_img(this);" class="btn btn-primary"  />
   </div>
   <div class="loading_img" style="display:none;" id='loading_<?php echo $row1->ad_image_id; ?>' ><img style="width: 96%;padding-top: 2%;" src="css/images/745.gif" /></div>
   </div>
   </div>
   
   
   </form>
   </div>
  
   
   
   
   
 
 <?php
 	$i++;
  }
  
  }
 ?>

    </div>

  </div>

</div>

</div>
 <br>
                             


        
                    </div>
                </div>
           
        
        <?php
    }

public function conatctForm() {
	?>
   
	<div class="form-check">
	<div class="mylabel pb-1">You are an *</div>
    <input name="areYou"  type="radio" value="0" checked="checked" id="Individual" class="form-check-input">
	<label class="form-check-label" for="Individual">Individual</label>
    <input type="radio"  value="1"  name="areYou" id="Business" class="form-check-input">
    <label class="form-check-label" for="Business">Business</label>
    </div>
    
	<div class="form-group">
    <label for="name">Name *</label>
	<input type="text" required class="form-control" id="name" name="name">
	</div>
    
    <div class="form-group">
    <label for="email">Name *</label>
    <input required  type="email" class="form-control" id="email" name="email" value="<?php
	if (isset($_POST['register'])) {
	echo $_POST['email'];
	}
	?>">
	<input type="text" required class="form-control" id="name" name="name">
	</div>
    
    
	
	
	
	
	<div class="col-2">
	<div class="space_10"></div>
	<div class="search-title"><strong> Mobile *</strong></div>
	<div class="space_10"></div>
	<div class="rows">
	
	<input type="text" disabled="disabled" value="+91" class="form_txt" id="phone_prefix" name="mobile_prefix" maxlength="10" size="2" style="width:5%;"> <input required type="text" pattern="[789][0-9]{9}" value="<?php
	if (isset($_POST['register'])) {
	echo $_POST['mobile'];
	}
	?>"  id="mobile" name="mobile" maxlength="10" class="form_txt" size="20" style="width:67%;">
	<div>(We will verify this number for privacy protection)</div>
	<div class="space_10"></div>
	</div>
	</div>
	
	<div class="col-2">
	<div class="space_10"></div>
	<div class="search-title"><strong>Select District *</strong></div>
	<div class="space_10"></div>
	<div class="rows">
	<select class="form_txt"  name="city" id="city" onchange="javascript:taluk();">
	<option value="0" selected>Select</option>
	<?php
	
	$location_query = mysqli_query($this->mysqlConfig(),"select DISTINCT city1 from pic_geometric order by lan,lon ASC");
	
	while($row = mysqli_fetch_object($location_query)){
	?>
	
	<option  <?php if(!empty($_SESSION['pic']['biscuit']['city']) && $_SESSION['pic']['biscuit']['city']=="$row->city1") { ?> selected <?php } ?>> <?php echo $row->city1; ?> </option>
	
	<?php } ?>
	</select>
	
	
	
	</div>
	</div>
	<div class="space_10"></div>
	<div id="taluk">
	
	</div>
	<div class="space_10"></div>
	
	
	</div>
  
	
	<?php
	}
	public function conatctDetails() {
	
	
	?>
   
	
	<div class="form-label-group">
	<div class="mylabel pb-1">Choose Contact *</div>
	
	<select name="contact_customer" id="contact_customer" class="form-control form-control-lg"  onchange="ajax_contact();">
	    <option value="<?php echo $_SESSION['pic']['biscuit']['userid']; ?>">Own Contact</option>
        <?php 
		$qry = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_user` where `user_refer`='PA00".$_SESSION['pic']['biscuit']['userid']."' and user_type='Customer' and user_status=1");
		while($rw = mysqli_fetch_array($qry)){ ?>
        <option value="<?php echo $rw['user_id']; ?>">PA00<?php echo $rw['user_id']; ?>,<?php echo $rw['user_username']; ?>(<strong><?php echo $rw['user_id_unique']; ?></strong>)</option>
		<?php
		}
		?>
      
      </select>
	</div>
	
    <div id="ajax_contact_div">
    <?php
    $this->ajax_conatctDetails();
	?>
	</div>
	
	
    
	<?php
	}
	public function ajax_conatctDetails(){
	
	if(isset($_REQUEST['id'])){
	$ads = $_REQUEST['id'];
	}
	else{
	$ads = "";
	}
	if(empty($_REQUEST['id'])){
	
	
	if(isset($_POST['id_refer']) and $_POST['id_refer'] and !empty($_POST['id_refer'])){
	$userid = $_POST['id_refer'];
	$readonly="readonly";
		
	}
	else{
	$userid = $_SESSION['pic']['biscuit']['userid'];
	$email = $_SESSION['pic']['biscuit']['email'];
	$readonly="";
	}
	
	$user_query = mysqli_query($this->mysqlConfig(),"select * from pic_user where user_id=$userid");
	$user_fetch = mysqli_fetch_object($user_query);
	
	$full_name = $user_fetch->user_username;
	$mobile_no = $user_fetch->user_mobile;
	$usertype = $user_fetch->user_type;
	$city = $user_fetch->user_city;
	$email = $user_fetch->user_email;
	
	
	}
	else{
	
	$user_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_ads_id=$ads");
	$user_fetch = mysqli_fetch_object($user_query);
	
	$full_name = $user_fetch->pic_user_fullname;
	$mobile_no = $user_fetch->pic_user_mobile;
	$usertype = $user_fetch->pic_user_type;
	$city = $user_fetch->pic_post_city;
	$pic_sms = $user_fetch->pic_sms;
	$pic_privacy = $user_fetch->pic_privacy;
	$email = $user_fetch->pic_user_email;
	
	}
	?>
    <div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title"><?php echo $full_name; ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $email;?></h6>
    <p class="card-text"><?php echo $city; ?></p>
    <a href="#" class="card-link"><i class="fa fa-phone"></i> <?php echo $mobile_no; ?></a>
    
  </div>
</div>
    <input required type="hidden"  class="form_txt1" id="name"  name="name" value="<?php echo $full_name; ?>">
    <input required type="hidden"  class="form_txt"  id="email" name="email" value="<?php echo $email;?>">
    <input type="hidden" disabled="disabled" value="+91" class="form_txt" id="phone_prefix" name="mobile_prefix" maxlength="10" size="2" style="width:5%;"> 
	<input required type="hidden" pattern="[789][0-9]{9}" value="<?php echo $mobile_no; ?>"  id="mobile"  name="mobile" maxlength="10" class="form_txt" size="20" style="width:67%;">
    <input  type="hidden" value="<?php echo $city; ?>"  id="location" name="location" maxlength="10" class="form_txt" size="20" style="width:67%;">
	
	<div id="taluk">
	
	</div>
	
    <?php
	}
	
					
}
?>