<?php include("db.php"); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Course Registration - Koshi Institute</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:520px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input,select,textarea{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:15px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;cursor:pointer;}
    button:hover{background:#0047d1;}
  </style>
</head>
<body>

<div class="box">
  <h2>Online Course Registration</h2>

  <form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="text" name="father" placeholder="Father Name" required>
    <input type="text" name="mobile" placeholder="Mobile Number" required>
    <input type="email" name="email" placeholder="Email (Optional)">

    <select name="course" required>
      <option value="">Select Course</option>
      <option>B.Ed</option>
      <option>D.El.Ed</option>
      <option>B.A</option>
      <option>B.Sc</option>
      <option>B.Com</option>
      <option>M.A</option>
      <option>M.Sc</option>
      <option>M.Com</option>
      <option>Diploma & Skill Course</option>
    </select>

    <textarea name="address" placeholder="Full Address" required></textarea>

    <input type="text" name="txn" placeholder="Payment Txn ID (After Payment)">

    <button type="submit" name="submit">Submit Registration</button>
  </form>

  <?php
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $father = $_POST['father'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $address = $_POST['address'];
    $txn = $_POST['txn'];

    $reg_id = "KOSHI".date("Y").rand(1000,9999);

    $sql = "INSERT INTO students (reg_id,name,father_name,mobile,email,course,address,txn_id)
            VALUES ('$reg_id','$name','$father','$mobile','$email','$course','$address','$txn')";

    if($conn->query($sql) === TRUE){
      echo "<h3 style='color:green;text-align:center;'>Registration Successful!</h3>";
      echo "<p style='text-align:center;'><b>Your Registration ID:</b> $reg_id</p>";

      echo "<p style='text-align:center;'>
      <a href='pay.php?reg=$reg_id' style='color:#0b5cff;font-weight:bold;'>Click Here to Pay Fee</a></p>";
    } else {
      echo "<p style='color:red;text-align:center;'>Error: ".$conn->error."</p>";
    }
  }
  ?>
</div>

</body>
</html>
