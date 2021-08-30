<?php

class categories extends config{

    public function select() {
        ?>
        <style type="text/css">
            .categories-button{
				    background: none repeat scroll 0 0 #f4f4f4;
    border: 1px solid #e2e2e2;
    margin: 0 15%;
    padding: 2% 8%;
    text-align: center;
				
            }
			.categories-button:hover{
				background: none repeat scroll 0 0 #f8ba14;
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
        <div class="container">
            <div class="row">

            
             <?php
					$post = $_REQUEST['post'];
					if(isset($_SESSION['pic']['biscuit']['userid']) and $_SESSION['pic']['biscuit']['userid']!=""){
					
					//$cat_ids= $_REQUEST['cat_id'];
					$usr=$_SESSION['pic']['biscuit']['userid'];
					$user_types=mysqli_query($this->mysqlConfig(),"select * from pic_user where user_id='$usr' ");
					$row = mysqli_fetch_object($user_types);
                    $utype = $row->user_type;
					
					$user_types_query=mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_user_type` where user_type='$utype'"); 
					$row_user_types = mysqli_fetch_object($user_types_query);
					$uType = $row_user_types->setoption;
					$category_privacy = "(".$row_user_types->setcategory.")";
					}
					
					//$formed_array = explode(',',$row_user_types->setcategory);
					?>
                    
				<?php if(isset($uType) and strpos($uType, $post) !== false){ ?> 	
                
               <div class="col-sm-12 col-md-12 col-lg-5">
                
                
                <div class="list-group ">
                <h4 class="default">Default Categories</h4>
                <footer class="default-footer pb-4">select the category</footer>
               
                
               <?php
				
				if(isset($_REQUEST['sub']) and !isset($_REQUEST['special'])){
				
				$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where `categories_id` in ".$category_privacy." and categories_sub = ".$_REQUEST['sub']."");
				
				}
				else{
				
				//$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where `categories_id` in ".$category_privacy." and `categories_parent`=1 and user_type LIKE '%{$uType}%'");
				$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where `categories_id` in ".$category_privacy." and `categories_parent`=1");
				}
				
				while($row=mysqli_fetch_object($categories_query)){
				$categories_query_count = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_sub=$row->categories_id");
				$count_row = mysqli_num_rows($categories_query_count);
				?>
                <a href="index.php?action=view&module=<?php if($count_row==0){ echo $_GET['post'];?>ad<?php } else{ ?>categories<?php } ?>&sub=<?php echo $row->categories_id;?>&post=<?php echo $_GET['post']; ?>&req=0" class="list-group-item list-group-item-action">
                <img width="20" class="rounded mr-2" src="admincp/media/<?php echo $row->categories_image;?>" /><?php echo $row->categories_name;?>
                </a>
				
                  
				<?php
              
                }
				?>
                 
                
                    
                    
                </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-2 pt-4">
                
                </div>
                <div class="col-sm-12 col-md-12 col-lg-5">
                <div class="list-group">
                <h4 class="default">Special Categories</h4>
                <footer class="default-footer pb-4">select the category</footer>
                <?php
					require'view/misc/misc.php';
					$subcat_array = new misc();
					
					$usr=$_SESSION['pic']['biscuit']['userid'];
					$user_types=mysqli_query($this->mysqlConfig(),"select * from pic_user where user_id='$usr' ");
					$row = mysqli_fetch_object($user_types);
                    $utype = $row->user_type;
                    $allowedCat = $row->privacy_category;
					$allowedCat = substr($allowedCat, 1, -1);
					
                    //$allowedCatNo  = substr_count($allowedCat , '|');
					//$allowedCatSub = $subcat_array->subcatid($allowedCat);
                    //$allowedCatNo = $allowedCatNo;
					
                    //for($i=1;$i<$allowedCatNo;$i++){
                   
                    //$allowedCat1 = explode("|", $allowedCat);
                   
                    
				if(isset($_REQUEST['sub']) and isset($_REQUEST['special'])){
				
				$allowedCatSub = $subcat_array->subcatid($_REQUEST['sub']);
				$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id in ".$allowedCatSub."");
				
				
				}
				else{
				
				$allowedCatMain = str_replace("|","','",$allowedCat);
				$allowedCatMain = "('".$allowedCatMain."')";
				$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id in ".$allowedCatMain." and categories_parent=0");
				$count_row1 = mysqli_num_rows($categories_query );
				}
				?>
               
                <?php
				while($row=mysqli_fetch_object($categories_query)){
				$categories_query_count = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_sub=$row->categories_id ");
				$count_row = mysqli_num_rows($categories_query_count);
				
				?>
               <a href="index.php?action=view&module=<?php if($count_row==0){ echo $_GET['post']; ?>ad<?php } else{ ?>categories<?php } ?>&sub=<?php echo $row->categories_id;?>&post=<?php echo $_GET['post']; ?>&req=0&special=yes" class="list-group-item list-group-item-action">
                <img width="20" class="rounded mr-2" src="admincp/media/<?php echo $row->categories_image;?>" /><?php echo $row->categories_name;?>
                </a>
				
                  
				<?php
				
                }
				
				if($count_row1==0)
				{
				?>
                
                <div class="list-group-item list-group-item-danger">
                <i class="fa fa-exclamation"></i> No Special Category Available!
                </div>
               
                <?php
				
				}
             //echo $i;
               // }
				?>
                
                </div>
                <?php } else {?>
                <div class="container">
	<div class="row">
        
        <div class="col-sm-12 col-md-12 col-lg-4 pb-0"></div>
        <div class="col-sm-12 col-md-12 col-lg-4 alert alert-light p-2 text-center" role="alert"style="border: 1px dashed #ccc;">
        
        <i class="fa fa-exclamation-triangle fa-2x"></i>
        <br />
        <br />
        <h6>Your Account Not Allow to <?php echo $post; ?> Ads</h6>
        
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 pb-0"></div>
        </div>
        
        </div>
                
                <?php } ?>
                
            </div>
        </div>
        <?php
    }
	
	
	 public function subcategories() {
	 ?>
	 <div class="rows">
	<div class="container">
    <div class="bor">
    	<div class="categories-left">
    		<?php $this->leftMenu(); ?>
        </div>
        <div class="categories-right">
        	<div>
            	<a class="location" href="#"><i class="fa fa-map-marker"></i> <b>Location</b> <span>(Select your city to see local ads)
</span></a>
            </div>
            <?php
            $cat_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id=".$_REQUEST['cat_id']." and categories_status=1");
            $cat_row = mysqli_fetch_object($cat_query);
            ?>
            
            <div class="categories-img">
            	<div class="cat_box">
            	<a href="index.php?module=categories&action=view&cat_id=<?php echo $cat_row ->categories_id; ?>">
            	<div class="box-inner">
                	<i class="<?php echo $cat_row->categories_image; ?>"></i>
                    <span><?php echo $cat_row ->categories_name; ?></span>
                </div>
                </a>
                </div>
                <div class="categories-img-right">
                	<div class="title"><?php echo $cat_row->categories_name; ?></div>
                    <div class="number-ads"><?php echo $cat_row->categories_desc; ?></div>
                    <a href="index.php?action=view&module=products&cat_id=<?php echo $cat_row->categories_id; ?>" class="view-all">View all ads >></a>
                </div>
            </div>
            <div class="categories-list">
            	<ul>
            	<?php
            	 $sub_cat_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_sub=".$_REQUEST['cat_id']." and categories_status=1");
            while($sub_cat_row = mysqli_fetch_object($sub_cat_query )){ ?>
            
                	<li>
                	<div class="main-img">
                	<a href="index.php?module=categories&action=view&cat_id=<?php echo $sub_cat_row->categories_id; ?>">
            	<div class="box-inner">
                	<i class="<?php echo $sub_cat_row->categories_image; ?>"></i>
                    <span><?php echo $sub_cat_row->categories_name; ?></span>
                </div>
                </a>
                	</div> 
                	<div class="main-link">
                	<?php echo $sub_cat_row->categories_name; ?>
                	</div>
                	</li>
                	
                	
                	<?php
                	
                	}
                	
                	?>
                    
                </ul>
            </div>
        </div>
        </div>
    </div>
</div>
	 <?php
	 }
	 
	  public function leftMenu() {
	  
	  ?>
	  
	  <div class="main-categories">Main Categories</div>
<div><a class="all-ads" href="mobile-tablets-list.php">All ads >></a></div>
<div class="border-bor"></div>
<div class="left-menu">
<ul>

<?php
$cat_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_parent=1 and categories_status=1 order by categories_name ASC");

	while($row = mysqli_fetch_object($cat_query)){ ?>
	
		<li><a <?php if($row->categories_id==$_REQUEST['cat_id']){?> class="left-menu-cur" <?php } ?> href="index.php?module=categories&action=view&cat_id=<?php echo $row->categories_id; ?>"><span style="width:25px;" class="<?php echo $row->categories_image;?>" ></span> <span><?php echo $row->categories_name;?></span></a></li>
	
	<?php } ?>

</ul>
         
	
</div>
	  <?php
	}

}
?>