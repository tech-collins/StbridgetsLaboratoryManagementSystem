<?php 
include 'fabinde.php';


$query_appointment = mysqli_query($con, "SELECT * FROM appointments");
$total_appointments = 0;
if(mysqli_num_rows($query_appointment) >= 1)
{

    $total_appointments = mysqli_num_rows($query_appointment);
}
else
{
    $total_appointments = 0;
}
?>

<h3><?php echo $total_appointments; ?></h3>