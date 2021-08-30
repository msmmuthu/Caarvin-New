<?php

class indexcontroller extends config{

    public function index() {
        
        require("config/instance.php");
			
		if(empty($_SESSION['fm']['portal']['userid'])){
			require("helper/controller/unsession.php");
                        
		}
		else{
			if(isset($_REQUEST['action']) and $_REQUEST['action'] == "config" and $_REQUEST['module'] == "session" and $_REQUEST['post']=="clear"){
                            require("view/static/header.php");
                            $instanceClass->clear();
                            require("view/static/footer.php");
			}
                        
			
				// Ajax Action
				if(isset($_POST['uname'])){
					$this->loginVerifyAction();
				}
				
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "scheme" && $_REQUEST['post'] == "request_list"){
					require("view/static/header.php");
					$instanceClass->request_list();
					require("view/static/footer.php");
				}
				
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "scheme" && $_REQUEST['post'] == "add"){
					require("view/static/header.php");
					$instanceClass->add();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "scheme" && $_REQUEST['post'] == "list"){
					require("view/static/header.php");
					$instanceClass->list_scheme();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "scheme" && ($_REQUEST['process'] == "activate" || $_REQUEST['process'] == "deactivate")){
					require("view/static/header.php");
					$instanceClass->activate();
					require("view/static/footer.php");
				}
				
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "scheme" && $_REQUEST['post'] == "delete"){
					require("view/static/header.php");
					$instanceClass->delete();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "scheme" && $_REQUEST['post'] == "insert"){
					require("view/static/header.php");
					$instanceClass->insert();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "scheme" && $_REQUEST['post'] == "approve"){
					require("view/static/header.php");
					$instanceClass->approve();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "scheme" && $_REQUEST['post'] == "approved"){
					require("view/static/header.php");
					$instanceClass->approved();
					require("view/static/footer.php");
				}
				
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "category" && $_REQUEST['post'] == "list"){
					require("view/static/header.php");
					$instanceClass->listing();
					require("view/static/footer.php");
				}
				
				
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "category" && $_REQUEST['post'] == "sub"){
					require("view/static/header.php");
					$instanceClass->listing();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "category" && $_REQUEST['post'] == "hidden"){
					require("view/static/header.php");
					$instanceClass->hide();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "category" && $_REQUEST['post'] == "delete"){
					require("view/static/header.php");
					$instanceClass->delete();
					require("view/static/footer.php");
				}
				elseif(isset($_POST['update_chain'])){
					require("view/static/header.php");
					$instanceClass->chainfieldupdate();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "selectAjaxValues"){
					$instanceClass->selectAjaxValues();
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "edit"){
					require("view/static/header.php");
					$instanceClass->general();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "general"){
					require("view/static/header.php");
					$instanceClass->general();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "managefield"){
					require("view/static/header.php");
					$instanceClass->managefield();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "update field"){
					$instanceClass->updateQuickedit();
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "chainfield"){
					require("view/static/header.php");
					$instanceClass->chainfield();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "updatechain"){
					require("view/static/header.php");
					$instanceClass->chainvalueupdate();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "resetchain"){
					require("view/static/header.php");
					$instanceClass->chainvaluereset();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "delete"){
					require("view/static/header.php");
					$instanceClass->delete();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "update"){
					require("view/static/header.php");
					$instanceClass->update();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "add"){
					require("view/static/header.php");
					$instanceClass->add();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "dropdownvalue"){
					require("view/static/header.php");
					$instanceClass->dropdownvalue();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "dropdownvalueupdate"){
					//require("view/static/header.php");
					$instanceClass->dropdownvalueupdate();
					//require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $_REQUEST['module'] == "fields" && $_REQUEST['post'] == "dropdownvaluedelete"){
					require("view/static/header.php");
					$instanceClass->dropdownvaluedelete();
					require("view/static/footer.php");
				}
				
				
				
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $_REQUEST['module'] == "category" && $_REQUEST['post'] == "addnew"){
					require("view/static/header.php");
					$instanceClass->form();
					require("view/static/footer.php");
				}
				
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "customer"){
					require("view/static/header.php");
					require("view/category/category.php");
					$instanceClass->customerList();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "reference"){
					require("view/static/header.php");
					require("view/category/category.php");
					$instanceClass->form();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "reference"){
					require("view/static/header.php");
					require("view/category/category.php");
					$instanceClass->save();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "report" && $_REQUEST['post'] == "list"){
					$instanceClass->business();
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "report" && $_REQUEST['post'] == "listing"){
					require("view/static/header.php");
					$instanceClass->reports();
					require("view/static/footer.php");
				}
				
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "user" && $_REQUEST['post'] == "user"){
					require("view/static/header.php");
					require("view/category/category.php");
					$instanceClass->form();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "user" && $_REQUEST['post'] == "usertype"){
					require("view/static/header.php");
					//require("view/category/category.php");
					$instanceClass->usertype_list();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "user" && $_REQUEST['post'] == "usertype"){
					require("view/static/header.php");
					//require("view/category/category.php");
					$instanceClass->usertype_list();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "user" && $_REQUEST['post'] == "addusertype"){
					require("view/static/header.php");
					//require("view/category/category.php");
					$instanceClass->usertype_form();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "user" && $_REQUEST['post'] == "addusertype"){
					require("view/static/header.php");
					//require("view/category/category.php");
					$instanceClass->usertype_add();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "user" && $_REQUEST['post'] == "editusertype"){
					require("view/static/header.php");
					$instanceClass->usertype_edit();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action']== "model" && $module == "user" && $_REQUEST['post'] == "editusertype"){
					require("view/static/header.php");
					$instanceClass->usertype_edit();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "customers" && isset($_REQUEST['smspost'])){
					
					$instanceClass->smsAccept();
					
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "smsreport"){
					require("view/static/header.php");
					
					$instanceClass->index();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "sms"){
					require("view/static/header.php");
					require("view/category/category.php");
					$instanceClass->form();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "sms"){
					require("view/static/header.php");
					require("view/category/category.php");
					$instanceClass->save();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "customers" && isset($_REQUEST['id'])){
					require("view/static/header.php");
					require("view/category/category.php");
					$instanceClass->customerList_privacy();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "privacy"){
					require("view/static/header.php");
					require("view/category/category.php");
					$instanceClass->categoryList();
					require("view/static/footer.php");
				}
                                elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "adsb"){
					//require("view/static/header.php");
					//require("view/adsb/adsb.php");
					$instanceClass->categoryList();
					//require("view/static/footer.php"); 
				} 
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "settings"){
					require("view/static/header.php");
					$instanceClass->change_password();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "Ads" && $_REQUEST['post'] == "picture"){
					require("view/static/header.php");
					$instanceClass->Ads_Add_picture();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "Ads" && $_REQUEST['post'] == "update_validity_1"){
				//require("view/static/header.php");
					//$instanceClass->update_validity_1();
					//require("view/static/footer.php");
				$id = $_POST['id'];
				$val = $_POST['val'];
				
				mysqli_query($this->mysqlConfig(),"UPDATE `pic_addpost` SET `pic_validity_auto` = $val,`pic_validity` = '' WHERE `pic_addpost`.`pic_ads_id` = $id");
		
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "Ads" && $_REQUEST['post'] == "update_validity_2"){
		$id = $_POST['id'];
		$values = $_POST['values'];
		
		mysqli_query($this->mysqlConfig(),"UPDATE `pic_addpost` SET `pic_validity_auto` = '0',`pic_validity` = '$values' WHERE `pic_addpost`.`pic_ads_id` = $id");
		echo "<script>alert('Validity Set Successfully');</script>";
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "Ads" && $_REQUEST['post'] == "picture"){
					require("view/static/header.php");
					$instanceClass->Ads_Add_picture();
					require("view/static/footer.php");
				}
				
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "Ads" && $_REQUEST['post'] == "delete"){
					$instanceClass->delete();
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "Ads" && $_REQUEST['post'] == "deleterefund"){
					$instanceClass->deleterefund();
				}
				
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "Ads" && $_REQUEST['post'] == "list"){
					require("view/static/header.php");
					$instanceClass->Ads_list();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "Ads" && $_REQUEST['post'] == "edit"){
					require("view/static/header.php");
					$instanceClass->index();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "Ads" && $_REQUEST['post'] == "update"){
					require("view/static/header.php");
					$instanceClass->update();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "Ads" && $_REQUEST['post'] == "field"){
					require("view/static/header.php");
					$instanceClass->update_field();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "Ads" && $_POST['post'] == "request"){
					
					$instanceClass->update_status();
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "Ads" && $_REQUEST['post'] == "tagform"){
					require("view/static/header.php");
					$instanceClass->Ads_Add_tag();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "Ads" && $_REQUEST['post'] == "Tags Insert"){
					require("view/static/header.php");
					$instanceClass->Ads_Add_tag_insert();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "Ads" && $_REQUEST['post'] == "act" && isset($_REQUEST['id'])){
					$instanceClass->Ads_Add_active_insert();
				}
                elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "Ads" && $_REQUEST['post'] == "deact" && isset($_REQUEST['id'])){
					$instanceClass->Ads_Add_deactive_insert();
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "settings"){
					require("view/static/header.php");
					$instanceClass->change_password();
					require("view/static/footer.php");
				}
                               elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "categorys" && isset($_REQUEST['id'])){
			       require("view/static/header.php");
		               require("view/category/category.php");
		     	       $instanceClass->form1();
		               require("view/static/footer.php");
				}
                               elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "editcategory" && isset($_REQUEST['id'])){
			       require("view/static/header.php");
		               require("view/category/category.php");
		     	       $instanceClass->form1();
		               require("view/static/footer.php");
				} 
                               elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "delcategorys" && isset($_REQUEST['id'])){
			       require("view/static/header.php");
		               require("view/category/category.php");
		     	       $instanceClass->delcat();
		               require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "likes" && $_REQUEST['post'] == "list"){
					require("view/static/header.php");
					$instanceClass->likes_list();
					require("view/static/footer.php");
				}
                                
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "category"){
					$instanceClass->insert();
					}
					
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "edtcategory"){
					$instanceClass->update();
					}
					
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "users"){
					$instanceClass->insert();
					
				}
                 elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "customers" && empty($_REQUEST['id'])){
					$instanceClass->inserts();
					
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "customers" && isset($_REQUEST['id']) && $_REQUEST['post']==1){
					
					$instanceClass->agentAccept();
					
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "administrator" && $_REQUEST['post'] == "administrator"){
					require("view/static/header.php");
					$instanceClass->listing();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "administrator" && $_REQUEST['post'] == "edit"){
					require("view/static/header.php");
					$instanceClass->admin_edit();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "administrator" && $_REQUEST['post'] == "add"){
					require("view/static/header.php");
					$instanceClass->admin_add();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "administrator" && $_REQUEST['post'] == "validity_add"){
					require("view/static/header.php");
					$instanceClass->validity_add();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "administrator" && $_REQUEST['post'] == "validity_add"){
					require("view/static/header.php");
					$instanceClass->validity_add();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "administrator" && $_REQUEST['post'] == "edit"){
					require("view/static/header.php");
					$instanceClass->edit();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "administrator" && $_REQUEST['post'] == "add"){
					require("view/static/header.php");
					$instanceClass->add();
					require("view/static/footer.php");
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "customers" && isset($_REQUEST['id']) && $_REQUEST['post']==0){
					
					$instanceClass->agentAccept();
					
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "model" && $module == "customers" && isset($_REQUEST['id']) && $_REQUEST['post']==2){
					$instanceClass->agentDelete();
				}
				elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "view" && $module == "category" && $_REQUEST['post'] == "sub category"){
					$instanceClass->select();
					
				}
				
                        
                        else{
                            require("view/static/header.php");
                            require("view/dashboard/dashboard.php");
                            $dashboard = new dashboard();
                            $dashboard->main();
                            require("view/static/footer.php");
                        }
		}
    }

   

}
?>