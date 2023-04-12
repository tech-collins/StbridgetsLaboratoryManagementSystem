<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'appointment_queries.php';
include 'transaction_queries.php';
include '../print/example/interface/print_receipt.php';

$insert_status = "";

if (isset($_GET["payment"])) {
    $payment_status = substr($_GET["payment"], 1, -1);
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
    //$test_category = $_SESSION["test_category"];
    $test_category = "";
    $test_cat = testCategory($test_category);
    $date = date("m-d-Y h:i:sa");
    $day = date("d-m-Y");
    $pateint_ref = "";
    $patient_passport = "none";
    $thirdParty = "";
    $tst = $_SESSION['tst'];
    $test_number = count($tst);
    $test = array($test_number);
    for ($i = 0; $i < $test_number; $i++) {
        $test[$i] = $tst[$i];
    }

    $implode_test = serialize($test);

    $thirdParty = "no";

    $a = substr($day, 7);
    $ref_check = mysqli_query($con, "SELECT * FROM patients");
    if (mysqli_num_rows($ref_check) == false || mysqli_num_rows($ref_check) == 0) {
        $a = substr($day, 7);
        $pateint_ref = "LABPT-" . $a . "0";
    } else {
        $a = substr($day, 7);
        $row_num = mysqli_num_rows($ref_check);
        $pateint_ref = "LABPT-" . $a . $row_num;
    }
    $query = "INSERT INTO patients(patient_surname,patient_firstname,gender,age,phone_number,address,city,patient_state,patient_ref_number,date_registered,test,number_of_test,patient_passport,payment_status) VALUES('$surname','$firstname','$gender','$dob','$phone','$address','$city','$state','$pateint_ref','$date','$test_cat','$implode_test','$patient_passport','$payment_status')";
    $insert_query = mysqli_query($con, $query);

    if ($insert_query) {
        $returnStatement = patientAppointment($pateint_ref, $test, $payment_status, $hospital, $doctor);
        if ($returnStatement == "Patient Queued Successfully") {
            insertTransaction($pateint_ref, $_SESSION["testAmount"], $payment_status, $thirdParty);
            $patientAppNumber = findAppNumber($pateint_ref);

            letsPrintReceipt($patientAppNumber);

            $insert_status = "<h5 style='color: green;'>patient registered successfully</h5>";
            header("location:patients.php?status=$insert_status&appNumber=$patientAppNumber");
        } else {
            $insert_status =  $returnStatement . "<h5 style='color: red;'>patient not registered successfully...something went wrong</h5>";
        }
    } else {
        $insert_status =  $payment_status . "<h5 style='color: red;'>patient not registered successfully...something went wrong oh</h5>";
    }
}

