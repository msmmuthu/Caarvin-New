<?php
class settings extends config{

	
	
	public function change_password(){
	
		$password = $_POST['confirm_pass'];
		
		
		mysqli_query($this->mysqlConfig(),"UPDATE  `pic_admin` SET  `admin_password` =  '".$password."' WHERE  `pic_admin`.`admin_id` =".$_SESSION['userid']."");

	}
}