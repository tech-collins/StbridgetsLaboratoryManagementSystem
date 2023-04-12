<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';

$insert_status = "";

if (isset($_GET["payment"])) {
    $payment_status = $_GET["payment"];
    $firstname = $_SESSION["firstname"];
    $surname = $_SESSION["surname"];
    $dob = $_SESSION["dob"];
    $gender = $_SESSION["gender"];
    $address = $_SESSION["address"];
    $state = $_SESSION["state"];
    $city = $_SESSION["city"];
    $phone = $_SESSION["phone"];
    $test_category = $_SESSION["test_category"];
    $test_cat = testCategory($test_category);
    $date = date("m-d-Y h:i:sa");
    $day = date("d-m-Y");
    $pateint_ref = "";
    $patient_passport = "none";
    $tst = $_SESSION['tst'];
    $test_number = count($tst);
    $test = array($test_number);
    for ($i = 0; $i < $test_number; $i++) {
        $test[$i] = $tst[$i];
    }

     $implode_test = serialize($test);
 

    $check = mysqli_query($con, "SELECT * FROM patients WHERE phone_number='$phone'");
    if (mysqli_num_rows($check) >= 1) {
        $p_ref = "";
        while ($seen = mysqli_fetch_assoc($check)) {
            $p_ref = $seen['patient_ref_number'];
        }
        $insert_status = "<h5 class='m-5' style='color: red;'>patient contact already exist...click <a href='schedule_new_test.php?ref=" . $p_ref . "'> here </a> to schedule new test</h5>";
    } else {
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
        if($payment_status == "yes")
        {
            $query = "INSERT INTO patients(patient_surname,patient_firstname,gender,age,phone_number,address,city,patient_state,patient_ref_number,date_registered,test,number_of_test,patient_passport,payment_status) VALUES('$surname','$firstname','$gender','$dob','$phone','$address','$city','$state','$pateint_ref','$date','$test_cat','$implode_test','$patient_passport','$payment_status')";
            $insert_query = mysqli_query($con, $query);

            if ($insert_query) {
                insertTest($pateint_ref);
                $insert_status = "<h5 style='color: green;'>patient registered successfully</h5>";
                header("location:patients.php?status=$insert_status");
            } else 
            {
                $insert_status =  $payment_status."<h5 style='color: red;'>patient not registered successfully...something went wrong</h5>";
            }
        }
        else
        {
            $query = "INSERT INTO patients(patient_surname,patient_firstname,gender,age,phone_number,address,city,patient_state,patient_ref_number,date_registered,test,number_of_test,patient_passport,payment_status) VALUES('$surname','$firstname','$gender','$dob','$phone','$address','$city','$state','$pateint_ref','$date','$test_cat','$implode_test','$patient_passport','$payment_status')";
            $insert_query = mysqli_query($con, $query);

            if ($insert_query) 
            {
                $insert_status = "<h5 style='color: green;'>patient registered successfully</h5>";
                header("location:patients.php?status=$insert_status");
            } 
            else 
            {
                $insert_status =  $payment_status."<h5 style='color: red;'>patient not registered successfully...something went wrong</h5>";
            }
        }
    }
}
function insertTest($patientReference)
{
    include 'fabinde.php';
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
    $payment = "paid";
    $pateint_id = $patientReference;
    $find_patient = mysqli_query($con,"SELECT * FROM patients WHERE id='$pateint_id'");
    $appointmentNumber = "";
    if($find_patient)
    {
        while($result = mysqli_fetch_assoc($find_patient))
        {
            if($result['payment_status'] == "yes")
            {
                $patient_name = $result['patient_surname'] . " " . $result['patient_firstname'];
                $test_number = unserialize($result['number_of_test']);
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
    }
    else{
        echo"<script> alert('Patient ID not found');</script>";
    }

    $serial_test = serialize($test_number);
    //$test_number = "Wider";

    $check_appointment = mysqli_query($con,"SELECT * FROM appointments");
    if (mysqli_num_rows($check_appointment) == false || mysqli_num_rows($check_appointment) == 0) {
        $appointmentNumber = "APT-" . $day . "-0";
    } else {
        $row_num = mysqli_num_rows($check_appointment);
        $appointmentNumber = "APT-" . $day . "-" . $row_num;
    }

    $appointment_list = mysqli_query($con,"INSERT INTO appointments(test_category,test_type,patient_name,dob,gender,phone,appointment_no,patient_ref_no,appointment_date,appointment_status,payment) VALUES('$test','$serial_test','$patient_name','$dob','$gender','$patient_number','$appointmentNumber','$ref_number','$date','$appointment_status','$payment')");

    if($appointment_list)
    {
        $test_amounts = "";
        foreach($test_number as $getAmount)
        { 
            $test_amounts = $test_amounts + prizeOnly($getAmount);
        }
        inserTransactions($patient_name,$ref_number,$appointmentNumber,$serial_test,$test_amounts);
        $result_ref = $appointmentNumber."-".$ref_number;
        $result_status = "no result";
        $test_result = "none";
        $test_result_date = "none";
        $number_of_test = count($test_number);
        for($ii = 0; $ii <= $number_of_test; $ii++)
        {
            $test_number_ref = $test_number[$ii];
            $paraNumbers = numberOfTestParameters($test_number_ref);
            if($paraNumbers == "none")
            {
                $subPara_ref = numberOfSubTestParameters($test_number_ref);
                if($subPara_ref == "none")
                {
                    $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref) VALUES('$patient_name','$ref_number','$appointmentNumber','$test','$test_number_ref','$paraNumbers','$subPara_ref','$result_status','$test_result','$test_result_date','$result_ref ')");
                }
                else
                {
                    foreach($subPara_ref as $subp)
                    {
                        $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref) VALUES('$patient_name','$ref_number','$appointmentNumber','$test','$test_number_ref','$paraNumbers','$subp','$result_status','$test_result','$test_result_date','$result_ref ')");
                    }
                }
            }
            else
            {
                
                $each_subPara_ref = numberOfSubTestParameters($test_number_ref);
                foreach($paraNumbers as $pn)
                {
                    if($each_subPara_ref == "none")
                    {
                        $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref) VALUES('$patient_name','$ref_number','$appointmentNumber','$test','$test_number_ref','$pn','$subPara_ref','$result_status','$test_result','$test_result_date','$result_ref ')");
                    }
                    else
                    {
                        foreach($paraNumbers as $pn)
                        {
                            foreach($each_subPara_ref as $esubP)
                            {
                                $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref) VALUES('$patient_name','$ref_number','$appointmentNumber','$test','$test_number_ref','$pn','$esubP','$result_status','$test_result','$test_result_date','$result_ref ')");
                            }
                        }

                    }
                }
            }
        }
        echo"Patient Queued Successfully";
    }
    else
    {
        //echo "patient not queued..something went wrong";
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
function checkDatabase($reference)
{
    include 'fabinde.php';
    $checking;
    $pat_ref = "";
    $check_base = mysqli_query($con, "SELECT * FROM patients WHERE phone_number='$reference'");
        if (mysqli_num_rows($check_base) >= 1) {
                while ($collectRef = mysqli_fetch_assoc($check_base)) 
                {
                    $pat_ref = $collectRef['patient_ref_number'];
                }
                        
                        $checking = $pat_ref;
                        //header("location:schedule_new_test.php?ref=$pat_ref");\
                        echo "<script>window.location = 'schedule_new_test.php?ref=".$pat_ref."'</script>";
            }
            else
            {
                $checking = "not seen";
            }
            return $checking;
}
function inserTransactions($patientName,$patientRef,$appNum,$testName,$testAmount)
{
    include 'fabinde.php';
    
    $complete = "";
    $transDate = date('Y-m_d');
    $transaction_invoice = "";
    $invoice_check = mysqli_query($con,"SELECT * FROM transactions");
    if(mysqli_num_rows($invoice_check) == false || mysqli_num_rows($invoice_check) < 1)
    {
        $transaction_invoice = "INV".substr($transDate,7)."-01";
    }
    else
    {
        $cd = mysqli_num_rows($invoice_check);
        $transaction_invoice = "INV".substr($transDate,7)."-0".$cd;
    }
    $payStat = "paid";
    $insert_transaction = mysqli_query($con,"INSERT INTO transactions(patient_name,ref_number,transaction_invoice,test_type,appointment_no,amount,transaction_date,transaction_payment	
    ) VALUES('$patientName','$patientRef','$transaction_invoice','$testName',',$appNum','$testAmount','$transDate','$payStat')");
    if($insert_transaction)
    {
        $complete = "complete";
    }
    return $complete;
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
                    $ph = mysqli_real_escape_string($con, $_POST["phone"]);

                    $dd = checkDatabase($ph);
                        
                    $_SESSION["firstname"] = mysqli_real_escape_string($con, $_POST["firstname"]);
                    $_SESSION["surname"] = mysqli_real_escape_string($con, $_POST["lastName"]);
                    $_SESSION["dob"] = mysqli_real_escape_string($con, $_POST["dob"]);
                    $_SESSION["gender"]  = mysqli_real_escape_string($con, $_POST["gender"]);
                    $_SESSION["address"]  = mysqli_real_escape_string($con, $_POST["address"]);
                    $_SESSION["state"]  = mysqli_real_escape_string($con, $_POST["state"]);
                    $_SESSION["city"]  = mysqli_real_escape_string($con, $_POST["city"]);
                    $_SESSION["phone"]  = mysqli_real_escape_string($con, $_POST["phone"]);
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
                            <a href="add_patient_two.php?payment=no" class="btn btn-primary submit-btn"> not paid </a>
                            <a href="add_patient_two.php?payment=yes" class="btn btn-primary submit-btn" style="background-color: rgba(12, 184, 182, 0.91);"> paid </a>
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