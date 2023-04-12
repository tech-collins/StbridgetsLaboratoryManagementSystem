<?php
include 'fabinde.php';
include 'test_dictionary.php';

$testNumber = "";

function patientAppointment($referenceNumber,$dePatientTest,$payment,$hospital,$doctor)
{
    $testNumber = "";

    include 'fabinde.php';

    
    $scientist_remark = "none";
    $hospital = "Saint Bridget Diagnostic Center";
    $resultStatus = "";
    $date = date("m-d-Y h:i:s");
    $day = date("m-d-Y");
    $patient_name = "";
    $patient_number = "";
    $total_number_of_test = count($dePatientTest);
    $test_number = "";
    $doctor = $_SESSION["staff_name"];
    $ref_number = "";
    $dob = "";
    $gender = "";
    $appointment_status = "pending";
    $pateint_id = $referenceNumber;
    $find_patient = mysqli_query($con,"SELECT * FROM patients WHERE patient_ref_number='$pateint_id'");
    $appointmentNumber = "";
    if($find_patient)
    {
        while($result = mysqli_fetch_assoc($find_patient))
        {
                $patient_name = $result['patient_surname'] . " " . $result['patient_firstname'];
                $testNumber = unserialize($result['number_of_test']);
                $test = $result['test'];
                $ref_number = $result['patient_ref_number'];
                $dob = $result['age'];
                $gender = $result['gender'];
                $patient_number = $result['phone_number'];
                $testPaymentStatus = $result['payment_status'];
            
        }
        
        //echo $_POST["patient_id"]."-".$patient_name;
    }
    else{
        echo"Patient ID not found";
    }

    $serial_test = serialize($dePatientTest);
    //$test_number = "Wider";

    $check_appointment = mysqli_query($con,"SELECT * FROM appointments");
    if ($check_appointment) {
        if(mysqli_num_rows($check_appointment) < 1)
        {
            $appointmentNumber = "APT-" . $day . "-0";
        }
        else
        {
            $row_num = mysqli_num_rows($check_appointment);
            $appointmentNumber = "APT-" . $day . "-" . $row_num;
        }
        
    } 
    else 
    {
        $appointmentNumber = "APT-" . $day . "-0";
    }

    $appointment_list = mysqli_query($con,"INSERT INTO appointments(test_category,test_type,patient_name,dob,gender,phone_no,appointment_no,patient_ref_no,appointment_date,appointment_status,payment,hospital_name,doctor_name,total_test) VALUES('$test','$serial_test','$patient_name','$dob','$gender','$patient_number','$appointmentNumber','$ref_number','$date','$appointment_status','$payment','$hospital','$doctor','$total_number_of_test')");

    if($appointment_list)
    {
        echo $appointmentNumber;
        $paraNumbers = "";
        $result_ref = $appointmentNumber."-".$ref_number;
        $result_status = "no result";
        $test_result = "none";
        $test_result_date = "none";
        $subPara_ref = "none";
        $test_number = $testNumber;
        //$number_of_test = count($test_number);
        if(is_array($dePatientTest) && count($dePatientTest) > 1)
        {
            //$number_of_test = count($test_number);
            foreach($dePatientTest as $test_number_ref)
            {
                //$test_number_ref = $test_number[$ii];
                $resultStatus = justTestResult($patient_name,$ref_number,$appointmentNumber,$test,$test_number_ref,$paraNumbers,$subPara_ref,$result_status,$test_result,$test_result_date,$result_ref,$scientist_remark);
                
            }
        }
        else
        {
            $realTestRef = $dePatientTest[0];
            $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref) VALUES('$patient_name','$ref_number','$appointmentNumber','$test','$realTestRef','$paraNumbers','$subPara_ref','$result_status','$test_result','$test_result_date','$result_ref ')");
                        if($insert_test)
                            {
                                $resultStatus = "Patient Queued Successfully";
                            }
        }

        
        
    }
    else
    {
        $resultStatus = "patient not queued..something went wrong";
    }
    return $resultStatus;
}

