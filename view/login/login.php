<?php
class login{

	public function form(){
	
		?>
        <table width="300" cellspacing="0" cellpadding="0" border="0"><form method="post" action="/SignIn" name="frmSignIn"></form><tbody><tr>
					<td width="125" height="32"><label><b><span style="color:#000;font-size:13px;">Email ID/ User ID:</span></b></label></td>
					<td>
						<input type="text" style="padding:6px 0 6px 5px;width:150px;border:1px solid #E1E1E1;" value="" id="loginemail" name="GreetingName">						<script>if(jQuery('loginemail'))document.getElementById('loginemail').focus();</script>
						</td>
				</tr>
				<tr>
				<td>
				<div class="blank10"></div>
				</td>
				</tr>
				<tr>
					<td width="125" height="32"><label><b><span style="color:#000;font-size:13px;">Password:</span></b></label></td>
					<td>
						<input type="password" style="padding:6px 0 6px 5px;width:150px;border:1px solid #E1E1E1;" id="Password" name="Password"></td>
				</tr>					
			<tr>
					<td height="36"><input type="hidden" value="'.$bye.'" name="bye">&nbsp;</td>
					<td>
					<div prog="http://teja1.kuikr.com/images/ajax_loader_1.gif" style="display:inline" id="createAlertLoader">						
						<input type="submit" style="background:#FEE804;border:1px solid #DEB501;
                        padding:3px 7px 3px 7px;font-size:15px;font-weight:bold;margin:-10px 0 0 -125px;position:absolute;cursor:pointer;" value="Submit" id="SubmitBtn">	</div>					
					</td>
				</tr>
				
			</tbody></table>
        <?php
	
	}
	
	public function logincheck(){
	
	
	}
	

}

?>