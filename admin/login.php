<?php
session_start();
include("../db.php");

if(isset($_POST['login'])){
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $res = $conn->query("SELECT * FROM admin WHERE username='$user' AND password='$pass'");
  if($res->num_rows > 0){
    $_SESSION['admin'] = $user;
    header("Location: dashboard.php");
  } else {
    echo "<p style='color:red;text-align:center;'>Invalid Login!</p>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:40px;}
    .box{max-width:420px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:12px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;cursor:pointer;}
  </style>
</head>
<body>

<div class="box">
  <h2>Admin Login</h2>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
  </form>
</div>

</body>
</html>
