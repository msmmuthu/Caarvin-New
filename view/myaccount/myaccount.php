<?php

class myaccount extends config{

public function leftMenu(){
$myact_query = mysqli_query($this->mysqlConfig(),"select * from pic_user where user_status=1 and user_id=".$_SESSION['pic']['biscuit']['userid']."");
$myact_fetch = mysqli_fetch_array($myact_query);

?>

<style>
    .pac-container{
        z-index : 1051 !important;
    }
    </style>
    <script type="text/javascript">
  function initializeAutocompleteRegMan(){
    var input = document.getElementById('localityregman');
    var options = {}

    var autocomplete = new google.maps.places.Autocomplete(input, options);
		

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      var place = autocomplete.getPlace();
      var latreg = place.geometry.location.lat();
      var lngreg = place.geometry.location.lng();
      var placeId = place.place_id;
	  var city = "";
	  var state = "";
      // to set city name, using the locality param
      var componentForm = {
        locality: 'long_name',
		administrative_area_level_2 : "long_name",
		administrative_area_level_1 : "long_name",
      };
     
	   for (const component of place.address_components) {
          const addressType = component.types[0];

          if (componentForm[addressType]) {
            const val = component[componentForm[addressType]];
			if(addressType == "locality")
            $("#townreg").val(val);
			if(addressType == "administrative_area_level_2")
            city = val;
			if(addressType == "administrative_area_level_1")
            state = val;
          }
        }
	  $("#city_header_profile_man").val(city + ", " + state);
      $("#latregman").val(latregman);
      $("#lonregman").val(lngregman);
      //document.getElementById("location_id").value = placeId;
    });
  }
</script>

  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header p-0" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Profile
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body p-0">
       <ul>
	<li>
	<a href="index.php?action=view&module=myaccount&post=profile">View Profile</a>
	</li>
	<li>
	<a href="index.php?action=view&module=myaccount">Manage Profile</a>
	</li>
    <li>
	<a href="index.php?action=view&module=user_list&post=list">View Customer</a>
	</li>
    <?php
	if($myact_fetch['privacy_register']==1){
	?>
    <li>
	<a href="index.php?action=view&module=user_list&post=add">Add Customer</a>
	</li>
    <?php
	}
	?>
	</ul>
      </div>
    </div>
  </div>


  <?php
    if($myact_fetch['user_type']!="Customer"){ ?>
<div class="card">
    <div class="card-header p-0" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          Manage Ads Scheme
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body p-0">
       <ul>
  
	<li>
	<a href="index.php?action=view&module=myaccount&task=scehmelist">Purchase Scheme</a>
	</li>
   
	<li>
	<a href="index.php?action=view&module=myaccount&task=myscheme">Purchase History</a>
	</li>
    <li>
	<a href="index.php?action=view&module=myaccount&task=mybalance">Ads Account</a>
	</li>
	</ul>
      </div>
    </div>
</div>

 <?php } ?>

	<div class="card">
    <div class="card-header p-0" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          Ads History
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body p-0">
       <ul>
	<li>
	<a href="index.php?action=view&module=add_history">View All</a>
	</li>
	
	</ul>
      </div>
    </div>
	</div>


<div class="card">
	
    <div class="card-header p-0" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
         Like History
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body p-0">
       <ul>
	<li>
	<a href="index.php?action=view&module=myaccount&task=mylike">List of Like's</a>
	</li>
	
	</ul>
      </div>
    </div>
	
</div>
 <?php
    if($myact_fetch['user_type']!="Customer"){ ?>
<div class="card">
	
    <div class="card-header p-0" id="headingFive">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
         Specials Location & Category
        </button>
      </h5>
    </div>
    <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordionExample">
      <div class="card-body p-0">
       <ul>
	<li>
	<a href="index.php?action=view&module=myaccount&task=myloc">My Location Ads</a>
	</li>
    <li>
	<a href="index.php?action=view&module=myaccount&task=mycat">My Special Ads</a>
	</li>
	
	</ul>
      </div>
    </div>
	
</div>
<?php } ?>
</div>
<?php

}


