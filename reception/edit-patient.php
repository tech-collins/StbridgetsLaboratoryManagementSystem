<?php
session_start();
include 'login_check.php';
include 'fabinde.php';

$insert_status = "";

if(isset($_POST["status"]))
{
    $insert_status = $_POST["status"];
}

if(isset($_POST["submit"]))
{
    $firstname = mysqli_real_escape_string($con,$_POST["firstname"]);
    $surname = mysqli_real_escape_string($con,$_POST["lastname"]);
    $gender = mysqli_real_escape_string($con,$_POST["gender"]);
    $dob = mysqli_real_escape_string($con,$_POST["dob"]);
    $address = mysqli_real_escape_string($con,$_POST["address"]);
    $city = mysqli_real_escape_string($con,$_POST["city"]);
    $state = mysqli_real_escape_string($con,$_POST["state"]);
    $phone_number = mysqli_real_escape_string($con,$_POST["phone"]);
    $photo = mysqli_real_escape_string($con,$_FILE["photo"]["name"]);
    $patient_id = mysqli_real_escape_string($con,$_POST["id"]);
    $empty_picture = "none";
    $passport_name = "";
    $folder = "";
    $extension = "";
    $passport_file  = "";
    if(!empty($photo))
    {
    $passport_name = basename($photo);
    $folder = '../patientPassport/' . $passport_name;
    $extension = pathinfo($passport, PATHINFO_EXTENSION);
    $passport_file = $_FILES['photo']['tmp_name'];

       if(!in_array($extension, ['jpg', 'jpeg','png','PNG']))
      {
           $insert_status = "only jpg, jpeg and png picture extension are accepted";
      }
      else
      {
        if(move_uploaded_file($passport_file,$folder))
        {
            $insert = mysqli_query($con,"UPDATE patients SET patient_surname='".$surname."', patient_firstname='".$firstname."', gender='".$gender."', age='".$dob."', phone_number='".$phone_number."', address='".$address."', city='".$city."', patient_state='".$state."', patient_passport='".$photo."' WHERE id='$patient_id'");
            if($insert)
            {
                $insert_status = "<h5 style='background-color: rgba(12, 184, 182, 0.91);'>patient details edited successfully</h5>";
                header("location:patients.php?status=$insert_status");
            }
            else
            {
                $insert_status = "<h5 style='color: red;'>patient details Not edited successfully</h5>";
            }
        }
      }

    }
    else
    {
        $inserting = mysqli_query($con,"UPDATE patients SET patient_surname='".$surname."', patient_firstname='".$firstname."', gender='".$gender."', age='".$dob."', phone_number='".$phone_number."', address='".$address."', city='".$city."', patient_state='".$state."', patient_passport='".$empty_picture."' WHERE id='$patient_id'");
            if($inserting)
            {
                $insert_status = "patient details edited successfully";
                header("location:patients.php?status=$insert_status");
            }
            else
            {
                $insert_status = "patient details Not edited successfully";
            }
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

        if(isset($_GET['id']))
        {
            $patient_id = $_GET['id'];
            $surname = "";
            $firstname = "";
            $dob = "";
            $address = "";
            $city = "";
            $state = "";
            $gender = "";
            $phone = "";
            $find = mysqli_query($con,"SELECT * FROM patients WHERE id='$patient_id'");
            if($find)
            {
                $ss = "found";
                while($res = mysqli_fetch_assoc($find))
                {
           
        ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Patient</h4>
                        <h5><?php echo $insert_status; ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" action="#">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="firstname" type="text" value="<?php echo $res['patient_firstname']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" name="lastname" type="text" value="<?php echo $res['patient_surname']; ?>" required>
                                    </div>
                                </div>
								<div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="">
                                            <input type="date" name="dob" class="form-control" value="<?php echo $res['age']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control select" name="gender" required>
                                            <option>....</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
											<div class="form-group">
												<label>City</label>
												<input type="text" name="city" class="form-control" value="<?php echo $res['city']; ?>" required>
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
												<label>State</label>
												<input type="text" name="state" class="form-control" value="<?php echo $res['patient_state']; ?>" required>
											</div>
										</div>
                                        <div class="col-sm-6 col-md-6 col-lg-12">
										<div class="col-sm-12">
											<div class="form-group">
												<label>Address</label>
												<input type="text" name="address" class="form-control" value="<?php echo $res['address']; ?>" required>
											</div>
										</div>
										</div>
                                
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input class="form-control" name="phone" type="text" value="<?php echo $res['phone_number']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group">
										<label>Avatar</label>
										<div class="profile-upload">
											<div class="upload-img">
												<img alt="" src="assets/img/user.jpg">
											</div>
											<div class="upload-input">
												<input type="file" name="photo" class="form-control">
											</div>
										</div>
									</div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $patient_id; ?>" >
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
			<div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box">
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Richard Miles </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item new-message">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">John Doe</span>
                                            <span class="message-time">1 Aug</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Tarah Shropshire </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Mike Litorus</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Catherine Manseau </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">D</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Domenic Houston </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">B</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Buster Wigton </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Rolland Webber </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Claire Mapes </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Melita Faucher</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Jeffery Lalor</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">L</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Loren Gatlin</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Tarah Shropshire</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.html">See all messages</a>
                    </div>
                </div>
            </div>
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
