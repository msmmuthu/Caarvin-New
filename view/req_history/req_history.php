<?php

class req_history {

    public function index() {
        ?>
        <style type="text/css">
           

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
                    <div class="account-left">

                        <form  id="registerform" name="registerform" method="post" action="" onSubmit="return register_validate();" >
                            <input type="hidden" name="action" value="model" />
                            <input type="hidden" name="module" value="add_history" />
                            <input type="hidden" name="post" value="addhistory details" />
                            <div>
                                <table id="example" class="table table-striped table-bordered">
                                <thead>
                                        <tr >
                                             <th align="left" width="10%" height="25px">Ads Details</th>
                                            <th align="left" width="10%"><div align="center">Category</div></th>
                                            <th align="left" width="10%"><div align="center">Price</div></th>
                                            <th  align="center" width="10%"><div align="center">Action</div></th>
                                            <th  align="center" width="10%"><div align="center">Status</div></th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php
				$usr=$_SESSION['pic']['biscuit']['userid'];
                                $sel = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where  pic_user_id='$usr' and pic_request=1");
                                while ($sel_pro = mysqli_fetch_array($sel)) {
                                     $title = $sel_pro['pic_title'];
                                    ?>
                                    
                                        <tr>
                                            <td align="left"  width="20%">
                                            <strong>Ads ID:</strong> <a href="index.php?action=view&module=product_detail&ads_id=<?php echo $sel_pro['pic_ads_id']; ?>"><?php echo $sel_pro['pic_ads_id']; ?></a><br>
                                            <strong>Name :</strong> <?php echo $sel_pro['pic_title']; ?><br>
                                              <strong>Description :</strong> <?php echo $sel_pro['pic_discription']; ?><br>
                                              </td>
                                            <td align="left"  width="15%"><div align="center"><?php echo $sel_pro['pic_category']; ?></div></td>
                                            <td align="left"  width="15%"><div align="center"><?php echo $sel_pro['pic_price']; ?></div></td>
                                            <td align="center"  width="15%"><a href="index.php?action=view&module=requestad&sub=<?php echo $sel_pro['pic_category']; ?>&id=<?php echo $sel_pro['pic_ads_id']; ?>">Edit</a></td>
                                             <td align="center"  width="15%"><?php if($sel_pro['addpost_status']=='0') { ?>Pending<?php } else { echo "Active"; } ?></td> 
                                        </tr>
                                    
                                    <?php
                                }
                                ?>
                                </tbody>
                                        </table>
                            </div>
                        </form>
                    </div>
                    <div class="account-right">
                       <?php 
					require("view/myaccount/myaccount.php");
					$leftmenu = new myaccount();
                    $leftmenu->leftMenu(); 
					?>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
?>