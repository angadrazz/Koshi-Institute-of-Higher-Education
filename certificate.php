<?php
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Certificate Download</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:30px;}
    .box{max-width:600px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:12px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;}
    .msg{text-align:center;font-weight:bold;margin-top:12px;}
    a.btn{display:inline-block;padding:10px 14px;background:green;color:white;text-decoration:none;border-radius:10px;}
  </style>
</head>
<body>

<div class="box">
  <h2>Download Certificate</h2>

  <form method="POST">
    <input type="text" name="reg_id" placeholder="Enter Registration ID" required>
    <input type="text" name="mobile" placeholder="Enter Mobile Number" required>
    <button type="submit" name="search">Search Certificate</button>
  </form>

  <?php
  if(isset($_POST['search'])){
    $reg=$_POST['reg_id'];
    $mobile=$_POST['mobile'];

    $res=$conn->query("SELECT * FROM students WHERE reg_id='$reg' AND mobile='$mobile' AND admission_status='Approved' AND course_status='Completed'");

    if($res->num_rows>0){
      $row=$res->fetch_assoc();

      if($row['certificate_no']==""){
        echo "<p class='msg' style='color:red;'>Certificate Not Generated Yet!</p>";
      } else {
        echo "<p class='msg' style='color:green;'>Certificate Found!</p>";
        echo "<p class='msg'><b>Certificate No:</b> ".$row['certificate_no']."</p>";
        echo "<p class='msg'><a class='btn' href='certificate_pdf.php?reg=".$row['reg_id']."' target='_blank'>Download PDF Certificate</a></p>";
      }

    } else {
      echo "<p class='msg' style='color:red;'>No Certificate Available!</p>";
    }
  }
  ?>
</div>

</body>
</html>
