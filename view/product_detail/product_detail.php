<?php

class product_detail extends config
{


    public function headerscript()
    {
?>
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
        <style type="text/css">
            .carousel {
                height: 300px;
                background: #fff;
                border: 1px solid #ccc;
                padding: 10px;
                width : 50%;
            }

            .carousel-caption {
                background: rgba(255, 255, 255, 0.67);
                padding: 10px;
                color: #000;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .middle {
                position: relative;
                height: 250px;
            }

            .middle img {
                max-width: 100%;
                max-height: 100%;
                margin: auto;
                position: absolute;
                left: 0;
                right: 0;
                top: 0;
                bottom: 0;
            }

            .carousel-control-next {
                background-image: linear-gradient(90deg, transparent, rgba(0, 0, 0, .2));

            }

            .carousel-control-prev {
                background-image: linear-gradient(270deg, transparent, rgba(0, 0, 0, .2));

            }
        </style>
    <?php
    }
    public function category($id)
    {
        $query_subcat = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_categories` where categories_id = " . $id . "");
        $row_subcat = mysqli_fetch_object($query_subcat);
        return array($row_subcat->categories_price_label);
    }

    public function categoryName($id)
	{
        $query_subcat = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_categories` where categories_id = " . $id . "");
        $row_subcat = mysqli_fetch_object($query_subcat);
		
		$query_parentcat = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_categories` where categories_id = " . $row_subcat->categories_sub . "");
		$row_parentcat = mysqli_fetch_object($query_parentcat);
		return $row_parentcat->categories_name . " -> " . $row_subcat->categories_name;
	}

    public function details()
    {
        $this->headerscript();
    ?>




        <div class="container" id="product_detail">
            <div class="row">

                <?php
                $ads_id = $_REQUEST['ads_id'];
                $query_ads = mysqli_query($this->mysqlConfig(), "select * from pic_addpost where pic_ads_id = '$ads_id'");
                $row = mysqli_fetch_object($query_ads);

                $multiLocqry = "select * from pic_addpost_locations where addpost_uni_id='$ads_id'";
                $multiLocqryExe = mysqli_query($this->mysqlConfig(), $multiLocqry);
                $multiLocqryCount = mysqli_num_rows($multiLocqryExe);

                $ads_user_id_uni = $row->pic_user_id;
                $pic_discription = $row->pic_discription;
                $pic_category = $row->pic_category;
                $pic_user_id = $row->pic_user_id;

                $getFIleQry = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_files where pic_ads_id = {$ads_id}");
                $getFileArr = mysqli_fetch_object($getFIleQry);

                // $profileUser = mysqli_query($this->mysqlConfig(), "SELECT user_pic FROM `pic_user` where user_id = {$_REQUEST['ads_uid']} limit 1");
                // $rowProfileUser = mysqli_fetch_object($profileUser);

                // if($rowProfileUser->user_pic==''){
                //     $profile_img_url = 'img/avatar.jpg';
                // }
                // else{
                //     $profile_img_url = 'media/profile/'.$rowProfileUser->user_pic;
                // }
                ?>

                <div  class="col-sm-12 col-md-12 col-lg-8">

                    <h4 class="pt-2"><?php echo $row->pic_title; ?></h4>


                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            $i = 0;
                            $query_ads = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_images where addpost_id = '$ads_id'");
                            while ($row_images = mysqli_fetch_object($query_ads)) {
                            ?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="active"></li>
                            <?php $i++;
                            } ?>

                        </ol>
                        <div class="carousel-inner">
                            <?php
                            $query_ads = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_images where addpost_id = '$ads_id'");
                            $j = 0;
                            while ($row_images = mysqli_fetch_object($query_ads)) {

                            ?>
                                <div class="carousel-item <?php if ($j == 0) {
                                                                echo 'active';
                                                            } else {
                                                                echo '';
                                                            } ?>">
                                    <div class="middle">
                                        <img class="d-block" src="media/<?php if ($row_images->ad_image_url != "") {
                                                                            echo $row_images->ad_image_url;
                                                                        } else {
                                                                            echo "no_images_2.jpg";
                                                                        } ?>" alt="First slide">
                                        <?php if (!empty($row_images->ad_image_title)) { ?>
                                            <div class="carousel-caption">
                                                <h5><?php echo $row_images->ad_image_title; ?></h5>
                                                <p><?php echo $row_images->ad_image_desc; ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php $j++;
                            } ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>



                </div>
			   <div class="p-2 bd-highlight" style="font-weight: bold"><?php echo $this->categoryName($pic_category) ?></div>

            
            <!-- <div class="col-sm-12 col-md-12 col-lg-12">
            <div style="padding:3px;height:175px;width:300px;">   
            <div >
                <img class="card-img" src="<?php echo $profile_img_url; ?>" height="50%"  style="width:50%;">
            </div>
                        </div></div> -->

            <div class="col-sm-12 col-md-12 col-lg-12">
                        <div style="float:right;marigin-right:5px;">

               <?php
                $userid1 = $_SESSION['pic']['biscuit']['userid'];
                $queryuser1 = mysqli_query($this->mysqlConfig(), "SELECT * FROM `pic_user` where user_id = $userid1 limit 1");
                $rowuser1 = mysqli_fetch_object($queryuser1);
                $module = "product_detail";

                $like_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_likes` where likes_product_id='$ads_id' and likes_cus_id=" . $_SESSION['pic']['biscuit']['userid'] . "");
                $like_no = mysqli_num_rows($like_query);

                if ($like_no == 0) {
                    $modal = "like";
                } else {
                    $modal = "liked";
                }
               ?>
            
                <a href="#<?php echo $modal; ?>" data-toggle="modal" ads_id="<?php echo $_REQUEST['ads_id']; ?>"  ads_uid="<?php echo $_REQUEST['ads_uid']; ?>"   user_name="<?php echo $rowuser1->user_username; ?>" user_mob="<?php echo $rowuser1->user_mobile; ?>" user_email="<?php echo $rowuser1->user_email; ?>" module="<?php echo $module; ?>" class="like1 like btn btn-primary btn-white like"><?php echo strtoupper($modal);?> <?php if ($modal == "liked") { ?>
								 <i class="text-success fa fa-check-circle"></i> <?php  } ?>
								</a>
               
               </div>
               </div>
           
            

                <div class="col-sm-12 col-md-12 col-lg-12 pt-2">
                    <div class="row p-2" style="border: 1px solid #dee2e6;">
                        <div class="col-sm-12 col-md-12 col-lg-12">

                            <strong><?php echo $this->category($pic_category)[0]; ?></strong>
                            <h4><?php echo $row->pic_price; ?></h4>

                            <?php
                            if ($multiLocqryCount > 0) {
                                while ($locRow = mysqli_fetch_object($multiLocqryExe)) {
                            ?>
                                    <figcaption class="figure-caption"><i class="fa fa-map-marker"></i> <?php echo $locRow->loc_name; ?></p>
                                    </figcaption>
                                <?php }
                            } else { ?>
                                <figcaption class="figure-caption"><i class="fa fa-map-marker"></i> <?php echo $row->pic_add_town; ?>, <?php echo $row->pic_post_city; ?></figcaption>
                            <?php } ?>


                            <figcaption class="figure-caption">
                                <i class="fa fa-clock-o"></i>
                                <?php
                                $date = date_create($row->pic_postdate);
                                echo date_format($date, 'd-My');
                                ?>
                            </figcaption>
                            <small class="text-muted">

                                <i class="text-muted">Ad Id :</i>
                                <?php
                                echo $ads_id;
                                ?>
                            </small>

                        </div>

                    </div>
                    <div class="row  p-2 mt-2" style="border: 1px solid #dee2e6;">
                        <table width="100%" border="0" id="product_details">


                            <?php
                            $query_contact = mysqli_query($this->mysqlConfig(), "select * from pic_addpost where pic_ads_id = '$ads_id'");
                            $row_contact = mysqli_fetch_object($query_contact);

                            ?>



                            <?php
                            $query_spec = mysqli_query($this->mysqlConfig(), "select DISTINCT(papf.addpost_fields_title),papf.addpost_fields_value,papf.addpost_fields_type from pic_addpost_field papf join pic_categories_fields pcf on papf.addpost_fields_categories_id = pcf.fields_categories_id and papf.field_id=pcf.fields_id where (papf.addpost_fields_type!='Chain' and papf.addpost_uni_id = '$ads_id') or (papf.addpost_fields_type='Numeric' and papf.pots_field_DV_id=0 and papf.addpost_uni_id = '$ads_id') group by papf.addpost_fields_title ORDER BY pcf.field_priority,pcf.fields_id ASC ");
                            while ($row_spec = mysqli_fetch_object($query_spec)) {
                                if (!empty($row_spec->addpost_fields_value)) {
                            ?>


                                    <tr class="spec_row">
                                        <td>
                                            <div class="left"><strong><?php echo $row_spec->addpost_fields_title;  ?></strong></div>
                                            <p><?php
                                                if ($row_spec->addpost_fields_type == "DropDown") {
                                                    $query = mysqli_query($this->mysqlConfig(), "select fields_title,field_value from pic_categories_fields where fields_id='$row_spec->addpost_fields_value'");
                                                    $row = mysqli_fetch_object($query);
                                                    echo $row->field_value;
                                                } else {
                                                    echo $row_spec->addpost_fields_value;
                                                }
                                                ?></p>


                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>





                        </table>
                    </div>
                    <div class="row  p-2 mt-2" style="border: 1px solid #dee2e6;">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4>Description</h4>
                            <hr />
                            <?php echo $pic_discription; ?>
                        </div>
                    </div>
                    <!-- <?php if ($modal == "liked") { ?>
                    <div class="row  p-2 mt-2" style="border: 1px solid #dee2e6;">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4>Download File</h4>
                            <hr />
                            <?php
                            $ext = pathinfo($getFileArr->pic_file_url, PATHINFO_EXTENSION);
                            $imgIconName = (strtolower($ext) == 'pdf') ? 'pdfIcon.png' : 'wordIcon.jpg';
                            ?>
                            <a target="_blank" href="<?php echo BASE_URL . $getFileArr->pic_file_url; ?>">
                                <img src="img/<?php echo $imgIconName; ?>" width="100" />
                            </a>
                        </div>
                    
                    
                    
                    
                    </div> -->
                    
                    <div class="row  p-2 mt-2" style="border: 1px solid #dee2e6;">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h4>Contact Person</h4>
                            <hr />
                            <h6><i class="fa fa-user"></i> <?php echo $row_contact->pic_user_fullname;  ?></h6>
                            <figcaption class="figure-caption"><i class="fa fa-map-marker"></i> <?php echo $row_contact->pic_add_town; ?>, <?php echo $row_contact->pic_post_city; ?></figcaption>
                            <div class="pt-2">
                                <?php
                                $query_ads = mysqli_query($this->mysqlConfig(), "select * from pic_addpost where pic_ads_id = '$ads_id' limit 1");
                                $row = mysqli_fetch_object($query_ads);

                                $userid = $_SESSION['pic']['biscuit']['userid'];
                                $queryuser = mysqli_query($this->mysqlConfig(), "SELECT * FROM `pic_user` where user_id = $userid limit 1");
                                $rowuser = mysqli_fetch_object($queryuser);


                                $like_query = mysqli_query($this->mysqlConfig(), "SELECT * FROM  `pic_likes` where likes_product_id='$ads_id' and likes_cus_id=" . $_SESSION['pic']['biscuit']['userid'] . "");
                                $like_no = mysqli_num_rows($like_query);

                                if ($like_no == 0) {
                                    $modal = "like";
                                } else {
                                    $modal = "liked";
                                }
                                if ($row->pic_request == 0) {
                                    $module = "product_detail";
                                } else {
                                    $module = "request_detail";
                                }

                                ?>

                                <a href="<?php if ($row_contact->pic_privacy == 1) {
                                                echo "tel:";
                                                echo $row_contact->pic_user_mobile;
                                            } else {
                                                echo "#";
                                                echo $modal;
                                            } ?>" <?php if ($row_contact->pic_privacy != 1) {
                                                        echo "data-toggle=modal";
                                                    } ?> ads_id="<?php echo $ads_id; ?>" ads_uid="<?php echo $row->pic_user_id; ?>" user_name="<?php echo $rowuser->user_username; ?>" user_mob="<?php echo $rowuser->user_mobile; ?>" user_email="<?php echo $rowuser->user_email; ?>" module="<?php echo $module; ?>" class="<?php echo $modal; ?> btn btn-primary btn-block">
                                    <i style="color: #fff;" class="fa fa-phone fa-1x"></i></span>&nbsp;&nbsp;<?php if ($row_contact->pic_privacy == 1) {
                                                                                                                    echo $row_contact->pic_user_mobile;
                                                                                                                } else { ?> Call Me<?php }   ?>
                                </a>

                               
                            </div>
                        </div>

                    </div>
                    <?php } ?>

                    <div class="row  p-2 mt-2" style="border: 1px solid #dee2e6;">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                        <a href="index.php?action=view&module=owner_cat&post=list&owner_id=<?php echo $pic_user_id; ?>&type=0&p=1&sort=0&offset=0&categories_id=<?php echo $pic_category;?>" class="btn btn-outline-primary btn-block">
                                    <i class="fa fa-align-justify fa-1x"></i></span>&nbsp;&nbsp; View more ads</a>
                        <a href="index.php?action=view&module=owner&post=list&owner_id=<?php echo $pic_user_id; ?>&type=0&p=1&sort=0&offset=0" class="btn btn-outline-primary btn-block">
                                    <i class="fa fa-align-justify fa-1x"></i></span>&nbsp;&nbsp; View more ads from the same user
                                </a>
                        </div>
                    </div>

                    <?php
                    if ($row_contact->pic_map_lan != "") {
                    ?>
                        <div class="row  p-2 mt-2" style="border: 1px solid #dee2e6;">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h4>Location</h4>
                                <hr />
                                <style>
                                    #map {
                                        overflow: hidden !important;
                                        width: 100%;
                                        height: 300px;
                                    }

                                    #floating-panel {
                                        z-index: 5;
                                        line-height: 30px;
                                    }
                                </style>

