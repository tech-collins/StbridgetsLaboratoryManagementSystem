<?php
require 'pdf_queries.php';
include 'fabinde.php';
include 'test_dictionary.php';
//require 'fpdf/fpdf.php';
//require('fpdf.php');


$test = "";
$ref = "";
//echo displaySemenPdf($test,$ref);


if(isset($_GET["ref"]))
{
    $patientRef = mysqli_real_escape_string($con,$_GET["ref"]);
    //$testRef = $_GET["test"];
    $appointmentNumber = mysqli_real_escape_string($con,$_GET["appointment"]);
    $testNumber = 0;

    $checkAppointment = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointmentNumber' ");
    if(mysqli_num_rows($checkAppointment) >= 1)
    {
        while($res = mysqli_fetch_assoc($checkAppointment))
        {
            $testRef = unserialize($res['test_type']);
            $testNumber = count($testRef);
        }
    }

    //$pdf = new FPDF('p','mm','A4');
    //$pdf->AddPage();
    $pdd = new PDFS();

    foreach($testRef as $tests)
    {
       $testCategory = testFormCategory($tests);
       if($testCategory == "Haematology")
       {
            $testNumber = $testNumber - 1;
            //echo $testNumber;
            $pdd->displayHaematologyPdf($tests,$appointmentNumber);

            if($testNumber != 0)
            {
                //$pdd->AddPage();
            }

       }
       elseif($testCategory == "Clinical Chemistry")
       {
            $testNumber = $testNumber - 1;
            $pdd->displayChemistryPdf($tests,$appointmentNumber);

            if($testNumber != 0)
            {
                //$pdd->AddPage();
            }
       }
       elseif($testCategory == "MicroBiology/Parasitology")
       {
            $testNumber = $testNumber - 1;
            $pdd->displayMicrobiologyPdf($tests,$appointmentNumber);

            if($testNumber != 0)
            {
                //$pdd->AddPage();
            }
       }
       elseif($testCategory == "Semen Analysis")
       {
            $testNumber = $testNumber - 1;
            $pdd->displaySemenPdf($tests,$appointmentNumber);

            if($testNumber != 0)
            {
                //$pdd->AddPage();
            }
       }
       elseif($testCategory == "laboratory")
       {
            $testNumber = $testNumber - 1;
            $pdd->displayLaboratoryPdf($tests,$appointmentNumber);

            if($testNumber != 0)
            {
                //$pdd->AddPage();
            }
       }
       else
       {}
    }
    $pdd->Output();
}
?>