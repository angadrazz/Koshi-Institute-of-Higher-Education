<?php
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Apply Franchise - Koshi Institute</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:650px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input,select,textarea{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:15px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;cursor:pointer;}
    button:hover{background:#0047d1;}
    .msg{text-align:center;font-weight:bold;margin-top:15px;}
    .note{background:#eef6ff;padding:12px;border-radius:12px;border:1px solid #d5e9ff;margin-top:15px;font-weight:bold;color:#0b5cff;}
  </style>
</head>
<body>

<div class="box">
  <h2>Franchise Application Form</h2>

  <div class="note">
    Become an Authorized Franchise Partner of Koshi Institute of Higher Education.
  </div>

  <form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="text" name="mobile" placeholder="Mobile Number" required>
    <input type="email" name="email" placeholder="Email (Optional)">

    <input type="text" name="city" placeholder="City" required>
    <input type="text" name="district" placeholder="District" required>
    <input type="text" name="state" placeholder="State" required>

    <select name="space" required>
      <option value="">Office Space Available?</option>
      <option>Yes (100–200 Sq.ft)</option>
      <option>Yes (200–500 Sq.ft)</option>
      <option>Yes (500+ Sq.ft)</option>
      <option>No (Planning Soon)</option>
    </select>

    <select name="investment" required>
      <option value="">Investment Capacity</option>
      <option>₹20,000 – ₹50,000</option>
      <option>₹50,000 – ₹1,00,000</option>
      <option>₹1,00,000 – ₹2,00,000</option>
      <option>₹2,00,000+</option>
    </select>

    <textarea name="message" placeholder="Why you want franchise? (Optional)"></textarea>

    <button type="submit" name="submit">Submit Franchise Application</button>
  </form>

  <?php
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $state = $_POST['state'];
    $space = $_POST['space'];
    $investment = $_POST['investment'];
    $message = $_POST['message'];

    $sql = "INSERT INTO franchise (name,mobile,email,city,district,state,space,investment,message)
            VALUES ('$name','$mobile','$email','$city','$district','$state','$space','$investment','$message')";

    if($conn->query($sql) === TRUE){

      echo "<p class='msg' style='color:green;'>Franchise Request Submitted Successfully!</p>";

      $text = "Koshi Franchise Enquiry%0A%0AName: $name%0AMobile: $mobile%0AEmail: $email%0ACity: $city%0ADistrict: $district%0AState: $state%0ASpace: $space%0AInvestment: $investment%0AMessage: $message";

      echo "<p class='msg'><a style='color:#0b5cff;font-weight:bold;' target='_blank'
        href='https://wa.me/919431496862?text=$text'>Send Details on WhatsApp</a></p>";

    } else {
      echo "<p class='msg' style='color:red;'>Error: ".$conn->error."</p>";
    }
  }
  ?>

</div>

</body>
</html>
