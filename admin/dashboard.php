<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    h2{color:#0b5cff;}
    table{width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;}
    th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left;}
    th{background:#0b5cff;color:white;}
    a.btn{padding:6px 12px;background:green;color:white;text-decoration:none;border-radius:8px;}
    a.reject{background:red;}
    a.logout{float:right;color:red;font-weight:bold;text-decoration:none;}
  </style>
</head>
<body>

<h2>Admin Dashboard <a class="logout" href="logout.php">Logout</a></h2>

<table>
  <tr>
    <th>Reg ID</th>
    <th>Name</th>
    <th>Course</th>
    <th>Mobile</th>
    <th>Payment</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

  <?php
  $res = $conn->query("SELECT * FROM students ORDER BY id DESC");
  while($row = $res->fetch_assoc()){
    echo "<tr>
      <td>".$row['reg_id']."</td>
      <td>".$row['name']."</td>
      <td>".$row['course']."</td>
      <td>".$row['mobile']."</td>
      <td>".$row['payment_status']."</td>
      <td>".$row['admission_status']."</td>
      <td>
        <a class='btn' href='update.php?id=".$row['id']."&status=Approved'>Approve</a>
        <a class='btn reject' href='update.php?id=".$row['id']."&status=Rejected'>Reject</a>
      </td>
    </tr>";
  }
  ?>

</table>

</body>
</html>
