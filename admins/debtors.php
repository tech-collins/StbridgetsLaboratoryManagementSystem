<?php
session_start();
include 'login_check.php';
include 'fabinde.php';


?>

<!DOCTYPE html>
<html lang="en">


<!-- payments23:25-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Laboratory Management System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
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
        ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Debtors</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Patient</th>
                                        <th>Payment</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalAmount = 0;
                                    $debts = "no";
                                    $query_tans = mysqli_query($con, "SELECT * FROM transactions WHERE transaction_payment='$debts'");
                                    if (mysqli_num_rows($query_tans)) {
                                        while ($result = mysqli_fetch_assoc($query_tans)) {
                                    ?>
                                            <tr>
                                                <td><a href="invoice-view.php?invoiceRef=<?php echo $result['transaction_invoice']; ?>&ref=<?php echo $result['ref_number']; ?>"><?php echo $result['transaction_invoice']; ?></a></td>
                                                <td>
                                                    <h2><a href="#"><?php echo $result['patient_name']; ?></a></h2>
                                                </td>
                                                <td><?php echo $result['transaction_payment']; ?></td>
                                                <td><?php echo $result['transaction_date']; ?></td>
                                                <td>&#8358;<?php echo $result['amount']; ?></td>
                                            </tr>
                                    <?php
                                            $totalAmount = $totalAmount + intval($result['amount']);
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td style="color: green;"><b>TOTAL</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>&#8358;<?php echo $totalAmount; ?></td>
                                    </tr>

                                </tbody>
                            </table>
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
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- payments23:25-->

</html>