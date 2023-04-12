<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';
require 'fpdf/fpdf.php';
include 'testDisplay_two.php';

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

$ref = $_GET["ref"];
$appointment = $_GET["appointment"];
$patientName = "";
$age = "";
$gender = "";
$address = "";
$test = "";
$stat = "";
$phone = "";
$allParameters = "";
$allSubParameters = "";
$allTestResults = "";
$scientistRemarks = "";
$testReference = "";
$search_appointments = mysqli_query($con,"SELECT * FROM appointments WHERE patient_ref_no='$ref'");
if(mysqli_num_rows($search_appointments))
{
    while($result = mysqli_fetch_assoc($search_appointments))
    {
        $patientName  = $result['patient_name'];
        $gender = $result['gender'];
        $age = $result['dob']."yrs";
        $phone = $result['phone_no'];
        $test = unserialize($result['test_type']);
    }
}
$searchPatient = mysqli_query($con,"SELECT * FROM patients WHERE patient_ref_number='$ref' ");
if(mysqli_num_rows($searchPatient))
{
    while($patResult = mysqli_fetch_assoc($searchPatient))
    {
        $address = $patResult['address'];
        $state = $patResult['city'].",".$patResult['patient_state'];
    }
}
$scientistRemarks = showTestRemarks($appointment);

