<?php

class mailing{

	public function mail_send($to,$sub,$info){
	
		if (!empty($to))  {
		
		$admin_email = $to;
		$email = "salahudeen.ls@gmail.com";
		$subject = $sub;
		$comment = $info;
		
		mail($admin_email, "$subject", $comment, "From:" . $email);
		//echo "Thank you for contacting us!";
		}
		
		
		/*$ch = curl_init();
		$user="salahudeen@astonishinfotech.com:musa2012";
		$receipientno="8508720424"; 
		$senderID="TEST SMS"; 
		$msgtxt="this is test message , test"; 
		curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
		$buffer = curl_exec($ch);
		if(empty ($buffer))
		{ echo " buffer is empty "; }
		else
		{ echo $buffer; } 
		curl_close($ch);
		*/

		
	}
	
	public function mail_to($to,$sub,$info){
	
		if (!empty($to))  {
		
		$admin_email = "salahudeen.ls@gmail.com";
		$email = $to;
		$subject = $sub;
		$comment = $info;
		
		mail($admin_email, "$subject", $comment, "From:" . $email);
		//echo "Thank you for contacting us!";
		}
		
		
		/*$ch = curl_init();
		$user="salahudeen@astonishinfotech.com:musa2012";
		$receipientno="8508720424"; 
		$senderID="TEST SMS"; 
		$msgtxt="this is test message , test"; 
		curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
		$buffer = curl_exec($ch);
		if(empty ($buffer))
		{ echo " buffer is empty "; }
		else
		{ echo $buffer; } 
		curl_close($ch);
		*/

		
	}
	
}
?>