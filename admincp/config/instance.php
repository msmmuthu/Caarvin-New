<?php
if(isset($_REQUEST['action'])){
$action = $_REQUEST['action'];
$module = $_REQUEST['module'];

require("".$action."/".$module."/".$module.".php");
$instanceClass = new  $module();

}

?>