$pdf = new FPDF('p','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

	// Logo
    $date = date("F j, Y,");
    $pdf->Image('assets/img/stbridget.jpg',10,10,30);
    $pdf->Cell(30,10,'',0,1);
	// Arial bold 15
	$pdf->SetFont('Arial','B',15);
	// Move to the right
	$pdf->Cell(150);
	// Title
    $pdf->Cell(30,10,'Test Result',0,1);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(150);
    $pdf->Cell(30,10,$date,0,1);
    $pdf->Cell(150);
    $pdf->Cell(30,10,'',0,1);
    $pdf->Cell(30,5,'',0,1);
    $pdf->Cell(20,5,'Saint Bridget\'s Diagnostic Service',0,1);
    $pdf->Cell(20,5,'No 4 Iyobosa Street,Off New Lagos Road,',0,1);
    $pdf->Cell(20,5,'Benin City, Edo State.',0,1);
    $pdf->Cell(20,5,'Tel No: 09155283008, 08051112578, 07030151491',0,1);
    $pdf->Cell(30,10,'',0,1);
    $pdf->Cell(20,5,'Test For:',0,1);
    $pdf->Cell(20,5,$patientName,0,1);
    $pdf->Cell(20,5,$gender,0,1);
    $pdf->Cell(20,5,$age,0,1);
    $pdf->Cell(20,5,$address,0,1);
    $pdf->Cell(20,5,$state,0,1);
    $pdf->Cell(5);
    
    $pdf->Cell(20,5,'',0,1);

    $checkArray = 0;
    $checkParameters = 0;
    if(is_array($test))
    {
        foreach($test as $dd)
        {
            $searchTestResult = mysqli_query($con,"SELECT * FROM test_results WHERE patient_ref_number='$ref' AND appointment_number='$appointment' AND test_type='$dd'");
            $counting = 0;
            if($searchTestResult)
            {
                $pdf->Cell(20,5,'',0,1);

                if(mysqli_num_rows($searchTestResult) >= 1)
                {
                    $allParameters = array(mysqli_num_rows($searchTestResult));
                    $allSubParameters = array(mysqli_num_rows($searchTestResult));
                    $allTestResults = array(mysqli_num_rows($searchTestResult));
                    while($gotten = mysqli_fetch_assoc($searchTestResult))
                    {
                        $testReference = $gotten['test_result_ref'];
                        if ($gotten['test_parameter'] == "none" && $gotten['sub_parameters'] == "none") {
                            $testResult[$counting] = $gotten['test_result'];
                            if($checkArray < 1)
                            {
                                $names = testNameOnly($dd);
                                $pdf->Cell(20,5,'',0,1);
                                $pdf->SetFont('Arial','B',12);
                                $pdf->SetFont('Arial','',10);
                                $pdf->Cell(40);
                                $pdf->Cell(50,5,'Test',1,0);
                                //$pdf->Cell(30,5,'',0,0);
                                $pdf->Cell(50,5,'Result',1,0);
                                //$pdf->Cell(20,5,$testResult[$reCount],0,0);
                                ++$checkArray;
                            }
                            else
                            {}
    
                            $reCount = 0;
                            $pdf->Cell(20,5,'',0,1);
                            $pdf->Cell(40);
                            $pdf->Cell(50,5,$names,1,0);
                            $pdf->Cell(50,5,$testResult[$counting],1,0);

                        } 
                        elseif($gotten['test_parameter'] != "none" && $gotten['sub_parameters'] == "none")
                        {
                            $checkArray = 0;
                            if($checkParameters < 1)
                            {
                                $names = testNameOnly($dd);
                                $pdf->Cell(20,5,'',0,1);
                                $pdf->SetFont('Arial','B',12);
                                //$pdf->Cell(30,15,$names.' Test',0,1,'C');
                                $pdf->SetFont('Arial','',10);
                                $pdf->Cell(40);
                                $pdf->Cell(50,5,'Parameter('.$names.')',1,0);
                                //$pdf->Cell(30,5,'',0,0);
                                $pdf->Cell(50,5,'Result',1,0);

                                ++$checkParameters;
                            }
                            else
                            {}
                            
                            $pdf->Cell(20,5,'',0,1);
                            $pdf->Cell(40);
                            $pdf->Cell(50,5,$gotten['test_parameter'],1,0);
                            $pdf->Cell(50,5,$gotten['test_result'],1,0);

                        }
                        else
                        {}
                        ++$counting;
                    }
                }
            
            }
        }
        
        $pdf->Cell(20,5,'',0,1);
    }


    if(is_array($allSubParameters) && count($allSubParameters) >= 2)
    {
        $number = count($test);
        for($i = 0; $i < $number; $i++)
        {
            $names = testNameOnly($test[$i]);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(30,15,$names.' Test',0,1,'C');
            if(is_array($allParameters) && is_array($allSubParameters) > 1)
            {
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(40,5,'Parameters',0,0);
                foreach($allSubParameters as $subs)
                {
                    $pdf->Cell(40,5,$subs,1,0);
                    //$pdf->Cell(30,5,'',0,0);
                }
                $pdf->Cell(20,5,'',0,1);
                foreach($allParameters as $showParameters)
                {
                    $resultCounter = 0;
                    $pdf->Cell(40,5,$showParameters,1,0);
                    //$pdf->Cell(30,5,'',0,0);
                    $pdf->Cell(40,5,$testResult[$resultCounter],1,0);
                    //$pdf->Cell(30,5,'',0,0);
                    ++$resultCounter;
                    $pdf->Cell(40,5,$testResult[$resultCounter],1,0);
                    $pdf->Cell(20,5,'',0,1);
                    
                }
            }
            else
            {}
            //$pdf->Cell(20,5,$tableHeader,0,1);
            $pdf->Cell(10);
        }
    }
    else
    {}

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,5,'',0,1);
    $pdf->Cell(20,5,'',0,1);
    $pdf->Cell(20,5,'Scientist Remarks',0,1);
    $pdf->Cell(15,5,'',0,1);
    $pdf->Cell(5,5,'',0,0);
    $pdf->MultiCell(0,5,$scientistRemarks);
    $pdf->Ln();
	// Line break
	$pdf->Ln(20);

/*
// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$pdf->SetFont('Arial','I',8);
	// Page number
	$pdf->Cell(0,10,'Page '.$pdf->PageNo().'/{nb}',0,0,'C');
}
*/

//Cell(width, height, text, border, endline, [align](optional))
/*$pdf->Cell(130,5,'',1,0);
$pdf->Cell(59,5,'',1,1);
$pdf->Cell(59,5,'',1,1);*/

$pdf->Output();
?>