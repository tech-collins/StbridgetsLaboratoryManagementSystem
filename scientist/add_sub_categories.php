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
             if(isset($_GET["ref"]))
             {
                 $test_ref = $_GET["ref"];
            ?>
            <div class="content" style=" box-shadow: 0 1px 2px rgba(0,0,0,0.07), 
                0 2px 4px rgba(0,0,0,0.07), 
                0 4px 8px rgba(0,0,0,0.07), 
                0 8px 16px rgba(0,0,0,0.07),
                0 16px 32px rgba(0,0,0,0.07), 
                0 32px 64px rgba(0,0,0,0.07);">
                <div class="row">
                    <div class="col-lg-8 offset-lg-0">
                        <h4 class="page-title">Add Sub-Category Test Parameters</h4>
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
                                            <label>Sub Category name</label>
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
            }
            else
            {
                echo "test reference number not found...";
            }
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
            alert(valueLength);
            var dd = [];
            for(var i = 0; i < valueLength; i++)
            {
                dd[i] = inputedValues[i].value;
            }
            $.ajax({
                url: 'test-queries.php',
                type: 'POST',
                data: {
                    sub_parameters: dd,
                    ref: ref
                },
                success:function(data) {
                    $('add').html(data);
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