<?php

class like_history {

    public function index() {
        ?>
        <style type="text/css">
            .account-left{
                width:54%;
                height:200px;
                float:left;
                /*background:#f4f4f4;*/
                padding:3%;
            }

            .account-right{
                width:33%;
                float:left;
                padding:3%;

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

        <style type="text/css">
            #rows_table tr>th{
                padding:5px;
                border-style:solid;
                border-width:thin;
                border-color:#999999;
            }
            #rows_table tr>td{
                padding:5px;
                border-style:solid;
                border-width:thin;
                border-color:#999999;
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
                                <table id="rows_table" width="920px">
                                        <tr >
                                            <th align="center" width="10%" height="25px">Product Title</th>
                                            <th align="center" width="10%">Total Likes</th>
                                            <th align="center" width="10%">Customer Details</th>
                                        </tr>
                                <?php
                                $sel = mysqli_query($this->mysqlConfig(),"select * from pic_likes");
                                while ($sel_pro = mysqli_fetch_array($sel)) {
                                    ?>
                                    
                                        <tr>
                                            <td align="left"  width="10%"><?php echo $sel_pro['like_product']; ?></td>
                                            <td align="left"  width="10%"><?php echo "10"; ?></td>
                                            <td align="left"  width="10%"><a href="">View Details</a></td>
                                        </tr>
                                    
                                    <?php
                                }
                                ?>
                                        </table>
                            </div>
                        </form>
                    </div>
                    <div class="account-right">
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

                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
?>