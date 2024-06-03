<?php
include "../config/connection.php";
include "../config/function.php";
$id=$_GET['id'];
$system_id=$_GET['system_id'];
$sqli="DELETE FROM sys_logs where id='$id'";
$data=mysqli_query($conn,$sqli);
if($data){

    ?>
    <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/crud/system_logs.php?id=<?= $system_id?>"/>
    
    <?php
}
else{
    echo "<script>alert('data not deleted');</script>";
    
}
?>