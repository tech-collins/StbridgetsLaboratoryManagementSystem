<?php
session_start();
//include 'login_check.php';
include 'fabinde.php';

/*
$result_array = "";
$status;
$patientReferenceNo = "";
$patientReferenceNo_status;
$result_status = "updated";
$allpatientRefs;
$uncomplete_ref;
$checking_result = mysqli_query($con,"SELECT * FROM test_results WHERE result_status='$result_status'");
if(mysqli_num_rows($checking_result) >= 1)
{
    $result_array = array(mysqli_num_rows($checking_result));
    $allpatientRefs = array(mysqli_num_rows($checking_result));
    $counting = 1;
    while($result = mysqli_fetch_assoc($checking_result))
    {
        $result_array[$counting] = $result['test_result_ref'];
        $allpatientRefs[$counting] = $result['patient_ref_number'];
        ++$counting;
    }
}
$anoda_counter = 0;
$ref_counting = 0;
echo $ref_counting."<br>";
$noResult = "no result";
if(is_array($result_array ))
{
    foreach($allpatientRefs as $checker)
    {
        $refing = $allpatientRefs[$ref_counting];
        //echo $refing."<br>";
        //echo $checker."<br>";
        $patientReferenceNo_status = "";
        $checking_result1 = mysqli_query($con,"SELECT * FROM test_results WHERE patient_ref_number='$checker' AND result_status='$noResult'");
        if($checking_result1)
        {        $patientReferenceNo = array(mysqli_num_rows($checking_result1));
            $uncomplete_ref = array(mysqli_num_rows($checking_result1));
            
            while($checking = mysqli_fetch_assoc($checking_result1))
            {
                if($checking['test_result'] == "none")
                {
                    //break;
                    //echo $ref_counting."<br>";
                    $cff = 0;
                    if($ref_counting > 1)
                    {
                        echo $ref_counting;
                        $cff = $ref_counting - 1;
                        if($uncomplete_ref[$cff] != $checking['patient_ref_number'])
                        {
                            $uncomplete_ref[$ref_counting] = $checking['patient_ref_number'];
                        }
                    }
                    else
                    {
                        $uncomplete_ref[$ref_counting] = $checking['patient_ref_number'];
                    }

                    echo $uncomplete_ref[$ref_counting]."<br>";
                }
                else
                {
                    $patientReferenceNo_status = $checking['patient_ref_number'];
                }
            }
            if($patientReferenceNo_status != "none" && !empty($patientReferenceNo_status))
            {
            // echo $patientReferenceNo_status.",";
                $patientReferenceNo[$anoda_counter] = $patientReferenceNo_status;
            }
    
            ++$anoda_counter;
            ++$ref_counting;
        }

    }
}
else
{}
$fr = count($uncomplete_ref);
echo $fr."<br>";
//echo $uncomplete_ref[0];
//echo $uncomplete_ref[1];
foreach($uncomplete_ref as $todel)
{
    //echo $todel."<br>";
}
$result_patientReferenceNo = array_diff_key($patientReferenceNo, array_flip($uncomplete_ref));

if(is_array($result_patientReferenceNo))
{
    foreach($result_patientReferenceNo as $updatingRef)
    {
        //echo "<br>".$updatingRef;
        $updates = "finish";
        $update_appointment = mysqli_query($con,"UPDATE appointments SET appointment_status='".$updates."' WHERE patient_ref_no='".$updatingRef."' ");
        if($update_appointment)
        {
            //echo "collated";
        }
        else
        {
        // echo "not collated";
        }
    }
}
else
{}
*/

function showAge($dfb)
{
    $birth_date = strtotime($dfb);
    $now = time();
    $age = $now - $birth_date;
    $new_age = intval($age / 60 / 60 / 24 / 365.25);
    return $new_age;
    //$dd = stripos(".",$a,0 );
    //$new_age = substr($a,$dd);
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- invoices23:24-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Laboratory Management System</title>
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
            <div class="content" style=" box-shadow: 0 1px 2px rgba(0,0,0,0.07), 
                0 2px 4px rgba(0,0,0,0.07), 
                0 4px 8px rgba(0,0,0,0.07), 
                0 8px 16px rgba(0,0,0,0.07),
                0 16px 32px rgba(0,0,0,0.07), 
                0 32px 64px rgba(0,0,0,0.07);">
                <div class="row">
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">View Patient Test Results</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <!--<a href="create-invoice.html" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Create New Invoice</a>-->
                    </div>
                </div>
                <div class="row filter-row">
                    <div class="col-md-6 col-md-6">
                        <div class="form-group form-focus">
                            <label class="focus-label">enter patient phone number</label>
                            <!--<div class="">  -->
                                <input class="form-control " type="text" placeholder="" required>
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <a href="#" class="btn btn-success btn-block" onclick="displayUser()"> Search </a>
                    </div>
                </div>
                <div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Appointment Date</th>
                                        <th>Time Of Appointment</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody id="txtHint">
									<?php
                                    $sample = "finish";
									$appointment = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_status='$sample' ORDER BY appointment_date");
                                    if(mysqli_num_rows($appointment) >= 1)
                                    {
                                        while($res = mysqli_fetch_assoc($appointment))
                                        { 
                                    ?>
									<tr>
										<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> <?php echo $res['patient_name']; ?></td>
										<td><?php echo showAge($res['dob']); ?></td>
										<td><?php echo $res['gender']; ?></td>
										<td><?php echo substr($res['appointment_date'],0,-8); ?></td>
										<td><?php echo substr($res['appointment_date'],12,-3); ?></td>
										<td><span class="custom-badge status-green"><?php echo $res['appointment_status']; ?></span></td>
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="all_result_view.php?ref=<?php echo $res['patient_ref_no'];?>&appointmentNo=<?php echo $res['appointment_no'];?>"><i class="fa fa-pencil m-r-5"></i> View Test</a>
												</div>
											</div>
										</td>
									</tr>
                                    <?php
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
        function displayUser()
        {
            var appNu = document.querySelector('input').value;
            $('#txtHint').html('');
            $.ajax({
                type: 'post',
                url: 'get_user.php',
                data: {
                    phone_id: appNu,
                },
                success: function(data) {
                    $('#txtHint').html(data);
                }
            })
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