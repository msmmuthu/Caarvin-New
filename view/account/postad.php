<?php

class postad {

    public function index() {
        ?>
        <style type="text/css">
            .account-left{
                width:54%;
                float:left;
                background:#f4f4f4;
                padding:3%;
            }

            .account-right{
                width: 30%;
                float:left;
                padding:3%;

            }

            .form_btn {
                background: none repeat scroll 0 0 #fb2106;
                border: 0 none;
                color: #fff;
                cursor: pointer;
                float: left;
                height: 34px;
                width:30%;

            }

            .form_txt {
                border: 1px solid #e2e2e2;
                border-radius: 2px;
                padding: 1%;
                width:75%

            }
			
 
        </style>
                    <link href="css/select2.min.css" rel="stylesheet" />
                    <script src="js/select2.min.js"></script>
         
           
        
        <div class="rows">
            <div class="container">
            
            <form  id="postad" name="postad" method="post" action="index.php" enctype="multipart/form-data">
                <div class="bor">
                
                    <div class="account-right">
                    

                        
                            <input type="hidden" name="action" value="model" />
                            <input type="hidden" name="module" value="postad" />
                            <input type="hidden" name="special" value="<?php echo $_REQUEST['special']; ?>" />
<?php
									if(isset($_REQUEST['id'])){
									
										$categories_querys = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_ads_id=".$_REQUEST['id']."");
										$rows=mysqli_fetch_object($categories_querys);
										
										$id_check = $rows->pic_ads_id;
										
										}
									?>
<?php if($rows->pic_ads_id==""){ ?>
                            <input type="hidden" name="post" value="postad insert" />
                             <?php } else{ ?><input type="hidden" name="post" value="postad update" />
<input type="hidden" name="id" value="<?php echo $rows->pic_ads_id; ?>" />
<?php }  ?>
                            <div class="title">Add Your Post</div>
                            <div class="space_10"></div>

                                <div class="space_10"></div>
                                <div class="space_10"></div>
                               
                                
                                <div class="col-2">
                                
                                <div class="search-title"><strong>Scheme *</strong></div>
                                  <div class="space_10"></div>
                                    
                                 

                            <?php
                            	if(!empty($_SESSION['pic']['biscuit']['userid'])){
							$scheme_query = mysqli_query($this->mysqlConfig(),"select *,SUM(pic_scheme_balance_qty) AS sum_ads from pic_scheme_user where payment_status='Approved' and pic_user_id=".$_SESSION['pic']['biscuit']['userid']." and pic_scheme_balance_qty!=0");
							$scheme_row = mysqli_fetch_object($scheme_query);
							
							?>
                            <div class="rows" style="background:#0099FF; border-radius:5px; border:1px solid #000;  padding:10px;">
                            <input name="scheme" type="radio" value="<?php echo $scheme_row->pic_scheme_user_id; ?>" checked >
                            &nbsp; &nbsp; <?php echo $scheme_row->sum_ads; ?> Remains
                            </div>
                             <div class="space_10"></div>
                             
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
                                 
                                    <div class="col-2">
                                    <div class="search-title"><strong> Title *</strong></div>
                                    <div class="space_10"></div>
                                    <div class="rows">
<?php if($rows->pic_ads_id==""){ ?>
                            <input required type="text"  class="form_txt" id="pro_title" name="pro_title">
                             <?php } else{ ?><input required type="text"  class="form_txt" id="pro_title" name="pro_title" value="<?php echo $rows->pic_title; ?>"><?php }  ?>
                                        
                                    </div>
                                    <div class="space_10"></div>
                                </div>
                                <div class="col-2">
                                    <div class="search-title"><strong>Category *</strong></div>
                                  <div class="space_10"></div>
                                    <div class="rows">
                                    <?php
									if(isset($_REQUEST['sub'])){
									
										$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id=".$_REQUEST['sub']."");
										$row=mysqli_fetch_object($categories_query);
										
										}
									?>
                                        <input type="text"  class="form_txt" id="pro_category" name="pro_category" value="<?php echo $row->categories_name; ?>" readonly>
                                        <input type="hidden"  class="form_txt" id="category_id" name="category_id" value="<?php echo $row->categories_id; ?>">
                                    </div>
                                    <div class="space_10"></div>
                                </div>
                                <div class="col-2">
                                    <div class="search-title"><strong> <?php echo $row->categories_price_label; ?> *</strong></div>
                                  <div class="space_10"></div>
                                    <div class="rows">
<?php if($rows->pic_ads_id==""){ ?>
                            <input type="number"   required class="form_txt" id="pro_price" name="pro_price">
                             <?php } else{ ?><input type="number"  required class="form_txt" id="pro_price" name="pro_price" value="<?php echo $rows->pic_price; ?>"><?php }  ?>
                                        
                                    </div>
                                    <div class="space_10"></div>
                                </div>
                                
                                 <?php
								 $temp="";
								 $field_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and fields_type='Chain' order by field_priority,fields_id ASC");
								 ?>
								 <?php
								 while($row=mysqli_fetch_object($field_query)){
								 ?>
                                <div class="col-2">
                                    <?php 
									$field_value_trim = trim($row->field_value, "from:");
									$field_value_trim = str_replace('to:', '', $field_value_trim);
									$field_value_trim = explode(',', $field_value_trim);
									?>
                                    <div class="search-title">
									  <strong>
									<?php 
                                    $title_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_id=$field_value_trim[0]");
                                    $maintitle = mysqli_fetch_array($title_query);
                                    echo $name =  $maintitle['fields_title']; 
									$name = str_replace(" ","_",$maintitle['fields_title']);
                                    ?>
								      </strong> </div>
                                  <div class="space_10"></div>
                                  
                                    <div class="rows">
					<?php $placeholder = $row->field_sample; ?>
                    <?php 
					
					$values_query1 = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and field_id='$field_value_trim[0]'");
                    $row_value1=mysqli_fetch_object($values_query1);
                    ?>
                   
                     
            
                    <select data-live-search="true" <?php if($_REQUEST['post']=="post") { ?> onchange="fieldChain_add(this,<?php echo $field_value_trim[1]; ?>,<?php echo $field_value_trim[0]; ?>,<?php echo $_REQUEST['sub']; ?>);" <?php } else { ?>  onchange="fieldChain(this,<?php echo $field_value_trim[1]; ?>,<?php echo $field_value_trim[0]; ?>,<?php echo $_REQUEST['sub']; ?>,<?php echo $_REQUEST['id']; ?>);" <?php } ?> name="<?php echo $name;?>" id="<?php echo $row_value1->addpost_field_id;?>"  class="js-example-basic-single" style="width:78%;">
                                        <?php
                                        $stringcond=",".$field_value_trims;
                                        $droplist_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and field_DV_id='$field_value_trim[0]'");
                                        while($list = mysqli_fetch_array($droplist_query)){
                                        $values_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and addpost_fields_value=".$list['fields_id']." and pots_field_DV_id!=0");
										
                                        $row_value=mysqli_fetch_object($values_query);
										?>
                                       
                                        <option data-tokens="<?php echo $list['field_value']; ?>" <?php if($list['fields_id'] == $row_value1->addpost_fields_value){ ?> selected="selected" <?php } ?> value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>
                                        
                                        <?php
                                        }
                                        ?>
                                        </select>
					<script>
                    // In your Javascript (external .js resource or <script> tag)
                    $(document).ready(function() {
                    $('.js-example-basic-single').select2();
                    });
                    </script>
                    
    <div class="space_10"></div>
   <img style="display:none;width: 78%;" class="gif_cls" src="css/images/745.gif" />
    <div id="ajax_select" style="display:none;">
    
    <div class="space_10"></div>
	    <div class="search-title">
    <strong>
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
    </strong> </div>
     <div class="space_10"></div>
     
    <select onblur="fieldUpdated_2(this,<?php echo $name_0; ?>);" name="<?php echo $name_1;?>"   class="js-example-basic-single2" style="width:78%;" disabled="disabled" required="required">
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
                                        
		<script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
        $('.js-example-basic-single2').select2();
        });
        </script>

    <div class="space_10"></div>
    </div>
    
    </div>
    </div>
	<?php
	$temp = $row->fields_title;
	$strrr = "and fields_id!=$field_value_trim[0] and fields_id!=$field_value_trim[1]";
}
								?>
                                <?php
								if($_REQUEST['req']==0){
								?>
                                 <?php
								 $temp="";
								 
								 $field_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and fields_type='DropDown' and field_DV_id=0 ".$strrr." order by field_priority,fields_id ASC");
								 ?>
                                 
								 <?php
								 while($row=mysqli_fetch_object($field_query)){
								 ?>
                                
                                <div class="col-2">
                                
                                <?php 
									if($temp!=$row->fields_title){
									?>
                                    <div class="search-title">
									  <strong>
									  <?php 
									echo $row->fields_title; 
									?>
								      </strong> </div>
                                  <div class="space_10"></div>
                                    <?php
                                    }
									?>
                                    <div class="rows">
                                        <?php $name = str_replace(" ","_",$row->fields_title); ?>
                                         <?php $placeholder = $row->field_sample; ?>
                                         
                                        <?php  
                                       
                                        $values_query1 = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and field_id='$row->fields_id'");
										$row_value1=mysqli_fetch_object($values_query1);
	?>
    
	<select onchange="fieldUpdated(this);" name="<?php echo $name;?>" id="<?php echo $row_value1->addpost_field_id; ?>" class="js-example-basic-single3" style="width:78%;">
		<?php
        $droplist_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and field_DV_id=".$row->fields_id."");
        while($list = mysqli_fetch_array($droplist_query)){
        ?>
        <option <?php if($list['fields_id']==$row_value1->addpost_fields_value){ ?> selected="selected" <?php } ?> value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>
        <?php
        }
        ?>
	</select>
    
    	<script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
        $('.js-example-basic-single3').select2();
        });
        </script>
    </div>
    </div>
    <div class="space_10"></div>
    
