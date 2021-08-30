<?php
class category extends config{

public function listing(){
	?>
	<div class="container">
		
		
		
		<div class="row" >
        
                    <div class="col-12 pt-4" >
                        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <a class="navbar-brand" href="#">Category</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="cat_export.php">Export Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cat_field_export.php">Export Category Fields</a>
      </li>
      
    </ul>
  </div>
</nav>
   
   
	<table id="myTable" class="table table-striped table-bordered">
  <thead>
  <tr>
   
    <th width="20%"><strong>CATEGORY</strong></td>
    <th width="30%"><strong>DESCRIPTION</strong></td>
    <th width="10%" align="center"><strong>Sub Category</strong></td>
    <th width="30%" align="center"><strong>Action</strong></td>
    <th width="30%" align="center"><strong>Action</strong></td>
    <th width="30%" align="center"><strong>Action</strong></td>
    </tr>
    </thead>
    <tbody>
  <?php
   //$subcat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories` where `categories_status`= 1 and `categories_parent`=0 and categories_sub=".$categories_id."");
 if($_REQUEST['post']=="sub"){
 
 $catsubid = $_REQUEST['catid'];
 
 $str = "and categories_sub!=0 and categories_sub=".$catsubid."";
 //echo $str;
 }
 else{
 
  $str = "and `categories_parent`=1"; 
 
 }

  
  $cat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories` where `categories_status`= 1 ".$str." ORDER BY `categories_name` DESC");
  
  while($row = mysqli_fetch_array($cat_query)){
  $id_agent = $row['categories_status'];
  $categories_id = $row['categories_id'];
  
  $subcat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories` where `categories_status`= 1 and categories_sub = $categories_id");
  $subcat_count = mysqli_num_rows($subcat_query);
  
  ?>
  <tr>
    <td><?php echo $row['categories_name']; ?></td>
    <td><?php echo $row['categories_desc']; ?></td>
    <td width="15%" align="center"><div class="link_href"><a href="index.php?action=view&module=category&catid=<?php echo $row['categories_id']; ?>&post=sub"><strong><?php echo $subcat_count; ?></strong> </a></div></td>
    <td width="8%" align="center"><div class="link_href"><a href="index.php?action=view&module=fields&catid=<?php echo $row['categories_id']; ?>&post=edit">Edit</a></div></td>
    <td width="8%" align="center"><?php if($row['categories_hidden']==1){ ?> <div class="link_href"><a href="index.php?action=model&module=category&id=0&post=hidden&catid=<?php echo $row['categories_id']; ?>">Hide</a></div>  <?php } else { ?> <div class="link_href"><a href="index.php?action=model&module=category&id=1&post=hidden&catid=<?php echo $row['categories_id']; ?>">Show</a></div><?php } ?></td>
    <td width="8%" align="center"><?php if($row['categories_status']==1){ ?> <div class="link_href"><a href="index.php?action=model&module=category&catid=<?php echo $row['categories_id']; ?>&post=delete">Delete</a></div>  <?php } ?></td>
  </tr>
  
  <?php
  
 
}
  ?>
  </tbody>
</table>

</div>
</div>
</div>

<?php
	}

	public function form(){
	?>
	
    <div class="container">
		
		
		
		<div class="row" >
        
                    <div class="col-6 pt-2">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="cat_form" id="cat_form" method="post" >
         <input type="hidden" name="action" value="model" />
             <input type="hidden" name="module" value="category" />
            
		  <table width="100%" border="0">
            <tr>
              <td height="38">Category Name</td>
              <td colspan="3">
                <input type="text" name="cat_name" id="cat_name" class="form-control" />              </td>
            </tr>
            <tr>
              <td height="34"> Description</td>
              <td colspan="3"><input type="text" name="cat_desc" id="cat_desc" class="form-control" /></td>
            </tr>
            
            <tr>
              <td height="34">Root Category</td>
              <td colspan="3">
                <label>
                  <input type="radio" name="cat_root" value="1" id="cat_root_0"  onchange="cat_sub();" />
                  Parent</label>
               
                <label>
                  <input type="radio" name="cat_root" value="0" id="cat_root_1" onchange="cat_sub();" />
                  Sub</label>              </td>
            </tr>
            <tr >
            <td >Choose Sub Category</td>
              <td id="sub_cat_div" colspan="3" >              </td>
           </tr>
           
            
            




            
           
            
          </table>
             </br>
          <input type="submit" name="save_cat" id="save_cat" value="Submit" class="btn btn-primary" />
         
         </form>
          </div>
  </div>
		
</div>
	<?php
    }
	
	public function select(){
	?>
    
	 
             <select name="sub_category" id="sub_category" class="form-control"  size="5" >
               
             <option value="0">Select</option>
             <?php
			 if($_REQUEST['step']=="1"){
			 $str = "categories_parent=1";
			 }
			 elseif($_REQUEST['step']=="2"){
			 $str = "categories_sub=".$_REQUEST['sub_category_id']."";
			 }
			 $sub_cat_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories WHERE ".$str." and categories_status=1");
			 while($row = mysqli_fetch_array($sub_cat_query)){
			 ?>
              <option onDblClick="cat_sub_select();" value="<?php echo $row['categories_id'] ?>"><?php echo $row['categories_name'] ?></option>
              <?php
			  }
			  ?>
             </select>
              
           
     
		
	<?php
	}

}
?>



