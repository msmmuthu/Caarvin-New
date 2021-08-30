<?php

class owner extends config{

    public function headerscript(){
	?>
                 
            <div class="modal fade bd-example-modal-lg" id="liked" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Like Ads</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            
            <div class="modal-body">
             <div class="row d-flex justify-content-center"><i class="fa fa-check-circle fa-4x"></i></div>
            <div class="row d-flex justify-content-center p-4 text-center">
            <h5>You Requested Already!<br />Thank you for Contacting us!.</h5>
           </div>
            <div class="row d-flex justify-content-center pb-4">
            <form name="like_save_form" method="post" action="index.php" >
            <input type="hidden" name="ads_id" id="ads_ids" >
            <input type="hidden" name="action" value="view" >
            <input type="hidden" name="module" value="product_detail" >
            <button style="border:1px dashed #ccc;" class="btn btn-light btn-lg" type="submit" name="viewads">View Ads</button>
            </form>
            </div>
            <div class="row d-flex justify-content-center">
            <h6 class="text-muted">We will Call you soon.</h6>
            </div>
            
            </div>
           
            </div>
            </div>
            </div>
    <div class="modal fade bd-example-modal-lg" id="like" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Like Ads</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body" id="dynamicformlike">

      

    </div>

  </div>

</div>

</div>

<script>
        $('.like').click(function(){
        
        var ads_id=$(this).attr('ads_id');
        var ads_uid=$(this).attr('ads_uid');
        var user_name=$(this).attr('user_name');
        var user_mob=$(this).attr('user_mob');
        var user_email=$(this).attr('user_email');
        var moduleview=$(this).attr('module');
       
        
        
        $.ajax({url:"index.php?module=misc&action=helper&post=likeForm&ads_id="+ads_id+"&ads_uid="+ads_uid+"&user_name="+user_name+"&user_mob="+user_mob+"&user_email="+user_email+"&moduleview="+moduleview,cache:false,success:function(result){
        $("#dynamicformlike").html(result);
        }});
        });
        </script>
      <script>
        $('.liked').click(function(){
        
        var ads_id=$(this).attr('ads_id');
        var ads_uid=$(this).attr('ads_uid');
        var user_name=$(this).attr('user_name');
        var user_mob=$(this).attr('user_mob');
        var user_email=$(this).attr('user_email');
        var moduleview=$(this).attr('module');
		
		$('#ads_ids').val(ads_id);
		
       
        });
        </script>
    

<!--<script>
	function search_filter(e) {
 
    var value = $("#myInput_"+e).val().toLowerCase();
    $("#value_"+e+" li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
 
}
	  </script>-->
      
      
        
        <?php
		if(isset($_REQUEST['cat_id']) and $_REQUEST['cat_id']!=""){
				$filter_str.= " and pic_category=".$_REQUEST['cat_id']."";
				$cat_id=$_REQUEST['cat_id'];
			}
			else{
				$cat_id="";
			}
			
			if(isset($_REQUEST['location']) and $_REQUEST['location']!=""){
				$filter_str.= " and pic_post_city='".$_REQUEST['location']."'";
				$location=$_REQUEST['location'];
			}
			else{
				$location="";
			}
			
			if(isset($_REQUEST['nearer']) and $_REQUEST['nearer']!=""){
				$filter_str.= " and pic_add_taluk='".$_REQUEST['nearer']."'";
				$nearer=$_REQUEST['nearer'];
			}
			else{
				$nearer="";
			}
		?>
        <script>
		function loadmore_mobile_layout(){
		loadmore_search(<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['type']; ?>,"<?php echo $_REQUEST['owner_id']; ?>",<?php echo $_REQUEST['sort']; ?>);
		}
		
		
		function loadmore_search(page,type,cat_id,sort){
		
		
		pages = page+1;
		
		offsets = page*5;
		offsets = offsets+1;
		
		
		postdata = {
			'sort' : sort,
			'search_pic' : cat_id,
			'type' : type,
			'p' : pages,
			'offset' : offsets,
			'action' : "view",
			'module' : "search",
			'post' : "form",
			'post2' : "loadmoresearch",
								
			}
			
		var string_id = "#loadmore_rows"+pages;
		
		//alert(string_id);
			
		$.post("index.php",postdata,function(data){
			$(string_id).html(data);														  
		});
	
}

    </script>
	<?php
	}
	
	public function index() { ?>
    
    
   <div class="col-sm-12 col-md-12 col-lg-12">
   
   
   <?php
    
    $query_search = $_POST['query_search'];
    $query_search = mysqli_real_escape_string($this->mysqlConfig(),$query_search);
    
    $search_query = mysqli_query($this->mysqlConfig(),"SELECT pic_category FROM pic_addpost LEFT JOIN (pic_addpost_images, pic_categories) ON ( pic_addpost_images.addpost_id = pic_addpost.pic_ads_id
AND pic_categories.categories_id = pic_addpost.pic_category )  WHERE  (addpost_status=1) and (`pic_title` LIKE  '%$query_search%' or `pic_tag` LIKE  '%$query_search%' or `pic_ads_id` LIKE  '%$query_search%' or `pic_admin_tag` LIKE  '%$query_search%' or `ad_image_desc` LIKE  '%$query_search%') group by pic_category limit 10");
    
    while($row = mysqli_fetch_array($search_query)){
    
   ?>
  
   
   <a  href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/index.php?action=view&module=products&string=<?php echo $query_search; ?>&cat_id=<?php echo $row['pic_category']; ?>&type=0&p=1&sort=0&offset=0">
   <div class="search_hover suggestion_search">
   <?php
    
    
    $cat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_categories WHERE  `categories_id` = ".$row['pic_category']." limit 1"); 
    
    $cat_row = mysqli_fetch_array($cat_query);
    ?>
     <?php
    echo $cat_row['categories_name'];
    ?>
    </div>
    </a>
  
    
    <?php
    
    }
	
	?>
    </div>
    <?php
       
    }
	
	 public function loopAds($adid,$adsuserid,$pic_title,$pic_discription,$pic_add_taluk,$pic_post_city,$pic_postdate,$pic_price){
	   
			$userid = $_SESSION['pic']['biscuit']['userid'];
			$queryuser = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_user` where user_id = $userid limit 1");
			$rowuser = mysqli_fetch_object($queryuser);
		
            
            $like_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_likes` where likes_product_id='$adid' and likes_cus_id=".$_SESSION['pic']['biscuit']['userid']."");
            $like_no = mysqli_num_rows($like_query);
			
			if($like_no==0){
			$modal = "like";
			}
			else{
			$modal = "liked";
			}
			
			if($_REQUEST['type']==0){
			$module = "product_detail";
			}
			else{
			$module = "request_detail";
			}
            
			?>
            <a href="#<?php echo $modal; ?>" data-toggle="modal"  ads_id="<?php echo $adid; ?>" ads_uid="<?php echo $adsuserid; ?>" user_name="<?php echo $rowuser->user_username; ?>" user_mob="<?php echo $rowuser->user_mobile; ?>" user_email="<?php echo $rowuser->user_email; ?>" module="<?php echo $module; ?>"  class="<?php echo $modal; ?> btn btn-white btn-block">
            <div class="card mb-3">
  <div class="row no-gutters">
    <div class="col-md-4">
      
<?php
$query_img = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_images where addpost_id='$adid' order by ad_image_id ASC limit 1");
$row_img = mysqli_fetch_object($query_img);
$row_nm = mysqli_num_rows($query_img);
if($row_nm==1){
?>
<img class="card-img" style="display:none" src="media/small/<?php echo $row_img->ad_image_url; ?>"> 
<?php } else { ?>
<img class="card-img" src="css/images/no_images.jpg" style="display:none"> 
<?php } ?>

    </div>
    <div class="col-md-8">
      <div class="card-body text-left">
        <h4 class="card-title text-primary"><strong><?php echo $pic_title; ?></strong> <?php if($modal=="liked"){ ?>
       <i class="text-success fa fa-check-circle"></i>
        <?php } ?></h4>
        <h5 class="text-dark"><strong><i class="fa fa-rupee-sign"></i> <?php echo $pic_price; ?></strong></h5>
        <div class="card-text text-justify"><?php echo $pic_discription; ?></div>
        <p class="hint"><i class="fa fa-map-marker"></i> <?php echo $pic_add_taluk." , ".$pic_post_city ; ?></p>
        <p class="card-text">
            <small class="text-muted">
                <strong>Posted on :</strong>
                <i class="fa fa-clock"></i>
                <?php 
                $date = date_create($pic_postdate);
                echo date_format($date, 'd/m/Y'); 
                ?>
            </small>
        </p>
        <p class="card-text">
		<small class="text-muted">

<i class="text-muted">Ad Id :</i>
<?php
echo $adid;
?>
</small>

        </p>

      </div>
    </div>
  </div>
</div>

                
                </a>
                <?php
                
	  
	  }
     public function category_name($id){
	 	$query_cat_name=mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id=$id limit 1");
		$no = mysqli_num_rows($query_cat_name);
		if(!empty($no)){
		$cat_name=mysqli_fetch_object($query_cat_name);
		$name = $cat_name->categories_name;
		return $name;
		}
		else{
		return "";
		}
		
	 }
     public function list_products() {
	 $this->headerscript();
	 ?>
        
     
    
     <?php
            $usr=$_SESSION['pic']['biscuit']['userid'];
            $user_types=mysqli_query($this->mysqlConfig(),"select * from pic_user where user_id='$usr' ");
            $row = mysqli_fetch_object($user_types);
            $utype = $row->user_type;
            
            $user_types_query=mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_user_type` where user_type='$utype'"); 
            $row_user_types = mysqli_fetch_object($user_types_query);
            $uType = $row_user_types->setoption;
        ?>
        <?php
			if(strpos($uType, 'view') !== false){
		?>
        
        
	 <div class="container" >
            
            <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 pb-0">
    	
		<?php
		$this->leftMenu();
		?>
         </div>
            
            <div class="col-sm-12 col-md-12 col-lg-8 pb-0">
	
         
            <div id="loading_filter" style="display:none;">
           
            <h4>loading..</h4>
            <img src="css/images/circel.gif" /></div>
        
      <div class="row pb-4">
             <?php echo $this->sorting(); ?>
            </div>
            
         <script>
        function MM_jumpMenu(targ,selObj,restore){ //v3.0
	
	  eval(targ+".location='"+"?module=owner&action=view&p=1&post=form&owner_id=<?php echo $_REQUEST['owner_id']; ?>&offset=0&type="+$("#adstype").val()+"&sort="+$("#sorting").val()+"'");
	  if (restore) selObj.selectedIndex=0;
	}
	
	</script>
    	<script>
        function MM_jumpMenu2(targ,selObj,restore){ //v3.0
	
	  eval(targ+".location='"+"?module=owner&action=view&p=1&post=form&owner_id=<?php echo $_REQUEST['owner_id']; ?>&offset=0&type="+$("#adstype").val()+"&sort="+$("#sorting").val()+"'");
	  if (restore) selObj.selectedIndex=0;
	}
	</script>
        <div class="row" id="ads_div">
        <?php
		 $query_search = $_REQUEST['owner_id'];
		 
			if(isset($_REQUEST['sort']) and $_REQUEST['sort']==1){
				$order = "pic_price ASC";
			}
			elseif(isset($_REQUEST['sort']) and $_REQUEST['sort']==2){
				$order = "pic_price DESC";
			}
			else{
				$order = "pic_add_lon DESC";
			}
		 $dates = date("Y-m-d");
		$query_ads = mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_addpost WHERE  addpost_status = 1 and pic_request=".$_REQUEST['type']." and (pic_user_id = ".$query_search.")  order by $order LIMIT 5 OFFSET ".$_REQUEST['offset']."");
		
		$count_rows = mysqli_num_rows($query_ads);
		
		while($row = mysqli_fetch_object($query_ads)) {
		
		
			$this->loopAds($row->pic_ads_id,$row->pic_user_id,$row->pic_title,$row->pic_discription,$row->pic_add_taluk,$row->pic_post_city,$row->pic_postdate,$row->pic_price);
			
		
			}
			?>
        </div>
         <?php 
			
			if($count_rows>4){ ?>
            <div class="row" id="loadmore_rows<?php echo $_REQUEST['p']+1; ?>"></div>
            <div class="d-flex justify-content-center row"><a class="btn btn-primary btn-lg loadmore-products" href="javascript:void(0)" onclick="javascript:loadmore_mobile_layout();">Load More Ads</a></div>
            <?php } ?>
            
    
			
    
   
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
	 
	  public function list_products_loadmore() {
              $this->headerscript();
	 ?>
        
    
     <?php
            $usr=$_SESSION['pic']['biscuit']['userid'];
            $user_types=mysqli_query($this->mysqlConfig(),"select * from pic_user where user_id='$usr' ");
            $row = mysqli_fetch_object($user_types);
            $utype = $row->user_type;
            
            $user_types_query=mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_user_type` where user_type='$utype'"); 
            $row_user_types = mysqli_fetch_object($user_types_query);
            $uType = $row_user_types->setoption;
        ?>
        <?php
			if(strpos($uType, 'view') !== false){
		
		 $query_search = $_REQUEST['owner_id'];
		 
			if(isset($_REQUEST['sort']) and $_REQUEST['sort']==1){
				$order = "pic_price ASC";
			}
			elseif(isset($_REQUEST['sort']) and $_REQUEST['sort']==2){
				$order = "pic_price DESC";
			}
			else{
				$order = "pic_add_lon DESC";
			}
			
		$query_ads = mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_addpost WHERE  addpost_status = 1 and  pic_request=".$_REQUEST['type']." and (pic_user_id = ".$query_search.") order by $order LIMIT 5 OFFSET ".$_REQUEST['offset']."");
		$count_rows = mysqli_num_rows($query_ads);
		
		while($row = mysqli_fetch_object($query_ads)) {
			
		$this->loopAds($row->pic_ads_id,$row->pic_user_id,$row->pic_title,$row->pic_discription,$row->pic_add_taluk,$row->pic_post_city,$row->pic_postdate,$row->pic_price);
		
			}
			
        if($count_rows>4){ ?>
            </div>
            <div class="row" id="loadmore_rows<?php echo $_REQUEST['p']+1; ?>">
            <div class="d-flex justify-content-center row p-3"><a class="btn btn-primary btn-lg loadmore-products" href="javascript:void(0)" onclick="javascript:loadmore_mobile_layout();">Load More Ads</a></div>
            <?php } ?>
            
        
  



 <?php } else { ?>
        
         <div class="rows">
	<div class="container">
        
        <div class="bor" style="text-align:center">
        
        <h3>You are not allowed to view ads!</h3>
        
        </div>
        </div>
        </div>
        
        
         <?php }?>
         
         
	 <?php
	 }
	 
	 
	 
	  public function leftMenu() {
	  
	  ?>
	  <div id="loading_filter" style="display:none;">
        <h2>Picads</h2>
        <h4>loading..</h4>
        <img src="css/images/circel.gif" /></div>
      <?php
	  
            if($_REQUEST['p']==1){
			?>
            
                
                <div class="row pb-4">
             <?php //echo $this->sorting(); ?>
            </div>
               
               
           
            <?php
			}
			
			$query_search = $_REQUEST['owner_id'];
			 
			if(isset($_REQUEST['sort']) and $_REQUEST['sort']==1){
				$order = "pic_price ASC";
			}
			elseif(isset($_REQUEST['sort']) and $_REQUEST['sort']==2){
				$order = "pic_price DESC";
			}
			else{
				$order = "pic_add_lon DESC";
			}
			
			$filter_str = "";
			if(isset($_REQUEST['cat_id']) and $_REQUEST['cat_id']!=""){
				$filter_str.= " and pic_category=".$_REQUEST['cat_id']."";
				$cat_id=$_REQUEST['cat_id'];
			}
			else{
				$cat_id="";
			}
			
			if(isset($_REQUEST['location']) and $_REQUEST['location']!=""){
				$filter_str.= " and pic_post_city='".$_REQUEST['location']."'";
				$location=$_REQUEST['location'];
			}
			else{
				$location="";
			}
			
			if(isset($_REQUEST['nearer']) and $_REQUEST['nearer']!=""){
				$filter_str.= " and pic_add_taluk='".$_REQUEST['nearer']."'";
				$nearer=$_REQUEST['nearer'];
			}
			else{
				$nearer="";
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
        
          eval(targ+".location='"+"?module=products&action=view&p=1&offset=0&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type="+$("#adstype").val()+"&sort="+$("#sorting").val()+"'");
          if (restore) selObj.selectedIndex=0;
        }
        </script>
  
  
      <div id="sidebar">

		<div id="accordion">
    
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" href="#">
                  Category
                </a>
              </h5>
            </div>
           <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
      		<div class="card-body">
            <?php
            $dates = date("Y-m-d");
			$filter_query=mysqli_query($this->mysqlConfig(),"select DISTINCT pic_category from pic_addpost where addpost_status = 1 and (pic_validity > $dates or pic_validity_auto=1) and pic_request=".$_REQUEST['type'].$filter_str." and (pic_user_id = ".$query_search.") order by $order");
			
			$no = mysqli_num_rows($filter_query);
			$nametitle = "Category";
			?>
            <?php
			if(($no>5) || ($no==0)){
			?>
			<input onkeyup="search_filter('<?php echo $nametitle ; ?>');" class="form-control" id="myInput_<?php echo $nametitle ; ?>" type="text" placeholder="Search..">
			<div id="value_<?php echo $nametitle; ?>" class="box-filter">
			<?php
			}
			else{ echo '<div class="box-filter-nonscroll">';}
			
			?>
            <ul class="list-group">
            <?php
			 while($row = mysqli_fetch_object($filter_query)){
			
			$name = $this->category_name($row->pic_category);
			$cat_id_selected = $row->pic_category;
			if(!empty($name)){
			
			
			
			 ?>
			 <li class="list-group-item">
            <input <?php if(isset($_POST['cat_id']) and $_POST['cat_id']==$cat_id_selected){ ?> checked <?php } else { } ?> id="category" name="category" value="<?php echo $cat_id_selected;?>" type="radio" onchange="javascript:filterProducts_owner(this,'<?php echo $cat_id_selected;?>',<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>,'<?php echo $query_search; ?>','<?php if(isset($_POST['location']) and $_POST['location']!="") { echo $_POST['location']; } else { ?><?php } ?>','<?php if(isset($_POST['nearer']) and $_POST['nearer']!="") { echo $_POST['nearer']; } else { ?><?php } ?>');" class="form-check-input filter_checkbox m-1">
            <div class="mylabel ml-4"><?php echo $name;?></div>
            </li>
			
			
			
             
			 <?php
			}
			
			 }
			 ?>
             </ul>
             
            
			 </div>
             
            </div>
           </div>
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" href="#">
                  City
                </a>
              </h5>
            </div>
           <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
      		<div class="card-body">
            <?php
			$filter_query=mysqli_query($this->mysqlConfig(),"select DISTINCT pic_post_city from pic_addpost where addpost_status = 1 and (pic_validity > $dates or pic_validity_auto=1) and pic_request=".$_REQUEST['type'].$filter_str." and (pic_user_id = ".$query_search.") order by $order");
			
			$no = mysqli_num_rows($filter_query);
			$nametitle = "City";
			?>
            <?php
			if(($no>5) || ($no==0)){
			?>
			<input onkeyup="search_filter('<?php echo $nametitle ; ?>');" class="form-control" id="myInput_<?php echo $nametitle ; ?>" type="text" placeholder="Search..">
			<div id="value_<?php echo $nametitle; ?>" class="box-filter">
			<?php
			}
			else{ echo '<div class="box-filter-nonscroll">';}
			
			?>
            <ul class="list-group">
            <?php
			 while($row = mysqli_fetch_object($filter_query)){
			
			$name = $row->pic_post_city;
			if(!empty($name)){
			
			
			
			 ?>
			 <li class="list-group-item">
            <input <?php if(isset($_POST['location']) and $_POST['location']==$name){ ?> checked <?php } else { } ?> id="location" name="location" value="<?php echo $name;?>" type="radio" onchange="javascript:filterProducts_owner(this,'<?php if(isset($_POST['cat_id']) and $_POST['cat_id']!="") { echo $_POST['cat_id']; } else { ?><?php } ?>',<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>,'<?php echo $query_search; ?>','<?php echo $name;?>','<?php if(isset($_POST['nearer']) and $_POST['nearer']!="") { echo $_POST['nearer']; } else { ?><?php } ?>');" class="form-check-input filter_checkbox m-1">
            <div class="mylabel ml-4"><?php echo $name;?></div>
            </li>
			
			
			
             
			 <?php
			}
			
			 }
			 ?>
             </ul>
             
            
			 </div>
             
            </div>
           </div>
           <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" href="#">
                  Located Nearer by you
                </a>
              </h5>
            </div>
           <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion">
      		<div class="card-body">
            <?php
			$filter_query=mysqli_query($this->mysqlConfig(),"select DISTINCT pic_add_taluk from pic_addpost where addpost_status = 1 and (pic_validity > $dates or pic_validity_auto=1) and pic_request=".$_REQUEST['type'].$filter_str." and (pic_user_id = ".$query_search.") order by $order");
			
			$no = mysqli_num_rows($filter_query);
			$nametitle = "LocatedNearerbyyou";
			?>
            <?php
			if(($no>5) || ($no==0)){
			?>
			<input onkeyup="search_filter('<?php echo $nametitle ; ?>');" class="form-control" id="myInput_<?php echo $nametitle ; ?>" type="text" placeholder="Search..">
			<div id="value_<?php echo $nametitle; ?>" class="box-filter">
			<?php
			}
			else{ echo '<div class="box-filter-nonscroll">';}
			
			?>
            <ul class="list-group">
            <?php
			 while($row = mysqli_fetch_object($filter_query)){
			
			$name = $row->pic_add_taluk;
			if(!empty($name)){
			
			
			
			 ?>
			 <li class="list-group-item">
            <input <?php if(isset($_POST['nearer']) and $_POST['nearer']==$name){ ?> checked <?php } else { } ?> id="nearer" name="nearer" value="<?php echo $name;?>" type="radio" onchange="javascript:filterProducts_owner(this,'<?php if(isset($_POST['cat_id']) and $_POST['cat_id']!="") { echo $_POST['cat_id']; } else { ?><?php } ?>',<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>,'<?php echo $query_search; ?>','<?php if(isset($_POST['location']) and $_POST['location']!="") { echo $_POST['location']; } else {?><?php } ?>','<?php echo $name; ?>');" class="form-check-input filter_checkbox m-1">
            <div class="mylabel ml-4"><?php echo $name;?></div>
            </li>
			
			
			
             
			 <?php
			}
			
			 }
			 ?>
             </ul>
             
            
			 </div>
             
            </div>
           </div>
      </div>
      
      </div>
      </div>
			
    
      
        
      
	  
      <?php
	  }
	  
	  public function filter(){
	   $this->headerscript();
	 ?>
        	
	
         
            
        
      
        <?php
		
		 $query_search = $_POST['search_pic'];
		 if(isset($_POST['location']) and $_POST['location']!=""){
		 
		 $str_location = " and pic_post_city='".$_POST['location']."'";
		 
		 }
		 else{
		 
		 $str_location = "";
		 
		 }
		 
		 if(isset($_POST['nearer']) and $_POST['nearer']!=""){
		 
		 $str_nearer = " and pic_add_taluk='".$_POST['nearer']."'";
		 
		 }
		 else{
		 
		 $str_nearer = "";
		 
		 }
		 
		  if(isset($_POST['cat_id']) and $_POST['cat_id']!=""){
		 
		 $str_cate = " and pic_category='".$_POST['cat_id']."'";
		 
		 }
		 else{
		 
		 $str_cate = "";
		 
		 }
		
		if(isset($_REQUEST['sort']) and $_REQUEST['sort']==1){
				$order = "pic_price ASC";
			}
			elseif(isset($_REQUEST['sort']) and $_REQUEST['sort']==2){
				$order = "pic_price DESC";
			}
			else{
				$order = "pic_add_lon DESC";
			}
		
		
		
		$query_ads = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where addpost_status = 1 and (pic_user_id = ".$query_search.") ".$str_location."".$str_nearer."".$str_cate."  order by $order LIMIT 5 OFFSET ".$_REQUEST['offset']."");
		$count_rows = mysqli_num_rows($query_ads);
		
		while($row = mysqli_fetch_object($query_ads)) {
			
			$this->loopAds($row->pic_ads_id,$row->pic_user_id,$row->pic_title,$row->pic_discription,$row->pic_add_taluk,$row->pic_post_city,$row->pic_postdate,$row->pic_price);
		
			}
			
          

	 
	 }
	 
	 public function user(){
	 
	$userid = $_SESSION['pic']['biscuit']['userid'];
	$queryuser = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_user` where user_id = $userid limit 1");
	$rowuser = mysqli_fetch_object($queryuser);
	return $rowuser;

	 }
	 
	  public function sorting(){
	  $misc2 = new misc2();
          $owner_id = $_REQUEST['owner_id'];
	  ?>
      
	 <script>
        function MM_jumpMenu(targ,selObj,restore){ //v3.0
	
	  eval(targ+".location='"+"?module=products&action=view&p=1&offset=0&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type="+$("#adstype").val()+"&sort="+$("#sorting").val()+"'");
	  if (restore) selObj.selectedIndex=0;
	}
	
	</script>
    	<script>
        function MM_jumpMenu2(targ,selObj,restore){ //v3.0
	
	  eval(targ+".location='"+"?module=products&action=view&p=1&offset=0&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type="+$("#adstype").val()+"&sort="+$("#sorting").val()+"'");
	  if (restore) selObj.selectedIndex=0;
	}
	</script>
    
            
             
             <div class="col-sm-12 col-md-12 col-lg-12">
             <h6 class="hint">
                 Showing <span class="text-primary"><?php echo $misc2->get_value('pic_user', 'user_id', $owner_id, 'user_id_unique') ?></span> Ads
             </h6>
            </div>
            
             
             <div class="col-sm-12 col-md-12 col-lg-3 d-flex flex-row">
           	  <form name="sort_form2" id="sort_form2">
              <label style="display:none">
            	  <select class="select_adstype" name="adstype" size="1" id="adstype" onChange="MM_jumpMenu2('parent',this,0)">
            	    <option <?php if($_REQUEST['type']==0){ ?> selected="selected" <?php } ?> value="0">Posted Ads</option>
            	    <option <?php if($_REQUEST['type']==1){ ?> selected="selected" <?php } ?> value="1">Requested Ads</option>
                   </select>
               </label>
                </form>
            </div>
            <div class="col-sm-9 col-md-9 col-lg-6">
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 d-flex flex-row-reverse">
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

}
?>