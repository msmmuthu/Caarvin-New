<?php
    $username = "picads_root";
			$password = "piCAds_16";
			$hostname = "localhost"; 
			$db_name  = "picads";
			$dbhandle = mysqli_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
			
			$selected = mysqli_select_db($db_name,$dbhandle) or die("Could not select the database(sgil)");
			

    $q=$_REQUEST["term"];
    $taluk=$_REQUEST["ts"]; 
    $city=$_REQUEST["ct"];
    $sql="SELECT `pic_add_town` FROM `pic_addpost` WHERE pic_add_town LIKE '%$q%' and pic_add_taluk='$taluk' and pic_post_city='$city' group by pic_add_town ";
    $result = mysqli_query($this->mysqlConfig(),$sql);
    
    

    $json=array();

    while($row = mysqli_fetch_array($result)) {
      array_push($json, $row['pic_add_town']);
    }

    echo json_encode($json);
?>