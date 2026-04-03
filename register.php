<?php
session_start();
include("db.php");

$captcha = rand(1000,9999);
$_SESSION['captcha'] = $captcha;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Online Registration - Koshi Institute</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:600px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input,select,textarea{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    label{font-weight:bold;margin-top:10px;display:block;color:#0b5cff;}
    button{width:100%;padding:12px;margin-top:15px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;cursor:pointer;}
    button:hover{background:#0047d1;}
    .msg{text-align:center;font-weight:bold;margin-top:10px;}
  </style>
</head>
<body>

<div class="box">
  <h2>Online Course Registration</h2>

  <form method="POST" enctype="multipart/form-data">

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

    <input type="text" name="txn" placeholder="Payment Transaction ID (After Payment)">

    <label>Upload Photo</label>
    <input type="file" name="photo" required>

    <label>Upload Aadhar</label>
    <input type="file" name="aadhar" required>

    <label>Upload Marksheet</label>
    <input type="file" name="marksheet" required>

    <label>Captcha Code: <span style="color:red;"><?php echo $_SESSION['captcha']; ?></span></label>
    <input type="text" name="captcha_input" placeholder="Enter Captcha" required>

    <button type="submit" name="submit">Submit Registration</button>
  </form>

  <?php
  if(isset($_POST['submit'])){

    if($_POST['captcha_input'] != $_SESSION['captcha']){
      echo "<p class='msg' style='color:red;'>Invalid Captcha!</p>";
      exit();
    }

    $name = $_POST['name'];
    $father = $_POST['father'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $address = $_POST['address'];
    $txn = $_POST['txn'];

    $reg_id = "KOSHI".date("Y").rand(1000,9999);

    if(!is_dir("uploads")){
      mkdir("uploads", 0777, true);
    }

    $photo_name = $reg_id."_photo_".basename($_FILES["photo"]["name"]);
    $aadhar_name = $reg_id."_aadhar_".basename($_FILES["aadhar"]["name"]);
    $marksheet_name = $reg_id."_marksheet_".basename($_FILES["marksheet"]["name"]);

    $photo_path = "uploads/".$photo_name;
    $aadhar_path = "uploads/".$aadhar_name;
    $marksheet_path = "uploads/".$marksheet_name;

    move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_path);
    move_uploaded_file($_FILES["aadhar"]["tmp_name"], $aadhar_path);
    move_uploaded_file($_FILES["marksheet"]["tmp_name"], $marksheet_path);

    $sql = "INSERT INTO students (reg_id,name,father_name,mobile,email,course,address,txn_id,photo,aadhar,marksheet)
            VALUES ('$reg_id','$name','$father','$mobile','$email','$course','$address','$txn','$photo_path','$aadhar_path','$marksheet_path')";

    if($conn->query($sql) === TRUE){

      echo "<p class='msg' style='color:green;'>Registration Successful!</p>";
      echo "<p class='msg'><b>Your Registration ID:</b> $reg_id</p>";

      echo "<p class='msg'><a href='pay.php?reg=$reg_id' style='color:#0b5cff;'>Pay Admission Fee</a></p>";
      echo "<p class='msg'><a href='verify.php?reg=$reg_id' style='color:green;'>Verify Your Record</a></p>";

    } else {
      echo "<p class='msg' style='color:red;'>Error: ".$conn->error."</p>";
    }
  }
  ?>
</div>

</body>
</html>
