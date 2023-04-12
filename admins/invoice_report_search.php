<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';




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
                        <h4 class="page-title">Transaction Records</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <!--<a href="create-invoice.html" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Create New Invoice</a>-->
                    </div>
                </div>
                <hr>
                <?php 
                    if(isset($_POST["from"]))
                    {
                        $from = mysqli_real_escape_string($con,$_POST["from"]);
                        $to = mysqli_real_escape_string($con,$_POST["to"]);
                        $status = mysqli_real_escape_string($con,$_POST["status"]);
                ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Transaction ID</th>
                                        <th>Patient</th>
                                        <th>Test</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="searchResult">
                                    <?php
                                    $query_transaction = mysqli_query($con, "SELECT * FROM transactions WHERE transaction_date  BETWEEN '$from' AND '$to' ");
                                    if($query_transaction)
                                    {
                                        if (mysqli_num_rows($query_transaction) >= 1) 
                                    {
                                        while ($result = mysqli_fetch_assoc($query_transaction)) {
                                    ?>
                                            <tr>
                                                <td>1</td>
                                                <td><a href="invoice-view.php?invoiceRef=<?php echo $result['transaction_invoice']; ?>&ref=<?php echo $result['ref_number']; ?>"><?php echo $result['transaction_invoice']; ?></a></td>
                                                <td><?php echo $result['patient_name']; ?></td>
                                                <td>
                                                    <?php
                                                    $testNames = unserialize($result['test_type']);
                                                    if (is_array($testNames)) {
                                                        foreach ($testNames as $names) {
                                                            echo testNameOnly($names) . "<br>";
                                                        }
                                                    } else {
                                                        echo $testNames;
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $result['transaction_date']; ?></td>
                                                <td>N<?php echo $result['amount']; ?></td>
                                                <td><span class="custom-badge status-green">Paid</span></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <!--<a class="dropdown-item" href="edit-invoice.html"><i class="fa fa-pencil m-r-5"></i> Edit</a> -->
                                                            <a class="dropdown-item" href="invoice-view.html"><i class="fa fa-eye m-r-5"></i> View</a>
                                                            <a class="dropdown-item" href="#"><i class="fa fa-file-pdf-o m-r-5"></i> Download</a>
                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_invoice"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                     }else
                                     {
                                         echo "<h4>transaction for the stipulated date not available</h4>";
                                     }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    else
                    {
                        echo "<h4>transaction not in database</h4>";
                    }
                ?>
            </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script type="text/javascript">
        $(document).ready(function(e) {
                $("#submit").click(function() {

                    var fromDate = $("#from").val();
                    var toDate = $("#to").val();
                    var searchStatus = $("#status").val();
                    $.ajax({
                            type: 'POST',
                            url: 'transaction_queries.php',
                            data: {
                                from_date: fromDate,
                                to_date: toDate,
                                paymentStatus: searchStatus
                            },
                        })
                        .done(function(msg) {
                            alert("Data Saved: " + msg);
                        });

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