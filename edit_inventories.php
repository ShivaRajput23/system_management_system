<?php
    include "../config/connection.php";
    include "../config/function.php";
        $id = $_GET['id'];
        $sqli="SELECT * FROM inventories WHERE id='$id'" ;
        $dataa=mysqli_query($conn,$sqli);
        $rows=mysqli_fetch_assoc($dataa);

        $sysid = $_GET['system_no'];
        $sqlsys="SELECT * FROM data WHERE system_no='$sysid'";
        $datasys=mysqli_query($conn,$sqlsys);
        $rowssys=mysqli_num_rows($datasys);
        $systemData = mysqli_fetch_assoc($datasys);
        if (!$datasys) {
            die ("not connected" .mysqli_error());
            
        }

    if(isset($_POST['Submite'])){
        $systemno=$_POST['systemnoe'];
        $name=$_POST['namee'];
        $productno=$_POST['productnoe'];
        $size=$_POST['sizee'];
        $type=$_POST['typee'];
        $vendor=$_POST['vendore'];
        date_default_timezone_set("Asia/Calcutta");
        $date = date("Y-m-d h:i:s", time());

        if ( $name != "" && $productno != "" && $type != "" ) {

            $id = $_GET['id'];
            $sql= "UPDATE inventories set system_id='$systemno',name='$name',product_no='$productno',size='$size',type='$type',vendor='$vendor',updated_at='$date' WHERE id='$id'";
            $data = mysqli_query($conn,$sql);

            if($data){
                echo "<script>alert ('Record Updated')</script>";
                ?>

                <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/inventories.php"/>

                <?php
                
            }
            else{
                echo "Failed";
            }
        }
        else{
            echo "<script>alert('Please fill the form correctly')</script>";
        }
        if($productno!=$rows["product_no"]){
            $old_product_no=$rows["product_no"];
            $sqlinsert="INSERT INTO logs(inv_id,system_id,name,product_no,size,vendor,type)
            VALUES('$id','$systemno','$name','$old_product_no','$size','$vendor','$type')";
            $data=mysqli_query($conn,$sqlinsert);

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
  <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
                    <div class="col-sm-11 ml-5">
                        <div class="card card-secondary">
                            <div class="card-header">
                                
                                <h3 class="card-title">Edit Product</h3>
                            </div>
                                <form class="form-horizontal" method="POST" action=#>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>System No.</label>
                                            <select class="form-control select2" style="width: 100%;" name="systemnoe">           
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
                                                    <option value="<?=$sysrow['system_id'] ?>" <?= ($sysrow['system_id']==$rows['system_id']) ? 'selected':""?>>
                                                    <?= $sysrow['system_no'] ?>
                                                    </option>
                                                <?php } } ?>      
                                            </select>
                                        </div>                         
                                        <!-- <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">System No.</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="System NO." name="systemnoe" value="<?php echo $rows["system_no"];?>" required>
                                            </div>
                                        </div> -->
                                        <div class="form-group row">
                                            <label for="productname" class="col-sm-3 col-form-label">Product Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="productname" placeholder="Product Name" name="namee" value="<?php echo $rows["name"];?>"  required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="product-no" class="col-sm-3 col-form-label">Product no.</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="product-no" placeholder="Product No" name="productnoe" value="<?php echo $rows["product_no"];?>"  required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="size" class="col-sm-3 col-form-label">Size</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="size" placeholder="Size" value="<?php echo $rows["size"];?>"  name="sizee">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control select2" style="width: 100%;" name="typee" >           
                                                <?php
                                                    $typesql="SELECT * FROM types";
                                                    $typedata=mysqli_query($conn,$typesql);
                                                    $typerows=mysqli_num_rows($typedata);
                                                    if (!$typedata) {
                                                    die ("not connected" .mysqli_error());

                                                    }
                                                    if ($typerows!=0) {
                                                ?>
                                                <?php while($typerow = mysqli_fetch_assoc($typedata)) { ?>
                                                    
                                                    <option value="<?= $typerow['id']?>" <?= ($typerow['id']==$rows['type']) ? 'selected':""?>>
                                                        <?= $typerow['type'] ?>
                                                    </option>
                            
                                                <?php } } ?>      
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label for="vendor" class="col-sm-3 col-form-label">Vendor</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="vendor" placeholder="Product Type" name="vendore" value="<?php echo $rows["vendor"];?>"  required>
                                            </div>
                                        </div>      
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="modal-footer justify-content-between">
                                        <a href="<?=$baseurl?>/inventories.php"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></a>
                                        <button type="submit" class="btn btn-dark" name="Submite">Submit</button>
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
<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
