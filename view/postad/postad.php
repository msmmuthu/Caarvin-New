<?php

class postad extends config
{

    public function index()
    {
        $scheme_query = mysqli_query($this->mysqlConfig(), "select *,SUM(pic_scheme_balance_qty) AS sum_ads from pic_scheme_user where payment_status='Approved' and pic_user_id=" . $_SESSION['pic']['biscuit']['userid'] . " and pic_scheme_balance_qty!=0");
        $scheme_row = mysqli_fetch_object($scheme_query);


?>





        <div class="container">



            <form id="postad" name="postad" method="post" action="index.php" enctype="multipart/form-data">


                <?php
                if ($scheme_row->sum_ads != 0 or isset($_REQUEST['id'])) { ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 pb-0">
                            <h4>Post Your Ads</h4>
                        </div>
                    </div>
                    <hr />
                    <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-6 pb-0">

                            <?php

                            if (!empty($_SESSION['pic']['biscuit']['userid'])) {

                            ?>

                                <div class="form-group">
                                    <div class="list-group">
                                        <div class="list-group-item list-group-item-light">
                                            <input name="scheme" type="hidden" value="<?php echo $scheme_row->pic_scheme_user_id; ?>">
                                            Your Scheme : <strong><?php echo $scheme_row->sum_ads; ?></strong> Available
                                        </div>
                                    </div>
                                </div>


                            <?php
                                if ($scheme_row->sum_ads == 0 and !isset($_REQUEST['id'])) {
                                    print "<script>";
                                    print "alert('Your scheme empty or pending for admin approval');";
                                    print "window.location.href = 'index.php?action=view&module=myaccount&task=scehmelist';";
                                    print "</script>";
                                }
                            }

                            ?>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 pb-0">

                            <?php
                            if (isset($_REQUEST['sub'])) {
                                $categories_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories where categories_id=" . $_REQUEST['sub'] . "");
                                $row = mysqli_fetch_object($categories_query);
                                $desc_label = $row->categories_desc_label;

                                $categories_parent_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories where categories_id=" . $row->categories_sub . "");
                                $subrow = mysqli_fetch_object($categories_parent_query);
                            }
                            ?>
                            <div class="form-group">
                                <div class="list-group">
                                    <div class="list-group-item list-group-item-light">
                                        <input type="hidden" class="form_txt" id="category_id" name="category_id" value="<?php echo $row->categories_id; ?>">
                                        <input type="hidden" class="form_txt" id="pro_category" name="pro_category" value="<?php echo $row->categories_name; ?>" readonly>
                                        Category :<strong><?php echo $subrow->categories_name; ?></strong><span> -> </span> <strong><?php echo $row->categories_name; ?></strong>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 pb-0">





                            <input type="hidden" name="action" value="model" />
                            <input type="hidden" name="module" value="postad" />
                            <?php if (isset($_REQUEST['special'])) { ?>
                                <input type="hidden" name="special" value="<?php echo $_REQUEST['special']; ?>" />
                            <?php } else { ?>
                                <input type="hidden" name="special" value="" />
                            <?php } ?>
                            <?php
                            if (isset($_REQUEST['id'])) {
                                $categories_querys = mysqli_query($this->mysqlConfig(), "select * from pic_addpost where pic_ads_id=" . $_REQUEST['id'] . "");
                                $rows = mysqli_fetch_object($categories_querys);
                                $id_check = $rows->pic_ads_id;
                                $str = "and  addpost_uni_id=" . $_REQUEST['id'] . "";

                                $getFIleQry = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_files where pic_ads_id = {$_REQUEST['id']}");
                                $getFileArr = mysqli_fetch_object($getFIleQry);
                            } else {
                                $id_check = "";
                                $str = "";
                            }
                            ?>
                            <?php if ($id_check == "") { ?>
                                <input type="hidden" name="post" value="postad insert" />
                            <?php } else { ?><input type="hidden" name="post" value="postad update" />
                                <input type="hidden" name="id" value="<?php echo $id_check; ?>" />
                            <?php }  ?>






                            <div class="form-group">
                                <label class="mylabel pb-1" for="inputtitle">Title *</label>
                                <?php if ($id_check == "") { ?>
                                    <input autofocus required type="text" class="form-control" id="inputtitle" name="pro_title">
                                <?php } else { ?><input autofocus required type="text" class="form-control" id="inputtitle" name="pro_title" value="<?php echo $rows->pic_title; ?>"><?php }  ?>




                            </div>


                            <div class="form-group">
                                <label class="mylabel pb-1" for="pro_price"><?php echo $row->categories_price_label; ?> *</label>
                                <?php if ($id_check == "") { ?>
                                    <input type="number" autofocus required class="form-control" id="pro_price" name="pro_price">
                                <?php } else { ?><input type="number" autofocus required class="form-control" id="pro_price" name="pro_price" value="<?php echo $rows->pic_price; ?>"><?php }  ?>

                            </div>




                            <?php
                            $temp = "";
                            $strrr = "";
                            $field_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_categories_id=" . $_REQUEST['sub'] . " and fields_type='Chain' order by field_priority,fields_id ASC");
                            ?>
                            <?php
                            while ($row = mysqli_fetch_object($field_query)) {
                            ?>
                                <div class="col-sm-12 col-md-12 col-lg-12 p-3 bg-primary mb-4 rounded-lg">
                                    <div class="form-group">
                                        <?php
                                        $field_value_trim = trim($row->field_value, "from:");
                                        $field_value_trim = str_replace('to:', '', $field_value_trim);
                                        $field_value_trim = explode(',', $field_value_trim);
                                        ?>
                                        <div class="mylabel pb-1 text-white">

                                            <?php
                                            $title_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_id=$field_value_trim[0]");
                                            $maintitle = mysqli_fetch_array($title_query);
                                            echo $name =  $maintitle['fields_title'];
                                            $name = str_replace(" ", "_", $maintitle['fields_title']);
                                            ?>
                                        </div>


                                        <?php $placeholder = $row->field_sample; ?>
                                        <?php

                                        $values_query1 = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_field where field_id='$field_value_trim[0]' " . $str . "");
                                        $row_value1 = mysqli_fetch_object($values_query1);
                                        ?>



                                        <select data-live-search="true" <?php if (isset($_REQUEST['post']) && $_REQUEST['post'] == "post") { ?> onchange="fieldChain_add(this,<?php echo $field_value_trim[1]; ?>,<?php echo $field_value_trim[0]; ?>,<?php echo $_REQUEST['sub']; ?>);" <?php } else { ?> onchange="fieldChain(this,<?php echo $field_value_trim[1]; ?>,<?php echo $field_value_trim[0]; ?>,<?php echo $_REQUEST['sub']; ?>,<?php echo $_REQUEST['id']; ?>);" <?php } ?> name="<?php echo $name; ?>" id="<?php echo $row_value1->addpost_field_id; ?>" class="form-control">
                                            <?php
                                            $stringcond = "," . $field_value_trims;
                                            $droplist_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_categories_id=" . $_REQUEST['sub'] . " and field_DV_id='$field_value_trim[0]' order by field_priority asc");

                                            while ($list = mysqli_fetch_array($droplist_query)) {
                                                $values_query = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_field where addpost_uni_id='" . $_REQUEST['id'] . "' and addpost_fields_value=" . $list['fields_id'] . " and pots_field_DV_id!=0");

                                                $row_value = mysqli_fetch_object($values_query);
                                            ?>

                                                <option data-tokens="<?php echo $list['field_value']; ?>" <?php if ($list['fields_id'] == $row_value1->addpost_fields_value) { ?> selected="selected" <?php } ?> value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>

                                            <?php
                                            }
                                            ?>
                                            <option value="" selected="selected">--Select Brand--</option>
                                        </select>


                                    </div>
                                    <img style="display:none;width: 78%;" class="gif_cls" src="css/images/745.gif" />
                                    <div id="ajax_select" style="display:none;">

                                        <div class="text-white">
                                            <?php
                                            $title_query_1 = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_id=$field_value_trim[1]");
                                            $maintitle_1 = mysqli_fetch_array($title_query_1);
                                            echo $name_1 = $maintitle_1['fields_title'];
                                            $name_1 = str_replace(" ", "_", $maintitle_1['fields_title']);
                                            ?>
                                            <?php
                                            $title_query_0 = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_id=$field_value_trim[0]");
                                            $maintitle_0 = mysqli_fetch_array($title_query_0);
                                            $name_0 = str_replace(" ", "_", $maintitle_0['fields_title']);
                                            ?>

                                        </div>

                                        <select onblur="fieldUpdated_2(this,<?php echo $name_0; ?>);" name="<?php echo $name_1; ?>" class="js-example-basic-single2" style="width:78%;" disabled="disabled" required="required">
                                            <?php
                                            $stringcond = "," . $field_value_trims;
                                            $droplist_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_categories_id=" . $_REQUEST['sub'] . " and field_DV_id='$field_value_trim[1]'");
                                            while ($list = mysqli_fetch_array($droplist_query)) {
                                                $values_query = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_field where addpost_uni_id='" . $_REQUEST['id'] . "' and addpost_fields_value=" . $list['fields_id'] . "");
                                                $row_value = mysqli_fetch_object($values_query);
                                            ?>

                                                <option <?php if ($list['fields_id'] == $row_value->addpost_fields_value) { ?> selected="selected" <?php } ?> value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>



                                            <?php
                                            }
                                            ?>
                                            <option value="" selected="selected">--Select--</option>
                                        </select>





                                    </div>

                                </div>
                            <?php
                                $temp = $row->fields_title;
                                $strrr = "and fields_id!=$field_value_trim[0] and fields_id!=$field_value_trim[1]";
                            }
                            ?>

                            <?php
                            if (isset($_REQUEST['req']) and $_REQUEST['req'] == 0) {
                            ?>
                                <?php
                                $temp = "";

                                $field_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_categories_id=" . $_REQUEST['sub'] . " and fields_type!='Chain' and field_DV_id=0 " . $strrr . " order by field_priority,fields_id ASC");
                                ?>

                                <?php
                                while ($row = mysqli_fetch_object($field_query)) {
                                ?>
                                    <?php
                                        if ($row->fields_type == "DropDown" ) {
                                            //echo $id_check;

                                        ?>


                                    <div class="form-group">

                                        <?php
                                        if ($temp != $row->fields_title ) {
                                        ?>

                                            <div class="text-black pb-1 mylabel pb-1"> <?php echo $row->fields_title; ?> *</div>



                                        <?php
                                        }
                                        ?>

                                        <?php $name = str_replace(" ", "_", $row->fields_title); ?>
                                        <?php $placeholder = $row->field_sample; ?>

                                        <?php
                                        $values_query1 = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_field where field_id='$row->fields_id' " . $str . "");
                                        $row_value1 = mysqli_fetch_object($values_query1);
                                        ?>

                                        <select onchange="fieldUpdated(this);" name="<?php echo $name; ?>" id="<?php echo $row_value1->addpost_field_id; ?>" class="js-example-basic-single3 form-control">
                                            <?php
                                            $droplist_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_categories_id=" . $_REQUEST['sub'] . " and field_DV_id=" . $row->fields_id . "");
                                            while ($list = mysqli_fetch_array($droplist_query)) {
                                            ?>
                                                <option <?php if ($list['fields_id'] == $row_value1->addpost_fields_value) { ?> selected="selected" <?php } ?> value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?php
                                            }
                                            ?>

                                        <?php
                                        if ($row->fields_type != "DropDown" and  $row->fields_type != "Chain") {
                                            //echo $id_check;

                                        ?>

                                    <div class="form-group">
                                        <?php
                                        if ($temp != $row->fields_title) {
                                        ?>
                                            <label class="mylabel pb-1" for="pro_price">

                                                <?php
                                                echo $row->fields_title;
                                                ?>

                                            </label>

                                        <?php
                                        }
                                        ?>

                                        <?php $name = str_replace(" ", "_", $row->fields_title); ?>
                                        <?php $placeholder = $row->field_sample; ?>

                                        <?php
                                        if ($row->fields_type == "Textbox" or $row->fields_type == "Text") {
                                            //echo $id_check;

                                        ?>

                                            <?php if ($id_check != "") { ?>

                                                <?php
                                                $value_query = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_field where field_id=$row->fields_id " . $str . "");
                                                $row_vlaue = mysqli_fetch_object($value_query);
                                                ?>

                                                <input id="<?php echo $row_vlaue->addpost_field_id; ?>" onchange="fieldUpdated(this);" type="text" required class="form-control" name="<?php echo $name; ?>" value="<?php echo $row_vlaue->addpost_fields_value; ?>">
                                            <?php
                                            } else {
                                            ?>
                                                <input placeholder="<?php echo $placeholder; ?>" type="text" required class="form-control" id="<?php echo $row_vlaue->addpost_field_id; ?>" name="<?php echo $name; ?>">
                                            <?php
                                            }
                                        }

                                        if ($row->fields_type == "Numeric") {
                                            //echo $id_check;

                                            ?>

                                            <?php if ($id_check != "") { ?>

                                                <?php
                                                $value_query = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_field where addpost_fields_title='$name' " . $str . "");
                                                $row_vlaue = mysqli_fetch_object($value_query);
                                                ?>

                                                <input id="<?php echo $row_vlaue->addpost_field_id; ?>" onchange="fieldUpdated(this);" type="number" required class="form-control" name="<?php echo $name; ?>" value="<?php echo $row_vlaue->addpost_fields_value; ?>">
                                            <?php
                                            } else {
                                            ?>
                                                <input placeholder="<?php echo $placeholder; ?>" type="number" required class="form-control" id="<?php echo $row_vlaue->addpost_field_id; ?>" name="<?php echo $name; ?>">
                                        <?php
                                            }
                                        }


                                        ?>



                                    </div>
                                    <?php
                                            }
                                            ?>

                                <?php
                                    $temp = $row->fields_title;
                                }

                                ?>

                                <?php
                                // $temp = "";
                                $field_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_categories_id=" . $_REQUEST['sub'] . " and fields_type!='Chain' and fields_type!='DropDown' order by field_priority,fields_id ASC");
                                ?>

                                <?php
                                while ($row = mysqli_fetch_object($field_query)) {
                                ?>

                                       
                                <?php

                                }
                                ?>

                            <?php
                            }
                            ?>


                            <div class="form-group">
                                <label class="mylabel pb-1" for="pro_description"><?php echo $desc_label; ?> *</label>
                                <?php if ($id_check == "") { ?>
                                    <textarea required class="form-control" id="pro_description" name="pro_description"></textarea>

                                    <input type='hidden' id='city_postadpost' name="city_postadpost" />
                                    <input type='hidden' id='townpostadpost' name="townpostadpost" />
                                    <input type='hidden' id='lati' name="lati" />
                                    <input type='hidden' id='longi' name="longi" />

                                <?php } else { ?><textarea required class="form-control" id="pro_description" name="pro_description"><?php echo $rows->pic_discription; ?></textarea><?php }  ?>

                            </div>

                            <?php
                            if (isset($_REQUEST['sub'])) {

                                $categories_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories where categories_id=" . $_REQUEST['sub'] . " and cat_search=1");
                                $row = mysqli_fetch_object($categories_query);

                                $chk_row = mysqli_num_rows($categories_query);

                                if ($chk_row == 1) {


                            ?>

                                    <div class="form-group">
                                        <label for="pro_tag" class="mylabel pb-1">
                                            <?php if ($row->cat_search_title != "") {
                                                echo $row->cat_search_title . "*";
                                            } else {
                                                echo "Serach Tags *";
                                            } ?>
                                        </label>

                                        <?php if ($id_check == "") { ?>
                                            <textarea placeholder="This <?php echo $row->cat_search_title; ?> has a character limit of <?php echo $row->cat_search_limit; ?>." required maxlength="<?php echo $row->cat_search_limit; ?>" class="form-control" id="pro_tag" name="pro_tag"></textarea>
                                        <?php } else { ?><textarea placeholder="This <?php echo $row->cat_search_title; ?> has a character limit of <?php echo $row->cat_search_limit; ?>." required maxlength="<?php echo $row->cat_search_limit; ?>" class="form-control" id="pro_tag" name="pro_tag"><?php echo $rows->pic_tag; ?></textarea><?php }  ?>


                                    </div>

                            <?php

                                }
                            }
                            ?>

                            <style>
                                .img-thumbnail {
                                    max-width: 150px;
                                }
                            </style>
                            
                            <?php if ($id_check == "") {                               
								$misc2 = new misc2();
                                $scheme_photo = $misc2->get_value_limit('pic_scheme_user', 'pic_user_id', $_SESSION['pic']['biscuit']['userid'], 'payment_status', 'Approved', 'photo_limit', 'pic_scheme_user_id', 'DESC');
                                //$scheme_photo = $misc2->get_value('pic_scheme', 'scheme_id', $pic_scheme_id, 'scheme_photo');
                            ?>
                                <div class="form-group">

                                    <script type="text/javascript">
                                        var fileReader = new FileReader();
                                        var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
                                        var resize_width = 600;

                                        function compress(uploadFile, fileReader, final_img, final_preview, file_input) {


                                            fileReader.onload = function(el) {
                                                var image = new Image();
                                                image.onload = function() {
                                                    //document.getElementById("original-Img").src=image.src;
                                                    var canvas = document.createElement("canvas");
                                                    var context = canvas.getContext("2d");
                                                    var custom_size = image.width / 1000;
                                                    //var custom_height = image.height/1000;

                                                    var scaleFactor = resize_width / image.width;
                                                    canvas.width = (image.width > 600 && image.height > 600) ? resize_width : image.width;
                                                    canvas.height = (image.width > 600 && image.height > 600) ? image.height * scaleFactor : image.height;
                                                    context.drawImage(image,
                                                        0,
                                                        0,
                                                        image.width,
                                                        image.height,
                                                        0,
                                                        0,
                                                        canvas.width,
                                                        canvas.height
                                                    );

                                                    document.getElementById(final_preview).src = canvas.toDataURL();
                                                    document.getElementById(final_img).value = canvas.toDataURL();

                                                }
                                                image.src = event.target.result;
                                                $("#" + file_input + "").val('');
                                                $("#btn_" + file_input).show();
                                            };
                                        }


                                        var loadImageFile = function(file_input, final_img, final_preview) {
                                            var uploadImage = document.getElementById(file_input);

                                            //check and retuns the length of uploded file.
                                            if (uploadImage.files.length === 0) {
                                                return;
                                            }

                                            //Is Used for validate a valid file.
                                            var uploadFile = document.getElementById(file_input).files[0];
                                            if (!filterType.test(uploadFile.type)) {
                                                alert("Please select a valid image.");
                                                return;
                                            }
                                            compress(uploadFile, fileReader, final_img, final_preview, file_input);
                                            fileReader.readAsDataURL(uploadFile);
                                        }

                                        var removeImg = function(imgId) {
                                            $("#img_preview_" + imgId).attr("src", "assets/images/uploadImg.jpg");
                                            $("#img_data_" + imgId).val('');
                                            $("#btn_img_choosefile_" + imgId).hide();
                                        }
                                    </script>


                                    <a href="#picture_upload_modal" data-toggle="modal" ads-id="<?php echo $_REQUEST['id']; ?>" class="editroute btn btn-light btn-block"><i class="fa fa-camera"></i> Pictures</a>

                                </div>
                                <div class="modal fade bd-example-modal-lg" id="picture_upload_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

                                    <div class="modal-dialog postAdImgModalDialog" role="document">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title">Picture</h5>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                    <span aria-hidden="true">&times;</span>

                                                </button>

                                            </div>

                                            <div class="modal-body postAdImgModal" id="dynamicedit">

                                                <div class="imgHolderContainer">

                                                    <?php
                                                    for ($i = 1; $i <= $scheme_photo; $i++) {
                                                    ?>
                                                        <div class="imgContainer">
                                                            <div class="container contCls bg-light p-2 mb-2" style="border:1px dashed #ccc;">
                                                                <h5 class="">Picture <?php echo $i; ?></h5>
                                                                <hr />

                                                                <div class="row img_preview">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 col-md-12 col-lg-12 pb-0">
                                                                            <div class="content_div form-group">
                                                                                <input type="hidden" name="img_data[]" id="img_data_<?php echo $i; ?>" value="" />
                                                                                <div class="previewImgCls">
                                                                                    <img id="img_preview_<?php echo $i; ?>" class="img-thumbnail" src="assets/images/uploadImg.jpg">
                                                                                    <button id="btn_img_choosefile_<?php echo $i; ?>" onclick="removeImg(<?php echo $i; ?>)" type="button" class="previewImgRemCls">X</button>
                                                                                    <input class="form-control-file previewImgBrowseCls" type="file" accept="image/*" name="files[]" id="img_choosefile_<?php echo $i; ?>" onchange="loadImageFile('img_choosefile_<?php echo $i; ?>','img_data_<?php echo $i; ?>','img_preview_<?php echo $i; ?>');">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="col-sm-6 col-md-6 col-lg-6 pb-0">

                                                                        <div class="form-group">
                                                                            <label for="img_choosefile_<?php echo $i; ?>">Browse to upload</label>
                                                                            <input class="form-control-file" type="file" accept="image/*" name="files[]" id="img_choosefile_<?php echo $i; ?>" onchange="loadImageFile('img_choosefile_<?php echo $i; ?>','img_data_<?php echo $i; ?>','img_preview_<?php echo $i; ?>');">
                                                                        </div>

                                                                    </div> -->


                                                                    <div class="row">
                                                                        <div class="col-sm-12 col-md-12 col-lg-12 pb-0 imgAlignBottomCls">
                                                                            <div class="form-group">
                                                                                <!-- <label for="textfield_<?php echo $i; ?>">Title</label> -->
                                                                                <input type="text" placeholder="Title" name="textfield_<?php echo $i; ?>" id="textfield_<?php echo $i; ?>" value="" class="form-control" />
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <!-- <div class="col-sm-6 col-md-6 col-lg-6 pb-0 imgAlignBottomCls">
                                                                        <div class="form-group">
                                                                            <!-- <label for="textfield2_<?php echo $i; ?>">Description</label> 
                                                                            <input type="text" placeholder="Description" name="textfield2_<?php echo $i; ?>" id="textfield2_<?php echo $i; ?>" value="" class="form-control" />
                                                                        </div>
                                                                    </div> -->

                                                                </div>



                                                            </div>





                                                        </div>
                                                    <?php
                                                    }
                                                    ?>


                                                </div>

                                                <!-- <?php
                                                        for ($i = 1; $i <= $scheme_photo; $i++) {
                                                        ?>

                                                    <div class="container bg-light p-2 mb-2" style="border:1px dashed #ccc;">
                                                        <h5 class="">Picture <?php echo $i; ?></h5>
                                                        <hr />

                                                        <div class="row img_preview">

                                                            <div class="col-sm-6 col-md-6 col-lg-6 pb-0">
                                                                <div class="content_div form-group">
                                                                    <input type="hidden" name="img_data[]" id="img_data_<?php echo $i; ?>" value="" />
                                                                    <img id="img_preview_<?php echo $i; ?>" class="img-thumbnail" src="http://placehold.it/1000x1000">

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-6 pb-0">

                                                                <div class="form-group">
                                                                    <label for="img_choosefile_<?php echo $i; ?>">Browse to upload</label>
                                                                    <input class="form-control-file" type="file" accept="image/*" name="files[]" id="img_choosefile_<?php echo $i; ?>" onchange="loadImageFile('img_choosefile_<?php echo $i; ?>','img_data_<?php echo $i; ?>','img_preview_<?php echo $i; ?>');">
                                                                </div>

                                                            </div>



                                                            <div class="col-sm-6 col-md-6 col-lg-6 pb-0">
                                                                <div class="form-group">
                                                                    <label for="textfield_<?php echo $i; ?>">Title</label>
                                                                    <input type="text" name="textfield_<?php echo $i; ?>" id="textfield_<?php echo $i; ?>" value="" class="form-control" />
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-6 col-md-6 col-lg-6 pb-0">
                                                                <div class="form-group">
                                                                    <label for="textfield2_<?php echo $i; ?>">Description</label>
                                                                    <input type="text" name="textfield2_<?php echo $i; ?>" id="textfield2_<?php echo $i; ?>" value="" class="form-control" />
                                                                </div>
                                                            </div>

                                                        </div>



                                                    </div>






                                                <?php
                                                        }
                                                ?> -->

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Done</button>
                                            </div>

                                        </div>

                                    </div>
	</div>
                            <?php } else { ?>
                                <div class="form-group">
                                    <a href="#editroute" data-toggle="modal" ads-id="<?php echo $_REQUEST['id']; ?>" class="editroute btn btn-light btn-block"><i class="fa fa-camera"></i> Pictures</a>
                                </div>
                            <?php } ?>



                            <div class="form-check">

                                <?php if ($id_check == "") { ?>

                                    <input required type="checkbox" value="true" class="form-check-input" id="confirm" name="ageConfirmChk">
                                <?php } else { ?><input required type="checkbox" value="true" id="confirm" name="ageConfirmChk" class="form-check-input" checked><?php }  ?>
                                <label class="form-check-label" for="confirm">&nbsp;I confirm that I am 18 years or older</label>
                            </div>


                            <link rel="stylesheet" href="dist/ladda.min.css">

                            <!-- <div class="form-group">
                                <button type="submit" name="posting_ad" id="submit_final_btn" class="btn btn-lg btn-primary btn-block text-uppercase ladda-button" data-color="blue" data-style="expand-left"><span class="ladda-label">Submit</span></button>

                            </div> -->


                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-6 pb-0">
                            <?php
                            if (isset($_REQUEST['sub'])) {
                                $categories_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories where categories_id=" . $_REQUEST['sub'] . " and categories_maps=1");
                                $row = mysqli_fetch_object($categories_query);
                                $chk_row = mysqli_num_rows($categories_query);
                                if ($chk_row == 1) {
                            ?>
                                    <div class="row p-4 bg-light rounded-lg mb-2">
                                        <h5 class="default">Choose your Current Location</h5>
                                        <div class="col-sm-12 col-md-12 col-lg-12 pb-0">
                                            <hr>
                                            <style>
                                                #map {
                                                    overflow: hidden !important;
                                                    width: 100%;
                                                    height: 300px;
                                                }
                                            </style>

                                            <div id="map"></div>
                                            <input type='hidden' id='lati' name="lati" />
                                            <input type='hidden' id='longi' name="longi" />

                                            <script>
                                                var map;
                                                var marker;
                                                var infowindow;
                                                var messagewindow;

                                                function initMap() {
                                                    /*navigator.geolocation.getCurrentPosition(showPosition);*/
                                                    var location_lat_lan = {
                                                        lat: 9.923817,
                                                        lng: 78.119717
                                                    };
                                                    map = new google.maps.Map(document.getElementById('map'), {
                                                        center: location_lat_lan,
                                                        zoom: 18
                                                    });
                                                    infoWindow = new google.maps.InfoWindow;

                                                    // Try HTML5 geolocation.
                                                    if (navigator.geolocation) {
                                                        navigator.geolocation.getCurrentPosition(function(position) {
                                                            var pos = {
                                                                lat: position.coords.latitude,
                                                                lng: position.coords.longitude
                                                            };

                                                            //infoWindow.setPosition(pos);
                                                            //infoWindow.setContent('Location found.');
                                                            placeMarker(pos);
                                                            infoWindow.open(map);
                                                            map.setCenter(pos);

                                                            document.getElementById('lati').value = position.coords.latitude;
                                                            document.getElementById('longi').value = position.coords.longitude;
                                                        }, function() {
                                                            handleLocationError(true, infoWindow, map.getCenter());
                                                        });
                                                    } else {
                                                        // Browser doesn't support Geolocation
                                                        handleLocationError(false, infoWindow, map.getCenter());
                                                    }



                                                    /* google.maps.event.addListener(map, 'click', function(event) {
                                                    marker = new google.maps.Marker({position: event.latLng,map: map});
                                                    var latlng = marker.getPosition();
                                                    document.getElementById('name').value = latlng.lat();
                                                    document.getElementById('address').value = latlng.lng();
                                                    
                                                    
                                                    
                                                    
                                                    google.maps.event.addListener(marker, 'click', function() {
                                                    infowindow.open(map, marker);
                                                    });
                                                    });*/

                                                    google.maps.event.addListener(map, 'click', function(event) {
                                                        placeMarker(event.latLng);
                                                        var latlng = marker.getPosition();
                                                        document.getElementById('lati').value = latlng.lat();
                                                        document.getElementById('longi').value = latlng.lng();
                                                    });

                                                }

                                                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                                                    infoWindow.setPosition(pos);
                                                    infoWindow.setContent(browserHasGeolocation ?
                                                        'Error: The Geolocation service failed.' :
                                                        'Error: Your browser doesn\'t support geolocation.');
                                                    infoWindow.open(map);
                                                }


                                                function placeMarker(location) {
                                                    if (marker) {
                                                        marker.setPosition(location);
                                                    } else {
                                                        marker = new google.maps.Marker({
                                                            position: location,
                                                            map: map
                                                        });
                                                    }
                                                }



                                                function doNothing() {}
                                            </script>


                                        </div>
                                    </div>
                            <?php
                                }
                            }

                            ?>

                            <div class="row p-4 bg-secondary rounded-lg">




                                <h5 class="default">Contact Details</h5>

                                <div class="col-sm-12 col-md-12 col-lg-12 pb-0">
                                    <hr>



                                    <?php
                                    if (!empty($_SESSION['pic']['biscuit']['userid'])) {

                                        $this->conatctDetails();
                                        $this->notifyForm();
                                    } else {

                                        $this->conatctForm();
                                        $this->notifyForm();
                                    }
                                    ?>

                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="row col-sm-12 col-md-12 col-lg-6 pb-0">
                        <div class="form-group submitBtnCls">
                            <button type="submit" name="posting_ad" id="submit_final_btn" class="btn btn-lg btn-primary btn-block text-uppercase ladda-button" data-color="blue" data-style="expand-left"><span class="ladda-label">Submit</span></button>

                        </div>
                        <script src="dist/spin.min.js"></script>
                        <script src="dist/ladda.min.js"></script>

                        <script>
                            Ladda.bind('#submit_final_btn');
                        </script>
                    </div>

            </form>



            <div class="modal fade bd-example-modal-lg" id="editroute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

                <div class="modal-dialog postAdImgModalDialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">Picture</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                        <div class="modal-body postAdImgModal" id="dynamicedit">
                            <div class="imgHolderContainer">
                                <?php
                                if ($id_check != "") {
                                    $categories_query2 = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_images where addpost_id=" . $id_check . " ORDER BY `ad_image_order` ASC ");
                                    $i = 1;
                                    while ($row1 = mysqli_fetch_object($categories_query2)) {

                                ?>
                                        <div class="imgContainer">
                                            <div class="container editImgContainerCls bg-light p-2 mb-2" style="border:1px dashed #ccc;">
                                                <h5 class="">Picture <?php echo $i; ?></h5>
                                                <hr />
                                                <form id="uploadimage_<?php echo $row1->ad_image_id; ?>" action="" method="post" enctype="multipart/form-data">
                                                    <div class="row">

                                                        <div calss="row">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 pb-0">
                                                                <div class="content_div form-group">
                                                                    <?php
                                                                    if ($row1->ad_image_url != "") { ?>
                                                                        <img id="blah_files_<?php echo $row1->ad_image_id; ?>" class="img-thumbnail" onerror="this.onerror=null;this.src='assets/images/uploadImg.jpg'" src="media/small/<?php echo $row1->ad_image_url; ?>">
                                                                        <input class="form-control-file previewImgBrowseCls" type="file" accept="image/*" name="files[]" id="files_<?php echo $row1->ad_image_id; ?>" onchange="readURL_more(this);">
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <img id="blah_files_<?php echo $row1->ad_image_id; ?>" class="img-thumbnail" src="assets/images/uploadImg.jpg">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  <div class="col-sm-6 col-md-6 col-lg-6 pb-0">

                                                            <div class="form-group">
                                                                <label for="files_<?php echo $row1->ad_image_id; ?>">Browse to upload</label>
                                                                <input class="form-control-file" type="file" accept="image/*" name="files[]" id="files_<?php echo $row1->ad_image_id; ?>" onchange="readURL_more(this);">
                                                            </div>

                                                        </div> -->


                                                        <input type="hidden" name="adsid" value="<?php echo $row1->addpost_id; ?>" />
                                                        <input type="hidden" name="rowid" value="<?php echo $row1->ad_image_id; ?>" />

                                                        <div calss="row">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 pb-0">
                                                                <div class="form-group">
                                                                    <label for="textfield_<?php echo $row1->ad_image_id; ?>">Title</label>
                                                                    <input type="text" name="title_img" id="textfield_<?php echo $row1->ad_image_id; ?>" value="<?php echo $row1->ad_image_title; ?>" class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- <div class="col-sm-6 col-md-6 col-lg-6 pb-0">
                                                            <div class="form-group">
                                                                <label for="textfield2_<?php echo $row1->ad_image_id; ?>">Description</label>
                                                                <input type="text" name="desc_img" id="textfield2" value="<?php echo $row1->ad_image_desc; ?>" class="form-control" />
                                                            </div>
                                                        </div> -->
                                                        <div class="col-sm-12 col-md-12 col-lg-12 pb-0">
                                                            <div class="form-group">
                                                                <input type="button" name="button" id="<?php echo $row1->ad_image_id; ?>" value="Update" onclick="update_img(this);" class="btn btn-primary" />
                                                            </div>
                                                            <div class="loading_img" style="display:none;" id='loading_<?php echo $row1->ad_image_id; ?>'><img style="width: 96%;padding-top: 2%;" src="css/images/745.gif" /></div>
                                                        </div>
                                                    </div>


                                                </form>
                                            </div>
                                        </div>






                                <?php
                                        $i++;
                                    }
                                }
                                ?>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Done</button>
                        </div>

                    </div>

                </div>

            </div>



            <br>




        </div>
        </div>

    <?php
                } else {

    ?>
        <div class="alert alert-warning" role="alert">
            Please visit your scheme page <a class="alert-link" href="index.php?action=view&module=myaccount&task=scehmelist">Purchase Scheme</a> | <a class="alert-link" href="index.php?action=view&module=myaccount&task=myscheme">Scheme Status</a>
        </div>

    <?php
                }
            }

