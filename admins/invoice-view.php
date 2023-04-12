<?php 
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';

$patientRef = $_GET["ref"];
$invoiceRef = $_GET["invoiceRef"];

function prizeOnly($reference)
{
    include 'fabinde.php';

    $amount = 0;
    $test_query = mysqli_query($con,"SELECT test_amount FROM test_categories WHERE test_ref='$reference'");
    while($results = mysqli_fetch_assoc($test_query))
        {
            $amount = intval($results['test_amount']);
        }

        return $amount;
}

?>

<!DOCTYPE html>
<html lang="en">


<!-- invoice-view24:07-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Laboratory Management System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
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
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Invoice</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">
                            <a href="invoice_to_pdf.php?ref=<?php echo $patientRef; ?>&invoiceRef=<?php echo $invoiceRef; ?>" class="btn btn-white">PDF</a>
                            <!--<button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>  -->
                        </div>
                    </div>
                </div>
                <?php
                if(isset($_GET["invoiceRef"]))
                {
                    $patientRef = $_GET["ref"];
                    $invoiceRef = $_GET["invoiceRef"];
                    $patient_name = "";
                    $appointmentNumber = "";
                    $appointmentDate = "";
                    $patientNumber = "";
                    $tests = "";
                    $gender = "";
                    $test_amount = "";
                    $transactionPayment = "";
                    $thirdParty = "";
                    $patient_search = mysqli_query($con,"SELECT * FROM appointments WHERE patient_ref_no='$patientRef' ");
                    if($patient_search)
                    {
                        while($result = mysqli_fetch_assoc($patient_search))
                        {
                            $patient_name = $result['patient_name'];
                            $appointmentNumber = $result['appointment_no'];
                            $appointmentDate = $result['appointment_date'];
                            $patientNumber = $result['phone_no'];
                            $tests = unserialize($result['test_type']);
                            $gender = $result['gender'];
                        }
                    }

                    $transaction_search = mysqli_query($con,"SELECT * FROM transactions WHERE ref_number='$patientRef' ");
                    if($transaction_search)
                    {
                        while($trans_result = mysqli_fetch_assoc($transaction_search))
                        {
                            $test_amount = $trans_result['amount'];
                            $thirdParty = $trans_result['third_party_payment'];
                            $transactionPayment = $trans_result['transaction_payment'];
                        }
                    }
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row custom-invoice">
                                    <div class="col-6 col-sm-6 m-b-20">
                                        <img src="assets/img/stbridget.jpg" class="inv-logo" alt="">
                                        <ul class="list-unstyled">
                                            <li>St Bridget Radiological & Laboratory Centre</li>
                                            <li>No 4 Iyobosa Street,</li>
                                            <li>Off New Lagos Road,</li>
                                            <li>Benin City, Edo State.</li>
                                            <li>Tel No: 09155283008, 08051112578, 07030151491</li>
                                        </ul>
                                    </div>
                                    <div class="col-6 col-sm-6 m-b-20">
                                        <div class="invoice-details">
                                            <h3 class="text-uppercase">Invoice: <?php echo $invoiceRef; ?></h3>
                                            <ul class="list-unstyled">
                                                <li>Date: <span><?php echo $appointmentDate; ?></span></li>
                                                <!-- <li>Due date: <span>November 25, 2017</span></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6 m-b-20">
										
											
                                            <?php 
                                            if($thirdParty != "no" && !empty($thirdParty))
                                            {
                                            ?>
                                            <h5>Invoice to:</h5>
                                            <ul class="list-unstyled">
                                                <li>
													<h5><strong><?php echo $thirdParty; ?></strong></h5>
												</li>
												<li>
													<h5>Patient Name:<strong><?php echo $patient_name; ?></strong></h5>
												</li>
												<li><span><?php echo $gender; ?></span></li>
												<li><?php echo $patientNumber; ?></li>
												<li><strong>Appointment No: <?php echo $appointmentNumber; ?></strong></li>
											</ul>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <h5>Invoice to:</h5>
                                            <ul class="list-unstyled">
												<li>
													<h5><strong><?php echo $patient_name; ?></strong></h5>
												</li>
												<li><span><?php echo $gender; ?></span></li>
												<li><?php echo $patientNumber; ?></li>
												<li><strong>Appointment No: <?php echo $appointmentNumber; ?></strong></li>
											</ul>
                                            <?php
                                            }
                                            ?>
										
                                    </div>
                                    <div class="col-sm-6 col-lg-6 m-b-20">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>TEST</th>
                                                <th>AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $counter = 1;
                                        foreach($tests as $tsts)
                                        {
                                        ?>
                                            <tr>
                                                <td><?php echo $counter; ?></td>
                                                <td><?php echo testNameOnly($tsts); ?></td>
                                                <td><?php echo prizeOnly($tsts); ?></td>
                                            </tr>
                                            <?php ++$counter; ?>
                                        <?php
                                        
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <div class="row invoice-payment">
                                        <div class="col-sm-7">
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="m-b-20">
                                                <h6>Total due</h6>
                                                <div class="table-responsive no-border">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th>Total:</th>
                                                                <td class="text-right">N<?php echo $test_amount; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="invoice-info">
                                        <h5>Other information</h5>
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum ligula, cursus blandit risus. Maecenas eget metus non tellus dignissim aliquam ut a ex. Maecenas sed vehicula dui, ac suscipit lacus. Sed finibus leo vitae lorem interdum, eu scelerisque tellus fermentum. Curabitur sit amet lacinia lorem. Nullam finibus pellentesque libero, eu finibus sapien interdum vel</p>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                }
                else
                {
                    echo "<h4>Invoice not Found</h4>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- invoice-view24:07-->
</html>