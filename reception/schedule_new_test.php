<?php
session_start();
include 'login_check.php';
include 'fabinde.php';

$totalAmount = 0;

if (isset($_POST["testCategory"])) {
    $patient_name = "";
    $phone_no = "";
    $dob = "";
    $gender = "";
    $date = date('Y-m-d');
    $appointmentNumber = "";
    $payment = "no";
    $test_number = count($_POST['testName']);
    $tst = $_POST['testName'];
    $test = array($test_number);
    for ($i = 0; $i < $test_number; $i++) {
        $test[$i] = $tst[$i];
    }

    $implode_test = serialize($test);

    $pat_ref = mysqli_real_escape_string($con, $_POST["ref"]);
    $test_cate = mysqli_real_escape_string($con, $_POST["testCategory"]);
    $find_patient = mysqli_query($con, "SELECT * FROM patients WHERE patient_ref_number='$pat_ref'");
    if ($find_patient) {
        while ($find_result = mysqli_fetch_assoc($find_patient)) {
            $patient_name = $find_result['patient_surname'] . " " . $find_result['patient_firstname'];
            $phone_no = $find_result['phone_number'];
            $dob = $find_result['age'];
            $gender = $find_result['gender'];
        }
    }
    $check_appointment = mysqli_query($con, "SELECT * FROM appointments");
    if (mysqli_num_rows($check_appointment) == false || mysqli_num_rows($check_appointment) == 0) {
        $appointmentNumber = "APT-" . $day . "-0";
    } else {
        $row_num = mysqli_num_rows($check_appointment);
        $appointmentNumber = "APT-" . $day . "-" . $row_num;
    }

    $appointment_list = mysqli_query($con, "INSERT INTO appointments(test_category,test_type,patient_name,dob,gender,phone,appointment_no,patient_ref_no,appointment_date,appointment_status,payment) 
        VALUES('$test_cate','$implode_test','$patient_name','$dob','$gender','$phone_no','$appointmentNumber','$pat_ref','$date','$appointment_status','$payment')");

    if ($appointment_list) {
        echo "Patient Queued Successfully";
    } else {
        //echo "patient not queued..something went wrong";
    }
}

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
?>
<!DOCTYPE html>
<html lang="en">


<!-- add-appointment24:07-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Laboratory Management System</title>
    <link rel="stylesheet" href="stackpath/bootstrap.min.css">
    <link rel="stylesheet" href="stackpath/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body style="background-color: rgb(240, 234, 214);">
    <div class="main-wrapper">
        <?php
        include 'header.php';
        include 'side-bar.php';
        ?>
        <div class="page-wrapper" style="background-color: rgb(240, 234, 214);">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Appointment</h4>
                    </div>
                </div>
                <?php
                if (isset($_GET["ref"]) || isset($_POST["ref"])) {
                    $tests;
                    if(isset($_SESSION["tst"]))
                    {
                        $tests = $_SESSION["tst"];
                    }
                    $test_number = "";
                    $totalAmount = "";
                    $patient_name = "";
                    $phone_no = "";
                    $dob = "";
                    $gender = "";
                    $patient_ref;
                    if(isset($_POST["ref"]))
                    {
                        $patient_ref = mysqli_real_escape_string($con, $_POST["ref"]);
                    }
                    else
                    {
                        $patient_ref = mysqli_real_escape_string($con, $_GET["ref"]);
                    }
                    
                    $find_patient = mysqli_query($con, "SELECT * FROM patients WHERE patient_ref_number='$patient_ref'");
                    if ($find_patient) {
                        while ($find_result = mysqli_fetch_assoc($find_patient)) {
                            $patient_name = $find_result['patient_surname'] . " " . $find_result['patient_firstname'];
                            $phone_no = $find_result['phone_number'];
                            $dob = $find_result['age'];
                            $gender = $find_result['gender'];
                        }
                    }
                ?>
                    <div class="card-box profile-header">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-view">
                                    <div class="profile-img-wrap">
                                        <! <div class="profile-img">
                                            <a href="#"><img class="avatar" src="assets/img/doctor-03.jpg" alt=""></a>
                                    </div>
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="profile-info-left">
                                                    <h3 class="user-name m-t-0 mb-0"><?php echo $patient_name; ?></h3>
                                                    <small class="text-muted"><?php echo $dob; ?> yrs</small>
                                                    <div class="staff-id">Reference ID : <?php echo $patient_ref; ?></div>
                                                    <div class="staff-id"><?php echo $gender; ?></div>
                                                    <div class="staff-id"><?php echo $phone_no; ?></div>
                                                </div>
                                            </div>

                                            <div class=>
                                                <form method="POST" action="schedule_new_test.php">
                                                    <div class="row" id="add_to_me">
                                                    </div>
                                                    <?php
                                                    if(isset($_POST["ref"])) {
                                                        $postedT = $_POST["testName"];
                                                        $postedTest = array(count($postedT));
                                                        foreach($postedT as $rr)
                                                        {
                                                            $postedTest = $rr;
                                                        }
                                                    ?>
                                                        <div class="col-12">
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
                                                                        $totalAmount = 0;

                                                                        if (is_array($postedT)) {
                                                                            $test_number = count($postedT);
                                                                            foreach ($postedT as $der) {
                                                                        ?>
                                                                                <tr>
                                                                                    <td><?php echo $cc; ?></td>
                                                                                    <?php
                                                                                    $getPrize = testPrize($der);
                                                                                    echo $getPrize;
                                                                                    ++$cc;
                                                                                    ?>
                                                                                    
                                                                                </tr>
                                                                            <?php
                                                                                $totalAmount = $totalAmount + prizeOnly($der);
                                                                            }
                                                                        } else {
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
                                                    <?php
                                                        $_SESSION["patient_reference"] = $patient_ref;
                                                        $_SESSION["patient_test"] = $postedT;
                                                        $_SESSION["testAmount"] = $totalAmount;
                                                    } 
                                                    else 
                                                    {
                                                    ?>
                                                        <div class="col-12">
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
                                                                        $totalAmount = 0;
                                                                    if(isset($_SESSION["tst"]))
                                                                    {
                                                                        $tests = $_SESSION["tst"];   
                                                                        if (is_array($tests)) {
                                                                            $test_number = count($tests);
                                                                            foreach ($tests as $der) {
                                                                        ?>
                                                                                <tr>
                                                                                    <td><?php echo $cc; ?></td>
                                                                                    <?php
                                                                                    $getPrize = testPrize($der);
                                                                                    echo $getPrize;
                                                                                    ++$cc;
                                                                                    ?>
                                                                                </tr>
                                                                            <?php
                                                                                $totalAmount = $totalAmount + prizeOnly($der);
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo $cc; ?></td>
                                                                            <?php
                                                                            echo $tests;
                                                                            $getPrize = testPrize($tests);
                                                                            echo $getPrize;
                                                                            $totalAmount = prizeOnly($tests);
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
                                                    <?php
                                                        $_SESSION["patient_reference"] = $patient_ref;
                                                        $_SESSION["patient_test"] = $_SESSION["tst"];
                                                        $_SESSION["testAmount"] = $totalAmount;
                                                    }
                                                }
                                                    ?>
                                                    <div class="m-t-20 text-center" style="margin-left: 5%;">
                                                        <a href="add_patient_two.php?payments=no&newSchedule=yes&patientRef=<?php echo  $patient_ref; ?>" class="btn btn-primary "> not paid </a>
                                                        <a href="add_patient_two.php?payments=yes&newSchedule=yes&patientRef=<?php echo  $patient_ref; ?>" class="btn btn-primary " style="background-color: rgba(12, 184, 182, 0.91);"> paid </a>
                                                        <a href="company_patient_name.php?company=company&newSchedule=yes&patientRef=<?php echo  $patient_ref; ?>" class="btn btn-warning mt-3"> company </a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
            </div>
            <div class="row">
            </div>
        <?php
                }
        ?>
        </div>
    </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script>
        function fetchPrize(val) {
            document.getElementById("add_to_me").multiple.innerHTML +=
                "<h3>" + val + "</h3>";
            /*$('#specificClass').html('');
            $.ajax({
                type: 'post',
                url: 'test-queries.php',
                data: {
                    test_name: id
                },
                success: function(data) {
                    $('#specificClass').html(data);
                }
            })*/
        }
    </script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="stackpath/popper.js@1.14.3/popper.min.js"></script>
    <script src="stackpath/popper.js@1.14.3/bootstrap.min.js"></script>
    <script src="stackpath/popper.js@1.14.3/bootstrap-select.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="myscript.js"></script>
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'

            });
        });
    </script>
</body>


<!-- add-appointment24:07-->

</html>