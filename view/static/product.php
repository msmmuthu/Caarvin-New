<?php
	$servername = "localhost";
		$username = "devavv";
		$password = "vvinWIN@2019";
		$dbname = "abocarz";

$conn = mysqli_connect($servername, $username, $password, $dbname);
?>


	<div class="container">
    
    
        <div class="row mt-4">
        
        <?php
		$i = 1;
		$cat_query = mysqli_query($conn,"select * from pic_categories where categories_parent=0 and categories_status=1 and categories_homepage=1 order by category_order ASC");
		while($row = mysqli_fetch_array($cat_query)){
		if($i!=1){
		
		$class = "m-left";
		
		}
		else{
		
		$class = "";
		
		}
		?>
        	<div class="col-4 col-sm-3 col-md-3 col-lg-3 pb-3 pt-3 mb-3 mt-3 box text-center cat_thum">
            	<div class="bg-light " style="border: 1px solid #d5d6d8;">
                <a href="index.php?action=view&module=products&cat_id=<?php echo $row['categories_id']; ?>&type=0&p=1&sort=0&offset=0">
            	
					<?php
                    if($row['cat_fa']!=""){
                    ?>
                    <i class="fa fa-2x <?php echo $row['cat_fa']; ?>"></i>
                    <?php } else { ?>
                    <img class="p-1" width="75" height="75" src="admincp/media/<?php echo $row['categories_image']; ?>" />
                    <?php } ?>
                    
                
                </a>
                </div>
                <div class="bg-secondary text-black" style="text-transform:lowercase;background-color:#CCCCCC !important"><?php echo $row['categories_name']; ?></div>
            </div>
         <?php
		
		$i=$i+1;
		}
		
		 ?>  
       
        </div>
        </div>
        
       
      
  

