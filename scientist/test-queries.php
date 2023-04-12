<?php 
include 'fabinde.php';

if(isset($_POST["test_name"]))
{
    $test_name = strtoupper(mysqli_real_escape_string($con,$_POST["test_name"]));
    $test_prize = mysqli_real_escape_string($con,$_POST["prize"]);
    $test_category = mysqli_real_escape_string($con,$_POST["category"]);
    $test_ref = "";
    $date = date('d-m-Y');
    $testPara = "none";
    $testSubPara = "none";

    $check = mysqli_query($con,"SELECT test_type FROM test_categories WHERE test_type='$test_name'");
    if(mysqli_num_rows($check) >= 1)
    {
        $insert_status = "test already exists";
        echo $insert_status;
    }
    else
    {
        $test_ref_query = mysqli_query($con,"SELECT * FROM test_categories");
        if(mysqli_num_rows($test_ref_query) == false || mysqli_num_rows($test_ref_query) == 0)
        {
            $cat = substr($test_category, 0, 3);
            $test_ref = $cat."-00";
        }
        else
        {
            $num = mysqli_num_rows($test_ref_query);
            $cat = substr($test_category, 0, 3);
            $test_ref = $cat."-0".$num;
        }
        $date_updated = "none";
        $insert = mysqli_query($con,"INSERT INTO test_categories(test_category,test_type,test_amount,date_added,test_ref,test_parameters,sub_parameters,date_updated) VALUES('$test_category','$test_name','$test_prize','$date','$test_ref','$testPara','$testSubPara','$date_updated')");
        if($insert)
        {
            $insert_status = "<h6 style='color: green;'>test added succesfully</h6>";
            header("location:add_test.php?status=$insert_status");
        }
        else
        {
            $insert_status = "<h6 style='color: red;'>test NOT added succesfully...something went wrong</h6>";
            echo $insert_status;
        }
    }
}
if(isset($_POST["parameters"]))
{
    $insert_status = "";
    $base_count;
    $available_parameters;
    $testName;
    $testCate;
    $parameters = "";
    $serial = "";
    $par = $_POST['parameters'];
    $ref = mysqli_real_escape_string($con,$_POST["ref"]);
    if(is_array($par))
    {
        $test_parameters = count($_POST["parameters"]);
        $parameters = array($test_parameters);
        for ($i = 0; $i < $test_parameters; $i++) 
        {
            $parameters[$i] = $par[$i];
        }
        $serial = serialize($parameters);
    }
    
    $serial = serialize($par);

    $checking = mysqli_query($con,"SELECT * FROM test_categories WHERE test_ref='$ref'");
    if(mysqli_num_rows($checking))
    {
            $updated_test_date = date('d-m-Y');
            $update = mysqli_query($con,"UPDATE test_categories SET test_parameters='".$serial."', date_updated='".$updated_test_date."' WHERE test_ref='".$ref."' ");
            if($update)
            {
                $insert_status = "parameters added to test successfully...";
                header("location:add_test.php?status=$insert_status");
                echo $insert_status;
                echo "<script>alert('parameters added to test successfully...');</script>";
            }
            else
            {
                echo "<script>alert('parameters not added...something went wrong');</script>";
            }
        
    }
    else
    {
        echo "<script>alert('test NOT found');</script>";
    }
}

if(isset($_POST["sub_parameters"]))
{
    $insert_status = "";
    $base_count;
    $available_parameters;
    $testName;
    $testCate;
    $updated_date = date('Y-m-d');
    $par = $_POST['sub_parameters'];
    $ref = mysqli_real_escape_string($con,$_POST["ref"]);
    $test_parameters = count($par);
    $parameters = array($test_parameters);
    for ($i = 0; $i <= $test_parameters; $i++) {
        $parameters[$i] = $par[$i];
    }
    $serialParameter = serialize($parameters);

    $checking = mysqli_query($con,"SELECT * FROM test_categories WHERE test_ref='$ref'");
    if(mysqli_num_rows($checking) >= 1)
    {

            $update = mysqli_query($con,"UPDATE test_categories SET sub_parameters='".$serialParameter."', date_updated='".$updated_date."' WHERE test_ref='".$ref."' ");
            if($update)
            {
                $insert_status = "parameters added to test successfully...";
                header("location:add_test.php?status=$insert_status");
                echo $insert_status;
            }
            else
            {
                echo "<script>alert('parameters not added...something went wrong');</script>";
            }
    }
    else
    {
        echo "<script>alert('test NOT found');</script>";
    }
}

