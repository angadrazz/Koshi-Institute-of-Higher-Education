<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
$msg = "";

$res = $conn->query("SELECT * FROM students WHERE id='$id'");
if($res->num_rows == 0){
  die("Invalid Student");
}
$row = $res->fetch_assoc();

if(isset($_POST['submit'])){

  $total = $_POST['total'];
  $obtained = $_POST['obtained'];
  $status = $_POST['status'];

  $file_path = $row['marksheet_pdf'];

  if(!empty($_FILES['marksheet']['name'])){
    if(!is_dir("../uploads")){
      mkdir("../uploads",0777,true);
    }

    $file_name = $row['reg_id']."_marksheet_".basename($_FILES['marksheet']['name']);
    $file_path = "uploads/".$file_name;

    move_uploaded_file($_FILES['marksheet']['tmp_name'], "../".$file_path);
  }

  $conn->query("UPDATE students 
    SET total_marks='$total', obtained_marks='$obtained', result_status='$status', marksheet_pdf='$file_path'
    WHERE id='$id'
  ");

  $msg="Marksheet Updated Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload Marksheet</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:650px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input,select{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:15px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;}
    .msg{text-align:center;font-weight:bold;margin-top:12px;color:green;}
    a.back{display:inline-block;margin-top:15px;text-decoration:none;font-weight:bold;color:green;}
  </style>
</head>
<body>

<div class="box">
  <h2>Upload Marks + Marksheet PDF</h2>

  <?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>

  <p><b>Student:</b> <?php echo $row['name']; ?> (<?php echo $row['reg_id']; ?>)</p>

  <form method="POST" enctype="multipart/form-data">
    <input type="number" name="total" placeholder="Total Marks" value="<?php echo $row['total_marks']; ?>" required>
    <input type="number" name="obtained" placeholder="Obtained Marks" value="<?php echo $row['obtained_marks']; ?>" required>

    <select name="status" required>
      <option value="Pending" <?php if($row['result_status']=="Pending") echo "selected"; ?>>Pending</option>
      <option value="Pass" <?php if($row['result_status']=="Pass") echo "selected"; ?>>Pass</option>
      <option value="Fail" <?php if($row['result_status']=="Fail") echo "selected"; ?>>Fail</option>
    </select>

    <input type="file" name="marksheet">

    <button type="submit" name="submit">Save Marksheet</button>
  </form>

  <?php if($row['marksheet_pdf']!=""){ ?>
    <p style="margin-top:12px;">
      <b>Uploaded PDF:</b>
      <a href="../<?php echo $row['marksheet_pdf']; ?>" target="_blank">View Marksheet</a>
    </p>
  <?php } ?>

  <a class="back" href="dashboard.php">⬅ Back to Dashboard</a>
</div>

</body>
</html>
