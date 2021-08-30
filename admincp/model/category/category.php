<?php
class category extends config{

public function hide(){

$val = $_REQUEST['id'];
$catid = $_REQUEST['catid'];

mysqli_query($this->mysqlConfig(),"UPDATE `pic_categories` SET `categories_hidden` = '$val' WHERE `pic_categories`.`categories_id` = $catid;");

echo "<script>alert('Done!');
window.location.href='index.php';
</script>";

}

public function delete(){

$val = $_REQUEST['id'];
$catid = $_REQUEST['catid'];

mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_categories` WHERE `pic_categories`.`categories_id` = $catid");
mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_categories` WHERE `pic_categories`.`categories_sub` = $catid");
mysqli_query($this->mysqlConfig(),"DELETE FROM `pic_categories_fields` WHERE `pic_categories_fields`.`fields_categories_id` = $catid");

echo "<script>alert('Deleted Successfully');
window.location.href='index.php';
</script>";

}

public function insert(){

$cat_name = $_POST['cat_name'];
$cat_desc = $_POST['cat_desc'];
$cat_pic = $_POST['cat_pic'];
$cat_root = $_POST['cat_root'];
$cat_layout = $_POST['cat_layout'];
$cat_contact_type = $_POST['contact_type'];
$cat_search_title = $_POST['search_title'];
$cat_search_limit = $_POST['search_limit'];
if(!empty($_POST['user_type']) and is_array($_POST['user_type'])) {
            $user_type.=implode(' | ',$_POST['user_type']);
          }
 
if($cat_root==0){
$sub_category = $_POST['sub_category'];
}
else{
$sub_category = 0;
}
mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_categories` (`categories_name`, `categories_desc`, `categories_image`,`categories_status`, `categories_parent`,`categories_sub`,`categories_contact_type`,`cat_search_title`,`cat_search_limit`,`user_type`) VALUES ('$cat_name', '$cat_desc', '$cat_pic', 1,$cat_root,$sub_category,'$cat_contact_type','$cat_search_title','$cat_search_limit','$user_type');");

$query = mysqli_query($this->mysqlConfig(),"Select * from pic_categories order by categories_id desc limit 1");
$row = mysqli_fetch_object($query);
$id = $row->categories_id;


// Textbox 
$textbox_count = substr_count($_POST['text_title'], ",")+1;

for($i=0;$i<$textbox_count;$i++){

$textbox_title = $_POST['text_title'];
$textbox_prior = $_POST['text_prior'];

$textbox_title = explode(",", $textbox_title);

$textbox_title = $textbox_title[$i];

if(!empty($textbox_title)){

mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_categories_fields` (`fields_categories_id`, `fields_title`, `fields_type`, `field_priority`) VALUES ($id,'$textbox_title','Textbox','$textbox_prior');");
echo mysqli_error();
}
}

// Numeric 
$textbox_count = substr_count($_POST['num_title'], ",")+1;

for($i=0;$i<$textbox_count;$i++){

$textbox_title = $_POST['num_title'];
$num_prior= $_POST['num_prior'];

$textbox_title = explode(",", $textbox_title);

$textbox_title = $textbox_title[$i];

if(!empty($textbox_title)){

mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_categories_fields` (`fields_categories_id`, `fields_title`, `fields_type`, `field_priority`) VALUES ($id,'$textbox_title','Numeric','$num_prior');");
echo mysqli_error();
}
}

// call function drop down box 
$this->dropdown($_POST['drop_title1'],$_POST['drop_value1'],$id,$_POST['drop_title1_prior']);
$this->dropdown($_POST['drop_title2'],$_POST['drop_value2'],$id,$_POST['drop_title2_prior']);
$this->dropdown($_POST['drop_title3'],$_POST['drop_value3'],$id,$_POST['drop_title3_prior']);
$this->dropdown($_POST['drop_title4'],$_POST['drop_value4'],$id,$_POST['drop_title4_prior']);
$this->dropdown($_POST['drop_title5'],$_POST['drop_value5'],$id,$_POST['drop_title5_prior']);
$this->dropdown($_POST['drop_title6'],$_POST['drop_value6'],$id,$_POST['drop_title6_prior']);
$this->dropdown($_POST['drop_title7'],$_POST['drop_value7'],$id,$_POST['drop_title7_prior']);
$this->dropdown($_POST['drop_title8'],$_POST['drop_value8'],$id,$_POST['drop_title8_prior']);
$this->dropdown($_POST['drop_title9'],$_POST['drop_value9'],$id,$_POST['drop_title9_prior']);
$this->dropdown($_POST['drop_title10'],$_POST['drop_value10'],$id,$_POST['drop_title10_prior']);

echo "<script>alert('Added Successfully');
window.location.href='index.php';
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