<?php

class user_list extends config{

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
  function initializeAutocompleteReg(){
    var input = document.getElementById('city_header_profile');
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
	  $("#city_header_profile").val(city + ", " + state);
      $("#latreg").val(latreg);
      $("#lonreg").val(lngreg);
      //document.getElementById("location_id").value = placeId;
    });
  }
</script>


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
    public function index() {
        ?>
        
        	<script>
$(document).ready(function() {
$('#example_add_history').DataTable({
"order": [[ 0, "asc" ]]
});
} );
</script>


	
        	<div class="container-fluid">
		<div class="row">
			
            <div class="col-sm-12 col-md-12 col-lg-3">
				
				<?php $this->leftMenu(); ?>
  
				   
				</div>
                    
				<div class="col-sm-12 col-md-12 col-lg-9">

                        <form  id="registerform" name="registerform" method="post" action="" onSubmit="return register_validate();" >
                            <input type="hidden" name="action" value="model" />
                            <input type="hidden" name="module" value="add_history" />
                            <input type="hidden" name="post" value="addhistory details" />
                            <div>
                           
                                <table id="example_add_history" class="table table-striped table-bordered">
                                <thead>
                                        <tr >
                                            <th align="left" width="10%" height="25px">No</th>
                                            <th align="left" width="10%" height="25px">Name</th>
                                            <th align="left" width="10%" height="25px">User Type</th>
                                            <th align="left" width="10%" height="25px">Unique ID</th>
                                            <th align="left" width="10%"><div align="center">Email</div></th>
                                            <th align="left" width="10%"><div align="center">Mobile</div></th>
                                            <th  align="center" width="10%"><div align="center">Location</div></th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php
								$usr="Pa00".$_SESSION['pic']['biscuit']['userid'];
								$sel = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_user` where user_refer='$usr'");
				 $i=1;
                                while ($sel_pro = mysqli_fetch_array($sel)) {
                                   
                                    ?>
                                   
                                        <tr>
                                        <td align="left"  width="15%"><?php echo $i; ?></td>
                                        <td align="left"  width="15%"><?php echo $sel_pro['user_username']; ?></td>
                                        <td align="left"  width="15%"><?php echo $sel_pro['user_type']; ?></td>
                                         <td align="left"  width="15%"><?php echo $sel_pro['user_id_unique']; ?></td>
                                         <td align="left"  width="15%"><?php echo $sel_pro['user_email']; ?></td>
                                          <td align="left"  width="15%"><?php echo $sel_pro['user_mobile']; ?></td>
                                             <td align="left"  width="15%"><?php echo $sel_pro['user_taluk']." , ".$sel_pro['user_city']; ?></td>
                                            
                                        </tr>
                                    
                                    <?php
									$i++;
                                }
                                ?>
                                </tbody>
                                        </table>
                            </div>
                        </form>
                    </div>
                    
                
            </div>
        </div>
        <?php
    }
	
	public function register(){
	$usr="PA00".$_SESSION['pic']['biscuit']['userid'];
	?>
    
        	<div class="container-fluid">
		<div class="row">
			
            <div class="col-sm-12 col-md-12 col-lg-3">
				
				<?php $this->leftMenu(); ?>
  
				   
				</div>
                    
				<div class="col-sm-12 col-md-12 col-lg-9">
<?php
$myact_query = mysqli_query($this->mysqlConfig(),"select * from pic_user where user_status=1 and user_id=".$_SESSION['pic']['biscuit']['userid']."");
$myact_fetch = mysqli_fetch_array($myact_query);
?>
 <?php
	if($myact_fetch['privacy_register']==1){
	?>
    
                        <form  id="registerform" name="registerform" method="post" action="" onSubmit="return register_validate();" >
                            <div class="row pt-4">
                    <div class="col-sm-10 col-md-10 col-lg-10 pb-0">
                    <h4>Register Now!</h4>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2 pb-0">
                        
                    </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 bg_form p-4">
                            <input type="hidden" name="action" value="model" />
                            <input type="hidden" name="module" value="account" />
                            <input type="hidden" name="post" value="account insert" />
                            <input type="hidden" name="usr" value="<?php echo $usr; ?>" />
                            
                            <label class="mylabel">You are an * &nbsp;&nbsp;</label>
                            <div class="form-inline">
                                    
                                   
    <?php
      $usertype_query = mysqli_query($this->mysqlConfig(),"select * from pic_user_type where status=1");
      $g = 1;
     while($row = mysqli_fetch_array($usertype_query)){
      ?>
        <div class="form-check pr-2">
        <input class="form-check-input" id="<?php echo $row['user_type']; ?>" type="radio" name="areYou[]" id="<?php echo $row['user_type']; ?>" value="<?php echo $row['user_type']; ?>" <?php if($g=='2'){?> checked="checked" <?php } ?>>
        <label class="form-check-label" for="<?php echo $row['user_type']; ?>">
        <?php echo $row['user_type']; ?>
        </label>
        </div>
	<?php
    $g=$g+1;			
     }
 ?>				
                            </div>
                            
                        
                                        
                        <div class="form-group pt-2">
                        <div class="form-check">
                        
                        <input type="checkbox" class="form-check-input"  name="yes_refer" id="yes_refer" value="<?php echo $usr; ?>" onchange="CheckCheckboxes1(this)" />
                        <label class="form-check-label mylabel" for="yes_refer">Reference *</label>
                        </div>
                            
                            <input type="text"  class="form-control" id="refer" name="refer" readonly="readonly" value="<?php echo $usr; ?>">
                        
                        </div>
                                
                        <div class="form-group">
                        <label class="mylabel" for="name">Name *</label>
                        <input type="text" required=""  class="form-control" id="name" name="name">
                        </div>
                        
                        <label class="mylabel" for="userid">User ID *</label>
                                <div class="form-group form-inline">
                        
                        <input type="text"  class="form-control mr-3" id="userid" name="userid" required value="<?php
                                        if (isset($_POST['register'])) {
                                            echo $_POST['email'];
                                        }
                                        ?>">
                        <input type="button" class="btn btn-primary" name="checkid" value="Check" onclick="javascript:checkUserId();" />
                            <?php
                        if (isset($_REQUEST['error_username'])) {
                            ?><div class="rows" style="color:#FF0000; font-weight:bold;">
                                EMAIL ALREADY EXIST!
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                        <div id="id_div">
                        </div>     

                        
                        <div class="form-group">
                        <label class="mylabel" for="email">Email *</label>
                        <input type="text" required=""  class="form-control" id="email" name="email" value="<?php
                                        if (isset($_POST['register'])) {
                                            echo $_POST['email'];
                                        }
                                        ?>">
                        <?php
                                    if (isset($_REQUEST['error_username'])) {
                                        ?><div class="rows" style="color:#FF0000; font-weight:bold;">
                                            EMAIL ALREADY EXIST!
                                        </div>
                                        <?php
                                    }
                                    ?>
                        </div>
                        
                        <div class="form-group">
                        <label class="mylabel" for="pass">Password *</label>
                        <input type="password"  class="form-control" id="pass" name="pass" required="">
                        </div>
                        
                        <label class="mylabel" for="phone">Mobile *</label>
                        <div class="form-group form-inline">
                        
                        <input type="text" disabled="disabled" value="+91" class="form-control mr-2" id="phone_prefix" name="mobile_prefix" maxlength="10" size="2"> 
                        <input type="text" value="<?php
                                    if (isset($_POST['register'])) {
                                        echo $_POST['mobile'];
                                    }
                                    ?>"  id="phone" name="mobile" type="text" maxlength="10"  pattern="[789][0-9]{9}" placeholder="Mobile (Eg:9842212345)" class="form-control" size="20">
                        <div>(We will verify this number for privacy protection)</div>
                        <?php if (isset($_REQUEST['error_mobile'])) { ?>
                        <div class="rows" style="color:#FF0000;font-weight:bold;">
                        MOBILE ALREADY EXIST!
                        </div>
                        <?php } ?>
           
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

                <label class="mylabel" for="city_header_profile">City *</label>

                <input value='<?php if(!empty($myact_fetch['user_city'])) {echo $myact_fetch['user_city'];}  ?>' id="city_header_profile" class="form-control" style="margin-top: 6px;width:100%;" type="text" name="city_header_profile" onFocus="initializeAutocompleteReg()" autocomplete="off" required placeholder="Enter your town and district...." />
                
              <input style="display:none;margin-top: 6px;width:100%;" class="form-control" style="margin-top: 6px;width:100%;" type="text" placeholder="Town here..." name="townreg" id="townreg"  required />
        
              <input type="hidden" name="latreg" id="latreg" value="" >
                <input type="hidden" name="lonreg" id="lonreg"  value="" >
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


                        <div class="form-check">

                        <input type="checkbox" class="form-check-input" required name="yes_refer" id="yes_refer" value="<?php echo $usr; ?>" onchange="CheckCheckboxes1(this)" />
                        <label class="form-check-label text-danger" for="yes_refer">I confirm that I am 18 years or older</label>
                        </div>
                 
                        <div class="form-group">
                        <input style="width:25%;" type="submit" name="register" class="btn btn-lg btn-primary btn-block text-uppercase" value="Register">
                        </div>
                        
                           
                            <div class="space_10"></div>
                            <div class="space_10"></div>
                            <div  id="error_register" class="rows" style="color:#FF0000; display:none;">
                                ! Please Fill Required Information
                            </div>
                            <div  id="error_register_email" class="rows" style="color:#FF0000; display:none;">
                                ! Email Address Invalid
                            </div>
                        </form>
                        
                        <?php
						}
						else
						{
						?>
                        <h3>Sorry! you are not allowed to add customer</h3>
                        
                        <?php
						}
						?>

                    </div>
                    </div>
                    
                </div>
            </div>
       
    <?php
	}
	
	

}
?>