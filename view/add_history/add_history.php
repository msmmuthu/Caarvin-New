<?php

class add_history extends config{

    public function select($fields_title,$field_DV_id,$adsid){?>
		
         <p><strong style="text-transform:uppercase;"><?php echo $fields_title; ?></strong></p>
        
        <select name="select" onchange="update_value_dropdown(this);">
        	<?php 
			
				$qry = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields` WHERE `field_DV_id`=$field_DV_id");
				while($rw = mysqli_fetch_object($qry)){
			?>
            
            <option mytag="<?php echo $this->selectedvalueall($adsid,$field_DV_id); ?>" <?php if(!empty($this->selectedvalue($rw->fields_id,$adsid,$field_DV_id))){ ?> selected="selected" <?php } ?> value="<?php echo $rw->fields_id; ?>"><?php echo $rw->field_value; ?></option>
            <?php
			}
			?>
        </select>
        
		
	<?php
	}
	public function selectedvalue($fields_value_id,$adsid,$field_DV_id){
	//echo "SELECT * FROM `pic_addpost_field` WHERE `addpost_uni_id`=$adsid and `addpost_fields_value`='$fields_value_id' limit 1";
		$qry = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_addpost_field` WHERE `addpost_uni_id`=$adsid and `addpost_fields_value`=$fields_value_id and field_id=$field_DV_id limit 1");
		$rw = mysqli_fetch_object($qry);
		return $rw->addpost_field_id;
				
	}
	public function selectedvalueall($adsid,$field_DV_id){
	//echo "SELECT * FROM `pic_addpost_field` WHERE `addpost_uni_id`=$adsid and `addpost_fields_value`='$fields_value_id' limit 1";
		$qry = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_addpost_field` WHERE `addpost_uni_id`=$adsid and field_id=$field_DV_id limit 1");
		$rw = mysqli_fetch_object($qry);
		return $rw->addpost_field_id;
				
	}
	
	public function numericfield($fields_title,$fields_id,$adsid){?>
		
          <p><strong style="text-transform:uppercase;"><?php echo $fields_title; ?></strong></p>
		<?php 
            $qry = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_addpost_field` WHERE `field_id`=$fields_id and addpost_uni_id=$adsid limit 1");
            $rw = mysqli_fetch_object($qry);
        ?>
            
        <input type="number" name="number" id="<?php echo $rw->addpost_field_id; ?>" value="<?php echo $rw->addpost_fields_value; ?>"  onchange="update_value_text(this);" />
        
		
	<?php
	}
	
	public function textfield($fields_title,$fields_id,$adsid){?>
		
         <p><strong style="text-transform:uppercase;"><?php echo $fields_title; ?></strong></p>
		<?php 
            $qry = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_addpost_field` WHERE `field_id`=$fields_id and addpost_uni_id=$adsid limit 1");
            $rw = mysqli_fetch_object($qry);
        ?>
            
        <input type="text" name="textfield" id="<?php echo $rw->addpost_field_id; ?>" value="<?php echo $rw->addpost_fields_value; ?>"  onchange="update_value_text(this);" />
        
		
	<?php
	}
	
	public function field_quick_edit($catid,$adsid){
		$qry = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields` WHERE `field_quickedit`=1 and fields_categories_id=$catid limit 1");
		$rw = mysqli_fetch_object($qry);
		
			if(!empty($rw->fields_type) and $rw->fields_type=="DropDown"){
				$this->select($rw->fields_title,$rw->fields_id,$adsid);
			}
			elseif(!empty($rw->fields_type) and $rw->fields_type=="Numeric"){
				$this->numericfield($rw->fields_title,$rw->fields_id,$adsid);
			}
			elseif(!empty($rw->fields_type) and ($rw->fields_type=="Textbox" or $rw->fields_type=="Text")){
				$this->textfield($rw->fields_title,$rw->fields_id,$adsid);
			
			}
			
			
	
	}
	public function updateValue(){
	
		$id = $_POST['id'];
		$name = $_POST['name'];
		$valu = $_POST['valu'];
		mysqli_query($this->mysqlConfig(),"UPDATE `pic_addpost_field` SET `addpost_fields_value` = '$valu' WHERE `addpost_field_id` = $id");
		
	
	}
	public function updatePrice(){
	
		$id = $_POST['id'];
		$name = $_POST['name'];
		$valu = $_POST['valu'];
		mysqli_query($this->mysqlConfig(),"UPDATE `pic_addpost` SET `pic_price` = $valu WHERE `pic_id` = $id");
		
	
	}
	
