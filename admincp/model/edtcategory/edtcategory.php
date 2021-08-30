<?php
class edtcategory extends config{ 

public function update(){
$id=$_POST['id'];
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
mysqli_query($this->mysqlConfig(),"update `pic_categories` set `categories_name`='$cat_name', `categories_desc`='$cat_desc', `categories_image`='$cat_pic',`categories_status`='1', `categories_parent`='$cat_root',`categories_sub`='$sub_category',`categories_contact_type`='$cat_contact_type',`cat_search_title`='$cat_search_title',`cat_search_limit`='$cat_search_limit',`user_type`='$user_type' where categories_id='$id' ");



// Textbox 
$textbox_count = substr_count($_POST['text_title'], ",")+1;

for($i=0;$i<$textbox_count;$i++){

$textbox_title = $_POST['text_title'];
$textbox_prior = $_POST['text_prior'];

$textbox_title = explode(",", $textbox_title);

$textbox_title = $textbox_title[$i];

if(!empty($textbox_title)){
$customer_quersy2 = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where `fields_categories_id`='$id'");
  
 $rowss2 = mysqli_num_rows($customer_quersy2);
if($rowss2 > 0)
{
mysqli_query($this->mysqlConfig(),"update `pic_categories_fields` set  `fields_title`='$textbox_title', `fields_type`='Textbox', `field_priority`='$textbox_prior' where `fields_categories_id`='$id' ");
}else{

mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_categories_fields` (`fields_categories_id`, `fields_title`, `fields_type`, `field_priority`) VALUES ($id,'$textbox_title','Textbox','$textbox_prior');");
}
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
$customer_quersy1 = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where `fields_categories_id`='$id'");
  
 $rowss1 = mysqli_num_rows($customer_quersy1);
if($rowss1 > 0)
{
mysqli_query($this->mysqlConfig(),"update `pic_categories_fields` set  `fields_title`='$textbox_title', `fields_type`='Numeric', `field_priority`='$num_prior' where `fields_categories_id`='$id' ");
}else
{
mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_categories_fields` (`fields_categories_id`, `fields_title`, `fields_type`, `field_priority`) VALUES ($id,'$textbox_title','Numeric','$num_prior');");
}
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
			$customer_quersy = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where `fields_categories_id`='$id'");
  
 $rowss = mysqli_num_rows($customer_quersy);
if($rowss > 0)
{
			mysqli_query($this->mysqlConfig(),"update `pic_categories_fields` set  `fields_title`='$dropdown_title ', `fields_type`='DropDown', `field_value`='$dropdown_value', `field_priority`='$prior' where `fields_categories_id`='$id' ");
}else
{

			mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_categories_fields` (`fields_categories_id`, `fields_title`, `fields_type`, `field_value`, `field_priority`) VALUES ($id,'$dropdown_title ','DropDown','$dropdown_value','$prior');");
}	
		echo mysqli_error();
		}
	}

}

}
?>