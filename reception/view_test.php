<?php
session_start();
include 'login_check.php';
include 'fabinde.php';

?>


<!DOCTYPE html>
<html lang="en">


<!-- schedule23:20-->

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
        ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">View Test</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <!--<a href="add-schedule.html" class="btn btn btn-rounded float-right" style="color:white; background-color: rgba(12, 184, 182, 0.91);"><i class="fa fa-plus"></i> Add Schedule</a>-->
                    </div>
                </div>

                <div class="row filter-row">
                    <div class="col-md-6 col-md-6">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label" id="error">search</label>
                            <select class="form-control selectpicker select" data-live-search="true" name="testName[]" multiple required>
                                <?php
                                $query_test = mysqli_query($con, "SELECT * FROM test_categories");
                                while ($results = mysqli_fetch_assoc($query_test)) {
                                ?>
                                    <option value="<?php echo $results['test_ref']; ?>"><?php echo $results['test_type']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <a href="#" class="btn btn-success btn-block" onclick="displayTest()"> view </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Test Name</th>
                                        <th>Test Category</th>
                                        <th>Amount</th>
                                        <th>Date Added</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="txtHint">
                                    <?php
                                    $query_test = mysqli_query($con, "SELECT * FROM test_categories");
                                    if ($query_test) {
                                        $dd = 1;
                                        while ($result = mysqli_fetch_assoc($query_test)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $dd; ?></td>
                                                <td><?php echo strtoupper($result['test_type']); ?></td>
                                                <td><?php echo $result['test_category']; ?></td>
                                                <td>N<?php echo $result['test_amount']; ?></td>
                                                <td><?php echo $result['date_added']; ?></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="test-view.php?ref=<?php echo $result['test_ref']; ?>"><i class="fa fa-pencil m-r-5"></i> View</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                            ++$dd;
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

    <script>
        function displayTest() {
            var inp = document.querySelector('select').value;
                $('#txtHint').html('');
                $.ajax({
                    type: 'post',
                    url: 'test-queries.php',
                    data: {
                        category_view: inp,
                    },
                    success: function(data) {
                        $('#txtHint').html(data);
                    }
                });
        }
    </script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.slimscroll.js"></script>
	<script src="assets/js/select2.min.js"></script>
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/js/app.js"></script>
</body>


<!-- schedule23:21-->

</html>