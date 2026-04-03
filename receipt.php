<?php
include("db.php");
require("fpdf/fpdf.php");

$reg = $_GET['reg'];

$res = $conn->query("SELECT * FROM students WHERE reg_id='$reg'");
if($res->num_rows == 0){
  die("Invalid Registration ID");
}

$row = $res->fetch_assoc();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);

$pdf->Cell(190,10,"Koshi Institute of Higher Education",0,1,"C");
$pdf->SetFont("Arial","",12);
$pdf->Cell(190,8,"(A Unit of Koshi Shiksha Private Limited)",0,1,"C");
$pdf->Ln(5);

$pdf->SetFont("Arial","B",14);
$pdf->Cell(190,10,"Admission Receipt",0,1,"C");
$pdf->Ln(8);

$pdf->SetFont("Arial","",12);
$pdf->Cell(60,8,"Registration ID:",0,0);
$pdf->Cell(100,8,$row['reg_id'],0,1);

$pdf->Cell(60,8,"Student Name:",0,0);
$pdf->Cell(100,8,$row['name'],0,1);

$pdf->Cell(60,8,"Father Name:",0,0);
$pdf->Cell(100,8,$row['father_name'],0,1);

$pdf->Cell(60,8,"Course:",0,0);
$pdf->Cell(100,8,$row['course'],0,1);

$pdf->Cell(60,8,"Mobile:",0,0);
$pdf->Cell(100,8,$row['mobile'],0,1);

$pdf->Cell(60,8,"Payment Status:",0,0);
$pdf->Cell(100,8,$row['payment_status'],0,1);

$pdf->Cell(60,8,"Transaction ID:",0,0);
$pdf->Cell(100,8,$row['txn_id'],0,1);

$pdf->Cell(60,8,"Date:",0,0);
$pdf->Cell(100,8,$row['created_at'],0,1);

$pdf->Ln(15);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(190,10,"This is a system generated receipt.",0,1,"C");

$pdf->Output();
?>
