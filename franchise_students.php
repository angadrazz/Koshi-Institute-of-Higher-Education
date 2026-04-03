<?php
session_start();
include("db.php");

if(!isset($_SESSION['franchise_id'])){
  header("Location: franchise_login.php");
  exit();
}

$fid = $_SESSION['franchise_id'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Students - Franchise Panel</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    h2{color:#0b5cff;}
    table{width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;}
    th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left;font-size:14px;}
    th{background:#0b5cff;color:white;}
    a.btn{padding:8px 12px;background:green;color:white;text-decoration:none;border-radius:10px;font-weight:bold;}
    a.back{display:inline-block;margin-bottom:15px;text-decoration:none;font-weight:bold;color:green;}
  </style>
</head>
<body>

<h2>My Students (<?php echo $fid; ?>)</h2>

<a class="back" href="franchise_dashboard.php">⬅ Back to Dashboard</a>

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