	public function index() {
        ?>
        
        	


        

	
<div class="container-fluid">
            <div class="row">
                
                    
                  <div class="col-sm-12 col-md-12 col-lg-3">
					<?php 
					require("view/myaccount/myaccount.php");
					$leftmenu = new myaccount();
                    $leftmenu->leftMenu(); 
					?>

                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9">

                        
<form  id="registerform" name="registerform" method="post" action="" onSubmit="return register_validate();" >
                            <input type="hidden" name="action" value="model" />
                            <input type="hidden" name="module" value="add_history" />
                            <input type="hidden" name="post" value="addhistory details" />
                            
                            <?php
                            $usr=$_SESSION['pic']['biscuit']['userid'];
                            $qry = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_user` WHERE `user_id`='$usr'");
                            $rw = mysqli_fetch_object($qry);
                            if($rw->user_type!="Customer"){
                            $str = "pic_refer_id";
                            $str1 = "pic_user_id";
                            $customer = "no";
                            }
                            else{
                            $str = "pic_user_id";
                            $str1 = "pic_user_id";
                            $customer = "yes";
                            }
                             
                                $sel = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where ".$str."='$usr' or ".$str1."='$usr'");
                            ?>
                                <table id="example_add_history" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                        <tr >
                                            <th>No</th>
                                            <th>Ads Type</th>
                                            <th>Ads Details</th>
                                            <th>Category</div></th>
                                            <th>Quick Edit</div></th>
                                            <th>Price</div></th>
                                            <?php
                                            if($customer=="no"){ ?>
                                            <th>Posted by</th>
                                            <?php
                                            }
                                            ?>
                                            <th>Action</th>
                                            <th>Status</th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php
								$i=1;
                                while ($sel_pro = mysqli_fetch_array($sel)) {
                                     $title = $sel_pro['pic_title'];
                                    ?>
                                   
                                        <tr>
                                        <td align="left"  width="15%"><?php echo $i; ?></td>
                                            <td align="left"  width="15%"><div align="center"><?php if($sel_pro['pic_request']==1) { echo "Request"; } else { echo "Post"; }; ?></div></td>
                                            <td align="left"  width="20%">
											<strong>Ads ID :</strong><a href="index.php?action=view&module=product_detail&ads_id=<?php echo $sel_pro['pic_ads_id']; ?>"><?php echo $sel_pro['pic_ads_id']; ?></a><br>
											<strong>Name :</strong> <?php echo $sel_pro['pic_title']; ?><br>
                                              <strong>Description :</strong> <?php echo $sel_pro['pic_discription']; ?><br>                                             </td>
                                            <td align="left"  width="15%"><div align="center">
                                            <?php 
                                            $qcer = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_categories` where categories_id=".$sel_pro['pic_category']." limit 1"); 
                                            $rw = mysqli_fetch_object($qcer);
                                            echo $rw->categories_name;
                                            ?></div></td>
                                           
                                            <td align="left"  width="15%"><div align="center">
                                            
                                            <?php $this->field_quick_edit($sel_pro['pic_category'],$sel_pro['pic_ads_id']); ?>
                                          </div></td>
										  <td align="left"  width="15%"><div align="center"><input type="number" name="pic_price" value="<?php echo $sel_pro['pic_price']; ?>" id="<?php echo $sel_pro['pic_id']; ?>" onchange="update_value(this);" /></div></td>
					  <?php
                                            if($customer=="no"){ ?>
                                          <td align="left"  width="15%"><div align="center"><?php echo $sel_pro['pic_user_fullname']; ?></div></td>
                                            <?php
                                            }
                                            ?>
                                            <td align="left"  width="15%"><div align="center">
                                              <a href="index.php?action=view&module=postad&sub=<?php echo $sel_pro['pic_category']; ?>&id=<?php echo $sel_pro['pic_ads_id']; ?><?php if($sel_pro['pic_request']==1) { ?>&req=1 <?php } ?>">Edit</a> 
                                            </div></td> 
                                            <td align="left"  width="15%"><div align="center">
                                              <?php if($sel_pro['addpost_status']=='0') { ?>
                                              Pending 
                                              <?php } else { echo "Active"; } ?>
                                            </div></td> 
                                        </tr>
                                    
                                    <?php
									$i++;
                                }
                                ?>
                                </tbody>
                                        </table>
                          
                        </form>
                    </div>
                
            </div>
        </div>
        
        <script>
		function update_value_dropdown(e){
			var valueField= e.value;
			var idField= e.id; 
			var nameField= e.name; 
			var idField = $('option:selected', e).attr('mytag');
			
			postdata = {
			'action' : "view",
			'module' : "add_history",
			'post' : "update field",
			'id' : idField,
			'name' : nameField,
			'valu' : valueField,
			
			}
			
			
			$.post("index.php",postdata,function(data){
			//$("#ajax_contact_div").html(data);														  
			});
		
		}
		
		function update_value(e){
			var valueField= e.value;
			var idField= e.id; 
			var nameField= e.name; 
			
			postdata = {
			'action' : "view",
			'module' : "add_history",
			'post' : "update price",
			'id' : idField,
			'name' : nameField,
			'valu' : valueField,
			
			}
			
			
			$.post("index.php",postdata,function(data){
			//$("#id").html(data);														  
			});
		
		}
		
		function update_value_text(e){
			var valueField= e.value;
			var idField= e.id; 
			var nameField= e.name; 
			
			postdata = {
			'action' : "view",
			'module' : "add_history",
			'post' : "update field",
			'id' : idField,
			'name' : nameField,
			'valu' : valueField,
			
			}
			
			
			$.post("index.php",postdata,function(data){
			//$("#id").html(data);														  
			});
		
		}
		
		
		</script>
        <?php
		
    }
	
	
	
	
	

}
?>