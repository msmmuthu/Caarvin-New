<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
session_start(); 

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Welcome to Jobbvin</title>
	
 <!-- add icon link -->
        <link rel = "icon" href = 
"logo.jpg" 
        type = "image/x-icon">
    
</head>

<body>
    
<div id="loading_filter" style="display:none;">
            <h4>loading..</h4>
            <img src="css/images/circel.gif" /></div>


<?php
include "config/config.php";
include "helper/misc2/misc2.php";



		
		
		require("controller/index.php");
		$indexcontroller = new indexcontroller();
		$indexcontroller->index();
		
	

		


//$indexcontroller = new index();
?>




</body>
</html>