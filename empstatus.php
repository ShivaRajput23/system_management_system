<?php
include "config/connection.php";
if (!isset($_SESSION['login'])) {
      header("location:login.php");
      exit;
}

if (isset($_GET['id']) && isset($_GET['status'])) {  
      $id=$_GET['id'];  
      $status=$_GET['status'];  
      date_default_timezone_set("Asia/Calcutta");
      $date = date("Y-m-d h:i:s", time());
      mysqli_query($conn,"update employee set status='$status',updated_at='$date' where id='$id'");  
      header("location:employees.php");  
      die();  
}  