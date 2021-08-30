$(document).ready(function() {

    $("#search_pic").keyup(function(e) {

        $('#loding_search').show();

        var query = $("#search_pic").val();
        if (query == "") {
            document.getElementById('suggestion_search').style.display = 'none';

        } else if (query != "") {
            document.getElementById('suggestion_search').style.display = 'block';




            postdata = {
                'query_search': query,

            }

            $.post("index.php?action=view&module=search&post=query", postdata, function(data) {
                $("#search_list").html(data);
                $('#loding_search').hide();
            });
        }
    });
});

function update_img(f) {

    var id = f.id;


    //var file_data = $("#files_"+id).prop('files')[0];

    var formData = new FormData($("#uploadimage_" + id)[0]);

    //formData.append('tax_file', $('input[type=file]')[0].files[0]);
    //formData.append('imgaaa', $("#files_"+id)[0].files[0]);

    //var fileName = $("#files_"+id)[0].files[0].name;

    //formData.append('fileswe', file_data);

    $('#loading_' + id).show();

    $.ajax({
        url: "index.php?action=model&module=postad&posts=img&id=" + id,
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $('#loading_' + id).hide();
            $("#id_div").html(data);
        }
    });

}


function sendmsg() {

    var name = $("#name").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var comments = $("#comments").val();

    if (mobile == "") {
        alert("Please Enter Details");
    } else {
        postdata = {
            'action': 'view',
            'module': 'contact',
            'post': "send",
            'name': name,
            'email': email,
            'mobile': mobile,
            'comments': comments,
        }
        $.post("index.php", postdata, function(data) {
            //$("#id_div").html(data);
        });
        alert("Thank you for Contact us");
    }

}


function checkUserId() {

    var userid = $("#userid").val();

    postdata = {
        'action': 'model',
        'module': 'account',
        'post': "checkid",
        'id': userid,
    }

    $.post("index.php", postdata, function(data) {
        $("#id_div").html(data);
    });



}

function register_validate() {

    var email = document.forms["registerform"]["email"].value;
    var pass = document.forms["registerform"]["pass"].value;
    var mobile = document.forms["registerform"]["mobile"].value;
    var city = document.forms["registerform"]["city"].value;
    var ageConfirmChk = document.registerform.ageConfirmChk.checked;

    var x = document.forms["registerform"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");


    if (email == null || email == "" || pass == null || pass == "" || mobile == null || mobile == "" || city == null || city == 0 || ageConfirmChk != true) {

        $("#error_register").show();
        return false;
    } else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
        $("#error_register_email").show();
        return false;

    } else {

        return true;

    }

}

function myacct_validate() {

    var email = document.forms["myacctform"]["email"].value;
    var pass = document.forms["myacctform"]["pass"].value;
    var pass_new = document.forms["myacctform"]["pass_new"].value;
    var pass_confirm = document.forms["myacctform"]["pass_confirm"].value;
    var mobile = document.forms["myacctform"]["mobile"].value;



    if (email == null || email == "" || pass == null || pass == "" || mobile == null || mobile == "") {

        alert("Please check the your details!");
        return false;
    } else if (pass_new != pass_confirm) {
        alert("Confirm Password did't matched");
        return false;
    } else {

        return true;

    }

}



function filterPrice() {

    var rangefrom = document.forms["filter_form"]["from_price"].value;
    var rangeto = document.forms["filter_form"]["to_price"].value;

    if (rangefrom != "" && rangefrom != 0 && rangeto != "" && rangeto != 0 && rangefrom < rangeto) {

        $("#filter_form").submit();

    } else {

        alert("Check Price Range Value!")

    }

}

