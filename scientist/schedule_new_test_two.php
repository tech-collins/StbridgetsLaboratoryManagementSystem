<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';

$insert_status = "";

if (isset($_GET["payment"])) {
    $payment_status = substr($_GET["payment"],1,-1);
    $patient_name = "";
    $test_number = "";
    $dob = "";
    $gender = "";
    $patient_number = "";
    $appointmentNumber = "";
    $date = date("m-d-Y h:i:s");
    $day = date("m-d-Y");
    $patient_refs = $_SESSION["ref"];
    $test_category = $_SESSION["test_category"];
    $date = date("m-d-Y h:i:sa");
    $day = date("d-m-Y");
    $tst = $_SESSION['tst'];
    $test_number = count($tst);
    $test = array($test_number);
    for ($i = 0; $i < $test_number; $i++) {
        $test[$i] = $tst[$i];
    }

     $implode_test = serialize($test);
 

    $check = mysqli_query($con, "SELECT * FROM patients WHERE patient_ref_number='$patient_refs'");
    if ($check) {
        $p_ref = "";
        while ($seen = mysqli_fetch_assoc($check)) {
                $patient_name = $seen['patient_surname'] . " " . $seen['patient_firstname'];
                $dob = $seen['age'];
                $gender = $seen['gender'];
                $patient_number = $seen['phone_number'];
        }
    }
    else 
    {
        echo "patient not found";
    }
    $check_appointment = mysqli_query($con,"SELECT * FROM appointments");
    if (mysqli_num_rows($check_appointment) == false || mysqli_num_rows($check_appointment) == 0) {
        $appointmentNumber = "APT-" . $day . "-0";
    } else {
        $row_num = mysqli_num_rows($check_appointment);
        $appointmentNumber = "APT-" . $day . "-" . $row_num;
    }

    $appointment_list = mysqli_query($con,"INSERT INTO appointments(test_category,test_type,patient_name,dob,gender,phone,appointment_no,patient_ref_no,appointment_date,appointment_status,payment) VALUES('$test_category','$implode_test','$patient_name','$dob','$gender','$patient_number','$appointmentNumber','$patient_refs','$date','$appointment_status','$payment_status')");

    if($appointment_list)
    {
        $insert_status = "Appointment Scheduled Successfull...";
        header("location:appointments.php?status=$insert_status");
    }
    else
    {
        $insert_status = "appointment NOT Successfull..something went wrong";
    }
}

function testPrize($refs)
{
    include 'fabinde.php';

    $test_prize = "";

    $test_query = mysqli_query($con,"SELECT * FROM test_categories WHERE test_ref='$refs'");
    if($test_query)
    {
        while($result = mysqli_fetch_assoc($test_query))
        {
            $test_prize = "<td>".$result['test_type']."</td><td>".$result['test_amount']."</td>";
        }
    }

    return $test_prize;
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
                if (isset($_POST["testCategory"])) {
                    $_SESSION["ref"] = mysqli_real_escape_string($con, $_POST["ref"]);
                    $_SESSION["test_category"]  = mysqli_real_escape_string($con, $_POST["testCategory"]);
                    //$_SESSION["test_cat"]  = testCategory($test_category);
                    $test_number = count($_POST['testName']);
                    $tst = $_POST['testName'];
                    $_SESSION["tst"] = $_POST['testName'];
                    $totalAmount = 0;
                    
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
                                            <tr><td><?php echo $cc; ?></td><?php 
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
                            </div>
                        </div>
                        <div class="m-t-20 text-center" style="margin-left: 5%;">
                            <a href="schedule_new_test_two.php?payment='no'" class="btn btn-primary submit-btn"> not paid </a>
                            <a href="schedule_new_test_two.php?payment='yes'" class="btn btn-primary submit-btn" style="background-color: rgba(12, 184, 182, 0.91);"> paid </a>
                        </div>
                        <!--
                        <div class="m-t-20 text-center">
                            <a href="#" class="btn btn-primary submit-btn" style="background-color: rgba(12, 184, 182, 0.91);"> paid </a>
                        </div>-->
                <?php
                    $_SESSION["totalAmount"] = $totalAmount;
                    
                }
                else
                {
                    if(!empty($insert_status))
                    {
                        echo $insert_status;
                    }
                    else
                    {
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