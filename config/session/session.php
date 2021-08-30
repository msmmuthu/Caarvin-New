<?php
class session{


public function create($userid,$username,$email,$city,$taluk,$town,$lan,$lon){

	$_SESSION['pic']['biscuit']['userid'] = $userid;
	$_SESSION['pic']['biscuit']['username'] = $username;
	$_SESSION['pic']['biscuit']['email'] = $email;
	$_SESSION['pic']['biscuit']['city'] = $city;
	$_SESSION['pic']['biscuit']['taluk'] = $taluk;
	$_SESSION['pic']['biscuit']['town'] = $town;
	$_SESSION['pic']['biscuit']['lan'] = $lan;
	$_SESSION['pic']['biscuit']['lon'] = $lon;

}


public function clear(){

	$_SESSION['pic']['biscuit']['userid'] = "";
	$_SESSION['pic']['biscuit']['username'] = "";
	$_SESSION['pic']['biscuit']['email'] = "";

}


}
?>