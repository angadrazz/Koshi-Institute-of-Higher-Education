<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Student Verification - Koshi Institute</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:30px;}
    .box{max-width:800px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:12px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;cursor:pointer;}
    table{width:100%;margin-top:20px;border-collapse:collapse;}
    td{padding:10px;border-bottom:1px solid #ddd;}
    .qr{text-align:center;margin-top:20px;}
    .qr img{width:160px;border:1px solid #ddd;padding:10px;border-radius:10px;}
    .btn{display:inline-block;padding:10px 15px;background:green;color:white;text-decoration:none;border-radius:10px;font-weight:bold;}
  </style>
</head>
<body>

<div class="box">
  <h2>Student Verification Portal</h2>

  <form method="GET">
    <input type="text" name="reg" placeholder="Enter Registration ID" required>
    <button type="submit">Verify Student</button>
  </form>

  <?php
  if(isset($_GET['reg'])){
    $reg = $_GET['reg'];
    $res = $conn->query("SELECT * FROM students WHERE reg_id='$reg'");

    if($res->num_rows > 0){
      $row = $res->fetch_assoc();

      $verify_link = "https://koshiinstitute.org/verify.php?reg=".$row['reg_id'];

      echo "<table>
        <tr><td><b>Registration ID</b></td><td>".$row['reg_id']."</td></tr>
        <tr><td><b>Name</b></td><td>".$row['name']."</td></tr>
        <tr><td><b>Father Name</b></td><td>".$row['father_name']."</td></tr>
        <tr><td><b>Course</b></td><td>".$row['course']."</td></tr>
        <tr><td><b>Mobile</b></td><td>".$row['mobile']."</td></tr>
        <tr><td><b>Payment Status</b></td><td>".$row['payment_status']."</td></tr>
        <tr><td><b>Admission Status</b></td><td>".$row['admission_status']."</td></tr>
        <tr><td><b>Txn ID</b></td><td>".$row['txn_id']."</td></tr>
        <tr><td><b>Date</b></td><td>".$row['created_at']."</td></tr>
      </table>";

      echo "<div class='qr'>
        <h3 style='color:#0b5cff;'>QR Verification</h3>
        <img src='https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=$verify_link'>
        <p style='color:gray;font-weight:bold;'>Scan QR to verify record</p>
      </div>";

      echo "<div style='text-align:center;margin-top:15px;'>
        <a class='btn' href='receipt.php?reg=".$row['reg_id']."' target='_blank'>Download Receipt PDF</a>
      </div>";

    } else {
      echo "<p style='color:red;text-align:center;margin-top:20px;font-weight:bold;'>No Record Found!</p>";
    }
  }
  ?>
</div>

</body>
</html>
