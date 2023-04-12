<?php 
include 'fabinde.php';

if(isset($_POST["test_name"]))
{
    $test_name = strtoupper(mysqli_real_escape_string($con,$_POST["test_name"]));
    $test_prize = mysqli_real_escape_string($con,$_POST["prize"]);
    $test_category = mysqli_real_escape_string($con,$_POST["category"]);
    $test_ref = "";
    $date = date('d-m-Y');

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
            $cat = var_export(substr($test_category, 0, 3), true).PHP_EOL;
            $test_ref = $cat."-00";
        }
        else
        {
            $num = mysqli_num_rows($test_ref_query);
            $cat = var_export(substr($test_category, 0, 3), true).PHP_EOL;
            $test_ref = $cat."-0".$num;
        }
        $insert = mysqli_query($con,"INSERT INTO test_categories(test_category,test_type,test_amount,date_added,test_ref) VALUES('$test_category','$test_name','$test_prize','$date','$test_ref')");
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

if(isset($_POST["category_view"]))
{
    $test_cat = mysqli_real_escape_string($con,$_POST["category_view"]);
    $search = mysqli_query($con,"SELECT * FROM test_categories WHERE test_ref='$test_cat'");
    if($search)
    {
        while($result = mysqli_fetch_array($search))
        {
            echo"
            <tr><td></td>
                <td>".$result['test_type']."</td>
                <td>".$result['test_category']."</td>
                <td>".$result['test_amount']."</td>
                <td>".$result['date_added']."</td>
                    <div class='dropdown dropdown-action'>
                        <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                        <div class='dropdown-menu dropdown-menu-right'>
                            <a class='dropdown-item' href='view-appointment.php?ref='".$test_cat."'><i class='fa fa-pencil m-r-5'></i> View</a>
                        </div>
                    </div>
                </td>
            </tr>

            ";

        }
    }
    else
    {
        echo "test NOT found...";
    }
}
?>