<?php

class products extends config{

public function headerscript()
	{
?>
		<script src="dist/js/jquery-3.4.1.min.js"></script>
		<script src="dist/js/popper.min.js"></script>
		
		<div class="modal fade bd-example-modal-lg" id="liked" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Like Ads</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<div class="row d-flex justify-content-center"><i class="fa fa-check-circle fa-4x"></i></div>
						<div class="row d-flex justify-content-center p-4 text-center">
							<h5>You Requested Already!<br />Thank you for Contacting us!.</h5>
						</div>
						<div class="row d-flex justify-content-center pb-4">
							<form name="like_save_form" method="post" action="index.php">
								<input type="hidden" name="ads_id" id="ads_ids">
								<input type="hidden" name="action" value="view">
								<input type="hidden" name="module" value="product_detail">
								<button style="border:1px dashed #ccc;" class="btn btn-light btn-lg" type="submit" name="viewads">View Ads</button>
							</form>
						</div>
						<div class="row d-flex justify-content-center">
							<h6 class="text-muted">We will Call you soon.</h6>
						</div>

					</div>

				</div>
			</div>
		</div>
		<div class="modal fade bd-example-modal-lg" id="like" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

			<div class="modal-dialog" role="document">

				<div class="modal-content">

					<div class="modal-header">

						<h5 class="modal-title">Like Ads</h5>

						<button type="button" class="close" data-dismiss="modal" aria-label="Close">

							<span aria-hidden="true">&times;</span>

						</button>

					</div>

					<div class="modal-body" id="dynamicformlike">



					</div>

				</div>

			</div>

		</div>


		<script>
			$(function() {
				$('select').each(function() {
					$(this).select2({
						theme: 'bootstrap4',
						width: 'style',
						placeholder: $(this).attr('placeholder'),
					});
				});
			});
		</script>

		<script>
			function search_filter(e) {

				var value = $("#myInput_" + e).val().toLowerCase();
				$("#value_" + e + " li").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});

			}
		</script>
		<script>
			$('.like').click(function() {

				var ads_id = $(this).attr('ads_id');
				var ads_uid = $(this).attr('ads_uid');
				var user_name = $(this).attr('user_name');
				var user_mob = $(this).attr('user_mob');
				var user_email = $(this).attr('user_email');
				var moduleview = $(this).attr('module');



				$.ajax({
					url: "index.php?module=misc&action=helper&post=likeForm&ads_id=" + ads_id + "&ads_uid=" + ads_uid + "&user_name=" + user_name + "&user_mob=" + user_mob + "&user_email=" + user_email + "&moduleview=" + moduleview,
					cache: false,
					success: function(result) {
						$("#dynamicformlike").html(result);
					}
				});
			});
		</script>
		<script>
			$('.liked').click(function() {

				var ads_id = $(this).attr('ads_id');
				var ads_uid = $(this).attr('ads_uid');
				var user_name = $(this).attr('user_name');
				var user_mob = $(this).attr('user_mob');
				var user_email = $(this).attr('user_email');
				var moduleview = $(this).attr('module');

				$('#ads_ids').val(ads_id);


			});
		</script>
	<?php
	}
	public function select()
	{
		$this->headerscript();
		$dates = date("Y-m-d");

	?>


		<?php

		$lan = $_SESSION['pic']['biscuit']['lan'];
		$lon = $_SESSION['pic']['biscuit']['lon'];
		$locality = $_SESSION['pic']['biscuit']['town'];

		if (isset($_SESSION['pic']['biscuit']['city'])) {
			$city = $_SESSION['pic']['biscuit']['city'];
		} else {
			$city = "";
		}

		if (isset($_REQUEST['sort']) and $_REQUEST['sort'] == 1) {

			$order = "pic_price ASC";
		} elseif (isset($_REQUEST['sort']) and $_REQUEST['sort'] == 2) {

			$order = "pic_price DESC";
		} else {
			$order = "CASE WHEN instr(pic_add_town, '$locality') = 0 then 1 else 0 end,distance ASC";
		}

		// owner by
		if (isset($_REQUEST['ownerby_val']) && $_REQUEST['ownerby_val'] != "") {
			$ownerbyString = " pic_user_id = " . $_REQUEST['ownerby_val'] . " and ";
			//$temp_price = "yes";
		} else {
			$ownerbyString = "";
		}

		?>

		<?php
		// Sub Category products query

		$cat_char = $this->subcatid();

		// End - Sub Category products query



		$query_ads = mysqli_query($this->mysqlConfig(), "SELECT * , 111.045 * DEGREES( ACOS( COS( RADIANS( " . $lan . " ) ) * COS( RADIANS(  `pic_add_lan` ) ) * COS( RADIANS(  `pic_add_lon` ) - RADIANS( " . $lon . " ) ) + SIN( RADIANS( " . $lan . " ) ) * SIN( RADIANS(  `pic_add_lan` ) ) ) ) AS distance FROM pic_addpost where " . $ownerbyString . " pic_category in " . $cat_char . " and pic_request=" . $_REQUEST['type'] . " and addpost_status=1 order by " . $order . " LIMIT 5 OFFSET " . $_REQUEST['offset'] . "");
		?>

		<script>
			function loadmore_mobile_layout() {
				loadmore(<?php echo $_REQUEST['p']; ?>, <?php echo $_REQUEST['type']; ?>, <?php echo $_REQUEST['cat_id']; ?>, <?php echo $_REQUEST['sort']; ?>);
			}
		</script>

		<?php
		$check_rows_ads = mysqli_num_rows($query_ads);
		while ($row = mysqli_fetch_object($query_ads)) {
			$this->loopAds($row->pic_ads_id, $row->pic_user_id, $row->pic_title, $row->pic_discription, $row->pic_add_taluk, $row->pic_post_city, $row->pic_postdate, $row->pic_price);
		}
		?>

		<?php if ($check_rows_ads > 4) { ?>
			<div id="loadmore_rows<?php echo $_POST['p'] + 1; ?>" class="d-flex justify-content-center row p-3">
				<a class="btn btn-primary btn-lg loadmore-products loadmore-products" href="javascript:void(0)" onclick="javascript:loadmore_mobile_layout();">Load More Ads</a>
			</div>
		<?php } ?>


	<?php
	}
	public function selectSub()
	{ ?>

		<h6>
			<?php
			$title_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM `pic_categories_fields`  where `fields_id`=" . $_REQUEST['sub'] . " limit 1");
			$title_row = mysqli_fetch_object($title_query);
			echo "Choose " . $title_row->fields_title;
			?>
		</h6>
		<?php

		?>
		<select class="filter_chain form-control filter_sub" name="<?php echo $_REQUEST['sub']; ?>" id="<?php echo $_REQUEST['sub']; ?>" onchange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);">


			<?php
			$strr = "," . $_REQUEST['parent'];
			$chain_value = $_POST['chain_value'];
			foreach ($chain_value as $chainValues) {
				$chainValues = explode(':', $chainValues);
				if ($chainValues[0] == $_REQUEST['sub']) {

					$chainValues = $chainValues[1];
				}
			}

			$sub_quick_filter_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM `pic_categories_fields`  where `field_chain_value` LIKE '%{$strr}%' ");
			?>
			<option value="0">All</option>
			<?php
			while ($row = mysqli_fetch_object($sub_quick_filter_query)) {
			?>
				<option <?php if ($chainValues == $row->fields_id) { ?> selected="selected" <?php } ?> value="<?php echo $row->fields_id; ?>"><?php echo $row->field_value; ?></option>

			<?php
			}
			?>
		</select>
	<?php
	}

	public function list_products()
	{


		$this->headerscript();

	?>
		<script type="text/javascript">
			sessionStorage.setItem('multiLocFil', '');
		</script>
		<?php

		$cat_ids = $_GET['cat_id'];
		$subcat_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_categories` where categories_id=$cat_ids");
		$row_subcat_query = mysqli_fetch_object($subcat_query);
		if ($row_subcat_query->categories_sub != 0) {
			$cat_ids = $row_subcat_query->categories_sub;
		}

		if ($_SESSION['pic']['biscuit']['userid'] != "") {
			$usr = $_SESSION['pic']['biscuit']['userid'];
			$user_types = mysqli_query($this->mysqlConfig(), "select * from pic_user where user_id='$usr' ");
			$row = mysqli_fetch_object($user_types);
			$utype = $row->user_type;

			$user_types_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_user_type` where user_type='$utype'");
			$row_user_types = mysqli_fetch_object($user_types_query);
			$uType = $row_user_types->setoption;
			$category_privacy = "(" . $row_user_types->setcat_view . ")";

			$lan = $_SESSION['pic']['biscuit']['lan'];
			$lon = $_SESSION['pic']['biscuit']['lon'];
			$locality = $_SESSION['pic']['biscuit']['town'];

			$dates = date("Y-m-d");

			if (isset($_SESSION['pic']['biscuit']['city'])) {
				$city = $_SESSION['pic']['biscuit']['city'];
			} else {
				$city = "";
			}
			if (isset($_REQUEST['sort']) and $_REQUEST['sort'] == 1) {
				$order = "pic_price ASC";
			} elseif (isset($_REQUEST['sort']) and $_REQUEST['sort'] == 2) {
				$order = "pic_price DESC";
			} else {

				$order = "CASE WHEN instr(pic_add_town, '$locality') = 0 then 1 else 0 end,distance ASC";
			}

			// owner by
			if (isset($_REQUEST['ownerby_val']) && $_REQUEST['ownerby_val'] != "") {
				$ownerbyString = " pic_user_id = " . $_REQUEST['ownerby_val'] . " and ";
				//$temp_price = "yes";
			} else {
				$ownerbyString = "";
			}

			$check_privacy = mysqli_query($this->mysqlConfig(), "SELECT * , 111.045 * DEGREES( ACOS( COS( RADIANS( " . $lan . " ) ) * COS( RADIANS(  `pic_add_lan` ) ) * COS( RADIANS(  `pic_add_lon` ) - RADIANS( " . $lon . " ) ) + SIN( RADIANS( " . $lan . " ) ) * SIN( RADIANS(  `pic_add_lan` ) ) ) ) AS distance FROM pic_addpost where pic_category in " . $category_privacy . " and pic_request=" . $_REQUEST['type'] . " and addpost_status=1 order by " . $order . "  LIMIT 5 OFFSET " . $_REQUEST['offset'] . "");
		}


		//echo "SELECT * , ( 3956 *2 * ASIN( SQRT( POWER( SIN( ( 10.6307 - pic_add_lan ) * PI( ) /180 /2 ) , 2 ) + COS( 10.6307 * PI( ) /180 ) * COS( pic_add_lan * PI( ) /180 ) * POWER( SIN( ( 79.3131 - pic_add_lon ) * PI( ) /180 /2 ) , 2 ) ) ) ) AS distance FROM pic_addpost HAVING distance <=20 and pic_category in ".$category_privacy." and pic_request=".$_REQUEST['type']." and addpost_status=1 order by distance LIMIT 5 OFFSET ".$_REQUEST['offset']."";

		//$check_privacy = mysqli_query($this->mysqlConfig(),"select * from pic_addpost where pic_category in ".$category_privacy." and pic_request=".$_REQUEST['type']." and addpost_status=1 order by $order LIMIT 5 OFFSET ".$_REQUEST['offset']."");

		

		if (isset($uType) and strpos($uType, 'view') !== false and strpos($category_privacy, $_GET['cat_id']) !== false) { ?>
			<div class="container" id="freezeid">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 pb-0">
						<div class="fixed-top" style="top:auto;right:auto;left: auto;     z-index: 1000;">
							<div class="collapse" id="navbarToggleExternalContent">
								<div class="bg-dark p-4"; style="overflow-y: auto;height: 400px;">
									<div class="row">
										<div class="col-10">
											<h5 class="text-white h4">Product Filter</h5>
										</div>
										<div class="col-2">
											<button type="button" class="close" lass="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="true" aria-label="Toggle navigation">

												<span style="color:#fff;" aria-hidden="true">×</span>

											</button>
										</div>
									</div>


									<?php
									$this->leftMenu();
									?>
								</div>
							</div>
							<nav class="navbar navbar-dark bg-dark">
								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span> Search Filter
								</button>
							</nav>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-12 pb-2 pt-5">
						<?php echo $this->sorting(); ?>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-12 pb-0" id="ads_div">







						<?php

						// Sub Category products query
						$cat_char = $this->subcatid();
						// End - Sub Category products query



						$query_ads = mysqli_query($this->mysqlConfig(), "SELECT * , 111.045 * DEGREES( ACOS( COS( RADIANS( " . $lan . " ) ) * COS( RADIANS(  `pic_add_lan` ) ) * COS( RADIANS(  `pic_add_lon` ) - RADIANS( " . $lon . " ) ) + SIN( RADIANS( " . $lan . " ) ) * SIN( RADIANS(  `pic_add_lan` ) ) ) ) AS distance FROM pic_addpost where " . $ownerbyString . " pic_category in " . $cat_char . " and pic_request=" . $_REQUEST['type'] . " and addpost_status=1 order by " . $order . "  LIMIT 5 OFFSET " . $_REQUEST['offset'] . "");
						//echo "SELECT * , 111.045 * DEGREES( ACOS( COS( RADIANS( ".$lan." ) ) * COS( RADIANS(  `pic_add_lan` ) ) * COS( RADIANS(  `pic_add_lon` ) - RADIANS( ".$lon." ) ) + SIN( RADIANS( ".$lan." ) ) * SIN( RADIANS(  `pic_add_lan` ) ) ) ) AS distance FROM pic_addpost where pic_category in ".$cat_char." and pic_request=".$_REQUEST['type']." and addpost_status=1 and pic_validity > $dates order by ".$order."  LIMIT 5 OFFSET ".$_REQUEST['offset']."";
						$count_rows = mysqli_num_rows($query_ads);

						$query_ads_for_count = mysqli_query($this->mysqlConfig(), "select * , 111.045 * DEGREES( ACOS( COS( RADIANS( " . $lan . " ) ) * COS( RADIANS(  `pic_add_lan` ) ) * COS( RADIANS(  `pic_add_lon` ) - RADIANS( " . $lon . " ) ) + SIN( RADIANS( " . $lan . " ) ) * SIN( RADIANS(  `pic_add_lan` ) ) ) ) AS distance from pic_addpost where " . $ownerbyString . " pic_category in " . $cat_char . " and pic_request=" . $_REQUEST['type'] . " and addpost_status=1  order by $order");
						$ads_for_counts = mysqli_num_rows($query_ads_for_count);

						?>
						<?php
						require 'view/misc/Mobile_Detect.php';
						$detect = new Mobile_Detect();
						// Check for any mobile device.
						$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

						?>
						<script>
							function loadmore_mobile_layout() {
								loadmore(<?php echo $_GET['p']; ?>, <?php echo $_GET['type']; ?>, <?php echo $_GET['cat_id']; ?>, <?php echo $_GET['sort']; ?>);
							}
						</script>
						<div class="row">
							<?php
							$check_rows_ads = mysqli_num_rows($query_ads);
							while ($row = mysqli_fetch_object($query_ads)) {

								$this->loopAds($row->pic_ads_id, $row->pic_user_id, $row->pic_title, $row->pic_discription, $row->pic_add_taluk, $row->pic_post_city, $row->pic_postdate, $row->pic_price);
							}
							?>

						</div>
						<?php

						if ($count_rows > 4) { ?>

							<div id="loadmore_rows2" class="d-flex justify-content-center row"><a class="btn btn-primary btn-lg loadmore-products" href="javascript:void(0)" onclick="javascript:loadmore_mobile_layout();">Load More Ads</a></div>

						<?php } ?>



					</div>




				</div>
			</div>


		<?php } else { ?>

			<div class="container">
				<div class="row">

					<div class="col-sm-12 col-md-12 col-lg-4 pb-0"></div>
					<div class="col-sm-12 col-md-12 col-lg-4 alert alert-light p-2 text-center" role="alert" style="border: 1px dashed #ccc;">

						<i class="fa fa-exclamation-triangle fa-2x"></i>
						<br />
						<br />
						<h6>You are not allowed to view ads!</h6>

					</div>
					<div class="col-sm-12 col-md-12 col-lg-4 pb-0"></div>
				</div>

			</div>
		<?php } ?>



	<?php
	}

	public function list_productswebsite()
	{
			

		$this->headerscript();
	?>
		
		<?php

		$cat_ids = $_GET['cat_id'];
		$subcat_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_website` where id=$cat_ids");
		$row_subcat_query = mysqli_fetch_object($subcat_query);

	    if(isset($_GET['cat_id'])){		
		 ?>
		 <div class="container">
        <div class="row mt-4">
        <?php
		$i = 1;
		$cat_query = mysqli_query($this->mysqlConfig(),"select * from pic_website where status=1 order by website_name ASC");
		while($row = mysqli_fetch_array($cat_query)){
		if($i!=1){		
			$class = "m-left";		
		}
		else{		
			$class = "";		
		}
		?>
        	<div class="col-4 col-sm-3 col-md-3 col-lg-3 pb-3 pt-3 mb-3 mt-3 box text-center cat_thum">
            	<div class="bg-light " style="border: 1px solid #d5d6d8;">
                <a href="<?php echo $row['website_url']; ?>" target="_blank">
            	
					<?php
                    if($row['logo']==""){
                    ?>
                    <i class="fa fa-2x <?php echo $row['logo']; ?>"></i>
                    <?php } else { ?>
                    <img class="p-1" width="75" height="75" src="admincp/media/weblogo/<?php echo $row['logo']; ?>" />
                    <?php } ?>
                    
                
                </a>
                </div>
                <div class="bg-secondary text-black" style="text-transform:lowercase;background-color:#CCCCCC !important"><?php echo $row['website_name']; ?></div>
            </div>
         <?php
		
		$i=$i+1;
		}
		
		 ?>  
       
        </div>
        </div>
        
       
      
  
			
		<?php } else { ?>

			<div class="container">
				<div class="row">

					<div class="col-sm-12 col-md-12 col-lg-4 pb-0"></div>
					<div class="col-sm-12 col-md-12 col-lg-4 alert alert-light p-2 text-center" role="alert" style="border: 1px dashed #ccc;">

						<i class="fa fa-exclamation-triangle fa-2x"></i>
						<br />
						<br />
						<h6>You are not allowed to view ads!</h6>

					</div>
					<div class="col-sm-12 col-md-12 col-lg-4 pb-0"></div>
				</div>

			</div>
		<?php } ?>



	<?php
	}

	public function leftMenu()
	{

	?>

		<div class="filter_mobile">
			<div class="filter-list">

			</div>


			<?php //echo $this->sorting(); 
			?>
		</div>

		<div id="sidebar">






			<form id="filter_form" name="filter_form" method="post" action="index.php" class="form-horizontal" role="form">
				<input type="hidden" name="module" value="products">
				<input type="hidden" name="action" value="view">
				<input type="hidden" name="filter" value="yes">

				<input type="hidden" name="cat_id" value="<?php echo $_REQUEST['cat_id']; ?>">
				<input type="hidden" name="p" value="<?php echo $_REQUEST['p']; ?>">
				<input type="hidden" name="offset" value="<?php echo $_REQUEST['offset']; ?>">
				<input type="hidden" name="sort" value="<?php echo $_REQUEST['sort']; ?>">
				<input type="hidden" name="type" value="<?php echo $_REQUEST['type']; ?>">













				<?php

				// Sub Category products query

				$cat_char = $this->subcatid();

				// End - Sub Category products query

				// main query
				$price_filter_query = mysqli_query($this->mysqlConfig(), "select DISTINCT addpost_fields_title from pic_addpost_field where addpost_fields_categories_id in " . $cat_char . " ORDER BY addpost_field_id ASC ");
				?>
				<div id="accordion">




					<div class="card">

						<div class="card-header" id="locationFIlterId">
							<h5 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#loctionExpFilId" aria-expanded="false" aria-controls="loctionExpFilId" href="#">
									Location
								</a>
							</h5>
						</div>
						<div id="loctionExpFilId" class="collapse" aria-labelledby="locationFIlterId" data-parent="#accordion">
							<div class="card-body">
								<div id="locationChipHolder" class="form-check">

								</div>
								<input class="form-control" style="margin-top: 6px;width:100%;" type="text" autocomplete="off" placeholder="Enter your town and district...." name="addresspostad" onFocus="initializeAutocompletePostAd()" id="localitypostad" />
								<div id="locErrTxtId" class="locErrTxtCls"></div>
								<input type="hidden" readonly name="multiLocChip" id="multiLocChip" value="" />
							</div>
						</div>


						<div class="card-header" id="headingTwo">
							<h5 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" href="#">
									<?php echo $this->category()[0]; ?>
								</a>
							</h5>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-5 col-md-5 col-lg-5 pb-0">
										<?php
										$filter_list_ASC_query = mysqli_query($this->mysqlConfig(), "select * from pic_addpost where pic_category in " . $cat_char . " ORDER BY pic_price ASC limit 1");
										$filter_list_DESC_query = mysqli_query($this->mysqlConfig(), "select * from pic_addpost where pic_category in " . $cat_char . " ORDER BY pic_price DESC limit 1");
										$row_list_ASC = mysqli_fetch_object($filter_list_ASC_query);
										$row_list_DESC = mysqli_fetch_object($filter_list_DESC_query);
										$row_list_DESC->pic_price;
										$total = ($row_list_DESC->pic_price - $row_list_ASC->pic_price) / 3;
										//$total = $row_list_ASC+$total;
										$no = mysqli_num_rows($filter_list_ASC_query);
										?>
										<input type="number" name="from_price" id="filter_price_from" class="form-control" placeholder="10" value="">
									</div>
									<div class="col-sm-2 col-md-2 col-lg-2 pb-0"><i class="fa fa-angle-left fa-1x"></i> <i class="fa fa-angle-right fa-1x"></i></div>
									<div class="col-sm-5 col-md-5 col-lg-5 pb-0">
										<input type="number" name="to_price" id="filter_price_to" class="form-control" onchange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);" placeholder="1000" value="">

									</div>



								</div>
							</div>
						</div>


						<?php
						$quick_filter_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM `pic_categories_fields` where `fields_type`='Chain' and fields_categories_id=" . $_REQUEST['cat_id'] . "");
						$quick_filter_row = mysqli_fetch_object($quick_filter_query);
						$checkRow = mysqli_num_rows($quick_filter_query);
						if ($checkRow != 0) {
						?>
							<?php

							$field_value_trim = trim($quick_filter_row->field_value, "from:");
							$field_value_trim = str_replace('to:', '', $field_value_trim);

							$field_value_trim = explode(',', $field_value_trim);
							$chain_id1 = $field_value_trim[0];
							$chain_id2 = $field_value_trim[1];
							$field_value_trim = "(" . $field_value_trim[0] . ")";

							$title_query1 = mysqli_query($this->mysqlConfig(), "SELECT * FROM `pic_categories_fields`  where `fields_id`=$chain_id2 limit 1");
							$title_row1 = mysqli_fetch_object($title_query1);

							$chain2 = $title_row1->fields_title;

							$title_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM `pic_categories_fields`  where `fields_id`=$chain_id1 limit 1");
							$title_row = mysqli_fetch_object($title_query);

							$chain1 = $title_row->fields_title;



							?>
							<div class="card-header" id="head_<?php echo $chain1; ?>">



								<h5 class="mb-0">
									<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse_<?php echo str_replace(" ", "_", $chain1); ?>" aria-expanded="false" aria-controls="collapse_<?php echo str_replace(" ", "_", $chain1); ?>" href="javascript:void(0);">
										<?php echo $chain1; ?>
									</a>
								</h5>

							</div>

							<div id="collapse_<?php echo str_replace(" ", "_", $chain1); ?>" class="collapse" aria-labelledby="head_<?php echo str_replace(" ", "_", $chain1); ?>" data-parent="#accordion">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12 col-md-12 col-lg-12 pb-4">
											<h6><?php echo "Choose " . $title_row->fields_title; ?></h6>
											<select name="<?php echo $chain_id1; ?>" id="<?php echo $chain_id1; ?>" onchange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);" class="form-control filter_chain">
												<?php
												$parent_quick_filter_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM `pic_categories_fields`  where `field_DV_id` in $field_value_trim");
												?>
												<option selected="selected" value="0">All</option>
												<?php
												while ($parent_quick_filter_row = mysqli_fetch_object($parent_quick_filter_query)) {
												?>
													<option value="<?php echo $parent_quick_filter_row->fields_id; ?>"><?php echo $parent_quick_filter_row->field_value; ?></option>
												<?php
												}
												?>
											</select>
											<input class="sub" type="hidden" name="sub" value="<?php echo $chain_id2; ?>" />
										</div>

										<div class="col-sm-12 col-md-12 col-lg-12 pb-0" id="sub_div">

										</div>



									</div>
								</div>
							</div>


						<?php
						} else {

							$chain2 = "";
							$chain1 = "";
						}
						?>
						<?php
						$filter_query = mysqli_query($this->mysqlConfig(), "select DISTINCT field_id,addpost_fields_title,addpost_fields_type from pic_addpost_field where addpost_fields_categories_id in " . $cat_char . " and addpost_fields_type in ('TextBox','Numeric')");
						$no = 0;
						while ($row = mysqli_fetch_object($filter_query)) {

						?>


							<?php $nametitle = preg_replace('/\s+/', '', $row->addpost_fields_title); ?>
							<?php $nametitle = str_replace('/', '', $nametitle); ?>


							<?php $nameid = $row->field_id; ?>
							<div class="card-header" id="heading_<?php echo $nametitle; ?>">
								<h5 class="mb-0">
									<a href="javascript:void(0);" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse_<?php echo $nametitle; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $nametitle; ?>">
										<?php echo $row->addpost_fields_title; ?>
									</a>
								</h5>
							</div>
							<div id="collapse_<?php echo $nametitle; ?>" class="collapse show <?php if (isset($_POST[$nametitle])) {
																									echo 'show';
																								} else {
																									echo '';
																								} ?>" aria-labelledby="heading_<?php echo $nametitle; ?>" data-parent="#accordion">
								<div class="card-body">
									<?php
									if (($no > 5 && $row->addpost_fields_type != "Numeric") || ($no == 0)) {
									?>
										<input onkeyup="search_filter('<?php echo $nametitle; ?>');" class="form-control" id="myInput_<?php echo $nametitle; ?>" type="text" placeholder="Search..">
										<div id="value_<?php echo $nametitle; ?>" class="box-filter">
										<?php
									} else {
										echo '<div class="box-filter-nonscroll">';
									}

									if ($row->addpost_fields_type != "Numeric") {
										$filter_list_query = mysqli_query($this->mysqlConfig(), "select DISTINCT addpost_fields_value,addpost_fields_title,field_id from pic_addpost_field where addpost_fields_categories_id in " . $cat_char . " and field_id = '" . $row->field_id . "' and addpost_fields_value != '' order by addpost_fields_value ASC");
										$no = mysqli_num_rows($filter_list_query);
										?>
											<ul class="list-group">
												<?php
												while ($row_list = mysqli_fetch_object($filter_list_query)) {
													$query_othercolumn = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_categories_fields` where fields_id = '" . $row_list->field_id . "'");
													$row_othercolumn = mysqli_fetch_object($query_othercolumn);
													$name = $row_othercolumn->fields_title;

													if ($no > 10 or $no == 0) {
												?>
														<li class="list-group-item">
															<input id="<?php echo $row_othercolumn->fields_id; ?>" name="<?php echo $name; ?>" value="<?php echo $row_list->addpost_fields_value; ?>" class="form-check-input filter_checkbox m-1" type="radio" onChange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);">
															<div class="mylabel ml-4"><?php echo $row_list->addpost_fields_value; ?></div>
														</li>

													<?php
													} else {
													?>
														<li class="list-group-item">
															<input id="<?php echo $row_othercolumn->fields_id; ?>" name="<?php echo $nametitle; ?>" value="<?php echo $row_list->addpost_fields_value; ?>" type="<?php if (isset($multi) && $multi == 1) { ?>checkbox <?php } else { ?>radio<?php } ?>" class="form-check-input filter_checkbox m-1" onChange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);">
															<div class="mylabel ml-4"><?php echo $row_list->addpost_fields_value; ?></div>
														</li>
												<?php
													}
												}
												?>
											</ul>
										<?php
									} else {

										?>
											<div class="row">
												<div class="col-sm-12 col-md-12 col-lg-12 pb-0">
													<input type="number" name="<?php echo $nametitle . "1"; ?>" id="<?php echo $nameid; ?>" class="filter_numeric_from form-control" value="" placeholder="<?php echo $nametitle; ?> From..">

												</div>
												<div class="col-sm-12 col-md-12 col-lg-12 pb-0 text-center"><i class="fa fa-angle-left fa-1x"></i> <i class="fa fa-angle-right fa-1x"></i></div>
												<div class="col-sm-12 col-md-12 col-lg-12 pb-0">
													<input type="number" name="<?php echo $nametitle . "2"; ?>" id="<?php echo $nameid; ?>" value="" class="form-control filter_numeric_to" placeholder="<?php echo $nametitle; ?> To.." onchange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);">
												</div>
											</div>


										<?php
									}
										?>
										</div>


								</div>
							</div>





						<?php
						}
						?>



						<?php
						$filter_query = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_field where addpost_fields_categories_id in " . $cat_char . " and addpost_fields_type='DropDown' and addpost_fields_title != '" . $chain1 . "' and addpost_fields_title != '" . $chain2 . "' group by addpost_fields_title");
						$no = 0;
						while ($row = mysqli_fetch_object($filter_query)) {

						?>




							<?php
							$query_title = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_addpost_field` WHERE  `field_id` = $row->field_id limit 1");
							$field_title = mysqli_fetch_object($query_title);
							?>
							<?php $nametitle = preg_replace('/\s+/', '', $field_title->addpost_fields_title); ?>
							<div class="card-header" id="heading_<?php echo $nametitle; ?>">
								<h5 class="mb-0">
									<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse_<?php echo $nametitle; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $nametitle; ?>" href="javascript:void(0);">
										<?php echo $field_title->addpost_fields_title; ?>
									</a>
								</h5>
							</div>

							<div id="collapse_<?php echo $nametitle; ?>" class="collapse <?php if (isset($_POST[$nametitle])) {
																								echo 'show';
																							} else {
																								echo '';
																							} ?>" aria-labelledby="heading_<?php echo $nametitle; ?>" data-parent="#accordion">
								<div class="card-body">
									<?php
									$query_othercolumn = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_categories_fields` where fields_id = '" . $row->field_id . "'");
									$row_othercolumn = mysqli_fetch_object($query_othercolumn);
									$name = $row_othercolumn->field_value;
									$multi = $row_othercolumn->multi;
									?>
									<select class="form-control filter_checkbox" name="<?php echo $nametitle; ?>" id="<?php echo $row_othercolumn->fields_id; ?>" onChange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);">

										<?php
										$filter_list_query = mysqli_query($this->mysqlConfig(), "select DISTINCT addpost_fields_value from pic_addpost_field where field_id = $row->field_id and addpost_fields_value!='' order by addpost_fields_value ASC");
										$no = mysqli_num_rows($filter_list_query);

										while ($row_list = mysqli_fetch_object($filter_list_query)) {

											$query_othercolumn = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_categories_fields` where fields_id = '" . $row_list->addpost_fields_value . "'");
											$row_othercolumn = mysqli_fetch_object($query_othercolumn);
											$name = $row_othercolumn->field_value;
										?>
											<option attr_id="<?php echo $row_othercolumn->field_DV_id; ?>" value="<?php echo $row_othercolumn->fields_id; ?>"><?php echo $name; ?></option>
										<?php
										}
										?>
										<option selected="selected" attr_id="<?php echo $row_othercolumn->field_DV_id; ?>" value="">All</option>
									</select>
								</div>
							</div>




						<?php
						}
						?>


						<div class="card-header" id="heading_ownerby">
							<h5 class="mb-0">
								<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse_ownerby" aria-expanded="false" aria-controls="collapse_ownerby" href="#">
									Owner by
								</a>
							</h5>
						</div>
						<div id="collapse_ownerby" class="collapse" aria-labelledby="heading_ownerby" data-parent="#accordion">
							<div class="card-body">
								<select class="form-control" name="ownerby_val" id="ownerby_val" onChange="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $_REQUEST['p']; ?>,<?php echo $_REQUEST['sort']; ?>);">

									<?php
									$ownerby_query = mysqli_query($this->mysqlConfig(), "select distinct pic_user_id from pic_addpost where pic_category in " . $cat_char . "");


									while ($row_ownerby = mysqli_fetch_array($ownerby_query)) {
									?>
										<option value="<?php echo $row_ownerby['pic_user_id']; ?>"><?php echo $row_ownerby['pic_user_id']; ?></option>
									<?php
									}
									?>
									<option selected="selected" value="">All</option>
								</select>


							</div>
						</div>
					</div>

				</div>
			</form>
		</div>



	<?php
	}

	public function filter()
	{
		$this->headerscript();
		$dates = date("Y-m-d");
	?>

		<?php
		if ($_REQUEST['p'] == 1) {
		?>


			<div class="row pb-4">
				<?php echo $this->sorting(); ?>
			</div>



		<?php
		}
		?>
		<script>
			function MM_jumpMenu(targ, selObj, restore) { //v3.0

				eval(targ + ".location='" + "?module=products&action=view&p=1&offset=0&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type=" + $("#adstype").val() + "&sort=" + $("#sorting").val() + "'");
				if (restore) selObj.selectedIndex = 0;
			}
		</script>
		<script>
			function MM_jumpMenu2(targ, selObj, restore) { //v3.0

				eval(targ + ".location='" + "?module=products&action=view&p=1&offset=0&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type=" + $("#adstype").val() + "&sort=" + $("#sorting").val() + "'");
				if (restore) selObj.selectedIndex = 0;
			}
		</script>

		<?php
		if (isset($_SESSION['pic']['biscuit']['city'])) {
			$city = $_SESSION['pic']['biscuit']['city'];
		} else {
			$city = "";
		}
		if (isset($_REQUEST['sort']) and $_REQUEST['sort'] == 1) {
			$order = "pic_price ASC";
		} elseif (isset($_REQUEST['sort']) and $_REQUEST['sort'] == 2) {
			$order = "pic_price DESC";
		} else {
			$order = "pic_id DESC";
		}
		// Sub Category products query
		$cat_char = $this->subcatid();
		// End - Sub Category products query


		// Dropdown and Textbox
		$count_c = 1;






		if (isset($_POST['value']) && $_POST['value'] != "") {
			$value = $_POST['value'];
			$fieldID = "";
			$fieldVal = "";


			$x = 0;
			foreach ($value as $values) {
				$values = explode(':', $values);
				$fieldID .= $values[0] . ",";

				$fieldVal .= " addpost_uni_id in (SELECT addpost_uni_id FROM pic_addpost_field where addpost_fields_value='" . $values[1] . "' and  addpost_fields_categories_id in " . $cat_char . " GROUP BY addpost_uni_id ) and ";
				$x++;
			}
			//$fieldID = substr($fieldID, 0, -1);
			//$fieldVal = substr($fieldVal, 0, -1);
		} else {
			$fieldID = "";
			$fieldVal = "";
		}

		if (isset($_POST['value1']) && $_POST['value1'] != "") {
			$value1 = $_POST['value1'];

			$fieldID1 = "";
			$fieldVal1 = "";

			$r = 0;
			foreach ($value1 as $values1) {
				$values1 = explode(':', $values1);
				$fieldID1 .= $values1[0] . ",";

				$fieldVal1 .= " addpost_uni_id in (SELECT addpost_uni_id FROM pic_addpost_field where addpost_fields_value='" . $values1[1] . "' and  addpost_fields_categories_id in " . $cat_char . " GROUP BY addpost_uni_id ) and ";
				$r++;
			}
		} else {
			$fieldID1 = "";
			$fieldVal1 = "";
		}

		if (isset($_POST['value2']) && $_POST['value2'] != "") {
			$value2 = $_POST['value2'];
			$fieldID2 = "";
			$fieldVal2 = "";

			$p = 0;
			foreach ($value2 as $values2) {
				$values2 = explode(':', $values2);
				$fieldID2 .= $values2[0] . ",";
				if ($values2[1] != 0) {

					$fieldVal2 .= " addpost_uni_id in (SELECT addpost_uni_id FROM pic_addpost_field where addpost_fields_value='" . $values2[1] . "' and  addpost_fields_categories_id in " . $cat_char . " GROUP BY addpost_uni_id ) and ";
				}
				$p++;
			}

			//$fieldID1 = substr($fieldID1, 0, -1);
			//$fieldVal1 = substr($fieldVal1, 0, -1);

		} else {
			$fieldID2 = "";
			$fieldVal2 = "";
		}

		// chain
		if (isset($_POST['chain_value'])) {
			$chain_value = $_POST['chain_value'];

			$chainID = "";
			$chainVal = "";
			$z = 0;
			foreach ($chain_value as $chain_values) {
				$chain_values = explode(':', $chain_values);
				$chainID .= $chain_values[0] . ",";
				if ($chain_values[1] != 0) {

					$chainVal .= " addpost_uni_id in (SELECT addpost_uni_id FROM pic_addpost_field where addpost_fields_value='" . $chain_values[1] . "' and  addpost_fields_categories_id in " . $cat_char . " GROUP BY addpost_uni_id ) and ";
				}
				$z++;
			}
			//$chainID = substr($chainID, 0, -1);
			//$chainVal = substr($chainVal, 0, -1);
		} else {
			$chainID = "";
			$chainVal = "";
		}


		//Numeric
		if (isset($_POST['numeric_from'], $_POST['numeric_to'])) {
			$numeric_from = $_POST['numeric_from'];
			$numeric_to = $_POST['numeric_to'];

			$str1 = "";
			$str2 = "";
			$str3 = "";
			$str = "";

			$j = 0;
			$ji = 0;
			foreach ($numeric_from as $numerics) {
				$numerics = explode(':', $numerics);
				$str1 .= " pic_ads_id in (SELECT addpost_uni_id FROM pic_addpost_field where addpost_fields_value between " . $numerics[1] . "";

				$numericses = explode(':', $numeric_to[$j]);
				$str2 .= " and " . $numericses[1] . "";
				$str3 .= " and `field_id`=" . $numericses[0] . " and addpost_fields_categories_id in " . $cat_char . ")";

				if ($numericses[1] != 0) {
					$str .= $str1 . $str2 . $str3;
					$ji++;
				}
				$j++;
				$str1 = "";
				$str2 = "";
				$str3 = "";
			}
		} else {
			$str = "";
			$ji = 0;
		}




		$fvstr_fields = $fieldVal . $fieldVal1 . $fieldVal2 . $chainVal;
		// sala 
		$fvstr_fields = substr($fvstr_fields, 0, -4);

		$fieldID = "(" . $fieldID . ")";

		if ($fieldVal != "") {
			$fieldVal = $fieldVal;
		}
		if ($fieldVal1 != "") {
			$fieldVal1 = $fieldVal1;
		}
		if ($fieldVal2 != "") {
			$fieldVal2 = $fieldVal2;
		}
		if ($chainVal != "" and $fieldVal != "" and $fieldVal1 != "" and $fieldVal2 != "") {
			$comma = ",";
		}
		if ($fieldVal != "" and $fieldVal1 != "" and $fieldVal2 != "") {
			$comma1 = ",";
		}
		if ($chainVal != "") {
			$chainVal = $chainVal;
		}
		if ($chainVal != "" or $fieldVal != "" or $fieldVal1 != "" or $fieldVal2 != "") {
			//$fvstr = " pic_ads_id in (SELECT addpost_uni_id FROM pic_addpost_field where ".$fvstr_fields." and addpost_fields_categories_id in ".$cat_char." GROUP BY addpost_uni_id ) and ";
			$fvstr = $fvstr_fields;
			$pri_price = "yes";
		} else {
			$fvstr = "";
			$pri_price = "";
		}

		if ($str != "" and $fvstr != "") {
			$or = " and ";
			$pri_price = "yes";
		} elseif ($str == "" and $fvstr == "") {
			$or = " addpost_fields_categories_id in " . $cat_char . " ";
		} else {
			$or = "";
		}

		$lan = $_SESSION['pic']['biscuit']['lan'];
		$lon = $_SESSION['pic']['biscuit']['lon'];

		$str_distance_ads = "111.045 * DEGREES( ACOS( COS( RADIANS( " . $lan . " ) ) * COS( RADIANS(  `pic_add_lan` ) ) * COS( RADIANS(  `pic_add_lon` ) - RADIANS( " . $lon . " ) ) + SIN( RADIANS( " . $lan . " ) ) * SIN( RADIANS(  `pic_add_lan` ) ) ) ) AS distance";

		$str_distance = "111.045 * DEGREES( ACOS( COS( RADIANS( " . $lan . " ) ) * COS( RADIANS(  `addpost_fields_lan` ) ) * COS( RADIANS(  `addpost_fields_lon` ) - RADIANS( " . $lon . " ) ) + SIN( RADIANS( " . $lan . " ) ) * SIN( RADIANS(  `addpost_fields_lan` ) ) ) ) AS distance";

		// Price

		if (isset($_POST['price_to']) && $_POST['price_to'] != "") {
			$priceString = "(pic_price between " . $_POST['price_from'] . " and " . $_POST['price_to'] . ") and ";
			$temp_price = "yes";
		} else {
			$priceString = "";
		}

		// Price

		if (isset($_POST['search_tag']) && $_POST['search_tag'] != "") {
			$searchString = "and pic_tag like '%" . $_POST['search_tag'] . "%'";
			//$temp_price = "yes";
		} else {
			$searchString = "";
		}

		// owner by
		if (isset($_REQUEST['ownerby_val']) && $_REQUEST['ownerby_val'] != "") {
			$ownerbyString = " and pic_user_id = " . $_REQUEST['ownerby_val'] . "";
			//$temp_price = "yes";
		} else {
			$ownerbyString = "";
		}

		//$offsetes=($_REQUEST['p']*5)-5;
		//$countAll = $x+$z;
		//$count_comma = $fieldVal.$fieldVal1.$comma.$chainVal;

		$count_comma = substr_count($fvstr_fields, ',');
		$countAll = $count_comma + 1 + $ji;

		//echo "SELECT addpost_fields_value,addpost_fields_categories_id,addpost_uni_id,".$str_distance." FROM pic_addpost_field where ".$fvstr.$or.$str." GROUP BY addpost_uni_id having count(distinct addpost_fields_value) = ".$countAll." order by distance ASC";

		if ($countAll != 1) {

			//echo "SELECT addpost_fields_value,addpost_fields_categories_id,addpost_uni_id,".$str_distance." FROM pic_addpost_field where ".$fvstr.$or.$str." GROUP BY addpost_uni_id having count(distinct addpost_fields_value) = ".$countAll." order by distance ASC";


			$query_ads = mysqli_query($this->mysqlConfig(), "SELECT addpost_fields_value,addpost_fields_categories_id,addpost_uni_id," . $str_distance . " FROM pic_addpost_field where " . $fvstr . $or . $str . " GROUP BY addpost_uni_id having count(distinct addpost_fields_value) = " . $countAll . " order by distance ASC");

			// $count_rows = mysqli_num_rows($query_ads);
			//$count_query = mysqli_query($this->mysqlConfig(),"SELECT addpost_fields_value,addpost_fields_categories_id,addpost_uni_id,".$str_distance." FROM pic_addpost_field where addpost_uni_id ".$fvstr.$or.$str." GROUP BY addpost_uni_id having count(distinct addpost_fields_value) = ".$countAll." LIMIT 1");
		} else {


			$query_ads = mysqli_query($this->mysqlConfig(), "SELECT addpost_fields_value,addpost_fields_categories_id,addpost_uni_id," . $str_distance . " FROM pic_addpost_field where " . $fvstr . $or . $str . " GROUP BY addpost_uni_id order by distance ASC");




			//$count_rows = mysqli_num_rows($query_ads);
			//$count_query = mysqli_query($this->mysqlConfig(),"SELECT addpost_fields_value,addpost_fields_categories_id,addpost_uni_id,".$str_distance." FROM pic_addpost_field where addpost_uni_id ".$fvstr.$or.$str." GROUP BY addpost_uni_id  LIMIT 1");


		}




		$x = 0;
		$y = 0;
		if ($_REQUEST['offset'] == 0) {
		} else {
			$y = $_REQUEST['offset'] / $_REQUEST['p'];
			$z = $_REQUEST['p'] - 1;
			$y = $y * $z;
			//$y = $y+1;
		}

		// new code
		if ($_REQUEST['p'] == 1) {
			$offsets = 0;
		} else {
			$pageload = $_REQUEST['p'] - 1;
			$offsets =  5 * $pageload;
		}


		//$check_rows_ads = mysqli_num_rows($count_query);

		if ($str == "" and $fvstr == "") {
			$or = " pic_category in " . $cat_char . " ";
		}

		// Multiple Location FIlter
		$uniqueAdIdStr = " ";
		if (isset($_REQUEST['multiLocChipData'])) {

			$multiLocArr = $_REQUEST['multiLocChipData'];
			$uniqueAdIdArr = [];

			foreach ($multiLocArr as $val) {
				/* // $priceString = "(pic_price between " . $_POST['price_from'] . " and " . $_POST['price_to'] . ") and ";
				$ownerbyString = ($ownerbyString != '') ? str_replace("pic_user_id", " pic_user_id.pa ", $ownerbyString) : '';
				$priceString = ($priceString != '') ? str_replace("pic_price", " pic_price.pa ", $priceString) : '';
				$or = ($or != '') ? str_replace("pic_category", " pic_category.pa ", $or) : ''; */
				/* $distQryStr = "111.045 * DEGREES( ACOS( COS( RADIANS( " . $val['latpostad'] . " ) ) * COS( RADIANS(  pic_add_lan.pl ) ) * COS( RADIANS(  pic_add_lon.pl ) - RADIANS( " . $val['lngpostad'] . " ) ) + SIN( RADIANS( " . $val['latpostad'] . " ) ) * SIN( RADIANS( pic_add_lan.pl) ) ) ) AS distance"; */
				$distQryStr = "111.111 *
				DEGREES(ACOS(LEAST(1.0, COS(RADIANS(" . $val['latpostad'] . "))
					 * COS(RADIANS(pl.pic_add_lat))
					 * COS(RADIANS(" . $val['lngpostad'] . " - pl.pic_add_lon))
					 + SIN(RADIANS(" . $val['latpostad'] . "))
					 * SIN(RADIANS(pl.pic_add_lat)))))
			";
				$getAdDistQry = "select pa.pic_ads_id,pl.pic_add_lat,pl.pic_add_lon, " . $distQryStr . "  AS distance from pic_addpost pa join pic_addpost_locations pl on pa.pic_ads_id = pl.addpost_uni_id where (" . $distQryStr . ") <= 100 order by distance ASC";
				$getAdDistArr = mysqli_query($this->mysqlConfig(), $getAdDistQry);
				while ($val = mysqli_fetch_object($getAdDistArr)) {
					$uniqueAdIdArr[] = $val->pic_ads_id;
				}
			}
			$uniqueAdIdArr = array_unique($uniqueAdIdArr);
			$uniqueAdIdStr = (!empty($uniqueAdIdArr)) ? " and pic_ads_id in (" . implode(' , ', $uniqueAdIdArr) . ")" : '';
			$str_distance_ads = ' 0 as distance ';
		}
		$dates = date("Y-m-d");
		$orderByQryStr = !empty($uniqueAdIdArr) ? " order by FIELD (pic_ads_id,".implode(' , ', $uniqueAdIdArr).")" : " order by pic_id asc ";
		$query_txt = "select *," . $str_distance_ads . " from pic_addpost where addpost_status=1 {$uniqueAdIdStr}" . $ownerbyString . " and " . $priceString . " " . $fvstr . $or . $str .$orderByQryStr. "  limit 5 OFFSET " . $offsets . "";

		$query_txt = str_replace(" addpost_uni_id in ", " pic_ads_id in ", $query_txt);

		//echo $query_txt;

		$query_ads = mysqli_query($this->mysqlConfig(), $query_txt);



		$check_rows_ads = mysqli_num_rows($query_ads);
		$pages = $_REQUEST['p'] + 1;
		if ($check_rows_ads != 0) {
			while ($list = mysqli_fetch_object($query_ads)) {
				$this->loopAds($list->pic_ads_id, $list->pic_user_id, $list->pic_title, $list->pic_discription, $list->pic_add_taluk, $list->pic_post_city, $list->pic_postdate, $list->pic_price);
				//$offsets++;
			}
		}


		?>



		<?php

		if ($check_rows_ads >= 5) {

			//$offsets = $offsets+1;
		?>

			<div id="loadmore_rows<?php echo $_REQUEST['p'] + 1; ?>" class="d-flex justify-content-center row p-3">
				<a id="loadmore_filter" class="btn btn-primary btn-lg loadmore-products" href="javascript:void(0)" onclick="javascript:filterProducts(this,<?php echo $_REQUEST['cat_id']; ?>,<?php echo $_REQUEST['type']; ?>,<?php echo $pages; ?>,<?php echo $_REQUEST['sort']; ?>);">Load More Ads</a>
			</div>
		<?php }
		// new code end
		?>






	<?php

	}

	public function sorting()
	{

	?>


		<div class="d-flex bd-highlight ">
			<div class="p-2 bd-highlight"  style="display:none">
				<form name="sort_form2" id="sort_form2">
					<select class="select_adstype" name="adstype" size="1" id="adstype" onChange="MM_jumpMenu2('parent',this,0)">
						<option <?php if ($_REQUEST['type'] == 0) { ?> selected="selected" <?php } ?> value="0">Posted Ads</option>
						<option <?php if ($_REQUEST['type'] == 1) { ?> selected="selected" <?php } ?> value="1">Requested Ads</option>
					</select>
				</form>

			</div>
			<div class="p-2 bd-highlight" style="font-weight: bold"><?php echo $this->categoryName() ?></div>
			<div class="ml-auto p-2 bd-highlight">
				<form name="sort_form" id="sort_form">
					<select class="select_sorting" style="width:110px;" name="sorting" size="1" id="sorting" onChange="MM_jumpMenu('parent',this,0)">
						<option value="0"><?php echo $this->category()[0]; ?> Sorting</option>
						<option <?php if ($_REQUEST['sort'] == 1) { ?> selected="selected" <?php } ?> value="1">Low to High</option>
						<option <?php if ($_REQUEST['sort'] == 2) { ?> selected="selected" <?php } ?> value="2">High to Low</option>
					</select>
				</form>
			</div>
		</div>




		<script>
			function MM_jumpMenu(targ, selObj, restore) { //v3.0
				//alert($("#sorting :selected").text());

				//console.log($("#sorting").target.options[$("#sorting").target.selectedIndex].text);
				eval(targ + ".location='" + "?module=products&action=view&p=1&offset=0&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type=" + $("#adstype").val() + "&sort=" + selObj.options[selObj.selectedIndex].value + "'");
				if (restore) selObj.selectedIndex = 0;
			}
		</script>
		<script>
			function MM_jumpMenu2(targ, selObj, restore) {


				eval(targ + ".location='" + "?module=products&action=view&p=1&offset=0&cat_id=<?php echo $_REQUEST['cat_id']; ?>&type=" + selObj.options[selObj.selectedIndex].value + "&sort=" + $("#sorting").val() + "'");
				if (restore) selObj.selectedIndex = 0;
			}
		</script>

	<?php


	}



	public function subcatid()
	{
		$query_subcat = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_categories` where categories_sub = " . $_REQUEST['cat_id'] . "");
		$cat_char = "(";
		while ($row_subcat = mysqli_fetch_object($query_subcat)) {

			$cat_char .= $row_subcat->categories_id . ",";
		}
		$cat_char .= $_REQUEST['cat_id'];
		$cat_char .= ")";
		return $cat_char;
	}
	public function category()
	{
		$query_subcat = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_categories` where categories_id = " . $_REQUEST['cat_id'] . "");
		$row_subcat = mysqli_fetch_object($query_subcat);
		return array($row_subcat->categories_price_label);
	}

	public function categoryName()
	{
		$query_subcat = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_categories` where categories_id = " . $_REQUEST['cat_id'] . "");
		$row_subcat = mysqli_fetch_object($query_subcat);
		
		$query_parentcat = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_categories` where categories_id = " . $row_subcat->categories_sub . "");
		$row_parentcat = mysqli_fetch_object($query_parentcat);


		return $row_parentcat->categories_name . " -> " . $row_subcat->categories_name;
	}

	public function loopAds($adid, $adsuserid, $pic_title, $pic_discription, $pic_add_taluk, $pic_post_city, $pic_postdate, $pic_price)
	{

		$cat_price_label = $this->category();
		$userid = $_SESSION['pic']['biscuit']['userid'];
		$queryuser = mysqli_query($this->mysqlConfig(), "SELECT * FROM `pic_user` where user_id = $userid limit 1");
		$rowuser = mysqli_fetch_object($queryuser);

		$like_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_likes` where likes_product_id='$adid' and likes_cus_id=" . $_SESSION['pic']['biscuit']['userid'] . "");
		$like_no = mysqli_num_rows($like_query);

		if ($like_no == 0) {
			$modal = "like";
		} else {
			$modal = "liked";
		}

		if ($_REQUEST['type'] == 0) {
			$module = "product_detail";
		} else {
			$module = "request_detail";
		}

		$profileUser = mysqli_query($this->mysqlConfig(), "SELECT user_pic FROM `pic_user` where user_id = $adsuserid limit 1");
		$rowProfileUser = mysqli_fetch_object($profileUser);

	?>


		<?php
        if ($like_no == 1) { ?> 
		<a href="#<?php echo $modal; ?>" data-toggle="modal" ads_id="<?php echo $adid; ?>" ads_uid="<?php echo $adsuserid; ?>" user_name="<?php echo $rowuser->user_username; ?>" user_mob="<?php echo $rowuser->user_mobile; ?>" user_email="<?php echo $rowuser->user_email; ?>" module="<?php echo $module; ?>" class="<?php echo $modal; ?> btn btn-white btn-block">
		<?php } else { ?>
		<a href="index.php?action=view&module=product_detail&ads_id=<?php echo $adid; ?>&ads_uid=<?php echo $adsuserid; ?>"  class="<?php echo $modal; ?> btn btn-white btn-block">	
		<?php } ?>





		<!--<a href="#<?php echo $modal; ?>" data-toggle="modal" ads_id="<?php echo $adid; ?>" ads_uid="<?php echo $adsuserid; ?>" user_name="<?php echo $rowuser->user_username; ?>" user_mob="<?php echo $rowuser->user_mobile; ?>" user_email="<?php echo $rowuser->user_email; ?>" module="<?php echo $module; ?>" class="<?php echo $modal; ?> btn btn-white btn-block">-->
			<div class="card mb-3">
				<div class="row no-gutters">
					<div class="col-md-4">

						<?php
						$multiLocqry = "select * from pic_addpost_locations where addpost_uni_id='$adid'";
						$multiLocqryExe = mysqli_query($this->mysqlConfig(), $multiLocqry);
						$multiLocqryCount = mysqli_num_rows($multiLocqryExe);

						

						?>

						<?php
						$query_img = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_images where addpost_id='$adid' order by ad_image_id ASC limit 1");
						$row_img = mysqli_fetch_object($query_img);
						$row_nm = mysqli_num_rows($query_img);
						if ($row_nm == 1) {
						?>
							 <img class="card-img" src="media/thumnails/<?php echo $row_img->ad_image_url; ?>" width="200px" height="240px"> 
						<?php  } else { ?>
							<img class="card-img" src="css/images/no_images.jpg" width="200px" height="240px"> 
						<?php  } ?>
						
						<!-- <div style="padding:3px;"><img class="card-img" src="<?php echo $profile_img_url; ?>" height="50%"  style="width:50%;"></div> -->
						
						

					</div>
					<div class="col-md-8">
						<div class="card-body text-left">
							<h4 class="card-title text-primary"><strong><?php echo $pic_title; ?></strong> <?php if ($modal == "liked") { ?>
									<i class="text-success fa fa-check-circle"></i>
								<?php } ?>
							</h4>
							<h5 class="text-dark"><strong><?php echo $cat_price_label[0]; ?> : <?php echo $pic_price; ?></strong></h5>
							<div class="card-text text-justify"><?php
							$trimeddesc = strlen($pic_discription) > 50 ? substr($pic_discription,0,50)."..." : $pic_discription;

							echo $trimeddesc;
							
							?></div>
							<?php
							if ($multiLocqryCount > 0) {
								while ($row = mysqli_fetch_object($multiLocqryExe)) {
							?>
									<p class="hint"><i class="fa fa-map-marker"></i> <?php echo $row->loc_name; ?></p>
								<?php }
							} else { ?>
								<p class="hint"><i class="fa fa-map-marker"></i> <?php echo $pic_post_city; ?></p>
							<?php } ?>

							
							<p class="card-text">
                            <?php
                            $query_spec = mysqli_query($this->mysqlConfig(), "select DISTINCT(papf.addpost_fields_title),papf.addpost_fields_value,papf.addpost_fields_type from pic_addpost_field papf join pic_categories_fields pcf on papf.addpost_fields_categories_id = pcf.fields_categories_id and papf.field_id=pcf.fields_id where (papf.addpost_fields_type!='Chain' and papf.addpost_uni_id = '$adid') or (papf.addpost_fields_type='Numeric' and papf.pots_field_DV_id=0 and papf.addpost_uni_id = '$adid') group by papf.addpost_fields_title ORDER BY pcf.field_priority,pcf.fields_id ASC ");
                            while ($row_spec = mysqli_fetch_object($query_spec)) {
                                if (!empty($row_spec->addpost_fields_value)) {
                            ?>
							  <tr class="spec_row">
                                        <td>
                                            <p><?php
											if ($row_spec->addpost_fields_type == "DropDown") {
                                                    $query = mysqli_query($this->mysqlConfig(), "select fields_title,field_value from pic_categories_fields where fields_id='$row_spec->addpost_fields_value'". " and displayinlist=1");
                                                    $row = mysqli_fetch_object($query);?>
													<?php
													if(isset($row))
													{?>
														 <small class="text-muted">
														 <strong>
															 <?php echo $row_spec->addpost_fields_title ?>:</strong>
														<?php
														echo $row->field_value;	?>						
														</small>
													<?php 
													} 
													}
													
													 else {

													$query = mysqli_query($this->mysqlConfig(), "select fields_title from pic_categories_fields where fields_title='$row_spec->addpost_fields_title'". " and displayinlist=1");
													$row = mysqli_fetch_object($query);
													if(isset($row))
													{?>
														<small class="text-muted">
														<strong>
															<?php echo $row_spec->addpost_fields_title ?>:</strong>
														<?php
														echo $row_spec->addpost_fields_value;	?>						
														</small>
													<?php
													}}?>									
											</p>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
							</p>
							<p class="card-text">
								<small class="text-muted">
									<strong>Posted on :</strong>
									<i class="fa fa-clock"></i>
									<?php
									$date = date_create($pic_postdate);
									echo date_format($date, 'd/m/Y');
									?>
								</small>
							</p>
							<p class="card-text">
								<small class="text-muted">
									<strong>Ad Id :</strong>
									<?php
									echo $adid;
									?>
								</small>
							</p>
						</div>
					</div>
				</div>
			</div>


		</a>
		<script type="text/javascript">
			var sessVal = JSON.parse(sessionStorage.getItem('multiLocFil'));

			var locationChipArr = (sessVal && sessVal.length > 0) ? sessVal : [];

			if (locationChipArr.length > 0) {
				initialLoadLocFilter();
			}

			function initialLoadLocFilter() {
				chipStr = '';
				if (locationChipArr.length > 0) {
					for (var i = 0; i < locationChipArr.length; i++) {
						chipStr = chipStr +
							`<div class="chip"><div class="chipLocNameCls" title="` + locationChipArr[i].locName + `" >` +
							locationChipArr[i].locName + `</div><i onclick="deleteLocCHip(` + i + `)" class="chipCloseCls fas fa-times"></i>
							</div>`;
					}
					$("#locationChipHolder").html(chipStr);
					$("#multiLocChip").val(JSON.stringify(locationChipArr));
				}
			}

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
					//$("#city_postadpost").val($("#townpostadpost").val() + ", " city + ", " + state);	
					$("#lati").val(latpostad);
					$("#longi").val(lngpostad);

					var chipStr = "";
					if (locationChipArr.length < 3) {
						for (var i = 0; i < locationChipArr.length; i++) {
							 if (locationChipArr[i].locName == place.formatted_address) {
							//if (locationChipArr[i].locName == $("#townpostadpost").val() + ", " city + ", " + state {

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
						 locName: place.formatted_address,
						//	locName:$("#townpostadpost").val() + ", " city + ", " + state
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
						sessionStorage.setItem('multiLocFil', JSON.stringify(locationChipArr));
						filterProducts(this, <?php echo $_REQUEST['cat_id']; ?>, <?php echo $_REQUEST['type']; ?>, <?php echo $_REQUEST['p']; ?>, <?php echo $_REQUEST['sort']; ?>);
					} else {
						$("#locErrTxtId").show();
						$("#locErrTxtId").html("Maximum 3 Location only allowed");
						setTimeout(function() {
							$("#locErrTxtId").hide();
						}, 3000);
					}
					console.log(locationChipArr);
					$("#localitypostad").val('');

					//document.getElementById("location_id").value = placeId;
				});
			}

			function deleteLocCHip(locChipId) {
				console.log(locChipId);
				var tempArr = [],
					chipStr = '';
				for (var i = 0; i < locationChipArr.length; i++) {
					if (i == locChipId) {
						locationChipArr.slice(i, 1);
					} else {
						tempArr.push(locationChipArr[i]);
					}
				}
				locationChipArr = tempArr;
				for (var i = 0; i < locationChipArr.length; i++) {
					chipStr = chipStr +
						`<div class="chip">
						<div class="chipLocNameCls" title="` + locationChipArr[i].locName + `" >` + locationChipArr[i].locName + `</div>
						<i onclick="deleteLocCHip(` + i + `)" class="chipCloseCls fas fa-times"></i>
					</div>`;
				}
				$("#locationChipHolder").html(chipStr);
				$("#multiLocChip").val(JSON.stringify(locationChipArr));
				sessionStorage.setItem('multiLocFil', JSON.stringify(locationChipArr));
				filterProducts(this, <?php echo $_REQUEST['cat_id']; ?>, <?php echo $_REQUEST['type']; ?>, <?php echo $_REQUEST['p']; ?>, <?php echo $_REQUEST['sort']; ?>);
			}
		</script>
<?php


	}
}
?>