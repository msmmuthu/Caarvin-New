<?php
class reference extends config{

	public function save(){ ?>
	
    <div class="content">
    <div class="nav" style="width: 100%; height:auto;">
    Set Reference
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
        
        $referid = $_POST['referid'];
        $id = $_POST['id'];
        mysqli_query($this->mysqlConfig(),"UPDATE  `pic_user` SET  `user_refer` =  '$referid' WHERE  `pic_user`.`user_id` =".$id."");
        ?>
        Reference Set Successfully!
    </div>
    </div>
    </div>
	
    <?php
    }
	
}
?>
