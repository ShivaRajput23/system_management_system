<?php
    include "../config/connection.php";
    include "../config/function.php";

    if (!isset($_SESSION['login'])) {
        header("location:login.php");
        exit;
    }
    $system_no = $_GET['system_no'];
    $id = $_GET['id'];
    $sql= "UPDATE employee set system_id='' WHERE id='$id'";
    $data = mysqli_query($conn,$sql);
    if($data){
    ?>
        <meta http-equiv="refresh" content="0;URL='<?=$baseurl?>/notes.php?id=<?= $system_no?>"/>
    <?php 
    }
    else{
      echo "<script>alert('not connected ')</script>";
    }

?>