            public function conatctForm()
            {
    ?>

    <div class="form-check">
        <div class="mylabel pb-1">You are an *</div>
        <input name="areYou" type="radio" value="0" checked="checked" id="Individual" class="form-check-input">
        <label class="form-check-label" for="Individual">Individual</label>
        <input type="radio" value="1" name="areYou" id="Business" class="form-check-input">
        <label class="form-check-label" for="Business">Business</label>
    </div>

    <div class="form-group">
        <label for="name">Name *</label>
        <input type="text" required class="form-control" id="name" name="name">
    </div>

    <div class="form-group">
        <label for="email">Name *</label>
        <input required type="email" class="form-control" id="email" name="email" value="<?php
                                                                                            if (isset($_POST['register'])) {
                                                                                                echo $_POST['email'];
                                                                                            }
                                                                                            ?>">
        <input type="text" required class="form-control" id="name" name="name">
    </div>






    <div class="col-2">
        <div class="space_10"></div>
        <div class="search-title"><strong> Mobile *</strong></div>
        <div class="space_10"></div>
        <div class="rows">

            <input type="text" disabled="disabled" value="+91" class="form_txt" id="phone_prefix" name="mobile_prefix" maxlength="10" size="2" style="width:5%;"> <input required type="text" pattern="[789][0-9]{9}" value="<?php
                                                                                                                                                                                                                                if (isset($_POST['register'])) {
                                                                                                                                                                                                                                    echo $_POST['mobile'];
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                ?>" id="mobile" name="mobile" maxlength="10" class="form_txt" size="20" style="width:67%;">
            <div>(We will verify this number for privacy protection)</div>
            <div class="space_10"></div>
        </div>
    </div>

    <div class="col-2">
        <div class="space_10"></div>
        <div class="search-title"><strong>Select District *</strong></div>
        <div class="space_10"></div>
        <div class="rows">


        </div>
    </div>
    <div class="space_10"></div>
    <div id="taluk">

    </div>
    <div class="space_10"></div>


    </div>


<?php
            }
            public function conatctDetails()
            {


?>


    <div class="form-label-group">
        <div class="mylabel pb-1">Choose Contact *</div>

        <select name="contact_customer" id="contact_customer" class="form-control form-control-lg" onchange="ajax_contact();">
            <option value="<?php echo $_SESSION['pic']['biscuit']['userid']; ?>">Own Contact</option>
            <?php
                $qry = mysqli_query($this->mysqlConfig(), "SELECT * FROM `pic_user` where `user_refer`='PA00" . $_SESSION['pic']['biscuit']['userid'] . "' and user_type='Customer' and user_status=1");
                while ($rw = mysqli_fetch_array($qry)) { ?>
                <option value="<?php echo $rw['user_id']; ?>">PA00<?php echo $rw['user_id']; ?>,<?php echo $rw['user_username']; ?>(<strong><?php echo $rw['user_id_unique']; ?></strong>)</option>
            <?php
                }
            ?>

        </select>
    </div>

    <div id="ajax_contact_div">
        <?php
                $this->ajax_conatctDetails();
        ?>
    </div>



<?php
            }

            public function ajax_conatctDetails()
            {

                if (isset($_REQUEST['id'])) {
                    $ads = $_REQUEST['id'];
                } else {
                    $ads = "";
                }
                if (empty($_REQUEST['id'])) {


                    if (isset($_POST['id_refer']) and $_POST['id_refer'] and !empty($_POST['id_refer'])) {
                        $userid = $_POST['id_refer'];
                        $readonly = "readonly";
                    } else {
                        $userid = $_SESSION['pic']['biscuit']['userid'];
                        $email = $_SESSION['pic']['biscuit']['email'];
                        $readonly = "";
                    }

                    $user_query = mysqli_query($this->mysqlConfig(), "select * from pic_user where user_id=$userid");
                    $user_fetch = mysqli_fetch_object($user_query);

                    $full_name = $user_fetch->user_username;
                    $mobile_no = $user_fetch->user_mobile;
                    $usertype = $user_fetch->user_type;
                    $city = $user_fetch->user_city;
                    $email = $user_fetch->user_email;
                    $multiLocChip = '[]';
                } else {

                    $user_query = mysqli_query($this->mysqlConfig(), "select * from pic_addpost where pic_ads_id=$ads");
                    $user_fetch = mysqli_fetch_object($user_query);

                    $full_name = $user_fetch->pic_user_fullname;
                    $mobile_no = $user_fetch->pic_user_mobile;
                    $usertype = $user_fetch->pic_user_type;
                    $city = $user_fetch->pic_post_city;
                    $pic_sms = $user_fetch->pic_sms;
                    $pic_privacy = $user_fetch->pic_privacy;
                    $email = $user_fetch->pic_user_email;
                    $multiLocChip = ($user_fetch->pic_multi_loc_chip != '') ? json_encode($user_fetch->pic_multi_loc_chip) : '[]';
                    $multiLocChipArr = json_decode($user_fetch->pic_multi_loc_chip, true);
                }
?>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"><?php echo $full_name; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $email; ?></h6>
            <!-- <p class="card-text" style="margin-bottom:0px;" id="lblcity"><?php echo $city; ?></p> -->



            <p> <a style="font-size:75%" href="#" id="change_loc_postad" onClick="updateContactVal()">Change Location <i class="fa fa-edit"></i></a></p>

            <div style="display : none;" class="form-group" id="changeloc">
                <div id="locationChipHolder" class="locationChipHolderCls form-check">
                    <?php
                    if (isset($_REQUEST['id']) && !empty($multiLocChipArr)) {
                        foreach ($multiLocChipArr as $key => $val) {
                    ?>
                             <div class="chip">
                                <div class="chipLocNameCls" title="<?php echo $val['locName'] ?>"> <?php echo $val['locName'] ?></div>
                                    <i onclick="deleteLocCHip(<?php echo $key; ?>)" class="chipCloseCls fas fa-times"></i>
                                </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <input class="form-control" style="margin-top: 6px;width:100%;" type="text" autocomplete="off" placeholder="Enter your town and district...." name="addresspostad" onFocus="initializeAutocompletePostAd()" id="localitypostad" />
                <div id="locErrTxtId" class="locErrTxtCls"></div>
                <input type="hidden" readonly name="multiLocChip" id="multiLocChip" value="" />
            </div>

            <a href="#" class="card-link"><i class="fa fa-phone"></i> <?php echo $mobile_no; ?></a>

        </div>
    </div>
    <script type="text/javascript">
        <?php 
        if(isset($_REQUEST['id'])){
        ?>
            var locationChipArr = JSON.parse(<?php echo $multiLocChip; ?>);
        <?php }else{ ?>
            var locationChipArr = [];
        <?php } ?>
        document.getElementById('multiLocChip').value = JSON.stringify(locationChipArr);

        function updateContactVal() {
            $('#changeloc').show();
            $('#locationChipHolder').show();

            $('#localitypostad').val('');

            $('#city_postadpost').val('');
            $('#townpostadpost').val('');
            $('#multiLocChip').val(JSON.stringify(locationChipArr));

            $('#lati').val('');
            $('#longi').val('');
            $('#lblcity').hide();
            $('#change_loc_postad').hide();
        }
    </script>
    <input required type="hidden" class="form_txt1" id="name" name="name" value="<?php echo $full_name; ?>">
    <input required type="hidden" class="form_txt" id="email" name="email" value="<?php echo $email; ?>">
    <input type="hidden" disabled="disabled" value="+91" class="form_txt" id="phone_prefix" name="mobile_prefix" maxlength="10" size="2" style="width:5%;">
    <input required type="hidden" pattern="[789][0-9]{9}" value="<?php echo $mobile_no; ?>" id="mobile" name="mobile" maxlength="10" class="form_txt" size="20" style="width:67%;">
    <input type="hidden" value="<?php echo $city; ?>" id="location" name="location" maxlength="10" class="form_txt" size="20" style="width:67%;">

    <div id="taluk">

    </div>

<?php
            }


            public function notifyForm()
            {

                if (isset($_REQUEST['id'])) {
                    $ads = $_REQUEST['id'];

                    $user_query = mysqli_query($this->mysqlConfig(), "select * from pic_addpost where pic_ads_id=$ads");
                    $user_fetch = mysqli_fetch_object($user_query);

                    $pic_sms = $user_fetch->pic_sms;
                    $pic_privacy = $user_fetch->pic_privacy;
                } else {
                    $pic_sms = "";
                    $pic_privacy = "";
                }

?>
    <div class="row">

        <div class="col-sm-12 col-md-12 col-lg-6 pb-0" style="display: none;">

            <div class="mylabel pb-1">SMS Notification *</div>

            <div class="form-check">
                <input name="sms" id="sms" class="form-check-input" type="radio" value="1" <?php if ($pic_sms == 1) { ?> checked="checked" <?php } ?>>
                <label class="form-check-label" for="sms">Yes</label>
            </div>


            <div class="form-check">
                <input <?php if ($pic_sms == 0) { ?> checked="checked" <?php } ?> type="radio" class="form-check-input" value="0" id="sms2" name="sms">
                <label class="form-check-label" for="sms2">No</label>
            </div>

        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 pb-0">
            <div class="mylabel pb-1">Privacy *</div>
            <div class="form-check">
                <input <?php if ($pic_privacy == 0) { ?> checked="checked" <?php } ?> name="privacy" type="radio" value="1" class="form-check-input" id="privacy1" />
                <label class="form-check-label" for="privacy1">Public</label>
            </div>
            <div class="form-check">
                <input type="radio" value="0" name="privacy" <?php if ($pic_privacy == 1) { ?> checked="checked" <?php } ?> class="form-check-input" id="privacy2">
                <label class="form-check-label" for="privacy2">Private</label>
            </div>
        </div>

    <?php
            }
            public function ajaxChain()
            { ?>


        <div class="form-group">
            <div class="text-white mylabel pb-1">
                <?php
                $title_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_id=" . $_POST['filid'] . "");
                $maintitle = mysqli_fetch_array($title_query);
                echo $name = $maintitle['fields_title'];
                $id = $maintitle['fields_id'];
                $name = str_replace(" ", "_", $maintitle['fields_title']);
                ?>


            </div>

            <?php
                if (isset($_REQUEST['id'])) {
                    $str = "and  addpost_uni_id=" . $_REQUEST['id'] . "";
                } else {
                    $str = "";
                }
                $values_query1 = mysqli_query($this->mysqlConfig(), "select * from pic_addpost_field where field_id=$id " . $str . "");
                $row_value1 = mysqli_fetch_object($values_query1);

            ?>



            <select onchange="fieldUpdated(this);" name="<?php echo $name; ?>" id="<?php echo $row_value1->addpost_field_id; ?>" class="form-control" required data-live-search="true">
                <?php
                $stringcond = "," . $_POST['value'];
                $droplist_query = mysqli_query($this->mysqlConfig(), "select * from pic_categories_fields where fields_categories_id=" . $_POST['cat_id'] . " and field_chain_value LIKE '%{$stringcond}%'");
                while ($list = mysqli_fetch_array($droplist_query)) {
                ?>
                    <?php //if(strpos($list['field_chain_value'], ",".$list['fields_id']) !== false){ 
                    ?>
                    <option value="<?php echo $list['fields_id']; ?>"><?php echo $list['field_value']; ?></option>
                    <?php //} 
                    ?>
                <?php
                }
                ?>
                <option value="">--Select--</option>
            </select>

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





<?php
            }
        }
?>