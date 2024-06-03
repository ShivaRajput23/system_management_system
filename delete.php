<?php
include "../config/connection.php";
include "../config/function.php";
$id=$_GET['id'];
$sql="DELETE FROM data where system_id='$id'";
$sqli="DELETE FROM employee where system_id='$id'";
$data=mysqli_query($conn,$sql);
$data=mysqli_query($conn,$sqli);
if($data){

    ?>
    <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/index.php'" />
    
    <?php
}
else{
    echo "<script>alert('data not deleted');</script>";
    
}
?>