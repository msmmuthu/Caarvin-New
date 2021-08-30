<?php

class searchincat{

    public function select() {
	
	
        ?>
         
        <div class="rows">
        <?php
		$query_search = $_REQUEST['string'];
		
		$lan = $_SESSION['pic']['biscuit']['lan'];
		$lon = $_SESSION['pic']['biscuit']['lon'];
		$locality = $_SESSION['pic']['biscuit']['town'];
		
		 if(isset($_SESSION['pic']['biscuit']['city'])){ $city = $_SESSION['pic']['biscuit']['city'];}
		  else{ $city = ""; }
		  
		  if(isset($_REQUEST['sort']) and $_REQUEST['sort']==1){
		 
		  $order = "pic_price ASC";
		 
		}
		elseif(isset($_REQUEST['sort']) and $_REQUEST['sort']==2){
		
		 $order = "pic_price DESC";
		
		}
		else{
		 $order = "CASE WHEN instr(pic_add_town, '$locality') = 0 then 1 else 0 end,distance ASC";
		
		}
		  
		?>
        
        <?php
		// Sub Category products query
		
		$cat_char = $this->subcatid();
		
		// End - Sub Category products query
		
		
		
		$query_ads = mysqli_query($this->mysqlConfig(),"SELECT * , 111.045 * DEGREES( ACOS( COS( RADIANS( ".$lan." ) ) * COS( RADIANS(  `pic_add_lan` ) ) * COS( RADIANS(  `pic_add_lon` ) - RADIANS( ".$lon." ) ) + SIN( RADIANS( ".$lan." ) ) * SIN( RADIANS(  `pic_add_lan` ) ) ) ) AS distance FROM pic_addpost where (pic_category in ".$cat_char." and pic_request=".$_REQUEST['type']." and addpost_status=1) and (`pic_title` LIKE  '%$query_search%' or `pic_tag` LIKE  '%$query_search%' or `pic_ads_id` LIKE  '%$query_search%' or `pic_admin_tag` LIKE  '%$query_search%') order by ".$order." LIMIT 5 OFFSET ".$_REQUEST['offset']."");
		?>
		 
        <script>
		
		function loadmore_mobile_layout(){
		loadmore_searchin(<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['sort']; ?>,'<?php echo $_REQUEST['string']; ?>');
		}
		
    </script>
        <?php
		$check_rows_ads = mysqli_num_rows($query_ads);
		while($row = mysqli_fetch_object($query_ads)) {
		?>
        	<a <?php if($row->pic_privacy==0 and $_REQUEST['type']==0){ ?>  data-reveal-id="myModal" onclick="javascript:pass_ads_id(<?php echo $row->pic_ads_id; ?>);" href="javascript:void(0);" <?php } else {?> href="index.php?action=view&module=<?php if($_REQUEST['type']==0){ echo "product_detail";} else { echo "request_detail"; } ?>&ads_id=<?php echo $row->pic_ads_id; ?>" <?php } ?> >
        	<div class="list-view">
            	<div class="list-view-img">
                <?php
				$query_img = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_images where addpost_id='$row->pic_ads_id' order by ad_image_id ASC limit 1");
				$row_img = mysqli_fetch_object($query_img);
				$row_nm = mysqli_num_rows($query_img);
				if($row_nm==1){
				
				?>
                <img width="150" src="media/small/<?php echo $row_img->ad_image_url; ?>"> 
                
                <?php } else { ?>
                
                <img width="150" src="css/images/no_images.jpg"> 
                
                <?php } ?>
                </div>
                <div class="list-view-cont">
                	<div class="list-title"><?php echo $row->pic_title; ?></div>
                    <p><?php echo $row->pic_discription; ?></p>
                    <b><?php echo $row->pic_add_taluk." , ".$row->pic_post_city." District"; ?></b>
                    
                    <div class="recent-time">
                    <strong>Posted on :</strong>
					<?php 
					$date = date_create($row->pic_postdate);
                    echo date_format($date, 'd/m/Y'); 
					?>
					</div>
                </div>
                <div class="list-view-amt">
                	<b><i><img src="css/images/inr_symbol.png" /></i><?php echo $row->pic_price; ?></b>
                </div>
            </div>
            </a>
            
            <?php
			}
			?>
         
        </div>
        <div id="loadmore_rows<?php echo $_POST['p']+1; ?>">
        <?php if($check_rows_ads>4){ ?>
        <a class="loadmore-products" href="javascript:void(0)" onclick="javascript:loadmore_mobile_layout();">Load More Ads</a>
        <?php } ?>
        </div>
        
        <?php
    }
	public function selectSub() { ?>
    
    <h4>
        <?php
		
		
        $title_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `fields_id`=".$_REQUEST['sub']." limit 1");
		$title_row = mysqli_fetch_object($title_query);
		echo "Choose ".$title_row->fields_title;
		?>
        </h4>
        <?php
		
		?>
	<select class="filter_chain filter_sub" name="<?php echo $_REQUEST['sub'];?>" id="<?php echo $_REQUEST['sub']; ?>" onchange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);"  style="width:78%;">
                                       
                                 
		<?php
		$strr = ",".$_REQUEST['parent'];
		$chain_value = $_POST['chain_value'];
		foreach($chain_value as $chainValues){
		$chainValues = explode(':', $chainValues);
			if($chainValues[0]==$_REQUEST['sub']){
			
			$chainValues=$chainValues[1];
			
			}
		}
		
