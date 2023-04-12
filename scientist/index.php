<?php
session_start();
//include 'login_check.php';
include 'fabinde.php';
?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Laboratory Management System-</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
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
            $('#div_refresh').load('index-queue.php', function() {
                setTimeout(refreshTable, 3000);
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            refreshFinish();
        });

        function refreshFinish() {
            $('#finish_refresh').load('finished_appointment.php', function() {
                setTimeout(refreshTable, 3000);
            });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            refreshPending();
        });

        function refreshPending() {
            $('#pending_refresh').load('pending_appointment.php', function() {
                setTimeout(refreshTable, 3000);
            });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            refreshAccepted();
        });

        function refreshAccepted() {
            $('#accepted_refresh').load('accepted_appointment.php', function() {
                setTimeout(refreshTable, 3000);
            });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            refreshTotal();
        });

        function refreshTotal() {
            $('#total_refresh').load('total_appointment.php', function() {
                setTimeout(refreshTable, 3000);
            });
        }
    </script>

</head>

<body>
    <div class="main-wrapper" style="background-color: rgb(240, 234, 214);">
        <?php 
        include 'header.php';
        include 'side-bar.php';
        ?>
        <div class="page-wrapper">
            <div class="content">
            <div class="row">
                    <?php
                    /**$query_booked = mysqli_query($con, "SELECT * FROM appointments");
                    $test_num = 0;
                    if($query_booked)
                    {
                        if (mysqli_num_rows($query_booked) < 1 || mysqli_num_rows($query_booked) == false) {
                            $test_num = 0;
                        } else {
                            $test_num = mysqli_num_rows($query_booked);
                        }
                    }
                    else
                    {
                        $test_num = 0;
                    }**/
                    ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3 id="total_refresh"><?php //echo $test_num; ?></h3>
                                <span class="mx-4" style="color: #009efb;">Total Lab Test <i class="fa fa-check" aria-hidden="true"></i></span>
                                <span class="" style="color: #009efb;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <?php
                        /**$sst = "pending";
                        $query_pending = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_status='$sst'");
                        $pending_num = 0;
                        if($query_pending)
                        {
                            if (mysqli_num_rows($query_pending) < 1 || mysqli_num_rows($query_pending) == false) {
                                $pending_num = 0;
                            } else {
                                $pending_num = mysqli_num_rows($query_pending);
                            }
                        }
                        else
                        {
                            $pending_num = 0;
                        }**/
                        ?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3 id="finish_refresh"><?php //echo $pending_num; ?></h3>
                                <span class="mx-4" style="color: #55ce63;">Total Finished Test <i class="fa fa-check" aria-hidden="true"></i></span>
                                <span class="" style="color: #55ce63;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <?php
                            /**$sst = "sample collected";
                            $query_approved = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_status='$sst'");
                            $approved_num = 0;
                            if($query_approved)
                            {
                                if (mysqli_num_rows($query_approved) < 1 || mysqli_num_rows($query_approved) == false) {
                                    $approved_num = 0;
                                } else {
                                    $approved_num = mysqli_num_rows($query_approved);
                                }
                            }
                            else
                            {
                                $approved_num = 0;
                            }**/
                            ?>
                            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3 id="accepted_refresh"><?php //echo $approved_num; ?></h3>
                                <span class="mx-4" style="color: #7a92a3;">Total Approved Test <i class="fa fa-check" aria-hidden="true"></i></span>
                                <span class="" style="color: #7a92a3;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <?php
                        /**$sst = "finish";
                        $query_finished = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_status='$sst'");
                        $finished_num = 0;
                        if($query_finished)
                        {
                            if (mysqli_num_rows($query_finished) < 1 || mysqli_num_rows($query_finished) == false) {
                                $finished_num = 0;
                            } else {
                                $finished_num = mysqli_num_rows($query_finished);
                            }
                        }
                        else
                        {
                            $finished_num = 0;
                        }**/
                        ?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3 id="pending_refresh"><?php //echo $finished_num; ?></h3>
                                <span class="mx-4" style="color: #ffbc35;">Total Pending Test<i class="fa fa-check" aria-hidden="true"></i></span>
                                <span class="" style="color: #ffbc35;"></span>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
                <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">Queued Appointments</h4> <a href="appointments.php" class="btn btn-primary float-right">View all</a>
                                <h5 id="deleteStatus"></h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="d-none">
                                            <tr>
                                                <th>Patient Name</th>
                                                <th>Doctor Name</th>
                                                <th>Timing</th>
                                                <th class="text-right">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="div_refresh">
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="card member-panel">
                            <div class="card-header bg-white">
                                <h4 class="card-title mb-0">Test Sample Collected</h4>
                            </div>
                            <div class="card-body">
                                <ul class="contact-list">
                                    <li id="approved_refresh">
                                        <?php

                                        $app = "sample collected";
                                        $display_approved = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_status='$app' LIMIT 6");
                                        if ($display_approved) {
                                            while ($approved = mysqli_fetch_assoc($display_approved)) {
                                        ?>
                                                <div class="contact-cont">
                                                    <div class="float-left user-img m-r-10">
                                                        <a href="profile.php" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                                    </div>
                                                    <div class="contact-info">
                                                        <span class="contact-name text-ellipsis"><?php echo $approved['patient_name']; ?></span>
                                                        <span class="contact-date"><?php echo $approved['gender']; ?></span>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer text-center bg-white">
                                <a href="" class="text-muted">============</a>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script>
        function acceptAppointment(id, status)
        {
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
        function removeAppointmentt(id)
        {
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
    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/app.js"></script>

</body>



</html>