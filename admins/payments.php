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
                        <h4 class="page-title">REVENUE</h4>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $today_revenu = 0;
                        $date = date('Y-m-d');

                        $check = mysqli_query($con,"SELECT * FROM transactions WHERE transaction_date='$date' ");
                        $today_revenu = 0;
                        if(mysqli_num_rows($check) >= 1)
                        {
                            while($re = mysqli_fetch_assoc($check))
                            {
                                $today_revenu = $today_revenu + intval($re['amount']);
                            }
                        }
                        else
                        {
                            $today_revenu = 0;
                        }
                    ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg1">&#8358;</span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $today_revenu; ?></h3>
                                <span class="mx-4" style="color: #009efb;">Today's</span>
                                <span class="" style="color: #009efb;">Revenue <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <?php
                        $today_debt = 0;
                        $date = date('Y-m-d');
                        $debt = "no";

                        $check_debt = mysqli_query($con,"SELECT * FROM transactions WHERE transaction_date='$date' AND transaction_payment='$debt'");
                        $today_revenu = 0;
                        if(mysqli_num_rows($check_debt) >= 1)
                        {
                            while($re = mysqli_fetch_assoc($check_debt))
                            {
                                $today_debt = $today_debt + intval($re['amount']);
                            }
                        }
                        else
                        {
                            $today_debt = 0;
                        }
                        ?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg2" style="background-color: #ffbc35;">&#8358;</span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $today_debt; ?></h3>
                                <span class="mx-4" style="color: #ffbc35;">Today's</span>
                                <span class="" style="color: #ffbc35;">Debt <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <?php
                        $total_debt = 0;
                        $date = date('Y-m-d');
                        $debt = "no";

                        $check_total_debt = mysqli_query($con,"SELECT * FROM transactions WHERE transaction_payment='$debt'");
                        if(mysqli_num_rows($check_total_debt) >= 1)
                        {
                            while($re = mysqli_fetch_assoc($check_total_debt))
                            {
                                $total_debt = $total_debt + intval($re['amount']);
                            }
                        }
                        else
                        {
                            $total_debt = "none";
                        }
                            ?>
                            <span class="dash-widget-bg3">&#8358;</span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $total_debt; ?></h3>
                                <span class="mx-4" style="color: #7a92a3;">Total</span>
                                <span class="" style="color: #7a92a3;">Debt <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <?php
                        $total_rev = 0;
                        $debt = "yes";

                        $check_total_rev = mysqli_query($con,"SELECT * FROM transactions WHERE transaction_payment='$debt'");
                        if(mysqli_num_rows($check_total_rev) >= 1)
                        {
                            while($re = mysqli_fetch_assoc($check_total_rev))
                            {
                                $total_rev = $total_rev + intval($re['amount']);
                            }
                        }
                        else
                        {
                            $total_rev = "none";
                        }
                        ?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg4" style="background-color: #55ce63;">&#8358;</span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $total_rev; ?></h3>
                                <span class="mx-4" style="color: #55ce63;">Total</span>
                                <span class="" style="color: #55ce63;">Revenue<i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
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
                                        <th>Paid Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalAmount = 0;
                                    $query_tans = mysqli_query($con, "SELECT * FROM transactions");
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
                                    <tr><td style="color: green;"><b>TOTAL</b></td><td></td><td></td><td></td><td>&#8358;<?php echo $totalAmount; ?></td></tr>
                                    
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