		$sub_quick_filter_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `field_chain_value` LIKE '%{$strr}%' ");
		?>
		<option value="0">All</option>
        <?php
        while($row = mysqli_fetch_object($sub_quick_filter_query)){
        ?>
			<option <?php if($chainValues==$row->fields_id){ ?> selected="selected" <?php } ?> value="<?php echo $row->fields_id;?>"><?php echo $row->field_value; ?></option>
            
		<?php
		}
		?>	
        </select>
        <?php
	}

	 public function list_products() {
	 
            $query_search = $_REQUEST['string'];
			
			$cat_ids= $_GET['cat_id'];
			$subcat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_categories` where categories_id=$cat_ids");
			$row_subcat_query = mysqli_fetch_object($subcat_query);
			if($row_subcat_query->categories_sub!=0){
			$cat_ids = $row_subcat_query->categories_sub;
			}
			
			$usr=$_SESSION['pic']['biscuit']['userid'];
            $user_types=mysqli_query($this->mysqlConfig(),"select * from pic_user where user_id='$usr' ");
            $row = mysqli_fetch_object($user_types);
            $utype = $row->user_type;
            
            $user_types_query=mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_user_type` where user_type='$utype'"); 
            $row_user_types = mysqli_fetch_object($user_types_query);
            $uType = $row_user_types->setoption;
			$category_privacy = "(".$row_user_types->setcategory.")";
			
			$lan = $_SESSION['pic']['biscuit']['lan'];
			$lon = $_SESSION['pic']['biscuit']['lon'];
			$locality = $_SESSION['pic']['biscuit']['town'];
			
			
	
$check_privacy = mysqli_query($this->mysqlConfig(),"SELECT * , 111.045 * DEGREES( ACOS( COS( RADIANS( ".$lan." ) ) * COS( RADIANS(  `pic_add_lan` ) ) * COS( RADIANS(  `pic_add_lon` ) - RADIANS( ".$lon." ) ) + SIN( RADIANS( ".$lan." ) ) * SIN( RADIANS(  `pic_add_lan` ) ) ) ) AS distance FROM pic_addpost LEFT JOIN (pic_addpost_images, pic_categories) ON ( pic_addpost_images.addpost_id = pic_addpost.pic_ads_id
AND pic_categories.categories_id = pic_addpost.pic_category ) where (pic_category in ".$category_privacy." and pic_request=".$_REQUEST['type']." and addpost_status=1) and (`pic_title` LIKE  '%$query_search%' or `pic_tag` LIKE  '%$query_search%' or `pic_ads_id` LIKE  '%$query_search%' or `pic_admin_tag` LIKE  '%$query_search%' or `ad_image_desc` LIKE  '%$query_search%') group by pic_ads_id order by ".$order."  LIMIT 5 OFFSET ".$_REQUEST['offset']."");

//echo "SELECT * , ( 3956 *2 * ASIN( SQRT( POWER( SIN( ( 10.6307 - pic_add_lan ) * PI( ) /180 /2 ) , 2 ) + COS( 10.6307 * PI( ) /180 ) * COS( pic_add_lan * PI( ) /180 ) * POWER( SIN( ( 79.3131 - pic_add_lon ) * PI( ) /180 /2 ) , 2 ) ) ) ) AS distance FROM pic_addpost HAVING distance <=20 and pic_category in ".$category_privacy." and pic_request=".$_REQUEST['type']." and addpost_status=1 order by distance LIMIT 5 OFFSET ".$_REQUEST['offset']."";

			//$check_privacy = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_category in ".$category_privacy." and pic_request=".$_REQUEST['type']." and addpost_status=1 order by $order LIMIT 5 OFFSET ".$_REQUEST['offset']."");
			if(strpos($uType, 'view') !== false and strpos($category_privacy , $_GET['cat_id']) !== false){?>
            <div class="rows">
            <div class="container">
            <div class="bor">
			<?php
            $this->leftMenu();
            ?>
            <div class="categories-right" >     
            <div id="ads_div">
            <div id="loading_filter" style="display:none;">
            <h2>Picads</h2>
            <h4>loading..</h4>
            <img src="css/images/circel.gif" /></div>
            <div class="filter">
                <div class="filter-list">
                    
                </div>
                
                <div class="space_10"></div>
                <?php echo $this->sorting(); ?>
            </div>
            <script>
            function MM_jumpMenu(targ,selObj,restore){ //v3.0
        
          eval(targ+".location='"+"?module=searchincat&action=view&p=1&offset=0&string=<?php echo $_REQUEST['string']; ?>&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type="+$("#adstype").val()+"&sort="+$("#sorting").val()+"'");
          if (restore) selObj.selectedIndex=0;
        }
        
        </script>
            <script>
            function MM_jumpMenu2(targ,selObj,restore){ //v3.0
        
          eval(targ+".location='"+"?module=searchincat&action=view&p=1&offset=0&string=<?php echo $_REQUEST['string']; ?>&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type="+$("#adstype").val()+"&sort="+$("#sorting").val()+"'");
          if (restore) selObj.selectedIndex=0;
        }
        </script>
            <div class="rows" >
            <?php
             if(isset($_SESSION['pic']['biscuit']['city'])){ $city = $_SESSION['pic']['biscuit']['city'];}
              else{ $city = ""; }
              if(isset($_REQUEST['sort']) and $_REQUEST['sort']==1){
              $order = "pic_price ASC";
            }
            elseif(isset($_REQUEST['sort']) and $_REQUEST['sort']==2){
             $order = "pic_price DESC";
            }
            else{
			
             $order = "CASE WHEN instr(pic_add_town, '$locality') = 0 then 1 else 0 end,distance ASC";
			 
            }
            // Sub Category products query
            $cat_char = $this->subcatid(); 
            // End - Sub Category products query
            
			

            $query_ads = mysqli_query($this->mysqlConfig(),"SELECT * , 111.045 * DEGREES( ACOS( COS( RADIANS( ".$lan." ) ) * COS( RADIANS(  `pic_add_lan` ) ) * COS( RADIANS(  `pic_add_lon` ) - RADIANS( ".$lon." ) ) + SIN( RADIANS( ".$lan." ) ) * SIN( RADIANS(  `pic_add_lan` ) ) ) ) AS distance FROM pic_addpost LEFT JOIN (pic_addpost_images, pic_categories) ON ( pic_addpost_images.addpost_id = pic_addpost.pic_ads_id
AND pic_categories.categories_id = pic_addpost.pic_category ) where (pic_category in ".$cat_char." and pic_request=".$_REQUEST['type']." and addpost_status=1) and (`pic_title` LIKE  '%$query_search%' or `pic_tag` LIKE  '%$query_search%' or `pic_ads_id` LIKE  '%$query_search%' or `pic_admin_tag` LIKE  '%$query_search%' or `ad_image_desc` LIKE  '%$query_search%') group by pic_ads_id order by ".$order."  LIMIT 5 OFFSET ".$_REQUEST['offset']."");
			$count_rows = mysqli_num_rows($query_ads);
			
			$query_ads_for_count = mysqli_query($this->mysqlConfig(),"select * from pic_addpost LEFT JOIN (pic_addpost_images, pic_categories) ON ( pic_addpost_images.addpost_id = pic_addpost.pic_ads_id AND pic_categories.categories_id = pic_addpost.pic_category ) where (pic_category in ".$cat_char." and pic_request=".$_REQUEST['type']." and addpost_status=1) and (`pic_title` LIKE  '%$query_search%' or `pic_tag` LIKE  '%$query_search%' or `pic_ads_id` LIKE  '%$query_search%' or `pic_admin_tag` LIKE  '%$query_search%' or `ad_image_desc` LIKE  '%$query_search%') group by pic_ads_id order by $order");
			$ads_for_counts = mysqli_num_rows($query_ads_for_count);
            
            ?>
            <?php 
            require'view/misc/Mobile_Detect.php';
                $detect = new Mobile_Detect();
                // Check for any mobile device.
                $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
                
            ?>
            <script>
            
            function loadmore_mobile_layout(){
            loadmore_searchin(<?php echo $_GET['p']; ?>,<?php echo $_GET['type']; ?>,<?php echo $_GET['cat_id']; ?>,<?php echo $_GET['sort']; ?>,'<?php echo $_GET['string']; ?>');
            }
			
        </script>
            <?php
			$check_rows_ads = mysqli_num_rows($query_ads);
            while($row = mysqli_fetch_object($query_ads)) {
			
          	$this->loopAds($row->pic_ads_id,$row->pic_user_id,$row->pic_title,$row->pic_discription,$row->pic_add_taluk,$row->pic_post_city,$row->pic_postdate,$row->pic_price);
			
                }
                ?>
                
            </div>
            
           	<?php 
			
			if($count_rows>4){ ?>
            <div id="loadmore_rows2"><a class="loadmore-products" href="javascript:void(0)" onclick="javascript:loadmore_mobile_layout();">Load More Ads</a></div>
            <?php } ?>
            <div class="space_20"></div>
            <?php
			require("helper/misc/misc.php");
			$likeads = new misc();
			$likeads->likeForm();
			?>
            
            </div>
            </div>
    
            </div>
            
        </div>
    </div>


 <?php } else { ?>
        
         <div class="rows">
	<div class="container">
        
        <div class="bor" style="text-align:center">
        
        <h3>You are not allowed to view ads!</h3>
        
        </div>
        </div>
        
        
         <?php }?>
         


	 <?php
	 }
	 
	  public function leftMenu() {
	  
	  ?>
      
	  <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
  
  
      <div class="categories-left">
      


		
     <form id="filter_form" name="filter_form" method="post" action="index.php" class="form-horizontal" role="form" >
     <input type="hidden" name="module" value="products">
     <input type="hidden" name="action" value="view">
     <input type="hidden" name="filter" value="yes">
    
     <input type="hidden" name="cat_id" value="<?php echo $_REQUEST['cat_id']; ?>">
     <input type="hidden" name="p" value="<?php echo $_REQUEST['p']; ?>">
     <input type="hidden" name="offset" value="<?php echo $_REQUEST['offset']; ?>">
     <input type="hidden" name="sort" value="<?php echo $_REQUEST['sort']; ?>">
     <input type="hidden" name="type" value="<?php echo $_REQUEST['type']; ?>">
     
    
<script type="text/javascript" src="js/bootstrap-list-filter.src.js"></script>
<script type="text/javascript" src="js/bootstrap-slider.js"></script>
<link rel="stylesheet" type="text/css" href="css/accordion.css" />
<script type="text/javascript" src="js/scriptbreaker-multiple-accordion-1.js"></script>
<script language="JavaScript">

$(document).ready(function() {
	$(".topnav").accordion({
		accordion:false,
		speed: 500,
		closedSign: '+',
		openedSign: '-'
	});
});

$(document).ready(function() {
	
	$('#showLess').hide();
	
    size_li = $("#myList li").size();
	
    x=2;
    $('#myList li:lt('+x+')').show();
    $('#loadMore').click(function () {
        x= (x+2 <= size_li) ? x+2 : size_li;
        $('#myList li:lt('+x+')').show();
		
		if(size_li==x){
			$('#loadMore').hide();
			$('#showLess').show();
    	}
		else{
			$('#loadMore').show();
			$('#showLess').hide();
			
		}
    });
    $('#showLess').click(function () {
        x=2;
        $('#myList li').not(':lt('+x+')').hide();
		
		if(x>1){
			$('#loadMore').show();
			$('#showLess').hide();
    	}
		else{
			$('#loadMore').hide();
			$('#showLess').show();
			
		}
    });
    
});

</script>
<link type="text/css" rel="stylesheet" href="css/jquery.treefilter.css">
<script src="js/jquery.treefilter-min.js"></script>
<script>
$(function() {

	var tree = new treefilter($("#my-tree"), {
		searcher : $("input#my-search"),
		multiselect : false
	});
});
</script>
<style>
	ul#my-tree	{margin:0; padding:10px 5px; color:#666;}
	ul#my-tree	li		{margin:8px 0;}
	.tf-tree .tf-child-true::before{ font-size:20px;}
	.tf-tree .tf-child-false:before {font-size:20px;}
</style>


<?php

// Sub Category products query

$cat_char = $this->subcatid();

// End - Sub Category products query
		
// main query
$price_filter_query=mysqli_query($this->mysqlConfig(),"select DISTINCT addpost_fields_title from pic_addpost_field where addpost_fields_categories_id in ".$cat_char." ORDER BY addpost_field_id ASC ");
?>

<ul class="topnav">
<li>
<a style="background:#6a2800;color:#fff;" href="javascript:void(0);">Price</a>
</li>
<?php
$filter_list_ASC_query=mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_category in ".$cat_char." ORDER BY pic_price ASC limit 1");
$filter_list_DESC_query=mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_category in ".$cat_char." ORDER BY pic_price DESC limit 1");
$row_list_ASC = mysqli_fetch_object($filter_list_ASC_query);
$row_list_DESC = mysqli_fetch_object($filter_list_DESC_query);
$row_list_DESC ->pic_price;
$total = ($row_list_DESC->pic_price- $row_list_ASC->pic_price)/3;
$total = $row_list_ASC+$total;
$no = mysqli_num_rows($filter_list_ASC_query);
?>
<ul>
<div style="overflow: auto; overflow-x: hidden; height:125px;" id="price" class="list-group">
<li>
  <div style="padding: 5px;" align="center">
  <input type="text" name="from_price" id="filter_price_from" class="filter_price_from"  placeholder="10" value="" >
  </div>
   <div style="padding: 5px;" align="center">- To - </div>
   <div style="padding: 5px;" align="center">
  <input type="text" name="to_price" id="filter_price_to" class="filter_price_to" onchange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);" placeholder="100000" value="" >
  </div>
  
 
