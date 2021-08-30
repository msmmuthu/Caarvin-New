<?php
class user extends config{

	
	
	public function form(){
	?>
	
    <div class="container">
		
		
		 
		<div class="row">
       
                    <div class="col-6 pt-4">
       
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="cat_form" id="cat_form" method="post" >
         <input type="hidden" name="action" value="model" />
             <input type="hidden" name="module" value="users" />
             <div style="position:relative; float:left; width:50%; ">
             
                 <table class="table" border="0">
            <tr>
              <td height="38">Name</td>
              <td colspan="3">
                <input type="text" name="usr_name" id="usr_name" class="form-control" />              </td>
            </tr>
            <tr>
              <td height="38">Password</td>
              <td colspan="3">
                <input type="text" name="usr_pass" id="usr_pass" class="form-control" />              </td>
            </tr>
            <tr>
              <td height="34"> Email ID</td>
              <td colspan="3"><input type="text" name="usr_email" id="usr_email" class="form-control" /></td>
            </tr>
             <tr >
            <td >User Type Privacy</td>
              <td colspan="3" >
              <?php
			  $usertype_query = mysqli_query($this->mysqlConfig(),"select * from pic_user_type");
			  $g = 1;
			 while($row = mysqli_fetch_array($usertype_query)){
			  ?>
<input type="radio" name="user_type[]" id="user_type[]" value="<?php echo $row['user_type']; ?>" <?php if($g=='2'){ ?> checked="checked" <?php } ?> > &nbsp; <?php echo $row['user_type']; ?>
	
		  
          <?php $g =$g+1; }?>
          </td>
           </tr>
           <tr>
              <td height="34"> Mobile</td>
              <td colspan="3"><input type="text" name="usr_mob" id="usr_mob" class="form-control" /></td>
            </tr>
           <tr>
              <td height="34"> Address</td>
              <td colspan="3">  <select class="form-control"  name="city" id="city" >
				<option value="0" selected>Select</option>
				<?php
				
				$location_query = mysqli_query($this->mysqlConfig(),"select DISTINCT city1 from pic_geometric order by lan,lon ASC");
				
				while($row = mysqli_fetch_object($location_query)){
				?>
				
				<option  <?php if(!empty($_SESSION['pic']['biscuit']['city']) && $_SESSION['pic']['biscuit']['city']=="$row->city1") { ?> selected <?php } ?>> <?php echo $row->city1; ?> </option>
				
				<?php } ?>
				</select>

</td>
            </tr>

            
           <tr>
              <td height="34"></td>
              <td colspan="3">
              <input type="reset" name="reset" id="reset" value="Reset"  class="btn btn-secondary"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="submit" name="save_cat" id="save_cat" value="Submit" class="btn btn-primary" />                  </td>
            </tr>
          </table>
          
          </div>
         </form>
          </div>
  </div>
		
</div>
	<?php
    }
    
    public function usertype_list(){ ?>
    
    <div class="container">
		
		
		
		<div class="row" >
        
                    <div class="col-6 pt-4">
                       <h5>UserType Management</h5> 
          <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="cat_form" id="cat_form" method="post" >
         <input type="hidden" name="action" value="model" />
             <input type="hidden" name="module" value="user" />
             <input type="hidden" name="post" value="usertype" />
            
             <table class="table">
            <tr >
              <td height="38" style="width:10%;"><div align="center"><strong>UserType</strong></div></td>
              <td colspan="2" style="width:10%;">
                
                <label>
                
                <div align="center"><strong>is Allow?                </strong></div>
               
                </label>                </td>
              <td style="width:10%;"></td>
            </tr>
            <?php
			$usertype_query = mysqli_query($this->mysqlConfig(),"select * from pic_user_type");
			
			while($row = mysqli_fetch_object($usertype_query)){ ?>
            
            <tr>
              <td height="38"><div align="center"><?php echo $row->user_type; ?></div></td>
              <td colspan="2">
                <label>
                <div align="center">
                  <input type="checkbox" name="usertype_allow[]" <?php if($row->status==1){ ?> checked <?php } ?> id="usertype_allow[]" value="<?php echo $row->user_id; ?>">
                </div>
              </label></td>
              <td><a href="index.php?module=user&action=view&post=editusertype&id=<?php echo $row->user_id; ?>">Edit</a></td>
            </tr>
            
            <?php
			
				
			
			}
			?>
            <tr>
              <td height="38" colspan="4" style="width:10%;"><div align="center">
                
                      <input class="btn btn-primary" type="submit" name="usertype_submit" id="usertype_submit" value="Save">
               
              </div> </td>
            </tr>
          </table>
          
          
         </form>
          
  </div>
		
</div>
    <?php
    
	}
	
