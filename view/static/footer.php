

<footer class="container py-5">
  <div class="row">
    <div class="col-12 col-md">
      <img src="assets/images/logo.png" />
      <small class="d-block mb-3 text-muted">&copy; <?php echo date("Y"); ?>.Abocarz. </br>All rights reserved</small>
    </div>
    <div class="col-6 col-md">
      
      <ul class="list-unstyled text-small">
        <li><a class="text-muted" href="#"><h6>About Us</h6></a></li>
        
      </ul>
    </div>
    <div class="col-6 col-md">
      
      <ul class="list-unstyled text-small">
        <li><a class="text-muted" target="_blank" href="policy.html"><h6>Privacy Policy</h6></a></li>
      </ul>
    </div>
    <div class="col-6 col-md">
      
      <ul class="list-unstyled text-small">
         <li><a class="text-muted" href="#"><h6>How it Works</h6></a></li>
      </ul>
    </div>
    <div class="col-6 col-md">
      
      <ul class="list-unstyled text-small">
        <li><a class="text-muted" href="#"><h6>Contact Us</h6></a></li>
        
      </ul>
    </div>
  </div>
</footer>

    <script src="dist/js/jquery-3.4.1.min.js"></script>
    <script src="dist/js/popper.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="dist/js/moment.min.js"></script>
    <script src="dist/js/bootstrap-datetimepicker.min.js"></script>






    <!-- select2 -->
<script src="dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
<script type="text/javascript" src="js/jqzoom.js"></script>

<script type="text/javascript">
$("#bzoom").zoom({
	zoom_area_width: 300,
    autoplay_interval :3000,
    small_thumbs : 4,
    autoplay : false
});

</script>
<script src="js/script.js"></script>
<script>
$('#pro_tag').summernote({
placeholder: '',
tabsize: 2,
height: 200
});
<?php if(!isset($_REQUEST['id'])){ ?>
$('#pro_tag').summernote('code', '<table class="table table-bordered"><tbody><tr><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td></tr><tr><td><br></td><td><br></td></tr></tbody></table><p><br></p>');
<?php } ?>
								</script>
                                <script>
$(document).ready(function() {
$('#example_add_history').DataTable({
"order": [[ 0, "desc" ]],
"paging":   true,
"info":     true,
"searching": true,
"language": {
"emptyTable":"No Ads Founds"
},
 responsive: true,
 
});
} );
</script>
<script>
		  $(document).ready(function() {
				$('#example').DataTable({
				"paging":   true,
				"info":     true,
				"searching": true,
				"language": {
        			"emptyTable": "No Records Found"
   				}
				});
			} );
		  </script>
<script type="text/javascript">
function pass_ads_id(pass_value,user_id,user_name,user_mobile,user_email,module_name){
	document.getElementById('ads_id').value = pass_value;
	document.getElementById('ads_id_new').value = pass_value;
	document.getElementById('ads_user_id').value = user_id;
	
	document.getElementById('ads_type').value = module_name;
	document.getElementById('cus_name').value = user_name;
	document.getElementById('cus_mobileno').value = user_mobile;
	document.getElementById('cus_email').value = user_email;
	
	
	//alert(pass_value);
}
</script>
<script>
$(function () {
  $('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: 'style',
      placeholder: $(this).attr('placeholder'),
    });
  });
});

</script>
<script>
        $('.like').click(function(){
        
        var ads_id=$(this).attr('ads_id');
        var ads_uid=$(this).attr('ads_uid');
        var user_name=$(this).attr('user_name');
        var user_mob=$(this).attr('user_mob');
        var user_email=$(this).attr('user_email');
        var moduleview=$(this).attr('module');
       
        
        
        $.ajax({url:"index.php?module=misc&action=helper&post=likeForm&ads_id="+ads_id+"&ads_uid="+ads_uid+"&user_name="+user_name+"&user_mob="+user_mob+"&user_email="+user_email+"&moduleview="+moduleview,cache:false,success:function(result){
        $("#dynamicformlike").html(result);
        }});
        });
        </script>
        <script>
        $('.liked').click(function(){
        
        var ads_id=$(this).attr('ads_id');
        var ads_uid=$(this).attr('ads_uid');
        var user_name=$(this).attr('user_name');
        var user_mob=$(this).attr('user_mob');
        var user_email=$(this).attr('user_email');
        var moduleview=$(this).attr('module');
       $('#ads_ids').val(ads_id);
        });
        </script>
<script>
$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
  }
  var $subMenu = $(this).next('.dropdown-menu');
  $subMenu.toggleClass('show');


  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass('show');
  });


  return false;
});
</script>

<script src='js/croppie.js'></script>
<script>
			  // Start upload preview image

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
		width: 150,
		height: 200,
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
				// End upload preview image  

</script>