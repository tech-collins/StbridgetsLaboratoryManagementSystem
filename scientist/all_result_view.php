<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';
include 'testDisplay_two.php';

$testName = "";
$patientName = "";
$patientGender = "";
$patientAge = "";
$patientAddress = "";
$patientCity = "";
$patientState = "";
$patientPhoneNumber = "";
$testParameters = "";

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
?>

<!DOCTYPE html>
<html lang="en">


<!-- invoice-view24:07-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Medical Laboratory Management Sytem</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <?php
        include 'header.php';
        include 'side-bar.php';
        ?>
        <div class="page-wrapper">
            <div class="content">
                <?php
                if (isset($_GET["ref"])) {
                    $patient_reference = mysqli_real_escape_string($con, $_GET["ref"]);
                    $appointmentNumber = mysqli_real_escape_string($con, $_GET["appointmentNo"]);

                    $search_patientDetails = mysqli_query($con, "SELECT * FROM patients WHERE patient_ref_number='$patient_reference'");
                    if (mysqli_num_rows($search_patientDetails) >= 1) {
                        while ($patientDetailsResult = mysqli_fetch_assoc($search_patientDetails)) {
                            $patientName = $patientDetailsResult['patient_surname'] . " " . $patientDetailsResult['patient_firstname'];
                            $patientGender = $patientDetailsResult['gender'];
                            $patientAge = $patientDetailsResult['age'];
                            $patientAddress = $patientDetailsResult['address'];
                            $patientCity = $patientDetailsResult['city'];
                            $patientState = $patientDetailsResult['patient_state'];
                            $patientPhoneNumber = $patientDetailsResult['phone_number'];
                        }
                    }

                    $search_appointment = mysqli_query($con, "SELECT * FROM appointments WHERE patient_ref_no='$patient_reference' AND appointment_no='$appointmentNumber'");
                    if (mysqli_num_rows($search_appointment) >= 1) {
                        while ($appointmentResult = mysqli_fetch_assoc($search_appointment)) {
                            $testName = unserialize($appointmentResult['test_type']);
                        }
                    }
                    $remarks = showTestRemarks($appointmentNumber);
                ?>
                    <div class="row">
                        <div class="col-sm-5 col-4">
                            <h4 class="page-title">Laboratory Result</h4>
                        </div>
                        <div class="col-sm-7 col-8 text-right m-b-30">
                            <div class="btn-group btn-group-sm">
                                <!-- <a href="edit_test_result.php?ref=<?php //echo $patient_reference; ?>&appointment=<?php //echo $appointmentNumber; ?>" class="btn btn-white">Edit</a>
                                <a href="test_to_pdf.php?ref=<?php //echo $patient_reference; ?>&appointment=<?php //echo $appointmentNumber; ?>" class="btn btn-white">PDF</a>
                                <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row custom-invoice">
                                        <div class="col-6 col-sm-6 m-b-20">
                                            <img src="assets/img/stbridget.jpg" class="inv-logo" alt="">
                                            <ul class="list-unstyled">
                                                <li>Saint Bridget's Diagnostic Service</li>
                                                <li>No 4 Iyobosa Street,Off New Lagos road,</li>
                                                <li>Benin City, Edo State.</li>
                                                <li>Tel No: 09155283008, 08051112578, 07030151491</li>
                                            </ul>
                                        </div>
                                        <div class="col-6 col-sm-6 m-b-20">
                                            <div class="invoice-details">
                                                <h3 class="text-uppercase">Test Result</h3>
                                                <ul class="list-unstyled">
                                                    <li>Date: <span><?php echo date("F j, Y,"); ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 m-b-20">

                                            <h5>Test Result For:</h5>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <h5><strong><?php echo $patientName; ?></strong></h5>
                                                </li>
                                                <li><span><?php echo $patientGender; ?></span></li>
                                                <li><?php echo $patientAge; ?> years</li>
                                                <li><?php echo $patientAddress; ?></li>
                                                <li><?php echo $patientCity . "," . $patientState; ?></li>
                                                <li><?php echo $patientPhoneNumber; ?></li>
                                            </ul>

                                        </div>
                                        <div class="col-sm-6 col-lg-6 m-b-20">
                                            <div class="invoices-view">
                                                <span class="text-muted"></span>
                                                <ul class="list-unstyled invoice-payment-details">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    foreach($testName as $tts)
                                    {
                                        $gottenMessage = testFormCategory($tts);
                                        if($gottenMessage == "Haematology")
                                        {
                                            echo showSingleHaematologyTest($tts,$appointmentNumber);
                                        ?>
                                        <br>
                                        <div class="col-sm-7 col-8 text-right m-b-30">
                                            <div class="btn-group btn-group-sm">
                                                <a href="edit_test_result.php?ref=<?php echo $patient_reference; ?>&appointment=<?php echo $appointmentNumber; ?>$test=<?php echo $tts; ?>" class="btn btn-white">Edit</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <?php
                                        }
                                        elseif($gottenMessage == "Clinical Chemistry")
                                        {
                                            echo showSingleClinicalChemistry($tts,$appointmentNumber);
                                        ?>
                                        <br>
                                        <div class="col-sm-7 col-8 text-right m-b-30">
                                            <div class="btn-group btn-group-sm">
                                                <a href="edit_test_result.php?ref=<?php echo $patient_reference; ?>&appointment=<?php echo $appointmentNumber; ?>$test=<?php echo $tts; ?>" class="btn btn-white">Edit</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <?php
                                        }
                                        elseif($gottenMessage == "MicroBiology/Parasitology")
                                        {
                                            echo showSingleMicroBiology($tts,$appointmentNumber);
                                        ?>
                                        <br>
                                        <div class="col-sm-7 col-8 text-right m-b-30">
                                            <div class="btn-group btn-group-sm">
                                                <a href="edit_test_result.php?ref=<?php echo $patient_reference; ?>&appointment=<?php echo $appointmentNumber; ?>$test=<?php echo $tts; ?>" class="btn btn-white">Edit</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <?php
                                        }
                                        elseif($gottenMessage == "Semen Analysis")
                                        {
                                            echo showSingleSemenAnalysis($tts,$appointmentNumber);
                                        ?>
                                        <br>
                                        <div class="col-sm-7 col-8 text-right m-b-30">
                                            <div class="btn-group btn-group-sm">
                                                <a href="edit_test_result.php?ref=<?php echo $patient_reference; ?>&appointment=<?php echo $appointmentNumber; ?>$test=<?php echo $tts; ?>" class="btn btn-white">Edit</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                        <?php
                                        }
                                        elseif($gottenMessage == "Homonal Assays")
                                        {
                                            echo showHomonalAssays($tts,$appointmentNumber);
                                        ?>
                                        <br>
                                        <div class="col-sm-7 col-8 text-right m-b-30">
                                            <div class="btn-group btn-group-sm">
                                                <a href="edit_test_result.php?ref=<?php echo $patient_reference; ?>&appointment=<?php echo $appointmentNumber; ?>$test=<?php echo $tts; ?>" class="btn btn-white">Edit</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                         <?php
                                        }
                                        elseif($gottenMessage == "laboratory")
                                        {
                                            echo showSingleLaboratory($tts,$appointmentNumber);
                                        ?>
                                        <br>
                                        <div class="col-sm-7 col-8 text-right m-b-30">
                                            <div class="btn-group btn-group-sm">
                                                <a href="edit_test_result.php?ref=<?php echo $patient_reference; ?>&appointment=<?php echo $appointmentNumber; ?>$test=<?php echo $tts; ?>" class="btn btn-white">Edit</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                         <?php
                                        }
                                        elseif($gottenMessage == "other")
                                        {
                                            echo showOther($tts,$appointmentNumber);
                                        ?>
                                        <br>
                                        <div class="col-sm-7 col-8 text-right m-b-30">
                                            <div class="btn-group btn-group-sm">
                                                <a href="edit_test_result.php?ref=<?php echo $patient_reference; ?>&appointment=<?php echo $appointmentNumber; ?>$test=<?php echo $tts; ?>" class="btn btn-white">Edit</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <br>
                                         <?php
                                        }
                                        else
                                        {}
                                    }
                                            //echo displayTestResult($patient_reference,$appointmentNumber);
                                    ?>
                                    <div>
                                        <div class="invoice-info" style="margin-top:30px;">
                                            <h5>Scientist Remark</h5>
                                            <p class="text-muted"> <?php echo $remarks; ?></p>
                                        </div>

                                        <div class="row" class="col-sm-12 offset-sm-0 mx-0" style="margin-left: 0px; margin-top:50px;">
                                            <div>
                                                <div class="invoices-view">
                                                    <ul class="list-unstyled invoice-payment-details">
                                                        <hr style="width:200px; border-bottom:3px solid #095484;">
                                                        <span>
                                                            <h5>Medical Lab. Scientist</h5>
                                                        </span>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    echo "test result not found...something went wrong";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- invoice-view24:07-->

</html>