if (isset($_GET["newSchedule"]) && isset($_GET["patientRef"])) {
    $payment_status = $_GET["payments"];
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
    //$test_category = $_SESSION["test_category"];
    $test_category = "";
    $test_cat = testCategory($test_category);
    $date = date("m-d-Y h:i:sa");
    $day = date("d-m-Y");
    $pateint_ref = $_GET["patientRef"];
    $patient_passport = "none";
    $thirdParty = "";
    $tst = $_SESSION['tst'];
    $test_number = count($tst);
    $test = array($test_number);
    for ($i = 0; $i < $test_number; $i++) {
        $test[$i] = $tst[$i];
    }

    $thirdParty = "no";

    $returnStatement = anotherAppointment($pateint_ref, $test, $payment_status, $hospital, $doctor);
    if ($returnStatement == "Patient Queued Successfully") {
        insertTransaction($pateint_ref, $_SESSION["testAmount"], $payment_status, $thirdParty);
        $patientAppNumber = findAppNumber($pateint_ref);

        letsPrintReceipt($patientAppNumber);

        $insert_status = "<h5 style='color: green;'>New Appointment registered successfully</h5>";
        header("location:patients.php?status=$insert_status&appNumber=$patientAppNumber");
    } else {
        $insert_status =  $returnStatement . "<h5 style='color: red;'>New Appointment NOT registered successfully...something went wrong</h5>";
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
        window.open('receipt_printer.php?ref=' + refs, '_blank');
    </script>
<?php
}

function testPrize($refs)
{
    include 'fabinde.php';

    $test_prize = "";

    $test_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$refs'");
    if ($test_query) {
        while ($result = mysqli_fetch_assoc($test_query)) {
            $test_prize = "<td>" . $result['test_type'] . "</td><td>" . $result['test_amount'] . "</td>";
        }
    }

    return $test_prize;
}

function prizeOnly($reference)
{
    include 'fabinde.php';

    $amount = 0;
    $test_query = mysqli_query($con, "SELECT test_amount FROM test_categories WHERE test_ref='$reference'");
    while ($results = mysqli_fetch_assoc($test_query)) {
        $amount = intval($results['test_amount']);
    }

    return $amount;
}
function checkDatabase($reference, $tests)
{
    include 'fabinde.php';
    $checking;
    $pat_ref = "";
    $check_base = mysqli_query($con, "SELECT * FROM patients WHERE phone_number='$reference'");
    if (mysqli_num_rows($check_base) >= 1) {
        while ($collectRef = mysqli_fetch_assoc($check_base)) {
            $pat_ref = $collectRef['patient_ref_number'];
        }

        $checking = $pat_ref;
        //header("location:schedule_new_test.php?ref=$pat_ref");\
        echo "<script>window.location = 'schedule_new_test.php?ref=" . $pat_ref . "&tests=" . $tests . "'</script>";
    } else {
        $checking = "not seen";
    }
    return $checking;
}
function findAppNumber($refn)
{
    include 'fabinde.php';
    $foundApp = "";

    $appN = mysqli_query($con, "SELECT appointment_no FROM appointments WHERE patient_ref_no='$refn'");
    if ($appN) {
        while ($ffs = mysqli_fetch_assoc($appN)) {
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
                <?php
                if (isset($_POST["lastName"])) {

                    //$_SESSION["test_category"]  = mysqli_real_escape_string($con, $_POST["testCategory"]);
                    //$_SESSION["test_cat"]  = testCategory($test_category);
                    $test_number = count($_POST['testName']);
                    $tst = $_POST['testName'];
                    $_SESSION["tst"] = $_POST['testName'];
                    $_SESSION["patient_test"] = $tst;
                    $totalAmount = 0;

                    $ph = mysqli_real_escape_string($con, $_POST["phone"]);

                    $dd = checkDatabase($ph, $tst);

                    $_SESSION["firstname"] = mysqli_real_escape_string($con, $_POST["firstname"]);
                    $_SESSION["surname"] = mysqli_real_escape_string($con, $_POST["lastName"]);
                    $_SESSION["dob"] = mysqli_real_escape_string($con, $_POST["dob"]);
                    $_SESSION["gender"]  = mysqli_real_escape_string($con, $_POST["gender"]);
                    $_SESSION["address"]  = mysqli_real_escape_string($con, $_POST["address"]);
                    $_SESSION["state"]  = mysqli_real_escape_string($con, $_POST["state"]);
                    $_SESSION["city"]  = mysqli_real_escape_string($con, $_POST["city"]);
                    $_SESSION["phone"]  = mysqli_real_escape_string($con, $_POST["phone"]);
                    $_SESSION["hospitalClinic"] = mysqli_real_escape_string($con, $_POST["hospitalClinic"]);
                    $_SESSION["doctorClinician"] = mysqli_real_escape_string($con, $_POST["doctorClinician"]);
                ?>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-0">
                            <h4 class="page-title" style="margin-left: 0px;">Test Amount</h4>
                            <hr>
                        </div>
                        <div style="align-content: center;"><?php echo $insert_status; ?></div>
                        <div class="col-md-12">
                            <h4 class="page-title">Cost Summary</h4>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table datatable mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>test</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cc = 1;
                                        for ($i = 0; $i < $test_number; $i++) {
                                        ?>
                                            <tr>
                                                <td><?php echo $cc; ?></td><?php
                                                                            $getPrize = testPrize($tst[$i]);
                                                                            echo $getPrize;
                                                                            ++$cc;
                                                                            ?>
                                            </tr>
                                        <?php
                                            $totalAmount = $totalAmount + prizeOnly($tst[$i]);
                                        }
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td>TOTAL</td>
                                            <td>N<?php echo $totalAmount; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php $_SESSION["testAmount"] = $totalAmount; ?>
                            </div>
                        </div>
                        <div class="m-t-20 text-center" style="margin-left: 5%;">
                            <a href="add_patient_two.php?payment='no'" class="btn btn-primary submit-btn"> not paid </a>
                            <a href="add_patient_two.php?payment='yes'" class="btn btn-primary submit-btn" style="background-color: rgba(12, 184, 182, 0.91);"> paid </a>
                            <a href="company_patient_name.php?company=company" class="btn btn-warning submit-btn"> company </a>
                        </div>
                        <!--
                        <div class="m-t-20 text-center">
                            <a href="#" class="btn btn-primary submit-btn" style="background-color: rgba(12, 184, 182, 0.91);"> paid </a>
                        </div>-->
                    <?php
                    $_SESSION["totalAmount"] = $totalAmount;
                } else {
                    if (!empty($insert_status)) {
                        echo $insert_status;
                    } else {
                        echo "something went wrong";
                    }
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
    <script src="myscript.js"></script>
</body>


<!-- add-patient24:07-->

</html>