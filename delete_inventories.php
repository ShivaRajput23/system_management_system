<?php
include "../config/connection.php";
include "../config/function.php";
if (!isset($_SESSION['login'])) {
    header("location:login.php");
    exit;
  }
$id=$_GET['id'];
$sqli="DELETE FROM inventories where id='$id'";
$data=mysqli_query($conn,$sqli);
if($data){

    ?>
    <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/inventories.php'" />
    
    <?php
}
else{
    echo "<script>alert('data not deleted');</script>";
    
}
?>