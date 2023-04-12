<?php
include 'test_dictionary.php';


$_SESSION["parameterCounter"] = 0;
$_SESSION["subParameters"] = 0;

function displayTestDetails($patientRef, $testRef,$parameterCounter)
{
    include 'fabinde.php';

    $testID = "";
    $appointment_num = "";

    echo "<br>".testName($testRef)."<br>";
?>
    <div class="table-responsive">
        <table class="table table-striped custom-table datatable mb-0">
            <?php
            $test_resulting = "none";
            $search_testResult = mysqli_query($con, "SELECT * FROM test_results WHERE patient_ref_number='$patientRef' AND test_type='$testRef' AND test_result='$test_resulting' ");
            if (mysqli_num_rows($search_testResult) >= 1) 
            {
                while ($displayParameters = mysqli_fetch_assoc($search_testResult)) 
                {
                    $testID = $displayParameters['test_result_ref'];
                    $appointment_num = $displayParameters['appointment_number'];
                    if ($displayParameters['test_parameter'] == "none") 
                    {
            ?>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Test</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            ?>
                            <tr>
                                <td>#</td>
                                <td style="display: none;"><?php echo $displayParameters['id']; ?></td>
                                <td><?php echo testNameOnly($testRef); ?></td>
                                <td><a  href="capture_test_result.php?patientRef=<?php echo $patientRef; ?>&testId=<?php echo $displayParameters['id']; ?>"><?php echo $displayParameters['test_result']; ?></a></td>
                            </tr>
                        <?php
                    }
                    elseif($displayParameters['test_parameter'] != "none" && $displayParameters['sub_parameters'] == "none")
                    {
                        if($_SESSION["parameterCounter"] == 0)
                        {
                        ?>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Parameter</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        }
                        
                        $update = $_SESSION["parameterCounter"] + 1;
                        $_SESSION["parameterCounter"] = $update;
                        ?>

                            <tr>
                            <td><?php echo $_SESSION["parameterCounter"]; ?></td>
                            <td><?php echo $displayParameters['test_parameter']; ?></td>
                            <td><a href="capture_test_result.php?patientRef=<?php echo $patientRef; ?>&testId=<?php echo $displayParameters['id']; ?>"><?php echo $displayParameters['test_result']; ?></a></td>
                            </tr>
                        <?php
                    }
                    elseif($displayParameters['sub_parameters'] != "none")
                    {
                        if($_SESSION["subParameters"] == 0)
                        {
                        ?>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Parameters</th>
                        <?php
                            $subPara_meters = getSubParameteras($testRef);
                            foreach($subPara_meters as $subs)
                            {
                            ?>
                                    <th><?php echo $subs; ?></th>
                            <?php
                            }
                        ?>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        }
                        $_SESSION["subParameters"] = $_SESSION["subParameters"] + 1;
                    ?>
                            <tr>
                                <td>#</td>
                                <td><?php echo $displayParameters['test_parameter']; ?></td>
                                <td><?php echo $displayParameters['test_result']; ?></td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!--  <a class="dropdown-item" href="edit-patient.php?id=<?php ///echo $displayParameters['id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a> -->
                                            <a class="dropdown-item" href="capture_test_result.php?patientRef=<?php echo $patientRef; ?>&testId=<?php echo $displayParameters['id']; ?>"><i class="fa fa-pencil m-r-5"></i> input test</a>
                                            <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#saveResult"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php
                    }
                    else {
                        echo $displayParameters['test_type'];
                        echo $displayParameters['test_type'];
                        echo $displayParameters['test_type'];
                        ?>
                        <h4><?php echo $displayParameters['test_type']; ?> ok na</h4>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>test</th>
                                    <th><?php echo $displayParameters['test_type']; ?></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr>
                                <td>#</td>
                                <td style="display: none;"><?php echo $displayParameters['id']; ?></td>
                                <td><?php echo $displayParameters['test_parameter']; ?></td>
                                <td><?php echo $displayParameters['test_result']; ?></td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!--  <a class="dropdown-item" href="edit-patient.php?id=<?php ///echo $displayParameters['id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a> -->
                                            <a class="dropdown-item" href="capture_test_result.php?patientRef=<?php echo $patientRef; ?>&testId=<?php echo $displayParameters['id']; ?>"><i class="fa fa-pencil m-r-5"></i> input test</a>
                                            <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#saveResult"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php
                    }
                }
            }
            echo "<h5 style='color:green;'>result inserted aleady....</h5>";
            /*
                                                        for ($dd = $i; $dd < $numberOfTest; $dd++) {
                                                            $display_details = testDetails($unserial_test[$i]);
                                                            echo $display_details;
                                                        }*/
                ?>
                        </tbody>
        </table>
    </div>
    <br>
    <br>
<?php
}

function scientistRemarks($patientRef, $appointmentNumber)
{
    include 'fabinde.php';
    $remarks = "none";
    $test_result_refs = "";
    $appointment_num = "";
    $remark_check = mysqli_query($con,"SELECT * FROM test_results WHERE patient_ref_number='$patientRef' AND appointment_number='$appointmentNumber' AND scientist_remark='$remarks'");
    if(mysqli_num_rows($remark_check) >= 1)
    {
        while($remarkChecking = mysqli_fetch_assoc($remark_check))
        {
            $test_result_refs = $remarkChecking['test_result_ref'];
        }
    ?>
        <form method="post" action="#">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="mt-3">Scientist Remark</label>
                        <textarea name="TestRemarks" class="form-control" id="testRemarks"  style="width: 500px; height:300px; resize: none;"></textarea>
                    </div>
                    <input type="hidden" id="testRef" name="testRef" value="<?php echo $test_result_refs; ?>" >
                    <input type="hidden" id="patientRef" name="patientRef" value="<?php echo $patientRef; ?>" >
                    <input type="hidden" id="appointmentRef" name="appointmentRef" value="<?php echo $appointmentNumber; ?>" >
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" id="saveRemark" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                </div>
                </div>
            </div>
        </form>
    <?php
    }
}

function getSubParameteras($restrefernce)
{
    include 'fabinde.php';
    $returner;
    $searchSub = mysqli_query($con,"SELECT * FROM test_categories WHERE test_ref='$restrefernce'");
    if(mysqli_num_rows($searchSub) >= 1)
    {
        while($rd = mysqli_fetch_assoc($searchSub))
        {
            $returner = unserialize($rd['sub_parameters']);
        }
    }
    return $returner;
}

?>