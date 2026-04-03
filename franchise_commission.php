<?php
session_start();
include("db.php");

if(!isset($_SESSION['franchise_id'])){
  header("Location: franchise_login.php");
  exit();
}

$fid = $_SESSION['franchise_id'];

$fres = $conn->query("SELECT commission_percent FROM franchise WHERE franchise_id='$fid'");
$fdata = $fres->fetch_assoc();
$percent = $fdata['commission_percent'];

$fee_per_student = 500; // change if needed
?>

<!DOCTYPE html>
<html>
<head>
  <title>Commission Report</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:850px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    table{width:100%;border-collapse:collapse;margin-top:20px;}
    th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left;}
    th{background:#0b5cff;color:white;}
    .summary{margin-top:20px;font-weight:bold;color:green;text-align:center;font-size:18px;}
    a.back{display:inline-block;margin-top:15px;text-decoration:none;font-weight:bold;color:green;}
  </style>
</head>
<body>

<div class="box">
  <h2>Franchise Commission Report</h2>

  <table>
    <tr>
      <th>Reg ID</th>
      <th>Student Name</th>
      <th>Course</th>
      <th>Admission Status</th>
      <th>Fee</th>
      <th>Commission</th>
    </tr>

    <?php
    $total_fee = 0;
    $total_commission = 0;

    $res = $conn->query("SELECT * FROM students WHERE franchise_id='$fid' AND admission_status='Approved' ORDER BY id DESC");
    while($row = $res->fetch_assoc()){

      $fee = $fee_per_student;
      $commission = ($fee * $percent)/100;

      $total_fee += $fee;
      $total_commission += $commission;

      echo "<tr>
        <td>".$row['reg_id']."</td>
        <td>".$row['name']."</td>
        <td>".$row['course']."</td>
        <td>".$row['admission_status']."</td>
        <td>₹".$fee."</td>
        <td>₹".$commission."</td>
      </tr>";
    }
    ?>
  </table>

  <div class="summary">
    Total Fee Collection (Approved): ₹<?php echo $total_fee; ?><br>
    Commission Percent: <?php echo $percent; ?>%<br>
    Total Commission Earned: ₹<?php echo $total_commission; ?>
  </div>

  <a class="back" href="franchise_dashboard.php">⬅ Back to Dashboard</a>
</div>

</body>
</html>
