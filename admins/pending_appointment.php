<?php 
include 'fabinde.php';


$sst = "pending";
$query_pending = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_status='$sst'");
$pending_num = 0;
if(mysqli_num_rows($query_pending) >= 1)
{

        $pending_num = mysqli_num_rows($query_pending);
}
else
{
    $pending_num = 0;
}
?>

<h3><?php echo $pending_num; ?></h3>