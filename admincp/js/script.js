function cat_images(){
	
		
		$("#cat_images").removeClass(cat_pic);
		
		var cat_pic = $("#cat_pic").val();
		
		$("#cat_images").addClass(cat_pic);
		
	
}
$("#field_name").change(function(){
  alert("The text has been changed.");
});

function quickedit(e){
var valueField= e.value;
var idField= e.id; 
var nameField= e.name; 

postdata = {
'action' : "view",
'module' : "fields",
'post' : "update field",
'id' : idField,
'name' : nameField,
'valu' : valueField,

}


$.post("index.php",postdata,function(data){
//$("#ajax_contact_div").html(data);														  
});

}
function updatedate_1(s,id){
  var check = $(s).is(':checked');
  if(check == true){
	postdata = {
		'action' : 'model',
		'module' : 'Ads',
		'post' : 'update_validity_1',
		'id' : id,
		'val' : 1,
		}
		
	$.post("https://abocarz.com/admincp/index.php?action=view&module=Ads&post=update_validity_1",postdata,function(data){
	//$("#sub_cat_div").html(data);
	});
		
  }
   if(check == false){
	postdata = {
		'action' : 'model',
		'module' : 'Ads',
		'post' : 'update_validity_1',
		'id' : id,
		'val' : 0,
		}
		
	$.post("https://abocarz.com/admincp/index.php?action=view&module=Ads&post=update_validity_1",postdata,function(data){
	//$("#sub_cat_div").html(data);
	});
		
  }
  
  }
  
  function updatedate_2(s,id){
  var datas = s.value;
  $('#'+id).attr('checked',false);
 
	postdata = {
		'action' : 'model',
		'module' : 'Ads',
		'post' : 'update_validity_2',
		'id' : id,
		'values' : datas,
		}
		
	$.post("https://abocarz.com/admincp/index.php?action=view&module=Ads&post=update_validity_2",postdata,function(data){
	//$("#sub_cat_div").html(data);
	});

  
  }
function cat_sub(){
		
		var cat_root = $("input[name=cat_root]:checked").val();
		
		if(cat_root=="0"){
			
			postdata = {
			'action' : 'view',
			'module' : 'category',
			'post' : 'sub category',
			'step' : '1',
			}
			
		$.post("index.php",postdata,function(data){
			$("#sub_cat_div").html(data);														  
		});

		}
		else if(cat_root=="1"){
			
			$("#sub_category").prop('disabled', true);
			
		}
	
}

function cat_sub_select(){
		
		var cat_root = $("input[name=cat_root]:checked").val();
		
		var sub_category = $("#sub_category").val();
		
		if(cat_root=="0"){
			
			postdata = {
			'action' : 'view',
			'module' : 'category',
			'post' : 'sub category',
			'step' : '2',
			'sub_category_id' : sub_category,
			}
			
		$.post("index.php",postdata,function(data){
			$("#sub_cat_div").html(data);														  
		});

		}
	
}

function verify(){
	
		
		var uname = $("#uname").val();
		var pass = $("#pass").val();
	
			postdata = {
			'uname' : uname,
			'pass' : pass,
			
			}
			
			
			$.post("index.php",postdata,function(data){
				if(data=="Invalid Login Details"){
					document.getElementById( 'error_msg' ).style.display = 'block';
					$("#error_msg").html(data);	
				}
				else if(data=="Success"){
					document.getElementById( 'error_msg' ).style.display = 'block';
					$("#error_msg").html(data);	
					postdata = {
					'login' : 'ok'
					}
					$.post("index.php",postdata,function(data){
																				  
					});
				}
			});
	
}
function report_business(){
window.open("https://abocarz.com/admincp/index.php?action=view&module=report&post=list", "_blank", "toolbar=no,scrollbars=yes,resizable=no,top=0,left=0,width=1300,height=768");
}



function fieldUpdated(sel){
	
		var valuestr = sel.id;
		var valueval = sel.value;  
		//alert(valueval);
			
		//var plan = $("#select_plan").val();
		
		postdata = {
			'action' : "model",
			'module' : "Ads",
			'post' : "field",
			'id' : valuestr,
			'value' : valueval,
			}
			
		$.post("index.php",postdata,function(data){
			//$("#period_select").html(data);														  
		});
	
}

function fieldChain(sel,id,current_id,cat_id,ads_id){
	
		var valuestr = current_id;
		var valueval = sel.value;  
		var valuestrid = sel.id;
		
		postdata2 = {
			'action' : "model",
			'module' : "postad",
			'post' : "field",
			'fid' : valuestrid,
			'value' : valueval,
			}
			
		$.post("../index.php",postdata2 ,function(data){
			//$("#period_select").html(data);														  
		});
		
		postdata = {
			'action' : "view",
			'module' : "postad",
			'post' : "chain",
			'fid' : valuestr,
			'value' : valueval,
			'cat_id' : cat_id,
			'filid' : id,
			'id' : ads_id,
			}
			
		$.post("../index.php",postdata,function(data){
			$("#ajax_select").html(data);														  
		});
		
}