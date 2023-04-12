<?php

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
<div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" action="booking_form_two.php">
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
                                            <label>Phone </label>
                                            <input class="form-control" type="tel" name="phone" required>
                                        </div>
                                    </div>
                            </div>
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">Create Patient</button>
                        </div>
                    </div>

                    </form>
                </div>
</div>
</body>