<?php
!defined('BASE_URL') && define('BASE_URL', 'https://jobbvin.com/');
class config{
	
	public function mysqlConfig(){
		
       
		$servername = "localhost";
		$username = "devavv";
		$password = "vvinWIN@2019";
		$dbname = "abocarz";
		
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        return $conn;

		
	}

		
}

?>