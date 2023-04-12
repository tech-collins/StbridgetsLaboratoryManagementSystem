<?php
session_start();
include 'login_check.php';
include 'fabinde.php';

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
    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
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
									$appointment = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_status='$sample' ORDER BY appointment_date DESC");
                                    if($appointment)
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
													<a class="dropdown-item" href="view-appointment.php?ref='<?php echo $res['patient_ref_no'];?>'"><i class="fa fa-pencil m-r-5"></i> View</a>
													<a class="dropdown-item" href="#" onclick="removeAppointment('<?php echo $res['id']; ?>')" data-toggle="" data-target=""><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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