function filterProducts(f, catid, type, page, sort) {

    $('#loading_filter').show();

    var id = f.id;
    //var attr_id = $(f).find(':selected').attr('attr_id')

    var value = f.value;
    var typee = f.type;



    if (id == "loadmore_filter") {
        pages = page;
        offsets = page * 5;
        //alert(offsets);
    } else {
        pages = 1;
        offsets = 0;
    }

    //$("#filter_form").submit();

    var chain = $(".filter_chain").val();
    var filter_sub = $(".filter_sub").val();
    var sub = $(".sub").val();

    var chainArray = $(".filter_chain").map(function() { return $(this).attr('id') + ":" + $(this).val() }).get();
    var subArray = $(".sub").map(function() { return $(this).attr('id') + ":" + $(this).val() }).get();

    var fieldArray = $(".filter_checkbox:radio:checked").map(function() { return $(this).attr('id') + ":" + $(this).val() }).get();
    var fieldArray1 = $(".filter_checkbox:checkbox:checked").map(function() { return $(this).attr('id') + ":" + $(this).val() }).get();
    var fieldArray2 = $(".filter_checkbox option:selected").map(function() { return $(this).attr('attr_id') + ":" + $(this).val() }).get();
    var numericFromArray = $(".filter_numeric_from").map(function() { return $(this).attr('id') + ":" + $(this).val() }).get();
    var numericToArray = $(".filter_numeric_to").map(function() { return $(this).attr('id') + ":" + $(this).val() }).get();
    var priceFromArray = $(".filter_price_from").val();
    var pricetoArray = $(".filter_price_to").val();

    //yourarray = [textbox_dropdown+","+numericfrom+","+numericto];

    $("#filter_price_to").val();

    if (chain != 0) {

        postdata = {
            'typee': typee,
            'filter': 'yes',
            'action': 'view',
            'module': 'products',
            'sort': sort,
            'cat_id': catid,
            'type': type,
            'p': pages,
            'offset': offsets,
            'parent': chain,
            'chain_value': chainArray,
            'sub': sub,
            'post': "loadsub",
        }

        $.post("index.php", postdata, function(data) {

            //if(filter_sub!=0){
            $("#sub_div").html(data);
            //}														  
        });

    }

	if(sessionStorage.getItem('multiLocFil')!="")
		var multiLocChipData = JSON.parse(sessionStorage.getItem('multiLocFil'));
   
    postdata = {
        'typee': typee,
        'filter': 'yes',
        'action': 'view',
        'module': 'products',
        'sort': sort,
        'cat_id': catid,
        'type': type,
        'p': pages,
        'offset': offsets,
        'value': fieldArray,
        'value1': fieldArray1,
        'value2': fieldArray2,
        'chain_value': chainArray,
        'numeric_from': numericFromArray,
        'numeric_to': numericToArray,
        'price_from': $("#filter_price_from").val(),
        'price_to': $("#filter_price_to").val(),
        'ownerby_val': $("#ownerby_val").val(),
        'search_tag': $("#search_tag").val(),
        'multiLocChipData': (sessionStorage.getItem('multiLocFil')!="" && multiLocChipData.length > 0) ? multiLocChipData : []
    }



    //alert(JSON.stringify(postdata));
    $.post("index.php", postdata, function(data) {
        if (id == "loadmore_filter") {
            var string_id = "#loadmore_rows" + pages;
        } else {
            var string_id = "#ads_div";
        }
        $(string_id).html(data);
        $('#loading_filter').hide();
    });

}

function filterProducts_owner(f, catid, type, page, sort, val_seacrh, val_loc, val_near) {

    $('#loading_filter').show();

    var id = f.id;
    var value = f.value;
    var typee = f.type;


    if (id == "loadmore_filter") {
        pages = page;
        offsets = page * 5;
    } else {
        pages = 1;
        offsets = 0;
    }

    postdata = {
        'filter': 'yes',
        'action': 'view',
        'module': 'search',
        'owner_id': val_seacrh,
        'location': val_loc,
        'nearer': val_near,
        'sort': sort,
        'cat_id': catid,
        'type': type,
        'p': pages,
        'offset': offsets,
    }

    $.post("index.php", postdata, function(data) {

        if (id == "loadmore_filter") {
            var string_id = "#loadmore_rows" + pages;
        } else {
            var string_id = "#ads_div";
        }

        $(string_id).html(data);
        $('#loading_filter').hide();
    });

}

