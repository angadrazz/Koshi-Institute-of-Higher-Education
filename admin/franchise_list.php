<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Franchise Requests</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    h2{color:#0b5cff;}
    table{width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;}
    th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left;font-size:14px;}
    th{background:#0b5cff;color:white;}
    a.back{display:inline-block;margin-bottom:15px;padding:10px 15px;background:green;color:white;text-decoration:none;border-radius:10px;font-weight:bold;}
  </style>
</head>
<body>

<h2>Franchise Requests</h2>
<a class="back" href="dashboard.php">Back to Dashboard</a>

<table>
  <tr>
    <th>Name</th>
    <th>Mobile</th>
    <th>Email</th>
    <th>City</th>
    <th>District</th>
    <th>State</th>
    <th>Space</th>
    <th>Investment</th>
    <th>Message</th>
    <th>Date</th>
  </tr>

  <?php
  $res = $conn->query("SELECT * FROM franchise ORDER BY id DESC");
  while($row = $res->fetch_assoc()){
    echo "<tr>
      <td>".$row['name']."</td>
      <td>".$row['mobile']."</td>
      <td>".$row['email']."</td>
      <td>".$row['city']."</td>
      <td>".$row['district']."</td>
      <td>".$row['state']."</td>
      <td>".$row['space']."</td>
      <td>".$row['investment']."</td>
      <td>".$row['message']."</td>
      <td>".$row['created_at']."</td>
    </tr>";
  }
  ?>

</table>

</body>
</html>
