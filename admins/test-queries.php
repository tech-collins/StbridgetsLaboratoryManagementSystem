<?php 
include 'fabinde.php';

if(isset($_POST["test_name"]))
{
    $test_name = strtoupper(mysqli_real_escape_string($con,$_POST["test_name"]));
    $test_prize = mysqli_real_escape_string($con,$_POST["prize"]);
    $test_category = mysqli_real_escape_string($con,$_POST["category"]);
    $test_ref = "";
    $date = date('d-m-Y');
    $no_of_Para = "none";
    $updatedDate = "";

    $check = mysqli_query($con,"SELECT * FROM test_categories WHERE test_type='$test_name' AND test_category=' $test_category'");
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
            $cat = var_export(substr($test_category, 0, 3), true).PHP_EOL;
            $test_ref = $cat."-00";
        }
        else
        {
            $num = mysqli_num_rows($test_ref_query);
            $cat = var_export(substr($test_category, 0, 3), true).PHP_EOL;
            $test_ref = $cat."-0".$num;
        }
        $insert = mysqli_query($con,"INSERT INTO test_categories(test_category,test_type,test_amount,date_added,test_ref,test_parameters,sub_parameters,date_update,main_test_category) VALUES('$test_category','$test_name','$test_prize','$date','$test_ref','$no_of_Para','$no_of_Para','$updatedDate','$test_category')");
        if($insert)
        {
            $insert_status = "<h6 style='color: green;'>test added succesfully</h6>";
            header("location:add_test.php");
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
    $par = $_POST['parameters'];
    $ref = mysqli_real_escape_string($con,$_POST["ref"]);
    $test_parameters = count($_POST["parameters"]);
    $parameters = array($test_parameters);
    for ($i = 0; $i < $test_parameters; $i++) {
        $parameters[$i] = $par[$i];
    }
    $serial = serialize($parameters);
    $paraCount = count($parameters);

    $checking = mysqli_query($con,"SELECT * FROM test_categories WHERE test_ref='$ref'");
    if(mysqli_num_rows($checking))
    {
        while($res = mysqli_fetch_assoc($checking))
        {
            $available_parameters = unserialize($res['test_parameters']); 
        }

        if($available_parameters != "none" && !empty($available_parameters))
        {
            $base_count = count($available_parameters);
            $new = $base_count + $test_parameters ;
            $new_parameter = array($new);
            for ($i = 0; $i < $base_count; $i++) {
                $new_parameters[$i] = $available_parameters[$i];
            }
            $continue = $base_count;
            for ($i = $continue; $i < $test_parameters; $i++) {
                $new_parameters[$i] = $parameters[$i];
            }
            $serialze_parameter = serialize($new_parameters);

            $updating = mysqli_query($con,"UPDATE test_categories SET test_parameters='".$serialze_parameter."' WHERE test_ref='".$ref."' ");
            if($updating)
            {
                $insert_status = "test parameters updated successfully...";
                header("location:add_test.php?status=$insert_status");
            }
            else
            {
                echo "<script>alert('test parameters NOT updated successfully...');</script>";
            }

        }
        else
        {
            $update = mysqli_query($con,"UPDATE test_categories SET test_parameters='".$serial."', number_of_parameters='".$paraCount."' WHERE test_ref='".$ref."' ");
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
    $capture_date = date('Y-m-d');
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

if(isset($_POST["category_view"]))
{
    $ref_number = $_POST["category_view"];
    $search = mysqli_query($con,"SELECT * FROM test_categories WHERE test_ref='$ref_number'");
    if($search)
    {
        while($result = mysqli_fetch_array($search))
        {
            echo"
            <tr>
                <td></td>
                <td><a class='dropdown-item' href='test-view.php?ref=".$result['test_ref']."'>".$result['test_type']."</a></td>
                <td>".$result['test_category']."</td>
                <td>".$result['test_amount']."</td>
                <td>".$result['date_added']."</td>
                <td class='text-right'>
                    <div class='dropdown dropdown-action'>
                        <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                        <div class='dropdown-menu dropdown-menu-right'>
                            <a class='dropdown-item' href='test-view.php?ref=".$result['test_ref']."'><i class='fa fa-pencil m-r-5'></i> View Test</a>
                            <a class='dropdown-item' href='edit-test.php?id=".$result['id']."'><i class='fa fa-pencil m-r-5'></i> Edit Test</a>
                            <a class='dropdown-item' href='#' onclick='removeAppointment('".$result['id']."')' data-toggle='' data-target=''><i class='fa fa-trash-o m-r-5'></i> Delete</a>
                        </div>
                    </div>
                </td>
            </tr>

            ";

        }
    }
    else
    {
        //echo "patient NOT found...";
        echo "<script>alert('test NOT found...');</script>";
    }
}
