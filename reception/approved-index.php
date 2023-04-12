<?php

$app = "approved";
$display_approved = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_status='$app' LIMIT 6");
if ($display_approved) {
    while ($approved = mysqli_fetch_assoc($display_approved)) {
?>
        <div class="contact-cont">
            <div class="float-left user-img m-r-10">
                <a href="profile.php" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
            </div>
            <div class="contact-info">
                <span class="contact-name text-ellipsis"><?php echo $approved['patient_name']; ?></span>
                <span class="contact-date"><?php echo $approved['gender']; ?></span>
            </div>
        </div>
<?php
    }
}
?>