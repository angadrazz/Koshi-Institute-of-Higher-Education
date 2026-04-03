<?php
session_start();
include("db.php");

if(!isset($_SESSION['student_reg'])){
  header("Location: student_login.php");
  exit();
}

$reg = $_SESSION['student_reg'];
$res = $conn->query("SELECT * FROM students WHERE reg_id='$reg'");
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Dashboard</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:850px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    table{width:100%;border-collapse:collapse;margin-top:20px;}
    td{padding:12px;border-bottom:1px solid #ddd;font-weight:bold;}
    .btn{display:inline-block;padding:10px 15px;background:#0b5cff;color:white;text-decoration:none;border-radius:10px;font-weight:bold;}
    .logout{background:red;float:right;}
  </style>
</head>
<body>

<div class="box">
  <h2>Student Dashboard
    <a class="btn logout" href="student_logout.php">Logout</a>
  </h2>

  <table>
    <tr><td>Registration ID</td><td><?php echo $row['reg_id']; ?></td></tr>
    <tr><td>Name</td><td><?php echo $row['name']; ?></td></tr>
    <tr><td>Course</td><td><?php echo $row['course']; ?></td></tr>
    <tr><td>Admission Status</td><td><?php echo $row['admission_status']; ?></td></tr>
    <tr><td>Payment Status</td><td><?php echo $row['payment_status']; ?></td></tr>
    <tr><td>Course Status</td><td><?php echo $row['course_status']; ?></td></tr>
    <tr><td>Certificate No</td><td><?php echo $row['certificate_no']; ?></td></tr>
    <tr><td>Result</td><td><?php echo $row['result_status']; ?></td></tr>
    <tr><td>Marks</td><td><?php echo $row['obtained_marks']." / ".$row['total_marks']; ?></td></tr>
  </table>

  <br>

  <?php if($row['certificate_no']!="" && $row['course_status']=="Completed"){ ?>
    <a class="btn" href="certificate_pdf.php?reg=<?php echo $row['reg_id']; ?>" target="_blank">
      Download Certificate PDF
    </a>
  <?php } ?>

  <?php if($row['marksheet_pdf']!=""){ ?>
    <a class="btn" style="background:green;" href="<?php echo $row['marksheet_pdf']; ?>" target="_blank">
      Download Marksheet PDF
    </a>
  <?php } ?>

</div>

</body>
</html>
