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
  <title>Admin Dashboard - Koshi Institute</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    h2{color:#0b5cff;}
    table{width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;}
    th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left;font-size:14px;}
    th{background:#0b5cff;color:white;}
    a.btn{padding:6px 12px;background:green;color:white;text-decoration:none;border-radius:8px;font-weight:bold;}
    a.reject{background:red;}
    a.logout{float:right;color:red;font-weight:bold;text-decoration:none;}
    a.excel{padding:10px 15px;background:#0b5cff;color:white;border-radius:10px;text-decoration:none;font-weight:bold;display:inline-block;margin-bottom:15px;}
  </style>
</head>
<body>

<h2>Admin Dashboard 
  <a class="logout" href="logout.php">Logout</a>
</h2>

<a class="excel" href="export_excel.php">Export Excel Report</a>
<a class="excel" href="franchise_list.php" style="background:green;">View Franchise Requests</a>


<table>
  <tr>
    <th>Reg ID</th>
    <th>Name</th>
    <th>Course</th>
    <th>Mobile</th>
    <th>Txn ID</th>
    <th>Photo</th>
    <th>Aadhar</th>
    <th>Marksheet</th>
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
      <td>".$row['txn_id']."</td>

      <td><a href='../".$row['photo']."' target='_blank'>View</a></td>
      <td><a href='../".$row['aadhar']."' target='_blank'>View</a></td>
      <td><a href='../".$row['marksheet']."' target='_blank'>View</a></td>

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
