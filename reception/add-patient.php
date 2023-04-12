<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';

$insert_status = "";

?>

<!DOCTYPE html>
<html lang="en">


<!-- add-patient24:06-->

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
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Patient</h4>
                    </div>
                    <div style="align-content: center;"><?php echo $insert_status; ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" action="add_patient_two.php">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="firstname" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" type="text" name="lastName" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <div class="">
                                            <input type="number" class="form-control" name="dob" required>
                                            <!--<input type="text" class="form-control datetimepicker" name="dob" required>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control select" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Phone </label>
                                            <input class="form-control" type="tel" name="phone" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="state" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label>Test</label>
                                            <select class="form-control selectpicker select" data-live-search="true" name="testName[]" multiple required>
                                            <?php 
                                                $query_test = mysqli_query($con,"SELECT * FROM test_categories");
                                                while($results = mysqli_fetch_assoc($query_test))
                                                {
                                                ?>
                                                <option value="<?php echo $results['test_ref']; ?>"><?php echo $results['test_type']; ?></option>
                                                <?php 
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-sm-6">
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <div class="profile-upload">
                                        <div class="upload-img">
                                            <img alt="" src="assets/img/user.jpg">
                                        </div>
                                        <div class="upload-input">
                                            <input type="file" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">Create Patient</button>
                    </div>
                    </div>
                    <!--
                            <div class="form-group">
                                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="patient_active" value="option1" checked>
									<label class="form-check-label" for="patient_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="patient_inactive" value="option2">
									<label class="form-check-label" for="patient_inactive">
									Inactive
									</label>
								</div>
                            </div>  -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="stackpath/popper.js@1.14.3/popper.min.js"></script>
    <script src="stackpath/popper.js@1.14.3/bootstrap.min.js"></script>
    <script src="stackpath/popper.js@1.14.3/bootstrap-select.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="myscript.js"></script>
</body>


<!-- add-patient24:07-->

</html>