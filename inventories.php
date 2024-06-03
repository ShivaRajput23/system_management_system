<?php
    include __dir__."/config/connection.php";
    include __dir__."/config/function.php";
    if (!isset($_SESSION['login'])) {
        header("location:login.php");
        exit;
    }
    
    

if(isset($_POST['Submit'])){
        $systemno=$_POST['systemno'];
        $name=$_POST['name'];
        $productno=$_POST['productno'];
        $size=$_POST['size'];
        $type=$_POST['type'];
        $vendor=$_POST['vendor'];
        $warranty_period=$_POST['warranty_period'];
        if ($systemno != "" && $name != "" && $productno != "" && $type != "" && $vendor != "" && $warranty_period != "") {

            $sql="INSERT INTO inventories(system_id,name,product_no,size,type,vendor,warranty_period)
            VALUES('$systemno','$name','$productno','$size','$type','$vendor','$warranty_period')";
            $data=mysqli_query($conn,$sql);

            
        }
    else{
        echo "<script>alert('Please fill the form correctly')</script>";
    }
}

$sort_option="where inventories.status IN ('0','1','2')";
if(isset($_GET['sorting'])){
    if($_GET["sorting"]=="active"){
        $sort_option="where inventories.status IN ('1')";
    }
    elseif($_GET['sorting']=="dead"){
        $sort_option="where inventories.status IN ('2')";
    }
    elseif($_GET['sorting']=="replacement"){
        $sort_option="where inventories.status IN ('0')";
    }
    
}
                    
$sql="SELECT inventories.*, data.system_no, types.type AS type_name
FROM inventories 
LEFT JOIN data ON inventories.system_id=data.system_id
LEFT JOIN types ON inventories.type=types.id
$sort_option;" ;
$data=mysqli_query($conn,$sql);


$inv_list_arr=[];
while($row = mysqli_fetch_assoc($data)) {
    $inv_list_arr[]=$row;
}
while($row = mysqli_fetch_assoc($data)) {
    $inv_list_arr[]=$inv;
}

                                        


if(isset($_POST['Submit-data'])){
    $id=$_POST['inv_id'];
    $issue=$_POST['issue0'];
    $status=$_POST['status'];
    date_default_timezone_set("Asia/Calcutta");
    $date = date("Y-m-d h:i:s", time());
    $sql= "UPDATE inventories set status='0',updated_at='$date',issue='$issue' WHERE id='$id'";
    $data = mysqli_query($conn,$sql);

    $syssqlstatus="SELECT * FROM inventories where id=$id";
    $sysdatastatus=mysqli_query($conn,$syssqlstatus);
    $sysrowsstatus=mysqli_fetch_assoc($sysdatastatus);

    $system_ststus_id=$sysrowsstatus["system_id"];
    $old_name=$sysrowsstatus["name"];
    $old_size=$sysrowsstatus["size"];
    $old_vendor=$sysrowsstatus["vendor"];
    $old_product_no=$sysrowsstatus["product_no"];
    $old_updated_at=$sysrowsstatus["updated_at"];
    $old_created_at=$sysrowsstatus["created_at"];
    $issue=$sysrowsstatus["issue"];
    $status=$sysrowsstatus["status"];
    
    $sqlinsert="INSERT INTO logs(inv_id,system_id,name,created_at,updated_at,product_no,size,vendor,type,issue_reason,status)
    VALUES('$id','$system_ststus_id','$old_name','$old_created_at','$old_updated_at','$old_product_no','$old_size','$old_vendor','$type','$issue','$status')";
    $data=mysqli_query($conn,$sqlinsert);

    $sqlup="UPDATE inventories set created_at='$old_updated_at'";
    $dataup=mysqli_query($conn,$sqlup);
   


    header("Refresh:0; url=inventories.php");
}

