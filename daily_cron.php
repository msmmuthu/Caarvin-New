<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require "config/config.php";
$configu = new config();
$conn = $configu->mysqlConfig();

$date_current = date('Y-m-d');

$where = "SELECT a.pic_ads_id from pic_addpost a
INNER JOIN pic_scheme_user su ON su.pic_scheme_user_id = a.addpost_scheme_user_id
where su.scheme_expiry<='$date_current'";

mysqli_query($conn,"DELETE FROM `pic_addpost_field` WHERE addpost_uni_id in (".$where.");DELETE FROM `pic_addpost_images` WHERE addpost_id in (".$where.");");
mysqli_query($conn,"DELETE FROM `pic_addpost` WHERE pic_ads_id in (".$where.");");
?>

