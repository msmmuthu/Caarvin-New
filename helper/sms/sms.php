<?php

class sms{

	public function sms_send($to,$info){
	
		
		

		//Your authentication key
		$authKey = "129433AQbfoIKj5901b6e1";
		
		//Multiple mobiles numbers separated by comma
		$mobileNumber = $to;
		
		//Sender ID,While using route4 sender id should be 6 characters long.
		$senderId = "Picads";
		
		//Your message to send, Add URL encoding here.
		$message = urlencode($info);
		
		//Define route 
		$route = "4";
		//Prepare you post parameters
		$postData = array(
		    'authkey' => $authKey,
		    'mobiles' => $mobileNumber,
		    'message' => $message,
		    'sender' => $senderId,
		    'route' => $route
		);
		
		//API URL
		$url="https://control.msg91.com/api/sendhttp.php";
		
		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
		    CURLOPT_URL => $url,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $postData
		    //,CURLOPT_FOLLOWLOCATION => true
		));
		
		
		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		
		//get response
		$output = curl_exec($ch);
		
		//Print error if any
		if(curl_errno($ch))
		{
		    echo 'error:' . curl_error($ch);
		}
		
		curl_close($ch);
		
		echo $output;
		
		
		
	}
	
}
?>