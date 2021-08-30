function updateAjax(e){
var valueField= e.value;
var idField= e.id; 
var nameField= e.name; 

postdata = {
'action' : "model",
'module' : "customers",
'post' : nameField,
'id' : idField,

}


$.post("index.php",postdata,function(data){
$('#tr_'+idField).html(data);														  
});

}

function updateAjaxAds(e,posted){
	var valueField= e.value;
	var idField= e.id; 
	var nameField= e.name; 
	
	postdata = {
	'action' : "model",
	'module' : "Ads",
	'val' : nameField,
	'id' : idField,
	'post' : posted,
	}
	
	$.post("index.php",postdata,function(data){
	//$('#tr_'+idField).html(data);														  
	});

}
function updateAjaxAds2(e,posted){
	var valueField= e.value;
	var idField= e.id; 
	
	postdata = {
	'action' : "model",
	'module' : "Ads",
	'id' : idField,
	'post' : posted,
	}
	
	
	$.post("index.php",postdata,function(data){
	$('#tr_'+idField).html(data);														  
	});

}

$(document).ready( function () {
    $('#myTable').DataTable();
} );

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




//Croppie

var $uploadCrop,
tempFilename,
rawImg,
imageId;

function readFile(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('.upload-demo').addClass('ready');
			$('#cropImagePop').modal('show');
			rawImg = e.target.result;
		}
		reader.readAsDataURL(input.files[0]);
	}
	else {
		swal("");
	}
}

$uploadCrop = $('#upload-demo').croppie({
	viewport: {
		width: 250,
		height: 150,
	},
	enforceBoundary: false
	
});
$('#cropImagePop').on('shown.bs.modal', function(){
        // alert('Shown pop');
        $uploadCrop.croppie('bind', {
                url: rawImg
        }).then(function(){
                console.log('jQuery bind complete');
        });
});

$('.item-img').on('change', function () { 

var ext = $(this).val().split('.').pop().toLowerCase();

	if($.inArray(ext, ['jpg','jpeg']) == -1) {
		alert('Invalid file format. choose only .JPEG format');
	}
	else{
		imageId = $(this).data('id'); tempFilename = $(this).val();
		$('#cancelCropBtn').data('id', imageId); readFile(this); 
	}
	
	
	});
$('#cropImageBtn').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'base64',
		format: 'jpeg',
		quality: 1,
		size: 'original',
		backgroundColor:'white'
	}).then(function (resp) {
		$('#item-img-output').attr('src', resp);
		$('#crop_final_data').attr('value', resp);
	$('#cropImagePop').modal('hide');


$('#cropImagePop').modal('hide');
});
});

//End Croppie


//Menu
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
// End Menu


// form validation
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
// end form validation

// Modal common ajax
function modal(e,module,post,display){
        clear_value();
        var id=$(e).attr('attr-id');
        $.ajax({url:"index.php?module="+module+"&action=view&post="+post+"&id="+id,cache:false,success:function(result){
        $("#"+display+"").html(result);
        }});
}
// End Modal common ajax

function clear_value(){
        $(".form-control").attr("value","");
}


