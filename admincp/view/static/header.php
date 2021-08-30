<script src="assets/js/jquery.min.js"></script>

<link href="assets/css/style.css" rel="stylesheet"> <!--load all styles -->


<link href="assets/fontawesome-free-5.11.2-web/css/all.css" rel="stylesheet"> <!--load all styles -->
<link href="assets/fontawesome-free-5.11.2-web/css/regular.min.css" rel="stylesheet">
<link href="assets/fontawesome-free-5.11.2-web/css/fontawesome.min.css" rel="stylesheet">
<link href="assets/fontawesome-free-5.11.2-web/css/brands.min.css" rel="stylesheet">
<link href="assets/fontawesome-free-5.11.2-web/css/solid.css" rel="stylesheet">
<link href="assets/fontawesome-free-5.11.2-web/css/svg-with-js.min.css" rel="stylesheet">
<link href="assets/fontawesome-free-5.11.2-web/css/v4-shims.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<!-- datatables -->
<link href="assets/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="assets/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/scroller/2.0.1/css/scroller.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/scroller/2.0.1/css/scroller.bootstrap4.min.css" rel="stylesheet">
<!-- Croppie -->
<link rel='stylesheet' href='https://foliotek.github.io/Croppie/croppie.css'>

 <div class="d-flex" id="wrapper">
     
     <?php if($_SESSION['fm']['portal']['userid']!=""){ ?>
<!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><?php echo $_SESSION['fm']['portal']['username']; ?> </div>
      <div class="list-group list-group-flush">
       <ul id="accordion1" class="nav nav-pills flex-column dashbord_menu">
           <?php
           require("helper/menu/menu.php");
		$menu= new menu();
		$menu->menus();
           ?>
  
</ul>
      </div>
    </div>
     <?php } ?>
<!-- Page Content -->
    <div id="page-content-wrapper">
<?php 

if($_SESSION['fm']['portal']['userid']!=""){ ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
<!--            <li class="nav-item active">
              <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>-->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                My Account
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
               
                <a class="dropdown-item" href="index.php?action=config&module=session&post=clear">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
<?php } ?>

<!-- /#sidebar-wrapper -->
    
    <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

