<?php

class indexcontroller {

    public function index() {
	
   
    	require("config/instance.php");

        // START - LOGIN & REGISTRATION ACTION
        if (isset($_POST['post']) and $_POST['post'] =='login_submit' and $_SESSION['pic']['biscuit']['userid'] == "") {
           
            $instanceClass->logincheck();
        }
        if (isset($_POST['register']) and $_SESSION['pic']['biscuit']['userid'] == "") {
           
            $instanceClass->register();
        }
		// END - LOGIN & REGISTRATION ACTION
		
        
        if (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "account" && $_REQUEST['post'] == "login_submit") {
            require("view/static/header.php");
            $instanceClass->form();
            require("view/static/footer.php");
        }
		elseif(isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "postad" && $_POST['post']=="chain" && !empty($_SESSION['pic']['biscuit']['userid'])){
			//require("view/static/header.php");
            $instanceClass->ajaxChain();
            //require("view/static/footer.php");
        } 
		elseif(isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "products" && $_REQUEST['post'] == "loadsub") {
		$instanceClass->selectSub();
        }
       
        
		elseif (isset($_POST['post']) and $_POST['post'] == "account insert") {
            require("view/static/header.php");
            $instanceClass->register();
            require("view/static/footer.php");
        }
        	elseif (isset($_REQUEST['post']) and $_REQUEST['post'] == "smsvalidate") {
            require("view/static/header.php");
            $instanceClass->smsForm();
            require("view/static/footer.php");
        }
        elseif (isset($_POST['post']) and $_POST['post'] == "smsvalidated") {
            require("view/static/header.php");
            $instanceClass->smsValidated();
            require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['post']) and $_REQUEST['post'] == "email") {
            require("view/static/header.php");
            $instanceClass->emailvalidate();
            require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "categories" && !isset($_REQUEST['cat_id'])) {
            require("view/static/header.php");
            $instanceClass->select();
            require("view/static/footer.php");
	}elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "categories" && isset($_REQUEST['cat_id'])) {
		require("view/static/header.php");
		$instanceClass->subcategories();
		require("view/static/footer.php");
        }
        
		elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "products" && $_REQUEST['post'] == "selectads") {
		//require("view/static/header.php");
		
		$instanceClass->select();
		//require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "products" && $_REQUEST['post'] == "loadmoreads") {
		//require("view/static/header.php");
		$instanceClass->filter_loadmore();
		//require("view/static/footer.php");
        }
		
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "products" && isset($_REQUEST['filter']) && $_REQUEST['filter']=="yes") {
		//require("view/static/header.php");
		$instanceClass->filter();
		//require("view/static/footer.php");
        }
		
		     
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "products" && isset($_REQUEST['cat_id']) && !isset($_REQUEST['filter'])) {          
            require("view/static/header.php");
            if($_REQUEST['cat_id']  == '109'){

                  $instanceClass->list_productswebsite();

            }else{

                  $instanceClass->list_products();

            }
            require("view/static/footer.php");
      }
        // SEARCH 
        
        	elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "search" && $_REQUEST['post'] == "selectads") {
		//require("view/static/header.php");
		
		$instanceClass->select();
		//require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "search" && $_REQUEST['post'] == "loadmoreads") {
		//require("view/static/header.php");
		$instanceClass->filter_loadmore();
		//require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "search" && $_REQUEST['post'] == "loadsub") {
		//require("view/static/header.php");
		$instanceClass->selectSub();
		//require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "search" && isset($_REQUEST['filter']) && $_REQUEST['filter']=="yes") {
		//require("view/static/header.php");
		$instanceClass->filter();
		//require("view/static/footer.php");
        }
		
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "search" && isset($_REQUEST['cat_id']) && !isset($_REQUEST['filter'])) {
		require("view/static/header.php");
		$instanceClass->list_products();
		require("view/static/footer.php");
        }
        // OWNER 
        
        	elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "owner" && $_REQUEST['post'] == "selectads") {
		//require("view/static/header.php");
		
		$instanceClass->select();
		//require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "owner" && $_REQUEST['post'] == "loadmoreads") {
		//require("view/static/header.php");
		$instanceClass->filter_loadmore();
		//require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "owner" && $_REQUEST['post'] == "loadsub") {
		//require("view/static/header.php");
		$instanceClass->selectSub();
		//require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "owner" && isset($_REQUEST['filter']) && $_REQUEST['filter']=="yes") {
		//require("view/static/header.php");
		$instanceClass->filter();
		//require("view/static/footer.php");
        }
		
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "owner" && $_REQUEST['post'] == "list") {
		require("view/static/header.php");
		$instanceClass->list_products();
		require("view/static/footer.php");
        }

        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "owner_cat" && $_REQUEST['post'] == "list" && $_REQUEST['categories_id']!='') {
            
            require("view/static/header.php");
            $instanceClass->list_products_categry();
            require("view/static/footer.php");
            }
		
		// SEARCH IN SUB CATEGORY
		
		elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "searchincat" && $_REQUEST['post'] == "selectads") {
		//require("view/static/header.php");
		
		$instanceClass->select();
		//require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "searchincat" && $_REQUEST['post'] == "loadmoreads") {
		//require("view/static/header.php");
		$instanceClass->filter_loadmore();
		//require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "searchincat" && $_REQUEST['post'] == "loadsub") {
		//require("view/static/header.php");
		$instanceClass->selectSub();
		//require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "searchincat" && isset($_REQUEST['filter']) && $_REQUEST['filter']=="yes") {
		//require("view/static/header.php");
		$instanceClass->filter();
		//require("view/static/footer.php");
        }
		
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "searchincat" && isset($_REQUEST['cat_id']) && !isset($_REQUEST['filter'])) {
		require("view/static/header.php");
		$instanceClass->list_products();
		require("view/static/footer.php");
        }
		
		// END SEARCH IN SUB CATEGORY
        
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "product_detail") {
            require("view/static/header.php");
            $instanceClass->details();
            require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "request_detail") {
            require("view/static/header.php");
            $instanceClass->details();
            require("view/static/footer.php");
        }
        elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "model" && $_REQUEST['module'] == "product_detail" && $_REQUEST['post'] == "like") {
            require("view/static/header.php");
            $instanceClass->like();
            require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "model" && $_REQUEST['module'] == "request_detail" && $_REQUEST['post'] == "like") {
            require("view/static/header.php");
            $instanceClass->like();
            require("view/static/footer.php");
        }
         elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "postad" && $_REQUEST['post']=="contact ajax") {
            
            $instanceClass->ajax_conatctDetails();
            
        }
        elseif (isset($_GET['action']) and $_GET['action'] == "model" && $_GET['module'] == "postad" && $_GET['posts']=="img") {
            
            $instanceClass->update_image();
            
        }
        elseif (!isset($_POST['post']) and isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "postad") {
            require("view/static/header.php");
            $instanceClass->index();
            require("view/static/footer.php");
        }
        elseif (!isset($_POST['post']) and isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "requestad") {
            require("view/static/header.php");
            $instanceClass->index();
            require("view/static/footer.php");
        }
	   
        
        elseif (isset($_POST['post']) and isset($_REQUEST['action']) and $_REQUEST['action'] == "helper" && $_REQUEST['module'] == "location" and $_POST['post']=="taluk") {
	   
	    $instanceClass->taluk();
	   
       
        } 
         elseif (isset($_POST['post']) and isset($_REQUEST['action']) and $_REQUEST['action'] == "helper" && $_REQUEST['module'] == "location" and $_POST['post']=="talukAll") {
	   
	    $instanceClass->talukAll();
	   
       
        } 
        
        elseif (isset($_POST['post']) and isset($_REQUEST['action']) and $_REQUEST['action'] == "model" && $_REQUEST['module'] == "account" and $_POST['post']=="checkid") {
	   
	    $instanceClass->checkUserId();
	   
       
        } 
        
        
         elseif (isset($_POST['post']) and $_POST['post'] == "requestad insert") {
            require("view/static/header.php");
			
            $instanceClass->insert();
            require("view/static/footer.php");
        }
         elseif (isset($_POST['post']) and $_POST['post'] == "requestad update") {
            require("view/static/header.php");
            $instanceClass->update();
            require("view/static/footer.php");
        }
		elseif (isset($_POST['post']) and $_POST['post'] == "postad insert") {
            require("view/static/header.php");
			
            $instanceClass->insert();
            require("view/static/footer.php");
        }
         elseif (isset($_POST['post']) and $_POST['post'] == "postad update") {
            require("view/static/header.php");
            $instanceClass->update();
            require("view/static/footer.php");
        }
		
	 	
		// START - SESSION IN
		
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "model" && $_REQUEST['module'] == "postad" && $_POST['post']=="postad insert" && !empty($_SESSION['pic']['biscuit']['userid'])){
            require("view/static/header.php");
            $instanceClass->insert();
            require("view/static/footer.php");
        }
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "model" && $_REQUEST['module'] == "postad" && $_POST['post']=="postad update" && !empty($_SESSION['pic']['biscuit']['userid'])){
            require("view/static/header.php");
            $instanceClass->update();
            require("view/static/footer.php");
        }
		 elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "model" && $_REQUEST['module'] == "postad" && $_POST['post']=="field" && !empty($_SESSION['pic']['biscuit']['userid'])){
			//require("view/static/header.php");
            $instanceClass->update_field();
            //require("view/static/footer.php");
        }
		
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "model" && $_REQUEST['module'] == "requestad" && $_POST['post']=="requestad insert" && !empty($_SESSION['pic']['biscuit']['userid'])){
            require("view/static/header.php");
            $instanceClass->insert();
            require("view/static/footer.php");
        }
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "model" && $_REQUEST['module'] == "requestad" && $_POST['post']=="requestad update" && !empty($_SESSION['pic']['biscuit']['userid'])){
            require("view/static/header.php");
            $instanceClass->update();
            require("view/static/footer.php");
        }
         elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "myaccount" && $_REQUEST['post'] == "profile" && !empty($_SESSION['pic']['biscuit']['userid'])) {
           
            require("view/static/header.php");
            $instanceClass->profile();
            require("view/static/footer.php");
           
        }
		
	elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "myaccount" && !isset($_REQUEST['task']) && !empty($_SESSION['pic']['biscuit']['userid'])) {
            require("view/static/header.php");
            $instanceClass->index();
            require("view/static/footer.php");
        }
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "model" && $_REQUEST['module'] == "myaccount" && $_REQUEST['post'] == "update" && !empty($_SESSION['pic']['biscuit']['userid'])) {
           
            require("view/static/header.php");
            $instanceClass->updatePass();
            require("view/static/footer.php");
        }
       
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "myaccount" && $_REQUEST['task'] == "scehmelist" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            require("view/static/header.php");
            $instanceClass->schemeList();
            require("view/static/footer.php");
        }
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "model" && $_REQUEST['module'] == "myaccount" && $_REQUEST['task'] == "scheme save" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            require("view/static/header.php");
            $instanceClass->schemeSave();
            require("view/static/footer.php");
        }

         elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "myaccount" && $_REQUEST['task'] == "myscheme" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            require("view/static/header.php");
            $instanceClass->myScheme();
            require("view/static/footer.php");
        }
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "myaccount" && $_REQUEST['task'] == "mybalance" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            require("view/static/header.php");
            $instanceClass->myBalance();
            require("view/static/footer.php");
        }
        
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "myaccount" && $_REQUEST['task'] == "mylike" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            require("view/static/header.php");
            $instanceClass->myLike();
            require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "myaccount" && $_REQUEST['task'] == "mycat" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            require("view/static/header.php");
            $instanceClass->myCat();
            require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "myaccount" && $_REQUEST['task'] == "myloc" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            require("view/static/header.php");
            $instanceClass->myLoc();
            require("view/static/footer.php");
        }
        
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "add_history" && $_REQUEST['post'] == "update field" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            
			$instanceClass->updateValue();
        }
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "add_history" && $_REQUEST['post'] == "update price" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            
			$instanceClass->updatePrice();
        }
		 elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "add_history" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            require("view/static/header.php");
            $instanceClass->index();
            require("view/static/footer.php");
        }
		 elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "user_list" && !empty($_SESSION['pic']['biscuit']['userid']) && $_REQUEST['post'] == "list") {
            require("view/static/header.php");
            $instanceClass->index();
            require("view/static/footer.php");
        }
		elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "user_list" && !empty($_SESSION['pic']['biscuit']['userid']) && $_REQUEST['post'] == "add") {
            require("view/static/header.php");
            $instanceClass->register();
            require("view/static/footer.php");
        }
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "req_history" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            require("view/static/header.php");
            $instanceClass->index();
            require("view/static/footer.php");
        }
        elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "like_history" && !empty($_SESSION['pic']['biscuit']['userid'])) {
            require("view/static/header.php");
            $instanceClass->index();
            require("view/static/footer.php");
        }
        elseif(isset($_REQUEST['action']) and $_REQUEST['action'] == "config" && $_REQUEST['module'] == "session" && !empty($_SESSION['pic']['biscuit']['userid'])){
		$instanceClass->clear();
		$this->home();
	  //echo "hi1";
	   }
	   // END - SESSION IN


        else {
        //echo "hi2";

             if (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "search" && $_REQUEST['post'] == "query") {
           
             
             $instanceClass->index();
             
           
             }
             elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "search" && $_REQUEST['post'] == "form" && $_REQUEST['post2'] != "loadmoresearch") {
             //echo "hi2-2";
             require("view/static/header.php");
             $instanceClass->list_products();
              require("view/static/footer.php");
           
             }
			  elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "search" && $_REQUEST['post'] == "form" && $_REQUEST['post2'] == "loadmoresearch") {
            
             $instanceClass->list_products_loadmore();
           
           
             }

             elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "search_cat" && $_REQUEST['post'] == "form" && $_REQUEST['post2'] == "loadmoresearch") {
                $instanceClass->list_products_loadmore_cat();
              

                }




             elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "search" && $_REQUEST['post'] == "filter") {
             //echo "hi2-4";
             require("view/static/header.php");
             $instanceClass->filter();
             require("view/static/footer.php");
           
             }
             
             elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "owner" && $_REQUEST['post'] == "form" && $_REQUEST['post2'] != "loadmoresearch") {
             
                require("view/static/header.php");
             $instanceClass->list_products();
              require("view/static/footer.php");
             }
             elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "owner" && $_REQUEST['post'] == "form" && $_REQUEST['post2'] == "loadmoresearch") {
             $instanceClass->list_products_loadmore();
             }
             elseif (isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "owner" && $_REQUEST['post'] == "filter") {
             require("view/static/header.php");
             $instanceClass->filter();
             require("view/static/footer.php");
             }
             
			elseif (isset($_POST['action'],$_POST['post']) and $_POST['action'] == "view" && $_POST['module'] == "misc" and $_POST['post']=="subcat") {
			$instanceClass->subcategory();
			
			}
			elseif (isset($_REQUEST['action'],$_REQUEST['post']) and $_REQUEST['action'] == "helper" && $_REQUEST['module'] == "misc" and $_REQUEST['post']=="likeForm") {
			$instanceClass->likeForm();
			
			} 
              elseif (isset($_POST['action']) and $_POST['action'] == "view" && $_POST['module'] == "contact" and $_POST['post']=="send") {
	     //echo "hi2-6";
	     $instanceClass->sends();
       
             }
             elseif(isset($_REQUEST['action']) and $_REQUEST['action'] == "view" && $_REQUEST['module'] == "contact" && $_REQUEST['post'] == "form"){
             //echo "hi2-7";
             require("view/static/header.php");
             $instanceClass->form();
             require("view/static/footer.php");
             }
        
             else{
             //echo "hi2-8";
        
             $this->home();
            
             }
        }
    }

    public function home() {

        //echo "hi2-9";
        require("view/static/header.php");
        require("view/postad/product.php");
        require("view/static/footer.php");
    }

    public function myaccount() {
        //echo "hi2-10";
        require("view/static/header.php");
        require("view/myaccount/myaccount.php");
        require("view/static/footer.php");
    }

}

?>