<?php
class likes extends config{

	public function likes_list(){ ?>
    
    <style>
	.img_tbl{
	text-align: center;
    border-radius: 5px;
    height: 100px;
    border: 5px solid #ccc;
	}
	</style>


  
  
  


	<div class="container">
		
		
		
		<div class="row" >
        
       
       <div class="col-10 pt-4" >


	<table id="account_dt" class="display">
    <thead>
  <tr>
  
  <th ><div align="center"><strong>S.No</strong></div></th>
  <th><div align="left"><strong>Ads ID</strong></div></th>
  <th><div align="left"><strong>Ads Name</strong></div></th>
  <th><div align="left"><strong>Customer Name</strong></div></th>
    <th><div align="left"><strong>Customer Email</strong></div></th>
    <th><div align="center"><strong>Customer Mobile</strong></div></th>
    <th  align="center"><div align="left"><strong>Contact No</strong></div></th>
	
  </tr>
  </thead>
  
  
</table>
</div>
<script>

		
			$(document).ready(function(argument) {
			var table = $('#account_dt').DataTable({
				serverSide: true,
				ajax:{
						url :"responselikes.php", // json datasource
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

}
?>
	
