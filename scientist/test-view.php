<?php
session_start();
include 'login_check.php';
include 'fabinde.php';


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

$test_name = "";
$test_category = "";
$prize = "";
$date_updated = "";
$parameters;
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
            echo $_GET["ref"];
            $test_name = "";
            $test_category = "";
            $prize = "";
            $date_updated = "";
            $parameters = "";
            $date_registered = "2022-05-12";
            $test_refs = mysqli_real_escape_string($con, $_GET["ref"]);
            $t_ref = substr($test_refs, 2, -2);
            $search_patient = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref = '$t_ref'");
            if ($search_patient) {
                while ($res_search = mysqli_fetch_assoc($search_patient)) {
                    $test_name = $res_search['test_type'];
                    $test_category = $res_search['test_category'];
                    $prize = $res_search['test_amount'];
                    $date_updated = $res_search['date_updated'];
                    $date_registered = $res_search['date_added'];
                    $parameters = $res_search['test_parameters'];
                    $sub_parameter = $res_search['sub_parameters'];
                }
            } else {
            }
        }
        ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">View Test</h4>
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
                                        <a href="#"><img class="avatar" src="assets/img/test.png" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"><?php echo $test_name; ?></h3>
                                                <small class="text-muted"><?php //echo showAge($dob); 
                                                                            ?> test</small>
                                                <div class="staff-id">Reference ID : <?php echo $t_ref; ?></div>
                                                <?php
                                                if (!empty($parameters) && $parameters != "none") {
                                                ?>
                                                    <div class="staff-msg"><a href="add_parametars.php?ref=<?php echo $t_ref; ?>" class="btn" style="color:white; background-color: rgba(12, 184, 182, 0.91);">Add Parametars</a></div>
                                                    <div class="staff-msg"><a href="add_sub_categories.php?ref=<?php echo $t_ref; ?>" class="btn" style="color:white; background-color: rgba(12, 184, 182, 0.91);">Add Sub Categories</a></div>

                                                <?php
                                                } else {
                                                ?>
                                                    <div class="staff-msg"><a href="add_parametars.php?ref=<?php echo $t_ref; ?>" class="btn" style="color:white; background-color: rgba(12, 184, 182, 0.91);">Add Parametars</a></div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Category:</span>
                                                    <span class="text"><?php echo $test_category; ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Date Registered:</span>
                                                    <span class="text"><?php echo $date_registered; ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Amount:</span>
                                                    <span class="text">N<?php echo $prize; ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Updated:</span>
                                                    <span class="text"><?php echo $date_updated; ?></span>
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
                        <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Parameters</a></li>
                        <!--<li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Results</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Messages</a></li>-->
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="about-cont">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">Test Parameters</h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">

                                            <?php
                                            if($parameters != "none")
                                            {
                                                    $para = unserialize($parameters);
                                                    if(is_array($para) && $parameters != "none")
                                                    {
                                                    $paraCount = count(unserialize($parameters));

                                                ?>
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="#/" class="name"></a>
                                                                <div>
                                                                    <?php
                                                                    foreach ($para as $selectedOption) {
                                                                        echo "<b>" . $selectedOption . "</b><br>";
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <span class="time"><b></b></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="#/" class="name">Sub Categories</a>
                                                                <div>
                                                                    <?php 
                                                                    if($sub_parameter == "none")
                                                                    {}
                                                                    else
                                                                    {
                                                                        
                                                                       $subP = unserialize($sub_parameter);
                                                                       if(is_array($subP))
                                                                       {
                                                                         foreach ($subP as $selectedparameter) {
                                                                            echo "<b>" . $selectedparameter . "</b><br>";
                                                                        }
                                                                       }
                                                                       elseif($subP != "none")
                                                                       {
                                                                        echo "<b>" . $subP . "</b><br>";
                                                                       }
                                                                       else
                                                                       {}
                                                                        
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <span class="time"><b></b></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php } ?>
                                            </ul>
                                            <?php
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