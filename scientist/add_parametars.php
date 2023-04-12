<?php
session_start();
//include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';

$insert_status = "";
/*
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
        $a = substr($day, 7);
        $pateint_ref = "LABPT-" . $a . "0";
    } else {
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
}*/
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
            <?php
             /*if(isset($_GET["ref"]))
             {
                 $test_ref = $_GET["ref"];
                 //$checker = checkTestAppointment($test_ref);
                 if($checker == "no")
                 {*/
                    ?>
                    <div class="content" style=" box-shadow: 0 1px 2px rgba(0,0,0,0.07), 
                        0 2px 4px rgba(0,0,0,0.07), 
                        0 4px 8px rgba(0,0,0,0.07), 
                        0 8px 16px rgba(0,0,0,0.07),
                        0 16px 32px rgba(0,0,0,0.07), 
                        0 32px 64px rgba(0,0,0,0.07);">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-0">
                                <h4 class="page-title">Add Test Parameters to <?php //testNameOnly($test_ref); ?></h4>
                                <h5 id="add"></h5>
                            </div>
                            <div style="align-content: center;"><?php echo $insert_status; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <form method="post" action="">
                                    <div class="row">
                                    </div>
                                    <div class="col-sm-12 form-wrapper">
                                        <div class="row">
                                                <div class="m-t-20 text-center">
                                                <button class="btn btn-primary addInput"  name="add" id="addInput" style="background-color: rgba(12, 184, 182, 0.91); margin-bottom: 10px;">add<span><i class="fa fa-plus"></i></span></button>
                                                <button class="btn btn-primary removeField" name="remove" id="removeInput" style="background-color: rgba(12, 184, 182, 0.91); margin-bottom: 10px;">remove<span><i class="fa fa-remove"></i></span></button>
                                                </div>
                                                <div class="col-sm-6">
                                                <div class="form-group"></div>
                                                </div>
                                            <div class="col-sm-6" id="options">
                                                <div class="form-group">
                                                    <label>Parameter name</label>
                                                    <input type="text" class="form-control" name="parameter[]" required>
                                                </div>
                                            </div>
                                            <div id="add"></div>
                                        </div>
                                    </div>
                                    
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" id="submit" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                            </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <?php
                 /*}
                 else
                 {
                     echo "test is currently on appointment...cannot add parameters now";
                 }

            }
            else
            {
                echo "test reference number not found...";
            }*/
            ?>
        </div>
    </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script>
        var options = document.getElementById('options');
        var moreFields = document.getElementById('addInput');
        var removeField = document.getElementById('removeInput');
        var saveButton = document.getElementById('submit');

        moreFields.onclick = function(){
            var newField = document.createElement('input');
            newField.setAttribute('type','text');
            newField.setAttribute('name','parameter[]');
            newField.setAttribute('class','form-control mt-2');
            newField.setAttribute('required','');
            options.appendChild(newField);
        }

        removeField.onclick = function(){
            var inputTag = document.getElementsByTagName('input');
            if(inputTag.length >= 2)
            {
                options.removeChild(inputTag[(inputTag.length) - 1]);
            }
        }

        saveButton.onclick = function(){
            
            <?php 
                echo "var ref = '$test_ref';"
            ?>
            var inputedValues = document.querySelectorAll('input');
            var valueLength = document.querySelectorAll('input').length;
            var dd = [];
            for(var i = 0; i < valueLength; i++)
            {
                /*var eachValue = document.querySelector('input');*/
                /*dd[i] = inputedValues[i].value;
                dd[i] = document.querySelector('input')[i].value;
                dd[i] = eachValue[i].value;*/
                dd[i] = inputedValues[i].value;
            }
            $.ajax({
                url: 'test-queries.php',
                type: 'POST',
                data: {
                    parameters: dd,
                    ref: ref
                },
                success:function(data) {
                    $('add').html(data);
                    alert(' test parameters');
                }
            });
        }
    </script>

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