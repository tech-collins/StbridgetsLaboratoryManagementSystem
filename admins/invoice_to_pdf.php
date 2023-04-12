<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';
require 'fpdf/fpdf.php';


function showAge($dfb)
{
    $birth_date = strtotime($dfb);
    $now = time();
    $age = $now - $birth_date;
    $new_age = intval($age / 60 / 60 / 24 / 365.25);
    return $new_age;
    //$dd = stripos(".",$a,0 );
    //$new_age = substr($a,$dd);
}
function prizeOnly($reference)
{
    include 'fabinde.php';

    $amount = 0;
    $test_query = mysqli_query($con,"SELECT test_amount FROM test_categories WHERE test_ref='$reference'");
    while($results = mysqli_fetch_assoc($test_query))
        {
            $amount = intval($results['test_amount']);
        }

        return $amount;
}

if(isset($_GET["invoiceRef"]))
{
    $patientRef = $_GET["ref"];
    $invoiceRef = $_GET["invoiceRef"];
    $patient_name = "";
    $appointmentNumber = "";
    $appointmentDate = "";
    $patientNumber = "";
    $tests = "";
    $gender = "";
    $test_amount = "";
    $transactionPayment = "";
    $thirdParty = "";
    $age = "";
    $patient_search = mysqli_query($con,"SELECT * FROM appointments WHERE patient_ref_no='$patientRef' ");
    if($patient_search)
    {
        while($result = mysqli_fetch_assoc($patient_search))
        {
            $patient_name = $result['patient_name'];
            $appointmentNumber = $result['appointment_no'];
            $appointmentDate = substr($result['appointment_date'],0,-8);
            $patientNumber = $result['phone_no'];
            $tests = unserialize($result['test_type']);
            $gender = $result['gender'];
            $age = showAge( $result['dob']);
        }
    }

    $transaction_search = mysqli_query($con,"SELECT * FROM transactions WHERE ref_number='$patientRef' ");
    if($transaction_search)
    {
        while($trans_result = mysqli_fetch_assoc($transaction_search))
        {
            $test_amount = $trans_result['amount'];
            $thirdParty = $trans_result['third_party_payment'];
            $transactionPayment = $trans_result['transaction_payment'];
        }
    }


$pdf = new FPDF('p','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$date = date("F j, Y,");
$pdf->Image('assets/img/stbridget.jpg',10,10,30);
$pdf->Cell(30,10,'',0,1);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(140);
$inv = "INVOICE:".$invoiceRef;
$ransDate = "Transaction Date: ".$appointmentDate;
$appN = "Appointment No:".$appointmentNumber;

$pdf->Cell(30,8,$inv,0,1);
$pdf->Cell(150);
$pdf->Cell(30,10,$date,0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(150);
$pdf->Cell(30,10,'',0,1);
$pdf->Cell(30,5,'',0,1);
$pdf->Cell(30,10,'',0,1);
$pdf->Cell(30,5,'',0,1);
$pdf->Cell(20,5,'Saint Bridget Diagnostic Service',0,1);
$pdf->Cell(20,5,'No 4 Iyobosa Street,Off New Lagos Road,',0,1);
$pdf->Cell(20,5,'Benin City, Edo State.',0,1);
$pdf->Cell(20,5,'Tel No: 09155283008, 08051112578, 07030151491',0,1);
$pdf->Cell(30,10,'',0,1);
$pdf->Cell(20,5,'Test Invoice For:',0,1);
if($thirdParty != "no" && !empty($thirdParty))
{
    $pdf->Cell(20,5,$thirdParty,0,1);
    $pdf->Cell(20,5,'For:',0,1);
    $pdf->Cell(20,5,$patient_name,0,1);
    $pdf->Cell(20,5,$gender,0,1);
    $pdf->Cell(20,5,$patientNumber,0,1);
    $pdf->Cell(20,5,$appN,0,1);
    $pdf->Cell(20,5,'',0,1);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,5,$ransDate,0,1);
    $pdf->Cell(20,5,'',0,1);
}
else
{
    $pdf->Cell(20,5,$patient_name,0,1);
    $pdf->Cell(20,5,$gender,0,1);
    $pdf->Cell(20,5,$patientNumber,0,1);
    $pdf->Cell(20,5,$appN,0,1);
    $pdf->Cell(20,5,'',0,1);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,5,$ransDate,0,1);
    $pdf->Cell(20,5,'',0,1);
}

$counter = 1;

if(is_array($tests) && count($tests) > 1)
{
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(10,5,'#',1,0);
    $pdf->Cell(90,5,'TEST',1,0);
    $pdf->Cell(90,5,'AMOUNT',1,0);
    foreach($tests as $tst)
    { 

        $pdf->Cell(20,5,'',0,1);
        $pdf->Cell(10,5,$counter,1,0);
        $pdf->Cell(90,5,testNameOnly($tst),1,0);
        $pdf->Cell(90,5,prizeOnly($tst),1,0);
        ++$counter;
    }
    $pdf->Cell(20,5,'',0,1);
    $pdf->Cell(70);
    $pdf->Cell(30,5,'TOTAL',1,0);
    $pdf->Cell(90,5,$test_amount,1,0);
}
else
{
    $pdf->Cell(10,5,'#',1,0);
    $pdf->Cell(90,5,'TEST',1,0);
    $pdf->Cell(90,5,'AMOUNT',1,0);

    $pdf->Cell(20,5,'',0,1);

    $pdf->Cell(10,5,$counter,1,0);
    $pdf->Cell(90,5,testNameOnly($tests[0]),1,0);
    $pdf->Cell(90,5,prizeOnly($tests[0]),1,0);
    $pdf->Cell(20,5,'',0,1);
}


$pdf->Ln(20);

$pdf->Output();
}
?>