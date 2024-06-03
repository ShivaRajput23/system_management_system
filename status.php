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
      mysqli_query($conn,"update inventories set status='$status',updated_at='$date' where id='$id'"); 
            $sqli="SELECT * FROM inventories where id=$id" ;
            $dataa=mysqli_query($conn,$sqli);
            $rows=mysqli_fetch_assoc($dataa);
            if (!$dataa) {
                  die ("not connected" .mysqli_error());

            }

            $old_name=$rows["name"];
            $old_name=$rows["name"];
            $old_size=$rows["size"];
            $old_vendor=$rows["vendor"];
            $old_product_no=$rows["product_no"];
            $old_updated_at=$rows["updated_at"];
            $old_created_at=$rows["created_at"];
            $issue=$rows["issue"];
            
            $sqlinsert="INSERT INTO logs(inv_id,name,created_at,updated_at,product_no,size,vendor,type,issue_reason)
            VALUES('$id','$old_name','$old_created_at','$old_updated_at','$old_product_no','$old_size','$old_vendor','$type','$issue')";
            $data=mysqli_query($conn,$sqlinsert);
            echo $sqlinsert;

            $sqlup="UPDATE inventories set created_at='$old_updated_at'";
            $dataup=mysqli_query($conn,$sqlup);


      // header("location:inventories.php");  
      die();  

}  