	<?php
	$temp = $row->fields_title;
	}

								?>
                                
                                  <?php
								 $temp="";
								 $field_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and fields_type!='Chain' and fields_type!='DropDown' order by field_priority,fields_id ASC");
								 ?>
                                 
								 <?php
								 while($row=mysqli_fetch_object($field_query)){
								 ?>
                                
                                <div class="col-2">
                                <?php 
									if($temp!=$row->fields_title){
									?>
                                    <div class="search-title">
									  <strong>
									  <?php 
									echo $row->fields_title; 
									?>
								      </strong> </div>
                                    <div class="space_10"></div>
                                    <?php
                                    }
									?>
                                    <div class="rows">
                                        <?php $name = str_replace(" ","_",$row->fields_title); ?>
                                         <?php $placeholder = $row->field_sample; ?>
                                        
                                        <?php
										if($row->fields_type=="Textbox" or $row->fields_type=="Text"){
										//echo $id_check;
										
										?>
                                        
										<?php if($id_check!=""){ ?>
										
										<?php
								 $value_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and field_id=$row->fields_id");
								 $row_vlaue=mysqli_fetch_object($value_query);
								 		?>
                                        
                                        <input id="<?php echo $row_vlaue->addpost_field_id; ?>" onchange="fieldUpdated(this);" type="text" required class="form_txt"  name="<?php echo $name; ?>" value="<?php echo $row_vlaue->addpost_fields_value; ?>">
                                        <?php
										}
										
										else{
										?>
                                         <input placeholder="<?php echo $placeholder; ?>"  type="text"  required class="form_txt" id="pro_price" name="<?php echo $name; ?>">
                                        <?php
										}
										}
										
										if($row->fields_type=="Numeric"){
										//echo $id_check;
										
										?>
                                        
										<?php if($id_check!=""){ ?>
										
										<?php
								 $value_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and addpost_fields_title='$name'");
								 $row_vlaue=mysqli_fetch_object($value_query);
								 		?>
                                        
                                        <input id="<?php echo $row_vlaue->addpost_field_id; ?>" onchange="fieldUpdated(this);"  type="number" required class="form_txt"  name="<?php echo $name; ?>" value="<?php echo $row_vlaue->addpost_fields_value; ?>">
                                        <?php
										}
										
										else{
										?>
                                         <input  placeholder="<?php echo $placeholder; ?>" type="number"  required class="form_txt" id="pro_price" name="<?php echo $name; ?>">
                                        <?php
										}
										}
										
										
										?>
                                     
                                    </div>
                                    <div class="space_10"></div>
                                </div>
                                
                                <?php
								
								}
								?>
                                
                                <?php
								}
								?>

                                <div class="col-2">
                                    <div class="search-title"><strong> Description *</strong></div>
                                  <div class="space_10"></div>
                                    <div class="rows">