if(isset($_POST['Submit-data-dead'])){
    $id=$_POST['inv_id'];
    $issue=$_POST['issue2'];
    date_default_timezone_set("Asia/Calcutta");
    $date = date("Y-m-d h:i:s", time());
    $sql= "UPDATE inventories set status='2',updated_at='$date',issue='$issue' WHERE id='$id'";
    $data = mysqli_query($conn,$sql);

    $syssqlstatus="SELECT * FROM inventories where id=$id";
    $sysdatastatus=mysqli_query($conn,$syssqlstatus);
    $sysrowsstatus=mysqli_fetch_assoc($sysdatastatus);
  
    $system_ststus_id=$sysrowsstatus["system_id"];
    $old_name=$sysrowsstatus["name"];
    $old_size=$sysrowsstatus["size"];
    $old_vendor=$sysrowsstatus["vendor"];
    $old_product_no=$sysrowsstatus["product_no"];
    $old_updated_at=$sysrowsstatus["updated_at"];
    $old_created_at=$sysrowsstatus["created_at"];
    $issue=$sysrowsstatus["issue"];
    $status=$sysrowsstatus["status"];
    
    $sqlinsert="INSERT INTO logs(inv_id,system_id,name,created_at,updated_at,product_no,size,vendor,type,issue_reason,status)
    VALUES('$id','$system_ststus_id','$old_name','$old_created_at','$old_updated_at','$old_product_no','$old_size','$old_vendor','$type','$issue','$status')";
    $data=mysqli_query($conn,$sqlinsert);

    $sqlup="UPDATE inventories set created_at='$old_updated_at'";
    $dataup=mysqli_query($conn,$sqlup);





    header("Refresh:0; url=inventories.php");
}

