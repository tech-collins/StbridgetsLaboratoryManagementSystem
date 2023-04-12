<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'testDisplay.php';

$insert_status = "";

if (isset($_GET["testID"]))
{
    $testResult = mysqli_real_escape_string($con, $_POST["testResult"]);
    $patientReference = mysqli_real_escape_string($con, $_POST["pateientRef"]);
    $testId = mysqli_real_escape_string($con, $_POST["testID"]);
    $date = date("m-d-Y h:i:sa");
    $day = date("d-m-Y");
    $update_status = "updated";
    $update_query = mysqli_query($con, "UPDATE test_results SET test_result='" . $testResult . "',test_status='".$update_status."', result_date='" . $day . "' WHERE id='" . $testId . "'");

    if ($insert_query) {
        $insert_status = "<h5 style='color: green;'>test result inserted successfully</h5>";
        header("location:record_result?status=$insert_status&ref=$patientReference");
    } else {
        $insert_status = "<h5 style='color: red;'>patient not registered successfully...something went wrong</h5>";
    }
}

if (isset($_GET["status"])) {
    $insert_status = $_GET["status"];
}
if (isset($_GET["ref"])) {
    $ref = $_GET["ref"];
    $test_result = "no result";
    $testTypes = "";
    $patientName = "";
    $patient_appNumber;
    $select = mysqli_query($con, "SELECT * FROM appointments WHERE patient_ref_no='$ref'"); {
        if ($select) {
            while ($rr = mysqli_fetch_assoc($select)) {
                $testTypes = unserialize($rr['test_type']);
                $patientName = $rr['patient_name'];
                $patient_appNumber = $rr['appointment_no'];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- patients23:17-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Laboratory Management System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
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
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Capture Test Result</h4>
                        <div style="align-content: center;" id="specificStatus"><?php echo $insert_status; ?></div>
                    </div>
                    <div class="col-lg-8 offset-lg-0">
                        <h2 class="mt-5"><?php echo $patientName; ?></h2>
                        <h5>Appointment No: <?php echo $patient_appNumber; ?></h5>
                        <h3 id="status"></h3>
                    </div>
                    <div class="col-lg-8 offset-lg-2">
                        <div class="row">
                            <?php
                            $parameremterCounter = 0;
                            if(is_array($testTypes) && count($testTypes) > 1)
                            {
                                foreach ($testTypes as $dr) {
                                    echo displayTestDetails($ref, $dr,$parameremterCounter) . "<hr><br>";
                                    ++$parameremterCounter;
                                }
                            }
                            else
                            {
                                $dr = $testTypes[0];
                                echo displayTestDetails($ref, $dr,$parameremterCounter) . "<hr><br>";
                            }
                              echo scientistRemarks($ref,$patient_appNumber);
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script>
        var saveRemarkBtn = document.getElementById('saveRemark');

        saveRemarkBtn.onclick = function(){
            var remarks = document.getElementById('testRemarks').value;
            var patientRef = document.getElementById('patientRef').value;
            var testRef = document.getElementById('testRef').value;
            var appointmentRef = document.getElementById('appointmentRef').value;
            $.ajax({
                type: 'POST',
                url: 'test-queries.php',
                data: {
                    scientist_remarks: remarks,
                    patient_ref: patientRef,
                    test_ref: testRef,
                    appointment_ref: appointmentRef
                },
                success: function(data) {
                    $('#specificStatus').html(data);
                    alert(data);
                }
            });
            location.reload();
        }
    </script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- patients23:19-->

</html>