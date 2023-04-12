<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';

$appointment_date = "";
$dob = "";
$patient_name = "";
$app_number = "";
$test_cat = "";
$test_type = "";
$status = "";
$gender = "";
$app_status = "pending";
$appointment = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_status='$app_status' ORDER BY appointment_date DESC");
if ($appointment) {
    while ($res = mysqli_fetch_assoc($appointment)) {
        $patient_name = $res['patient_name'];
        $dob = $res['dob'];
        $app_number = $res['appointment_no'];
        $appointment_date = $res['appointment_date'];
        $test_cat = $res['test_category'];
        $test_type = $res['test_type'];
        $status = $res['appointment_status'];
        $gender = $res['gender'];
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


?>

<!DOCTYPE html>
<html lang="en">


<!-- appointments23:19-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <script src="assets/js/jquery-3.2.1.min.js"></script>
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

    <script type="text/javascript">
        $(document).ready(function() {
            refreshTable();
        });

        function refreshTable() {
            $('#div_refresh').load('load_appointment.php', function() {
                setTimeout(refreshTable, 4000);
            });
        }
    </script>
</head>

<body>
    <div class="main-wrapper" style="background-color: rgb(240, 234, 214);">
        <?php
        include 'header.php';
        include 'side-bar.php'
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
                        <h4 class="page-title">Appointments</h4>
                        <h5 id="deleteStatus" style="color: red;"></h5>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <!--<a href="add-appointment.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Appointment</a> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>Appointment ID</th>
                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Test Category</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="div_refresh">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script>
        function queueStatus(id, status) {
            $('#specificStatus').html('');
            $.ajax({
                type: 'post',
                url: 'patient-queries.php',
                data: {
                    status_id: id,
                    status_con: status
                },
                success: function(data) {
                    $('#specificStatus').html(data);
                }
            })
        }
    </script>
    <script>
        function removeAppointment(id) {
            if (confirm("are you sure, you want to remove this appointment? ") == true) {
                $.ajax({
                    type: 'post',
                    url: 'patient_queries.php',
                    data: {
                        removeId: id,
                    },
                    success: function(data) {
                        $('#deleteStatus').html(data);
                    }
                });
            }
        }
    </script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker4').datetimepicker({
                format: 'LT'
            });
        });
    </script>
</body>


<!-- appointments23:20-->

</html>