<div id="period_select">
<?php
	//echo $_POST['first_name'];
	$query_plan_list = mysqli_query("select plan_serial_id,plan_name,plan_term from plan GROUP BY plan_serial_id");
	
?>

<form name="plan_selection" method="post" action="<?php echo $_SERVER["PHP_SELF"];  ?>" >
<select name="select_plan" id="select_plan" onchange="planSelection();">
  <option>Select Plan</option>
  <?php
   while($row = mysqli_fetch_object($query_plan_list)){
  ?>
  <option value="<?php echo $row->plan_serial_id;?>"><?php echo $row->plan_name;?></option>
  <?php
  }
  ?>
</select>
<select name="select_term" id="select_term" onchange="termSelection();">
  <option>Select Plot Size</option>
 <?php
	$planSelected = $_POST['planSelected'];
	$query_sqft__list = mysqli_query("select  *  from plan WHERE plan_serial_id=$planSelected");
	while($row = mysqli_fetch_object($query_sqft__list)){
  ?>
  <option value="<?php echo $row->plan_land_sqft;?>"><?php echo $row->plan_land_sqft;?> Land Sq. - <?php echo $row->plan_paid_amt;?> INR</option>
  <?php
  }
  ?>
</select>
<input type="text" name="reg_no" id="reg_no" />
<input type="text" name="date_of_join" id="date_of_join" />
<input type="text" name="benefit_sqft" id="benefit_sqft" />
<input type="text" name="mode_of_payment" id="mode_of_payment" />
<input type="text" name="tot_period" id="tot_period" />
<input type="text" name="exp_date_agree" id="exp_date_agree" />
<input type="submit" name="register" id="register" value="Save" />
</form>
</div>


<?php
if(isset($_POST['register'])){

//$controller = new indexcontroller();
//$controller->registrationSaveAction();
}
?>