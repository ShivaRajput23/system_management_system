<?php
    include __dir__."/config/connection.php";
    include __dir__."/config/function.php";
    if (!isset($_SESSION['login'])) {
        header("location:login.php");
        exit;
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
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <?php
        
        include "navbar/navbar.php";
        include "navbar/sidebar.php";
        if(isset($_POST['Submit'])){
            $type=$_POST['type'];
         
            if ($type!= "") {
                $sql="SELECT * FROM types where type='$type'";
                $data=mysqli_query($conn,$sql);
                $rows=mysqli_fetch_assoc($data);
                

                

                if(isset($rows['type'])>0){
                echo "<script>alert('Type Already Exist ')</script>";
                }
            
                else {
                    $sql="INSERT INTO types(type) VALUES('$type')";
                    $data=mysqli_query($conn,$sql);
                    echo "<script>alert('Type Added')</script>";
                }
            }
            else{
                echo "<script>alert('Please fill the form correctly')</script>";
            }
        }
    ?>
    
            <?php
                $sqli="SELECT * FROM types" ;

                $dataa=mysqli_query($conn,$sqli);
                $rowss=mysqli_num_rows($dataa);
                if (!$dataa) {
                    die ("not connected" .mysqli_error());

                }
                
            ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid"> 
                <div class="row">                    
                    <div class="col-sm-7">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Add Type</h3>
                            </div>
                            <form class="form-horizontal" method="POST" action=#>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Add inventories Types</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="inputEmail3" placeholder="RAM" name="type"  required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-dark" name="Submit">Submit</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>  
                      
                           
                                <div class="card card-primary  card-outline">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table m-0" id="table-data">
                                                <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <?php if ($rowss!=0) {?>
                                                <tbody>
                                                    <?php while($row = mysqli_fetch_assoc($dataa)) {?>
                                                        <tr>
                                                            <td><?= $row['type'] ?></td> 
                                                            <td>
                                                                <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                                    <div class="btn-group">
                                                                        <a class="btn btn-primary btn-sm" href='crud/edit_types.php?id=<?= $row['id']?>'>
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" href='crud/delete_types.php?id=<?= $row['id']?>'>
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>   
                                </div>
                            </div>
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
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>
</body>
</html>


