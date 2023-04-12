<?php
include 'fabinde.php';

function testName($tst_ref)
{
    include 'fabinde.php';

    $test_details = "";

    $test_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$tst_ref'");
    if (mysqli_num_rows($test_query) >= 1) {
        while ($rest = mysqli_fetch_assoc($test_query)) {
            $test_details =  $rest['test_type'];
        }
    }
    return $test_details;
}

function insertTransaction($patientRef,$amount,$thirdParty)
{
    include 'fabinde.php';
    $insert_st = "";
    $patientName = "";
    $appointmentNo = "";
    $transaction_date = date('d-m-Y');
    $paymentStatus = "";
    $invoice = "";
    $tests = "";
    $searchPatient = mysqli_query($con,"SELECT * FROM appointments WHERE patient_ref_no='$patientRef' ");
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

if(isset($_POST['from_date']))
{
    $start_date = mysqli_real_escape_string($con,$_POST['from_date']);
    $ending_date = mysqli_real_escape_string($con,$_POST['to_date']);
    $paymentStatus = mysqli_real_escape_string($con,$_POST['paymentStatus']);

    $queryTransaction = mysqli_query($con,"SELECT * FROM transactions WHERE transaction_date='$start_date' OR transaction_date='$ending_date' AND transaction_payment='$paymentStatus' ");
    if(mysqli_num_rows($queryTransaction) >= 1)
    {
        $allTestNames = "";
        while($search = mysqli_fetch_assoc($queryTransaction))
        {
            $testNames = unserialize($search['test_type']);
            if(is_array($testNames))
            {
                foreach($testNames as $names)
                    {
                        $allTestNames= $allTestNames.",".testName($names);
                    }
            }
            else
                {
                    $allTestNames = testName($testNames);
                }
            echo"
            <td>1</td>
            <td><a href='invoice-view.php?invoiceRef=".$search['transaction_invoice']."'>".$search['transaction_invoice']."</a></td>
            <td>".$search['patient_name']."</td>
            <td>".$allTestNames."</td>
                <td><".$search['transaction_date']."</td>
                <td>N".$result['amount']."</td>
                <td><span class='custom-badge status-green'>".$result['transaction_payment']."</span></td>
                <td class='text-right'>
                <div class='dropdown dropdown-action'>
                <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                <div class='dropdown-menu dropdown-menu-right'>
                <!--<a class='dropdown-item' href='edit-invoice.html'><i class='fa fa-pencil m-r-5'></i> Edit</a> -->
                <a class='dropdown-item' href='invoice-view.html'><i class='fa fa-eye m-r-5'></i> View</a>
                <a class='dropdown-item' href='#'><i class='fa fa-file-pdf-o m-r-5'></i> Download</a>
				<a class='dropdown-item' href='#' data-toggle='modal' data-target='#delete_invoice'><i class='fa fa-trash-o m-r-5'></i> Delete</a>
                </div>
                </div>
                </td>
            ";
        }
    }
    else
    {
        echo "transactions not found";
    }
}
?>