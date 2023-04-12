<?php
include 'fabinde.php';

if(isset($_POST["amount"]))
{
    $testName = mysqli_real_escape_string($con,$_POST["testName"]);
    $testCategory = mysqli_real_escape_string($con,$_POST["testCategory"]);
    $test_amount = mysqli_real_escape_string($con,$_POST["amount"]);
    $tst_id = mysqli_real_escape_string($con,$_POST["id"]);
    $ref = mysqli_real_escape_string($con,$_POST["ref"]);
    $updated_date = date('Y-m-d');
    $test_ref = "";
    $cat = substr($testCategory,0,3);
    $cut = substr($ref,0,3);
    $category = str_replace($cat,$cut,$ref);
    $test_ref = $category;
    
            $inserted = mysqli_query($con,"UPDATE test_categories SET test_category ='".$testName."', test_type ='".$testCategory."', test_amount ='".$test_amount."', date_updated ='".$updated_date."', test_ref ='".$test_ref."' WHERE id ='".$test_id."'");
            if($inserted)
            {
                $insert_status = $test_ref."<h5 style='color: rgba(12, 184, 182, 0.91);'>patient details edited successfully</h5>";
                header("location:add_test.php?status=$insert_status");
            }
            else
            {
                $insert_status = "<h5 style='color: red;'>patient details Not edited successfully</h5>";
            }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body>
    <div class="m-10">
        <input list="browsers" multiple required>
        <datalist id="browsers">
            <option value="Internet Explorer">
            <option value="Firefox">
            <option value="Chrome">
            <option value="Opera">
            <option value="Safari">
        </datalist>
    </div>

    <div class="search_select_box">
    <select class="selectpicker" data-live-search="true" multiple required>
        <?php 
        $select = mysqli_query($con,"SELECT * FROM patients");
        if($select)
        {
            while($result = mysqli_fetch_assoc($select))
            {
        ?>
        <option value=""><?php echo $result['patient_surname']; ?></option>
    
        <?php
            }
        }
        ?>
        </select>
    </div>
   <?php echo $insert_status; ?>
    <div>
        <select>
            <option value="">Select a state...</option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
        </select>

    </div>
    <script>
        /*
      new TomSelect("#select-state",{
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });*/
    </script>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="myscript.js"></script>
</body>

</html>