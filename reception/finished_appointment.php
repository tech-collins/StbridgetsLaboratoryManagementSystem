<?php
include 'fabinde.php';

$finished = "finish";
$finished_test = 0;
$testQuery = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_status='$finished'");
if(mysqli_num_rows($testQuery) >= 1)
{
    $finished_test = mysqli_num_rows($testQuery);
}
else
{
    $finished = 0;
}
?>

<h3><?php echo $finished_test; ?></h3>