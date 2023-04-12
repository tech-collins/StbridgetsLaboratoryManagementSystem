<?php
session_start();
include 'login_check.php';
include 'fabinde.php';

$insert_status = "";

if (isset($_GET["status"])) {
	$insert_status = $_GET["status"];
}

?>

<!DOCTYPE html>
<html lang="en">


<!-- patients23:17-->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
	<title>St Bridget - Laboratory Management System</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
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
					<div class="col-sm-4 col-3">
						<h4 class="page-title">Patients</h4>
						<div style="align-content: center;" id="specificStatus" ><?php echo $insert_status; ?></div>
					</div>
					
					<div class="col-sm-8 col-9 text-right m-b-20">
						<!-- <a href="add-patient.php" class="btn btn btn-primary btn-rounded float-right" style="background-color: rgba(12, 184, 182, 0.91);"><i class="fa fa-plus"></i> Add Patient</a>-->
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Date of Birth</th>
										<th>Address</th>
										<th>Phone</th>
										<th>Date Registered</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query = mysqli_query($con, "SELECT * FROM patients");
									if ($query) {
										while ($result = mysqli_fetch_assoc($query)) {
									?>
											<tr>
												<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""><a href="view_patient.php?ref=<?php echo $result['patient_ref_number']; ?>"> <?php echo $result['patient_surname']." ".$result['patient_firstname']; ?></a></td>
												<td><?php echo $result['age']; ?></td>
												<td><?php echo $result['address']; ?></td>
												<td><?php echo $result['phone_number']; ?></td>
												<td><?php echo $result['date_registered']; ?></td>
												<td class="text-right">
													<div class="dropdown dropdown-action">
														<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="edit-patient.php?id=<?php echo $result['id']; ?>&ref=<?php echo $result['patient_ref_number']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
															<!-- <a class="dropdown-item" onclick="queuePatient('<?php //echo $result['patient_ref_number']; ?>')" href="#"><i class="fa fa-pencil m-r-5"></i> Queue</a> -->
															<a class="dropdown-item" href="#" onclick="removeAppointment('<?php echo $result['id']; ?>')" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
		<!--
		<div id="delete_patient" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Patient?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>

		</div>  -->
	</div>
	<div class="sidebar-overlay" data-reff=""></div>

	<script>
		function queuePatient(id)
		{
			$('#specificStatus').html('');
            $.ajax({
                type: 'post',
                url: 'patient-queries.php',
                data: {
                    patient_id: id
                },
                success: function(data) {
                    $('#specificStatus').html(data);
                }
            })
		}
	</script>
	<script>
		function removeAppointment(id)
        {
            if (confirm("are you sure, you want to remove this appointment? ") == true) {
                $.ajax({
                    type: 'post',
                    url: 'patient_queries.php',
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
	<script src="assets/js/jquery.slimscroll.js"></script>
	<script src="assets/js/select2.min.js"></script>
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/js/app.js"></script>
</body>


<!-- patients23:19-->

</html>