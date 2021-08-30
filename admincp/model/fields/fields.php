<?php
class fields extends config{


	
	
	public function dropdownvalueupdate(){
	
		$id = $_POST['id'];
		$name = $_POST['name'];
		$valu = $_POST['valu'];
		//mysqli_query($this->mysqlConfig(),"UPDATE `pic_addpost` SET `pic_price` = $valu WHERE `pic_id` = $id");
		mysqli_query($this->mysqlConfig(),"UPDATE `pic_categories_fields` SET $name = '$valu' WHERE `pic_categories_fields`.`fields_id` = $id;");
		
	
	}
	
	public function general(){
	?>
	<div class="content">
		
		<div class="nav">
		Edit Category
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:95%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px; height:100px;">

   
	<?php
	$cat_name = $_POST['cat_name'];
	$cat_desc = $_POST['cat_desc'];
	$order_category = $_POST['order_category'];
	$cat_price = $_POST['price_label'];
	$desc_label = $_POST['desc_label'];
	$categories_id = $_POST['id'];
	$homepage = $_POST['homepage'];
	$cat_search_title = $_POST['search_title'];
	$cat_search_limit = $_POST['search_limit'];
	$search_tag= $_POST['search_tag'];
	$cat_fa = $_POST['threads-icon'];
	$maps = $_POST['maps'];
	
	
	//Image
	$max_size = 300*300; // 200kb
	$extensions = array('jpeg', 'jpg', 'png');
	$dir = 'media/';
	$name = $_FILES['photo']['name'];
	

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_FILES['photo'])){
		if (!is_uploaded_file($_FILES['photo']['tmp_name']) or $_FILES['photo']['size'] >= $max_size or !in_array(pathinfo($name, PATHINFO_EXTENSION), $extensions) ){
		$str = "";
		?>
        <div style="border-bottom:1px dotted #666;" align="center"><h2>Updated Successfully!</h2></div>
        <div align="center"><a class="btn_sub_active" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=edit">Back</a></div>
        <?php
		}
		else{
		//move_uploaded_file($tmp_name, "$uploads_dir/$name");
		move_uploaded_file($_FILES["photo"]["tmp_name"], "$dir"."$name");
		$str = " , categories_image='$name'";
		
		?>
        <div style="border-bottom:1px dotted #666;" align="center"><h2>Updated Successfully!</h2></div>
        <div align="center"><a class="btn_sub_active" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=edit">Back</a></div>
        <?php
			
		}
		$cat_query = mysqli_query($this->mysqlConfig(),"UPDATE `pic_categories` SET `category_order` = '".$order_category."',`cat_search` = '".$search_tag."',`cat_search_title` = '".$cat_search_title ."',`cat_search_limit` = '".$cat_search_limit."',`categories_name` = '".$cat_name."',`cat_fa` = '".$cat_fa."',`categories_desc` = '".$cat_desc."',`categories_price_label` = '".$cat_price."',`categories_desc_label` = '".$desc_label."',`categories_maps` = '".$maps."',`categories_homepage` = ".$homepage."".$str." WHERE `pic_categories`.`categories_id` = $categories_id;");
	
}
	
	?>
    


   
     

   </div>