<?php if($rows->pic_ads_id==""){ ?>
                            <textarea  required class="form_txt" id="pro_description" name="pro_description"></textarea>
                             <?php } else{ ?><textarea  required class="form_txt" id="pro_description" name="pro_description"><?php echo $rows->pic_discription; ?></textarea><?php }  ?>
                                        
                                    </div>
                                </div>
                                 <?php
                                       if(isset($_REQUEST['sub'])){
									
										$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id=".$_REQUEST['sub']." and cat_search=1");
										$row=mysqli_fetch_object($categories_query);
										
										$chk_row = mysqli_num_rows($categories_query );
										
										if($chk_row==1){
										
										
									?>
									
                                <div class="col-2">
                                
                                    <div class="search-title"> <strong>
                                    <?php if($row->cat_search_title!=""){ echo $row->cat_search_title."*"; } else { echo "Serach Tags *"; } ?>
                                    </strong> </div>
                                  <div class="space_10"></div>
                                    <div class="rows">
                                    <?php if($rows->pic_ads_id==""){ ?>
                            <textarea placeholder="This <?php echo $row->cat_search_title; ?> has a character limit of <?php echo $row->cat_search_limit; ?>." required maxlength="<?php echo $row->cat_search_limit; ?>" class="form_txt" id="pro_tag" name="pro_tag"></textarea>
                             <?php } else{ ?><textarea placeholder="This <?php echo $row->cat_search_title; ?> has a character limit of <?php echo $row->cat_search_limit; ?>." required maxlength="<?php echo $row->cat_search_limit; ?>" class="form_txt" id="pro_tag" name="pro_tag"><?php echo $rows->pic_tag; ?></textarea><?php }  ?>
									
                                        
                                    </div>
                                </div>
                                <?php
                                
                                }
                                }
                                ?>
                               
                                <div class="col-2">
                                    <div class="search-title"><strong> Image *</strong></div>
                                  <div class="space_10"></div>
                                    <div class="rows">
