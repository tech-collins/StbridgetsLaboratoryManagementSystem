<?php
include 'fabinde.php';
include 'test_dictionary.php';

if(isset($_POST["patient_id"]))
{
    $date = date("m-d-Y h:i:s");
    $day = date("m-d-Y");
    $patient_name = "";
    $patient_number = "";
    $test = "";
    $test_number = "";
    $status = "";
    $ref_number = "";
    $dob = "";
    $gender = "";
    $appointment_status = "pending";
    $payment = "paid";
    $pateint_id = mysqli_real_escape_string($con,$_POST["patient_id"]);
    $find_patient = mysqli_query($con,"SELECT * FROM patients WHERE id='$pateint_id'");
    $appointmentNumber = "";
    if($find_patient)
    {
        while($result = mysqli_fetch_assoc($find_patient))
        {
            if($result['payment_status'] == "yes")
            {
                $patient_name = $result['patient_surname'] . " " . $result['patient_firstname'];
                $test_number = $result['number_of_test'];
                $test = $result['test'];
                $ref_number = $result['patient_ref_number'];
                $dob = $result['age'];
                $gender = $result['gender'];
                $patient_number = $result['phone_number'];
            }
            else
            {
                echo "test has not been paid for";
            }
            
        }
    }
    else{
        echo"Patient ID not found";
    }

    $serial_test = serialize($test_number);
    //$test_number = "Wider";

    $check_appointment = mysqli_query($con,"SELECT * FROM appointments");
    if (mysqli_num_rows($check_appointment) == false || mysqli_num_rows($check_appointment) == 0) {
        $appointmentNumber = "APT-" . $day . "-0";
    } else {
        $row_num = mysqli_num_rows($check_appointment);
        $appointmentNumber = "APT-" . $day . "-" . $row_num;
    }

    $appointment_list = mysqli_query($con,"INSERT INTO appointments(test_category,test_type,patient_name,dob,gender,phone,appointment_no,patient_ref_no,appointment_date,appointment_status,payment) VALUES('$test','$serial_test','$patient_name','$dob','$gender','$patient_number','$appointmentNumber','$ref_number','$date','$appointment_status','$payment')");

    if($appointment_list)
    {
        echo"Patient Queued Successfully";
    }
    else
    {
        //echo "patient not queued..something went wrong";
    }
}

if(isset($_POST["status_con"]) && isset($_POST["status_id"]))
{
    $status = mysqli_real_escape_string($con,$_POST["status_con"]);
    $id = mysqli_real_escape_string($con,$_POST["status_id"]);
    if($status == "sample collected")
    {
        $find_p = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE id ='".$id."' ");
        if($find_p)
        {
            echo "<h5 style='color: green;'>appointment status update to sample"." ".$status."</h5>";
        }
        else
        {
            echo "<h5 style='color: red;'>status not updated...something went wrong</h5>";
        }
    }
    elseif($status == "finish")
    {
        $find_ps = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE id ='".$id."' ");
        if($find_ps)
        {
            echo "<h5 style='color: green;'>laboratory test status updated to "." ".$status."</h5>";
        }
        else
        {
            echo "<h5 style='color: red;'>laboratory test status not updated...something went wrong</h5>";
        }
    }
    else
    {}
}

if(isset($_POST["removeId"]))
{
    $id_remove = mysqli_real_escape_string($con,$_POST["removeId"]);
    $remove_query = mysqli_query($con,"SELECT * FROM appointments WHERE id='$id_remove'");
    if($remove_query)
    {
        echo"appointment removed successfully";
    }
    else
    {
        echo"appointment Not removed...something went wrong";
    }
}

?>