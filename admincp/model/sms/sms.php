<?php
class sms extends config{

	public function save(){ ?>
	
    <div class="content">
    <div class="nav" style="width: 100%; height:auto;">
    SMS Settings
    </div>
    <div class="main" style="padding:25px;" >
        <div  style="background-color:#CCCCCC; padding:10px; width:100%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px;">
		<style type="text/css">
        #rows tr>th{
        padding:5px;
        border-style:solid;
        border-width:thin;
        border-color:#999999;
        }
        #rows tr>td{
        padding:5px;
        border-style:solid;
        border-width:thin;
        border-color:#999999;
        }
        a{
        text-decoration:none;
        }
        </style>
        <?php
        
        $perday= $_POST['perday'];
        $total= $_POST['total'];
        $id = $_POST['id'];
        mysqli_query($this->mysqlConfig(),"UPDATE  `pic_user` SET  `user_sms_day` =  '$perday', `user_sms_total` =  '$total' WHERE  `user_id` =".$id."");
        ?>
        SMS Settings Saved!
    </div>
    </div>
    </div>
	
    <?php
    }
	
}
?>
