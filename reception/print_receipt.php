<?php
include '../print/example/interface/print_receipt.php';
include 'fabinde.php';

$oname = "";
$pref = "";

$querytings = mysqli_query($con,"SELECT * FROM patients");
if($querytings)
{
    if(mysqli_num_rows($querytings) >= 1)
    {
        while($result = mysqli_fetch_assoc($querytings))
        {
            $oname = $result['patient_surname'];
            $pref  = $result['patient_ref_number'];
        }
    }
}


letsPrint($oname,$pref);

?>