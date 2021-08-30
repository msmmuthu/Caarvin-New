<?php
class Ads extends config{

	
	
	public function index() {
        ?>
         <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>
        <style type="text/css">
            .account-left{
                width:54%;
                float:left;
                background:#f4f4f4;
                padding:3%;
            }

            .account-right{
                
                
                padding:3%;
				width:50%;

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
				.search-title{
	width:100%;
/*	float:left;
*/	font-size:15px;
}
.space_10 {
    height: 10px;
}
.title {
    width: 100%;
    float: left;
    font-size: 18px;
    font-weight: bold;
}
        </style>
       <div class="content">
		
		<div class="nav">
		Ads Management
		</div>
		
		<div class="main" style="padding:25px;" >
        
       <div class="div-custom">
       
            <form  id="postad" name="postad" method="post" action="index.php" enctype="multipart/form-data">
                <div class="bor">
                    <div class="account-right">

                        
                            <input type="hidden" name="action" value="model" />
                            <input type="hidden" name="module" value="Ads" />
<?php
									if(isset($_REQUEST['id'])){
									
										$categories_querys = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_ads_id=".$_REQUEST['id']."");
										$rows=mysqli_fetch_object($categories_querys);
										
										$id_check = $rows->pic_ads_id;
										
										}
									?>
<?php if($rows->pic_ads_id==""){ ?>
                            <input type="hidden" name="post" value="postad insert" />
                             <?php } else{ ?><input type="hidden" name="post" value="update" />
<input type="hidden" name="id" value="<?php echo $rows->pic_ads_id; ?>" />
<?php }  ?>
                            <div class="title">Edit Posted Ads</div>
                            <div class="space_10"></div>

                                <div class="space_10"></div>
                                <div class="space_10"></div>
                               
                                
                                <div class="col-2">
                                
                                    <div class="space_10"></div>
                            
                                   </div>
                                 
                                    <div class="col-2">
                                    <div class="search-title"> Title *</div>
                                    <div class="space_10"></div>
                                    <div class="rows">
<?php if($rows->pic_ads_id==""){ ?>
                            <input required type="text"  class="form_txt" id="pro_title" name="pro_title">
                             <?php } else{ ?><input required type="text"  class="form_txt" id="pro_title" name="pro_title" value="<?php echo $rows->pic_title; ?>"><?php }  ?>
                                        
                                    </div>
                                    <div class="space_10"></div>
                                </div>
                                <div class="col-2">
                                    <div class="search-title">Category *</div>
                                    <div class="space_10"></div>
                                    <div class="rows">
                                    <?php
									if(isset($_REQUEST['sub'])){
									
										$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id=".$_REQUEST['sub']."");
										$row=mysqli_fetch_object($categories_query);
										
										}
									?>
                                        <input type="text"  class="form_txt" id="pro_category" name="pro_category" value="<?php echo $row->categories_name; ?>" readonly>
                                        <input type="hidden"  class="form_txt" id="category_id" name="category_id" value="<?php echo $row->categories_id; ?>">
                                    </div>
                                    <div class="space_10"></div>
                                </div>
                                <div class="col-2">
                                    <div class="search-title"> Price *</div>
                                    <div class="space_10"></div>
                                    <div class="rows">
<?php if($rows->pic_ads_id==""){ ?>
                            <input type="text"  required class="form_txt" id="pro_price" name="pro_price">
                             <?php } else{ ?><input type="text"  required class="form_txt" id="pro_price" name="pro_price" value="<?php echo $rows->pic_price; ?>"><?php }  ?>
                                        
                                    </div>
                                    <div class="space_10"></div>
                                </div>
                                
                                  <?php
								 $temp="";
								 $field_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and fields_type='Chain' order by field_priority,fields_id ASC");
								 ?>
								 <?php
								 while($row=mysqli_fetch_object($field_query)){
								 ?>
                                <div class="col-2">
                                    <?php 
									$field_value_trim = trim($row->field_value, "from:");
									$field_value_trim = str_replace('to:', '', $field_value_trim);
									$field_value_trim = explode(',', $field_value_trim);
									?>
                                    <div class="search-title">
									  <strong>
									<?php 
                                    $title_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_id=$field_value_trim[0]");
                                    $maintitle = mysqli_fetch_array($title_query);
                                    echo $name =  $maintitle['fields_title']; 
									$name = str_replace(" ","_",$maintitle['fields_title']);
                                    ?>
								      </strong> </div>
                                  <div class="space_10"></div>
                                  
                                    <div class="rows">
					<?php $placeholder = $row->field_sample; ?>
                    <?php 
					$values_query1 = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and pots_field_DV_id='$field_value_trim[0]'");
                    $row_value1=mysqli_fetch_object($values_query1);
                    ?>
                                        
                                        <select 
                                        <?php if($_REQUEST['post']=="post") { ?> onchange="fieldChain_add(this,<?php echo $field_value_trim[1]; ?>,<?php echo $field_value_trim[0]; ?>,<?php echo $_REQUEST['sub']; ?>);" <?php } else { ?>  onchange="fieldChain(this,<?php echo $field_value_trim[1]; ?>,<?php echo $field_value_trim[0]; ?>,<?php echo $_REQUEST['sub']; ?>,<?php echo $_REQUEST['id']; ?>);" <?php } ?>
                                        name="<?php echo $name;?>" id="<?php echo $row_value1->addpost_field_id;?>"  class="form_txt" style="width:78%;">
                                        <?php
                                        $stringcond=",".$field_value_trims;
                                        $droplist_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and field_DV_id='$field_value_trim[0]'");
                                        while($list = mysqli_fetch_array($droplist_query)){
                                        $values_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and pots_field_DV_id!=0");
										
										
                                        $row_value=mysqli_fetch_object($values_query);
										?>
                                       
                                        <option <?php if($list['fields_id'] == $row_value->addpost_fields_value){ ?> selected="selected" <?php } ?> value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>
                                        
                                        <?php
                                        }
                                        ?>
                                        </select>
    
    <div class="space_10"></div>
    <div id="ajax_select">
    <div class="space_10"></div>
	    <div class="search-title">
    <strong>
    <?php 
	$title_query_1 = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_id=$field_value_trim[1]");
	$maintitle_1 = mysqli_fetch_array($title_query_1);
    echo $name_1 = $maintitle_1['fields_title']; 
	$name_1 = str_replace(" ","_",$maintitle_1['fields_title']);
    ?>
    <?php 
	$title_query_0 = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_id=$field_value_trim[0]");
	$maintitle_0 = mysqli_fetch_array($title_query_0);
	$name_0 = str_replace(" ","_",$maintitle_0['fields_title']);
    ?>
    </strong> </div>
     <div class="space_10"></div>
     
    <select onblur="fieldUpdated_2(this,<?php echo $name_0; ?>);" name="<?php echo $name_1;?>"  class="form_txt" style="width:78%;">
                                        <?php
                                        $stringcond=",".$field_value_trims;
                                        $droplist_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and field_DV_id='$field_value_trim[1]'");
                                        while($list = mysqli_fetch_array($droplist_query)){
                                        $values_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and addpost_fields_value=".$list['fields_id']."");
                                        $row_value=mysqli_fetch_object($values_query);
										?>
                                       
                                        <option <?php if($list['fields_id'] == $row_value->addpost_fields_value){ ?> selected="selected" <?php } ?> value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>
                                        
                                        <?php
                                        }
                                        ?>
                                        </select>
    <div class="space_10"></div>
    </div>
    
    </div>
    </div>
	<?php
	$temp = $row->fields_title;
}
								?>
                                
                                 <?php
								 $temp="";
								 $field_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and fields_type='DropDown' and field_DV_id=0 and fields_id!=$field_value_trim[0] and fields_id!=$field_value_trim[1] order by field_priority,fields_id ASC");
								 ?>
                                 
								 <?php
								 while($row=mysqli_fetch_object($field_query)){
								 ?>
                                
                                <div class="col-2">
                                
                                <?php 
									if($temp!=$row->fields_title){
									?>
                                    <div class="search-title">
									  <strong>
									  <?php 
									echo $row->fields_title; 
									?>
								      </strong> </div>
                                  <div class="space_10"></div>
                                    <?php
                                    }
									?>
                                    <div class="rows">
                                        <?php $name = str_replace(" ","_",$row->fields_title); ?>
                                         <?php $placeholder = $row->field_sample; ?>
                                        <?php  $values_query1 = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and pots_field_DV_id='$row->fields_id'");
										$row_value1=mysqli_fetch_object($values_query1);
	?>
    
	<select onchange="fieldUpdated(this);" name="<?php echo $name;?>" id="<?php echo $row_value1->addpost_field_id; ?>" class="form_txt" style="width:78%;">
		<?php
        $droplist_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and field_DV_id=".$row->fields_id."");
        while($list = mysqli_fetch_array($droplist_query)){
        ?>
        <option <?php if($list['fields_id']==$row_value1->addpost_fields_value){ ?> selected="selected" <?php } ?> value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>
        <?php
        }
        ?>
	</select>
    </div>
    </div>
    <div class="space_10"></div>
    
	<?php
	$temp = $row->fields_title;
	}

								?>
                                
                                  <?php
								 $temp="";
								 $field_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories_fields where fields_categories_id=".$_REQUEST['sub']." and fields_type!='Chain' and fields_type!='DropDown' order by field_priority,fields_id ASC");
								 ?>
                                 
								 <?php
								 while($row=mysqli_fetch_object($field_query)){
								 ?>
                                
                                <div class="col-2">
                                <?php 
									if($temp!=$row->fields_title){
									?>
                                    <div class="search-title">
									  <strong>
									  <?php 
									echo $row->fields_title; 
									?>
								      </strong> </div>
                                    <div class="space_10"></div>
                                    <?php
                                    }
									?>
                                    <div class="rows">
                                        <?php $name = str_replace(" ","_",$row->fields_title); ?>
                                         <?php $placeholder = $row->field_sample; ?>
                                        
                                        <?php
										if($row->fields_type=="Textbox" or $row->fields_type=="Text"){
										//echo $id_check;
										
										?>
                                        
										<?php if($id_check!=""){ ?>
										
										<?php
								 $value_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and field_id=$row->fields_id");
								 $row_vlaue=mysqli_fetch_object($value_query);
								 		?>
                                        
                                        <input id="<?php echo $row_vlaue->addpost_field_id; ?>" onchange="fieldUpdated(this);" type="text" required class="form_txt"  name="<?php echo $name; ?>" value="<?php echo $row_vlaue->addpost_fields_value; ?>">
                                        <?php
										}
										
										else{
										?>
                                         <input placeholder="<?php echo $placeholder; ?>"  type="text"  required class="form_txt" id="pro_price" name="<?php echo $name; ?>">
                                        <?php
										}
										}
										
										if($row->fields_type=="Numeric"){
										//echo $id_check;
										
										?>
                                        
										<?php if($id_check!=""){ ?>
										
										<?php
								 $value_query = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_field where addpost_uni_id='".$_REQUEST['id']."' and addpost_fields_title='$name'");
								 $row_vlaue=mysqli_fetch_object($value_query);
								 		?>
                                        
                                        <input id="<?php echo $row_vlaue->addpost_field_id; ?>" onchange="fieldUpdated(this);"  type="number" required class="form_txt"  name="<?php echo $name; ?>" value="<?php echo $row_vlaue->addpost_fields_value; ?>">
                                        <?php
										}
										
										else{
										?>
                                         <input  placeholder="<?php echo $placeholder; ?>" type="number"  required class="form_txt" id="pro_price" name="<?php echo $name; ?>">
                                        <?php
										}
										}
										
										
										?>
                                     
                                    </div>
                                    <div class="space_10"></div>
                                </div>
                                
                                <?php
								
								}
								?>

                                <div class="col-2">
                                    <div class="search-title"> Description *</div>
                                    <div class="space_10"></div>
                                    <div class="rows">
<?php if($rows->pic_ads_id==""){ ?>
                            <textarea  required class="form_txt" id="pro_description" name="pro_description"></textarea>
                             <?php } else{ ?><textarea  required class="form_txt" id="pro_description" name="pro_description"><?php echo $rows->pic_discription; ?></textarea><?php }  ?>
                                        
                                    </div>
                                </div>
                                <?php
                                       if(isset($_REQUEST['sub'])){
									
										$categories_query = mysqli_query($this->mysqlConfig(),"select * from pic_categories where categories_id=".$_REQUEST['sub']."");
										$row=mysqli_fetch_object($categories_query);
										
										$chk_row = mysqli_num_rows($categories_query );
										
										if($chk_row==1){
										
										
									?>
									
                                <div class="col-2">
                                
                                    <div class="search-title"> <?php echo $row->cat_search_title; ?> *</div>
                                    <div class="space_10"></div>
                                    <div class="rows">
                                    <?php if($rows->pic_ads_id==""){ ?>
                            <textarea placeholder="This <?php echo $row->cat_search_title; ?> has a character limit of <?php echo $row->cat_search_limit; ?>." required maxlength="<?php echo $row->cat_search_limit; ?>" class="form_txt" id="pro_tag" name="pro_tag"></textarea>
                             <?php } else{ ?><textarea placeholder="This <?php echo $row->cat_search_title; ?> has a character limit of <?php echo $row->cat_search_limit; ?>." required maxlength="<?php echo $row->cat_search_limit; ?>" class="form_txt" id="pro_tag" name="pro_tag"><?php echo $rows->pic_tag; ?></textarea><?php }  ?>
									
                                        
                                    </div>
                                </div>
                                <?php
                                
                                }
                                }
                                ?>
                                <div class="col-2">
                                    <div class="search-title"> Image *</div>
                                    <div class="space_10"></div>
                                    <div class="rows">
<?php if($rows->pic_ads_id==""){ ?>
                            <input type="file" name="files[]" multiple="multiple" id="files">
                             <?php } else{ 
$categories_query2 = mysqli_query($this->mysqlConfig(),"select * from pic_addpost_images where addpost_id=".$rows->pic_ads_id."");
										$row1=mysqli_fetch_object($categories_query2);
 ?><img src="../media/small/<?php echo $row1->ad_image_url; ?>"><br>
Change Image: <input type="file" name="files[]" multiple="multiple" id="files">
<?php }  ?>
                                        
                                    </div>
                                </div>

                                <div class="space_10"></div>
                            
                             <div class="col-2">
                                <input type="submit" value="Edit" name="posting_ad" class="form_btn" >
                            </div>
                            <div class="space_10"></div>
                            <div class="space_10"></div>
                        
                    </div>
                    
                    </form>
        </div>
        </div>
        </div>
        <script>
      $('#pro_tag').summernote({
        placeholder: '',
        tabsize: 2,
        height: 200
      });
	  $('#pro_tag').summernote();
    </script>
        <?php
    }
	public function header($txt) {
       
	
        ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <a class="navbar-brand" href="#"><?php echo $txt; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="ads_export.php">Export Ads</a>
        
      </li>
      <li class="nav-item">
          <a class="nav-link" href="field_export.php">Export Ads Fields</a>
      </li>
     
    </ul>
  </div>
</nav>
<?php
    }
	public function Ads_list(){ ?>
    
    <style>
	.img_tbl{
	text-align: center;
    border-radius: 5px;
    height: 100px;
    border: 5px solid #ccc;
	}
	</style>



  
  
  


	<div class="container">
		
	
		
		<div class="row">
        
     
       <div class="col-12 pt-4" >
	
<?php $this->header('Ads'); ?>

	<table id="account_dt" class="display">
    <thead>
  <tr>
  
  <th  align="center"><strong>S.No</strong></th>
  <th><div align="left"><strong>Ads Type</strong></div></th>
  <th><div align="left"><strong>ID</strong></div></th>
    <th><div align="left"><strong>Title</strong></div></th>
    <th><div align="center"><strong>Category</strong></div></th>
    <th  align="center"><div align="left"><strong>Posted by</strong></div></th>
	<th  align="center"><div align="left"><strong>Reference No</strong></div></th>
	<th  align="center"><div align="left"><strong>Location</strong></div></th>
	<th  align="center" style="width: 150px;"><strong>Action</strong></th>
    <th  align="center"><strong>Status</strong></th>
    <th  align="center"><strong>Date by</strong></th>
    
  </tr>
  </thead>
  
  
</table>
</div>
<script>

		
			$(document).ready(function(argument) {
			var table = $('#account_dt').DataTable({
				serverSide: true,
				ajax:{
						url :"response.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".account_dt-error").html("");
							$("#account_dt").append('<tbody class="account_dt-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
							$("#account_dt_processing").css("display","none");
						}
					},
				dom: "frtiS",
				scrollY:'75vh',
				scrollX: true,
				deferRender: true,
				scrollCollapse: true,
                                drawCallback: function() {
                                    $('[data-toggle="popover"]').popover(),
                                    $('[data-toggle="tooltip-secondary"]').tooltip({
          template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
        })      
                                },
				scroller: true,
				searching: true
			 
			});
			$('#search_input_dt').keyup(function(){
				  table.search($(this).val()).draw() ;
			});
                        
							
                       
			
		  	});
                       
                       
			
    	</script>


</div>
</div>
	
		

	<?php
	}
	
	public function Ads_Add_tag(){
	?>
	
    <div class="container">
		
		
		
		<div class="row">
        
                    <div class="col-12 pt-4">
       <?php
	   $query=mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_addpost WHERE pic_id=".$_REQUEST['id']."");
	   $row = mysqli_fetch_array($query);
	   $this->header('Ads tag');
	   ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="change_password_form" id="change_password_form" method="post" >
         <input type="hidden" name="action" value="model" />
             <input type="hidden" name="module" value="Ads" />
             <input type="hidden" name="post" value="Tags Insert" />
             <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />
             <div style="position:relative; float:left; width:50%; ">
		  <table border="0">
            <tr>
              <td height="38">Ads Unique Id</td>
              <td colspan="3">
                <input type="text" name="usr_name" id="usr_name" class="form-control" value="<?php echo $row['pic_ads_id']; ?>" disabled />              </td>
            </tr>
            <tr>
              <td height="38">Search Tags</td>
              <td colspan="3">
                  <textarea class="form-control" name="search_tags" id="search_tags" cols="45" rows="5" required><?php echo $row['pic_admin_tag']; ?></textarea>
              </td>
            </tr>
            
            
           <tr>
              <td height="34"></td>
              <td colspan="3">
              <input type="reset" name="reset" id="reset" value="Reset"  class="btn btn-secondary"/>
              <input type="submit" name="save_tags" id="save_tags" value="Submit" class="btn btn-primary" />                  </td>
            </tr>
          </table>
          
          </div>
         </form>
          </div>
  </div>
		
</div>

<?php 	} 

public function Ads_Add_picture(){
	?>
	
    <div class="container">
		
		
		
		<div class="row">
        
                    <div  class="col-12 pt-4">
       <?php
	   $query=mysqli_query($this->mysqlConfig(),"SELECT * FROM pic_addpost WHERE pic_id=".$_REQUEST['id']."");
	   $row = mysqli_fetch_array($query);
	   
	   ?>
                        <?php $this->header('Set Picture Limit'); ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="ads_picture" id="ads_picture" method="post" >
         <input type="hidden" name="action" value="model" />
             <input type="hidden" name="module" value="Ads" />
             <input type="hidden" name="post" value="picture" />
             <input type="hidden" name="id" value="<?php echo $row['pic_ads_id']; ?>" />
             <div style="position:relative; float:left; width:50%; ">
		  <table border="0">
            
            <tr>
              <td height="38">No. of Picture</td>
              <td colspan="3">
                  <input class="form-control" type="number" name="pic_no" placeholder="10" />
              </td>
            </tr>
            
            
           <tr>
              <td height="34"></td>
              <td colspan="3">
              <input type="reset" name="reset" id="reset" value="Reset"  class="btn btn-secondary"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input  type="submit" name="save_tags" id="save_tags" value="Submit" class="btn btn-primary" />                  </td>
            </tr>
          </table>
          
          </div>
         </form>
          </div>
  </div>
		
</div>

<?php 	} 
}
?>
	