</li>
</div>
			
</ul>	
</ul>
<?php
$quick_filter_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields` where `fields_type`='Chain' and fields_categories_id=".$_REQUEST['cat_id']."");
$quick_filter_row = mysqli_fetch_object($quick_filter_query);
$checkRow = mysqli_num_rows($quick_filter_query);
if($checkRow!=0){
?>
<ul class="topnav">
<?php
		
		$field_value_trim = trim($quick_filter_row->field_value, "from:");
		$field_value_trim = str_replace('to:', '', $field_value_trim);
		
		$field_value_trim = explode(',', $field_value_trim);
		$chain_id1 = $field_value_trim[0];
		$chain_id2 = $field_value_trim[1];
		$field_value_trim = "(".$field_value_trim[0].")";
		
		$title_query1 = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `fields_id`=$chain_id2 limit 1");
		$title_row1 = mysqli_fetch_object($title_query1);
		
		$chain2 = $title_row1->fields_title;
		
		$title_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `fields_id`=$chain_id1 limit 1");
		$title_row = mysqli_fetch_object($title_query);
		
		$chain1 = $title_row->fields_title;
		
		
		
		?>
    <li>
    	<a style="background:#6a2800;color:#fff;" href="javascript:void(0);"><?php echo $chain1; ?></a>
    </li>
		
        
        <div style="padding:5px 20px;font-size: 13px;" class="list-group-item">
        <h4>
        <?php echo "Choose ".$title_row->fields_title; ?>
        </h4>
        <input class="sub" type="hidden" name="sub" value="<?php echo $chain_id2; ?>" />
		<select name="<?php echo $chain_id1;?>" id="<?php echo $chain_id1; ?>" onchange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);" class="filter_chain"  style="width:78%;">
                                       
                                 
		<?php
        $parent_quick_filter_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `field_DV_id` in $field_value_trim");
		?>
		<option selected="selected" value="0">All</option>
        <?php
        while($parent_quick_filter_row = mysqli_fetch_object($parent_quick_filter_query)){
        ?>
			<option value="<?php echo $parent_quick_filter_row->fields_id;?>"><?php echo $parent_quick_filter_row->field_value; ?></option>
            
		<?php
		}
		?>	
        </select>
       <div style="padding:5px 0px;font-size: 13px;" class="list-group-item" id="sub_div">
       
       </div>
        </div>
			
		
</ul>
<?php
}
?>
<ul  id="myList" >
<li>
	
   		<?php
			$filter_query=mysqli_query($this->mysqlConfig(),"select DISTINCT field_id,addpost_fields_title,addpost_fields_type from pic_addpost_field where addpost_fields_categories_id in ".$cat_char." and addpost_fields_type in ('TextBox','Numeric')");
			$no=0;
			while($row = mysqli_fetch_object($filter_query)){
			
    		?>
    		
    		<ul class="topnav">	
	<li>
	
	<?php $nametitle = preg_replace('/\s+/', '', $row->addpost_fields_title); ?>
    <?php $nameid = $row->field_id; ?>
	<a style="background:#6a2800;color:#fff;" href="javascript:void(0);"><?php echo $row->addpost_fields_title; ?></a>
		<ul <?php if(isset($_POST[$nametitle])){ ?> style="display:block;" <?php } else { ?>style="display:none;" <?php } ?>>
			
			
			<?php
			 if($no<10 && $row->addpost_fields_type!="Numeric"){
			?>
			
			<input class="form-control" id="<?php echo $nametitle ; ?>input" type="search" placeholder="Search..."  style="width:100%; " />
			
			<div style="overflow: auto; overflow-x: hidden;" id="<?php echo $nametitle ; ?>" class="list-group">
			
			 <?php
			}
			else{?>
			<div>
		<?php
		}
		?>
		<?php
			 
			if($row->addpost_fields_type!="Numeric"){
			$filter_list_query=mysqli_query($this->mysqlConfig(),"select DISTINCT addpost_fields_value,addpost_fields_title,field_id from pic_addpost_field where addpost_fields_categories_id in ".$cat_char." and field_id = '".$row->field_id."' and addpost_fields_value != '' order by addpost_fields_value ASC");
			$no = mysqli_num_rows($filter_list_query);
			while($row_list = mysqli_fetch_object($filter_list_query)){
			$query_othercolumn=mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_categories_fields` where fields_id = '".$row_list->field_id."'");
			$row_othercolumn = mysqli_fetch_object($query_othercolumn);
			$name = $row_othercolumn->fields_title;
			
			//echo $_POST[$name];
			 if($no<10){
			 ?>
			<div><a style="padding:5px 20px;font-size: 13px;text-transform: uppercase;" class="list-group-item" href="#"><input id="<?php echo $row_othercolumn->fields_id;?>" name="<?php echo $name;?>" value="<?php echo $row_list->addpost_fields_value;?>" class="filter_checkbox" type="radio" onChange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);" style="float:left;"><div style="padding:5px; padding-left: 25px;"><?php echo $row_list->addpost_fields_value;?></div></a></div>
			
			 <?php
			 }
			 else{
			 ?>
			 <a style="padding:5px 20px;font-size: 13px;text-transform: uppercase;" href="#"><input id="<?php echo $row_othercolumn->fields_id;?>" name="<?php echo $name;?>" value="<?php echo $row_list->addpost_fields_value;?>" type="<?php if($multi==1){ ?>checkbox <?php } else { ?>radio<?php } ?>" class="filter_checkbox" onChange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);" style="float:left;"><div style="padding:5px; padding-left: 25px;"><?php echo $row_list->addpost_fields_value;?></div></a>
			 <?php
			 }
			 }
			 }
			 else{ 
			 
			 ?>
			 <div style="overflow: auto; overflow-x: hidden; height:125px;" id="price" class="list-group">

  <div style="padding: 5px;" align="center">
  <input type="text" name="<?php echo $nametitle."1"; ?>" id="<?php echo $nameid; ?>" class="filter_numeric_from" value="" placeholder="<?php echo $nametitle; ?> From.."  >
  </div>
   <div style="padding: 5px;" align="center">- To - </div>
   <div style="padding: 5px;" align="center">
  <input type="text" name="<?php echo $nametitle."2"; ?>" id="<?php echo $nameid; ?>" value="" class="filter_numeric_to" placeholder="<?php echo $nametitle; ?> To.." onchange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);">
  </div>
  
 