if(isset($_POST['Submit-data-active'])){
    $id=$_POST['inv_id'];
    $issue=$_POST['issue1'];
    date_default_timezone_set("Asia/Calcutta");
    $date = date("Y-m-d h:i:s", time());
    $sql= "UPDATE inventories set status='1',updated_at='$date',issue='$issue' WHERE id='$id'";
    $data = mysqli_query($conn,$sql);
    $syssqlstatus="SELECT * FROM inventories where id=$id";
    $sysdatastatus=mysqli_query($conn,$syssqlstatus);
    $sysrowsstatus=mysqli_fetch_assoc($sysdatastatus);
  
    $system_ststus_id=$sysrowsstatus["system_id"];
    $old_name=$sysrowsstatus["name"];
    $old_size=$sysrowsstatus["size"];
    $old_vendor=$sysrowsstatus["vendor"];
    $old_product_no=$sysrowsstatus["product_no"];
    $old_updated_at=$sysrowsstatus["updated_at"];
    $old_created_at=$sysrowsstatus["created_at"];
    $issue=$sysrowsstatus["issue"];
    $status=$sysrowsstatus["status"];
    
    $sqlinsert="INSERT INTO logs(inv_id,system_id,name,created_at,updated_at,product_no,size,vendor,type,issue_reason,status)
    VALUES('$id','$system_ststus_id','$old_name','$old_created_at','$old_updated_at','$old_product_no','$old_size','$old_vendor','$type','$issue','$status')";
    $data=mysqli_query($conn,$sqlinsert);

    $sqlup="UPDATE inventories set created_at='$old_updated_at'";
    $dataup=mysqli_query($conn,$sqlup);



    header("Refresh:0; url=inventories.php");
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
    
    <div class="content-wrapper">
        <div class="content-header">

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="card-title">Add New Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <form class="form-horizontal" method="POST" action=#>
                                <div class="form-group">
                                    <label>System No.</label>
                                    <select class="form-control select2" style="width: 100%;" name="systemno">           
                                        <?php
                                            $syssql="SELECT * FROM data";
                                            $sysdata=mysqli_query($conn,$syssql);
                                            $sysrows=mysqli_num_rows($sysdata);
                                            if (!$sysdata) {
                                            die ("not connected" .mysqli_error());

                                            }
                                            if ($sysrows!=0) {
                                        ?>
                                        <?php while($sysrow = mysqli_fetch_assoc($sysdata)) { ?>
                                        <option value="<?= $sysrow['system_id'] ?>">
                                            <?= $sysrow['system_no'] ?>
                                        </option>
                                        <?php } } ?>      
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Product Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" placeholder="HP mouse" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="product-no" class="col-sm-3 col-form-label">Product no.</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="product-no" placeholder="CEC45336" name="productno" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="size" class="col-sm-3 col-form-label">Size</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="size" placeholder="4 GB" name="size">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control select2" style="width: 100%;" name="type">           
                                        <?php
                                            $typesql="SELECT * FROM types";
                                            $typedata=mysqli_query($conn,$typesql);
                                            $typerows=mysqli_num_rows($typedata);
                                            if (!$typedata) {
                                            die ("not connected" .mysqli_error());
                                            }
                                            if ($typerows!=0) {
                                        ?>
                                        <option selected disabled>Choose here</option>
                                        <?php while($typerow = mysqli_fetch_assoc($typedata)) {?>
                                        <option value="<?= $typerow['id']?>">
                                            <?= $typerow['type'] ?>
                                        </option>
                                        <?php } } ?>      
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="vendor" class="col-sm-3 col-form-label">Vendor</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="vendor" placeholder="Kisan Singh" name="vendor" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="warranty-period" class="col-sm-3 col-form-label">Warranty Period</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="warranty-period" placeholder="1 yr" name="warranty_period" required>
                                    </div>
                                </div>
                            
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark" name="Submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <?php
                
                if (!$data) {
                    die ("not connected1" .mysqli_error());
                }
                
            ?>
            <?php foreach($inv_list_arr as $inv){?>
                <div class="modal fade" id="modal-default-replacement-<?= $inv['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Status-Replacement</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="POST" action=#>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-8 col-form-label">Write the issue?</label>
                                            <div class="col-sm-12">
                                                <input type="text-area" class="form-control" id="issue" placeholder="Mouse is not working" name="issue0" required>
                                            </div>
                                        </div>
                                    </div>
                                   

                                    <!-- /.card-body -->
                                    
                                    <!-- /.card-footer -->
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="inv_id" value="<?= $inv['id']?>">
                                        <input type="hidden" name="status" value="<?= $inv['status']?>">
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
            <?php foreach($inv_list_arr as $inv){?>
                <div class="modal fade" id="modal-default-dead-<?= $inv['id'] ?>">
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
                                            <label for="name" class="col-sm-8 col-form-label">Write the issue?</label>
                                            <div class="col-sm-12">
                                                <input type="text-area" class="form-control" id="issue" placeholder="Mouse is not working" name="issue2" required>
                                            </div>
                                        </div>
                                    </div>
                                   

                                    <!-- /.card-body -->
                                    
                                    <!-- /.card-footer -->
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="inv_id" value="<?= $inv['id']?>">
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
            <?php foreach($inv_list_arr as $inv){?>
                <div class="modal fade" id="modal-default-active-<?= $inv['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Change Status</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="POST" action=#>
                                    <div class="card-body">
                                        <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="name" class="col-sm-8 col-form-label">Write the issue?</label>
                                            
                                                <input type="text-area" class="form-control" id="issue" placeholder="Mother Board" name="issue1" required>
                                            </div>
                                        </div>
                                    </div>
                                   

                                    <!-- /.card-body -->
                                    
                                    <!-- /.card-footer -->
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="inv_id" value="<?= $inv['id']?>">
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
            
                    
            <div class="row">
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-dark m-2" data-toggle="modal" data-target="#modal-default">
                        Add inventories
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">            
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card card-primary card-outline">
                        <div class="card-header border-transparent">
                            <div class="col-md-3"  style="float:right;">
                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <select class="form-control select2" name="sorting" id="">
                                            <option selected value="">All</option>
                                            <option value="active" <?php if(isset($_GET['sorting']) && $_GET['sorting']=="active"){echo "selected";}?>>Active</option>
                                            <option value="dead" <?php if(isset($_GET['sorting']) && $_GET['sorting']=="dead"){echo "selected";}?>>Dead</option>
                                            <option value="replacement" <?php if(isset($_GET['sorting']) && $_GET['sorting']=="replacement"){echo "selected";}?>>Replacement</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-dark" id="basic-addon2">Sort</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <h3 style= "font-size:25px;" class="card-title mt-1">Inventories List</h3>
                            <div class="col-md-7 offset-md-2" >
                                <form action="">
                                    <div class="input-group" >
                                        <input type="search" class="form-control" id="search" placeholder="Type your keywords here" >
                                        <a href="<?=$baseurl?>/inventories.php" class="btn btn-dark ml-1">
                                            <i class="fas fa-times"></i>
                                        </a>       
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        
                       

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="table-data" class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>System NO.</th>
                                            <th>Product Name</th>
                                            <th>Product No.</th>
                                            <th>Product Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <?php
                                        if (count($inv_list_arr)>0) {
                                    ?>
                                    <tbody>
                                        <?php foreach($inv_list_arr as $row) {?>
                                            <tr>
                                                
                                                <td ><?= $row['system_no'] ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['product_no'] ?></td>

                                                <td><?= $row['type_name'] ?></td>

                                                <td><?php
                                                    if($row['status']==0){
                                                        echo "<span class='badge badge-warning'>Replacement</span>";
                                                    }
                                                    if($row['status']==1){
                                                        echo "<span class='badge badge-success'>Active</span>";
                                                    }
                                                    if($row['status']==2){
                                                        echo "<span class='badge badge-danger'>Dead</span>";
                                                    }
                                                ?></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default-details-<?= $row['id'] ?>">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <a class="btn btn-primary btn-sm" href='crud/edit_inventories.php?id=<?= $row['id']?> && system_no=<?= $row['system_no']?>'>
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure?')" href='crud/delete_inventories.php?id=<?= $row['id']?>'>
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </div>  
                                                        <a class="btn btn-secondary btn-sm p-1" href='crud/logs.php?id=<?= $row['id']?>'>
                                                            <i>Logs</i>
                                                        </a>  
                                                        <!-- <select style="padding:5px;" class="btn btn-dark btn-sm " onchange="status_update(this.options[this.selectedIndex].value,'<?php echo $row['id']?>')">  
                                                            <option value="" >Update Status</option>  
                                                            <option value="0" >Replacement</option>  
                                                            <option value="1">Active</option>  
                                                            <option value="2">Dead</option>  
                                                        </select>  -->
                                                        
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-dark dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                Update Status<span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                <button type="button" class="dropdown-item btn-sm" data-toggle="modal" data-target="#modal-default-replacement-<?= $row['id']?>">
                                                                    Replacement
                                                                </button>
                                                                <button type="button" class="dropdown-item btn-sm " data-toggle="modal" data-target="#modal-default-dead-<?= $row['id']?>">
                                                                    Dead
                                                                </button>
                                                                <button type="button" class="dropdown-item btn-sm " data-toggle="modal" data-target="#modal-default-active-<?= $row['id']?>">
                                                                    Active
                                                                </button>
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

            
            <?php foreach($inv_list_arr as $inv){?>
                <div class="modal fade" id="modal-default-details-<?= $inv['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Inventory Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                      
                                        <th>Inventories Name</th>
                                        <th>Inventories Data</th>
                                    </tr>
                                    </thead>
                                    <tbody>        
                                        <tr>
                                            <td>Product Name</td>
                                            <td><?= $inv['name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Product No.</td>
                                            <td><?= $inv['product_no'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Product Size</td>
                                            <td><?php 
                                                echo ($row['size']);
                                                if($row['size']==""){
                                                echo "NULL";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Product Type</td>
                                            <td><?= $inv['type_name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Vendor</td>
                                            <td><?= $inv['vendor'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Warranty Period</td>
                                            <td><?= $inv['warranty_period'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Issued At</td>
                                            <td><?= $inv['created_at'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Updated At</td>
                                            <td><?= $inv['updated_at'] ?></td>
                                        </tr>
                                        <tr>
                                            <?php if($inv['issue']==NULL){
                                                echo NULL;
                                                }
                                                else{
                                            ?>
                                                    <td>Issues</td>
                                                    <td><?= $inv['issue'] ?></td>
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

<script type="text/javascript">  
      function status_update(value,id){  
        //    alert(id);  
           let url = "<?=$baseurl?>/status.php";  
            window.location.href= url+"?id="+id+"&status="+value;  
      }  
</script>

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
            url:"ajax-search.php",
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
