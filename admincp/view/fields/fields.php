<?php
class fields extends config{


	
    public function header() {
        $categories_id = $_REQUEST['catid'];
	
        ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <a class="navbar-brand" href="#">Category</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=edit">General</a>
        
      </li>
      <li class="nav-item">
          <a class="nav-link" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=managefield">Fields</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=chainfield">Fields Chain</a>
      </li>
    </ul>
  </div>
</nav>
<?php
    }
	public function general(){
	?>
	<div class="container">
		
		
            
		
		<div class="row" >
        
                    <div class="col-12 pt-2">

   
	<?php
        $categories_id = $_REQUEST['catid'];
	$cat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories` where `categories_status`= 1 and `categories_id`= $categories_id");
	$row = mysqli_fetch_object($cat_query);
	
        $this->header();
	
	?>
                        
  

   <form id="general" name="general" method="post" enctype="multipart/form-data" action="">
   <input type="hidden" name="action" value="model" />
   <input type="hidden" name="module" value="fields" />
   <input type="hidden" name="post" value="general" />
   <input type="hidden" name="id" value="<?php echo $categories_id; ?>" />
   
     <table width="100%" border="0">
       <tr>
         <td colspan="3">
             <div style="border-bottom:1px dotted #666;" align="center"><h3>General Information > <span class="label_title"><?php echo $row->categories_name; ?></span></h3></div></td>
         </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td><div align="right">Name</div></td>
         <td>&nbsp;</td>
         <td><label>
           <input class="form-control" type="text" name="cat_name" id="cat_name" value="<?php echo $row->categories_name; ?>" />
         </label></td>
       </tr>
       <tr>
         <td><div align="right"></div></td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td><div align="right">Description</div></td>
         <td>&nbsp;</td>
         <td><label>
           <textarea class="form-control" name="cat_desc" id="cat_desc" cols="45" rows="5"><?php echo $row->categories_desc; ?></textarea>
           
         </label></td>
       </tr>
       <tr>
         <td><div align="right"></div></td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
         
         <link rel="stylesheet" href="../css/normalize.min.css">

  <link rel='stylesheet prefetch' href='../css/font-awesome.min.css'>
<link rel='stylesheet prefetch' href='../css/chosen.min.css'>

       <style>
		#icon {
		margin: 0 0 10px;
		}
		
		.chosen-container {
		text-align: left; // overrides body text-align
		}
	</style>
       <tr>
         <td><div align="right">Choose Image</div></td>
         <td>&nbsp;</td>
         <td>
         	<div id="icon"></div>
		<!--<select id="select" name="threads-icon" class="fa-select"><option value=""><img src="https://cdn.iconscout.com/public/images/icon/free/png-512/apple-fruit-food-vitamin-healthy-30aba8081bb38594-512x512.png" /></option></select>-->
        <img height="100px" src="https://cdn.iconscout.com/public/images/icon/free/png-512/apple-fruit-food-vitamin-healthy-30aba8081bb38594-512x512.png" />
	</td>
       </tr>
       
<script src='js/chosen.jquery.min.js'></script>
<script src='js/js-yaml.min.js'></script>

       <script>
		$.get('js/icons.yml', function(data) {
		var parsedYaml = jsyaml.load(data);
		$.each(parsedYaml.icons, function(index, icon){
		$('#select').append('<option value="fa-' + icon.id + '">' + icon.id + '</option>');
		});
		
		$("#select").chosen({
		enable_split_word_search: true,
		search_contains: true 
		});
		$("#icon").html('<i class="fa fa-2x ' + $('#select').val() + '"></i>');
		});
		
		/* Detect any change of option*/
		$("#select").change(function(){
		var icono = $(this).val();
		$("#icon").html('<i class="fa fa-2x ' + icono + '"></i>');
		});

       </script>
       
       <tr>
         <td><div align="right">Choose Custom Image</div></td>
         <td>&nbsp;</td>
         <td>
         <div class="form-group">
    
    <input type="file" class="form-control-file" name="photo" id="icon">
  </div>
             
         </td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>
         <?php
         if($row->cat_fa!=""){
         ?>
         
         <i class="fa fa-2x <?php echo $row->cat_fa; ?>"></i>
         
         <?php } else { ?>
         
         <img style="border-radius: 10px;border: 1px solid #EAC000;" height="100" src="media/<?php echo $row->categories_image; ?>"  />
         
         <?php } ?>
         </td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td><div align="right">Map</div></td>
         <td>&nbsp;</td>
         <td><label>
           <input name="maps" type="radio" id="homepage1" value="1" <?php if($row->categories_maps==1) { ?>checked="checked" <?php } ?> />
           Yes 
           &nbsp;|&nbsp;
           <input name="maps" type="radio" id="homepage2" value="0" <?php if($row->categories_maps==0) { ?>checked="checked" <?php } ?> />
           No
           
           
         </label></td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       
       <tr>
         <td><div align="right">Show on Home Page?</div></td>
         <td>&nbsp;</td>
         <td><label>
           <input name="homepage" type="radio" id="homepage1" value="1" <?php if($row->categories_homepage==1) { ?>checked="checked" <?php } ?> />
           Yes 
           &nbsp;|&nbsp;
           <input name="homepage" type="radio" id="homepage2" value="0" <?php if($row->categories_homepage==0) { ?>checked="checked" <?php } ?> />
           No
           
           
         </label></td>
       </tr>
       <tr>
         <td><div align="right"></div></td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td><div align="right">Price Label</div></td>
         <td>&nbsp;</td>
         <td><label>
           <input name="price_label" type="text" id="price_label" class="form-control" value="<?php echo $row->categories_price_label; ?>" placeholder="Price" />
          
           
         </label></td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td><div align="right">Description Label</div></td>
         <td>&nbsp;</td>
         <td><label>
           <input name="desc_label" type="text" id="desc_label" class="form-control" value="<?php echo $row->categories_desc_label; ?>" placeholder="Descriptions" />
          
           
         </label></td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td><div align="right">Search Tag</div></td>
         <td>&nbsp;</td>
         <td><label>
           <input name="search_tag" type="radio" id="homepage3" value="1" <?php if($row->cat_search==1) { ?>checked="checked" <?php } ?> />
           Yes 
           &nbsp;|&nbsp;
               <input name="search_tag" type="radio" id="homepage4" value="0" <?php if($row->cat_search==0) { ?>checked="checked" <?php } ?> />
           No </label></td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td><div align="right">Search Label</div></td>
         <td>&nbsp;</td>
         <td><label>
           <input name="search_title" type="text" id="search_title" class="form-control" value="<?php echo $row->cat_search_title; ?>" placeholder="Search Tag" />
         </label></td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td><div align="right">Search Limit</div></td>
         <td>&nbsp;</td>
         <td><label>
           <input name="search_limit" type="text" id="price_label3" class="form-control" value="<?php echo $row->cat_search_limit; ?>" placeholder="100" />
         </label></td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td><div align="right">Order</div></td>
         <td>&nbsp;</td>
         <td><label>
           <input name="order_category" type="text" id="order_category" class="form-control" value="<?php echo $row->category_order; ?>" placeholder="100" />
         </label></td>
       </tr>
       <tr>
         <td><div align="right"></div></td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td><label>
           
         </label>           <label>
           
           </label></td>
         <td>&nbsp;</td>
         <td>
           <div align="left">
             <input type="submit" name="save" class="btn btn-primary" id="button" value="Save" />
           </div></td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td></td>
       </tr>
     </table>
   </form>
   </div>
</div>
</div>
<?php
	}
	public function updateQuickedit(){
	
		$cateid = $_POST['id'];
		$fieldid = $_POST['valu'];
		
		mysqli_query($this->mysqlConfig(),"UPDATE `pic_categories_fields` SET field_quickedit = 0 WHERE `fields_categories_id` = $cateid");
		mysqli_query($this->mysqlConfig(),"UPDATE `pic_categories_fields` SET field_quickedit = 1 WHERE `fields_id` = $fieldid");
		
	
	}
	public function managefield(){
	?>
   
    <div class="container">
		
		
		
		<div class="row" >
        
                    <div class="col-12 pt-2" >

   
	<?php
	$categories_id = $_REQUEST['catid'];
	$cat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories`  where `categories_status`= 1 and `categories_id`= $categories_id");
	
	$row_title = mysqli_fetch_object($cat_query);
	
	$this->header();
	
	?>
   

   <form id="general" name="general" method="post" enctype="multipart/form-data" action="">
   <input type="hidden" name="action" value="model" />
   <input type="hidden" name="module" value="fields" />
   <input type="hidden" name="post" value="update" />
   <input type="hidden" name="catid" value="<?php echo $categories_id; ?>" />
   <div align="center">
                 <h3>Fields Information > 
                     <span class="label_title"><?php echo $row_title->categories_name; ?></span>
                 </h3>
             </div>
   <div align="left"><a class="btn_sub" href="index.php?action=model&module=fields&catid=<?php echo $categories_id; ?>&post=add&type=Textbox">Add Textbox</a></div>
   <div align="left"><a class="btn_sub" href="index.php?action=model&module=fields&catid=<?php echo $categories_id; ?>&post=add&type=Numeric">Add Numeric</a></div>
   <div align="left"><a class="btn_sub" href="index.php?action=model&module=fields&catid=<?php echo $categories_id; ?>&post=add&type=DropDown">Add Dropdown</a></div>
   <div align="left"><a class="btn_sub" href="index.php?action=model&module=fields&catid=<?php echo $categories_id; ?>&post=add&type=Text">Add Label</a></div> 
   <table class="table">
      
      
       <thead>
       <tr>
         <th>Type</td>
         <th>Title</td>
         <th align="center">Quick Edit</td>
         <th>MultiSelect</td>
         <th>DisplayInListing</td>
         <th>Sample Text</td>
         <th>Order</td>
         <th>Values</td>
         <th>Action</td>
       </tr>
       </thead>
       <?php
	   $field_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `fields_categories_id`= $categories_id and `fields_type`!= 'Chain' and `field_DV_id`=0 ORDER BY `pic_categories_fields`.`field_priority` ASC");
	   while($row_field = mysqli_fetch_object($field_query)){
	   ?>
       
       <tr>
       
         <td><div align="center"><?php echo $row_field->fields_type; ?></div></td>
         <td><label>
         <input type="hidden" name="id[]" value="<?php echo $row_field->fields_id; ?>" />
         <input type="hidden" name="fields_type[]" value="<?php echo $row_field->fields_type; ?>" />
         <input type="hidden" name="fields_old_title[]" value="<?php echo $row_field->fields_title; ?>" />
           <input class="form-control" type="text" name="field_name[]" id="field_name" value="<?php echo $row_field->fields_title; ?>" />
           
         </label></td>
         <td align="center"><label>
           <input name="quickedit" class="quickedit form-check-input" type="radio" id="<?php echo $categories_id; ?>" value="<?php echo $row_field->fields_id;?>" <?php if($row_field->field_quickedit==1){ ?> checked="checked" <?php } ?>   />
         </label></td>
        <td align="center">
        <label>
             <input  class="form-check-input" type="checkbox" name="multi<?php echo $row_field->fields_id;?>" id="multi" <?php if($row_field->multi==1){ ?> checked <?php } ?> value="1">
        </label>
             </td>
             <td align="center">
        <label>
             <input  class="form-check-input" type="checkbox" name="displayinlist<?php echo $row_field->fields_id;?>" id="displayinlist" <?php if($row_field->displayinlist==1){ ?> checked <?php } ?> value="1">
        </label>
             </td>
         <td><label>
         
           <input class="form-control" type="text" name="field_sample[]" id="field_sample" value="<?php echo $row_field->field_sample; ?>" />
         </label></td>
         <td><input class="form-control" type="text" name="field_pri[]" id="field_pri" style="" value="<?php echo $row_field->field_priority; ?>" /></td>
        
         <td><?php if($row_field->fields_type=="DropDown"){ ?><div align="left"><a class="btn btn-secondary" href="index.php?action=view&module=fields&catid=<?php echo $categories_id; ?>&post=dropdownvalue&id=<?php echo $row_field->fields_id; ?>">Values</a></div><?php } ?></td>
         
         <td><div align="left" ><a class="btn btn-danger" href="index.php?action=model&module=fields&fieldid=<?php echo $row_field->fields_id; ?>&post=delete&id=<?php echo $row_field->fields_categories_id; ?>">Delete</a></div></td>
       </tr>
       
       
       <?php
	   }
	   ?>
      
       <tr>
         <td colspan="7"><div align="center">
           <input type="submit" name="save" class="btn btn-primary" id="button" value="Save" />
         </div></td>
         </tr>
     </table>
   </form>
   </div>
</div>
</div>
<script>
	   $(".quickedit").change(function(){
	   
	  var valueField = $( "input[type=radio][name=quickedit]:checked" ).val();
  

postdata = {
'action' : "view",
'module' : "fields",
'post' : "update field",
'valu' : valueField,
'id' : <?php echo $_REQUEST['catid']; ?>,
}


$.post("index.php",postdata,function(data){
//$("#ajax_contact_div").html(data);														  
});


});
	   </script>

    <?php
	}
	
