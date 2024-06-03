<?php
include "../config/connection.php";
include "../config/function.php";
$id=$_GET['id'];
$sqli="DELETE FROM employee where id='$id'";
$data=mysqli_query($conn,$sqli);
if($data){
    
    ?>
    <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/employees.php" />
    
    <?php
}
else{
    echo "<script>alert('data not deleted');</script>";
    
}
?>