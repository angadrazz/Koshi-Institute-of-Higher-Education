<?php
$id = $_GET['id'] ?? "";

$courses = [
  "ADCA" => ["name"=>"ADCA (Advanced Diploma in Computer Application)", "duration"=>"12 Months", "fee"=>"5000", "type"=>"Computer"],
  "DCA"  => ["name"=>"DCA (Diploma in Computer Application)", "duration"=>"6 Months", "fee"=>"3000", "type"=>"Computer"],
  "TALLY"=> ["name"=>"Tally + GST", "duration"=>"3 Months", "fee"=>"2500", "type"=>"Computer"],

  "BEAUTY" => ["name"=>"Beauty Parlour Course", "duration"=>"3 Months", "fee"=>"3000", "type"=>"Vocational"],
  "TAILOR" => ["name"=>"Tailoring Course", "duration"=>"6 Months", "fee"=>"4000", "type"=>"Vocational"],

  "BED" => ["name"=>"B.Ed (Bachelor of Education)", "duration"=>"2 Years", "fee"=>"50000", "type"=>"Degree"],
  "DELED" => ["name"=>"D.El.Ed", "duration"=>"2 Years", "fee"=>"45000", "type"=>"Degree"]
];

if(!isset($courses[$id])){
  die("Invalid Course");
}

$course = $courses[$id];
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $course['name']; ?> | Koshi Institute</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:30px;}
    .box{max-width:850px;margin:auto;background:white;padding:30px;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{color:#0b5cff;}
    p{font-size:16px;line-height:1.8;font-weight:bold;color:#333;}
    .btn{display:inline-block;padding:12px 18px;background:#0b5cff;color:white;text-decoration:none;border-radius:12px;font-weight:bold;margin-top:15px;}
    .btn2{background:green;}
  </style>
</head>
<body>

<div class="box">
  <h2><?php echo $course['name']; ?></h2>

  <p>📌 Course Type: <?php echo $course['type']; ?></p>
  <p>⏳ Duration: <?php echo $course['duration']; ?></p>
  <p>💰 Total Fees: ₹<?php echo $course['fee']; ?></p>

  <p>
    ✅ Full Guidance + Admission Support <br>
    ✅ Study Material Support <br>
    ✅ Certificate after completion <br>
    ✅ Verification System Available
  </p>

  <a class="btn" href="register_course.php?course=<?php echo $id; ?>">Apply Online Admission</a>
  <a class="btn btn2" href="pay.php?reg=<?php echo $id; ?>">Pay Now</a>
</div>

</body>
</html>
