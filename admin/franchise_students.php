<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$fid = $_GET['fid'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Franchise Students</title>
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

<h2>Students Registered By Franchise: <?php echo $fid; ?></h2>
<a class="back" href="franchise_list.php">⬅ Back to Franchise List</a>

<table>
  <tr>
    <th>Reg ID</th>
    <th>Name</th>
    <th>Course</th>
    <th>Mobile</th>
    <th>Status</th>
    <th>Date</th>
  </tr>

  <?php
  $res = $conn->query("SELECT * FROM students WHERE franchise_id='$fid' ORDER BY id DESC");
  while($row = $res->fetch_assoc()){
    echo "<tr>
      <td>".$row['reg_id']."</td>
      <td>".$row['name']."</td>
      <td>".$row['course']."</td>
      <td>".$row['mobile']."</td>
      <td>".$row['admission_status']."</td>
      <td>".$row['created_at']."</td>
    </tr>";
  }
  ?>

</table>

</body>
</html>