<?php if($rows->pic_ads_id==""){ ?>
                            <input type="file" name="files[]" accept="image/*"  id="files" >
                           
                             <?php } else{ ?>
                             <a class="mydialogbox" data-reveal-id="myModal" href="javascript:void(0);" style="background: #6a2800;padding: 2%;border-radius: 4px; color: #fff;">Picture</a>
                             
                             <?php
							 
							 
							 }  ?>
                                        
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="space_10"></div>
                                    <div class="search-title">
<?php if($rows->pic_ads_id==""){ ?>
                            <input type="checkbox" value="true"  id="confirm" name="ageConfirmChk">&nbsp;I confirm that I am 18 years or older
                             <?php } else{ ?><input type="checkbox" value="true"  id="confirm" name="ageConfirmChk" checked>&nbsp;I confirm that I am 18 years or older<?php }  ?>
</div></div>
                                <div class="space_10"></div>
                                <div class="space_10"></div>
                            
                             <link rel="stylesheet" href="dist/ladda.min.css">
                             
                             <div class="col-2">
                                <button style="width:100%;" type="submit" name="posting_ad" class="btn btn-primary ladda-button" data-color="green" data-style="expand-left"><span class="ladda-label">Submit</span></button>
                                
                            </div>
                            <div class="space_10"></div>
                            <div class="space_10"></div>
                        
                    </div>
                    <script src="dist/spin.min.js"></script>
		<script src="dist/ladda.min.js"></script>

		<script>
			Ladda.bind( 'button[type=submit]' );
		</script>
        
        <?php
		 if(isset($_REQUEST['sub'])){
		$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id=".$_REQUEST['sub']." and categories_maps=1");
		$row=mysqli_fetch_object($categories_query);
		$chk_row = mysqli_num_rows($categories_query);
		if($chk_row==1){
		?>
               <div class="account-left" style="float:right;background: none;padding:0%;width:60%;">    
                     <style>
	 #map{
	 overflow: hidden !important;
	 width:100%;
	 height:300px; 
	 }
	 </style>
     
    <div id="map"></div>
      <input type='hidden' id='lati' name="lati"/>
    <input type='hidden' id='longi' name="longi"/>
    
    <script>
      var map;
      var marker;
      var infowindow;
      var messagewindow;

      function initMap() {
	  /*navigator.geolocation.getCurrentPosition(showPosition);*/
        var location_lat_lan = {lat: 9.923817, lng: 78.119717};
        map = new google.maps.Map(document.getElementById('map'), {
          center: location_lat_lan,
          zoom: 14
        });

       

       /* google.maps.event.addListener(map, 'click', function(event) {
          marker = new google.maps.Marker({position: event.latLng,map: map});
		  var latlng = marker.getPosition();
		document.getElementById('name').value = latlng.lat();
		document.getElementById('address').value = latlng.lng();
		
		


          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });
        });*/
		
		google.maps.event.addListener(map, 'click', function(event) {
		  placeMarker(event.latLng);
		  var latlng = marker.getPosition();
		 document.getElementById('lati').value = latlng.lat();
		document.getElementById('longi').value = latlng.lng();
		});
		
      }
	  
		function placeMarker(location) {
			if ( marker ) {
				marker.setPosition(location);
			} else {
				marker = new google.maps.Marker({
				position: location,
				map: map
			});
			}
		}

	  

      function doNothing () {
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBftT0VSAqnfOPxDB5fnznkZDTfRTwtfyw&callback=initMap">
    </script>
    </div>
    
    <?php
	}
	}
	
	?>
                    <div class="account-left" style="float:right;">

                             
   
    
                            <div class="title">Contact Details</div>
                            <div class="space_10"></div>



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
                    </form>
                    
       
	     
        <div id="myModal" class="reveal-modal">
        <a class="close-reveal-modal">&#215;</a>
        
	   <?php              
