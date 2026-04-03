<?php
include("db.php");
require("fpdf/fpdf.php");

$reg = $_GET['reg'];

$res = $conn->query("SELECT * FROM students WHERE reg_id='$reg' AND idcard_status='Generated'");
if($res->num_rows==0){
  die("ID Card Not Generated Yet!");
}

$row = $res->fetch_assoc();

$pdf = new FPDF("P","mm","A4");
$pdf->AddPage();

$pdf->SetFont("Arial","B",16);
$pdf->Cell(0,10,"Koshi Institute of Higher Education",0,1,"C");
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,8,"(A Unit of Koshi Shiksha Private Limited)",0,1,"C");

$pdf->Ln(10);

/* ID CARD BOX */
$pdf->SetDrawColor(11,92,255);
$pdf->SetLineWidth(1);
$pdf->Rect(35, 55, 140, 85, "D");

$pdf->SetFont("Arial","B",14);
$pdf->SetTextColor(11,92,255);
$pdf->SetXY(35, 58);
$pdf->Cell(140,10,"STUDENT ID CARD",0,1,"C");

$pdf->SetTextColor(0,0,0);

/* PHOTO */
if($row['photo']!=""){
  $photoPath = $row['photo'];
  if(file_exists($photoPath)){
    $pdf->Image($photoPath, 42, 75, 30, 35);
  }
}

/* DETAILS */
$pdf->SetFont("Arial","B",11);
$pdf->SetXY(78, 75);
$pdf->Cell(35,8,"Name:",0,0);
$pdf->SetFont("Arial","",11);
$pdf->Cell(60,8,$row['name'],0,1);

$pdf->SetFont("Arial","B",11);
$pdf->SetX(78);
$pdf->Cell(35,8,"Course:",0,0);
$pdf->SetFont("Arial","",11);
$pdf->Cell(60,8,$row['course'],0,1);

$pdf->SetFont("Arial","B",11);
$pdf->SetX(78);
$pdf->Cell(35,8,"Reg ID:",0,0);
$pdf->SetFont("Arial","",11);
$pdf->Cell(60,8,$row['reg_id'],0,1);

$pdf->SetFont("Arial","B",11);
$pdf->SetX(78);
$pdf->Cell(35,8,"Student ID:",0,0);
$pdf->SetFont("Arial","",11);
$pdf->Cell(60,8,$row['student_id'],0,1);

$pdf->SetFont("Arial","B",11);
$pdf->SetX(78);
$pdf->Cell(35,8,"Mobile:",0,0);
$pdf->SetFont("Arial","",11);
$pdf->Cell(60,8,$row['mobile'],0,1);

$pdf->SetFont("Arial","B",11);
$pdf->SetX(78);
$pdf->Cell(35,8,"Valid Till:",0,0);
$pdf->SetFont("Arial","",11);
$pdf->Cell(60,8,date("d-m-Y", strtotime("+1 year")),0,1);

/* QR CODE */
$verify_link = "https://koshiinstitute.org/verify.php?reg=".$row['reg_id'];
$qr = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=".$verify_link;

$pdf->Image($qr, 140, 108, 28, 28);

$pdf->SetFont("Arial","B",9);
$pdf->SetXY(130, 137);
$pdf->Cell(50,6,"Scan to Verify",0,0,"C");

/* FOOTER SIGN */
$pdf->SetFont("Arial","B",10);
$pdf->SetXY(40, 130);
$pdf->Cell(70,8,"Authorized Signatory",0,0);

$pdf->Output();
?>
