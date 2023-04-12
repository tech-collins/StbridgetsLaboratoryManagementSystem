<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'appointment_queries.php';
include 'transaction_queries.php';

$insert_status = "";

if (isset($_POST["submit"]) && $_POST["newSchedule"] == "no") 
{
    $companyName = mysqli_real_escape_string($con, $_POST["companyName"]);
    $patientReference = "";
    $tests = $_SESSION["patient_test"];
    $testAmount = mysqli_real_escape_string($con, $_POST["testAmount"]);
    $date = date("m-d-Y h:i:sa");
    $day = date("d-m-Y");
    $patient_name = "";
    $update_status = "updated";
    $payments = "no";
    $test_category = "";
    $test_cat = testCategory($test_category);
    $a = substr($day, 7);
    $firstname = $_SESSION["firstname"];
    $surname = $_SESSION["surname"];
    $dob = $_SESSION["dob"];
    $gender = $_SESSION["gender"];
    $address = $_SESSION["address"];
    $state = $_SESSION["state"];
    $city = $_SESSION["city"];
    $phone = $_SESSION["phone"];
    $hospital = $_SESSION["hospitalClinic"];
    $doctor = $_SESSION["doctorClinician"];
    $tst = $_SESSION['tst'];
    $test_number = count($tst);
    $test = array($test_number);
    for ($i = 0; $i < $test_number; $i++) {
        $test[$i] = $tst[$i];
    }
    $payment_status = "no";
     $implode_test = serialize($test);
    
    $ref_check = mysqli_query($con, "SELECT * FROM patients");
    if (mysqli_num_rows($ref_check) == false || mysqli_num_rows($ref_check) == 0) {
        $a = substr($day, 7);
        $patientReference = "LABPT-" . $a . "0";
    } else {
        $a = substr($day, 7);
        $row_num = mysqli_num_rows($ref_check);
        $patientReference = "LABPT-" . $a . $row_num;
    }
    $query = "INSERT INTO patients(patient_surname,patient_firstname,gender,age,phone_number,address,city,patient_state,patient_ref_number,date_registered,test,number_of_test,patient_passport,payment_status) VALUES('$surname','$firstname','$gender','$dob','$phone','$address','$city','$state','$patientReference','$date','$test_cat','$implode_test','$patient_passport','$payment_status')";
    $insert_query = mysqli_query($con, $query);

    $returnStatement = patientAppointment($patientReference,$tests,$payments,$hospital,$doctor);
    if($returnStatement = "Patient Queued Successfully")
    {
        $paymentStatus = "no";
        insertTransaction($patientReference,$testAmount,$paymentStatus,$companyName);
        $returnAppNumber = findAppNumber($patientReference);
        letsPrintReceipt($returnAppNumber);

        $insert_status = "<h5 style='color: green;'>patient registered successfully</h5>";
        header("location:patients.php?status=$insert_status&appNumber=$returnAppNumber");
    }
    else
    {
        $insert_status = $testId."<h5 style='color: red;'>patient not registered successfully...something went wrong</h5>";
        header("location:patients.php?status=$insert_status");
    }
    /*$patient_query = mysqli_query($con, "SELECT * FROM patients WHERE patient_ref_number='$patientReference' ");

    if (mysqli_num_rows($patient_query) >= 1) {
        $insert_status = "<h5 style='color: green;'>test result inserted successfully</h5>";
        header("location:record_result?status=$insert_status&ref=$patientReference");
    } else {
        $insert_status = $testId."<h5 style='color: red;'>patient not registered successfully...something went wrong</h5>";
    }*/
}

if(isset($_POST["submit"]) && $_POST["newSchedule"] == "yes")
{
    $companyName = mysqli_real_escape_string($con, $_POST["companyName"]);
    $patientReference = "";
    $tests = $_SESSION["patient_test"];
    $testAmount = mysqli_real_escape_string($con, $_POST["testAmount"]);
    $date = date("m-d-Y h:i:sa");
    $day = date("d-m-Y");
    $patient_name = "";
    $update_status = "updated";
    $payments = "no";
    $test_category = "";
    $test_cat = testCategory($test_category);
    $a = substr($day, 7);
    $patRefNew = $_POST["patRefNew"];
    $tst = $_SESSION['tst'];
    $payment_status = "no";

    $returnStatement = anotherAppointment($patRefNew,$tests,$payments,$hospital,$doctor);
    if($returnStatement = "Patient Queued Successfully")
    {
        $paymentStatus = "no";
        insertTransaction($patRefNew,$testAmount,$paymentStatus,$companyName);
        $returnAppNumber = findAppNumber($patRefNew);
        letsPrintReceipt($returnAppNumber);

        $insert_status = "<h5 style='color: green;'>appointment registered successfully</h5>";
        header("location:appointments.php?status=$insert_status&appNumber=$returnAppNumber");
    }
    else
    {
        $insert_status = $testId."<h5 style='color: red;'>appointment not registered successfully...something went wrong</h5>";
        header("location:appointments.php?status=$insert_status");
    }
}

function letsPrintReceipt($testAppointmentNumbers)
{
    /*echo "<a href='https://www.google.com/' target='_blank'>Google</a>
    ";*/
?>
<script type="text/javascript">
<?php 
    echo "var refs = '$testAppointmentNumbers';"
?>
       window.open('receipt_printer.php?ref=refs', '_blank');
    </script>
<?php
}

function findAppNumber($refn)
{
    include 'fabinde.php';
    $foundApp = "";

    $appN = mysqli_query($con,"SELECT appointment_no FROM appointments WHERE patient_ref_no='$refn'");
    if($appN)
    {
        while($ffs = mysqli_fetch_assoc($appN))
        {
            $foundApp = $ffs['appointment_no'];
        }
    }

    return $foundApp;
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
                        <h4 class="page-title">Third Party Payment</h4>
                    </div>
                    <div style="align-content: center;"><?php echo $insert_status; ?></div>
                </div>
                <div class="row">
                    <?php
                    if (isset($_GET["company"])) {
                        //$patientRef = mysqli_real_escape_string($con, $_GET["patientRef"]);
                        $testName;
                        $parameter;
                        $subParameter;
                        $testsNamesNumber;
                        $patientRefs =  $_SESSION["patient_reference"];
                        $new = "";
                        if($_GET["newSchedule"])
                        {
                            $new = $_GET["newSchedule"];
                        }
                        else
                        {
                            $new = "no";
                        }
                        if(isset($_SESSION["patient_test"]))
                        {
                            $testsNamesNumber = count($_SESSION["patient_test"]);
                        }
                    ?>
                            <div class="col-lg-8 offset-lg-2">
                                <h4>Total Amount = N<?php echo $_SESSION["testAmount"]; ?> </h4>
                                <form method="post" action="company_patient_name.php">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>enter company name<span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="companyName" required>
                                            </div>
                                        </div>
                                        <input class="form-control" type="hidden" name="patientRef" value="<?php echo $_SESSION["patient_reference"]; ?>">
                                        <input class="form-control" type="hidden" name="testAmount" value="<?php echo $_SESSION["testAmount"]; ?>">
                                        <input class="form-control" type="hidden" name="newSchedule" value="<?php echo $new; ?>">
                                        <input class="form-control" type="hidden" name="patRefNew" value="<?php echo $patientRefs; ?>">
                                        <div class="m-t-20 text-center">
                                            <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                </div>
        <?php
                    }
                    else
                    {}
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