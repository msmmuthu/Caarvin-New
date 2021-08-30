<?php

class contact {

    public function form() {
        ?>
        <style type="text/css">
            .account-left{
                width:54%;
                float:left;
                background:#f4f4f4;
                padding:3%;
            }

            .account-right{
                width:33%;
                float:left;
                padding:3%;

            }

           

            .form_txt {
                border: 1px solid #e2e2e2;
                border-radius: 2px;
                padding: 1%;
                width:75%

            }
        </style>
        <div class="rows">
            <div class="container">
                <div class="bor">
                    <div class="account-left">

                       

                            <div class="title">Contact Us!</div>
                            <div class="space_10"></div>



                            <div>
                                
                                <div class="space_10"></div>
                                
                                <div class="col-2">
                                    <div class="search-title"> Name *</div>
                                    <div class="space_10"></div>
                                    <div class="rows">
                                        <input type="text"  class="form_txt" id="name" name="name" required>
                                    </div>
                                </div>
                               <div class="space_10"></div>
                                
                                
                                <div class="col-2">
                                    <div class="search-title">Email *</div>
                                    <div class="space_10"></div>
                                    <div class="rows">
                                        <input type="text"  class="form_txt" id="email" name="email" value="" required>
                                    </div>
                                </div>
                                <div class="space_10"></div>
                                

                                
                                

                                <div class="col-2">
                                    <div class="search-title"> Mobile *</div>
                                    <div class="space_10"></div>
                                    <div class="rows">

                                        <input type="text" disabled="disabled" value="+91" class="form_txt" id="phone_prefix" name="mobile_prefix" maxlength="10" size="2" style="width:5%;"> 
                                        <input type="text"  id="mobile" name="mobile" maxlength="10"  pattern="[789][0-9]{9}" placeholder="Mobile (Eg:9842212345)" class="form_txt" size="20" style="width:67%;" required>
                                       
                                        <div class="space_10"></div>
                                    </div>
                                </div>
                                <div class="space_10"></div>
                                <div class="col-2">
                                    <div class="search-title">Comments *</div>
                                    <div class="space_10"></div>
                                    <div class="rows">
                                    <textarea name="comments" id="comments" class="form_txt" required></textarea>
                                       
                                    </div>
                                </div>

                              
                                    
                                   
                                   
<div class="space_10"></div>
                                        
                                <div class="space_10"></div>
                               
                            </div>
                            <div>
                                <input type="button" value="Submit" name="submit" class="form_btn" onClick="sendmsg();" >
                            </div>
                            <div class="space_10"></div>
                            
                            
                       
                    </div>
                    <div class="account-right">
                        <div class="title">Picads</div>
                        <div class="space_10"></div>
                        <div class="space_10"></div>
                        <div class="search-title">Sivagangai Branch</div>
                         <div class="space_10"></div>
                        <div class="search-title">P.O:#123, East Street, Sivaganga District</div>
                         <div class="space_10"></div>
                        <div class="search-title">Tamil Nadu</div>
                        <div class="space_10"></div>
                        <div class="space_10"></div>
                        <div class="space_10"></div>
                        
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
	
	public function sends() {
       
		$name = $_POST['name'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$comments = $_POST['comments'];
		
		require("helper/mailing/mailing.php");
		$mailing= new mailing();
		
		$sub = "Mr.".$name."";
		
		$info = "Name :  ".$name."

Email : ".$email."

Contact No : ".$mobile."

Comments : ".$comments."";
		
		$mailing->mail_to($email,$sub,$info);
			
	   
    }
	
	

}
?>

