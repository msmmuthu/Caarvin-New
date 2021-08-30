<?php



class menu extends config{

    public function is_submenu($id) {
        $query_menu = mysqli_query($this->mysqlConfig(),"SELECT * FROM `menu` where menu_sub=$id order by menu_order asc");
        $no = mysqli_num_rows($query_menu);
        return $no;
    }
    public function submenu($id) {
        $query_menu = mysqli_query($this->mysqlConfig(),"SELECT * FROM `menu` where menu_sub=$id order by menu_order asc");
        while($row_menu = mysqli_fetch_object($query_menu)){ 
          
        ?>
 <div id="item-<?php echo $id; ?>" class="collapse <?php if(isset($_REQUEST['module'],$_REQUEST['post']) && $_REQUEST['module']==$row_menu->menu_module){ echo 'show'; } ?>">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link pl-4 <?php if(isset($_REQUEST['module'],$_REQUEST['post']) && $_REQUEST['module']==$row_menu->menu_module && $_REQUEST['post']==$row_menu->menu_post){ echo 'active'; } ?>" href="<?php echo $row_menu->menu_url; ?>"><i class="<?php echo $row_menu->menu_ico; ?>"></i> <?php echo $row_menu->menu_label; ?></a>
                  </li>
                </ul>
 </div>
        

            <?php
        }
    }
	
    public function menus(){
	
	 
        $query_menu = mysqli_query($this->mysqlConfig(),"SELECT * FROM `menu` where menu_parent=1 order by menu_order asc");
        while($row_menu = mysqli_fetch_object($query_menu)){ ?>
          <li class="nav-item">
              <?php if($this->is_submenu($row_menu->menu_id)!=0){ ?>
              <a class="nav-link" data-toggle="collapse" href="#item-<?php echo $row_menu->menu_id; ?>" data-parent="#accordion1" aria-expanded="<?php if(isset($_REQUEST['module'],$_REQUEST['post']) && $_REQUEST['module']==$row_menu->menu_module && $_REQUEST['post']==$row_menu->menu_post){ echo 'true'; } else { echo 'false'; } ?>"><i class="<?php echo $row_menu->menu_ico; ?>"></i> <?php echo $row_menu->menu_label; ?>  <span class="sub_link"><i class="fas fa-arrow-circle-down"></i></span> </a>
              <?php } else { ?>
              <a class="nav-link <?php if(isset($_REQUEST['module'],$_REQUEST['post']) && $_REQUEST['module']==$row_menu->menu_module && $_REQUEST['post']==$row_menu->menu_post){ echo 'active'; } ?>" href="<?php echo $row_menu->menu_url; ?>"><i class="<?php echo $row_menu->menu_ico; ?>"></i> <?php echo $row_menu->menu_label; ?></a>
              <?php } ?>
              <?php $this->submenu($row_menu->menu_id)?>
          </li>
            <?php } 
    }

	

}

?>