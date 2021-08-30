<?php
class login extends config{
    
    public function form() {
    ?>
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

      <style>
@import url('https://fonts.googleapis.com/css?family=Titillium+Web:200,200i,300,300i,400,400i,600,600i,700,700i,900');
</style>

<link href="assets/css/floating-labels.css" rel="stylesheet">

<div class="row" style="background: #fff;max-width: 100%;
    width: 100%;background-size: cover;font-family: 'Titillium Web', sans-serif;background-size: contain;">  
    <div class="col-12">
        <form class="form-signin" action="index.php" method="post" style="background-color: rgba(204, 204, 204, 0.47);">
<input type="hidden" name="action" value="model" />
<input type="hidden" name="module" value="login" />
<input type="hidden" name="post" value="login" />
      <div class="text-center mb-4">
        <img class="mb-4" src="assets/img/abovvin.png" alt="" height="100">
        <h1 class="h3 mb-3 font-weight-600 text-dark">Abocarz</h1>
        <h5 class="text-dark">Portal Admin</h5>
       
      </div>

      <div class="form-label-group">
        <input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="Username" required autofocus>
        <label for="inputEmail">Username</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>

      
      <button class="btn btn-lg btn-primary btn-block" type="submit" style="background:#399bc8;">Sign in</button>
      <p class="mt-5 mb-3 text-muted text-center"><i class="fa fa-copyright"></i> The Abocarz Portal 2020</p>
    </form></div>

    
    </div>

    <!-- /#page-content-wrapper -->
    
<script defer src="assets/fontawesome-free-5.11.2-web/js/all.js"></script>
<script defer src="assets/fontawesome-free-5.11.2-web/js/brands.min.js"></script>
<script defer src="assets/fontawesome-free-5.11.2-web/js/fontawesome.min.js"></script>
<script defer src="assets/fontawesome-free-5.11.2-web/js/regular.min.js"></script>
<script defer src="assets/fontawesome-free-5.11.2-web/js/solid.min.js"></script>
<script defer src="assets/fontawesome-free-5.11.2-web/js/v4-shims.min.js"></script>
<!--<script src="assets/js/jquery.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
<script src="assets/js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!--    datatables-->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.dataTables.min.js"></script>
<script src="assets/js/dataTables.responsive.min.js"></script>
<script src="assets/js/responsive.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/scroller/2.0.1/js/dataTables.scroller.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>

<?php
    }
    
}
?>