<?php


function insertTransaction($patientRef,$amount,$payment,$thirdParty)
{
    include 'fabinde.php';
    $insert_st = "";
    $patientName = "";
    $appointmentNo = "";
    $transaction_date = date('Y-m-d');
    $paymentStatus = "";
    $invoice = "";
    $tests = "";
    $searchPatient = mysqli_query($con,"SELECT * FROM appointments WHERE patient_ref_no='$patientRef' ");
    if($searchPatient)
    {
        if(mysqli_num_rows($searchPatient) > 0)
        {
            while($result = mysqli_fetch_assoc($searchPatient))
            {
                $patientName = $result['patient_name'];
                $appointmentNo = $result['appointment_no'];
                $tests = $result['test_type'];
                $paymentStatus = $result['payment'];
            }
        }
    }
    else
    {}
    
    $check_transaction = mysqli_query($con,"SELECT * FROM transactions");
    if(mysqli_num_rows($check_transaction) == 0 || mysqli_num_rows($check_transaction) == false)
    {
        $invoice = "INV".substr($transaction_date,6)."-01";
    }
    else
    {
        $numbs = mysqli_num_rows($check_transaction);
        $invoice = "INV".substr($transaction_date,6).$numbs;
    }
    $insert_transaction = mysqli_query($con,"INSERT INTO transactions(patient_name,ref_number,transaction_invoice,test_type,appointment_no,amount,transaction_date,transaction_payment,third_party_payment) VALUES('$patientName','$patientRef','$invoice','$tests','$appointmentNo','$amount','$transaction_date','$paymentStatus','$thirdParty')");
    if($insert_transaction)
    {
        $insert_st = "inserted";
    }

    return $insert_st;
}
?>