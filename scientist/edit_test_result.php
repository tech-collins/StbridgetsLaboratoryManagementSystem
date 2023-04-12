<?php
session_start();
//include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';
include 'edit_test_result_display.php';

$insert_status = "";
if(isset($_GET["message"]))
{
    $insert_status = $_GET["message"];
}

?>

<!DOCTYPE html>
<html lang="en">


<!-- add-patient24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget Laboratory Management System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]--> 
</head>

<body>
    <div class="main-wrapper" style="background-color: rgb(240, 234, 214);">
        <?php
        include 'header.php';
        include 'side-bar.php';
        ?>
        <div class="page-wrapper">
            <div class="content" style=" box-shadow: 0 1px 2px rgba(0,0,0,0.07), 
                0 2px 4px rgba(0,0,0,0.07), 
                0 4px 8px rgba(0,0,0,0.07), 
                0 8px 16px rgba(0,0,0,0.07),
                0 16px 32px rgba(0,0,0,0.07), 
                0 32px 64px rgba(0,0,0,0.07);">

                <?php
                if (isset($_GET["ref"]))
                {
                    $pat_ref = $_GET["ref"];
                    $appnum = $_GET["appNumber"];
                    $tests = $_GET["test"];
                    $patientNames = "";
                    $findP = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_no='$appnum'");
                    if (mysqli_num_rows($findP)) {
                        while ($findResult = mysqli_fetch_assoc($findP)) {
                            $patientNames = $findResult['patient_name'];
                        }
                    }
                    $appnum = "APT-04-22-2022-0";
                    $patientNames = "Eze Onyema Collins";
                    $tests = "Homonal Assays";
                    $pat_ref = "LAB"
                ?>
                              
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <h4 class="page-title">Edit Test Results For</h4>
                            <div style="align-content: center;"><h4><?php echo $patientNames . "<br>Appointment No: " . $appnum; ?></h4></div>
                            <div style="align-content: center;"><?php echo $insert_status; ?></div>
                            <div style="align-content: center;"><h4>Test Name: <?php echo testNameOnly($tests); ?></h4></div>
                            <hr>
                        </div>
                    <?php
                    $returnedMessage = testFormCategory($tests);
                    
                    //$returnedMessage = "Homonal Assays";
                    if ($returnedMessage == "Haematology") {
                    ?>

                        <div class="col-lg-8 offset-lg-2" style="align-content: center;">
                            <h3>Haematology Result</h3>
                    </div>
                    <?php
                        echo displayEditHeamatology($tests, $appnum,$patientNames,$pat_ref);
                    ?>
                    <?php
                    } elseif ($returnedMessage == "Clinical Chemistry") {
                    ?>

                        <div class="col-lg-8 offset-lg-2" style="align-content: center;">
                            <h3>Clinical Chemistry Result</h3>
                        </div>
                    <?php
                        echo displayEditChemistry($tests, $appnum,$patientNames,$pat_ref);
                    }
                    elseif ($returnedMessage == "Homonal Assays") {
                    ?>

                        <div class="col-lg-8 offset-lg-2" style="align-content: center;">
                            <h3>Homonal Assays Result</h3>
                        </div>
                    <?php
                        echo displayEditHomonalAssays($tests, $appnum,$patientNames,$pat_ref);
                    }
                    elseif ($returnedMessage == "MicroBiology/Parasitology") {
                    ?>

                        <div class="col-lg-8 offset-lg-2" style="align-content: center;">
                            <h3>MicroBiology/Parasitology Result</h3>
                        </div>
                    <?php
                        echo displayEditMicroBiology($tests, $appnum,$patientNames,$pat_ref);
                    ?>
                    </div>
                    <?php
                    } elseif ($returnedMessage == "Semen Analysis") {
                    ?>

                        <div class="col-lg-8 offset-lg-2" style="align-content: center;">
                            <h3>Semen Analysis Result</h3>
                        </div>
                    <?php
                        echo displayEditSemenAnalysis($tests, $appnum,$patientNames,$pat_ref);
                    } elseif($returnedMessage == "laboratory") {
                    ?>

                        <div class="col-lg-8 offset-lg-2" style="align-content: center;">
                            <h3>Clinical Laboratory Report</h3>
                    <?php
                        echo displayEditLaboratories($tests, $appnum,$patientNames,$pat_ref);
                    ?>
                    </div>
                    <?php
                    }
                    elseif($returnedMessage == "other") {
                        ?>
    
                            <div class="col-lg-8 offset-lg-2" style="align-content: center;">
                                <h3>Clinical Laboratory Report</h3>
                        <?php
                            echo displayEditOther($tests, $appnum,$patientNames,$pat_ref); 
                        ?>
                        </div>
                        <?php
                        }
                    else
                    {
                        
                        echo $tests."-"."no appointments<br>".$returnedMessage;
                    }
                    ?>
                <?php
                } else {
                    echo "test appointment not found";
                }
                ?>
            </div>
        </div>
    </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- add-patient24:07-->

</html>