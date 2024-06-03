<?php
include "../config/connection.php";
include "../config/function.php";
$id=$_GET['id'];
    $sql="DELETE FROM data where system_id='$id'";
    $data=mysqli_query($conn,$sql);
    $sqlemp="UPDATE employee set system_id=null where system_id='$id'";
    $dataemp=mysqli_query($conn,$sqlemp);
    if($data){

        ?>
        <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/system_data.php'" />
        
        <?php
    }
    else{
        echo "<script>alert('data not deleted');</script>";
        
    }

?>