</div>
			 <?php
			 }
			 ?>
			 </div>
			
		</ul>
	</li>
	
	
</ul>





<script type="text/javascript">

$('#<?php echo $nametitle ?>').btsListFilter('#<?php echo $nametitle ?>input', {itemChild: 'div'});

</script>
<!--<script src="js/labs-common.js"></script>-->

<?php
}
?>

<?php
			$filter_query=mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_fields_categories_id in ".$cat_char." and addpost_fields_type='DropDown' and addpost_fields_title != '".$chain1."' and addpost_fields_title != '".$chain2."' group by addpost_fields_title");
			$no=0;
			while($row = mysqli_fetch_object($filter_query)){
			
    		?>
    		
        <ul class="topnav">	
        <li>
        <?php
	$query_title = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_addpost_field` WHERE  `field_id` = $row->field_id limit 1");
	$field_title = mysqli_fetch_object($query_title);
	?>
	<?php $nametitle = preg_replace('/\s+/', '', $field_title->addpost_fields_title); ?>
	<a style="background:#6a2800;color:#fff;" href="javascript:void(0);"><?php echo $field_title->addpost_fields_title; ?></a>
		<ul <?php if(isset($_POST[$nametitle])){ ?> style="display:block;" <?php } else { ?>style="display:none;" <?php } ?>>
			<input class="form-control" id="<?php echo $nametitle ; ?>input" type="search" placeholder="Search..."  style="width:100%; " />
			<div style="overflow: auto; overflow-x: hidden;" id="<?php echo $nametitle ; ?>" class="list-group">
		<?php
			$filter_list_query=mysqli_query($this->mysqlConfig(),"select DISTINCT addpost_fields_value from pic_addpost_field where field_id = $row->field_id and addpost_fields_value!='' order by addpost_fields_value ASC");
			$no = mysqli_num_rows($filter_list_query);
			while($row_list = mysqli_fetch_object($filter_list_query)){
			
			$query_othercolumn=mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_categories_fields` where fields_id = '".$row_list->addpost_fields_value."'");
			$row_othercolumn = mysqli_fetch_object($query_othercolumn);
			$name = $row_othercolumn->field_value;
			$multi = $row_othercolumn->multi;
			 if($no<10){
			 ?>
			<div><a style="padding:5px 20px;font-size: 13px;text-transform: uppercase;" class="list-group-item" href="#"><input id="<?php echo $row_othercolumn->fields_id;?>" name="<?php echo $nametitle;?>" value="<?php echo $row_othercolumn->fields_id;?>" class="filter_checkbox" type="<?php if($multi==1){ ?>checkbox<?php } else { ?>radio<?php } ?>" onChange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);" style="float:left;"><div style="padding:5px; padding-left: 25px;"><?php echo $row_othercolumn->field_value;?></div></a></div>
			 <?php
			 }
			 else{
			 ?>
			 <a style="padding:5px 20px;font-size: 13px;text-transform: uppercase;" href="#"><input id="<?php echo $row_othercolumn->fields_id;?>" name="<?php echo $nametitle;?>" value="<?php echo $row_othercolumn->fields_id;?>" class="filter_checkbox" type="<?php if($multi==1){ ?>checkbox<?php } else { ?>radio<?php } ?>" onChange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);" style="float:left;"><div style="padding:5px; padding-left: 25px;"><?php echo $row_othercolumn->field_value;?></div></a>
			 <?php
			 }
			 }
			 ?>
			 </div>
		</ul>
	</li>
	
	