	public function dropdownvalue(){
	?>
    <script>
	function update_value(e){
			var valueField= e.value;
			var idField= e.id; 
			var nameField= e.name; 
			
			postdata = {
			'action' : "model",
			'module' : "fields",
			'post' : "dropdownvalueupdate",
			'id' : idField,
			'name' : nameField,
			'valu' : valueField,
			
			}
			
			
			$.post("index.php",postdata,function(data){
			//$("#id").html(data);														  
			});
		
		}
	</script>
    <div class="container">
		
		
		
		<div class="row" >
        
                    <div class="col-12 pt-2">

   
	<?php
	$categories_id = $_REQUEST['catid'];
	$field_id = $_REQUEST['id'];
	$cat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories` where `categories_status`= 1 and `categories_id`= $categories_id");
	
	$row_title = mysqli_fetch_object($cat_query);
	
	$this->header();
	
	?>
  

   <form id="general" name="general" method="post" action="index.php">
   <input type="hidden" name="action" value="model" />
   <input type="hidden" name="module" value="fields" />
   <input type="hidden" name="post" value="dropdownvalueupdate" />
   <input type="hidden" name="catid" value="<?php echo $categories_id; ?>" />
    
   <div align="center"><h3><?php echo $field_id; ?> > <span class="label_title"><?php echo $row_title->categories_name; ?></span></h3></div>
   <div align="left"><a class="btn_sub" href="index.php?action=model&module=fields&catid=<?php echo $categories_id; ?>&post=add&type=DropDown&id=<?php echo $field_id; ?>">Add Value</a></div>
   <table class="table">
     
     
      
       <thead>
       <tr>
         <th>Type</th>
         <th>Values</th>
         <th>Order</th>
         <th>Action</th>
       </tr>
       </thead>
       <?php
	   $field_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields` where field_DV_id='$field_id' ORDER BY `pic_categories_fields`.`field_priority` ASC");
	   while($row_field = mysqli_fetch_object($field_query)){
	   
	   ?>
       
       <tr>
         <td ><?php echo $row_field->fields_type; ?></td>
         <td >
         
           <input class="form-control" type="text" name="field_value" id="<?php echo $row_field->fields_id; ?>" value="<?php echo $row_field->field_value; ?>" onchange="update_value(this);" />
         </td>
         <td ><input class="form-control" type="number" name="field_priority" id="<?php echo $row_field->fields_id; ?>" style="" value="<?php echo $row_field->field_priority; ?>" onchange="update_value(this);" /></td>
         
         <td><a class="btn btn-danger" href="index.php?action=model&module=fields&fieldid=<?php echo $row_field->fields_id; ?>&post=dropdownvaluedelete&id=<?php echo $row_field->fields_categories_id; ?>">Delete</a></td>
       </tr>
       
       
       <?php
	   }
	   ?>
       
       
     </table>
   </form>
   </div>
</div>
</div>
    <?php
	}
	
