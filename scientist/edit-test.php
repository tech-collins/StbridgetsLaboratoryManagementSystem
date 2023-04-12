<?php
session_start();
include 'login_check.php';
include 'fabinde.php';

$insert_status = "";

if(isset($_POST["status"]))
{
    $insert_status = $_POST["status"];
}

if(isset($_POST["amount"]))
{
    $testName = mysqli_real_escape_string($con,$_POST["testName"]);
    $testCategory = mysqli_real_escape_string($con,$_POST["testCategory"]);
    $test_amount = mysqli_real_escape_string($con,$_POST["amount"]);
    $tst_id = mysqli_real_escape_string($con,$_POST["id"]);
    $ref = mysqli_real_escape_string($con,$_POST["ref"]);
    $updated_date = date('Y-m-d');
    $test_ref = "";
    $cat = substr($testCategory,0,3);
    $cut = substr($ref,0,3);
    $category = str_replace($cat,$cut,$ref);
    $test_ref = $category;
    
            $inserted = mysqli_query($con,"UPDATE test_categories SET test_category ='".$testCategory."', test_type ='".$testName."', test_amount ='".$test_amount."', date_updated ='".$updated_date."', test_ref ='".$test_ref."' WHERE id ='".$tst_id."'");
            if($inserted)
            {
                $insert_status = $tst_id."<h5 style='color: rgba(12, 184, 182, 0.91);'>patient details edited successfully</h5>";
                header("location:add_test.php?status=$insert_status");
            }
            else
            {
                $insert_status = "<h5 style='color: red;'>patient details Not edited successfully</h5>";
            }

}

?>

<!DOCTYPE html>
<html lang="en">


<!-- edit-patient24:07-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Laboratory Management System</title>
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

        if(isset($_GET["id"]))
        {
            $dd = $_GET["id"];
            $test_id = substr($dd,1,-1);
            $find = mysqli_query($con,"SELECT * FROM test_categories WHERE id='$test_id'");
            if($find)
            {
                while($res = mysqli_fetch_assoc($find))
                {
           
        ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Test</h4>
                        <h5><?php echo $insert_status; ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" action="edit-test.php">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Test Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="testName" type="text" placeholder="<?php echo $res['test_type']; ?>" value="" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Test Category <span class="text-danger">*</span></label>
                                        <input class="form-control" name="testCategory" type="text" value="<?php echo $res['test_category']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
											<div class="form-group">
												<label>Amount<span class="text-danger">*</span></label>
												<input type="text" name="amount" class="form-control" value="<?php echo $res['test_amount']; ?>" required>
											</div>
										</div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $test_id; ?>" >
                            <input type="hidden" name="ref" value="<?php echo $res['test_ref']; ?>" >
                            <div class="m-t-20 text-center">
                                <button class="btn submit-btn" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php 
             }
            }
            }
            else
            {
                echo"patient ID not found";
            }
             ?>
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


<!-- edit-patient24:07-->
</html>
