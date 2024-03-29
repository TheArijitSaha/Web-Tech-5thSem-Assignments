<?php
session_start();

function CourseTime($course){
    if($course == "B.TECH.")
        return 4;
    else if($course=="M.TECH.")
        return 2;
    else if($course=="Dual Degree")
        return 5;
    else if($course=="M.Sc.")
        return 2;
    return 0;
}

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
$pdf->Rect(1.3,1.25,87.45,11,'F');
$pdf->Rect(1.3,50.75,87.45,2.95,'F');
$pdf->SetFillColor(186,242,247);
$pdf->Rect(1.3,12.25,87.45,38.5,'F');

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
$pdf->Cell(65,4,strtoupper($_SESSION["name"]),$borders,1,'L');

$pdf->SetXY(5,18);
$pdf->SetTextColor(0);
$pdf->SetFont('Times');
$pdf->Cell(15,4,"Course :",$borders,0,'R');
$pdf->SetTextColor(50);
$pdf->SetFont('Courier');
$pdf->Cell(25,4,strtoupper($_SESSION["course"]),$borders,0,'L');

$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(18,4,"DOB :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$asd = date("d-m-Y",strtotime($_SESSION["dob"]));
$pdf->Cell(22,4,$asd,$borders,1,'L');

$pdf->SetXY(5,22);
$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(15,4,"Joined on :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$pdf->Cell(15,4,$_SESSION["yoj"],$borders,0,'L');

$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(28,4,"Blood Grp. :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$pdf->Cell(22,4,$_SESSION["bloodgroup"],$borders,1,'L');

$pdf->SetXY(5,26);
$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(15,4,"Gender :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$pdf->Cell(44,4,$_SESSION["gender"],$borders,1,'L');

$pdf->SetXY(5,30);
$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(15,4,"Valid Upto :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$yog = $_SESSION["yoj"]+CourseTime($_SESSION["course"]);
$pdf->Cell(44,4,$yog,$borders,1,'L');

$pdf->SetXY(5,34);
$pdf->SetFont('Times');
$pdf->SetTextColor(0);
$pdf->Cell(15,4,"Address :",$borders,0,'R');
$pdf->SetFont('Courier');
$pdf->SetTextColor(50);
$pdf->SetFontSize(7);
$pdf->SetY(34.5,false);
$pdf->MultiCell(44,3,$_SESSION["address"],$borders,'J');
$pdf->SetFontSize(9);


$pdf->SetLineWidth(1);
$pdf->Rect(65,30,20,20);
$split_name=explode(".",$_SESSION["profile"]);
$pdf->Image($_SESSION["profile"],65,30,20,20,end($split_name));
$pdf->Output('I','ID - '.$_SESSION["name"].'.pdf');

session_unset();
session_destroy();

?>
