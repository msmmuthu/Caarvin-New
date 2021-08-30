<?php

class account {

    public function form() {
        ?>
        
        <div class="container">
            <div class="row">
                <div class="col-sm-0 col-md-0 col-lg-3 pb-0">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 p-4 bg-secondary rounded-lg">
                    
                    
                        <h4 class="default text-center">Sign In</h4>
                        <footer class="default-footer pb-4 text-center">I have account already</footer>
                        <form id="loginform" action="index.php" method="post">
                            <input type="hidden" name="action" value="model" />
                            <input type="hidden" name="module" value="account" />
                            <input type="hidden" name="post" value="login_submit" />

                          <div class="form-label-group">
                                    <input autofocus required class="form-control" type="text"  name="username" id="username">
                                    <label for="username">Enter email address *</label>
                                </div>
                           <div class="form-label-group">
                                    <input autofocus required class="form-control" type="password"  name="pass" id="pass">
                                    <label for="pass">Enter password *</label>
                           </div>
                            <div class="form-label-group">
                            		<button class="btn btn-lg btn-primary btn-block text-uppercase" name="login_submit" type="submit">Login</button>
                                    
                                
                            </div>
                            <div class="form-label-group">
							<?php
                            if (isset($_REQUEST['error'])) {
                            ?>
                            <div style="border: 1px dashed #721d24;" class="alert alert-danger" role="alert"><i class="fa fa-exclamation-circle"></i> Invalid Login Details!</div>
                           
                            <?php
                            }
                            ?>	                              
                            </div>
                           
                            <div  id="error_login" class="rows" style="color:#FF0000; display:none;">
                                ! Please Fill Required Information
                            </div>
        
                        </form>
                    
                    
                </div>
                <div class="col-sm-0 col-md-0 col-lg-3 pb-0">
                </div>
            </div>
        </div>
        <?php
    }
	
	public function smsForm() {
        ?>
        <style type="text/css">
            .account-center{
		width: 50%;
		background: #ffffff;
		padding: 5% 25%;
            }


            .form_btn {
                background: none repeat scroll 0 0 #fb2106;
                border: 0 none;
                color: #fff;
                cursor: pointer;
                float: left;
                height: 34px;
                width:30%;

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
                    
                    <div class="account-center">
                        <div class="title">Mobile Validation</div>
                        <div class="space_10"></div>
                        <div class="search-title">To Validate your Mobile Number Here..</div>
                        <div class="space_10"></div>
                        <div class="space_10"></div>
                        <div class="space_10"></div>
                        <form id="smsvalidateform" name="smsvalidateform" action="" method="post">
                            <input type="hidden" name="action" value="model" />
                            <input type="hidden" name="module" value="account" />
                            <input type="hidden" name="post" value="smsvalidated" />

                            <div class="col-2">
                                <div class="search-title">Verification Code *</div>
                                
                                <div class="space_10"></div>
                                <div class="rows">
                                    <input required type="text"  class="form_txt" name="smscode" placeholder="Verification Code sent your Registered Mobile">
                                </div>
                            </div>
                            
                            <div class="col-2">

                                <div class="space_10"></div>
                                <div class="rows">
                                    <input type="submit" value="Validate" class="form_btn" name="sms_submit">
                                </div>
                            </div>
                            <div class="space_10"></div>
                            <div class="space_10"></div>
                            <div  id="error_login" class="rows" style="color:#FF0000; display:none;">
                                ! Please Fill Required Information
                            </div>
        <?php
        if (isset($_REQUEST['error'])) {
            ?>
                                <div class="col-2">

                                    <div class="space_10"></div>
                                    <div class="rows" style="color:#FF0000;">
                                        Invalid Login Details!
                                    </div>
                                </div>
            <?php
        }
        ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
?>
