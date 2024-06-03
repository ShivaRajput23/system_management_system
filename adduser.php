<?php

include "../config/connection.php";
include "../config/function.php";
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
}

if(isset($_POST['Submit'])){
    $systemno=$_POST['systemno'];
    $cpuno=$_POST['cpu'];
    $ramslot=$_POST['ramslot'];
    $ups=$_POST['ups'];
    $monitor=$_POST['monitor'];
    $wifi=$_POST['wifi'];
    $syspassword=$_POST['syspassword'];

    $sql="SELECT * FROM data where '$systemno'=system_no";
    $data=mysqli_query($conn,$sql);
    $rows=mysqli_fetch_assoc($data);
    
    if(isset($rows['system_no'])>0){
      echo "<script>alert('System Already Assigned')</script>";
  }
  else{
   $sql="INSERT INTO data(system_no,cpu_no,ram_slot,ups_no,monitor_no,wifi_name,system_password)
    VALUES('$systemno','$cpuno','$ramslot','$ups','$monitor','$wifi','$syspassword')";
    $data=mysqli_query($conn,$sql);
    ?>
    <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/dashboard.php"/>
  
    <?php
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mediatrenz</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <?php
        include "../navbar/navbar.php";
        include "../navbar/sidebar.php";
    ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid"> 
                <div class="row">                    
                    <div class="col-sm-5">
                        <div class="card card-secondary">
                            <div class="card-header">
                                
                                <h3 class="card-title">Edit Product</h3>
                            </div>
                                <form class="form-horizontal" method="POST" action=#>
                                    <div class="card-body">
                                      <div class="form-group row">
                                          <label for="inputEmail3" class="col-sm-3 col-form-label">System No.</label>
                                          <div class="col-sm-6">
                                          <input type="text" class="form-control" id="inputEmail3" placeholder="System NO." name="systemno">
                                          </div>
                                      </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label">CPU No.</label>
                                        <div class="col-sm-6">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="Product Name" name="cpu">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">RAM slot</label>
                                        <div class="col-sm-6">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Product No" name="ramslot">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">UPS No.</label>
                                        <div class="col-sm-6">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Size" name="ups">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputEmail3" class="col-sm-3 col-form-label">Monitor No.</label>
                                      <div class="col-sm-6">
                                      <input type="text" class="form-control" id="inputEmail3" placeholder="Product Type" name="monitor">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputEmail3" class="col-sm-3 col-form-label">Wifi Name</label>
                                      <div class="col-sm-6">
                                      <input type="text" class="form-control" id="inputEmail3" placeholder="Product Type" name="wifi">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputEmail3" class="col-sm-3 col-form-label">System Password</label>
                                      <div class="col-sm-6">
                                      <input type="text" class="form-control" id="inputEmail3" placeholder="Product Type" name="syspassword">
                                      </div>
                                    </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                    <button type="submit" class="btn btn-info" name="Submit">Submit</button>
                                    </div>
                                <!-- /.card-footer -->
                                </form>
                        </div>   
                    </div>
                </div>                 
            </div> 
        </div>
    </div>
</div>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>
</body>
</html>












