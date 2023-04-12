<?php 
include 'fabinde.php';

$date = date('Y-m-d');

$check = mysqli_query($con,"SELECT * FROM transactions WHERE transaction_date='$date' ");
$today_revenu = 0;
if(mysqli_num_rows($check) >= 1)
{
    while($re = mysqli_fetch_assoc($check))
    {
        $today_revenu = $today_revenu + intval($re['amount']);
    }
}
?>

<h4>Todays's Total Revenue &#8358; <?php echo $today_revenu; ?>.00</h4>

<?php

?>