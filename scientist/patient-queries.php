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
                $testNumber = $result['number_of_test'];
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
        $resultStatus = "";
        $result_ref = $appointmentNumber."-".$ref_number;
        $result_status = "no result";
        $test_result = "none";
        $test_result_date = "none";
        $test_number = unserialize($testNumber);
        $number_of_test = count($test_number);
        for($ii = 0; $ii <= $number_of_test; $ii++)
        {
            $test_number_ref = $test_number[$ii];
            $paraNumbers = numberOfTestParameters($test_number_ref);
            if($paraNumbers == "none")
            {
                $subPara_ref = numberOfSubTestParameters($test_number_ref);
                if($subPara_ref == "none")
                {
                    $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref) VALUES('$patient_name','$ref_number','$appointmentNumber','$test','$test_number_ref','$paraNumbers','$subPara_ref','$result_status','$test_result','$test_result_date','$result_ref ')");
                    if($insert_test)
                        {
                            $resultStatus = "Patient Queued Successfully without test parameters";
                        }
                        else
                        {
                            $resultStatus = "result table NOT Queued Successfully";
                        }
                }
                else
                {
                    $insert_test;
                    foreach($subPara_ref as $subp)
                    {
                        $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref) VALUES('$patient_name','$ref_number','$appointmentNumber','$test','$test_number_ref','$paraNumbers','$subp','$result_status','$test_result','$test_result_date','$result_ref ')");
                    }
                    if($insert_test)
                        {
                            $resultStatus = "Patient Queued Successfully with parametrs";
                        }
                        else
                        {
                            $resultStatus = "result NOT Queued Successfully with parametrs";
                        }
                }
            }
            else
            {
                
                $each_subPara_ref = numberOfSubTestParameters($test_number_ref);
                foreach($paraNumbers as $pn)
                {
                    if($each_subPara_ref == "none")
                    {
                        $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref) VALUES('$patient_name','$ref_number','$appointmentNumber','$test','$test_number_ref','$pn','$subPara_ref','$result_status','$test_result','$test_result_date','$result_ref ')");
                        if($insert_test)
                        {
                            $resultStatus = "Patient Queued Successfully without sub parameters";
                        }
                    }
                    else
                    {
                        $insert_test;
                        foreach($paraNumbers as $pn)
                        {
                            foreach($each_subPara_ref as $esubP)
                            {
                                $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref) VALUES('$patient_name','$ref_number','$appointmentNumber','$test','$test_number_ref','$pn','$esubP','$result_status','$test_result','$test_result_date','$result_ref ')");
                            }
                        }
                        if($insert_test)
                        {
                            $resultStatus = "Patient Queued Successfully with parameters";
                        }
                        else
                        {
                            $resultStatus = "result table NOT Queued Successfully with parameters and sub parameters";
                        }

                    }
                }
            }
        }

        echo $resultStatus;
        
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
        $find_p = mysqli_query($con,"UPDATE appointments SET appointment_status ='".$status."' WHERE patient_ref_no ='".$id."' ");
        if($find_p)
        {
            echo "test accepted";
        }
        else
        {
            echo "<h5 style='color: red;'>status not updated...something went wrong</h5>";
        }
    }
    elseif($status == "finish")
    {
        $find_ps = mysqli_query($con,"UPDATE appointments SET appointment_status ='".$status."' WHERE patient_ref_no ='".$id."' ");
        if($find_ps)
        {
            echo "test updated to finish";
        }
        else
        {
            echo "<h5 style='color: red;'>laboratory test status not updated...something went wrong</h5>";
        }
    }
    else
    {}
}

function updateAllTables($patientRefNum, $patientName)
{
    include 'fabinde.php';

    $resturnMessage = "";
    $updateAppointment = mysqli_query($con,"UPDATE appointments SET patient_name='".$patientName."' WHERE patient_ref_no='".$patientRefNum."'");
    if($updateAppointment)
    {
        $update_test_result = mysqli_query($con,"UPDATE test_results SET patient_name='".$patientName."' WHERE patient_ref_number='".$patientRefNum."' ");
        if($update_test_result)
        {
            $resturnMessage = "updated";
        }
        else
        {
            $resturnMessage = "test result NOT update";
        }
    }
    else
    {
        $resturnMessage = "appointment NOT updated";
    }
    return $resturnMessage;
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