$categories_query2 = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_images where addpost_id=".$rows->pic_ads_id." ORDER BY `ad_image_order` ASC ");
										while($row1=mysqli_fetch_object($categories_query2)){
										
 ?>

   
   <form id="uploadimage_<?php echo $row1->ad_image_id; ?>" action="" method="post" enctype="multipart/form-data">
   <div class="img_preview">
   
   <div class="content_div" style="margin-right: 5%;border: 1px solid #ccc;"> 
   <?php
   if($row1->ad_image_url!=""){ ?>
   <img style="height:100px; width:100px;" src="media/small/<?php echo $row1->ad_image_url; ?>">
   <?php
   }
   else{
   ?>
   <img style="height:100px; width:100px;" src="css/images/no_images.jpg">
   <?php 
   }
   ?>
    </div>
   
   <div class="content_div">
   		
        <input type="file" accept="image/*" name="files[]" id="files_<?php echo $row1->ad_image_id; ?>" >
        <input type="hidden" name="adsid" value="<?php echo $row1->addpost_id; ?>"  />
        <input type="hidden" name="rowid" value="<?php echo $row1->ad_image_id; ?>"  />
        
        <br />
        <br />
        Title:
       <input type="text" name="title_img" id="textfield" value="<?php echo $row1->ad_image_title; ?>" />
       <br />
       <br />
       Description:
       <input type="text" name="desc_img" id="textfield2" value="<?php echo $row1->ad_image_desc; ?>" />
       
   </div>
   
   
    <div class="content_div" style="clear: left;width: 50%;">
      <input type="button" name="button" id="<?php echo $row1->ad_image_id; ?>" value="Update" onclick="update_img(this);"  />
   </div>
   <div class="loading_img" id='loading_<?php echo $row1->ad_image_id; ?>' ><img style="width: 96%;padding-top: 2%;" src="css/images/745.gif" /></div>
   </div>
   </form>
   
   
   
   
 
 <?php
  }
 ?>
  
 </div>

 <br>
                             


        
                    </div>
                </div>
           
        <?php
    }

	public function conatctForm() {
	?>
   
	<div>
	<div class="search-title">You are an * &nbsp;&nbsp;<input name="areYou"  type="radio" value="0" checked="checked">
	<span class="label">Individual</span> <span class="label">&nbsp; or &nbsp;</span> <input type="radio"  value="1"  name="areYou"> <span class="label">Business</span><span class="label"> ? &nbsp;</span></div>
	<div class="space_10"></div>
	
	<div class="col-2">
	<div class="space_10"></div>
	<div class="search-title"><strong> Name *</strong></div>
	<div class="space_10"></div>
	<div class="rows">
	<input type="text" required class="form_txt1" id="name" name="name">
	</div>
	</div>
	<div class="col-2">
	<div class="space_10"></div>
	<div class="search-title"><strong>Email *</strong></div>
	<div class="space_10"></div>
	<div class="rows">
	<input required  type="email" class="form_txt" id="email" name="email" value="<?php
	if (isset($_POST['register'])) {
	echo $_POST['email'];
	}
	?>">
	</div>
	
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
   
	
	<div>
	
	
	
    <div class="col-2">
	<div class="space_10"></div>
	<div class="search-title"><strong> Choose Contact *</strong></div>
	<div class="space_10"></div>
	<div class="rows">
    <script>
	
	</script>
	<select name="contact_customer" id="contact_customer"  onchange="ajax_contact();">
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
	</div>
    <div id="ajax_contact_div">
    <?php
    $this->ajax_conatctDetails();
	?>
	</div>
	
	</div>
    
	<?php
	}
	
	public function ajax_conatctDetails(){
	$ads = $_REQUEST['id'];
	
	if(empty($ads)){
	
	
	if($_POST['id_refer'] and !empty($_POST['id_refer'])){
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
    
	<div class="col-2">
	<div class="space_10"></div>
	<div class="search-title"><strong> Name *</strong></div>
	<div class="space_10"></div>
	<div class="rows">
	<input required type="text"  class="form_txt1" id="name" <?php echo $readonly; ?> name="name" value="<?php echo $full_name; ?>">
	</div>
	</div>
	<div class="col-2">
	<div class="space_10"></div>
	<div class="search-title"><strong>Email *</strong></div>
	<div class="space_10"></div>
	<div class="rows">
	<input required type="email"  class="form_txt" <?php echo $readonly; ?> id="email" name="email" value="<?php
	echo $email;
	?>">
	</div>
	
	</div>
	<div class="col-2">
	<div class="space_10"></div>
	<div class="search-title"><strong> Mobile *</strong></div>
	<div class="space_10"></div>
	<div class="rows">
	
	<input type="text" disabled="disabled" value="+91" class="form_txt" id="phone_prefix" name="mobile_prefix" maxlength="10" size="2" style="width:5%;"> 
	<input required type="text" pattern="[789][0-9]{9}" value="<?php echo $mobile_no; ?>"  id="mobile" <?php echo $readonly; ?> name="mobile" maxlength="10" class="form_txt" size="20" style="width:67%;">
	<div>(We will verify this number for privacy protection)</div>
	<div class="space_10"></div>
	</div>
	</div>
	<div class="col-2">
	<div class="search-title"><strong>Current City *</strong></div>
	<div class="space_10"></div>
	<div class="rows">
	
	<input readonly="readonly" type="text" value="<?php echo $city; ?>"  id="location" name="location" maxlength="10" class="form_txt" size="20" style="width:67%;">
	
	
	</div>
	</div>
	<div class="space_10"></div>
	<div id="taluk">
	
	</div>
	<div class="space_10"></div>
    <?php
	}	
    
    
	public function notifyForm() {
	$ads = $_REQUEST['id'];
	$user_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_ads_id=$ads");
	$user_fetch = mysqli_fetch_object($user_query);
	
	$pic_sms = $user_fetch->pic_sms;
	$pic_privacy = $user_fetch->pic_privacy;
	
	
	?>
	<div>
	<div class="search-title"><strong>SMS Notification *</strong> &nbsp;&nbsp;
	<input name="sms"  type="radio" value="1" <?php if($pic_sms==1){ ?> checked="checked" <?php } ?>>
	<span class="label">Yes</span> <span class="label">&nbsp; or &nbsp;</span> <input  <?php if($pic_sms==0){ ?> checked="checked" <?php } ?> type="radio"  value="0"  name="sms"> <span class="label">No</span><span class="label"> ? &nbsp;</span></div>
	<div class="space_10"></div>
	<div class="search-title"><strong>Privacy *</strong> &nbsp;&nbsp;
	<input  <?php if($pic_privacy==1){ ?> checked="checked" <?php } ?> name="privacy"  type="radio" value="1" />
	<span class="label">Public</span> <span class="label">&nbsp; or &nbsp;</span> <input type="radio"  value="0"  name="privacy" <?php if($pic_privacy==0){ ?> checked="checked" <?php } ?>> <span class="label">Private</span><span class="label">&nbsp;</span></div>
	</div>
	
	<?php
	}
	public function ajaxChain() { ?>
    
    <div class="space_10"></div>
	    <div class="search-title">
    <strong>
    <?php 
	$title_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_id=".$_POST['filid']."");
	$maintitle = mysqli_fetch_array($title_query);
    echo $name = $maintitle['fields_title']; 
	$id = $maintitle['fields_id']; 
	$name = str_replace(" ","_",$maintitle['fields_title']);
    ?>
   
    
    </strong> </div>
     <div class="space_10"></div>
	<?php 
	
     $values_query1 = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and field_id=$id");
    $row_value1=mysqli_fetch_object($values_query1);
	
    ?>
   
  
 
     <select onchange="fieldUpdated(this);" name="<?php echo $name;?>" id="<?php echo $row_value1->addpost_field_id; ?>" class="js-example-basic-single4" style="width:78%;" required="required">
		<?php
		$stringcond=",".$_POST['value'];
        $droplist_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_POST['cat_id']." and field_chain_value LIKE '%{$stringcond}%'");
        while($list = mysqli_fetch_array($droplist_query)){
        ?>
        <?php //if(strpos($list['field_chain_value'], ",".$list['fields_id']) !== false){ ?>
        <option  value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>
        <?php //} ?>
        <?php
        }
        ?>
        <option value="" selected="selected">--Select--</option>
	</select>
    
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
        $('.js-example-basic-single4').select2();
        });
        </script>
  
  
 
    <div class="space_10"></div>
	
	<?php
	}
			
}
?>