	 public function usertype_form(){ ?>
     
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
   
    
    <div class="container">
		
		
		<div class="row" >
                    <div  class="col-6 pt-4">
                        <h5>Add & Set Privacy in UserType</h5>
       
        <form  name="add_scheme" method="post" action="index.php">
       <input type="hidden" name="module" value="user" />
       <input type="hidden" name="action" value="model" />
       <input type="hidden" name="post" value="addusertype" />
       
       <table class="table">
           <tr>
             <td><div align="right">Title</div></td>
             <td><label>
                     <input class="form-control" type="text" name="title" id="title" value="" style="width:100%;" />
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Status</div></td>
             <td><label>
               <select  name="status" id="status" class="form-control" style="width:100%;">
                <option value="1">Active</option>
                <option value="0">Deactive</option>
               </select>
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>
			  <input type="checkbox" name="act[]" id="act[]" value="post">Post Ads &nbsp; &nbsp;</br>
			   <input type="checkbox" name="act[]" id="act[]" value="request">Request Ads  &nbsp; &nbsp;</br>
			  <input type="checkbox" name="act[]" id="act[]" value="view">View Ads &nbsp; &nbsp;</br>
			   <input type="checkbox" name="act[]" id="act[]" value="auto approve">Auto Approve&nbsp;&nbsp;</br>             </td>
           </tr>
           
           
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Select Category</div></td>
             <td>
				<?php $customer_query1 = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_parent=0"); ?>
                <link href="css/bootstrap.min.css" rel="stylesheet">
                <link rel="stylesheet" href="css/bootstrap-select.min.css" />
                
                <script src="js/bootstrap.min.js"></script>
                <script src="js/bootstrap-select.min.js"></script>
             <div class="form-group">
            <select data-live-search="true" class="selectpicker" name="cat[]" size="10" multiple="multiple" id="cat">
				<?php 
                while($row1 = mysqli_fetch_array($customer_query1)){?>
                ?>
                <option data-tokens="<?php echo $row1['categories_name']; ?>" value="<?php echo $row1['categories_id'].",".$row1['categories_sub']; ?>" > <?php echo $row1['categories_name']; ?></option>
                <?php 
                }
                ?>
            </select>
            </div>
             </td>
           </tr>
           <tr>
             <td></td>
             <td>
               <div align="left">
                 <input type="submit" name="save" id="save" value="Save" class="btn btn-primary">
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
    <?php
    
	}
	
	 public function usertype_edit(){ ?>
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
    
    <div class="container">
		
		
		<div class="row" >
                    <div  class="col-8 pt-4">
                        <h5>Add & Set Privacy in UserType</h5>

        <form  name="add_scheme" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		<?php
		$user_id = $_REQUEST['id'];
		$usertype_query = mysqli_query($this->mysqlConfig(),"select * from pic_user_type where user_id=$user_id");
		$row = mysqli_fetch_array($usertype_query);
		?>
       <input type="hidden" name="module" value="user" />
       <input type="hidden" name="action" value="model" />
       <input type="hidden" name="post" value="editusertype" />
	   <input type="hidden" name="id" value="<?php echo $user_id; ?>" />
       
           <table class="table">
           <tr>
             <td><div align="right">Title</div></td>
             <td><label>
                     <input class="form-control" type="text" name="title" id="title" value="<?php echo $row['user_type']; ?>" style="width:100%;" />
             </label></td>
           </tr>
           <tr>
             <td><div align="right"></div></td>
             <td>&nbsp;</td>
           </tr>
           
           <tr>
             <td><div align="right"></div></td>
             <td>
                 <input <?php if(strpos($row['setoption'], 'post') !== false){ ?> checked <?php } ?> type="checkbox" name="act[]" id="act[]" value="post">Post Ads &nbsp; &nbsp;</br>
			   <input <?php if(strpos($row['setoption'], 'request') !== false){ ?> checked <?php } ?> type="checkbox" name="act[]" id="act[]" value="request">Request Ads  &nbsp; &nbsp;</br>
			  <input <?php if(strpos($row['setoption'], 'view') !== false){ ?> checked <?php } ?> type="checkbox" name="act[]" id="act[]" value="view">View Ads &nbsp; &nbsp;</br>
			   <input <?php if(strpos($row['setoption'], 'auto') !== false){ ?> checked <?php } ?> type="checkbox" name="act[]" id="act[]" value="auto approve">Auto Approve&nbsp;&nbsp;  </br>           </td>
           </tr>
           
           
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td><div align="right">Select Category for Post,Request Ads and Auto Approve</div></td>
             <td>
				<?php $customer_query1 = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_parent=0"); ?>
                
            
           
                
                
             <div class="form-group">
            <select data-live-search="true" class="selectpicker" name="cat[]" size="10" multiple="multiple" id="cat">
				<?php 
                while($row1 = mysqli_fetch_array($customer_query1)){?>
                ?>
                <option  <?php if(strpos($row['setcategory'], $row1['categories_id']) !== false){ ?> selected="selected" <?php } ?> data-tokens="<?php echo $row1['categories_name']; ?>" value="<?php echo $row1['categories_id'].",".$row1['categories_sub']; ?>" > <?php echo $row1['categories_name']; ?></option>
                <?php 
                }
                ?>
            </select>
            </div>             </td>
           </tr>
           <tr>
              <td><div align="right">Select Category for View Page</div></td>
             <td>
				<?php $customer_query1 = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_parent=0"); ?>
                
            
           
                
                
             <div class="form-group">
            <select data-live-search="true" class="selectpicker" name="cat_view[]" size="10" multiple="multiple" id="cat_view">
				<?php 
                while($row1 = mysqli_fetch_array($customer_query1)){?>
                ?>
                <option  <?php if(strpos($row['setcat_view'], $row1['categories_id']) !== false){ ?> selected="selected" <?php } ?> data-tokens="<?php echo $row1['categories_name']; ?>" value="<?php echo $row1['categories_id'].",".$row1['categories_sub']; ?>" > <?php echo $row1['categories_name']; ?></option>
                <?php 
                }
                ?>
            </select>
            </div>             </td>
           </tr>
           <tr>
             <td></td>
             <td>
               <div align="left">
                 <input type="submit" name="save" id="save" value="Save" class="btn btn-primary">
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
    <?php
    
	}
	


}
?>
