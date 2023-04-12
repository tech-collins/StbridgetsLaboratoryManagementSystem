<?php
session_start();
//include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';

$patient_ref = "";

$today = "";

$appointmnetStatus = "";

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
            $appNumber = "";
            $messages = "";
            if(isset($_GET['appN']))
            {
                $appNumber = $_GET['appN'];
            }
            $today;
            if(isset($_GET["today"]))
            {
                $today = $_GET["today"];
            }
            if(isset($_GET["message"]))
            {
                $messages = $_GET["message"];
            }
            $patient_name = "";
            $ref_number = "";
            $phone = "";
            $gender = "";
            $age = "";
            $dob = "";
            $address = "";
            $patient_id = "";
            $date_registered = "";
            $patient_refs = mysqli_real_escape_string($con, $_GET["ref"]);
            $patient_ref = $patient_refs;
            $patient_id = $patient_ref;
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
            $checkAppointment = mysqli_query($con,"SELECT * FROM appointments WHERE patient_ref_no='$patient_ref' AND appointment_no='$appNumber'");
            if(mysqli_num_rows($checkAppointment) >= 1)
            {
                while($gottenStats = mysqli_fetch_assoc($checkAppointment))
                {
                    $appointmnetStatus = $gottenStats['appointment_status'];
                }
            }
        }
        ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">View Appointment</h4>
                        <h5 style="color: green;"><?php echo $messages; ?></h5>
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
                                        <a href="#"><img class="avatar" src="assets/img/user.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"><?php echo $patient_name; ?></h3>
                                                <small class="text-muted"><?php echo $dob; ?> yrs</small>
                                                <div class="staff-id">Reference ID : <?php echo $patient_ref; ?></div>
                                                <?php 
                                                if($appointmnetStatus == "pending")
                                                {
                                                ?>
                                                    <div class="staff-msg"><a href="#" onclick="acceptAppointment('<?php echo $patient_id; ?>','sample collected')" class="btn" style="color:white; background-color: rgba(12, 184, 182, 0.91);">Accept Test</a></div>
                                                <?php
                                                }
                                                elseif($appointmnetStatus == "sample collected")
                                                {
                                                ?>
                                                <!-- <div class="staff-msg"><a href="record_result.php?ref=<?php //echo $patient_ref; ?>" class="btn" style="color:white; background-color: rgba(12, 184, 182, 0.91);">input test result</a></div>  -->
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <?php
                                                }
                                                ?>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><?php echo $phone; ?></span>
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
                        <!--<li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Results</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Messages</a></li>  -->
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="about-cont">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">Laboratory Test</h3>
                                        <div class="experience-box">
                                            <?php
                                            
                                            $categ = "";
                                            $app_search = mysqli_query($con, "SELECT * FROM appointments WHERE patient_ref_no='$patient_ref' AND appointment_date='$today'");
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
                                                                    <a href="#" class="name">
                                                                        <?php 
                                                                            if($categ == $result_search['test_category'])
                                                                            {}
                                                                            else
                                                                            {
                                                                                $categ = $result_search['test_category'];
                                                                                //echo $categ;
                                                                            
                                                                        ?>
                                                                    </a>
                                                                    <div>
                                                                    <?php 
                                                                    $tt = $result_search['test_type'];
                                                                    $serial =  unserialize($tt);
                                                                    if(is_array($serial) && count($serial) > 1)
                                                                    {
                                                                        foreach($serial as $ed)
                                                                        {
                                                                            if($appointmnetStatus == "sample collected")
                                                                            {
                                                                                $returning = checkTestResultStatus($ed,$appNumber);
                                                                                if($returning == "no result")
                                                                                {
                                                                                    echo "<br><b>".testNameOnly($ed)." "."(".findCategory($ed).")</b><br><a href='input_result.php?ref=".$patient_ref."&appNumber=".$appNumber."&test=".$ed."'>Input Test Result</a>";
                                                                                }
                                                                                elseif($returning == "updated")
                                                                                {
                                                                                    echo "<br><b>".testNameOnly($ed)." "."(".findCategory($ed).")</b><br><a href='single_view_result.php?ref=".$patient_ref."&appNumber=".$appNumber."&test=".$ed."&test=".$ed."'>Check Result</a>";
                                                                                }
                                                                                else
                                                                                {}
                                                                            }
                                                                            else
                                                                            {
                                                                                echo "<b>".testNameOnly($ed)." "."(".findCategory($ed).")</b><br>";
                                                                            }
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                        if(is_array($serial))
                                                                        {
                                                                            //echo count($serial);
                                                                        }
                                                                        if($appointmnetStatus == "sample collected")
                                                                            {
                                                                                $returning = checkTestResultStatus($serial[0],$appNumber);
                                                                                if($returning == "no result")
                                                                                {
                                                                                    echo "<br><b>".testNameOnly($serial[0])." "."(".findCategory($serial[0]).")</b><br><a href='input_result.php?ref=".$patient_ref."&appNumber=".$appNumber."&test=".$serial[0]."'>Input Test Result</a>";
                                                                                }
                                                                            }
                                                                            //echo "<b>".testNameOnly($serial[0])."</b><br>";
                                                                    }
                                                                    //$dcount = count($serial);
                                                                }
                                                                   /* for($ee = 0; $ee < $dcount; $ee++)
                                                                    {
                                                                        echo "<b>".$serial[$ee]."</b><br>";
                                                                    }*/
                                                                    ?></div>
                                                                    <span class="time"><b><?php echo $result_search['appointment_date']; ?></b></span>
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
                    alert(data);
                    document.location.href='index.php';
                }
            });
            
            
        }
    </script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- profile23:03-->

</html>