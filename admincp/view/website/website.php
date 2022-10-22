<?php
class website extends config{

public function listing(){
	?>
	<div class="container">		
		<div class="row" >        
        <div class="col-12 pt-4" >
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                <a class="navbar-brand" href="#">Website</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>  
            </nav>   
   
	<table id="myTable" class="table table-striped table-bordered">
    <thead>
        <tr>   
          <th width="20%"><strong>Name</strong></td>
          <th width="30%"><strong>Website(URL)</strong></td>    
            <th width="20%"><strong>Logo</strong></td>
          <th width="30%" align="center"><strong>Action</strong></td>
          <th width="30%" align="center"><strong>Action</strong></td>
          <th width="30%" align="center"><strong>Action</strong></td>
        </tr>
    </thead>
    <tbody>
  <?php

 if($_REQUEST['post']=="sub"){ 
      $catsubid = $_REQUEST['catid']; 
      $str = "and categories_sub!=0 and categories_sub=".$catsubid."";    
 }
 else{ 
      $str = "and `categories_parent`=1";  
 } 

  $cat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_website` ORDER BY `website_name` DESC");
  
  while($row = mysqli_fetch_array($cat_query)){

    $id_agent       = $row['status'];
    $categories_id  = $row['id'];
    
  ?>
  <tr>    

    <td><?php echo $row['website_name']; ?></td>

    <td><?php echo $row['website_url']; ?></td>

    <td><img style="border-radius: 10px;border: 1px solid #EAC000;" height="100" src="media/weblogo/<?php echo $row['logo']; ?>"  />
         </td>



    <td width="8%" align="center"><div class="link_href"><a href="index.php?action=view&module=editwebsite&catid=<?php echo $row['id']; ?>&post=edit">Edit</a></div></td>

    <td width="8%" align="center">
      <?php if($row['status']==1){ ?> 
        <div class="link_href"><a href="index.php?action=model&module=website&id=0&post=hidden&catid=<?php echo $row['id']; ?>">Hide</a></div>  
        <?php } else { ?> 
          <div class="link_href"><a href="index.php?action=model&module=website&id=1&post=hidden&catid=<?php echo $row['id']; ?>">Show</a>
          </div><?php } ?>
    </td>

    <td width="8%" align="center"><?php if($row['status']==1){ ?> <div class="link_href"><a href="index.php?action=model&module=website&catid=<?php echo $row['id']; ?>&post=delete">Delete</a></div>  <?php } ?></td>

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
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="cat_form" id="cat_form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="model" />
        <input type="hidden" name="module" value="website"/>
            
		    <table width="100%" border="0">

            <tr>
              <td height="38">Website Name</td>
              <td colspan="3">
                <input type="text" name="website_name" id="website_name" class="form-control" required />
              </td>
            </tr>

            <tr>
              <td height="34">URL </td>
              <td colspan="3"><input type="text" name="website_url" id="website_url" class="form-control" required/></td>
            </tr>

            <tr>
              <td height="34">Logo </td>         
              <td colspan="3">
                  <input type="file" class="form-control-file" name="photo" id="icon" required>
              </td>         
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



