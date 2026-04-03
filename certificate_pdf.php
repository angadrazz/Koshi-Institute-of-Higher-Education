<?php
include("db.php");
require("fpdf/fpdf.php");

$reg = $_GET['reg'];

$res = $conn->query("SELECT * FROM students WHERE reg_id='$reg' AND admission_status='Approved' AND course_status='Completed'");
if($res->num_rows==0){
  die("Invalid Student");
}

$row = $res->fetch_assoc();

$pdf = new FPDF("L","mm","A4");
$pdf->AddPage();

$pdf->SetFont("Arial","B",22);
$pdf->Cell(0,15,"Koshi Institute of Higher Education",0,1,"C");

$pdf->SetFont("Arial","",14);
$pdf->Cell(0,10,"(A Unit of Koshi Shiksha Private Limited)",0,1,"C");

$pdf->Ln(10);

$pdf->SetFont("Arial","B",20);
$pdf->Cell(0,12,"COURSE COMPLETION CERTIFICATE",0,1,"C");

$pdf->Ln(12);

$pdf->SetFont("Arial","",16);
$pdf->MultiCell(0,10,
"This is to certify that ".$row['name']." (S/o ".$row['father_name'].") has successfully completed the course: ".$row['course'].".

Certificate No: ".$row['certificate_no']."
Registration ID: ".$row['reg_id']."

Date: ".date("d-m-Y"),
0,"C");

$verify_link = "https://koshiinstitute.org/verify.php?reg=".$row['reg_id'];

$pdf->Image("https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=".$verify_link, 240, 130, 45, 45);

$pdf->SetXY(230, 175);
$pdf->SetFont("Arial","B",10);
$pdf->Cell(60,8,"Scan to Verify Certificate",0,0,"C");

$pdf->Ln(25);
$pdf->SetFont("Arial","B",14);
$pdf->Cell(0,10,"Authorized Signatory",0,1,"R");

$pdf->Output();
?>
