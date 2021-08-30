<?php

class products{

    public function select() {
        ?>
        
        
        <?php
    }
	
	
	 public function list_products() {
	 ?>
        
        
	 <div class="rows">
	<div class="container">
    <div class="bor">
    	<?php
		$this->leftMenu();
		?>
	
        <div class="categories-right">     
        
      <div class="filter">
        	<div class="filter-list">
            	
            </div>
            
            <div class="space_10"></div>
            <div class="rows" align="right">
           	  <form name="sort_form" id="sort_form">
            	  <select name="sorting" size="1" id="sorting" onChange="MM_jumpMenu('parent',this,0)">
            	    <option>Price Sorting</option>
            	    <option>Low to High</option>
            	    <option>High to Low</option>
                   </select>
                </form>
            </div>
        </div>
        
        <div class="rows">
        <?php
		$query_ads = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_category=".$_REQUEST['cat_id']."");
		while($row = mysqli_fetch_object($query_ads)) {
		?>
        	<a href="index.php?action=view&module=product_detail&ads_id=<?php echo $row->pic_ads_id; ?>">
        	<div class="list-view">
            	<div class="list-view-img">
                <?php
				$query_img = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_images where addpost_id='$row->pic_ads_id' order by ad_image_id ASC limit 1");
				$row_img = mysqli_fetch_object($query_img);
				
				?>
                <img src="media/small/<?php echo $row_img->ad_image_url; ?>"> 
                </div>
                <div class="list-view-cont">
                	<div class="list-title"><?php echo $row->pic_title; ?></div>
                    <p><?php echo $row->pic_discription; ?></p>
                    <b><?php echo $row->pic_post_city; ?></b>
                    
                    <div class="recent-time"><?php echo $row->pic_postdate; ?></div>
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
        
        <div class="space_20"></div>
        
        <div class="page-nav">
        	<ul>
            	<li><a href="#">4</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">2</a></li>
                <li><a class="active-1" href="#">1</a></li>
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
	  <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
  
  
      <div class="categories-left">
      


		
     <form id="filter_form" name="filter_form" method="post" action="index.php" class="form-horizontal" role="form" >
     <input type="hidden" name="module" value="products">
     <input type="hidden" name="action" value="view">
     <input type="hidden" name="filter" value="yes">
     <input type="hidden" name="cat_id" value="<?php echo $_REQUEST['cat_id']; ?>">

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

</script>

<?php
// main query
$price_filter_query=mysqli_query($this->mysqlConfig(),"select DISTINCT addpost_fields_title from pic_addpost_field where addpost_fields_categories_id = ".$_REQUEST['cat_id']."");
?>
<ul class="topnav">
<li>
<a style="background:#6a2800;color:#fff;" href="javascript:void(0);">Price</a>
</li>
<?php
$filter_list_ASC_query=mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_category = ".$_REQUEST['cat_id']." ORDER BY pic_price ASC limit 1");
			
			$filter_list_DESC_query=mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_category = ".$_REQUEST['cat_id']." ORDER BY pic_price DESC limit 1");
			
			$row_list_ASC = mysqli_fetch_object($filter_list_ASC_query);
			
		 
			
			$row_list_DESC = mysqli_fetch_object($filter_list_DESC_query);
			
			$row_list_DESC ->pic_price;
			
			$total = ($row_list_DESC->pic_price- $row_list_ASC->pic_price)/3;
			
			$total = $row_list_ASC+$total;
			
			
			$no = mysqli_num_rows($filter_list_ASC_query);
			
			
			 ?>
<ul>
<div style="overflow: auto; overflow-x: hidden; height:90px;" id="price" class="list-group">
<li>
  <div style="padding: 5px;" align="center">
  <input type="text" name="from_price" id="from_price" placeholder="Price From.." value="<?php if(isset($_POST['from_price'])){ echo $_POST['from_price']; } ?>" >
  <div/>
   <div style="padding: 5px;" align="center">- To - </div>
   <div style="padding: 5px;" align="center">
  <input type="text" name="to_price" id="to_price" placeholder="Price To.." value="<?php if(isset($_POST['to_price'])){ echo $_POST['to_price']; } ?>" onchange="filterPrice();">
  </div>
 
</li>
</div>
<div style="overflow: auto; overflow-x: hidden; height:90px;" id="price" class="list-group">

			 
			<li><a class="list-group-item" href="#"><input <?php if(isset($_POST['price']) and ($_POST['price']==$row_list_ASC->pic_price._.(round($total+$row_list_ASC->pic_price)))){ ?> checked <?php } else { } ?> id="price" name="price" value="<?php echo $row_list_ASC->pic_price; ?>_<?php echo round($total+$row_list_ASC->pic_price); ?>" type="radio" onchange="javascript:filterProducts();" style="float:left;"><div style="padding:5px; padding-left: 25px;">Rs. <?php echo $row_list_ASC->pic_price; ?> - <?php echo round($total+$row_list_ASC->pic_price); ?></div></a></li>
			
			<li><a class="list-group-item" href="#"><input <?php if(isset($_POST['price']) and ($_POST['price']==round(($total+$row_list_ASC->pic_price))._.round(($total+$total+$row_list_ASC->pic_price)))){ ?> checked <?php } else { } ?> id="price" name="price" value="<?php echo round($total+$row_list_ASC->pic_price); ?>_<?php echo round($total+$total+$row_list_ASC->pic_price); ?>" type="radio" onchange="javascript:filterProducts();" style="float:left;"><div style="padding:5px; padding-left: 25px;">Rs. <?php echo round($total+$row_list_ASC->pic_price); ?> - <?php echo round($total+$total+$row_list_ASC->pic_price); ?></div></a></li>
			
			<li><a class="list-group-item" href="#"><input <?php if(isset($_POST['price']) and ($_POST['price']==round(($total+$total+$row_list_ASC->pic_price))._.($row_list_DESC->pic_price))){ ?> checked <?php } else { } ?> id="price" name="price" value="<?php echo round($total+$total+$row_list_ASC->pic_price); ?>_<?php echo $row_list_DESC->pic_price; ?>" type="radio" onchange="javascript:filterProducts();" style="float:left;"><div style="padding:5px; padding-left: 25px;">Rs. <?php echo round($total+$total+$row_list_ASC->pic_price); ?> - <?php echo round($row_list_DESC->pic_price); ?></div></a></li>
</div>			
</ul>	
</ul>	

     	
    		<?php
			$filter_query=mysqli_query($this->mysqlConfig(),"select DISTINCT addpost_fields_title from pic_addpost_field where addpost_fields_categories_id = ".$_REQUEST['cat_id']."");
			$no=0;
			while($row = mysqli_fetch_object($filter_query)){
			
			
    		
    		
    		?>
    		
    		<ul class="topnav">	
	<li>
	
	<?php $nametitle = preg_replace('/\s+/', '', $row->addpost_fields_title); ?>
	<a style="background:#6a2800;color:#fff;" href="javascript:void(0);"><?php echo $row->addpost_fields_title; ?></a>
		<ul <?php if(isset($_POST[$nametitle])){ ?> style="display:block;" <?php } else { ?>style="display:none;" <?php } ?> >
			
			
			<?php
			 if($no<10){
			?>
			
			<input class="form-control" id="<?php echo $nametitle ; ?>input" type="search" placeholder="Search..."  style="width:100%; " />
			
			<div style="overflow: auto; overflow-x: hidden; height:90px;" id="<?php echo $nametitle ; ?>" class="list-group">
			
			 <?php
			}
			else{
			
		?>
		
		
		<?php
		}
		?>
		<?php
			 
			$filter_list_query=mysqli_query($this->mysqlConfig(),"select DISTINCT addpost_fields_value,addpost_fields_title from pic_addpost_field where addpost_fields_categories_id = ".$_REQUEST['cat_id']." and addpost_fields_title = '".$row->addpost_fields_title."' ");
			
			$no = mysqli_num_rows($filter_list_query);
			
			while($row_list = mysqli_fetch_object($filter_list_query)){
			$name = preg_replace('/\s+/', '', $row_list->addpost_fields_value);
			//echo $_POST[$name];
			 if($no<10){
			 ?>
			 
			<li><a class="list-group-item" href="#"><input <?php if(isset($_POST[$name]) and $_POST[$name]==$row_list->addpost_fields_value){ ?> checked <?php } else { } ?> id="<?php echo $row->addpost_fields_title;?>" name="<?php echo $name;?>" value="<?php echo $row_list->addpost_fields_value;?>" type="checkbox" onchange="javascript:filterProducts();" style="float:left;"><div style="padding:5px; padding-left: 25px;"><?php echo $row_list->addpost_fields_value;?></div></a></li>
			
			
			
             
			 <?php
			 }
			 else{
			 ?>
			 <a href="#"><input <?php if(isset($_POST[$name]) and $_POST[$name]==$row_list->addpost_fields_value){ ?> checked <?php } else { } ?> id="<?php echo $row->addpost_fields_title;?>" name="<?php echo $name;?>" value="<?php echo $row_list->addpost_fields_value;?>" type="checkbox" onchange="javascript:filterProducts();"><span><?php echo $row_list->addpost_fields_value;?></span></a>
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
<script src="/labs-common.js"></script>

<?php
}
?>



        </form>
        </div>
        
      
	  
      <?php
	  }
	  
	  public function filter(){
	  
	  ?>
	          <div class="rows">
	<div class="container">
    <div class="bor">
    	<?php
		$this->leftMenu();
		?>
		
	          <div class="categories-right">     
      
      <div class="filter">
      <div class="filter-list">
            	<ul>
      <?php
      $filtered_value_query = mysqli_query($this->mysqlConfig(),"select DISTINCT addpost_fields_value,addpost_fields_title from pic_addpost_field where addpost_fields_categories_id=".$_POST['cat_id']."");
      $str="WHERE ";
      
      $str.=addpost_fields_categories_id."=".$_POST['cat_id'];
      
      $i=1;
	  while($row = mysqli_fetch_object($filtered_value_query)){
     
     $addpost_fields_title = preg_replace('/\s+/', '', $row->addpost_fields_value);
     
      if(isset($_POST[$addpost_fields_title]) and $_POST[$addpost_fields_title]==$row->addpost_fields_value){ 
      
	  if($i==1){ $str.=" and"; } else { $str.="or "; }
	  $str.="(".addpost_fields_value."='".$row->addpost_fields_value."' and "; 
	  $str.=addpost_fields_title."='".$row->addpost_fields_title."') "; 
	  
      ?>
      <li><a href="#"><?php echo $row->addpost_fields_value; ?></a></li>
      <?php
      $i++;
	  }
      
      
	  }
      
      //echo $str;
      
      $filtered_criteria_query = mysqli_query($this->mysqlConfig(),"select DISTINCT addpost_uni_id from pic_addpost_field $str");
      //$ree = mysqli_fetch_array($filtered_criteria_query);
	  //echo $str;
      //print_r($ree);
      ?>
        	
                    
                    
                </ul>
            </div>
            
            <div class="space_10"></div>
            <div class="rows" align="right">
           	  <form name="sort_form" id="sort_form">
            	  <select name="sorting" size="1" id="sorting" onChange="MM_jumpMenu('parent',this,0)">
            	    <option>Price Sorting</option>
            	    <option>Low to High</option>
            	    <option>High to Low</option>
                   </select>
                </form>
            </div>
        </div>
        
        <div class="rows">
         <?php
		
		while($row =  mysqli_fetch_object($filtered_criteria_query)) {
		?>
        	
           <?php
           if(isset($_POST['from_price']) and isset($_POST['to_price']) and $_POST['to_price']!="" and $_POST['from_price']!="" and $_POST['to_price']!=0 and $_POST['from_price']!=0){
      
      $str_price="pic_price BETWEEN ".$_POST['from_price']." AND ".$_POST['to_price']."";
      
      }
          // $query_ads_fields = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_fields_categories_id=".$_REQUEST['cat_id']." and addpost_fields_title='' and addpost_fields_value=''");
		   $query_ads = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_category=".$_REQUEST['cat_id']." and pic_ads_id='".$row->addpost_uni_id."' and ".$str_price."");
		   $row_ads = mysqli_fetch_object($query_ads);
		   
		   $no_product = mysqli_num_rows($query_ads );
		   
		   if($no_product==1){
		   ?>
		   
           
           <a href="index.php?action=view&module=product_detail&ads_id=<?php echo $row->addpost_uni_id; ?>">
           
           <div class="list-view">
            	<div class="list-view-img">
                <?php
				$query_img = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_images where addpost_id='$row->addpost_uni_id' order by ad_image_id ASC limit 1");
				$row_img = mysqli_fetch_object($query_img);
				
				?>
                <img src="media/small/<?php echo $row_img->ad_image_url; ?>"> 
                </div>
                <div class="list-view-cont">
                	<div class="list-title"><?php echo $row_ads->pic_title; ?></div>
                    <p><?php echo $row_ads->pic_discription; ?></p>
                    <b><?php echo $row_ads->pic_post_city; ?></b>
                    
                    <div class="recent-time"><?php echo $row_ads->pic_postdate; ?></div>
                </div>
                <div class="list-view-amt">
                	<b><i><img src="css/images/inr_symbol.png" /></i><?php echo $row_ads->pic_price; ?></b>
                </div>
            </div>
            
        	
            </a>
            <?php } ?>
            
            <?php
			}
			?>
            

            
            
        </div>
        
        <div class="space_20"></div>
        
        <div class="page-nav">
        	<ul>
            	<li><a href="#">4</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">2</a></li>
                <li><a class="active-1" href="#">1</a></li>
            </ul>
        </div>       
            
        </div>
         </div>
          </div>
           </div>
	  
	  <?php
	  
	  }

}
?>