</div>
</div>
<?php
	}
	
	public function delete(){
	?>
    
	
	<div class="content">
		
		<div class="nav">
		Edit Category
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:95%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px; height:100px;">
   
	<?php
	$fieldid = $_REQUEST['fieldid'];
	$categories_id = $_REQUEST['id'];
		$cat_query = mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_categories_fields` WHERE `pic_categories_fields`.`fields_id` = $fieldid");
		mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_categories_fields` WHERE `pic_categories_fields`.`field_DV_id` = $fieldid");
		?>
		
		
        <div style="border-bottom:1px dotted #666;" align="center"><h2>Updated Successfully!</h2></div>
		
        <div align="center"><a class="btn_sub_active" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=managefield">Back</a></div>
  
  
   </div>
</div>
</div>
<?php
	
  
	}
	
	public function update(){
	?>
    
	
	<div class="content">
		
		<div class="nav">
		Edit Category
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:95%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px; height:100px;">
   
	<?php
	$fields_type = $_REQUEST['fields_type'];
	$fieldid = $_REQUEST['id'];
	$categories_id = $_REQUEST['catid'];
	$field_pri = $_REQUEST['field_pri'];
	$field_name = $_REQUEST['field_name'];
	$fields_old_title = $_REQUEST['fields_old_title'];
	$field_sample = $_REQUEST['field_sample'];
	
	//echo $multi= $_REQUEST['"multi".$fieldid'];
	//print_r($multi);
	
	$i=0;
	foreach ($fieldid as $fieldid1){
	
	if($fields_type[$i]=="DropDown"){
	$str = "`fields_categories_id` = $categories_id and `fields_title`='$fields_old_title[$i]'";
	}
	else{
	$str = "`pic_categories_fields`.`fields_id` = $fieldid1";
	}
		$multis= "multi".$fieldid[$i];
		$multi = $_REQUEST[$multis];
		
		$cat_query = mysqli_query($this->mysqlConfig(),"UPDATE `pic_categories_fields` SET `field_priority` = '$field_pri[$i]',`fields_title` = '$field_name[$i]',`field_sample` = '$field_sample[$i]',`multi` = '$multi' WHERE ".$str."");
	
	$i++;
	}
		?>
		
		
        <div style="border-bottom:1px dotted #666;" align="center"><h2>Updated Successfully!</h2></div>
		
        <div align="center"><a class="btn_sub_active" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=managefield">Back</a></div>
  
  
   </div>
</div>
</div>
<?php
	
  
	}
	
	public function add(){
	?>
    
	
	<div class="content">
		
		<div class="nav">
		Edit Category
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:95%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px; height:100px;">
   
	<?php
	
	$categories_id = $_REQUEST['catid'];
	$type = $_REQUEST['type'];
	
	if(isset($_REQUEST['id'])){
	$id = $_REQUEST['id'];
	$query = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_categories_fields` WHERE fields_id = $id");
	$row = mysqli_fetch_object($query);
	$title = $row->fields_title;
	}
	else{
	$title = "Sample-".time();
	}
	
mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_categories_fields` (`fields_categories_id`, `fields_title`, `fields_type`, `field_value`, `field_priority`,`field_DV_id`) VALUES ('$categories_id', '$title', '$type','','','$id')");

		?>
		
		
        <div style="border-bottom:1px dotted #666;" align="center"><h2>New <?php echo $type; ?> Added Successfully!</h2></div>
		
        <div align="center"><a class="btn_sub_active" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=managefield">Back</a></div>
  
  
   </div>
</div>
</div>
<?php
	
  
	}
	
	public function dropdownvalue(){
	?>
    
	
	<div class="content">
		
		<div class="nav">
		Edit Category
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:95%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px; height:100px;">
   
	<?php
	echo "dsds";
	$categories_id = $_REQUEST['catid'];
	$type = $_REQUEST['type'];
	$val = "Sample-".time();
	$field_id = $_REQUEST['id'];
	
mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_categories_fields` (`fields_categories_id`, `fields_title`, `fields_type`, `field_value`, `field_priority`,`field_DV_id`) VALUES ('$categories_id', '$field_title', '$type', '$val', '',$field_id)");

		?>
		
		
        <div style="border-bottom:1px dotted #666;" align="center"><h2>New <?php echo $type; ?> Added Successfully!</h2></div>
		
        <div align="center"><a class="btn_sub_active" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=managefield">Back</a></div>
  
  
   </div>
</div>
</div>
<?php
	
  
	}
	
	public function dropdownvaluedelete(){
	?>
    
	
	<div class="content">
		
		<div class="nav">
		Edit Category
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:95%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px; height:100px;">
   
	<?php
	$fieldid = $_REQUEST['fieldid'];
	$categories_id = $_REQUEST['id'];
		$cat_query = mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_categories_fields` WHERE `pic_categories_fields`.`fields_id` = $fieldid");
		?>
		
		
        <div style="border-bottom:1px dotted #666;" align="center"><h2>Updated Successfully!</h2></div>
		
        <div align="center"><a class="btn_sub_active" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=managefield">Back</a></div>
  
  
   </div>
</div>
</div>
<?php
	
  
	}
	
	
	
	public function chainfieldupdate(){
	?>
    
	
	<div class="content">
		
		<div class="nav">
		Edit Category
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:95%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px; height:100px;">
   
	<?php
	
	$fieldid = $_REQUEST['id'];
	$categories_id = $_REQUEST['catid'];
	$field_pri = $_REQUEST['field_pri'];
	$field_value = $_REQUEST['assignvalue'];
	$field_name = $_REQUEST['field_name'];
	
	$field_value_form="";
	$i=0;
	foreach ($field_value as $field_value1){
	if($i==0){ $str="from:";} else { $str="to:"; }
	$field_value_form.= $str.$field_value1.",";
	$i++;
	}
	$field_value_form = substr($field_value_form, 0, -1);
	
	mysqli_query($this->mysqlConfig(),"UPDATE `pic_categories_fields` SET `fields_title` = '$field_name',`field_value` = '$field_value_form' WHERE `pic_categories_fields`.`fields_id` = $fieldid;");
	
		?>
		
		
        <div style="border-bottom:1px dotted #666;" align="center"><h2>Updated Successfully!</h2></div>
		
        <div align="center"><a class="btn_sub_active" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=chainfield">Back</a></div>
  
  
   </div>
</div>
</div>
<?php
	
  
	}
	
	public function chainvalueupdate(){
	?>
    
	
	<div class="content">
		
		<div class="nav">
		Edit Category
		</div>
		
		<div class="main" style="padding:25px;" >
       	<div  style="background-color:#CCCCCC; padding:10px; width:95%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px; height:100px;">
   
		<?php
        $categories_id = $_REQUEST['catid'];
        $field_sub = $_REQUEST['field_sub'];
        
       
		foreach ($field_sub as $field_subs){
		$query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where `fields_id` = $field_subs");
		$row = mysqli_fetch_object($query);
		if(!empty($row->field_chain_value)){
		$field_parent=",".$_REQUEST['field_parent'].",".$row->field_chain_value;
		}
		else{
		$field_parent=",".$_REQUEST['field_parent'];
		}
        mysqli_query($this->mysqlConfig(),"UPDATE `pic_categories_fields` SET  field_chain_value='$field_parent' WHERE `fields_id` = $field_subs");
        }
        ?>
        
        <div style="border-bottom:1px dotted #666;" align="center"><h2>Updated Successfully!</h2></div>
        <div align="center"><a class="btn_sub_active" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=chainfield">Back</a></div>
  
  
   </div>
</div>
</div>
<?php
	
  
	}
	
	public function chainvaluereset(){
	?>
	<div class="content">
		
		<div class="nav">
		Edit Category
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:95%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px; height:100px;">
   
	<?php
	$fieldid = $_REQUEST['fieldid'];
	mysqli_query($this->mysqlConfig(),"UPDATE `pic_categories_fields` SET `field_chain_value` = '' WHERE `pic_categories_fields`.`fields_id` = $fieldid");
	?>
		
		
        <div style="border-bottom:1px dotted #666;" align="center"><h2>Reset Successfully!</h2></div>
		
        <div align="center"><a class="btn_sub_active" href="index.php?action=view&module=fields&catid=<?php echo $_REQUEST['id']; ?>&post=chainfield">Back</a></div>
  
  
   </div>
</div>
</div>
<?php
	
  
	}

}
?>



