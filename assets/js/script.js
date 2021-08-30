

function quick_register(){

	

		alert("hi");

		//var plan = $("#select_plan").val();

		

		

		

		postdata = {

			'post' : 'quick',

			'action' : 'model',

			'module' : 'registration',

			}

			

		$.post("index.php",postdata,function(data){

			$("#notification").html(data);														  

		});

	

}



function caste_selection(){



		$("#caste_container_old").hide();

		

		var religion_id = $("#religion").val();

		

		postdata = {

		'religion' : religion_id,

		'post' : 'caste',

		'action' : 'view',

		'module' : 'search',

		

		}

		

		$.post("index.php",postdata,function(data){

		$("#caste_container").html(data);														  

		});



}

function caste_selection_dashboard(){



		$("#caste_dashboard_old").hide();

		

		var religion_id = $("#religion_dashboard").val();

		

		postdata = {

		'religion' : religion_id,

		'post' : 'caste',

		'action' : 'view',

		'module' : 'dashboard',

		

		}

		

		$.post("index.php",postdata,function(data){

		$("#caste_dashboard").html(data);														  

		});



}

$(function () {

  $('[data-toggle="tooltip"]').tooltip()

})