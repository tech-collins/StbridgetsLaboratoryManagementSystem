<?php
include 'fabinde.php';


function displayTestResult($patient_reference,$appointmentNumber)
{
    include 'fabinde.php';

    $testName = "";
    $testParas = "";
    $testSubPara = "";
    $testResult = "";
    $testCountings = 0;
    $search_appointment = mysqli_query($con, "SELECT * FROM appointments WHERE patient_ref_no='$patient_reference' AND appointment_no='$appointmentNumber'");
    if($search_appointment)
    {
        if(mysqli_num_rows($search_appointment) >= 1)
        {
            while ($appointmentResult = mysqli_fetch_assoc($search_appointment)) {
                $testName = unserialize($appointmentResult['test_type']);
            }
        }
        else
        {}
    }
    else
    {}
    if(is_array($testName))
    {
        foreach($testName as $tst_name)
        {
            $select_result = mysqli_query($con,"SELECT * FROM test_results WHERE patient_ref_number='$patient_reference' AND appointment_number='$appointmentNumber' AND test_type='$tst_name'");
                if($select_result)
                {
                ?>
                    <h4 class="text-center"><?php echo testNameOnlyResult($tst_name); ?></h4>
                <?php
                    if(mysqli_num_rows($select_result) >= 1)
                    {
                        $testParas = array(mysqli_num_rows($select_result));
                        $testSubPara = array(mysqli_num_rows($select_result));
                        $testResult = array(mysqli_num_rows($select_result));
                        $subCount = 0;
                        while($queryResult = mysqli_fetch_assoc($select_result))
                        {
                            if($queryResult['test_parameter'] == "none" && $queryResult['sub_parameters'] == "none")
                            {
                                $firstCount = 1;
                            ?>
                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Test</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $firstCount; ?></td>
                                                <td><?php echo testNameOnlyResult($tst_name); ?></td>
                                                <td><?php echo $queryResult['test_result'] ; ++$firstCount;?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                            }
                            else
                            {
                                if($queryResult['sub_parameters'] == "none")
                                {
                                    $secondCounting = 1;
                                ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>PARAMETERS</th>
                                                    <th>RESULT</th>
                                                </tr>
                                            </thead>
                                            </tbody>
                                                <tr>
                                                    <td><?php echo $secondCounting; ?></td>
                                                    <td><?php echo $queryResult['test_parameter']; ?></td>
                                                    <td><?php echo $queryResult['test_result']; ++$secondCounting;?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }
                                else
                                {
                                    if(count($testSubPara) >= 1)
                                    {
                                        $backcheck = count($testSubPara) - 1;
                                        if($testSubPara[$backcheck] != $queryResult['sub_parameters'])
                                        {
                                            $testSubPara[$subCount] = $queryResult['sub_parameters'];
                                        }

                                        $testParas[$subCount] = $queryResult['test_parameter'];
                                        $testResult[$subCount] = $queryResult['test_result'];
                                    }
                                    elseif(count($testSubPara) < 1)
                                    {
                                        $testParas[$subCount] = $queryResult['test_parameter'];
                                        $testSubPara[$subCount] = $queryResult['sub_parameters'];
                                        $testResult[$subCount] = $queryResult['test_result'];
                                    }
                                    else
                                    {}
                                }
                            }
                            ++$subCount;
                        }
                        if(is_array($testSubPara) && count($testSubPara) > 1)
                        {
                            $sub_numb = count($testSubPara);
                        ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>PARAMETERS</th>
                        <?php
                            foreach($testSubPara as $sub)
                            {
                            ?>
                                                <th><?php echo $sub; ?></th>
                            <?php
                            }
                            ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                            <?php
                            for($rr = 0; $rr < count($testParas); ++$rr)
                            {
                            ?>
                                            <tr>
                                                <td><?php echo $testParas[$rr]; ?></td>
                            <?php
                            for($ee = 0; $ee < count($testSubPara); ++$ee)
                            {
                            ?>
                                                <td><?php echo $testResult[$testCountings]; ?></td>
                                            </tr>
                            <?php
                            ++$testCountings;
                            }
                            $testCountings = $ee;
                            }
                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                        }
                        else
                        {}
                    }
                    else
                    {}
                }
                else
                {}
        }
    }
    else
    {}
}

function testNameOnlyResult($tst_ref)
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
?>