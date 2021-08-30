<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Business</title>
</head>
    <?php
    
    
    include "config/config.php";
    include "helper/misc/misc.php";
    require("controller/index.php");
    $indexcontroller = new indexcontroller();
    $indexcontroller->index();
    ?>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $(function () {
    $('#members_label_id').selectpicker();
});
    </script>
</html>