<?php
    if(isset($_REQUEST['action']) and $_REQUEST['action'] == "view" and $_REQUEST['module'] == "login"){
        $instanceClass->form();
    }
    elseif(isset($_REQUEST['action']) and $_REQUEST['action'] == "model" and $_REQUEST['module'] == "login"){
        $instanceClass->logged();
    }
    elseif(isset($_REQUEST['action']) and !isset($_REQUEST['post']) and $_REQUEST['action'] == "view" and $_REQUEST['module'] == "details"){
        require("view/static/header.php");
        $instanceClass->main();
        require("view/static/footer.php");
    }

    else{
        login();
    }
    
    function login() {
        require("view/login/login.php");
        $login = new login();
        $login->form();
    }
		
?>
