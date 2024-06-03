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
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
      <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/index.php"/>
  
      <?php
    }
  }
  else{
      echo "<script>alert('Please fill the form correctly')</script>";
  }      
}




$sql="SELECT * FROM employee RIGHT JOIN data ON data.system_id = employee.system_id ORDER BY data.system_no ASC" ;

$data=mysqli_query($conn,$sql);
$rows=mysqli_num_rows($data);
if (!$data) {
    die ("not connected" .mysqli_error());
    
}




?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
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
                  <label for="ram" class="col-sm-4 col-form-label">RAM slot</label>
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">System Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-laptop"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Systems</span>
                <span class="info-box-number">
                  <?php
                    $resulti=mysqli_query($conn,"SELECT count(*) as total from data");
                    $dataa=mysqli_fetch_assoc($resulti);
                    echo $dataa['total'];
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-keyboard"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Inventories</span>
                <span class="info-box-number">
                  <?php
                    $resulti=mysqli_query($conn,"SELECT count(*) as total from inventories");
                    $dataa=mysqli_fetch_assoc($resulti);
                    echo $dataa['total'];
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Day Employees</span>
                <span class="info-box-number">
                <?php
                    $resulti=mysqli_query($conn,"SELECT count(*) as total from employee where shift=1");
                    $dataa=mysqli_fetch_assoc($resulti);
                    echo $dataa['total'];
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Night Employees</span>
                <span class="info-box-number">
                <?php
                  $resulti=mysqli_query($conn,"SELECT count(*) as total from employee where shift=2");
                  $dataa=mysqli_fetch_assoc($resulti);
                  echo $dataa['total'];
                ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-12 text-right">
            <button type="button" class="btn btn-dark m-2" data-toggle="modal" data-target="#modal-default">
                Add System
            </button>
          </div>
          <!-- Left col -->
          <div class="col-md-12">            
            <!-- TABLE: LATEST ORDERS -->
            <div class="card card-primary card-outline">
              <div class="card-header border-transparent">
                <h1 style= "font-size:25px; " class="card-title mt-1">System Details</h1>
                <div class="col-md-8 offset-md-2"  style="float:right;">
                  <form action="">
                      <div class="input-group" >
                        <input type="search" class="form-control" id="search" placeholder="Type your keywords here" >
                        <a href="<?=$baseurl?>/index.php" class="btn btn-dark  ml-1">
                          <i class="fas fa-times"></i>
                        </a>
                      </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0" id="table-data">
                    <thead>
                    <tr>
                      <th>System No.</th>
                      <th>Assigned To</th>
                      <th>Operating System</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <?php
                      if ($rows!=0) {
                    ?>
                    <tbody>
                    <?php while($row = mysqli_fetch_assoc($data)) {?>
                    
                    <tr>
                      <td><?= $row['system_no'] ?></td>
                      <td><?php 
                        if($row['employee_name']==""){
                            echo "not assigned";

                        } 
                        else{
                            echo  $row['employee_name'];
                        }
                        ?>
                      </td>
                      <td><?= $row['operating_system'] ?></td>
                      <td>
                        <div class="btn-group">
                          <a class="btn btn-warning btn-sm" href='notes.php?id=<?= $row['system_no']?>'>
                            <i class="fas fa-eye"></i>
                          </a>
                          <a class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure?')" href='crud/delete.php?id=<?= $row['system_id']?>'>
                            <i class="fas fa-trash-alt"></i>
                          </a>
                        </div>
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <i class="fas fa-plus"></i><span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu">
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-default-day<?= $row['system_no'] ?>">
                              Day
                            </button>
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-default-night<?= $row['system_no'] ?>">
                              Night
                            </button>
                          </div>
                        </div> 
                      </td>
                    </tr>
                    <div class="modal fade" id="modal-default-day<?= $row['system_no'] ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Add Day Employee To <?= $row['system_no'] ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="POST" action="">
                            <div class="modal-body">
                              <div class="form-group">
                                <label>System No.</label>
                                <select class="form-control select2" name="systemno">                
                                  <option value=<?=$row['system_id']?>>
                                    <?= $row['system_no']?>
                                  </option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Employee Name</label>
                                <select class="form-control select2" style="width: 100%;" name="empname">                 
                                  <?php 
                                    $sqlempdropdown="SELECT * FROM employee WHERE (system_id='' OR system_id='0' OR system_id IS NULL) AND shift='1'";
                                    $dataempdropdown=mysqli_query($conn,$sqlempdropdown);
                                    $sys=$row['system_no'];

                                    $sqlsys="SELECT * FROM data WHERE system_no='$sys'";
                                    $datasys=mysqli_query($conn,$sqlsys);
                                    $rowss=mysqli_num_rows($datasys);
                                    $systemData = mysqli_fetch_assoc($datasys);


                                    $system_id = $systemData['system_id'];
                                    $sqlemp="SELECT * FROM employee WHERE system_id='$system_id' AND shift='1'" ;

                                    $dataemp=mysqli_query($conn,$sqlemp);
                                    $rowsemp=mysqli_num_rows($dataemp);
                                    var_dump($rowsemp);
                                    if($rowsemp>0){
                                  ?>
                                    <option>
                                      Employee Exceeded
                                    </option>
                                  <?php
                                    }
                                    else{
                                    while($empfetch=mysqli_fetch_assoc($dataempdropdown)){
                                  ?>       
                                    <option value="<?= $empfetch['id'] ?>">
                                      <?php 
                                      if($empfetch['status'] == 0){
                                        echo ($empfetch['employee_name']);
                                      }
                                      
                                        ?>                       
                                    </option>
        
                                  <?php  }} ?>
                                </select>
                                
                              </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-dark" name="Submit-data">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="modal-default-night<?= $row['system_no'] ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Add Day Employee To <?= $row['system_no'] ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="POST" action="">
                            <div class="modal-body">
                              <div class="form-group">
                                <label>System No.</label>
                                <select class="form-control select2" name="systemno">                
                                  <option value=<?=$row['system_id']?>>
                                    <?= $row['system_no']?>
                                  </option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Employee Name</label>
                                <select class="form-control select2" style="width: 100%;" name="empname">                 
                                  <?php 
                                    $sqlempdropdown="SELECT * FROM employee WHERE (system_id='' OR system_id='0' OR system_id IS NULL) AND shift='2'";
                                    $dataempdropdown=mysqli_query($conn,$sqlempdropdown);
                                    $sys=$row['system_no'];

                                    $sqlsys="SELECT * FROM data WHERE system_no='$sys'";
                                    $datasys=mysqli_query($conn,$sqlsys);
                                    $rowss=mysqli_num_rows($datasys);
                                    $systemData = mysqli_fetch_assoc($datasys);


                                    $system_id = $systemData['system_id'];
                                    $sqlemp="SELECT * FROM employee WHERE system_id='$system_id' AND shift='2'" ;

                                    $dataemp=mysqli_query($conn,$sqlemp);
                                    $rowsemp=mysqli_num_rows($dataemp);
                                    var_dump($rowsemp);
                                    if($rowsemp>0){
                                  ?>
                                    <option>
                                      Employee Exceeded
                                    </option>
                                  <?php
                                    }
                                    else{
                                    while($empfetch=mysqli_fetch_assoc($dataempdropdown)){
                                  ?>       
                                    <option value="<?= $empfetch['id'] ?>">
                                      <?= $empfetch['employee_name'];
                                        ?>                       
                                    </option>
                                  <?php  }} ?>
                                </select>
                                
                              </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-dark" name="Submit-data">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    
                    
                  
                    <?php } } ?>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
  
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- ./wrapper -->
<?php
                                  
  if(isset($_POST['Submit-data'])){
    $systemid=$_POST['systemno'];
    $empid=$_POST['empname'];
   
  
  
    if ($empid != "" && $empid != "Employee Exceeded") {
      $sqlemployee="SELECT * FROM employee WHERE id='$empid'";
      $datamodal=mysqli_query($conn,$sqlemployee);
      $employeerows=mysqli_num_rows($datamodal);
      if($employeerows>0){
        $updateemp= "UPDATE employee set system_id='$systemid' WHERE id='$empid'";
        $datamodal=mysqli_query($conn,$updateemp);
        ?>
        <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/index.php" />
        
        <?php
        
        
      }
      else{
        echo "<script>alert('Employee Not Found')</script>";
      }
  }
  else{
    echo "<script>alert('Please fill the form correctly')</script>";
  }
  }
  ?>

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
            url:"ajax-search-index.php",
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