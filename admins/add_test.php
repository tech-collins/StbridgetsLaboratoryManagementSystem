<?php
session_start();
include 'login_check.php';
include 'fabinde.php';

$insert_status = "";

if(isset($_GET["status"]))
{
    $insert_status = $_GET["status"];
}

if (isset($_POST["testName"])) {
    $test_name = mysqli_real_escape_string($con, $_POST["testName"]);
    $test_prize = mysqli_real_escape_string($con, $_POST["testPrize"]);
    $test_category = mysqli_real_escape_string($con, $_POST["testCategory"]);
    $test_ref = "";
    $date = date('Y-m-d');

    $check = mysqli_query($con, "SELECT test_type FROM test_categories WHERE test_type='$test_name' AND test_category='$test_category'");
    if (mysqli_num_rows($check) >= 1) {
        $insert_status = "test already exists";
    } else {
        $test_ref_query = mysqli_query($con, "SELECT * FROM test_categories");
        if (mysqli_num_rows($test_ref_query) == false || mysqli_num_rows($test_ref_query) == 0) {
            //$cat = var_export(substr($test_category, 0, 3), true) . PHP_EOL;
            $cat = substr($test_category,0,3);
            $test_ref = $cat . "-00";
        } else {
            $num = mysqli_num_rows($test_ref_query);
            //$ss = var_export(substr($test_category, 0, 3), true) . PHP_EOL;
            $cat = substr($test_category,0,3);
            $test_ref = $cat . "-0" . $num;
        }
        $test_parameters = "none";
        $sub_parameters = "none";
        $insert = mysqli_query($con, "INSERT INTO test_categories(test_category,test_type,test_amount,date_added,test_ref,test_parameters,sub_parameters) VALUES('$test_category','$test_name','$test_prize','$date','$test_ref','$test_parameters','$sub_parameters')");
        if ($insert) {
            $insert_status = "<h6 style='color: green;'>test added succesfully</h6>";
        } else {
            $insert_status = "<h6 style='color: red;'>test NOT added succesfully...".$cat."something went wrong</h6>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- invoices23:24-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget- Laboratory Management System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
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
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Laboratory Tests</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <!--<a href="create-invoice.html" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Create New Invoice</a>-->
                    </div>
                </div>
                <hr>
                <div id="txtHint"><?php echo $insert_status; ?></div>
                <h5 class="page-title">Add Test</h5>
                <form method="post" action="#">
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus">
                                <label class="focus-label">test name</label>
                                <div class="">
                                    <input class="form-control floating" name="testName" type="text" id="testName" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus">
                                <label class="focus-label">prize</label>
                                <div class="">
                                    <input class="form-control floating" name="testPrize" type="number" id="testPrize" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus select-focus">
                                <label class="focus-label">category</label>
                                <select class="select floating form-control" name="testCategory" id="testCategory" required>
                                    <option value="Clinical Chemistry">Clinical Chemistry</option>
                                    <option value="Haematology">Haematology</option>
                                    <option value="MicroBiology/Parasitology">MicroBiology/Parasitology</option>
                                    <option value="Semen Analysis">Semen Analysis</option>
                                    <option value="laboratory">Clinical Laboratory</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <!--<a href="edit-test.php" type="submit" name="submit" id="submit" class="btn btn-success btn-block"> add </a>-->
                            <button type="submit" name="submit" id="submit" class="btn btn-success btn-block"> add </button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-title">Tests Summary</h4>
                        <div class="table-responsive">
                            <table class="table table-striped custom-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Test Name</th>
                                        <th>Test Category</th>
                                        <th>Created Date</th>
                                        <th>Test Ref. No</th>
                                        <th>Amount</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $test_display = mysqli_query($con, "SELECT * FROM test_categories");
                                    if ($test_display) {
                                        
                                    $index = 1;
                                        while ($test_show = mysqli_fetch_assoc($test_display)) {
                                            
                                    ?>
                                            <tr>
                                                <td><?php echo $index; ?></td>
                                                <td><a href="test-view.php?ref=<?php echo $test_show['test_ref']; ?>"><?php echo $test_show['test_type']; ?></a></td>
                                                <td><?php echo $test_show['test_category']; ?></td>
                                                <td><?php echo $test_show['date_added']; ?></td>
                                                <td><?php echo $test_show['test_ref']; ?></td>
                                                <td><?php echo $test_show['test_amount']; ?></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-test.php?id=<?php echo $test_show['id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                            <a class="dropdown-item" href="test-view.php?ref=<?php echo $test_show['test_ref']; ?>"><i class="fa fa-eye m-r-5"></i> View</a>
                                                            <a class="dropdown-item" href="" onclick="removeTest('<?php echo $test_show['id']; ?>')" data-toggle="" data-target=""><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                            ++$index;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script type="text/javascript">
        $(document).ready(function(e) {
                $("#submit").click(function() {

                    var nn = $("#testName").val();
                    var pp = $("#testPrize").val();
                    var cc = $("#testCategory").val();
                    $.ajax({
                            type: 'POST',
                            url: 'test-queries.php',
                            data: {
                                test_name: nn,
                                prize: pp,
                                category: cc
                            },
                            success: function(data) {
                        $('#txtHint').html(data);
                    }
                        });
                        /*.done(function(msg) {
                            alert("Data Saved: " + msg);
                        });*/

                });
            });
    </script>
 	<script>
		function removeTest(id)
        {
            if (confirm("are you sure, you want to delete this test...? ") == true) {
                $.ajax({
                    type: 'post',
                    url: 'test-queries.php',
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
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- invoices23:25-->

</html>