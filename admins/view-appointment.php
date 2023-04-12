<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';

$patient_ref = "";

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


<!-- profile22:59-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Laboratory Maagement System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
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

        if (isset($_GET["ref"]) || isset($_POST["ref"])) {
            $patient_name = "";
            $ref_number = "";
            $phone = "";
            $gender = "";
            $age = "";
            $dob = "";
            $address = "";
            $date_registered = "2022-05-12";
            $patient_refs = mysqli_real_escape_string($con, $_GET["ref"]);
            $patient_ref = $patient_refs;
            $search_patient = mysqli_query($con, "SELECT * FROM patients WHERE patient_ref_number = '$patient_ref'");
            if ($search_patient) {
                while ($res_search = mysqli_fetch_assoc($search_patient)) {
                    $patient_name = $res_search['patient_firstname'] . " " . $res_search['patient_surname'];
                    $gender = $res_search['gender'];
                    $dob = $res_search['age'];
                    $phone = $res_search['phone_number'];
                    $address = $res_search['address'];
                    $date_registered = substr($res_search['date_registered'], 0, 10);
                }
            } else {
            }
        }
        ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">View Appointment</h4>
                    </div>

                    <div class="col-sm-5 col-6 text-right m-b-30">
                        <!--<a href="edit-profile.html" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a> -->
                    </div>
                </div>
                <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img class="avatar" src="assets/img/doctor-03.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"><?php echo $patient_name; ?></h3>
                                                <small class="text-muted"><?php echo $dob; ?> yrs</small>
                                                <div class="staff-id">Reference ID : <?php echo $patient_ref; ?></div>
                                                <!-- <div class="staff-msg"><a href="#" class="btn" style="color:white; background-color: rgba(12, 184, 182, 0.91);">Schedule test</a></div> -->
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#"><?php echo $phone; ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Age:</span>
                                                    <span class="text"><?php echo $dob; ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Address:</span>
                                                    <span class="text"><?php echo $address; ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text"><?php echo $gender; ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Date Registered:</span>
                                                    <span class="text"><?php echo $date_registered; ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Test</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Results</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Messages</a></li> -->
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="about-cont">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">Laboratory Test</h3>
                                        <div class="experience-box">
                                            <?php

                                            $app_search = mysqli_query($con, "SELECT * FROM appointments WHERE patient_ref_no='$patient_ref' ORDER BY appointment_date DESC");
                                            if ($app_search) {
                                                while ($result_search = mysqli_fetch_assoc($app_search)) {

                                            ?>
                                                    <ul class="experience-list">
                                                        <li>
                                                            <div class="experience-user">
                                                                <div class="before-circle"></div>
                                                            </div>
                                                            <div class="experience-content">
                                                                <div class="timeline-content">
                                                                    <a href="#" class="name"><?php //echo $result_search['test_category']; ?></a>
                                                                    <div><?php 
                                                                    $tt = unserialize($result_search['test_type']); 
                                                                    foreach ($tt as $selectedOption){
                                                                        echo "<b>".testNameOnly($selectedOption)."</b><br>";
                                                                    }
                                                                    ?></div>
                                                                    <span class="time"><b>
                                                                        <?php 
                                                                        echo $result_search['appointment_date']; 
                                                                        if($result_search['appointment_status'] == "finish")
                                                                        {
                                                                            echo $result_search['appointment_date'];?><a href="all_result_view.php?ref=<?php echo $result_search['patient_ref_no']; ?>&appointmentNo=<?php echo $result_search['appointment_no']; ?>"> View Result</a>
                                                                        <?php 
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $result_search['appointment_date']."<h4 style='color: violet;'><b>(".$result_search['appointment_status'].")</b></h4>"; 
                                                                        ?>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </b></span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                    </ul>
                                            <?php }
                                            }
                                            else{
                                                echo "appointments not found";
                                            }
                                             ?>
                                        </div>
                                    </div>
                                   <!-- <div class="card-box mb-0">
                                        <h3 class="card-title">Experience</h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">Consultant Gynecologist</a>
                                                            <span class="time">Jan 2014 - Present (4 years 8 months)</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">Consultant Gynecologist</a>
                                                            <span class="time">Jan 2009 - Present (6 years 1 month)</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">Consultant Gynecologist</a>
                                                            <span class="time">Jan 2004 - Present (5 years 2 months)</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>   -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab2">
                        <div class="row">
                        <div class="col-md-12">
                        <div class="card-box">
                        <h3 class="card-title">Education Informations</h3>
                        <div class="experience-box"></div>
                        </div>
                        </div>
                        </div>
                            Tab content 2
                        </div>
                        <div class="tab-pane" id="bottom-tab3">
                            Tab content 3
                        </div>
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
    <script src="assets/js/app.js"></script>
</body>


<!-- profile23:03-->

</html>