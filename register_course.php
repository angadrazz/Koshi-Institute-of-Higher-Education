<?php
include("db.php");

$course = $_GET['course'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Course Admission Form</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:650px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input,textarea{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:15px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;cursor:pointer;}
    .msg{text-align:center;font-weight:bold;margin-top:12px;}
  </style>
</head>
<body>

<div class="box">
  <h2>Online Admission Form</h2>
  <p style="text-align:center;font-weight:bold;color:green;">Selected Course: <?php echo $course; ?></p>

  <form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="text" name="father" placeholder="Father Name" required>
    <input type="text" name="mobile" placeholder="Mobile Number" required>
    <input type="email" name="email" placeholder="Email (Optional)">
    <textarea name="address" placeholder="Full Address" required></textarea>

    <button type="submit" name="submit">Submit Admission</button>
  </form>

  <?php
  if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $father=$_POST['father'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $address=$_POST['address'];

    $reg_id = "KOSHI".date("Y").rand(1000,9999);

    $sql="INSERT INTO students(reg_id,name,father_name,mobile,email,course,address)
          VALUES('$reg_id','$name','$father','$mobile','$email','$course','$address')";

    if($conn->query($sql)===TRUE){
      echo "<p class='msg' style='color:green;'>Admission Submitted Successfully!</p>";
      echo "<p class='msg'><b>Your Registration ID:</b> $reg_id</p>";
      echo "<p class='msg'><a style='color:#0b5cff;font-weight:bold;' href='pay.php?reg=$reg_id'>Pay Now</a></p>";
    }else{
      echo "<p class='msg' style='color:red;'>Error: ".$conn->error."</p>";
    }
  }
  ?>

</div>

</body>
</html>
