<?php

function checkTestResultStatus($refs,$appnums)
{
    include 'fabinde.php';

    $returnMessage = "";
    $gottenMessage = testFormCategory($refs);

    if($gottenMessage == "Haematology")
    {
        $test_query = mysqli_query($con,"SELECT test_status FROM haematology WHERE appointment_number='$appnums' AND test_type='$refs'");
        if(mysqli_num_rows($test_query) >= 1)
        {
            while($result = mysqli_fetch_assoc($test_query))
            {
                $returnMessage = $result['test_status'];
            }
        }
        else
        {
            $returnMessage = "no result";
        }
    }
    elseif($gottenMessage == "Clinical Chemistry")
    {
        $test_query = mysqli_query($con,"SELECT test_status FROM clinical_chemistry WHERE appointment_number='$appnums' AND test_type='$refs'");
        if(mysqli_num_rows($test_query) >= 1)
        {
            while($result = mysqli_fetch_assoc($test_query))
            {
                $returnMessage = $result['test_status'];
            }
        }
        else
        {
            $returnMessage = "no result";
        }
    }
    elseif($gottenMessage == "MicroBiology/Parasitology")
    {
        $test_query = mysqli_query($con,"SELECT test_status FROM microbiology WHERE appointment_number='$appnums' AND test_type='$refs'");
        if(mysqli_num_rows($test_query) >= 1)
        {
            while($result = mysqli_fetch_assoc($test_query))
            {
                $returnMessage = $result['test_status'];
            }
        }
        else
        {
            $returnMessage = "no result";
        }
    }
    elseif($gottenMessage == "Semen Analysis")
    {
        $test_query = mysqli_query($con,"SELECT test_status FROM semen_analysis WHERE appointment_number='$appnums' AND test_type='$refs'");
        if(mysqli_num_rows($test_query) >= 1)
        {
            while($result = mysqli_fetch_assoc($test_query))
            {
                $returnMessage = $result['test_status'];
            }
        }
        else
        {
            $returnMessage = "no result";
        }
    }
    elseif($gottenMessage == "laboratory")
    {
        $test_query = mysqli_query($con,"SELECT test_status FROM clinical_laboratory WHERE appointment_number='$appnums' AND test_type='$refs'");
        if(mysqli_num_rows($test_query) >= 1)
        {
            while($result = mysqli_fetch_assoc($test_query))
            {
                $returnMessage = $result['test_status'];
            }
        }
        else
        {
            $returnMessage = "no result";
        }
    }
    else
    {}

    return $returnMessage;
}


function checkTestAppointment($reference)
{
    include 'fabinde.php';

    $amount = 0;
    $testRsult = "none";
    $test_query = mysqli_query($con,"SELECT * FROM test_results WHERE test_type='$reference'AND test_result='$testRsult'");
    if(mysqli_num_rows($test_query) >= 1)
    {
            $amount = "yes";
    }
    else
    {
        $amount = "no";
    }

        return $amount;
}

function numberOfTestParameters($tst_ref)
{
    include 'fabinde.php';
    $number_of_paramters;
    $test_para;
    $test_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$tst_ref'");
    if (mysqli_num_rows($test_query) >= 1) {
        while ($rest = mysqli_fetch_assoc($test_query)) {
            if ($rest['test_parameters'] == "none") {
                $number_of_paramters = $rest['test_parameters'];
            } else {
                $test_para = unserialize($rest['test_parameters']);
                $number_of_paramters = $test_para;
            }
        }
    } else {
    }
    return $number_of_paramters;
}

function numberOfSubTestParameters($tst_ref)
{
    include 'fabinde.php';
    $number_of_paramters;
    $test_para;
    $test_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$tst_ref'");
    if (mysqli_num_rows($test_query) >= 1) {
        while ($rest = mysqli_fetch_assoc($test_query)) {
            if ($rest['sub_parameters'] == "none") {
                $number_of_paramters = $rest['sub_parameters'];
            } else {
                $test_para = unserialize($rest['sub_parameters']);

                $number_of_paramters = $test_para;
            }
        }
    } else {
    }
    return $number_of_paramters;
}

function testNameOnly($tst_ref)
{
    include 'fabinde.php';

    $test_details = "";

    $test_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$tst_ref'");
    if (mysqli_num_rows($test_query) >= 1) {
        while ($rest = mysqli_fetch_assoc($test_query)) {
            $test_details = $rest['test_type'];
        }
    }
    return $test_details;
}

function testName($tst_ref)
{
    include 'fabinde.php';

    $test_details = "";

    $test_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$tst_ref'");
    if (mysqli_num_rows($test_query) >= 1) {
        while ($rest = mysqli_fetch_assoc($test_query)) {
            $test_details = "<h4>Enter " . $rest['test_type'] . " Test </h4>";
        }
    }
    return $test_details;
}

function namingTest($tst_refing)
{
    include 'fabinde.php';

    $test_details = "";

    $test_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$tst_refing'");
    if (mysqli_num_rows($test_query) >= 1) {
        while ($rest = mysqli_fetch_assoc($test_query)) {
            $test_details = "<h4 class='text-center'>" . $rest['test_type'] . " Test </h4>";
        }
    }
    return $test_details;
}

function findCategory($ref)
{
    include 'fabinde.php';

    $test_category = "";

    $search_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$ref'");
    if ($search_query) {
        while ($res = mysqli_fetch_assoc($search_query)) {
            $test_category = $res['test_category'];
        }
    }

    return $test_category;
}

function testCategory($input)
{
    $test_category = "";

    if ($input = "H") {
        $test_category = "Haematology";
    } elseif ($input = "M") {
        $test_category = "MicroBiology";
    } elseif ($input = "C") {
        $test_category = "Clinical Chemistry";
    } else {
    }

    return $test_category;
}

function testFormCategory($testRef)
{
    include 'fabinde.php';
    $return_message = "";
    $searchTEstForm = mysqli_query($con,"SELECT * FROM test_categories WHERE test_ref='$testRef'");
    if(mysqli_num_rows($searchTEstForm) >= 1)
    {
        while($searcResults = mysqli_fetch_assoc($searchTEstForm))
        {
            $return_message = $searcResults['test_category'];
        }
    }
    else
    {
        $return_message = "test category not found";
    }
    return $return_message;
}

?>