public function schemeList(){

?>

<div class="container-fluid pt-4">
            <div class="row">
                	<div class="col-sm-12 col-md-12 col-lg-3">
                    
                    <?php $this->leftMenu(); ?>
      
                       
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9">
                    <form name="form_scheme_save" id="" action="index.php" method="post">
                    <input type="hidden" name="action" value="model">
                    <input type="hidden" name="module" value="myaccount">
                    <input type="hidden" name="task" value="scheme save">
                      
                      <table id="schemelist" class="table table-bordered">
                      <thead>
                        <tr align="left">
                          <th><strong>Scheme Name</strong></th>
                          <th><strong>Scheme Description</strong></th>
                          <th><strong>Price</strong></th>
                         
                          <th><strong>Select</strong></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
						$scheme_query = mysqli_query($this->mysqlConfig(),"select * from pic_scheme where scheme_status=1");
						while($scheme_row = mysqli_fetch_object($scheme_query)){
						?>
                        <tr align="left">
                          <td><?php echo $scheme_row->scheme_name; ?></td>
                           <td><?php echo $scheme_row->scheme_desc; ?></td>
                          <td><?php echo $scheme_row->scheme_price; ?></td>
                          
                          <td><input checked type="radio" name="plan" value="<?php echo $scheme_row->scheme_id; ?>"></td>
                        </tr>
                        <?php
						}
						?>
                        </tbody>
                        
                        <tr>
                        <td colspan="4" align="left"><label for="payment_details"><strong>Payment Details *</strong></label>
                        <input required class="form-control" type="text" name="payment_details" id="payment_details" placeholder="Payment Details">
                        
                        
                        </td>
                        </tr>
                        
                        <tr>
                         <td colspan="4" align="left">
                       
                           <label for="purpose"><strong>Ads Type *</strong></label>
                             <select class="form-control" name="purpose" id="purpose">
                        <option value="post" selected="selected">Post Ads</option>
                        <option value="request">Request Ads</option>
                                                                  </select>
                               
                               </td>
                      
                      </tr>
                      
                        <tr>
                         <td colspan="4" align="left">
                       
                           <?php
                            $scheme_query = mysqli_query($this->mysqlConfig(),"select *,SUM(pic_scheme_balance_qty) AS sum_ads from pic_scheme_user where pic_user_id=".$_SESSION['pic']['biscuit']['userid']." and pic_scheme_balance_qty!=0");
                            $scheme_row = mysqli_fetch_object($scheme_query);
                            if($scheme_row->sum_ads==0){
                           ?>
                            <input name="btn_scheme_save" type="submit" value="Save" class="btn btn-primary btn-lg">
                            <?php } else {?>
                            <div class="alert alert-warning" role="alert">
                                You purchased already! Please check your scheme status <a class="alert-link" href="index.php?action=view&module=myaccount&task=myscheme">Scheme Status</a>
                            </div>
                            <?php } ?>
                               
                               </td>
                      
                      </tr>
                      </table>
                      
                      </form>
                    </div>
                    
                
            </div>
</div>
<script>
		  $(document).ready(function() {
				$('#schemelist').DataTable({
				"paging":   false,
				"info":     false,
				"searching": false,
				"language": {
        			"emptyTable":     "No Scheme Founds"
   				}
				});
			} );
		  </script>
<?php
}

