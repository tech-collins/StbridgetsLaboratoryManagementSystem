<?php
include 'fabinde.php';
include 'testDisplay.php';
$dd = "pending";

echo substr(date('d-m-Y'), 7) . "<br>";
$stat = "";
$ref = "LABPT-0220";
$testNumber = "";
$date = date("m-d-Y h:i:s");
$day = date("m-d-Y");
$patient_name = "";
$patient_number = "";
$test = "";
$test_number = "";
$status = "";
$ref_number = "";
$dob = "";
$gender = "";
$appointment_status = "pending";
$payment = "yes";
//$pateint_id = mysqli_real_escape_string($con,$_POST["patient_id"]);
$find_patient = mysqli_query($con,"SELECT * FROM patients WHERE patient_ref_number='$ref'");
$appointmentNumber = "";
if($find_patient)
{
    while($result = mysqli_fetch_assoc($find_patient))
    {
        if($result['payment_status'] == "yes")
        {
            $patient_name = $result['patient_surname'] . " " . $result['patient_firstname'];
            $testNumber = $result['number_of_test'];
            $test = $result['test'];
            $ref_number = $result['patient_ref_number'];
            $dob = $result['age'];
            $gender = $result['gender'];
            $patient_number = $result['phone_number'];
        }
        else
        {
            echo "test has not been paid for";
        }
        
    }
    
    //echo $_POST["patient_id"]."-".$patient_name;
}
else{
    echo"Patient ID not found";
}

$serial_test = serialize($test_number);
echo $testNumber;
//$test_number = "Wider";

$check_appointment = mysqli_query($con,"SELECT * FROM appointments");
if($check_appointment)
{
    if (mysqli_num_rows($check_appointment) == false || mysqli_num_rows($check_appointment) == 0) {
        $appointmentNumber = "APT-" . $day . "-0";
    } else {
        $row_num = mysqli_num_rows($check_appointment);
        $appointmentNumber = "APT-" . $day . "-" . $row_num;
    }
}
else
{
    $appointmentNumber = "APT-" . $day . "-0";
}

$appointment_list = mysqli_query($con,"INSERT INTO appoinments(test_category,test_type,patient_name,dob,gender,phone_no,appointment_no,patient_ref_no,appointment_date,appointment_status,payment) 
VALUES('$test','$testNumber','$patient_name','$dob','$gender','$patient_number','$appointmentNumber','$ref_number','$date','$appointment_status','$payment')");
if($appointment_list)
{
    $stat = "inserted";
}
?>
<!DOCTYPE html>
<html lang="en">


<!-- add-salary24:08-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Laboratory Management System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper" style="background-color: rgb(240, 234, 214);">
        <?php
        //include 'header.php';
        //include 'side-bar.php';
        ?>
        <div class="page-wrapper">
            <div class="content">
               <?php 
               echo $test."<br>";
               echo $testNumber."<br>";
               echo $patient_name."<br>";
               echo $dob."<br>";
               echo $gender."<br>";
               echo $patient_number."<br>";
               echo $appointmentNumber."<br>";
               echo $ref_number."<br>";
               echo $date."<br>";
               echo $appointment_status."<br>";
               ?>
            </div>
            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <tr>
                                        <th rowspan="2">ANTIBIOTICS</th>
                                        <td></td>
                                        <th colspan="2" class="text-center">ORGANISMS/SENSITIVITY</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>NO 1</td>
                                        <td>NO 2</td>
                                        <td>NO 3</td>
                                        <td>NO 4</td>
                                    </tr>
                                    <tr>
                                        <td>PENICILLIN</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>