<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$dbname="systemdata";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die (mysqli_eror());
}
?>