public function myLike(){

?>

  
<div class="container-fluid pt-4">
            <div class="row">
                
                    
                    <div class="col-sm-12 col-md-12 col-lg-3">
                    
                    <?php $this->leftMenu(); ?>
      
                       
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9">
                   
                    
                      <table id="example" class="table table-striped table-bordered">
                      <thead>
                        <tr align="left">
                          <th><strong>Ad ID</strong></th>
                          <th><strong>Ads Tile</strong></th>
                          <th><strong>Customer Name</strong></th>
                          <th><strong>Customer Mobile</strong></th>
                          <th><strong>Customer Email</strong></th>
                          <th><strong>Contact No</strong></th>
                       </thead>  
                        </tr>
                        <tbody>
                        <?php
						$like_query = mysqli_query($this->mysqlConfig(),"select * from pic_likes where likes_ads_user_id=".$_SESSION['pic']['biscuit']['userid']."");
						while($like_row = mysqli_fetch_object($like_query)){
						?>
                        <tr align="left">
                          <td><a href="index.php?action=view&module=product_detail&ads_id=<?php echo $like_row->likes_product_id; ?>"><?php echo $like_row->likes_product_id; ?></a></td>
                           <td><?php
                           $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_addpost` WHERE pic_ads_id=".$like_row->likes_product_id." LIMIT 1");
						   $row = mysqli_fetch_object($query);
						   echo "dsd".$row->pic_title;
						   ?>
                           </td>
                           <td><?php echo $like_row->likes_cus_name; ?></td>
                          <td><?php echo $like_row->likes_cus_mobile; ?></td>
                          <td><?php echo $like_row->likes_cus_email; ?></td>
                          <td><?php echo $like_row->contact_no; ?></td>
                          
                        </tr>
                        <?php
						}
						?>
                      </tbody>  
                      </table>
                      
                     
                    </div>
                
            </div>
</div>
<?php
}

	  
public function myCat(){

?>
  
<div class="container-fluid pt-4">
            <div class="row">
                
                <div class="col-sm-12 col-md-12 col-lg-3">
                    
                    <?php $this->leftMenu(); ?>
      
                       
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9">
                   
                    
                      <table id="example" class="table table-striped table-bordered">
                      <thead>
                        <tr align="left">
                          <th><strong>Ad ID</strong></th>
                          <th><strong>Customer Name</strong></th>
                          <th><strong>Customer Mobile</strong></th>
                          <th><strong>Customer Email</strong></th>
                          <th><strong>Location</strong></th>
                          <th><strong>Category</strong></th>
                           <th><strong>Status</strong></th>
                       </thead>  
                        </tr>
                        <tbody>
                        <?php
						
						$query=mysqli_query($this->mysqlConfig(),"select * from pic_user where user_id=".$_SESSION['pic']['biscuit']['userid']."");
						$row = mysqli_fetch_object($query);
						$special_location = $row->privacy_location;
						$special_location = substr($special_location, 1, -1);
						$special_location = str_replace("|","','",$special_location);
						$special_location = "('".$special_location."')";
						
						$special_category = $row->privacy_category;
						$special_category = substr($special_category, 1, -1);
						$special_category = str_replace("|",",",$special_category);
						$cat_char = "('".$special_category."')";
						//$special_category = array($special_category);
						//print_r($special_category);
						//require'view/misc/misc.php';
						//$subcat_array = new misc();
						//$cat_char = $subcat_array->subcatid($special_category);
						
						$query_ads = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_addpost` WHERE pic_special='yes' AND pic_refer_id=".$_SESSION['pic']['biscuit']['userid']." ORDER BY  `pic_addpost`.`pic_id` DESC");
						while($ads_row = mysqli_fetch_object($query_ads)){
						?>
                        <tr align="left">
                          <td>
                          <strong>Ads ID :</strong><a href="index.php?action=view&module=product_detail&ads_id=<?php echo $ads_row->pic_ads_id; ?>"><?php echo $ads_row->pic_ads_id; ?></a><br>
											<strong>Name :</strong> <?php echo $ads_row->pic_title; ?><br>
                                            
                          </td>
                          <td><?php echo $ads_row->pic_user_fullname; ?></td>
                          <td><?php echo $ads_row->pic_user_mobile; ?></td>
                          <td><?php echo $ads_row->pic_user_email; ?></td>
                          <td><?php echo $ads_row->pic_add_taluk; ?></td>
                          
                          
                          <td>
						  <?php 
						  $cat_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id=".$ads_row->pic_category."");
						  $cat_row = mysqli_fetch_object($cat_query);
						  echo $cat_row->categories_name; 
						  ?>
                          </td>
                           <td><?php if($ads_row->addpost_status=='0') { ?>Pending<?php } else { echo "Active"; } ?></td>
                          
                        </tr>
                        <?php
						}
						?>
                      </tbody>  
                      </table>
                      
                     
                    </div>
                    
                
            </div>
</div>
<?php
}
public function myLoc(){

?>
  
<div class="container-fluid pt-4">
            <div class="row">
                
                	<div class="col-sm-12 col-md-12 col-lg-3">
                    
                    <?php $this->leftMenu(); ?>
      
                       
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9">
                   
                    
                      <table id="example" class="table table-striped table-bordered">
                      <thead>
                        <tr align="left">
                          <th><strong>Ad ID</strong></th>
                          <th><strong>Customer Name</strong></th>
                          <th><strong>Customer Mobile</strong></th>
                          <th><strong>Customer Email</strong></th>
                          <th><strong>Location</strong></th>
                          <th><strong>Category</strong></th>
                       </thead>  
                        </tr>
                        <tbody>
                        <?php
						
						$query=mysqli_query($this->mysqlConfig(),"select * from pic_user where user_id=".$_SESSION['pic']['biscuit']['userid']."");
						$row = mysqli_fetch_object($query);
						$special_location = $row->privacy_location;
						$special_location = substr($special_location, 1, -1);
						$special_location = str_replace("|","','",$special_location);
						$special_location = "('".$special_location."')";
						
						$special_category = $row->privacy_category;
						$special_category = substr($special_category, 1, -1);
						$special_category = str_replace("|","','",$special_category);
						$cat_char = "('".$special_category."')";
						//require'view/misc/misc.php';
						//$subcat_array = new misc();
						//$cat_char = $subcat_array->subcatid($special_category);
						
						
						//echo "SELECT * FROM `pic_addpost` WHERE `pic_add_taluk` in ".$special_location." and `pic_category` in ".$cat_char." and addpost_status=1";
						
						$query_ads = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_addpost` WHERE `pic_add_taluk` in ".$special_location." and `pic_category` in ".$cat_char." and addpost_status=1");
						while($ads_row = mysqli_fetch_object($query_ads)){
						?>
                        <tr align="left">
                          <td>
                          <strong>Ads ID :</strong><a href="index.php?action=view&module=product_detail&ads_id=<?php echo $ads_row->pic_ads_id; ?>"><?php echo $ads_row->pic_ads_id; ?></a><br>
											<strong>Name :</strong> <?php echo $ads_row->pic_title; ?><br>
                                            
                          </td>
                           <td><?php echo $ads_row->pic_user_fullname; ?></td>
                          <td><?php echo $ads_row->pic_user_mobile; ?></td>
                          <td><?php echo $ads_row->pic_user_email; ?></td>
                          <td><?php echo $ads_row->pic_add_taluk; ?></td>
                         <td>
						  <?php 
						  $cat_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id=".$ads_row->pic_category."");
						  $cat_row = mysqli_fetch_object($cat_query);
						  echo $cat_row->categories_name; 
						  ?>
                          </td>
                          
                        </tr>
                        <?php
						}
						?>
                      </tbody>  
                      </table>
                      
                     
                    </div>
                    
                
            </div>
</div>
<?php
}

public function myScheme(){

?>

<div class="container-fluid pt-4">
            <div class="row">
                
                <div class="col-sm-12 col-md-12 col-lg-3">
                    
                    <?php $this->leftMenu(); ?>
      
                       
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9">
					

                    <form name="form_scheme_save" id="" action="index.php" method="post">
                    <input type="hidden" name="action" value="model">
                    <input type="hidden" name="module" value="myaccount">
                    <input type="hidden" name="task" value="scheme save">
                      <table id="example" class="table table-striped table-bordered">
                      <thead>
                        <tr align="left">
                        <th><strong>Date</strong></th>
                          <th><strong>Scheme Name</strong></th>
                          <th><strong>Allocated Ads</strong></th>
                          <th><strong>Cost</strong></th>
                          <th><strong>Payment Status</strong></th>
                           <th><strong>Payment Method</strong></th>
                          
                        </tr>
                        </thead>
                        <tbody>
                        <?php
						$scheme_query = mysqli_query($this->mysqlConfig(),"select * from pic_scheme_user where pic_user_id=".$_SESSION['pic']['biscuit']['userid']." ORDER BY  `pic_scheme_user_id` DESC ");
						$i = 0;
						$j = 0;
						while($scheme_row = mysqli_fetch_object($scheme_query)){
						
						?>
                        <tr align="left">
                          <td><?php echo date('d-m-Y', strtotime($scheme_row->scheme_purchased_date)); ?></td>
                          <td><?php echo $scheme_row->pic_scheme_name; ?></td>
                           <td><?php echo $scheme_row->total_ads; ?></td>
                          <td><?php echo $scheme_row->cost_scheme; ?></td>
                           <td><?php echo $scheme_row->payment_status; ?><br><span style="color:#fb2106;"><?php echo $scheme_row->payment_remarks; ?></span></td>
                          <td><?php echo $scheme_row->payment_method; ?></td>
                           
                        </tr>
                        <?php
						$i = $scheme_row->total_ads;
						$j = $scheme_row->pic_scheme_balance_qty;
						}
						?>
                      </tbody>  
                      </table>
                      
                      </form>
                    </div>
                    
                
            </div>
</div>
<?php
}

public function myBalance(){

?>

<div class="container-fluid pt-4">
            <div class="row">
                
                	<div class="col-sm-12 col-md-12 col-lg-3">
                    
                    <?php $this->leftMenu(); ?>
      
                       
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9">
					

                   
                      <table id="example" class="table table-striped table-bordered">
                      <thead>
                        <tr align="left">
                        <th><strong>Total Scheme</strong></th>
                          <th><strong>Total Ads</strong></th>
                           <th><strong>Total Used Ads</strong></th>
                          <th><strong>Total Balance Ads</strong></th>
                         
                          
                        </tr>
                        </thead>
                        <tbody>
                        <?php
						$scheme_query = mysqli_query($this->mysqlConfig(),"select sum(total_ads) as a,sum(pic_scheme_balance_qty) as b from pic_scheme_user where pic_user_id=".$_SESSION['pic']['biscuit']['userid']." and payment_status='Approved'");
						$count_scheme_query = mysqli_query($this->mysqlConfig(),"select * from pic_scheme_user where pic_user_id=".$_SESSION['pic']['biscuit']['userid']." and payment_status='Approved'");
						
						$count_scheme = mysqli_num_rows($count_scheme_query);
						
						$scheme_row = mysqli_fetch_object($scheme_query);
						?>
                        <tr align="left">
                          <td><?php echo $count_scheme; ?></td>
                          <td><?php echo $scheme_row->a; ?></td>
                          <td><?php echo $scheme_row->a-$scheme_row->b; ?></td>
                         <td><?php echo $scheme_row->b; ?></td>
                           
                        </tr>
                        
                      </tbody>  
                      </table>
                      
                      
                    </div>
                    
               
            </div>
</div>
<?php
}

public function index() {
	?>
	
	<div class="container-fluid pt-4">
		<div class="row">
			
            <div class="col-sm-12 col-md-12 col-lg-3">
				
				<?php $this->leftMenu(); ?>
  
				   
				</div>
                    
				<div class="col-sm-12 col-md-12 col-lg-9">
                                    <form  id="myacctform" name="myacctform" method="post" action="index.php" onSubmit="return myacct_validate();" enctype="multipart/form-data">
                                    <div class="row pt-4">
                    <div class="col-sm-10 col-md-10 col-lg-10 pb-0">
                    <h4>My Account Details</h4>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2 pb-0">
                        
                    </div>
                    </div>
                    <hr />
                    <div class="row">
                        <?php

$myact_query = mysqli_query($this->mysqlConfig(),"select * from pic_user where user_status=1 and user_id=".$_SESSION['pic']['biscuit']['userid']."");
$myact_fetch = mysqli_fetch_array($myact_query);

if($myact_fetch['user_pic']==''){
    $img_url = 'img/avatar.jpg';
}
else{
    $img_url = 'media/profile/'.$myact_fetch['user_pic'];
}


?>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <link rel='stylesheet prefetch' href='https://foliotek.github.io/Croppie/croppie.css'>
    
   <style>
  label.cabinet{
	display: block;
	cursor: pointer;
	
}

label.cabinet input.file{
	position: relative;
	
	width: auto;
	opacity: 0;
	-moz-opacity: 0;
  filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  margin-top:-30px;
}

#upload-demo{
	/*width: 350px;*/
	height: 486px;
  padding-bottom:25px;
}
figure figcaption {
 
  bottom: 0;
  color: #fff;
  width: 100%;
  padding-left: 9px;
  padding-bottom: 5px;
  text-shadow: 0 0 10px #000;
}
  </style>

    
    <label class="mylabel" for="profile_pic">Photo *</label>
    <div class="form-group">
    <label class="cabinet center-block">
    <figure>
    <img src="<?php echo $img_url; ?>" class="gambar img-responsive img-thumbnail" id="item-img-output" width="150"/>
    <input type="hidden" name="crop_final_data" id="crop_final_data" value=""  />
    <figcaption><i class="fa fa-camera"></i></figcaption>
    </figure>
    <input type="file" class="item-img file center-block form-control custom-file-input" name="file_photo"/>
    </label>
    </div>
    <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-body">
                        <div id="upload-demo" class="center-block"></div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">
                            <label class="mylabel" for="name">Name *</label>
                            <input type="text"  required class="form-control" id="name" name="name" value="<?php echo $myact_fetch['user_username']; ?>">
                            </div>
                            
                            <div class="form-group">
                            <label for="dob" class="mylabel">Date of Birth *</label>
                            <?php
                            $dob = $myact_fetch['user_dob'];
                            if($dob!='0000-00-00'){ 

                            $dob = str_replace('-', '/', $dob);
                            $dob = date('Y-m-d', strtotime($dob));
                            }
                            else
                            {
                            $dob = "";
                            }
                            ?>
                            <input class="form-control" type="date" name="dob"  id="dob" value="<?php echo $dob;?>">
                            </div>
                            
                            <div class="form-group">
                            <label class="mylabel" for="exampleRadios1">Sex</label>
                            <div class="form-check">
                            <input class="form-check-input" <?php if($myact_fetch['user_sex']=="Male"){ ?> checked="checked" <?php } ?> type="radio" name="Sex" value="Male" id="Sex_0" />
                            <label class="form-check-label" for="exampleRadios1">
                            Male
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" <?php if($myact_fetch['user_sex']=="Female"){ ?> checked="checked" <?php } ?> type="radio" name="Sex" value="Female" id="Sex_1" />
                            <label class="form-check-label" for="exampleRadios1">
                            Female
                            </label>
                            </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                            <label class="mylabel" for="name1">Introducer ID</label>
                            <input autofocus disabled="disabled"  type="text" class="form-control" id="name1" name="name1" value="<?php echo $myact_fetch['user_refer']; ?>">
                            </div>

                            <div class="form-group">
                            <label class="mylabel" for="name2">Customer ID</label>
                            <input autofocus disabled="disabled"  type="text" class="form-control" id="name2" name="name2" value="PA00<?php echo $myact_fetch['user_id']; ?>">
                            </div>

                            <div class="form-group">
                            <label class="mylabel" for="name3">User Type</label>
                            <input type="text" disabled="disabled"  class="form-control" id="name3" name="name3" value="<?php echo $myact_fetch['user_type']; ?>">
                            </div>
                            </div>
                    </div>
                        <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                        


    <input type="hidden" name="action" value="model" />
    <input type="hidden" name="module" value="myaccount" />
    <input type="hidden" name="post" value="update" />

    
    
    
    
    <div class="form-group">
    <label class="mylabel" for="email">Username / Email*</label>
    <input required disabled type="text"  class="form-control" id="email" name="email" value="<?php echo $myact_fetch['user_email']; ?>">
    </div>
    
    <div class="form-group">
    <label class="mylabel" for="pass">Current Password *</label>
    <input type="password"  required class="form-control" id="pass" name="pass" placeholder="<?php echo $myact_fetch['user_password'];?>">
    </div>
    <div class="form-group">
    <label class="mylabel" for="pass_new">New Password</label>
    <input type="password"  class="form-control" id="pass_new" name="pass_new" placeholder="Leave empty to use this <?php echo $myact_fetch['user_password'];?> password..">
    </div>
    
    <div class="form-group">
    <label class="mylabel" for="pass_confirm">Confirm Password</label>
    <input type="password"  class="form-control" id="pass_confirm" name="pass_confirm" placeholder="Leave empty to use this <?php echo $myact_fetch['user_password'];?> password..">
    </div>
    
    
    
    
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            
                            
                            
    
    <label class="mylabel" for="pass_confirm">Mobile *</label>
    <div class="input-group form-group">
    
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">+91</span>
    </div>
    <input disabled type="number" value="<?php echo $myact_fetch['user_mobile']; ?>"  id="phone" name="mobile" maxlength="10" class="form-control" size="20" style="width:67%;">
    </div>
    
  

    <div class="form-group">
            <!-- <select class="form-control"  name="city_header_profile" id="city_header_profile" onchange="javascript:taluk_header_profile();">
            <option value="0" >Select</option>
            <?php
            $location_query = mysqli_query($this->mysqlConfig(),"select DISTINCT city1 from pic_geometric order by lan,lon ASC");
            while($row = mysqli_fetch_object($location_query)){
            ?>
            <option  <?php if(!empty($myact_fetch['user_city']) && $myact_fetch['user_city']=="$row->city1") { ?> selected <?php } ?>> <?php echo $row->city1; ?> </option>
            <?php } ?>
            </select> -->
            <label class="mylabel" for="city_header_profile_man">City *</label>
            
            <input style="display:none;" class="form-control" style="margin-top: 6px;width:100%;" type="text" placeholder="Search your town and district...." name="addressregman" onFocus="initializeAutocompleteRegMan()" id="localityregman" />
                
                       
                <input value='<?php if(!empty($myact_fetch['user_city'])) {echo $myact_fetch['user_city'];}  ?>' id="city_header_profile_man" class="form-control" style="margin-top: 6px;width:100%;" type="text" name="city_header_profile_man"  required placeholder="City..." />
                <a href="#" id="change_loc_man" onClick="(function(){
                  
                  $('#localityregman').show();
                  $('#townregman').hide();
		            $('#city_header_profile_man').hide();
                  $('#change_locman').hide();
                        return false;
                  })();return false;">Change Location</a>
              

              <input type="hidden"  name="townregman" id="townregman" />
        
              <input type="hidden" name="latregman" id="latregman" value=""/>
                <input type="hidden" name="lonregman" id="lonregman"  value="" />
    </div>
    <!-- <div id="taluk_header_profile">
    <div class="form-group">
        <input type="hidden" name="taluk_select" value="<?php echo $myact_fetch['user_taluk']; ?>">
        <label for="taluk_select" class="mylabel">Select Taluk *</label>
        <input type="text" class="form-control" disabled name="" id="taluk_select" value="<?php echo $myact_fetch['user_taluk']; ?>">
    </div>
    </div>
     -->
    <style>
        #set_loc_btn{
            display:none;
        }
    </style>
   
    

   <div class="form-group">

   <input type="hidden" name="hdnUserDocument" id="hdnUserDocument" value="<?php echo ($myact_fetch['user_document']) ? $myact_fetch['user_document'] : ""; ?>">


  <style>
  .img-thumbnail {
  max-width: 150px;
  }
  </style>
  <script type="text/javascript">
    function checkFileUpload(fileId) {
      var browseFileId = document.getElementById(fileId);
      var fileUploadTxtId = document.getElementById('fileUploadTxt');
      var fileUploadErrHolderId = document.getElementById('fileUploadErrHolderId');
      if (browseFileId.files.length === 0) {
      return;
    }
    console.log(browseFileId.files[0]);
    var fileInfo = browseFileId.files[0];
    var fileType = fileInfo.type;
    if (fileType.indexOf('word') >= 0 || fileType.indexOf('pdf') >= 0) {
      fileUploadErrHolderId.style.display = 'none';
      fileUploadTxtId.innerHTML = fileInfo.name;
    } else {
      browseFileId.value = '';
      fileUploadErrHolderId.style.display = 'block';
      fileUploadTxtId.innerHTML = 'Upload File *';
    }
  }
  </script>

  <label class="mylabel" for="city_header_profile">Upload Document *</label>
  <div class="editroute btn btn-light btn-block" style="position:relative;">
      <input id="fileUploadId" type="file" name="fileUpload[]" class="fileUploadCls" onchange="checkFileUpload('fileUploadId')" value="" />
      <span><i class="fa fa-upload"></i> <span id="fileUploadTxt">Upload </span></span>
  </div>
  <div id="fileUploadErrHolderId" class="form-group">
      <div class="fileUploadErrMsgCls">Permitted file types : pdf, doc, docx</div>
  </div>


  <?php

                        if($myact_fetch['user_document']!=''){
                       
                          $file_name = 'media/uploadfiles/'.$myact_fetch['user_document'];
                       
                        ?>


                            <div class="form-group">
                            <div class="hint">
                            <a target="_blank" href="<?php echo BASE_URL . 'media/uploadfiles/'. $myact_fetch['user_document']; ?>">
                                Download
                            </a>
                            </div>
                            </div>
                            
                            
                            
                        <?php } ?>


    </div>    


<!--
<div >
<a href="index.php?action=view&module=add_history">My Advertisement History</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href="index.php?action=view&module=like_history">Like History</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="index.php?action=view&module=req_history">My Request History</a>
</div>-->

                        </div>
                        
                        </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                        <input style="width:25%;" type="submit" name="update" class="btn btn-lg btn-primary btn-block text-uppercase" value="update">
                        </div>
                        </div>
                    </div>
				
			
		</div>
                            </form>

	</div>
        </div>
        </div>
	<?php
}

public function profile() {
	?>
	<div class="container-fluid pt-4">
		<div class="row">
			
            <div class="col-sm-5 col-md-5 col-lg-3">
				
				<?php $this->leftMenu(); ?>
  
				   
				</div>
                    
				<div class="col-sm-7 col-md-7 col-lg-9">
                                    <div class="row pt-4">
                    <div class="col-sm-10 col-md-10 col-lg-10 pb-0">
                    <h4>My Profile</h4>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2 pb-0">
                        
                    </div>
                    </div>
                    <hr />
                    <div class="row">
                        <?php

$myact_query = mysqli_query($this->mysqlConfig(),"select * from pic_user where user_status=1 and user_id=".$_SESSION['pic']['biscuit']['userid']."");
$myact_fetch = mysqli_fetch_array($myact_query);

if($myact_fetch['user_pic']==''){
    $img_url = 'img/avatar.jpg';
}
else{
    $img_url = 'media/profile/'.$myact_fetch['user_pic'];
}


?>
                        <div class="col-sm-12 col-md-12 col-lg-3">
 
    <div class="form-group">
    
    <img src="<?php echo $img_url; ?>" class="img-thumbnail" id="item-img-output" width="150"/>
    
    </div>
 
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">
                                <label class="mylabel"><i class="fa fa-user"></i> Name</label>
                            <div class="hint"><?php echo $myact_fetch['user_username']; ?></div>
                            </div>
                            
                            <div class="form-group">
                            <label class="mylabel"><i class="fa fa-birthday-cake"></i> Date of Birth</label>
                            <div class="hint">
                                <?php
                            $dob = $myact_fetch['user_dob'];
                            if($dob!='0000-00-00'){ 

                            $dob = str_replace('-', '/', $dob);
                            echo $dob = date('d-m-Y', strtotime($dob));
                            }
                            else
                            {
                            echo $dob = "Not Available!";
                            }
                            ?></div>
                            
                            
                            </div>
                            
                            <div class="form-group">
                            <label class="mylabel" for="exampleRadios1"><i class="fa fa-group"></i> Sex</label>
                            <div class="hint">
                            <?php echo $myact_fetch['user_sex']; ?>
                            </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">
                            <label class="mylabel" for="name1"><i class="fas fa-id-card"></i> Introducer ID</label>
                            <div class="hint"><?php echo $myact_fetch['user_refer']; ?>
                            </div>
                            </div>

                            <div class="form-group">
                            <label class="mylabel" for="name2"><i class="fas fa-id-card"></i> Customer ID</label>
                            <div class="hint">
                                PA00<?php echo $myact_fetch['user_id']; ?>
                            </div>
                            </div>

                            <div class="form-group">
                            <label class="mylabel" for="name3"><i class="fas fa-user-secret"></i> User Type</label>
                            <div class="hint">
                                <?php echo $myact_fetch['user_type']; ?>
                            </div>
                            </div>
                            </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">
                            <label class="mylabel" for="email"><i class="fa fa-send"></i> Username / Email</label>
                            <div class="hint">
                            <?php echo $myact_fetch['user_email']; ?>
                            </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="mylabel" for="email"><i class="fa fa-phone"></i> Mobile</label>
                            <div class="hint">
                            <?php echo $myact_fetch['user_mobile']; ?>
                            </div>
                            </div>
                            
                            <div class="form-group">
                            <label class="mylabel" for="email"><i class="fa fa-location-arrow"></i> Location</label>
                            <div class="hint">
                            <?php echo $myact_fetch['user_town'].", ".$myact_fetch['user_taluk'].", ".$myact_fetch['user_city']; ?>
                            </div>
                            </div>

                            
                            
                            
                        </div>

                        <?php

                        if($myact_fetch['user_document']!=''){
                       
                          $file_name = 'media/uploadfiles/'.$myact_fetch['user_document'];
                       
                        ?>

                        <input type="hidden" name="hdnUserDocument" id="hdnUserDocument" value="<?php echo ($myact_fetch['user_document']) ? $myact_fetch['user_document'] : ""; ?>">

                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">
                            <label class="mylabel" for="file download"><i class="fas fa-camera fa-xs"></i> File Download</label>
                            <div class="hint">
                            <a target="_blank" href="<?php echo BASE_URL . 'media/uploadfiles/'. $myact_fetch['user_document']; ?>">
                                Download
                            </a>
                            </div>
                            </div>
                            
                            
                            
                        </div>
                        <?php } ?>
                        
                    </div>
                        
                    
				
			
		</div>
                           

	</div>
        </div>
       
	
<?php
}

}
?>