 <?php 
/*
function testPrize($refs)
{
    include 'fabinde.php';

    $test_prize = "";

    $test_query = mysqli_query($con,"SELECT test_amount FROM test_categories WHERE test_ref='$refs'");
    if($test_query)
    {
        while($result = mysqli_fetch_assoc($test_query))
        {
            $test_prize = "<td>".$result['test_type']."</td>".$result['test_amount'];
        }
    }

    return $test_prize;
}*/

function testFormCategory($testRef)
{
    include 'fabinde.php';
    $return_message = "";
    $searchTEstForm = mysqli_query($con,"SELECT * FROM test_categories WHERE test_ref='$testRef'");
    if(mysqli_num_rows($searchTEstForm) >= 1)
    {
        while($searcResults = mysqli_fetch_assoc($searchTEstForm))
        {
            $return_message = $searcResults['main_test_category'];
        }
    }
    else
    {
        $return_message = "test category not found";
    }
    return $return_message;
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

function numberOfTestParameters($tst_ref)
{
    include 'fabinde.php';
    $number_of_paramters = "";
    $test_para;
    $test_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$tst_ref'");
    if (mysqli_num_rows($test_query) >= 1) {
        while ($rest = mysqli_fetch_assoc($test_query)) {
            if($rest['test_parameters'] == "none")
            {
                $number_of_paramters = $rest['test_parameters'];
            }
            else
            {
                $test_para = unserialize($rest['test_parameters']);
                $number_of_paramters = $test_para;
            }
            
        }
    }
    else
    {}

    return $number_of_paramters;
}

function numberOfSubTestParameters($tst_ref)
{
    include 'fabinde.php';

    $number_of_paramters = "";
    $test_para = "";
    $test_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$tst_ref'");
    if (mysqli_num_rows($test_query) >= 1) {
        while ($rest = mysqli_fetch_assoc($test_query)) {
            if($rest['sub_parameters'] == "none")
            {
                $number_of_paramters = $rest['sub_parameters'];
            }
            else
            {
                $test_para = unserialize($rest['sub_parameters']);
                
                $number_of_paramters = $test_para;
            }
            
        }
    }
    else
    {}
    return $number_of_paramters;
}

function testName($tst_ref)
{
    include 'fabinde.php';

    $test_details = "";

    $test_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$tst_ref'");
    if (mysqli_num_rows($test_query) >= 1) {
        while ($rest = mysqli_fetch_assoc($test_query)) {
            $test_details = "<h4>Enter " . $rest['test_type'] . " Test Results For</h4>";
        }
    }
    return $test_details;
}

function findCategory($ref)
{
    include 'fabinde.php';

    $test_category = "";

    $search_query = mysqli_query($con,"SELECT * FROM test_categories WHERE test_ref='$ref'");
    if($search_query)
    {
        while($res = mysqli_fetch_assoc($search_query))
        {
            $test_category = $res['test_category'];
        }
    }

    return $test_category;
}

function testCategory($input)
{
    $test_category = "";

    if($input = "H")
    {
        $test_category = "Haematology";
    }
    elseif($input = "M")
    {
        $test_category = "MicroBiology";
    }
    elseif($input = "C")
    {
        $test_category = "Clinical Chemistry";
    }
    else{}

    return $test_category;
}


?>