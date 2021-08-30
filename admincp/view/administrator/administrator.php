<?php
class administrator extends config{

public function menu(){
?>
<a  style="float:right;" class="btn_sub" href="index.php?action=view&module=administrator&post=validity_add">Validity</a>
<a  style="float:right;" class="btn_sub" href="index.php?action=view&module=administrator&post=administrator">Staff List</a>
<a style="float:right;" class="btn_sub" href="index.php?action=view&module=administrator&post=add">Add Staff</a>
<?php
}

public function listing(){
	?>
	<div class="content">
		
		<div class="nav">
		Staff Management
        <?php $this->menu(); ?>
        
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div  style="background-color:#CCCCCC; padding:10px; width:95%; border-color:#fed82e;border-style:dashed;border-width:thin;border-radius:5px;">
       
   
	<table id="example" class="table table-striped table-bordered">
  <thead>
  <tr>
   
    <th width="20%"><strong>USERNAME</strong></td>
    <th width="30%"><strong>PASSWORD</strong></td>
    <th width="10%" align="center"><strong>TYPE</strong></td>
    <th width="30%" align="center"><strong>Action</strong></td>
    <th width="30%" align="center"><strong>Action</strong></td>
    <th width="30%" align="center"><strong>Action</strong></td>    </tr>
    </thead>
    <tbody>
  <?php
  
  $cat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_admin`");
  
  while($row = mysqli_fetch_array($cat_query)){
  
  ?>
  <tr>
    <td><?php echo $row['admin_username']; ?></td>
    <td><?php echo $row['admin_password']; ?></td>
    <td><?php echo $row['admin_sets']; ?></td>
    
    <td colspan="3" align="center"><div class="link_href"><a href="index.php?action=view&module=administrator&post=edit&id=<?php echo $row['admin_id']; ?>">Edit</a></div></td>
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

		 public function admin_edit(){ ?>
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
    
    <div class="content">
		
		<div class="nav" style="width: 100%; height:auto;">
		Add & Set Privacy in Staff
		</div>
		<div class="main" style="padding:25px;" >
            <div  style="padding:10px; width:100%;height:50px;">
            <div align="left"><?php $this->menu(); ?></div>
            
         
            
           </div>
       <div  style="padding:10px; width:60%;">
        <form  name="add_scheme" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		<?php
		$user_id = $_REQUEST['id'];
		$usertype_query = mysqli_query($this->mysqlConfig(),"select * from pic_admin where admin_id=$user_id");
		$row = mysqli_fetch_array($usertype_query);
		?>
       <input type="hidden" name="module" value="administrator" />
       <input type="hidden" name="action" value="model" />
       <input type="hidden" name="post" value="edit" />
	   <input type="hidden" name="id" value="<?php echo $user_id; ?>" />
       
         <table width="100%" border="0" id="rows">
           <tr>
             <td><div align="right">Username</div></td>
             <td><label>
               <input type="text" name="title" id="title" value="<?php echo $row['admin_username']; ?>" style="width:100%;" />
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Password</div></td>
             <td><label>
               <input type="text" name="password" id="title" value="<?php echo $row['admin_password']; ?>" style="width:100%;" />
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
          
           
           <tr>
             <td><div align="right">Set Work</div></td>
             <td>
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="css/bootstrap-select.min.css" />
            
            <script src="js/bootstrap.min.js"></script>
            <script src="js/bootstrap-select.min.js"></script>
            <div class="form-group">
            <select data-live-search="true" class="selectpicker" name="mod[]" size="10" multiple="multiple" id="mod">
            
            <option <?php if(strpos($row['admin_sets'], 'fields') !== false){ ?> selected="selected" <?php } ?> data-tokens="fields" value="fields" >fields</option>
            <option <?php if(strpos($row['admin_sets'], 'category') !== false){ ?> selected="selected" <?php } ?> data-tokens="category" value="category" >category</option>
            <option <?php if(strpos($row['admin_sets'], 'Ads') !== false){ ?> selected="selected" <?php } ?> data-tokens="Ads" value="Ads" >Ads</option>
            <option <?php if(strpos($row['admin_sets'], 'likes') !== false){ ?> selected="selected" <?php } ?> data-tokens="likes" value="likes" >Likes</option>
            <option <?php if(strpos($row['admin_sets'], 'customer') !== false){ ?> selected="selected" <?php } ?> data-tokens="customer" value="customer" >customer</option>
            <option <?php if(strpos($row['admin_sets'], 'scheme') !== false){ ?> selected="selected" <?php } ?> data-tokens="scheme" value="scheme" >scheme</option>
            <option <?php if(strpos($row['admin_sets'], 'user') !== false){ ?> selected="selected" <?php } ?> data-tokens="scheme" value="user" >user</option>
            <option <?php if(strpos($row['admin_sets'], 'report') !== false){ ?> selected="selected" <?php } ?> data-tokens="report" value="report" >report</option>
            <option <?php if(strpos($row['admin_sets'], 'administrator') !== false){ ?> selected="selected" <?php } ?> data-tokens="administrator" value="administrator" >administrator</option>
            <option <?php if(strpos($row['admin_sets'], 'settings') !== false){ ?> selected="selected" <?php } ?> data-tokens="settings" value="settings" >settings</option>
            
            </select>
            
            </div>
           
             </td>
           </tr>
           <tr>
             <td></td>
             <td>
               <div align="left">
                 <input type="submit" name="save" id="save" value="Save" class="form_btn">
               </div></td>
           </tr>
           
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
         </table>
       </form>
  		</div>
	</div>	
</div>
    <?php
    
	}
	
	 public function admin_add(){ ?>
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
    
    <div class="content">
		
		<div class="nav" style="width: 100%; height:auto;">
		Add & Set Privacy in Staff
		</div>
		<div class="main" style="padding:25px;" >
            <div  style="padding:10px; width:100%;height:50px;">
             <div align="left"><?php $this->menu(); ?></div>
            
           </div>
       <div  style="padding:10px; width:60%;">
        <form  name="add_staff" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		
       <input type="hidden" name="module" value="administrator" />
       <input type="hidden" name="action" value="model" />
       <input type="hidden" name="post" value="add" />
	  
       
         <table width="100%" border="0" id="rows">
           <tr>
             <td><div align="right">Username</div></td>
             <td><label>
               <input type="text" name="title" id="title" value="" style="width:100%;" />
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Password</div></td>
             <td><label>
               <input type="text" name="password" id="password" value="" style="width:100%;" />
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
          
           
           <tr>
             <td><div align="right">Set Work</div></td>
             <td>
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="css/bootstrap-select.min.css" />
            
            <script src="js/bootstrap.min.js"></script>
            <script src="js/bootstrap-select.min.js"></script>
            <div class="form-group">
            <select data-live-search="true" class="selectpicker" name="mod[]" size="10" multiple="multiple" id="mod">
            
            <option data-tokens="fields" value="fields" >fields</option>
            <option data-tokens="category" value="category" >category</option>
            <option data-tokens="Ads" value="Ads" >Ads</option>
            <option data-tokens="customer" value="customer" >customer</option>
            <option data-tokens="scheme" value="scheme" >scheme</option>
            <option data-tokens="user" value="user" >user</option>
            <option data-tokens="report" value="report" >report</option>
            <option data-tokens="administrator" value="administrator" >administrator</option>
            <option data-tokens="settings" value="settings" >settings</option>
            
            </select>
            
            </div>
           
             </td>
           </tr>
           <tr>
             <td></td>
             <td>
               <div align="left">
                 <input type="submit" name="save" id="save" value="Save" class="form_btn">
               </div></td>
           </tr>
           
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
         </table>
       </form>
  		</div>
	</div>	
</div>
    <?php
    
	}
	
	public function validity_add(){ ?>
    
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <script>
  $( function() {
  
    $( "#choose_validity" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
  
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
    
    <div class="content">
		
		<div class="nav" style="width: 100%; height:auto;">
		Validity Settings
		</div>
		<div class="main" style="padding:25px;" >
            <div  style="padding:10px; width:100%;height:50px;">
             <div align="left"><?php $this->menu(); ?></div>
            
            
           </div>
       <div  style="padding:10px; width:60%;">
        <form  name="add_staff" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		
       <input type="hidden" name="module" value="administrator" />
       <input type="hidden" name="action" value="model" />
       <input type="hidden" name="post" value="validity_add" />
	  
       <?php
  
  $cat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_validity` where pic_validity_id=1");
  
  $row = mysqli_fetch_array($cat_query);
  
  ?>
  
    
         <table width="100%" border="0" id="rows">
           <tr>
             <td><div align="right">Label</div></td>
             <td><label>
             
               <input type="text" name="title" id="title" value="<?php echo $row['pic_validity_label']; ?>" style="width:100%;" />
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Choose Validity</div></td>
             <td><label>
               <input name="dates" type="text" id="choose_validity" style="width:100%;" size="30" value="<?php echo $row['pic_validity_date']; ?>">
             </label></td>
           </tr>
           
          
           
           
           <tr>
             <td></td>
             <td>
               <div align="left">
                 <input type="submit" name="save" id="save" value="Save" class="form_btn">
               </div></td>
           </tr>
           
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
         </table>
       </form>
  		</div>
	</div>	
</div>
    <?php
    
	}

}
?>



