<?php
  include __dir__."/config/connection.php";
  include __dir__."/config/function.php";
  if (!isset($_SESSION['login'])) {
      header("location:login.php");
      exit;
  }
  $id = $_GET['id'];
  $sql="SELECT * FROM data WHERE system_no='$id'";
  $data=mysqli_query($conn,$sql);
  $rows=mysqli_num_rows($data);
  $systemData = mysqli_fetch_assoc($data);
  if (!$data) {
      die ("not connected" .mysqli_error());
      
  }
  if(isset($_POST['Submit'])){
    $system_id=$systemData['system_id'];
    $empid=$_POST['empname'];
    
    if ($empid != "" && $empid != "Employee Exceeded") {
      $sqlemployee="SELECT * FROM employee WHERE id='$empid'";
      $data=mysqli_query($conn,$sqlemployee);
      $employeerows=mysqli_num_rows($data);
      if($employeerows>0){
        $updateemp= "UPDATE employee set system_id='$system_id' WHERE id='$empid'";
        $data=mysqli_query($conn,$updateemp);
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
    <div class="content-wrapper">
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Day Employee To <?= $id?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action=#>
                <div class="card-body">
                  <div class="form-group">
                    <label>System No.</label>
                    <select class="form-control select2" style="width: 100%;" name="systemno">                
                      <option>
                        <?= $id ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Employee Name</label>
                    <select class="form-control select2" style="width: 100%;" name="empname">                 
                      <?php 
                        $sqlempdropdown="SELECT * FROM employee WHERE (system_id='' OR system_id='0' OR system_id IS NULL) AND shift='1'";
                        $dataempdropdown=mysqli_query($conn,$sqlempdropdown);

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
      <div class="modal fade" id="modal-default-night">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Night Employee To <?= $id?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action=#>
                <div class="card-body">
                  <div class="form-group">
                    <label>System No.</label>
                    <select class="form-control select2" style="width: 100%;" name="systemno">                
                      <option>
                          <?= $id ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Employee Name</label>
                    <select class="form-control select2" style="width: 100%;" name="empname">
                    <?php 
                    $sqlempdropdown="SELECT * FROM employee WHERE (system_id='' OR system_id='0' OR system_id IS NULL) AND shift='2'";
                    $dataempdropdown=mysqli_query($conn,$sqlempdropdown);

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

                          <?= $empfetch['employee_name'];?>
                       
                      </option>
                    
                      <?php  }} ?>
                    </select>
                  </div>
                  
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
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6 mt-2">
              <h1>System -- <?= $id?></h1>
            </div>
            <div class="col-sm-6 mt-2">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=$baseurl?>/index.php">Home</a></li>
                <li class="breadcrumb-item active">System Details</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
        <div class="margin float-right">
          <div class="btn-group">
            <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
              Add Employee--<span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
              <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-default">
                Day
              </button>
              <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-default-night">
                Night
              </button>
            </div>
          </div> 
        </div>
      </section>
      <?php 
        include "navbar/navbar.php";
        include "navbar/sidebar.php";
      ?>
      <section class="content">
        <div class="container-fluid mt-5">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><?= $id?>--System Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th >System No.</th>
                        <th>CPU</th>
                        <th>RAM Slots</th>
                        <th>Operating System</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php  if ($rows!=0) { ?>
                      <tr>
                        <td><?= $systemData['system_no'] ?></td>
                        <td><?= $systemData['cpu_no'] ?></td>
                        <td><?= $systemData['ram_slot'] ?></td>
                        <td><?= $systemData['operating_system'] ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>    
      <?php
        $system_id = $systemData['system_id'];
        $sqlemp="SELECT * FROM employee WHERE system_id='$system_id'" ;
        $dataemp=mysqli_query($conn,$sqlemp);
        $rowsemp=mysqli_num_rows($dataemp);   
        if (!$dataemp) {
          die ("not connected" .mysqli_error());
          }       
      ?>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><?= $id?>--Employees</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Shift</th>
                        <th>Action</th> 
                      </tr>  
                    </thead>
                    <tbody>
                      <?php
                      if ($rowsemp!=0) {
                      ?>
                      <?php while($row = mysqli_fetch_assoc($dataemp)) {?>
                        <tr>                            
                          <td><?= $row['employee_name'] ?></td>
                          <td><?= $row['emp_phone_no'] ?></td>
                          <td><?= $row['emp_email'] ?></td>
                          <td><?= $row['username'] ?></td>
                          <td><?= $row['password'] ?></td>
                          <td>
                            <?php
                              if($row['shift']==1){
                                  echo "Day";
                              }
                              if($row['shift']==2){
                                  echo "Night";
                              }
                            ?>
                          </td>
                          <td>
                            <div class="sparkbar" data-color="#00a65a" data-height="20">
                            <a href='crud/moredetails.php?id=<?= $row['id']?> && system_no=<?= $id?> ' onclick="return confirm('Are you sure you want to delete it ?')"><button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></a>
                            </div>
                          </td>
                        </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>
      <?php
        $system_id=$systemData['system_id'];
        $sqlinv="SELECT * FROM inventories WHERE system_id='$system_id'" ;

        $datainv=mysqli_query($conn,$sqlinv);
        $rowsinv=mysqli_num_rows($datainv);
        if (!$datainv) {
          die ("not connected" .mysqli_error());
          }
      ?>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><?= $id?>--Inventories</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th style="width: 10px">name</th>
                        <th style="width: 150px">product no.</th>
                        <th>size</th>
                        <th>type</th>
                        <th>status</th>
                        <th>created_at</th>
                        <th>updated_at</th>     
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($rowsinv!=0) {?>
                      <?php while($rowinv = mysqli_fetch_assoc($datainv)) {?>
                        <tr>
                          <td><?= $rowinv['name'] ?></td>
                          <td><?= $rowinv['product_no'] ?></td>
                          <td><?php 
                          if ($rowinv['size'] == NULL){
                            echo "null";
                            }
                            else{
                              echo $rowinv['size'];
                            }
                          ?></td>
                          <td><?= $rowinv['type'] ?></td>
                          <td><?php 
                          if ($rowinv['status'] == 0){
                            echo "<span class='badge badge-warning'>Replacement</span>";
                            }
                            elseif($rowinv['status'] == 1){
                              echo "<span class='badge badge-success'>Active</span>";
                            }
                            else{
                              echo "<span class='badge badge-danger'>Dead</span>";
                            }
                          ?></td>
                          <td><?= $rowinv['created_at'] ?></td>
                          <td><?= $rowinv['updated_at'] ?></td>
                        </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.js"></script>
  <script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    });
  </script>
</body>
</html>