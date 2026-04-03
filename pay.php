<?php
$reg = $_GET['reg'] ?? "KOSHI20260000";
$upi = "koshiinstitute@paytm";
$amount = "500";

$note = "Admission Fee - ".$reg;
$upi_link = "upi://pay?pa=$upi&pn=Koshi%20Institute&am=$amount&cu=INR&tn=".urlencode($note);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pay Admission Fee</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:30px;text-align:center;}
    .box{max-width:450px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{color:#0b5cff;}
    a.paybtn{display:block;padding:14px;background:#0b5cff;color:white;text-decoration:none;font-weight:bold;border-radius:12px;margin-top:15px;}
    a.paybtn:hover{background:#0047d1;}
  </style>
</head>
<body>

<div class="box">
  <h2>Pay Admission Fee</h2>
  <p><b>Registration ID:</b> <?php echo $reg; ?></p>
  <p><b>UPI ID:</b> <?php echo $upi; ?></p>
  <p><b>Amount:</b> ₹<?php echo $amount; ?></p>

  <a class="paybtn" href="<?php echo $upi_link; ?>">Pay Now via PhonePe / GPay / Paytm</a>

  <p style="margin-top:15px;color:gray;font-weight:bold;">
    After payment, fill Txn ID in Registration Form.
  </p>
</div>

</body>
</html>