                                <div id="floating-panel" class="pb-1">
                                    <b>Mode of Travel: </b>
                                    <select id="mode">
                                        <option value="DRIVING">Driving</option>
                                        <option value="WALKING">Walking</option>
                                        <option value="BICYCLING">Bicycling</option>
                                        <option value="TRANSIT">Transit</option>
                                    </select>
                                </div>
                                <div id="map"></div>

                                <script>
                                    // Note: This example requires that you consent to location sharing when
                                    // prompted by your browser. If you see the error "The Geolocation service
                                    // failed.", it means you probably did not give permission for the browser to
                                    // locate you.
                                    var map, infoWindow;

                                    function initMap() {
                                        var directionsDisplay = new google.maps.DirectionsRenderer;
                                        var directionsService = new google.maps.DirectionsService;
                                        var myLatlng = new google.maps.LatLng(-34.397, 150.644);
                                        map = new google.maps.Map(document.getElementById('map'), {
                                            center: {
                                                lat: -34.397,
                                                lng: 150.644
                                            },
                                            zoom: 14
                                        });

                                        infoWindow = new google.maps.InfoWindow;

                                        // Try HTML5 geolocation.
                                        if (navigator.geolocation) {
                                            navigator.geolocation.watchPosition(function(position) {
                                                var pos = {
                                                    lat: position.coords.latitude,
                                                    lng: position.coords.longitude
                                                };

                                                //infoWindow.setPosition(pos);
                                                //infoWindow.setContent('Location found.');
                                                //infoWindow.open(map);
                                                //map.setCenter(pos);
                                                var image = 'https://abocarz.com/ico.png';
                                                directionsDisplay.setMap(map);
                                                var marker = new google.maps.Marker({
                                                    position: pos,
                                                    title: "You",
                                                    icon: image
                                                });

                                                marker.setMap(map);
                                                calculateAndDisplayRoute(directionsService, directionsDisplay, position.coords.latitude, position.coords.longitude);
                                                document.getElementById('mode').addEventListener('change', function() {
                                                    calculateAndDisplayRoute(directionsService, directionsDisplay, position.coords.latitude, position.coords.longitude);
                                                });

                                            }, function() {
                                                handleLocationError(true, infoWindow, map.getCenter());
                                            });
                                        } else {
                                            // Browser doesn't support Geolocation
                                            handleLocationError(false, infoWindow, map.getCenter());
                                        }
                                    }

                                    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                                        infoWindow.setPosition(pos);
                                        infoWindow.setContent(browserHasGeolocation ?
                                            'Error: The Geolocation service failed.' :
                                            'Error: Your browser doesn\'t support geolocation.');
                                        infoWindow.open(map);
                                    }

                                    function calculateAndDisplayRoute(directionsService, directionsDisplay, lat1, lon1) {
                                        var selectedMode = document.getElementById('mode').value;
                                        directionsService.route({
                                            origin: {
                                                lat: lat1,
                                                lng: lon1
                                            }, // Haight.
                                            destination: {
                                                lat: <?php echo $row_contact->pic_map_lan; ?>,
                                                lng: <?php echo $row_contact->pic_map_lon; ?>
                                            }, // Ocean Beach.
                                            // Note that Javascript allows us to access the constant
                                            // using square brackets and a string value as its
                                            // "property."
                                            travelMode: google.maps.TravelMode[selectedMode]
                                        }, function(response, status) {
                                            if (status == 'OK') {
                                                directionsDisplay.setDirections(response);
                                            } else {
                                                window.alert('Directions request failed due to ' + status);
                                            }
                                        });
                                    }
                                </script>


                                <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgz9gQANhwRBhu6oPIuO1LPd6KcMUDoKo&callback=initMap">
                                </script>-->


                            </div>
                        </div>

                    <?php } ?>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div style="float:right;marigin-right:5px;marigin-top:5px !important;padding-top:8px;">
                          <a style="marigin-top:5px;" href="#<?php echo $modal; ?>" data-toggle="modal" ads_id="<?php echo $_REQUEST['ads_id']; ?>"  ads_uid="<?php echo $_REQUEST['ads_uid']; ?>"   user_name="<?php echo $rowuser1->user_username; ?>" user_mob="<?php echo $rowuser1->user_mobile; ?>" user_email="<?php echo $rowuser1->user_email; ?>" module="<?php echo $module; ?>" class="like1 like btn btn-primary btn-white like"><?php echo strtoupper($modal);?> <?php if ($modal == "liked") { ?>
								 <i class="text-success fa fa-check-circle"></i> <?php  } ?>
								</a>
                    </div> 
                    </div>

                </div>


            </div>



            <?php
            $this->get_client_ip();
            ?>

        </div>




        </div>



        </div>

