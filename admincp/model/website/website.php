<?php
class website extends config{

public function hide(){

	$val 	= $_REQUEST['id'];
	$catid 	= $_REQUEST['catid'];

	mysqli_query($this->mysqlConfig(),"UPDATE `pic_website` SET `status` = '$val' WHERE `pic_website`.`id` = $catid;");

	echo "<script>alert('Done!');
	window.location.href='index.php';
	</script>";

}

public function delete(){

	$val 	= $_REQUEST['id'];
	$catid 	= $_REQUEST['catid'];

	mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_website` WHERE `pic_website`.`id` = $catid");

	echo "<script>alert('Deleted Successfully');
	window.location.href='index.php?action=view&module=website&post=list';
	</script>";

}

public function insert(){

	$cat_name = $_POST['website_name'];
	$cat_desc = $_POST['website_url'];

	//Image
	$max_size = 300*300; // 200kb
	$extensions = array('jpeg', 'jpg', 'png');
	$dir = 'media/weblogo/';
	$name = $_FILES['photo']['name'];	
	


		if (!is_uploaded_file($_FILES['photo']['tmp_name']) or $_FILES['photo']['size'] >= $max_size or !in_array(pathinfo($name, PATHINFO_EXTENSION), $extensions) ){
		$str = "";
		?>

        <?php
		}
		else{
		//move_uploaded_file($tmp_name, "$uploads_dir/$name");
		move_uploaded_file($_FILES["photo"]["tmp_name"], "$dir"."$name");		
		?>

        <?php
			
		}


mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_website` (`website_name`, `website_url`, `logo`, `status`) VALUES ('$cat_name', '$cat_desc','$name',  1);");

$query = mysqli_query($this->mysqlConfig(),"Select * from pic_website order by id desc limit 1");
$row 	= mysqli_fetch_object($query);
$id 	= $row->categories_id;

echo "<script>alert('Added Successfully');
window.location.href='index.php?action=view&module=website&post=list';
</script>";


}



// drop down box
public function dropdown($title,$value,$id,$prior){
	
	echo $dropdown_count = substr_count($value, ",")+1;
	
	for($i=0;$i<$dropdown_count;$i++){
	
		$dropdown_title = $title;
		
		$dropdown_value = $value;
		
		$dropdown_value = explode(",", $dropdown_value);
		
		echo $dropdown_value = $dropdown_value[$i];
		
		if(!empty($dropdown_title) and !empty($dropdown_value)){
		
		$dropdown_value;
			
			mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_categories_fields` (`fields_categories_id`, `fields_title`, `fields_type`, `field_value`, `field_priority`) VALUES ($id,'$dropdown_title ','DropDown','$dropdown_value','$prior');");
			echo mysqli_error();
		}
	}

}

}
?>