function filterProducts_search(f, catid, type, page, sort, val_seacrh, val_loc, val_near) {

    $('#loading_filter').show();

    var id = f.id;
    var value = f.value;
    var typee = f.type;


    if (id == "loadmore_filter") {
        pages = page;
        offsets = page * 5;
    } else {
        pages = 1;
        offsets = 0;
    }

    postdata = {
        'filter': 'yes',
        'action': 'view',
        'module': 'search',
        'search_pic': val_seacrh,
        'location': val_loc,
        'nearer': val_near,
        'sort': sort,
        'cat_id': catid,
        'type': type,
        'p': pages,
        'offset': offsets,
    }

    $.post("index.php", postdata, function(data) {

        if (id == "loadmore_filter") {
            var string_id = "#loadmore_rows" + pages;
        } else {
            var string_id = "#ads_div";
        }

        $(string_id).html(data);
        $('#loading_filter').hide();
    });

}




function taluk() {



    var city = $("#city").val();



    postdata = {
        'value_city': city,
        'post': 'talukAll',
        'action': 'helper',
        'module': 'location',

    }

    $.post("index.php", postdata, function(data) {
        $("#taluk").html(data);
    });

}

function validate_dim() {
    //Get reference of FileUpload.
    var fileUpload = $("#files")[0];
    //Check whether HTML5 is supported.
    if (typeof(fileUpload.files) != "undefined") {
        //Initiate the FileReader object.
        var reader = new FileReader();
        //Read the contents of Image File.
        reader.readAsDataURL(fileUpload.files[0]);
        reader.onload = function(e) {
            //Initiate the JavaScript Image object.
            var image = new Image();
            //Set the Base64 string return from FileReader as source.
            image.src = e.target.result;
            image.onload = function() {
                //Determine the Height and Width.
                var height = this.height;
                var width = this.width;

                if (height > 1000 || width > 800) {

                    alert("Height and Width must not exceed 1000px.");
                    $("#files").val("");
                    return false;

                }


                //alert("Uploaded image has valid Height and Width.");
                return true;
            };
        }
    } else {
        alert("This browser does not support HTML5.");
        return false;
    }
}

function post_ads_progress() {




    alert("Click to Continue..");



}








function taluk_header() {



    $('#loading-image-location').show();
    var city = $("#city_header").val();



    postdata = {
        'value_city': city,
        'post': 'taluk',
        'action': 'helper',
        'module': 'location',

    }

    $.post("index.php", postdata, function(data) {
        $("#taluk_header").html(data);
    });

}

function taluk_header_profile() {




    var city = $("#city_header_profile").val();



    postdata = {
        'value_city': city,
        'post': 'taluk',
        'action': 'helper',
        'module': 'location',

    }

    $.post("index.php", postdata, function(data) {
        $("#taluk_header_profile").html(data);
    });

}

function loadmore(page, type, cat_id, sort) {




    pages = page + 1;

    offsets = page * 5;
    //offsets = offsets+1;


    postdata = {
        'sort': sort,
        'cat_id': cat_id,
        'type': type,
        'p': pages,
        'offset': offsets,
        'action': "view",
        'module': "products",
        'post': "selectads",

    }

    var string_id = "#loadmore_rows" + pages;

    //alert(string_id);

    $.post("index.php", postdata, function(data) {
        $(string_id).html(data);
    });

}

function loadmore_filter(page, type, cat_id, sort) {


    pages = page + 1;

    offsets = page * 5;
    //offsets = offsets+1;


    postdata = {
        'sort': sort,
        'cat_id': cat_id,
        'type': type,
        'p': pages,
        'offset': offsets,
        'action': "view",
        'module': "products",
        'post': "loadmoreads",

    }

    var string_id = "#loadmore_rows" + pages;

    //alert(string_id);

    $.post("index.php", postdata, function(data) {
        $(string_id).html(data);
    });

}

function loadmore_searchin(page, type, cat_id, sort, str) {




    pages = page + 1;

    offsets = page * 5;
    //offsets = offsets+1;


    postdata = {
        'sort': sort,
        'cat_id': cat_id,
        'type': type,
        'p': pages,
        'string': str,
        'offset': offsets,
        'action': "view",
        'module': "searchincat",
        'post': "selectads",

    }

    var string_id = "#loadmore_rows" + pages;

    //alert(string_id);

    $.post("index.php", postdata, function(data) {
        $(string_id).html(data);
    });

}





