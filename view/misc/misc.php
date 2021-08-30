<?php
class misc{

	public function subcategory(){ ?>
	
	<div id="loading-image" style="display:none;width: 100%;margin: 0 auto;text-align: center;">
	<img src="css/images/loading.gif">
	</div>
	
	<div style="width: 95%;float: left;background: #cccccc;border-radius: 10px;padding: 0px 10px;margin-left: 5%;">
	<div style="float:left;width:95%;">
	<!--<h3 style="border-bottom: 1px solid #e2e2e2;padding-bottom: 10px;text-transform: uppercase;color: #444">Click to Show Categories</h3>-->
	 <?php
	 $id = $_POST['id'];
        $cat_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_parent=0 and categories_status=1 and categories_sub='$id' order by categories_name ASC");
	while($row = mysqli_fetch_array($cat_query)){
	?>
	<div class="sub_cat_li">
	<a onclick="subcate(<?php echo $row['categories_id']; ?>);" href="index.php?action=view&module=products&cat_id=<?php echo $row['categories_id']; ?>&type=0&p=1&sort=0&offset=0">
	<div style="float:left;margin-right: 10px;"><img width="35" height="35" src="admincp/media/<?php echo $row['categories_image']; ?>" /></div> &nbsp;&nbsp;<div><?php echo $row['categories_name']; ?></div>
	</a>
	</div>
	
	<?php
	}
		
        ?>
        
	</div>
	<!--<div style="float:right;width:25%;text-align: right;padding-top: 20px;">
	<a href="">View All</a>
	</div>-->
	</div>
	
	<?php
	}
	
	public function subcatid($a){
		$thePostIdArray = explode('|', $a);
		$result = count($thePostIdArray);
		$cat_char="(";
		for($i=0;$i<=$result;$i++){
			$query_subcat = mysqli_query($this->mysqlConfig(),"SELECT * FROM  `pic_categories` where categories_sub = ".$thePostIdArray[$i]."");
			
			while($row_subcat = mysqli_fetch_object($query_subcat)){
			
				$cat_char.=$row_subcat->categories_id.",";
			
			}
		
		}
		$cat_char = trim($cat_char, ",");
		
		$cat_char.=")";
		
		
		return $cat_char;
	}
	
	

}
?>