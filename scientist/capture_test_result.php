<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';

$insert_status = "";
$patientRef = "";
$testId = "";
$testName = "";
$parameter = "";
$subParameter = "";

if (isset($_POST["testResult"])) {
    $testResult = mysqli_real_escape_string($con, $_POST["testResult"]);
    $patientReference = mysqli_real_escape_string($con, $_POST["pateientRef"]);
    $testId = mysqli_real_escape_string($con, $_POST["testID"]);
    $date = date("d-m-Y h:i:sa");
    $day = date("d-m-Y");
    $update_status = "updated";
    $update_query = mysqli_query($con, "UPDATE test_results SET test_result='".$testResult."', result_date='".$day."', result_status='".$update_status."' WHERE id='".$testId."' ");

    if ($update_query) {
        /*$testFinished = "finish";
        $updateAppointment = mysqli_query($con,"UPDATE appointments  SET appointment_status='".$testFinished."' WHERE patient_ref_no='".$patientReference."' ");*/
        $insert_status = "test result inserted successfully";
        header("location:record_result.php?status=$insert_status&ref=$patientReference");
    } else {
        $insert_status = "<h5 style='color: red;'>patient result not registered successfully...something went wrong</h5>";
    }
}
if(isset($_POST["testParameterResult"]))
{
    $testResult = mysqli_real_escape_string($con, $_POST["testParameterResult"]);
    $patientReference = mysqli_real_escape_string($con, $_POST["pateientRef"]);
    $testId = mysqli_real_escape_string($con, $_POST["testID"]);
    $receivedParameters = mysqli_real_escape_string($con,$_POST["para"]);
    $date = date("d-m-Y h:i:sa");
    $day = date("d-m-Y");
    $update_status = "updated";
    $update_query = mysqli_query($con, "UPDATE test_results SET test_result='".$testResult."', result_date='".$day."', result_status='".$update_status."' WHERE id='".$testId."' AND test_parameter='".$receivedParameters."' ");

    if ($update_query) {
        /*$testFinished = "finish";
        $updateAppointment = mysqli_query($con,"UPDATE appointments  SET appointment_status='".$testFinished."' WHERE patient_ref_no='".$patientReference."' ");*/
        $insert_status = "test result inserted successfully";
        header("location:record_result.php?status=$insert_status&ref=$patientReference");
    } else {
        $insert_status = "<h5 style='color: red;'>patient result not registered successfully...something went wrong</h5>";
    }
}
if(isset($_POST["testSubParameterResult"]))
{
    $testResult = mysqli_real_escape_string($con, $_POST["testSubParameterResult"]);
    $patientReference = mysqli_real_escape_string($con, $_POST["pateientRef"]);
    $testId = mysqli_real_escape_string($con, $_POST["testID"]);
    $receivedSubParameters = mysqli_real_escape_string($con,$_POST["sub"]);
    $date = date("d-m-Y h:i:sa");
    $day = date("d-m-Y");
    $update_status = "updated";
    $update_query = mysqli_query($con, "UPDATE test_results SET test_result='".$testResult."', result_date='".$day."', result_status='".$update_status."' WHERE id='".$testId."' AND sub_parameters='".$receivedSubParameters."' ");

    if ($update_query) {
        /*$testFinished = "finish";
        $updateAppointment = mysqli_query($con,"UPDATE appointments  SET appointment_status='".$testFinished."' WHERE patient_ref_no='".$patientReference."' ");*/
        $insert_status = "test result inserted successfully";
        header("location:record_result.php?status=$insert_status&ref=$patientReference");
    } else {
        $insert_status = "<h5 style='color: red;'>patient result not registered successfully...something went wrong</h5>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">


<!-- add-patient24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Laboratory Management System</title>
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
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Capture Result</h4>
                    </div>
                    <div style="align-content: center;"><?php echo $insert_status; ?></div>
                </div>
                <div class="row">
                    <?php
                    if (isset($_GET["testId"])) {
                        $patientRef = mysqli_real_escape_string($con, $_GET["patientRef"]);
                        $testId = mysqli_real_escape_string($con, $_GET["testId"]);
                        

                    } 
                    else 
                    {
                            echo "test name could not be found";
                    }
                    $search_testName = mysqli_query($con, "SELECT * FROM test_results WHERE patient_ref_number='$patientRef' AND id='$testId' ");
                    if (mysqli_num_rows($search_testName) >= 1) {
                        while ($res = mysqli_fetch_assoc($search_testName)) {
                            $testName = $res['test_type'];
                            $parameter = $res['test_parameter'];
                            $subParameter = $res['sub_parameters'];
                        }
                    } else {
                        echo "test not found".$patientRef."<br>".$testId;
                    }

                        if (empty($subParameter) || $subParameter == "none" && $parameter != "none") {
                    ?>
                            <div class="col-lg-8 offset-lg-2">
                                <h4><?php echo testName($testName); ?></h4>
                                <form method="post" action="capture_test_result.php">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $parameter; ?><span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="testParameterResult" required>
                                            </div>
                                        </div>
                                        <input class="form-control" type="hidden" name="pateientRef" value="<?php echo $patientRef; ?>">
                                        <input class="form-control" type="hidden" name="testID" value="<?php echo $testId; ?>">
                                        <input class="form-control" type="hidden" name="para" value="<?php echo $parameter; ?>">
                                        <div class="m-t-20 text-center">
                                            <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                </div>
        <?php 
                    }
                    elseif(empty($parameter) || $parameter == "none")
                    {
                    ?>
                    <div class="col-lg-8 offset-lg-2">
                                <h4><?php echo testName($testName); ?></h4>
                                <form method="post" action="capture_test_result.php">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo testNameOnly($testName); ?><span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="testResult" required>
                                            </div>
                                        </div>
                                        <input class="form-control" type="hidden" name="pateientRef" value="<?php echo $patientRef; ?>">
                                        <input class="form-control" type="hidden" name="testID" value="<?php echo $testId; ?>">
                                        <div class="m-t-20 text-center">
                                            <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class="col-lg-8 offset-lg-2">
                                <h4><?php echo testName($testName); ?></h4>
                                <form method="post" action="capture_test_result.php">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label><?php echo $subParameter; ?><span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="testSubParameterResult" required>
                                            </div>
                                        </div>
                                        <input class="form-control" type="hidden" name="pateientRef" value="<?php echo $patientRef; ?>">
                                        <input class="form-control" type="hidden" name="testID" value="<?php echo $testId; ?>">
                                        <input class="form-control" type="hidden" name="sub" value="<?php echo $subParameter; ?>">
                                        <div class="m-t-20 text-center">
                                            <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    <?php
                    }
        ?>
            </div>
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