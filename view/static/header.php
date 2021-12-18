
<?php

function conn(){
	$servername = "localhost";
		$username = "devavv";
		$password = "vvinWIN@2019";
		$dbname = "abocarz";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	return $conn;
}

function all_sub_category($id)
{
?>
	<ul class="dropdown-menu" style="overflow-y: auto;height: 300px;">
		<?php
		$cat_query = mysqli_query(conn(), "select * from pic_categories where categories_parent=0 and categories_status=1 and categories_sub=$id order by category_order ASC");
		while ($row = mysqli_fetch_array($cat_query)) {
		?>
			<li><a class="dropdown-item" href="index.php?action=view&module=products&cat_id=<?php echo $row['categories_id']; ?>&type=0&p=1&sort=0&offset=0">
					<div class="d-flex flex-row">
						<div class="p-1"><img width="15" height="15" src="admincp/media/<?php echo $row['categories_image']; ?>" /></div>
						<div class="p-1"><?php echo $row['categories_name']; ?></div>
					</div>
				</a></li>

		<?php
		}
		?>
	</ul>
<?php
}
?>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBgz9gQANhwRBhu6oPIuO1LPd6KcMUDoKo&sensor=false&libraries=places"></script>
<style>
	.pac-container {
		z-index: 1051 !important;
	}
</style>
<script type="text/javascript">
	function initializeAutocomplete() {
		var input = document.getElementById('locality');
		var options = {}

		var autocomplete = new google.maps.places.Autocomplete(input, options);
		// autocomplete.setComponentRestrictions({
		//         country: ["in"],
		//       });


		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			var place = autocomplete.getPlace();
			var lat = place.geometry.location.lat();
			var lng = place.geometry.location.lng();
			var placeId = place.place_id;
			var city = "";
			var state = "";
			// to set city name, using the locality param
			var componentForm = {
				locality: 'long_name',
				administrative_area_level_2: "long_name",
				administrative_area_level_1: "long_name",
			};

			for (const component of place.address_components) {
				const addressType = component.types[0];

				if (componentForm[addressType]) {
					const val = component[componentForm[addressType]];
					if (addressType == "locality")
						$("#town").val(val);
					if (addressType == "administrative_area_level_2")
						city = val;
					if (addressType == "administrative_area_level_1")
						state = val;
				}
			}
			 $("#city_header").val(place.formatted_address);
			//$("#city_header").val( $("#town").val() + ", " + city + ","  + state);
			$("#lan").val(lat);
			$("#lon").val(lng);
			$('#setlocation').click();
			//document.getElementById("location_id").value = placeId;
		});
	}
</script>
<script type="text/javascript">
	var locationChipArr = [];
	function initializeAutocompletePostAd() {
		var input = document.getElementById('localitypostad');
		var options = {}

		var autocomplete = new google.maps.places.Autocomplete(input, options);

		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			var place = autocomplete.getPlace();
			//console.log(place.formatted_address);
			var latpostad = place.geometry.location.lat();
			var lngpostad = place.geometry.location.lng();
			var placeId = place.place_id;
			var city = "";
			var state = "";
			// to set city name, using the locality param
			var componentForm = {
				locality: 'long_name',
				administrative_area_level_2: "long_name",
				administrative_area_level_1: "long_name",
			};

			for (const component of place.address_components) {
				const addressType = component.types[0];

				if (componentForm[addressType]) {
					const val = component[componentForm[addressType]];
					if (addressType == "locality")
						$("#townpostadpost").val(val);
					if (addressType == "administrative_area_level_2")
						city = val;
					if (addressType == "administrative_area_level_1")
						state = val;
				}
			}
			 $("#city_postadpost").val(place.formatted_address);
			 //$("#city_postadpost").val($("#townpostadpost").val() + ", " + city + "," + state);
			
			$("#lati").val(latpostad);
			$("#longi").val(lngpostad);

			var chipStr = "";
			if (locationChipArr.length < 3) {
				for (var i = 0; i < locationChipArr.length; i++) {
					if (locationChipArr[i].locName == place.formatted_address) {
					//if (locationChipArr[i].locName == $("#townpostadpost").val() + ", " + city + "," + state) {
					
						$("#localitypostad").val('');
						$("#locErrTxtId").show();
						$("#locErrTxtId").html("City and State Already Added.");
						setTimeout(function() {
							$("#locErrTxtId").hide();
						}, 3000);
						return;
					}
				}

				locationChipArr.push({
					locName: $("#townpostadpost").val() + ", " + city + "," + state,
					latpostad: latpostad,
					lngpostad: lngpostad
				});
				for (var i = 0; i < locationChipArr.length; i++) {
					chipStr = chipStr +
						`<div class="chip">
						<div class="chipLocNameCls" title="` + locationChipArr[i].locName + `" >` + locationChipArr[i].locName + `</div>
						<i onclick="deleteLocCHip(` + i + `)" class="chipCloseCls fas fa-times"></i>
					</div>`;
				}
				$("#locationChipHolder").html(chipStr);
				$("#multiLocChip").val(JSON.stringify(locationChipArr));
			} else {
				$("#locErrTxtId").show();
				$("#locErrTxtId").html("Maximum 3 Location only allowed");
				setTimeout(function() {
					$("#locErrTxtId").hide();
				}, 3000);
			}
			console.log(locationChipArr)
			$("#localitypostad").val('');
			//document.getElementById("location_id").value = placeId;
		});
	}

	function deleteLocCHip(locChipId) {
		console.log(locChipId);
		var tempArr = [], chipStr='';
		for (var i = 0; i < locationChipArr.length; i++) {
			if (i == locChipId) {
				locationChipArr.slice(i, 1);
			}else{
				tempArr.push(locationChipArr[i]);
			}
		}
		locationChipArr = tempArr;
		for (var i = 0; i < locationChipArr.length; i++) {
			chipStr = chipStr +
				`<div class="chip">
						<div class="chipLocNameCls" title="` + locationChipArr[i].locName + `">` + locationChipArr[i].locName + `</div>
						<i onclick="deleteLocCHip(` + i + `)" class="chipCloseCls fas fa-times"></i>
					</div>`;
		}
		$("#locationChipHolder").html(chipStr);
		$("#multiLocChip").val(JSON.stringify(locationChipArr));
	}
