<?php
include "../config/connection.php";
include "../config/function.php";
$id=$_GET['id'];
$sql="DELETE FROM types where id='$id'";
$data=mysqli_query($conn,$sql);
if($data){

    ?>
    <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/type.php'" />
    
    <?php
}
else{
    echo "<script>alert('data not deleted');</script>";
    
}
?>