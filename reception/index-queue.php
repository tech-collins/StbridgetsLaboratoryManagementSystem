<?php
include 'fabinde.php';

$status = "pending";
$diplay_queue = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_status='$status' ORDER BY appointment_date ASC LIMIT 25");
if ($diplay_queue) {
    while ($feedback = mysqli_fetch_assoc($diplay_queue)) {
?>
        <tr>
            <td style="min-width: 200px;">
                <a class="avatar" href="profile.php">B</a>
                <h2><a href="view-appointment.php?ref=<?php echo $feedback['patient_ref_no']; ?>&appN=<?php echo $feedback['appointment_no']; ?>"><?php echo $feedback['patient_name']; ?> <span><?php echo $feedback['gender']; ?></span></a></h2>
            </td>
            <td>
                <h5 class="time-title p-0"><?php echo $feedback['test_category']; ?></h5>
                <p>Laboratory Test</p>
            </td>
            <td>
                <h5 class="time-title p-0">Timing</h5>
                <p><?php echo substr($feedback['appointment_date'], 10, -3); ?></p>
            </td>
            <td class="text-right">
                <a href="#" onclick="removeAppointment('<?php echo $feedback['id']; ?>')" class="btn btn-outline-primary take-btn">Remove</a>
            </td>
    <?php
    }
}
    ?>