</script>

<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
<link href="dist/css/all.css" rel="stylesheet">
<link href="dist/css/bootstrap.css" rel="stylesheet">
<link href="dist/css/product.css" rel="stylesheet">
<link rel="stylesheet" href="dist/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="assets/css/style.css" rel="stylesheet">
<link href="dist/css/select2.min.css" rel="stylesheet" />
<link href="dist/css/select2-bootstrap4.css" rel="stylesheet" />
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">


<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
<div class="container-fluid sticky-top pt-2 pb-2" style="background: #fff;box-sizing: border-box;box-shadow: 0 1px 4px 0 rgba(0,0,0,.1);">
	<div class="row">
		<div class="container">
			<div class="row pt-0 pr-3 pl-3 mobileAdjClsRow">
				<div class="col-3 col-sm-3 col-md-3 col-lg-6 p-0">
					<a href="index.php"><img class="logo" src="assets/images/logo.jpg" /></a>

				</div>
				<div class="col-9 col-sm-9 col-md-9 col-lg-6 p-0 mobileAdjClsCol">
					<div class="d-flex flex-row-reverse bd-highlight">
						<div class="bd-highlight">
							<?php if (empty($_SESSION['pic']['biscuit']['userid'])) { ?>
								<a class="btn" href="index.php?action=view&module=account&post=login_submit">Login</a>
							<?php
							} else {
							?>
								<div class="dropdown">
									<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

										<i class="fa fa-user"></i>
										<?php echo $_SESSION['pic']['biscuit']['username']; ?>
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="index.php?action=view&module=myaccount&post=profile">Menu</a>
										<a class="dropdown-item" href="index.php?action=config&module=session">Logout</a>
									</div>
								</div>
							<?php } ?>
							</li>
						</div>
						<div class="bd-highlight">
							<div class="dropdown">
								<button class="btn btn-outline-primary" type="button" id="dropdownMenuButton">
								<a class="dropdown-item" href="index.php?action=view&module=categories&post=post">Post</a>
								</button>
								<div style="display:none;" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="index.php?action=view&module=categories&post=post"><i class="fa fa-share-square"></i> Ads</a>
									<a class="dropdown-item" href="index.php?action=view&module=categories&post=request"><i class="fa fa-share-square"></i> Quote</a>


								</div>
							</div>
						</div>
					</div>
					<div class="d-flex flex-row-reverse bd-highlight pt-2">
						<div class="location bd-highlight">
						<button class="btn btn-outline-primary" type="button" >


							<i class="fa fa-map-marker"></i>
							<a href="#location" data-toggle="modal">
								<?php


								$country = "India";

								if (isset($_POST['setlocation'])) {

									$_SESSION['pic']['biscuit']['city'] = $_POST['city_header'];
									$_SESSION['pic']['biscuit']['taluk'] = $_POST['taluk_select'];
									$_SESSION['pic']['biscuit']['town'] = $_POST['town'];



									$_SESSION['pic']['biscuit']['lan'] = $_POST['lan'];
									$_SESSION['pic']['biscuit']['lon'] = $_POST['lon'];
								}

								if (!empty($_SESSION['pic']['biscuit']['city'])) {

									echo $_SESSION['pic']['biscuit']['city'] . "</br>";
								} else {

									echo "Choose Location" . "</br>";
								}

								?>
							</a>
							</button>	
						</div>

					</div>

				</div>
			</div>
			<div class="row pr-3 pl-3 pt-1">
				<div class="col-12 col-sm-12 col-md-12 col-lg-8 p-0 dropdown d-flex justify-content-left bd-highlight">
					<div class="dropdown bd-highlight pr-1">
						<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-align-left"></i></button>
						<ul class="dropdown-menu menus" aria-labelledby="dropdownMenuButton">

							<?php
							$cat_query = mysqli_query(conn(), "select * from pic_categories where categories_parent=1 and categories_status=1 order by category_order ASC");
							$i = 1;
							while ($row = mysqli_fetch_array($cat_query)) {
							?>

								<li class="dropdown-submenu">

									<a class="dropdown-item dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="">
										<div class="d-flex flex-row">
											<div class="p-1"><img width="15" height="15" src="admincp/media/<?php echo $row['categories_image']; ?>" /></div>
											<div class="p-1"> <?php echo $row['categories_name']; ?></div>
										</div>
									</a>


									<?php
									all_sub_category($row['categories_id']);
									$i++;
									?>
								</li>

							<?php
							}
							?>
						</ul>





					</div>
					<div class="bd-highlight" style="width:100%;">
						<form class="form-inline" name="common_search_for" method="post" action="index.php?action=view&module=search">
							<input type="hidden" name="post" value="form">
							<input type="hidden" name="type" value="0">
							<input type="hidden" name="offset" value="0">
							<input type="hidden" name="p" value="1">
							<input type="hidden" name="sort" value="0">


							<input autocomplete="off" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_pic" id="search_pic">

							<!--<button name="search_common" class="btn btn-outline-light bg-primary" type="submit"><i class="fa fa-search"></i></button>-->

						</form>
						<div id="suggestion_search" style="display:none;overflow: auto;overflow-x: hidden;">
							<span id="loding_search" class="hint">loading</span>
							<div id="search_list" class="search_list">

							</div>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<div class="modal fade bd-example-modal-lg" id="location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

	<div class="modal-dialog" role="document">

		<div class="modal-content">



			<div class="modal-body" id="dynamicform">

				<form name="location_form" id="location_form" method="post" action="index.php" style="z-index: -10;">
					<!--<label for="city_header">Choose District</label>-->


					<input class="form-control" style="margin-top: 6px;width:100%;" type="text" autocomplete="off" placeholder="Enter your town and district...." name="address" onFocus="initializeAutocomplete()" id="locality" required />

					<div id="taluk_header">
						<!--<label for="city_header">Choose Taluk</label>-->
						<div style="display:none" class="form-label-group">
							<select class="form-control select_city" style="width:100%;" name="taluk_select" id="taluk_select">
								<option value="0" selected>Select Taluk</option>
							</select>
						</div>


						<input id="town" class="form-control" style="margin-top: 6px;width:100%;display:none;" type="text" name="town" placeholder="Town..." required />


						<!--<label for="city_header">Company Address</label>-->

						<input id="city_header" class="form-control" style="margin-top: 6px;width:100%; display:none;" type="text" name="city_header" required placeholder="City..." />



						<input class="btn btn-primary" type="submit" name="setlocation" id="setlocation" value="Set Location" style="margin-top: 6px;display:none;" />
						<div id="loading-image-location" style="display:none;text-align: center;background: rgba(255, 255, 255, 0.81);border-radius: 5px;margin: 0px -10px;">
							<img src="css/images/circel.gif">
						</div>
					</div>

					<input type="hidden" name="lan" id="lan" value="">
					<input type="hidden" name="lon" id="lon" value="">

				</form>

			</div>

		</div>

	</div>

</div>
<?php if (!isset($_REQUEST['module'])) { ?>
	<!-- <div class="container pt-2 pb-2" style="background:url(assets/images/MT.jpg); max-width:none;">
		<div class="row">
			<div class="col-6 col-sm-6 col-md-6 col-lg-6 text-center">
				<img width="100" src="assets/images/sell.png" />
				<h2 class="banner_title">Want to Sell a Car?</h2>
				<p class="subtitles">Click to Publish your Ads</p>
				<a class="btn btn-outline-primary btn-lg" href="index.php?action=view&module=categories&post=post"><i class="fa fa-share-square"></i> Post Sell Ads</a>
			</div>
			<div class="col-6 col-sm-6 col-md-6 col-lg-6 text-center">
				<img width="100" src="assets/images/quote.png" />
				<h2 class="banner_title">Want to Buy a Car?</h2>
				<p class="subtitles">Click to Publish your Quote</p>
				<a class="btn btn-outline-primary btn-lg" href="index.php?action=view&module=categories&post=post"><i class="fa fa-share-square"></i> Request Quote</a>
			</div>
		</div>
	</div> -->

<?php } ?>