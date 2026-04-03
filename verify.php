<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Student Verification - Koshi Institute</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:30px;}
    .box{max-width:600px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:12px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;cursor:pointer;}
    table{width:100%;margin-top:20px;border-collapse:collapse;}
    td{padding:10px;border-bottom:1px solid #ddd;}
  </style>
</head>
<body>

<div class="box">
  <h2>Student Verification Portal</h2>

  <form method="GET">
    <input type="text" name="reg" placeholder="Enter Registration ID" required>
    <button type="submit">Verify</button>
  </form>

  <?php
  if(isset($_GET['reg'])){
    $reg = $_GET['reg'];
    $res = $conn->query("SELECT * FROM students WHERE reg_id='$reg'");

    if($res->num_rows > 0){
      $row = $res->fetch_assoc();
      echo "<table>
        <tr><td><b>Name</b></td><td>".$row['name']."</td></tr>
        <tr><td><b>Course</b></td><td>".$row['course']."</td></tr>
        <tr><td><b>Mobile</b></td><td>".$row['mobile']."</td></tr>
        <tr><td><b>Admission Status</b></td><td>".$row['status']."</td></tr>
        <tr><td><b>Payment Status</b></td><td>".$row['txn_id']."</td></tr>
        <tr><td><b>Registered On</b></td><td>".$row['created_at']."</td></tr>
      </table>";
    } else {
      echo "<p style='color:red;text-align:center;margin-top:20px;'>No Record Found!</p>";
    }
  }
  ?>
</div>

</body>
</html>
