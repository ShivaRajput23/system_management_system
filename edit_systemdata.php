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
        $sqli="SELECT * FROM data WHERE system_no='$id'" ;

        $dataa=mysqli_query($conn,$sqli);
        $rows=mysqli_fetch_assoc($dataa);


        if(isset($_POST['Submit'])){ 
            $systemno=$_POST['systemno'];
            $cpu=$_POST['cpu'];
            $ramslot=$_POST['ramslot'];
            $operating_system=$_POST['operating_system'];
            date_default_timezone_set("Asia/Calcutta");
            $date = date("Y-m-d h:i:s", time());
            

            if ($systemno != "" && $cpu != "" && $ramslot != "" && $operating_system != "" ) {
            
                $id = $_GET['id'];
                $sql= "UPDATE data set system_no='$systemno',cpu_no='$cpu',ram_slot='$ramslot',operating_system='$operating_system',updated_at='$date' WHERE system_no='$id'";
                $data = mysqli_query($conn,$sql);

                if($data){
                    echo "<script>alert ('Record Updated')</script>";
                    ?>

                    <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/system_data.php"/>

                    <?php
                    
                }
                else{
                    echo "Failed";
                }
            }
            else{
                echo "<script>alert('Please fill the form correctly')</script>";
            }

            if($cpu!=$rows["cpu_no"]){
                $old_updated_at=$rows["updated_at"];
                $old_created_at=$rows["created_at"];
                $issue=$rows["issue"];
                $systemno_old=$rows['system_id'];
                $cpuno_old=$rows['cpu_no'];
                $ramslot_old=$rows['ram_slot'];
                $operating_system_old=$rows['operating_system'];
                
                $sqlinsert="INSERT INTO sys_logs(sys_id,cpu,ram_slot,operating_system,updated_at,created_at,issue)
                VALUES('$systemno_old','$cpuno_old','$ramslot_old','$operating_system_old','$old_updated_at','$old_created_at','$issue')";
                $data=mysqli_query($conn,$sqlinsert);
        
                $sqlup="UPDATE data set created_at='$old_updated_at'";
                $dataup=mysqli_query($conn,$sqlup);
        
            }
        }
    ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid"> 
                <div class="row">                    
                    <div class="col-sm-11 ml-5">
                        <div class="card card-secondary">
                            <div class="card-header">
                                
                                <h3 class="card-title">Add System</h3>
                            </div>
                            <form class="form-horizontal" method="POST" action=#>
                                <div class="card-body">
                                    <div class="form-group row">    
                                        <label for="systemd" class="col-sm-4 col-form-label">System no.</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" id="systemd" class="form-control" value="<?php echo $rows["system_no"];?>" name="systemno" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cpu" class="col-sm-4 col-form-label">CPU</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="cpu"  name="cpu" value="<?php echo $rows["cpu_no"];?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ram" class="col-sm-4 col-form-label">RAM slot</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ram"  name="ramslot" value="<?php echo $rows["ram_slot"];?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="os" class="col-sm-4 col-form-label">Operating System</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="os" name="operating_system" value="<?php echo $rows["operating_system"];?>" required>
                                        </div>
                                    </div>
                                   
                                </div>
                                <!-- /.card-body -->
                                <div class="modal-footer justify-content-between">
                                    <a href="<?=$baseurl?>/system_data.php"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></a>
                                    <button type="submit" class="btn btn-dark" name="Submit">Submit</button>
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


















