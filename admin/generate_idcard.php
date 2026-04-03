<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM students WHERE id='$id'");
if($res->num_rows == 0){
  die("Invalid Student");
}

$row = $res->fetch_assoc();

$student_id = "KOSHI-ID-".date("Y").rand(1000,9999);

$conn->query("UPDATE students 
SET student_id='$student_id', idcard_status='Generated'
WHERE id='$id'");

header("Location: dashboard.php");
exit();
?>