function justTestResult($patient_name,$ref_number,$appointmentNumber,$test,$dePatientTest,$paraNumbers,$subPara_ref,$result_status,$test_result,$test_result_date,$result_ref,$scientist_remark)
{
    include 'fabinde.php';
    $dePatientTest;

    $testNumber;
    $testPaymentStatus = "";
    $resultStatus = "";
    $categories = testCategoryName($dePatientTest);
    $paraNumbers = numberOfTestParameters($dePatientTest);
    if($paraNumbers == "none")
    {
            $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref,scientist_remark) VALUES('$patient_name','$ref_number','$appointmentNumber','$categories','$dePatientTest','$paraNumbers','$subPara_ref','$result_status','$test_result','$test_result_date','$result_ref ','$scientist_remark')");
            if($insert_test)
                {
                    $resultStatus = "Patient Queued Successfully";
                }
                else
                {
                    $resultStatus = "result table NOT Queued Successfully for no parameters";
                }
    }
    else
    {
        
        $each_subPara_ref = numberOfSubTestParameters($dePatientTest);
        
        if($each_subPara_ref == "none")
        {
            foreach($paraNumbers as $pn)
            {
                $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref) VALUES('$patient_name','$ref_number','$appointmentNumber','$categories','$dePatientTest','$pn','$each_subPara_ref','$result_status','$test_result','$test_result_date','$result_ref ')");
                if($insert_test)
                {
                    $resultStatus = "Patient Queued Successfully ";
                }
                else
                {
                    $resultStatus = "Patient NOT Queued Successfully with parameters ";
                }
            }
            
        }
        else
        {
            $insert_test = "";
            foreach($paraNumbers as $pn)
            {
                foreach($each_subPara_ref as $esubP)
                {
                    if(empty($esubP) || $esubP == "")
                    {}
                    else
                    {
                        $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref) VALUES('$patient_name','$ref_number','$appointmentNumber','$categories','$dePatientTest','$pn','$esubP','$result_status','$test_result','$test_result_date','$result_ref ')");
                    }
                }
            }
            if($insert_test)
            {
                $resultStatus = "Patient Queued Successfully";
            }
            else
            {
                $resultStatus = "result table NOT Queued Successfully with parameters and sub parameters";
            }

        }
    
    }
    return $resultStatus;
}

function anotherAppointment($referenceNumber,$dePatientTest,$payment,$hospital,$doctor)
{
    $testNumber = "";

    include 'fabinde.php';

    
    $scientist_remark = "none";
    $hospital = "Saint Bridget Diagnostic Center";
    $resultStatus = "";
    $date = date("m-d-Y h:i:s");
    $day = date("m-d-Y");
    $patient_name = "";
    $patient_number = "";
    $test = "";
    $total_number_of_test = count($dePatientTest);
    $doctor = $_SESSION["staff_name"];
    $ref_number = "";
    $dob = "";
    $gender = "";
    $appointment_status = "pending";
    $pateint_id = $referenceNumber;
    $find_patient = mysqli_query($con,"SELECT * FROM patients WHERE patient_ref_number='$pateint_id'");
    $appointmentNumber = "";
    if($find_patient)
    {
        while($result = mysqli_fetch_assoc($find_patient))
        {
                $patient_name = $result['patient_surname'] . " " . $result['patient_firstname'];
                $ref_number = $result['patient_ref_number'];
                $dob = $result['age'];
                $gender = $result['gender'];
                $patient_number = $result['phone_number'];
            
        }
        
        //echo $_POST["patient_id"]."-".$patient_name;
    }
    else{
        echo"Patient ID not found";
    }

    $serial_test = serialize($dePatientTest);
    $testingCat = "Several";

    $check_appointment = mysqli_query($con,"SELECT * FROM appointments");
    if ($check_appointment) {
        if(mysqli_num_rows($check_appointment) < 1)
        {
            $appointmentNumber = "APT-" . $day . "-0";
        }
        else
        {
            $row_num = mysqli_num_rows($check_appointment);
            $appointmentNumber = "APT-" . $day . "-" . $row_num;
        }
        
    } 
    else 
    {
        $appointmentNumber = "APT-" . $day . "-0";
    }

    $appointment_list = mysqli_query($con,"INSERT INTO appointments(test_category,test_type,patient_name,dob,gender,phone_no,appointment_no,patient_ref_no,appointment_date,appointment_status,payment,hospital_name,doctor_name,total_test) VALUES('$testingCat','$serial_test','$patient_name','$dob','$gender','$patient_number','$appointmentNumber','$ref_number','$date','$appointment_status','$payment','$hospital','$doctor','$total_number_of_test')");

    if($appointment_list)
    {
        echo $appointmentNumber;
        $paraNumbers = "";
        $result_ref = $appointmentNumber."-".$ref_number;
        $result_status = "no result";
        $test_result = "none";
        $test_result_date = "none";
        $subPara_ref = "none";
        $test_number = $testNumber;
        //$number_of_test = count($test_number);
        if(is_array($dePatientTest) && count($dePatientTest) > 1)
        {
            //$number_of_test = count($test_number);
            foreach($dePatientTest as $test_number_ref)
            {
                //$test_number_ref = $test_number[$ii];
                $resultStatus = justTestResult($patient_name,$ref_number,$appointmentNumber,$test,$test_number_ref,$paraNumbers,$subPara_ref,$result_status,$test_result,$test_result_date,$result_ref,$scientist_remark);
                
            }
        }
        else
        {
            $realTestRef = $dePatientTest[0];
            $insert_test = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,sub_parameters,result_status,test_result,result_date,test_result_ref,scientist_remark) VALUES('$patient_name','$ref_number','$appointmentNumber','$test','$realTestRef','$paraNumbers','$subPara_ref','$result_status','$test_result','$test_result_date','$result_ref','$scientist_remark')");
                        if($insert_test)
                            {
                                $resultStatus = "Patient Queued Successfully";
                            }
        }

        
        
    }
    else
    {
        $resultStatus = "patient not queued..something went wrong";
    }
    return $resultStatus;
}
?>