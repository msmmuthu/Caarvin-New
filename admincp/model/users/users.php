<?php
class users extends config{

public function insert(){

$usr_name = $_POST['usr_name'];
$usr_pass=$_POST['usr_pass'];
$usr_email = $_POST['usr_email'];
$user_type1 = $_POST['user_type'];
			foreach ($user_type1 as $user_type){

$user_type=$user_type;

}

$usr_mob = $_POST['usr_mob'];
$city = $_POST['city'];

 
mysqli_query($this->mysqlConfig(),"INSERT INTO `pic_user` (`user_username`, `user_password`, `user_email`,`user_mobile`, `user_city`,`user_type`,`user_status`) VALUES ('$usr_name', '$usr_pass', '$usr_email','$usr_mob','$city','$user_type','1');");

echo mysqli_error();
}}
?>