	public function chainselectvalues(){
	$categories_id = $_REQUEST['catid'];
	$title = $_REQUEST['title'];
	?>
	<select class="form-control" name="setvalues[]" id="setvalues" size="5" multiple="multiple">
         
				<?php
                $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `fields_categories_id`= $categories_id and `fields_type`='DropDown' and `fields_title`='$title' ORDER BY `pic_categories_fields`.`field_priority` ASC");
                while($row = mysqli_fetch_object($query)){
                ?>
             <option <?php if(strpos($row_field->field_value,"to:".$row->fields_title) !== false){ ?>  selected="selected" <?php } ?> value="<?php echo $row->field_value; ?>"><?php echo $row->field_value; ?></option>
             
             <?php
			 }
			 ?>
           </select>
           
           <?php
           }

	public function chainfield(){
	
	
	?>
    <div class="container">
		
		
		
		<div class="row">
        
                    <div class="col-12 pt-2">

   
	<?php
	$categories_id = $_REQUEST['catid'];
	$cat_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories`  where `categories_status`= 1 and `categories_id`= $categories_id");
	
	$row_title = mysqli_fetch_object($cat_query);
	
	$this->header();
	
	?>
 
   <form id="general" name="general" method="post" enctype="multipart/form-data" action="index.php">
   <input type="hidden" name="action" value="model" />
   <input type="hidden" name="module" value="fields" />
   <input type="hidden" name="post" value="updatechain" />
   <input type="hidden" name="catid" value="<?php echo $categories_id; ?>" />
   <div  align="center"><h3>Fields Information > <span class="label_title"><?php echo $row_title->categories_name; ?></span></h3></div>
   <div align="left"><a class="btn_sub" href="index.php?action=model&module=fields&catid=<?php echo $categories_id; ?>&post=add&type=Chain">Add Chain Fields</a></div>
   <table class="table">
      
       <thead>
       <tr>
         <th>Type</th>
         <th>Title</th>
         <th>Parent</th>
         <th>Sub</th>
         <th colspan="2">Action</th>
       </tr>
       </thead>
         <?php
	   $field_query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `fields_categories_id`= $categories_id and `fields_type`= 'Chain' group by fields_title ORDER BY `pic_categories_fields`.`field_priority` ASC");
	   $chk_rows = mysqli_num_rows($field_query);
	   while($row_field = mysqli_fetch_object($field_query)){
	   ?>
       
       <tr>
         <td><?php echo $row_field->fields_type; ?></td>
         <td>
       <input type="hidden" name="id" value="<?php echo $row_field->fields_id; ?>" />
           <input class="form-control" type="text" name="field_name" id="field_name" value="<?php echo $row_field->fields_title; ?>" />
           
         </td>
         <td>
         <?php echo $this->selectFields($row_field->field_value,$categories_id,"from:",$row_field->field_chain_value); ?>
         </td>
         <td >
          <?php echo $this->selectFields($row_field->field_value,$categories_id,"to:",$row_field->field_chain_value); ?>
         </td>
         
         <td><a class="btn btn-danger" href="index.php?action=model&module=fields&fieldid=<?php echo $row_field->fields_id; ?>&post=delete&id=<?php echo $row_field->fields_categories_id; ?>"><span class="label_title">Delete</a></td>
         <td>
         <input type="hidden" name="fieldid" value="<?php echo $row_field->fields_id; ?>" />
         <input type="submit" name="update_chain" class="btn btn-primary" id="button" value="Asign" /></td>
       </tr>
       
       <?php  if($chk_rows!=0){ ?>
       
       <tr>
       <?php
		$field_value_trim = trim($row_field->field_value, "from:");
		$field_value_trim = str_replace('to:', '', $field_value_trim);
		$field_value_array = explode(',', $field_value_trim);
		?>
         <td valign="top">Values</td>
         <td valign="top"><label>
       <input type="hidden" name="id" value="<?php echo $row_field->fields_id; ?>" />
           
           
         </label></td>
         <td valign="top">
        
          <?php echo $this->selectValues($field_value_array[0],$field_value_array[1],$row_field->field_chain_value,$categories_id,"Source"); ?>
         </td>
         <td valign="top" id="chainselectvalues">
         
         
         </td>
         
         <td colspan="2" valign="top"><a class="btn btn-dark" href="index.php?action=model&module=fields&fieldid=<?php echo $row_field->fields_id; ?>&post=resetchain&id=<?php echo $row_field->fields_categories_id; ?>">Reset</a>
           <input type="hidden" name="fieldid" value="<?php echo $row_field->fields_id; ?>" />        </td>
         </tr>
       
       <?php } ?>
       
       
       <?php
	   }
	   ?>
       
       
      
       <tr>
         <td colspan="6"><div align="center">
           <input type="submit" name="save" class="btn btn-primary" id="button" value="Save" />
         </div></td>
         </tr>
     </table>
   </form>
   </div>
</div>
</div>
    <?php
	
	
	}
	
	public function selectValues($title,$destination,$mainRowChainValue,$categories_id,$source){ 
	
	?>
<script>
	function chainselectvalues(catid,destination){
	
		var parent_id = $("#field_parent").val();
		
		postdata = {
		'action' : 'view',
		'module' : 'fields',
		'post' : 'selectAjaxValues',
		'destination' : destination,
		'parent_id' : parent_id,
		}
		
		$.post("index.php",postdata,function(data){
		$("#chainselectvalues").html(data);														  
		});
	
	}
</script>
	<select class="form-control" name="field_parent" id="field_parent" size="5"  onclick="chainselectvalues(<?php echo $categories_id; ?>,'<?php echo $destination; ?>')">
         
				<?php
                $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `field_DV_id`='$title' ORDER BY `pic_categories_fields`.`field_priority` ASC");
                while($row = mysqli_fetch_object($query)){
                ?>
             <option   <?php if(strpos($mainRowChainValue,$row->field_value) !== false){ ?>  selected="selected" <?php } ?> value="<?php echo $row->fields_id; ?>"><?php echo $row->field_value; ?></option>
             
             <?php
			 }
			 ?>
           </select>
	<?php }
	
	public function selectAjaxValues(){ 
	
	?>
	<select class="form-control" name="field_sub[]" id="field_sub" size="5"  multiple="multiple" >
         
				<?php
                $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `field_DV_id`= '".$_POST['destination']."' ORDER BY `pic_categories_fields`.`field_priority` ASC");
                while($row = mysqli_fetch_object($query)){
                ?>
             <option   <?php if(strpos($row->field_chain_value,",".$_POST['parent_id']) !== false){ ?>  selected="selected" <?php } ?> value="<?php echo $row->fields_id; ?>"><?php echo $row->field_value; ?></option>
             
             <?php
			 }
			 ?>
           </select>
	<?php }
	
	public function selectFields($mainRowChainValue,$categories_id,$addressText,$chainValue){ ?>
	<select class="form-control" name="assignvalue[]" id="assignvalue" <?php if($chainValue!=""){ ?> disabled="disabled" <?php } ?> >
          <option value="0">Select</option>
				<?php
                $query = mysqli_query($this->mysqlConfig(),"SELECT * FROM `pic_categories_fields`  where `fields_categories_id`= $categories_id and `fields_type`='DropDown' and `field_DV_id`=0 ORDER BY `pic_categories_fields`.`field_priority` ASC");
                while($row = mysqli_fetch_object($query)){
                ?>
             <option <?php if(strpos($mainRowChainValue,$addressText.$row->fields_id) !== false){ ?>  selected="selected" <?php } ?>	 value="<?php echo $row->fields_id; ?>"><?php echo $row->fields_title; ?></option>
             
             <?php
			 }
			 ?>
           </select>
           <?php
	}

}
?>



