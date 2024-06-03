<?php
include 'config/connection.php';
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql="SELECT * FROM loginform where username='$username'";
    $data=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($data);
    if (mysqli_num_rows($data)>0) {
        if(password_verify($password,$row['password'])){

            $_SESSION['login']=true;
            $_SESSION['id']=$row['id'];
            header("location:index.php");

        }
        else {
        echo "<script>alert ('wrong password')</script>";
        }
    }
    else {
        echo "<script>alert ('username does not exist')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
  background: #f9f9f9; /* fallback for old browsers */
  font-family: "Raleway", sans-serif;
  color: #151515;
}
a {
  color: black;
  font-weight: 600;
  font-size: 0.85em;
  text-decoration: none;
}
label {
  color: black;
  font-weight: 600;
  font-size: 0.85em;
}
input:focus {
  outline: none;
}
.container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
}
.form {
  display: flex;
  width: auto;
  background: #fff;
  margin: 15px;
  padding: 25px;
  border-radius: 25px;
  box-shadow: 0px 10px 25px 5px #0000000f;
}
.sign-in-section {
  padding: 30px;
}
.sign-in-section h6 {
  margin-top: 0px;
  font-size: 0.75em;
}
.sign-in-section h1 {
  text-align: center;
  font-weight: 700;
  position: relative;
}
.sign-in-section h1:after {
  position: absolute;
  content: "";
  height: 5px;
  bottom: -15px;
  margin: 0 auto;
  left: 0;
  right: 0;
  width: 40px;
  background-color: #091A28;
  background:#091A28;
 
  -o-transition: 0.25s;
  -ms-transition: 0.25s;
  -moz-transition: 0.25s;
  -webkit-transition: 0.25s;
  transition: 0.25s;
}
.sign-in-section h1:hover:after {
  width: 100px;
}
.sign-in-section ul {
  list-style: none;
  padding: 0;
  margin: 0;
  text-align: center;
}
.sign-in-section ul > li {
  display: inline-block;
  padding: 10px;
  font-size: 15px;
  width: 20px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
  border-radius: 50%;
  box-shadow: 0px 3px 1px #0000000f;
  border: 1px solid #e2e2e2;
}
.sign-in-section p {
  text-align: center;
  font-size: 0.85em;
}
.form-field {
  display: block;
  width: 300px;
  margin: 10px auto;
}
.form-field label {
  display: block;
  margin-bottom: 10px;
}
.form-field input[type="text"],
input[type="password"] {
  width: -webkit-fill-available;
  padding: 15px;
  border-radius: 10px;
  border: 1px solid #e8e8e8;
}
.form-field input::placeholder {
  color: #e8e8e8;
}
.form-field input:focus {
  border: 1px solid #AE00FF;
}
.form-field input[type="checkbox"] {
  display: inline-block;
}
.form-options {
  display: block;
  margin: auto;
  width: 300px;
}
.checkbox-field {
  display: inline-block;
  float: left;
}
.form-options a {
  float: right;
  text-decoration: none;
}
.btn {
  padding: 15px;
  font-size: 1em;
  width: 100%;
  border-radius: 25px;
  border: none;
  margin: 20px 0px;
}
.btn-signin {
  cursor: pointer;
  background: #091A28;
  background-color:#091A28;

  color: #fff;
}
.links a:nth-child(1) {
  float: left;
}
.links a:nth-child(2) {
  float: right;
}

    </style>
</head>
<body>
<div class="container">
  <div class="form">
    <div class="sign-in-section">
      <h1>Log in</h1>
      <p>Only For Administrators</p>
      <form action="" method="POST">
        <div class="form-field">
          <label for="text">Username</label>
          <input id="email" name="username" type="text" placeholder="Email" />
        </div>
        <div class="form-field">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="Password" />
        </div>
        <div class="form-options">
          <div class="checkbox-field">
            <input id="rememberMe" type="checkbox" class="checkbox" />
            <label for="rememberMe">Remember Me</label>
          </div>
        </div>
        <div class="form-field">
          <input type="submit" name="login" class="btn btn-signin" value="Submit" />
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>