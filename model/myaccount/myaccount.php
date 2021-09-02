<?php

class myaccount extends config{
    
public function leftMenu(){
$myact_query = mysqli_query($this->mysqlConfig(),"select * from pic_user where user_status=1 and user_id=".$_SESSION['pic']['biscuit']['userid']."");
$myact_fetch = mysqli_fetch_array($myact_query);

?>
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Profile
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
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
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Manage Ads Scheme
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
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
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Ads History
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       <ul>
	<li>
	<a href="index.php?action=view&module=add_history">View All</a>
	</li>
	
	</ul>
      </div>
    </div>
	</div>


<div class="card">
	
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         Like History
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
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
	
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         Specials Location & Category
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
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


public function schemeSave(){


$scheme_query = mysqli_query($this->mysqlConfig(),"select * from pic_scheme where scheme_id=".$_POST['plan']."");
$scheme_row = mysqli_fetch_object($scheme_query);

$scheme_photo = $scheme_row->scheme_photo;
$scheme_valid = $scheme_row->scheme_valid;

$dop = date('Y-m-d');
$purpose = $_POST['purpose'];
$payment_details = $_POST['payment_details'];


$query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_scheme_user` ORDER BY `pic_scheme_user`.`pic_scheme_user_id` DESC limit 1");
$row = mysqli_fetch_object($query);
$cashid = "PACASH00".$row->pic_scheme_user_id;

mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_scheme_user` (`pic_scheme_id`, `pic_scheme_name`, `pic_scheme_desc`, `pic_scheme_balance_qty`,`total_ads`,`cost_scheme`,`payment_status`,`payment_method`, `pic_user_id`,`scheme_purchased_date`,`scheme_purpose`,`scheme_cash_id`,payment_details,photo_limit,ads_valid) VALUES ($scheme_row->scheme_id, '$scheme_row->scheme_name', '$scheme_row->scheme_desc', $scheme_row->scheme_ads_qty,$scheme_row->scheme_ads_qty,$scheme_row->scheme_price,'Pending','Net Banking',".$_SESSION['pic']['biscuit']['userid'].",'$dop','$purpose','$cashid','$payment_details',$scheme_photo,$scheme_valid)");

?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-lg-3">
                    <?php $this->leftMenu(); ?>
                </div>
                <div class="col-sm-7 col-md-7 col-lg-9 pt-4">
                    <div class="alert alert-success" role="alert">
                        Scheme Purchased. Go Back <a href="index.php?action=view&module=myaccount&task=myscheme" class="alert-link">My Scheme</a>.
                    </div>
                </div>
            </div>
        </div>

<?php

}

public function updatePass(){



if(isset($_POST['pass_new']) && $_POST['pass_new']==""){
$pass = $_POST['pass'];
}
else{
$pass = $_POST['pass_new'];
}

//Image with crop
if (isset($_POST['crop_final_data']) and $_POST['crop_final_data']!=""){
$croped_image = $_POST['crop_final_data'];
//list($type, $croped_image) = explode(';', $croped_image);
list(, $croped_image)      = explode(',', $croped_image);
$croped_image = base64_decode($croped_image);
//$image_name = time().'.jpg';
$name = microtime().'.jpg';
$name = str_replace(' ', '_', $name);
// upload cropped image to server 
file_put_contents('media/profile/'.$name, $croped_image);
}
else{
$name = "";
}
        

$dob = $_POST['dob'];
$dob = str_replace('/', '-', $dob);
$dob = date('Y-m-d', strtotime($dob));

// $location_query = mysqli_query($this->mysqlConfig(),"select * from pic_geometric where city1='".$_REQUEST['city']."' and city2='".$_REQUEST['taluk_select']."' limit 1");
// $location_fetch = mysqli_fetch_object($location_query);

$lan = $_POST['latregman'] == "" ? $location_fetch->lan: $_POST['latregman'];;
$lon = $_POST['lonregman'] == "" ? $location_fetch->lon : $_POST['lonregman'];;
			

if (isset($_POST['crop_final_data']) and $_POST['crop_final_data']!=""){

mysqli_query($this->mysqlConfig(),"UPDATE  `pic_user` SET  `user_password`='$pass',`user_lon`='".$lon."',`user_lan`='".$lan."',`user_city`='".$_POST['city_header_profile_man']."',`user_town`='".$_POST['townregman']."',`user_pic`='".$name."',`user_sex`='".$_POST['Sex']."',`user_username`='".$_POST['name']."',`user_dob`='".$dob."' WHERE  `pic_user`.`user_id`=".$_SESSION['pic']['biscuit']['userid']." and `pic_user`.`user_password` ='".$_POST['pass']."'");



}
else{
  

// File Upload start
$fileName = (isset($_POST['hdnUserDocument']) ? $_POST['hdnUserDocument'] : '');
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

  if (isset($_POST['hdnUserDocument']) && $_POST['hdnUserDocument'] != '') {
    unlink($fileDirPath.'/'.$_POST['hdnUserDocument']);
  }

}
// File upload End

mysqli_query($this->mysqlConfig(),"UPDATE  `pic_user` SET  `user_password`='$pass',`user_lon`='".$lon."',`user_lan`='".$lan."',`user_city`='".$_POST['city_header_profile_man']."',`user_taluk`='".$_POST['taluk_select']."',`user_town`='".$_POST['townregman']."',`user_sex`='".$_POST['Sex']."',`user_username`='".$_POST['name']."',`user_dob`='".$dob."', `user_document`='".$fileName."' WHERE  `pic_user`.`user_id`=".$_SESSION['pic']['biscuit']['userid']." and `pic_user`.`user_password` ='".$_POST['pass']."'");


}
?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-lg-3">
                    <?php $this->leftMenu(); ?>
                </div>
                <div class="col-sm-7 col-md-7 col-lg-9 pt-4">
                   
                    <div class="alert alert-success" role="alert">
                        Profile Updated. Go Back <a href="index.php?action=view&module=myaccount&post=profile" class="alert-link">My Profile</a>.
                    </div>
                </div>
            </div>
        </div>
			
		
<?php

}


}

?>