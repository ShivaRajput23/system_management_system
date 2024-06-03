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
        $systemno='MT-'.$_POST['systemno'];
        $cpuno=$_POST['cpu'];
        $ramslot=$_POST['ramslot'];
        $operating_system=$_POST['operating_system'];

        if ($systemno != "" && $cpuno != "" && $ramslot != "" && $operating_system != "" ) {

            $sql="SELECT * FROM data where system_no='$systemno'";
            $data=mysqli_query($conn,$sql);
            $rows=mysqli_fetch_assoc($data);
            
            if(isset($rows['system_no'])>0){
            echo "<script>alert('System No. Already There ')</script>";
            }
            else{
            $sql="INSERT INTO data(system_no,cpu_no,ram_slot,operating_system)
                VALUES('$systemno','$cpuno','$ramslot','$operating_system')";
                $data=mysqli_query($conn,$sql);
                ?>
                <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/system_data.php"/>
            
                <?php
            }
        }
        else{
            echo "<script>alert('Please fill the form correctly')</script>";
        }      

    }
    $sqlsys="SELECT * FROM data";
    $datasys=mysqli_query($conn,$sqlsys);
    $inv_list_arr=[];
    while($rowdata = mysqli_fetch_assoc($datasys)) {
        $inv_list_arr[]=$rowdata;
    }
    


    if(isset($_POST['Submit-data'])){
        $id=$_POST['inv_id'];
        $issue=$_POST['issue0'];
        date_default_timezone_set("Asia/Calcutta");
        $date = date("Y-m-d h:i:s", time());
        $sql= "UPDATE data set status='0',updated_at='$date',issue='$issue' WHERE system_id='$id'";
        $data = mysqli_query($conn,$sql);
        header("Refresh:0; url=system_data.php");


        
    }
    
    if(isset($_POST['Submit-data-dead'])){
        $id=$_POST['inv_id'];
        $issue=$_POST['issue2'];
        date_default_timezone_set("Asia/Calcutta");
        $date = date("Y-m-d h:i:s", time());
        $sql= "UPDATE data set status='1',updated_at='$date',issue='$issue' WHERE system_id='$id'";
        $data = mysqli_query($conn,$sql);
        header("Refresh:0; url=system_data.php");
    }
    if(isset($_POST['Submit-data-active'])){
        $id=$_POST['inv_id'];
        $issue=$_POST['issue1'];
        date_default_timezone_set("Asia/Calcutta");
        $date = date("Y-m-d h:i:s", time());
        $sql= "UPDATE data set status='2',updated_at='$date',issue='$issue' WHERE system_id='$id'";
        $data = mysqli_query($conn,$sql);
        header("Refresh:0; url=system_data.php");
    }
    
    

    ?>

    <div class="content-wrapper">
        <div class="content-header">
            <?php foreach($inv_list_arr as $rowdata){?>
                <div class="modal fade" id="modal-default-replacement-<?= $rowdata['system_id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Status-Replacement-<?= $rowdata['system_id'] ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="POST" action=#>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-5 col-form-label">Write the issue?</label>
                                            <div class="col-sm-12">
                                                <input type="text-area" class="form-control" id="issue" placeholder="Mouse is not working" name="issue0" required>
                                            </div>
                                        </div>
                                    </div>
                                   

                                    <!-- /.card-body -->
                                    
                                    <!-- /.card-footer -->
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="inv_id" value="<?= $rowdata['system_id']?>">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-dark" name="Submit-data">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
            <?php }?>

            <?php foreach($inv_list_arr as $rowdata){?>
                <div class="modal fade" id="modal-default-dead-<?= $rowdata['system_id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Status-Dead</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="POST" action=#>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-5 col-form-label">Write the issue?</label>
                                            <div class="col-sm-12">
                                                <input type="text-area" class="form-control" id="issue" placeholder="Mouse is not working" name="issue2" required>
                                            </div>
                                        </div>
                                    </div>
                                   

                                    <!-- /.card-body -->
                                    
                                    <!-- /.card-footer -->
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="inv_id" value="<?= $rowdata['system_id']?>">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-dark" name="Submit-data-dead">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
            <?php }?>

            <?php foreach($inv_list_arr as $rowdata){?>
                <div class="modal fade" id="modal-default-active-<?= $rowdata['system_id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Status-Active-<?= $rowdata['system_id'] ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="POST" action=#>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-5 col-form-label">Write the issue?</label>
                                            <div class="col-sm-12">
                                                <input type="text-area" class="form-control" id="issue" placeholder="Mouse is not working" name="issue1" required>
                                            </div>
                                        </div>
                                    </div>
                                   

                                    <!-- /.card-body -->
                                    
                                    <!-- /.card-footer -->
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="inv_id" value="<?= $rowdata['system_id']?>">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-dark" name="Submit-data-active">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
            <?php }?>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="card-title">Add New System</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" method="POST" action=#>
                            <div class="card-body">
                                <div class="form-group row">    
                                    <label for="systemd" class="col-sm-4 col-form-label">System no.</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">MT-</span>
                                            </div>
                                            <input type="number" id="systemd" class="form-control" placeholder="1001" name="systemno">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cpu" class="col-sm-4 col-form-label">CPU</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="cpu" placeholder="Intel i3 Gen 4" name="cpu" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ram" class="col-sm-4 col-form-label">RAM slots</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ram" placeholder="4 Slots" name="ramslot" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="os" class="col-sm-4 col-form-label">Operating System</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="os" placeholder="Windows 7" name="operating_system" required>
                                    </div>
                                </div>
                            </div>
                                <!-- /.card-body -->
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark" name="Submit">Submit</button>
                            </div>
                                <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <?php
                $sql="SELECT * FROM data ORDER BY system_no ASC" ;

                $data=mysqli_query($conn,$sql);
                $rows=mysqli_num_rows($data);
                if (!$data) {
                    die ("not connected" .mysqli_error());

                }
                
            ?>
           
            <div class="row">
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-dark m-2" data-toggle="modal" data-target="#modal-default">
                        Add System
                    </button>
                </div>
                <div class="col-md-12">            
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card card-primary card-outline">
                        <div class="card-header border-transparent">
                            <h3 style= "font-size:25px;" class="card-title">System Details</h3>
                            <div class="col-md-8 offset-md-2"  style="float:right;">
                                <form action="">
                                    <div class="input-group" >
                                        <input type="search" class="form-control" id="search" placeholder="Type your keywords here" >
                                        <a href="<?=$baseurl?>/system_data.php" class="btn btn-dark ml-1">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" id="table-data">
                                    <thead>
                                        <tr>
                                            <th>System NO.</th>
                                            <th>Cpu</th>
                                            <th>Operating System</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($rows!=0) { ?>
                                        <?php while($row = mysqli_fetch_assoc($data)) {?>
                                            <tr>
                                                
                                                <td><?= $row['system_no'] ?></td>
                                                <td><?= $row['cpu_no'] ?></td>
                                                <td><?= $row['operating_system'] ?></td>
                                                <td><?php
                                                    if($row['status']==0){
                                                        echo "<span class='badge badge-warning'>Replacement</span>";
                                                    }
                                                    if($row['status']==2){
                                                        echo "<span class='badge badge-success'>Active</span>";
                                                    }
                                                    if($row['status']==1){
                                                        echo "<span class='badge badge-danger'>Dead</span>";
                                                    }
                                                ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default-details-<?= $row['system_id'] ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <a class="btn btn-primary btn-sm" href='crud/edit_systemdata.php?id=<?= $row['system_no']?>&&sys_id=<?= $row['system_id']?>'>
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure?')" href='crud/delete_systemdata.php?id=<?= $row['system_id']?>'>
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                    <a class="btn btn-secondary btn-sm p-1" href='crud/system_logs.php?id=<?= $row['system_id']?>&&sys_id=<?= $row['system_no']?>'>
                                                        <i>Logs</i>
                                                    </a> 
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                            Update Status<span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <button type="button" class="dropdown-item btn-sm" data-toggle="modal" data-target="#modal-default-replacement-<?= $row['system_id']?>">
                                                                Replacement
                                                            </button>
                                                            <button type="button" class="dropdown-item btn-sm " data-toggle="modal" data-target="#modal-default-dead-<?= $row['system_id']?>">
                                                                Dead
                                                            </button>
                                                            <button type="button" class="dropdown-item btn-sm " data-toggle="modal" data-target="#modal-default-active-<?= $row['system_id']?>">
                                                                Active
                                                            </button>
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
                    <!-- /.card -->
                </div>
            </div>

            <?php foreach($inv_list_arr as $rowdata){?>
                <div class="modal fade" id="modal-default-details-<?= $rowdata['system_id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">System Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                      
                                        <th>Index</th>
                                        <th>System Data</th>
                                    </tr>
                                    </thead>
                                    <tbody>        
                                        <tr>
                                            <td>Cpu No.</td>
                                            <td><?= $rowdata['cpu_no'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ram Slot</td>
                                            <td><?= $rowdata['ram_slot'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Operating System</td>
                                            <td><?= $rowdata['operating_system'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Issued At</td>
                                            <td><?= $rowdata['created_at'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Updated At</td>
                                            <td><?= $rowdata['updated_at'] ?></td>
                                        </tr>
                                        <tr>
                                            <?php if($rowdata['issue']==NULL){
                                                echo NULL;
                                                }
                                                else{
                                            ?>
                                                    <td>Issues</td>
                                                    <td><?= $rowdata['issue'] ?></td>
                                            <?php }?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>
<script>
 $(document).ready(function(){
    $("#search").on("keyup",function(){
        var search_term=$(this).val();
        $.ajax({
            url:"ajax-search-system.php",
            type:"POST",
            data:{search:search_term},
            success:function(data){
                $("#table-data").html(data);
            }
        });
    });
    
 });
</script>
</body>
</html>


















