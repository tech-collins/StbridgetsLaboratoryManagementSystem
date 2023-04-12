<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';

$insert_status = "";

if (isset($_POST["submit"])) {
    $firstname = mysqli_real_escape_string($con, $_POST["firstname"]);
    $surname = mysqli_real_escape_string($con, $_POST["lastName"]);
    $dob = mysqli_real_escape_string($con, $_POST["dob"]);
    $gender = mysqli_real_escape_string($con, $_POST["gender"]);
    $address = mysqli_real_escape_string($con, $_POST["address"]);
    $state = mysqli_real_escape_string($con, $_POST["state"]);
    $city = mysqli_real_escape_string($con, $_POST["city"]);
    $phone = mysqli_real_escape_string($con, $_POST["phone"]);
    $test_category = mysqli_real_escape_string($con, $_POST["testCategory"]);
    $test_cat = testCategory($test_category);
    $date = date("m-d-Y h:i:sa");
    $day = date("d-m-Y");
    $pateint_ref = "";
    $test_number = count($_POST['testName']);
    $tst = $_POST['testName'];
    $test = array($test_number);
    for ($i=0; $i < $test_number; $i++)
    {
        $test[$i] = $tst[$i];
    }
    $implode_test = serialize($test);
    

                

    $ref_check = mysqli_query($con, "SELECT * FROM patients");
    if (mysqli_num_rows($ref_check) == false || mysqli_num_rows($ref_check) == 0) {
        $a = substr(date("d-m-Y"), 7);
        $pateint_ref = "LABPT-" . $a . "0";
    } else {
        $a = substr(date("d-m-Y"), 7);
        $row_num = mysqli_num_rows($ref_check);
        $pateint_ref = "LABPT-" . $a . "-" . $row_num;
    }

    $insert_query = mysqli_query($con, "INSERT INTO patients(patient_surname,patient_firstname,gender,age,phone_number,address,city,patient_state,patient_ref_number,date_registered,test,number_of_test) VALUES('$surname','$firstname','$gender','$dob','$phone','$address','$city','$state','$pateint_ref','$date','$test_cat','$implode_test')");

    if ($insert_query) {
        $insert_status = "<h5 style='color: green;'>patient registered successfully</h5>";
        header("location:patients.php?status='$insert_status'");
    } else {
        $insert_status = "<h5 style='color: red;'>patient not registered successfully...something went wrong</h5>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- add-patient24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget Laboratory Management System</title>
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <div class="">
                                            <input type="text" class="form-control" name="dob" required>
                                            <!--<input type="text" class="form-control datetimepicker" name="dob" required>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control select" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
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
                                            <label>Phone </label>
                                            <input class="form-control" type="tel" name="phone" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="state" required>
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
                                            <label>Test Category</label>
                                            <select class="form-control select" name="testCategory" required>
                                            <option value="Clinical Chemistry">Clinical Chemistry</option>
                                            <option value="Coagulation Test">Coagulation Test</option>
                                            <option value="Glucose Metabolism">Glucose Metabolism</option>
                                            <option value="Haematology">Haematology</option>
                                            <option value="Hepatitis Test">Hepatitis Test</option>
                                            <option value="HIV">HIV Test</option>
                                            <option value="Homonal Assays/Tumour Markers">Homonal Assays/Tumour Markers</option>
                                            <option value="Liver & Pancreas">Liver & Pancreas</option>
                                            <option value="Lipids">Lipids</option>
                                            <option value="MicroBiology">MicroBiology/Parasitology</option>
                                            <option value="Tumour Markers">Serology</option>
                                            <option value="Tumour Markers">Tumour Markers</option>
                                            <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label>Test</label>
                                            <select class="form-control select" name="testName[]" multiple required>
                                                <option value="MRI">MRI</option>
                                                <option value="Wider">Wider</option>
                                                <option value="Sugar">Sugar</option>
                                            </select>
                                        </div>
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
</body>


<!-- add-patient24:07-->

</html>