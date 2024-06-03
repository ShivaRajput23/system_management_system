<?php
    include __dir__."/config/connection.php";
    include __dir__."/config/function.php";
    if (!isset($_SESSION['login'])) {
        header("location:login.php");
        exit;
      }
    if(isset($_POST['Submit'])){
        $name=$_POST['name'];
        $empphone=$_POST['empphone'];
        $empemail=$_POST['empemail'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $shift=$_POST['shift'];
        if ($name != "" && $empphone != "" && $empemail != ""&& $username != ""&& $password != "" && $shift != "") {

            $sql="INSERT INTO employee(employee_name,emp_phone_no,emp_email,username,password,shift)
                VALUES('$name','$empphone','$empemail','$username','$password','$shift')";
                $data=mysqli_query($conn,$sql);
        }
        else{
            echo "<script>alert('Please fill the form correctly')</script>";
        }
    }
    if(isset($_POST['active'])){
        $id=$_POST['active_status'];
        date_default_timezone_set("Asia/Calcutta");
        $date = date("Y-m-d h:i:s", time());
        $sql= "UPDATE employee set status='0',updated_at='$date' WHERE id='$id'"; 
        $data = mysqli_query($conn,$sql);
        header("Refresh:0; url=employees.php");
    }
    if(isset($_POST['dead'])){
        $id=$_POST['active_status'];
        date_default_timezone_set("Asia/Calcutta");
        $date = date("Y-m-d h:i:s", time());
        $sql= "UPDATE employee set status='1',updated_at='$date',system_id=NULL WHERE id='$id'"; 
        $data = mysqli_query($conn,$sql);
        header("Refresh:0; url=employees.php");
    }

$sqlie="SELECT * FROM employee" ;
$dataie=mysqli_query($conn,$sqlie);

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
    ?>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action=#>
                        <div class="card-body">
                            
                            <div class="form-group row">
                                <label for="name" class="col-sm-12 col-form-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" placeholder="Navil" name="name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-sm-12 col-form-label">Phone</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="phone" placeholder="9898989555" name="empphone" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-12 col-form-label">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" id="email" placeholder="Email" name="empemail" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-12 col-form-label">Username</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="username" placeholder="System Username " name="username" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pass" class="col-sm-12 col-form-label">Password</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="pass" placeholder="navil@1234" name="password" required>
                                </div>
                            </div>
                            
                            <label>Shift</label>
                            <select class="form-control select2" style="width: 100%;" name="shift">
                                <option value="1">Day</option>
                                <option value="2">Night</option>
                            </select>
                        </div>
                        <!-- /.card-body -->
                        
                        <!-- /.card-footer -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark" name="Submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    
    
    <div class="content-wrapper">
        <div class="content-header">                     
            <?php
                $sql="SELECT employee.*,data.system_id,data.system_no FROM employee LEFT JOIN data ON employee.system_id=data.system_id
                 ORDER BY employee.system_id ASC" ;

                $data=mysqli_query($conn,$sql);
                $rows=mysqli_num_rows($data);
                if (!$data) {
                    die ("not connected" .mysqli_error());

                }
                
            ?>
            <div class="row">
                <div class="col-md-12 text-right"> 
                    <button type="button" class="btn btn-dark m-2" data-toggle="modal" data-target="#modal-default">
                        Add Employee
                    </button>
                </div>
                <div class="col-md-12">         
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card card-primary card-outline">
                        <div class="card-header border-transparent">
                            <h1 style= "font-size:25px;" class="card-title mt-1">Employee List</h1>
                            <div class="col-md-8 offset-md-2"  style="float:right;">
                                <form action="">
                                    <div class="input-group" >
                                        <input type="search" class="form-control" id="search" placeholder="Type your keywords here" >
                                        <a href="<?=$baseurl?>/employees.php" class="btn btn-dark  ml-1">
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
                                            <th>ID</th>
                                            <th>System NO.</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Shift</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    
                                    if ($rows!=0) {?>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_assoc($data)) {?>
                                            <tr>

                                                <td><?= $row['id'] ?></td>
                                                <td><?= $row['system_no']?></td>
                                                <td><?= $row['employee_name'] ?></td>
                                                <td><?= $row['emp_phone_no'] ?></td>
                                                <td><?php
                                                    if($row['shift']==1){
                                                        echo "Day";
                                                    }
                                                    if($row['shift']==2){
                                                        echo "Night";
                                                    }
                                                ?></td>
                                                <td><?php
                                                    if($row['status']==0){
                                                        echo "<span class='badge badge-success'>Active</span>";
                                                    }
                                                    if($row['status']==1){
                                                        echo "<span class='badge badge-danger'>Inactive</span>";
                                                    }
                                                
                                                ?></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default-details-<?= $row['id'] ?>">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <a class="btn btn-primary btn-sm" href='crud/edit_employee.php?id=<?= $row['id']?>'>
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" href='crud/delete_employee.php?id=<?= $row['id']?>'>
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                Update Status<span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                
                                                            
                                                                <form action="" method="post">
                                                                    <button type="submit" name="active" class="dropdown-item btn-sm">
                                                                        Active
                                                                        <input type="hidden" name="active_status" value="<?= $row['id']?>">
                                                                    </button>
                                                                    <button type="submit" name="dead" class="dropdown-item btn-sm">
                                                                        Inactive
                                                                        <input type="hidden" name="active_status" value="<?= $row['id']?>">
                                                                    </button>
                                                                    
                                                                
                                                                </form>
                                                            </div>
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

            <?php while($rowe = mysqli_fetch_assoc($dataie)) {?>
                <div class="modal fade" id="modal-default-details-<?= $rowe['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Employee Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                        
                                            <th>Index</th>
                                            <th>Employee Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>        
                                        <tr>
                                            <td>Employee Name</td>
                                            <td><?= $rowe['employee_name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone No.</td>
                                            <td><?= $rowe['emp_phone_no'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Employee Email</td>
                                            <td><?= $rowe['emp_email'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Computer Username</td>
                                            <td><?= $rowe['username'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Computer Password</td>
                                            <td><?= $rowe['password'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Created At</td>
                                            <td><?= $rowe['created_at'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Updated At</td>
                                            <td><?= $rowe['updated_at'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Shift</td>
                                            <td><?php
                                               if($rowe['shift']==1){
                                                echo "day";
                                               } 
                                               else{
                                                echo "night";
                                               }
                                            ?></td>
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
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
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
            url:"ajax-search-emp.php",
            type:"POST",
            data:{search:search_term},
            success:function(data){
                $("#table-data").html(data);
            }
        });
    });
    
 });
</script>
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    });
</script>
</body>
</html>


