if(isset($_POST["parameters_result"]))
{
    $parameters_result = mysqli_real_escape_string($con,$_POST["parameters_result"]);
    $parameter_names = $_POST["parameter_names"];
    $patient_ref ;
    $test_ref = mysqli_real_escape_string($con,$_POST["test_ref"]);
    $appointment_number = $_POST["appointment_no"];
    $patient_names;
    $testCategory;
    $testName;
    $capture_date = date('d-m-Y');
    $result_status = "none";
    $numberOfParameters = count($parameter_names);
    $test_parameters = array($numberOfParameters);
    $test_parameters_result = array($numberOfParameters);
    for ($i = 0; $i < $numberOfParameters; $i++) {
        $test_parameters[$i] = $parameter_names[$i];
        $test_parameters_result[$i] = $parameters_result[$i];
    }

    $insert;

    $search_appointment = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointment_number'");
    if(mysqli_num_rows($search_appointment) >= 1)
    {
        while($got = mysqli_fetch_assoc($search_appointment))
        {
            $patient_names = $got['patient_name'];
            $testCategory = $got['test_category'];
            $testName = $got['test_type'];
            $patient_ref = $got['patient_ref_no'];
        }
        for($in = 0; $in < $numberOfParameters; $in++)
        {
            $meters_name = $test_parameters[$in];
            $meters_result = $test_parameters_result[$in];
            $insert = mysqli_query($con,"INSERT INTO test_results(patient_name,patient_ref_number,appointment_number,test_category,test_type,test_parameter,result_status,test_result,result_date) VALUES('$patient_names','$patient_ref','$appointment_number','$testCategory','$testName','$meters_name','$result_status','$meters_result','$capture_date')");

        }
    }
    else
    {
        echo"appointment not found";
    }
    
    if($insert)
    {
        $update = "finish";
        $update_appointment = mysqli_query($con, "UPDATE appointments SET appointment_status='" . $update . "' WHERE appointment_no='" . $appointment_number . "' ");
        if ($update_appointment) {
            $update_status = "test result imputed successfully";
            header("location:patient_test.php?status=$update_status");
        } else {
            echo "test result NOT updated successfully...";
        }

    }
}

if(isset($_POST["scientist_remarks"]))
{
    $scientist_remarks = mysqli_real_escape_string($con,$_POST["scientist_remarks"]);
    $patientRef = mysqli_real_escape_string($con,$_POST["patient_ref"]);
    $testRef = mysqli_real_escape_string($con,$_POST["test_ref"]);
    $appointmentRefs = mysqli_real_escape_string($con,$_POST["appointment_ref"]);
    $replies = checkAllResults($appointmentRefs);

    if($replies == "yes")
    {
        
        $insertRemark = mysqli_query($con,"INSERT INTO test_remarks(patient_ref,appointment_no,test_ref,remarks) VALUES('$patientRef','$appointmentRefs','$testRef','$scientist_remarks') ");
        if($insertRemark)
        {
            $status_update = "updated";
            $updateResults = mysqli_query($con,"UPDATE test_results SET scientist_remark='".$status_update."' WHERE test_result_ref='".$testRef."' ");
            if($updateResults)
            {
                $finito = "finish";
                $updateAppointments = mysqli_query($con,"UPDATE appointments SET appointment_status='".$finito."' WHERE appointment_no='".$appointmentRefs."' ");
                if($updateAppointments)
                {
                    echo "'scientist remarks updated.....test finished!!!";
                }
                else
                {
                    echo "'appointment status not updated.....!!!";
                }
            }
            else
            {
                echo "'scientist remarks NOT Fully updated...!!!";
            }
        }
        else
        {
            echo "scientist remarks NOT updated...something went wrong!!";
        }
    }
    else
    {
        echo "all test result have not been captured yet....please insert all test result first!!!";
    }

}

function checkAllResults($appNumbers)
{
    include 'fabinde.php';
    $returnCheck = "";
    $result = "none";
    $checks = mysqli_query($con,"SELECT * FROM test_results WHERE appointment_number='$appNumbers' AND test_result='$result'");
    if(mysqli_num_rows($checks) >= 1)
    {
        $returnCheck = "no";
    }
    else
    {
        $returnCheck = "yes";
    }
    return $returnCheck;

}
?>
