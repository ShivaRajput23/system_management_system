<?php
    include "../config/connection.php";
    include "../config/function.php";

    if (!isset($_SESSION['login'])) {
        header("location:login.php");
        exit;
    }
    $id=$_GET['id'];
    $sql="SELECT sys_logs.*, data.system_no FROM sys_logs RIGHT JOIN data ON sys_logs.sys_id=data.system_id Where sys_id='$id'" ;
    $data=mysqli_query($conn,$sql);
    
    $inv_list_arr=[];
    while($row = mysqli_fetch_assoc($data)) {
        $inv_list_arr[]=$row;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
  </script>
  <title>Mediatrenz</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
            <div class="row">
                <div class="col-md-12">            
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card card-primary card-outline">
                        <div class="card-header border-transparent">
                            <h3 style= "font-size:25px;" class="card-title mt-1">Logs Table</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="table-data" class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>System No</th>
                                            <th>Cpu No.</th>
                                            <th>Ram Slot</th>
                                            <th>Operating System</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Issue</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        if (count($inv_list_arr)>0) {
                                    ?>
                                    <tbody>
                                        <?php foreach($inv_list_arr as $row) {?>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><?= $row['system_no'] ?></td>
                                                <td ><?= $row['cpu'] ?></td>        
                                                <td ><?= $row['ram_slot'] ?></td>
                                                <td ><?= $row['operating_system'] ?></td>
                                                <td><?= $row['created_at'] ?></td>
                                                <td ><?= $row['updated_at'] ?></td>        
                                                <td><?= $row['issue'] ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure?')" href='<?=$baseurl?>/crud/delete_sys_logs.php?id=<?= $row['id']?> && system_id=<?= $id?>'>
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>
</body>
</html>