</ul>





<script type="text/javascript">

$('#<?php echo $nametitle ?>').btsListFilter('#<?php echo $nametitle ?>input', {itemChild: 'div'});

</script>
<!--<script src="js/labs-common.js"></script>-->

<?php
}
?>

</li>
</ul>
<ul class="topnav" id="loadMore">
<li>
  <div align="center"><a href="javascript:void(0);">Show More</a>
  </div>
</li>

  </ul>
<ul class="topnav" id="showLess">
<li>
  <div align="center"><a href="javascript:void(0);">Show Less</a>
  </div>
</li>

  </ul>
  
  
     </form>
        </div>
        
      
	  
      <?php
	  }
	  
	  public function filter(){
	  
	  ?>
      <div id="loading_filter" style="display:none;">
            <h2>Picads</h2>
            <h4>loading..</h4>
            <img src="css/images/circel.gif" /></div>
            <?php
            if($_REQUEST['p']==1){
			?>
            <div class="filter">
                <div class="filter-list">
                    
                </div>
                
                <div class="space_10"></div>
                <?php 
				
				echo $this->sorting(); 
				
				?>
            </div>
            <?php
			}
			?>
            <script>
            function MM_jumpMenu(targ,selObj,restore){ //v3.0
        
          eval(targ+".location='"+"?module=products&action=view&p=1&offset=0&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type="+$("#adstype").val()+"&sort="+$("#sorting").val()+"'");
          if (restore) selObj.selectedIndex=0;
        }
        
        </script>
            <script>
            function MM_jumpMenu2(targ,selObj,restore){ //v3.0
        
          eval(targ+".location='"+"?module=searchincat&action=view&p=1&offset=0&string=<?php echo $_REQUEST['string']; ?>&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type="+$("#adstype").val()+"&sort="+$("#sorting").val()+"'");
          if (restore) selObj.selectedIndex=0;
        }
        </script>
            <div class="rows" >
            <?php
             if(isset($_SESSION['pic']['biscuit']['city'])){ $city = $_SESSION['pic']['biscuit']['city'];}
              else{ $city = ""; }
              if(isset($_REQUEST['sort']) and $_REQUEST['sort']==1){
              $order = "pic_price ASC";
            }
            elseif(isset($_REQUEST['sort']) and $_REQUEST['sort']==2){
             $order = "pic_price DESC";
            }
            else{
             $order = "pic_id DESC";
            }
            // Sub Category products query
            $cat_char = $this->subcatid(); 
            // End - Sub Category products query
            
			
			// Dropdown and Textbox
			$count_c=1;
			$value = $_POST['value'];
			$value1 = $_POST['value1'];
			$numeric_from = $_POST['numeric_from'];
			$numeric_to = $_POST['numeric_to'];
			
			$fieldID="";
			$fieldVal="";
			
						
			$x=0;
			foreach($value as $values){
			$values = explode(':', $values);
			$fieldID.=$values[0].",";
			$fieldVal.="'".$values[1]."'".",";
			$x++;
			}
			//$fieldID = substr($fieldID, 0, -1);
			//$fieldVal = substr($fieldVal, 0, -1);
			
			$fieldID1="";
			$fieldVal1="";
			
			$r=0;
			foreach($value1 as $values1){
			$values1 = explode(':', $values1);
			$fieldID1.=$values1[0].",";
			$fieldVal1.="'".$values1[1]."'".",";
			$r++;
			}
			//$fieldID1 = substr($fieldID1, 0, -1);
			//$fieldVal1 = substr($fieldVal1, 0, -1);
			
			
			
			// chain
			$chain_value = $_POST['chain_value'];
			
			$chainID="";
			$chainVal="";
			$z=0;
			foreach($chain_value as $chain_values){
			$chain_values = explode(':', $chain_values);
			$chainID.=$chain_values[0].",";
			if($chain_values[1]!=0){
			$chainVal.="'".$chain_values[1]."'".",";
			}
			$z++;
			}
			//$chainID = substr($chainID, 0, -1);
			//$chainVal = substr($chainVal, 0, -1);
			
			//Numeric
			$str1="";
			$str2="";
			$str3="";
			$str="";
			
			$j=0;
			$ji=0;
			foreach($numeric_from as $numerics){
				$numerics = explode(':', $numerics);
				$str1.=" (addpost_fields_value between ".$numerics[1]."";
				
					$numericses = explode(':', $numeric_to[$j]);
					$str2.=" and ".$numericses[1]."";
					$str3.=" and `field_id`=".$numericses[0]." and addpost_fields_categories_id in ".$cat_char.")";
				
			if($numericses[1]!=0){
			$str.=$str1.$str2.$str3;
			$ji++;
			}
			$j++;
			$str1="";
			$str2="";
			$str3="";
			}
			
			
			
			
			
			$fvstr_fields = $fieldVal.$fieldVal1.$chainVal;
			// sala 
			$fvstr_fields = substr($fvstr_fields, 0, -1);
			
			$fieldID = "(".$fieldID.")";
			
				if($fieldVal!=""){
				$fieldVal = $fieldVal;
				
				}
				if($fieldVal1!=""){
				$fieldVal1 = $fieldVal1;
				
				}
				if($chainVal!="" and $fieldVal!="" and $fieldVal1!=""){
				$comma = ",";
				
				}
				if($fieldVal!="" and $fieldVal1!=""){
				$comma1 = ",";
				
				}
				if($chainVal!=""){
				$chainVal = $chainVal;
				}
			if($chainVal!="" or $fieldVal!="" or $fieldVal1!=""){
			
			$fvstr = "(addpost_fields_value in (".$fvstr_fields.") and addpost_fields_categories_id in ".$cat_char.")";
			$pri_price = "yes";
			}
			
			if($str!="" and $fvstr!=""){
				$or = " or ";
				$pri_price = "yes";
			}
			if($str=="" and $fvstr==""){
				$or = " addpost_fields_categories_id in ".$cat_char." ";
				
			}
			
			$lan = $_SESSION['pic']['biscuit']['lan'];
			$lon = $_SESSION['pic']['biscuit']['lon'];
			
			$str_distance = "111.045 * DEGREES( ACOS( COS( RADIANS( ".$lan." ) ) * COS( RADIANS(  `addpost_fields_lan` ) ) * COS( RADIANS(  `addpost_fields_lon` ) - RADIANS( ".$lon." ) ) + SIN( RADIANS( ".$lan." ) ) * SIN( RADIANS(  `addpost_fields_lan` ) ) ) ) AS distance";
			
			// Price
			
			if($_POST['price_to']!=""){
			$priceString = "pic_price between ".$_POST['price_from']." and ".$_POST['price_to']." and ";
			$temp_price = "yes";
			}
			else{
			$priceString = "";	
			}
			
			//$offsetes=($_REQUEST['p']*5)-5;
			//$countAll = $x+$z;
			//$count_comma = $fieldVal.$fieldVal1.$comma.$chainVal;
			
			$count_comma = substr_count($fvstr_fields, ',');
			$countAll = $count_comma+1+$ji;
			
			if($countAll!=1){
			$query_ads = mysqli_query($this->mysqlConfig(),"SELECT addpost_fields_value,addpost_fields_categories_id,addpost_uni_id,".$str_distance." FROM pic_addpost_field where ".$fvstr.$or.$str." GROUP BY addpost_uni_id having count(distinct addpost_fields_value) = ".$countAll." order by distance ASC");
			
		    $count_rows = mysqli_num_rows($query_ads);
			$count_query = mysqli_query($this->mysqlConfig(),"SELECT addpost_fields_value,addpost_fields_categories_id,addpost_uni_id,".$str_distance." FROM pic_addpost_field where ".$fvstr.$or.$str." GROUP BY addpost_uni_id having count(distinct addpost_fields_value) = ".$countAll." LIMIT 1");
			}
			else{
			$query_ads = mysqli_query($this->mysqlConfig(),"SELECT addpost_fields_value,addpost_fields_categories_id,addpost_uni_id,".$str_distance." FROM pic_addpost_field where ".$fvstr.$or.$str." GROUP BY addpost_uni_id order by distance ASC");
			
            $count_rows = mysqli_num_rows($query_ads);
			$count_query = mysqli_query($this->mysqlConfig(),"SELECT addpost_fields_value,addpost_fields_categories_id,addpost_uni_id,".$str_distance." FROM pic_addpost_field where ".$fvstr.$or.$str." GROUP BY addpost_uni_id  LIMIT 1");
			}
			
			
			$count_fields = mysqli_fetch_object($count_query);
			if($count_fields->c==1) { 
			$i=1; 
			}
			elseif($count_comma>0){
			$i=$count_fields->c; 
			}
			elseif($count_comma==0){
			$i=$count_fields->c; 
			}
			$x=0;
			$y=0;
			if($_REQUEST['offset']==0){
			}
			else{
			$y = $_REQUEST['offset']/$_REQUEST['p'];
			$z = $_REQUEST['p']-1;
			$y = $y*$z;
			//$y = $y+1;
			}
			
			$check_rows_ads = mysqli_num_rows($count_query);
			
			if($check_rows_ads!=0){
            while($list = mysqli_fetch_object($query_ads)) {
			
			if($list->c==1 and $count_comma==0){ 
			$query_row = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where ".$priceString." pic_ads_id='".$list->addpost_uni_id."' and pic_request=".$_REQUEST['type']." and addpost_status=1");
			$row = mysqli_fetch_object($query_row);
			$cou_rows = mysqli_num_rows($query_row);
			$offset_temp = $_REQUEST['p']*5;
			
			
			//echo $x."|".$y."<br/>";
			if($cou_rows!=0 and $x<$offset_temp){
			if($x==$y){
			
			$this->loopAds($row->pic_ads_id,$row->pic_user_id,$row->pic_title,$row->pic_discription,$row->pic_add_taluk,$row->pic_post_city,$row->pic_postdate,$row->pic_price);
				
				$y++;
				}
				
				$x++;
				if($x==$offset_temp){
				$filter_p = $_REQUEST['p']+1;
				}
				}
				}
				
			elseif($count_comma==0){  
			$query_row = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where ".$priceString." pic_ads_id='".$list->addpost_uni_id."' and pic_request=".$_REQUEST['type']." and addpost_status=1");
			$row = mysqli_fetch_object($query_row);
			$cou_rows = mysqli_num_rows($query_row);
			$offset_temp = $_REQUEST['p']*5;
			
			
			//echo $x."|".$y."<br/>";
			if($cou_rows!=0 and $x<$offset_temp){
			if($x==$y){
		
			$this->loopAds($row->pic_ads_id,$row->pic_user_id,$row->pic_title,$row->pic_discription,$row->pic_add_taluk,$row->pic_post_city,$row->pic_postdate,$row->pic_price);
				
				$y++;
				}
				
				$x++;
				if($x==$offset_temp){
				$filter_p = $_REQUEST['p']+1;
				}
				}
				}
			elseif($count_comma>0 and $count_fields->c==$list->c){ 
			$query_row = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where ".$priceString." pic_ads_id='".$list->addpost_uni_id."' and pic_request=".$_REQUEST['type']." and addpost_status=1");
			$row = mysqli_fetch_object($query_row);
			$cou_rows = mysqli_num_rows($query_row);
			$offset_temp = $_REQUEST['p']*5;
			
			
			//echo $x."|".$y."<br/>";
			if($cou_rows!=0 and $x<$offset_temp){
			if($x==$y){
			
			$this->loopAds($row->pic_ads_id,$row->pic_user_id,$row->pic_title,$row->pic_discription,$row->pic_add_taluk,$row->pic_post_city,$row->pic_postdate,$row->pic_price);
				
				$y++;
				}
				
				$x++;
				if($x==$offset_temp){
				$filter_p = $_REQUEST['p']+1;
				}
				}
				}
				
				}
				
				}
				
				elseif($temp_price=="yes" and $pri_price!="yes"){ 
				
			$query_row = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_category in ".$cat_char." and ".$priceString." pic_request=".$_REQUEST['type']." and addpost_status=1 and pic_add_lan>");
			
			
			
			$cou_rows = mysqli_num_rows($query_row);
			
			while($row = mysqli_fetch_object($query_row)){
			$offset_temp = $_REQUEST['p']*5;
			
			//echo $x."|".$y."<br/>";
			if($cou_rows!=0 and $x<$offset_temp){
			if($x==$y){
			
			$this->loopAds($row->pic_ads_id,$row->pic_user_id,$row->pic_title,$row->pic_discription,$row->pic_add_taluk,$row->pic_post_city,$row->pic_postdate,$row->pic_price);
				
				$y++;
				}
				
				$x++;
				if($x==$offset_temp){
				$filter_p = $_REQUEST['p']+1;
				}
				}
				
                }
				}
				?>
                
            </div>
            
            <?php 
			
			$totalads = $x/$_REQUEST['p'];
			if($totalads>=5 or $x==5){ ?>
            <div id="loadmore_rows<?php echo $_REQUEST['p']+1; ?>">
            <a id="loadmore_filter" class="loadmore-products" href="javascript:void(0)" onclick="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $filter_p; ?>,<?php echo $_REQUEST['sort']; ?>);" >Load More Ads</a>
            </div>
            <?php } ?>
           
            <div class="space_20"></div>
			 <?php
			require("helper/misc/misc.php");
			$likeads = new misc();
			$likeads->likeForm();
			?>
    		
            
	  <?php
	  
	  }
	  
	  public function sorting(){
	  
	  ?>
      
	 <script>
        function MM_jumpMenu(targ,selObj,restore){ //v3.0
	
	  eval(targ+".location='"+"?module=searchincat&action=view&p=1&offset=0&string=<?php echo $_REQUEST['string']; ?>&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type="+$("#adstype").val()+"&sort="+$("#sorting").val()+"'");
	  if (restore) selObj.selectedIndex=0;
	}
	
	</script>
    	<script>
        function MM_jumpMenu2(targ,selObj,restore){ //v3.0
	
	  eval(targ+".location='"+"?module=searchincat&action=view&p=1&offset=0&string=<?php echo $_REQUEST['string']; ?>&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type="+$("#adstype").val()+"&sort="+$("#sorting").val()+"'");
	  if (restore) selObj.selectedIndex=0;
	}
	</script>
    
            
             <div class="rows" align="left" style="width: 40%;float: left;clear:none;">
           	  <form name="sort_form2" id="sort_form2">
              <label>
            	  <select class="select_adstype" name="adstype" size="1" id="adstype" onChange="MM_jumpMenu2('parent',this,0)">
            	    <option <?php if($_REQUEST['type']==0){ ?> selected="selected" <?php } ?> value="0">Posted Ads</option>
            	    <option <?php if($_REQUEST['type']==1){ ?> selected="selected" <?php } ?> value="1">Requested Ads</option>
                   </select>
               </label>
                </form>
            </div>
            
             <div class="rows" align="right" style="width: 40%;float: right;clear:none;">
           	  <form name="sort_form" id="sort_form">
              <label>
            	  <select class="select_sorting" style="width:110px;" name="sorting" size="1" id="sorting" onChange="MM_jumpMenu('parent',this,0)">
            	    <option value="0">Price Sorting</option>
            	    <option <?php if($_REQUEST['sort']==1){ ?> selected="selected" <?php } ?> value="1">Low to High</option>
            	    <option <?php if($_REQUEST['sort']==2){ ?> selected="selected" <?php } ?> value="2">High to Low</option>
                   </select>
                    </label>
                </form>
            </div>
	  
	  <?php
		
	  
	  }
	  
	  public function subcatid(){
		$query_subcat = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_categories` where categories_sub = ".$_REQUEST['cat_id']."");
		$cat_char="(";
		while($row_subcat = mysqli_fetch_object($query_subcat)){
		
			$cat_char.=$row_subcat->categories_id.",";
		
		}
		$cat_char.=$_REQUEST['cat_id'];
		$cat_char.=")";
		return $cat_char;
	  }
	  
	  public function loopAds($adid,$adsuserid,$pic_title,$pic_discription,$pic_add_taluk,$pic_post_city,$pic_postdate,$pic_price){
	   
			$userid = $_SESSION['pic']['biscuit']['userid'];
			$queryuser = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_user` where user_id = $userid limit 1");
			$rowuser = mysqli_fetch_object($queryuser);
		
            
            $like_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_likes` where likes_product_id='$adid' and likes_cus_id=".$_SESSION['pic']['biscuit']['userid']."");
            $like_no = mysqli_num_rows($like_query);
            
            if($like_no==0){
            ?>
                <?php if($_REQUEST['type']==0){ ?>
                <a data-reveal-id="myModal" onclick="javascript:pass_ads_id(<?php echo $adid; ?>,<?php echo $adsuserid; ?>,'<?php echo $rowuser->user_username; ?>',<?php echo $rowuser->user_mobile; ?>,'<?php echo $rowuser->user_email; ?>','product_detail');" href="javascript:void(0);">
                <?php } else { ?>
                  <a data-reveal-id="myModal" onclick="javascript:pass_ads_id(<?php echo $adid; ?>,<?php echo $adsuserid; ?>,'<?php echo $rowuser->user_username; ?>',<?php echo $rowuser->user_mobile; ?>,'<?php echo $rowuser->user_email; ?>','request_detail');" href="javascript:void(0);">
                <?php } ?>
                
            <?php }	else{ ?>
                
                 <a data-reveal-id="myModal2" onclick="javascript:pass_ads_id(<?php echo $adid; ?>,<?php echo $adsuserid; ?>,'<?php echo $rowuser->user_username; ?>',<?php echo $rowuser->user_mobile; ?>,'<?php echo $rowuser->user_email; ?>','product_detail');" href="javascript:void(0);">
                 
            <?php
			}
			?>
                 
                <div class="list-view">
                    <div class="list-view-img">
                    <?php
					
                    $query_img = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_images where addpost_id='$adid' order by ad_image_id ASC limit 1");
                    $row_img = mysqli_fetch_object($query_img);
                    $row_nm = mysqli_num_rows($query_img);
                    if($row_nm==1){
                    
                    ?>
                    <img width="150" src="media/small/<?php echo $row_img->ad_image_url; ?>"> 
                    
                    <?php } else { ?>
                    
                    <img width="150" src="css/images/no_images.jpg"> 
                    
                    <?php } ?>
                    </div>
                    <div class="list-view-cont">
                        <div class="list-title"><?php echo $pic_title; ?></div>
                        <p><?php echo $pic_discription; ?></p>
                        <b><?php echo $pic_add_taluk." , ".$pic_post_city." District"; ?></b>
                        
                        <div class="recent-time">
                        <strong>Posted on :</strong>
                        <?php 
                        $date = date_create($pic_postdate);
                        echo date_format($date, 'd/m/Y'); 
                        ?>
                        </div>
                    </div>
                    <div class="list-view-amt">
                        <b><i><img src="css/images/inr_symbol.png" /></i><?php echo $pic_price; ?></b>
                    </div>
                </div>
                </a>
                <?php
                
	  
	  }
	 
}
?>