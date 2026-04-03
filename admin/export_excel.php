<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=students_report.xls");

echo "RegID\tName\tFather\tMobile\tEmail\tCourse\tPaymentStatus\tAdmissionStatus\tTxnID\tDate\n";

$res = $conn->query("SELECT * FROM students ORDER BY id DESC");
while($row = $res->fetch_assoc()){
  echo $row['reg_id']."\t".
       $row['name']."\t".
       $row['father_name']."\t".
       $row['mobile']."\t".
       $row['email']."\t".
       $row['course']."\t".
       $row['payment_status']."\t".
       $row['admission_status']."\t".
       $row['txn_id']."\t".
       $row['created_at']."\n";
}
?>
