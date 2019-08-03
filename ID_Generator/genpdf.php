<?php

require('../fpdf181/fpdf.php');

$borders = 0;
$pdf = new FPDF();
$pdf->AddPage('L',[90,55]);
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Arial','B',16);
$pdf->SetLineWidth(0.6);
$pdf->Rect(1,1,88,53);
$pdf->SetLineWidth(0.2);

//For Editing
if($borders==1)
    $pdf->Rect(4,4,82,47);

$pdf->SetFillColor(21,86,92);
$pdf->Rect(1.5,1.5,87.25,11,'F');
$pdf->Rect(1.5,50.5,87.25,3.25,'F');
$pdf->SetFillColor(186,242,247);
$pdf->Rect(1.5,12.5,87.25,38.25,'F');

$pdf->SetXY(4,4);
$pdf->SetFontSize(10.1);
$pdf->SetTextColor(255);
$pdf->SetFont('Times');
$pdf->Cell(82,4,"COMPUTER ENGINEERS SOCIETY, IIEST, SHIBPUR",$borders,1,'C');

$pdf->SetXY(4,8.5);
$pdf->SetFontSize(8.5);
$pdf->Cell(82,3,"Since 1982",$borders,1,'C');

$pdf->SetXY(1.5,50.5);
$pdf->Cell(87,3.25,"Member",$borders,1,'C');

$pdf->SetFontSize(9);
$pdf->SetTextColor(0);
$pdf->Image("coensobec_logo.png",7,39,10,10,'png');


$pdf->SetXY(5,14);
$pdf->SetTextColor(0);
$pdf->SetFont('Times');
$pdf->Cell(15,4,"Name :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$pdf->Cell(65,4,strtoupper($_POST["name"]),$borders,1,'L');

$pdf->SetXY(5,18);
$pdf->SetTextColor(0);
$pdf->SetFont('Times');
$pdf->Cell(15,4,"Course :",$borders,0,'R');
$pdf->SetTextColor(50);
$pdf->SetFont('Courier');
$pdf->Cell(25,4,strtoupper($_POST["course"]),$borders,0,'L');

$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(18,4,"DOB :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$asd = date("d-m-Y",strtotime($_POST["dob"]));
$pdf->Cell(22,4,$asd,$borders,1,'L');

$pdf->SetXY(5,22);
$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(15,4,"Joined on :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$pdf->Cell(15,4,$_POST["yoj"],$borders,0,'L');

$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(28,4,"Blood Grp. :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$pdf->Cell(22,4,$_POST["bloodgroup"],$borders,1,'L');

$pdf->SetXY(5,26);
$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(15,4,"Gender :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$pdf->Cell(44,4,$_POST["gender"],$borders,1,'L');

$pdf->SetXY(5,30);
$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(15,4,"Age :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$diff = date_diff(date_create($_POST["dob"]),date_create(date("Y-m-d")));
$pdf->Cell(44,4,$diff->format('%y'),$borders,1,'L');

$pdf->SetXY(5,34);
$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(15,4,"Address :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$pdf->SetFontSize(7);
$pdf->SetY(34.5,false);
$pdf->MultiCell(44,3,$_POST["address"],$borders,'J');
$pdf->SetFontSize(9);


$pdf->SetLineWidth(1);
$pdf->Rect(65,30,20,20);
$pdf->Image($_FILES['profile']['tmp_name'],65,30,20,20,end(explode(".",$_FILES["profile"]["name"])));

$pdf->Output();

?>
