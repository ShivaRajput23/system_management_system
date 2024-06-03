<?php
    include "../config/connection.php";
    include "../config/function.php";

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
        $id = $_GET['id'];
        $sqli="SELECT * FROM types WHERE id='$id'" ;

        $dataa=mysqli_query($conn,$sqli);
        $rows=mysqli_fetch_assoc($dataa);

        if(isset($_POST['Submit'])){
            $type=$_POST['type'];

            if ($type != "") {
            
                $id = $_GET['id'];
                $sql= "UPDATE types set type='$type' WHERE id='$id'";
                $data = mysqli_query($conn,$sql);
                ?>
                    <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/type.php"/>
                <?php      
            }
            else{
                echo "<script>alert('Please fill the form correctly')</script>";
            }
        }
    ?>
    <?php
    $sqlemp="SELECT * FROM types WHERE id='$id'" ;

    $dataemp=mysqli_query($conn,$sqlemp);
    $rowsemp=mysqli_fetch_assoc($dataemp);
    ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid"> 
                <div class="row">                    
                    <div class="col-sm-11 ml-5">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Edit types</h3>
                            </div>
                            <form class="form-horizontal" method="POST" action=#>
                                <div class="card-body">
                                    
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-12 col-form-label">Type</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="type" value="<?= $rowsemp['type']?>" name="type" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                
                                <!-- /.card-footer -->
                                <div class="modal-footer justify-content-between">
                                    <a href="<?=$baseurl?>/type.php"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></a>
                                    <button type="submit" class="btn btn-dark" name="Submit">Submit</button>
                                </div>
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
<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>

<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    });
</script>
</body>
</html>