<?php
        //echo $row_contact->pic_user_id."|".$_SESSION['pic']['biscuit']['userid'];
        if ($row_contact->pic_user_id != $_SESSION['pic']['biscuit']['userid']) {
            require("helper/mailing/mailing.php");
            $mailing = new mailing();

            if ($_SESSION['pic']['biscuit']['username'] != "") {
                $sub = "Mr." . $_SESSION['pic']['biscuit']['username'] . " Reviewed your Ads";
                $title = "Mr." . $_SESSION['pic']['biscuit']['username'] . "";
            } else {
                $sub = "Reviewed your Ads";
                $title = "Someone";
            }

            $info = "Dear " . $row_contact->pic_user_fullname . ",

" . $title . " Viewed your Advertisment

Please Check your Ads 

http://www.picagri.com/index.php?action=view&module=product_detail&ads_id=" . $ads_id . "

Kindly Regards,
PIC Team";


            //$mailing->mail_send($row_contact->pic_user_email,$sub,$info);
        }
    }

    function get_client_ip()
    {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
?>
<script src="dist/js/jquery-3.4.1.min.js"></script>
		<script src="dist/js/popper.min.js"></script>
<script>
			$('.like').click(function() { alert("ssss");

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
                        alert(result);
						//$("#dynamicform").html(result);
                        $("#dynamicformlike").html(result);
					}
				});
			});

            
		</script>