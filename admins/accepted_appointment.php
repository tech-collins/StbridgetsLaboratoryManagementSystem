<?php
include 'fabinde.php';

$sample = "sample collected";
$sample_test = 0;
$testQuery = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_status='$sample'");
if(mysqli_num_rows($testQuery) >= 1)
{
    $sample_test = mysqli_num_rows($testQuery);
}
else
{
    $sample_test= 0;
}
?>

<h3><?php echo $sample_test; ?></h3>