function town() {



    var taluk = $("#taluk_select").val();

    postdata = {
        'value_taluk': taluk,
        'post': 'town',
        'action': 'view',
        'module': 'postad',

    }

    $.post("index.php", postdata, function(data) {
        $("#town").html(data);
    });

}

function CheckCheckboxes1(chk) {

    var txt = document.getElementById('refer');
    var val = chk.value;

    if (chk.checked === true) {
        document.getElementById("refer").setAttribute('value', '');
        txt.readOnly = false;
    } else {
        document.getElementById("refer").setAttribute('value', val);
        txt.readOnly = true;
    }
}

function subcate(sel) {
    $('.subcategory').hide();
    $('#subcategory' + sel).show();
    $('#loading-image' + sel).show();



    postdata = {
        'id': sel,
        'post': 'subcat',
        'action': 'view',
        'module': 'misc',

    }


    $.post("index.php", postdata, function(data) {
        $("#subcategory" + sel).html(data);
    });

}


function fieldUpdated(sel) {

    var valuestr = sel.id;
    var valueval = sel.value;
    //alert(valueval);

    //var plan = $("#select_plan").val();

    postdata = {
        'action': "model",
        'module': "postad",
        'post': "field",
        'fid': valuestr,
        'value': valueval,
    }

    $.post("index.php", postdata, function(data) {
        //$("#period_select").html(data);														  
    });

}

function fieldUpdated_chain(sel1, sel2) {

    var valuestr1 = sel1.id;
    var valueval1 = sel1.value;

    var valuestr2 = sel2.id;
    var valueval3 = sel2.value;

    alert(valuestr1);

    postdata = {
        'action': "model",
        'module': "postad",
        'post': "field",
        'fid1': valuestr1,
        'value1': valueval1,
        'fid2': valuestr2,
        'value2': valueval2,
    }

    $.post("index.php", postdata, function(data) {
        //$("#period_select").html(data);														  
    });

}

function fieldChain(sel, id, current_id, cat_id, ads_id) {


    $('.gif_cls').show();
    $('#ajax_select').hide();
    var valuestr = current_id;
    var valueval = sel.value;
    var valuestrid = sel.id;

    postdata2 = {
        'action': "model",
        'module': "postad",
        'post': "field",
        'fid': valuestrid,
        'value': valueval,
    }

    $.post("index.php", postdata2, function(data) {
        //$("#period_select").html(data);														  
    });

    postdata = {
        'action': "view",
        'module': "postad",
        'post': "chain",
        'fid': valuestr,
        'value': valueval,
        'cat_id': cat_id,
        'filid': id,
        'id': ads_id,
    }

    $.post("index.php", postdata, function(data) {
        $("#ajax_select").html(data);
        $('#ajax_select').show();
        $('.gif_cls').hide();
        $('.form_txt_1').prop('disabled', false);

    });

}

function fieldChain_add(sel, id, current_id, cat_id) {


    $('.gif_cls').show();
    $('#ajax_select').hide();
    var valuestr = current_id;
    var valueval = sel.value;


    postdata = {
        'action': "view",
        'module': "postad",
        'post': "chain",
        'fid': valuestr,
        'value': valueval,
        'cat_id': cat_id,
        'filid': id,
    }

    $.post("index.php", postdata, function(data) {

        $("#ajax_select").html(data);
        $('#ajax_select').show();
        $('.gif_cls').hide();
        $('.form_txt_1').prop('disabled', false);
    });

}

function ajax_contact() {


    var id_refer = contact_customer.value;

    postdata = {
        'action': "view",
        'module': "postad",
        'post': "contact ajax",
        'id_refer': id_refer,

    }


    $.post("index.php", postdata, function(data) {
        $("#ajax_contact_div").html(data);
    });

}

function readURL(input, image_allowed) {

    var images_count = $("#files")[0].files.length;

    if (input.files && input.files[0]) {

        if (images_count > image_allowed) {
            alert("Picture limit " + image_allowed + "");
            $('#blah').attr('src', 'http://placehold.it/1000x1000');
            $('#files').val('');
        } else {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);

        }

    }
}

function readURL_more(input) {
    if (input.files && input.files[0]) {
        var id = input.id;




        var reader = new FileReader();

        reader.onload = function(e) {
            $("#blah_" + id)
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}