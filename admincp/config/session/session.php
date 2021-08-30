<?php
class session{


public function create($userid,$username,$email){

	$_SESSION['fm']['portal']['userid'] = $userid;
	$_SESSION['fm']['portal']['username'] = $username;
	$_SESSION['fm']['portal']['email'] = $email;
	
	

}


public function clear(){

	$_SESSION['fm']['portal']['userid'] = "";
	$_SESSION['fm']['portal']['username'] = "";
	$_SESSION['fm']['portal']['email'] = "";
	$_SESSION['fm']['portal']['designation'] = "";
	print "<script>";
	print "window.location.href = 'index.php'; ";
	print "</script>";

}


}
?>