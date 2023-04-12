<?php
include 'fabinde.php';


function testNames($tst_ref)
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

function displayTestResult($patient_reference, $appointmentNumber)
{
    include 'fabinde.php';
    $checkArray = 0;
    $checkingParameters = 0;

    $testName = "";
    $testParas = "";
    $testSubPara = "";
    $testResult = "";
    $testCountings = 0;
    $search_appointment = mysqli_query($con, "SELECT * FROM appointments WHERE patient_ref_no='$patient_reference' AND appointment_no='$appointmentNumber'");
    if ($search_appointment) {
        if (mysqli_num_rows($search_appointment) >= 1) {
            while ($appointmentResult = mysqli_fetch_assoc($search_appointment)) {
                $testName = unserialize($appointmentResult['test_type']);
            }
        } else {
        }
    } else {
    }
    if (is_array($testName)) {

        $firstCount = 1;
        foreach ($testName as $tst_name) {

            $dd = numberOfParameters($tst_name);
            $select_result = mysqli_query($con, "SELECT * FROM test_results WHERE patient_ref_number='$patient_reference' AND appointment_number='$appointmentNumber' AND test_type='$tst_name'");
            if ($select_result) {
                if (mysqli_num_rows($select_result) >= 1) {
                    $testParas = array(mysqli_num_rows($select_result));
                    $testSubPara = array(mysqli_num_rows($select_result));
                    $testResult = array(mysqli_num_rows($select_result));
                    $subCount = 0;
                    while ($queryResult = mysqli_fetch_assoc($select_result)) {
                        if ($queryResult['test_parameter'] == "none" && $queryResult['sub_parameters'] == "none") {

                            if ($checkArray == 0 && $dd == "none") {
?>

                                <div class="table-responsive">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Test</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                    } else {
                                    }
                                        ?>
                                        <tr>
                                            <td><?php //echo $firstCount; 
                                                ?>#</td>
                                            <td><?php echo testNameOnlyResult($tst_name); ?></td>
                                            <td><?php echo $queryResult['test_result']; ?></td>
                                        </tr>
                                        <?php
                                        ++$checkArray;
                                    } else {
                                        $checkArray = 0;
                                        if ($queryResult['sub_parameters'] == "none" && $queryResult['test_parameter'] != "none") {
                                            $secondCounting = 1;
                                            if ($checkingParameters < 1) {
                                        ?>
                                                <h4 class="text-center"></h4>

                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>PARAMETERS(<?php echo testNameOnlyResult($tst_name); ?> Test)</th>
                                                                <th>RESULT</th>
                                                            </tr>
                                                        </thead>
                                        </tbody>
                                    <?php
                                            } else {
                                            }
                                    ?>
                                    <tr>
                                        <td><?php //echo $secondCounting; 
                                            ?>#</td>
                                        <td><?php echo $queryResult['test_parameter']; ?></td>
                                        <td><?php echo $queryResult['test_result'];
                                            ++$secondCounting; ?></td>
                                    </tr>
                            <?php
                                            ++$checkingParameters;
                                        } else {
                                            if (count($testSubPara) >= 1) {
                                                $backcheck = count($testSubPara) - 1;
                                                if ($testSubPara[$backcheck] != $queryResult['sub_parameters']) {
                                                    $testSubPara[$subCount] = $queryResult['sub_parameters'];
                                                }

                                                $testParas[$subCount] = $queryResult['test_parameter'];
                                                $testResult[$subCount] = $queryResult['test_result'];
                                            } elseif (count($testSubPara) < 1) {
                                                $testParas[$subCount] = $queryResult['test_parameter'];
                                                $testSubPara[$subCount] = $queryResult['sub_parameters'];
                                                $testResult[$subCount] = $queryResult['test_result'];
                                            } else {
                                            }
                                        }
                                    }
                                    ++$subCount;
                                }
                                if (is_array($testSubPara) && count($testSubPara) > 1) {
                                    $sub_numb = count($testSubPara);
                            ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>PARAMETERS</th>
                                            <?php
                                            foreach ($testSubPara as $sub) {
                                            ?>
                                                <th><?php echo $sub; ?></th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($rr = 0; $rr < count($testParas); ++$rr) {
                                        ?>
                                            <tr>
                                                <td><?php echo $testParas[$rr]; ?></td>
                                                <?php
                                                for ($ee = 0; $ee < count($testSubPara); ++$ee) {
                                                ?>
                                                    <td><?php echo $testResult[$testCountings]; ?></td>
                                            </tr>
                    <?php
                                                    ++$testCountings;
                                                }
                                                $testCountings = $ee;
                                            }
                                        } else {
                                        }
                                    } else {
                                    }
                                } else {
                                }
                                ++$firstCount;
                            }
                    ?>

                                    </tbody>
                                </table>
                            </div>
                        <?php
                    } else {
                    }
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


                function showTestRemarks($appointmentNumber)
                {
                    include 'fabinde.php';

                    $returnComments = "";
                    $search = mysqli_query($con, "SELECT * FROM test_remarks WHERE appointment_no='$appointmentNumber'");
                    if (mysqli_num_rows($search) >= 1) {
                        while ($found = mysqli_fetch_assoc($search)) {
                            $returnComments = $found['remarks'];
                        }
                    } else {
                        $returnComments = "no remarks found";
                    }

                    return $returnComments;
                }
                function numberOfParameters($refNumber)
                {
                    include 'fabinde.php';
                    $returnStatement = "";

                    $returnParameneter = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$refNumber'");
                    if (mysqli_num_rows($returnParameneter) >= 1) {
                        while ($result = mysqli_fetch_assoc($returnParameneter)) {
                            $returnStatement = $result['number_of_parameters'];
                        }
                    }
                    return $returnStatement;
                }

                function showSingleHaematologyTest($testRef, $appointmentNumber)
                {
                    include 'fabinde.php';

                    $patientNames = "";
                    $pat_ref = "";
                    $appointNum = "";
                    $haematologySpecimen = "";
                    $pcv = "";
                    $hb = "";
                    $tlc = "";
                    $neutrophils = "";
                    $lymphocytes = "";
                    $eosinophils = "";
                    $monocytes = "";
                    $baseophils = "";
                    $platelets = "";
                    $rbc = "";
                    $retics = "";
                    $mcv = "";
                    $mchc = "";
                    $mch = "";
                    $bleedingTime = "";
                    $clothing = "";
                    $protrombin = "";
                    $trombinTime = "";
                    $pttk = "";
                    $leCells = "";
                    $esr = "";
                    $bloodGroup = "";
                    $hbGenotype = "";
                    $malariaParasite = "";
                    $microFilaria = "";
                    $directCombs = "";
                    $testRemarks = "";
                    $test_status = "";
                    $date = "";

                    $searchTest = mysqli_query($con, "SELECT * FROM haematology WHERE test_type='$testRef' AND appointment_number='$appointmentNumber' ");
                    if (mysqli_num_rows($searchTest) >= 1) {
                        while ($found = mysqli_fetch_assoc($searchTest)) {
                            $patientNames = $found['patient_name'];
                            $pat_ref = $found['ref_number'];
                            $haematologySpecimen = $found['specimen'];
                            $pcv = $found['pcv'];
                            $hb = $found['hb'];
                            $tlc = $found['tlc'];
                            $neutrophils = $found['neutrophils'];
                            $lymphocytes = $found['lymphocytes'];
                            $eosinophils = $found['eosinophils'];
                            $monocytes = $found['monocytes'];
                            $baseophils = $found['baseophils'];
                            $platelets = $found['plateletes'];
                            $rbc = $found['rbc'];
                            $retics = $found['retics'];
                            $mcv = $found['mcv'];
                            $mchc = $found['mchc'];
                            $mch = $found['mch'];
                            $bleedingTime = $found['bleeding_time'];
                            $clothing = $found['clothing_time'];
                            $protrombin = $found['protrobim'];
                            $trombinTime = $found['trombim_time'];
                            $pttk = $found['pttk'];
                            $leCells = $found['le_cells'];
                            $esr = $found['esr'];
                            $bloodGroup = $found['blood_group'];
                            $hbGenotype = $found['hb_genotype'];
                            $malariaParasite = $found['malaria_parasites'];
                            $microFilaria = $found['micro_filaria'];
                            $directCombs = $found['direct_combs_test'];
                            $testRemarks = $found['scientist_remarks'];
                            $date = $found['date_updated'];
                        }
                        ?>
                            <div class="text-center">
                                <h3>HAEMATOLOGY TEST RESULT</h3>
                            </div>
                            <div class="text-center">
                                <h3><?php echo testNames($testRef); ?></h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5>SPECIMEN COLLECTED: <strong><?php echo strtoupper($haematologySpecimen); ?></strong></h5>
                                    <h5></h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>Test</th>
                                            <th>UM</th>
                                            <th>Result</th>
                                            <th>N/A</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PCV</td>
                                            <td>%</td>
                                            <td><?php echo $pcv; ?></td>
                                            <td>30 - 54</td>
                                        </tr>
                                        <tr>
                                            <td>HB</td>
                                            <td>g/dl</td>
                                            <td><?php echo $hb; ?></td>
                                            <td>12 - 16g/dl</td>
                                        </tr>
                                        <tr>
                                            <td>TLC</td>
                                            <td>X10 9/L</td>
                                            <td><?php echo $tlc; ?></td>
                                            <td>4.1 - 11</td>
                                        </tr>
                                        <tr>
                                            <td>NEUTROPHILS</td>
                                            <td>%</td>
                                            <td><?php echo $neutrophils; ?></td>
                                            <td>40 - 75</td>
                                        </tr>
                                        <tr>
                                            <td>LYMPHOCYTES</td>
                                            <td>%</td>
                                            <td><?php echo $lymphocytes; ?></td>
                                            <td>25 - 40</td>
                                        </tr>
                                        <tr>
                                            <td>EOSINOPHILS</td>
                                            <td>%</td>
                                            <td><?php echo $eosinophils; ?></td>
                                            <td>0 - 7</td>
                                        </tr>
                                        <tr>
                                            <td>MONOCYTES</td>
                                            <td>%</td>
                                            <td><?php echo $monocytes; ?></td>
                                            <td>2 - 20</td>
                                        </tr>
                                        <tr>
                                            <td>BASEOPHILS</td>
                                            <td>%</td>
                                            <td><?php echo $baseophils; ?></td>
                                            <td>0 - 1</td>
                                        </tr>
                                        <tr>
                                            <td>PLATELETS</td>
                                            <td>X10 9/L</td>
                                            <td><?php echo $platelets; ?></td>
                                            <td>140 - 400</td>
                                        </tr>
                                        <tr>
                                            <td>RBC</td>
                                            <td>X10<sup>12/L</sup></td>
                                            <td><?php echo $rbc; ?></td>
                                            <td>4.8 - 5.5</td>
                                        </tr>
                                        <tr>
                                            <td>RETICS</td>
                                            <td>%</td>
                                            <td><?php echo $retics; ?></td>
                                            <td>0 - 2</td>
                                        </tr>
                                        <tr>
                                            <td>MCV</td>
                                            <td>FL</td>
                                            <td><?php echo $mcv; ?></td>
                                            <td>80 - 95</td>
                                        </tr>
                                        <tr>
                                            <td>MCHC</td>
                                            <td>g/dl</td>
                                            <td><?php echo $mchc; ?></td>
                                            <td>30 - 35</td>
                                        </tr>
                                        <tr>
                                            <td>MCH</td>
                                            <td>pg</td>
                                            <td><?php echo $mch; ?></td>
                                            <td>27 - 32</td>
                                        </tr>
                                        <tr>
                                            <td>BLEEDING TIME</td>
                                            <td>mins</td>
                                            <td><?php echo $bleedingTime; ?></td>
                                            <td>2 - 7</td>
                                        </tr>
                                        <tr>
                                            <td>CLOTTING TIME</td>
                                            <td>mins</td>
                                            <td><?php echo $clothing; ?></td>
                                            <td>5 - 11</td>
                                        </tr>
                                        <tr>
                                            <td>PROTROBIM TIME</td>
                                            <td>secs</td>
                                            <td><?php echo $protrombin; ?></td>
                                            <td>10 - 14</td>
                                        </tr>
                                        <tr>
                                            <td>TROMBIN TIME</td>
                                            <td>secs</td>
                                            <td><?php echo $trombinTime; ?></td>
                                            <td>13 - 15</td>
                                        </tr>
                                        <tr>
                                            <td>PTTK</td>
                                            <td>secs</td>
                                            <td><?php echo $pttk; ?></td>
                                            <td>35 - 43</td>
                                        </tr>
                                        <tr>
                                            <td>LE CELLS</td>
                                            <td>%</td>
                                            <td><?php echo $leCells; ?></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>ESR</td>
                                            <td>mm/HR</td>
                                            <td><?php echo $esr; ?></td>
                                            <td>M= 3 - 5<br>F= 4 - 7</td>
                                        </tr>
                                        <tr>
                                            <td>BLOOD GROUP</td>
                                            <td>-</td>
                                            <td><?php echo $bloodGroup; ?></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>HB GENOTYPE</td>
                                            <td>-</td>
                                            <td><?php echo $hbGenotype; ?></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>MALARIA PARASITES</td>
                                            <td>-</td>
                                            <td><?php echo $malariaParasite; ?></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>MICRO-FILARIA</td>
                                            <td>-</td>
                                            <td><?php echo $microFilaria; ?></td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>DIRECT COMBS TEST</td>
                                            <td>-</td>
                                            <td><?php echo $directCombs; ?></td>
                                            <td>-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="invoice-info" style="margin-top:30px;">
                                <h5>Scientist Remark</h5>
                                <p class="text-muted"> <?php echo $testRemarks; ?></p>
                            </div>

                        <?php
                        $resistivity = mysqli_query($con,"SELECT * FROM resistivity WHERE appointment_number='$appointmentNumber' ");
                        if(mysqli_num_rows($resistivity) >= 1)
                        {
                            while($re = mysqli_fetch_assoc($resistivity))
                            {
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table">
                                        <tr>
                                            <th rowspan="2">ANTIBIOTICS</th>
                                            <td></td>
                                            <th colspan="2" class="text-center">ORGANISMS/SENSITIVITY</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">NO. 1</td>
                                            <td class="text-center">NO. 2</td>
                                            <td class="text-center">NO. 3</td>
                                            <td class="text-center">NO. 4</td>
                                        </tr>
                                        <tr>
                                            <td>PENICILLIN</td>
                                            <td><?php echo $re['penicilin_one']; ?></td>
                                            <td><?php echo $re['penicilin_two']; ?></td>
                                            <td><?php echo $re['penicilin_three']; ?></td>
                                            <td><?php echo $re['penicilin_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>AMPICILLIN</td>
                                            <td><?php echo $re['ampicillin_one']; ?></td>
                                            <td><?php echo $re['ampicillin_two']; ?></td>
                                            <td><?php echo $re['ampicillin_three']; ?></td>
                                            <td><?php echo $re['ampicillin_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>STREPTOMYCIN</td>
                                            <td><?php echo $re['streptomycin_one']; ?></td>
                                            <td><?php echo $re['streptomycin_two']; ?></td>
                                            <td><?php echo $re['streptomycin_three']; ?></td>
                                            <td><?php echo $re['streptomycin_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>CHLORAMPENICOL</td>
                                            <td><?php echo $re['chlorampenicol_one']; ?></td>
                                            <td><?php echo $re['chlorampenicol_two']; ?></td>
                                            <td><?php echo $re['chlorampenicol_three']; ?></td>
                                            <td><?php echo $re['chlorampenicol_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>TETRACYCLINE</td>
                                            <td><?php echo $re['tetracycline_one']; ?></td>
                                            <td><?php echo $re['tetracycline_two']; ?></td>
                                            <td><?php echo $re['tetracycline_three']; ?></td>
                                            <td><?php echo $re['tetracycline_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>ERYTHTOMYCINE</td>
                                            <td><?php echo $re['erithtomycine_one']; ?></td>
                                            <td><?php echo $re['erithtomycine_two']; ?></td>
                                            <td><?php echo $re['erithtomycine_three']; ?></td>
                                            <td><?php echo $re['erithtomycine_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>SEPTRIN</td>
                                            <td><?php echo $re['septrin_one']; ?></td>
                                            <td><?php echo $re['septrin_two']; ?></td>
                                            <td><?php echo $re['septrin_three']; ?></td>
                                            <td><?php echo $re['septrin_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>CLOXACILLIN</td>
                                            <td><?php echo $re['cloxacilin_one']; ?></td>
                                            <td><?php echo $re['cloxacilin_two']; ?></td>
                                            <td><?php echo $re['cloxacilin_three']; ?></td>
                                            <td><?php echo $re['cloxacilin_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>CONTRIMOXAZOLE</td>
                                            <td><?php echo $re['contrimoxazole_one']; ?></td>
                                            <td><?php echo $re['contrimoxazole_two']; ?></td>
                                            <td><?php echo $re['contrimoxazole_three']; ?></td>
                                            <td><?php echo $re['contrimoxazole_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>FURADANTINE</td>
                                            <td><?php echo $re['furadantine_one']; ?></td>
                                            <td><?php echo $re['furadantine_two']; ?></td>
                                            <td><?php echo $re['furadantine_three']; ?></td>
                                            <td><?php echo $re['furadantine_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>NALIDIXIC ACID</td>
                                            <td><?php echo $re['nalidixic_acid_one']; ?></td>
                                            <td><?php echo $re['nalidixic_acid_two']; ?></td>
                                            <td><?php echo $re['nalidixic_acid_three']; ?></td>
                                            <td><?php echo $re['nalidixic_acid_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>COLISTIN SULPHATE</td>
                                            <td><?php echo $re['colistin_suphate_one']; ?></td>
                                            <td><?php echo $re['colistin_suphate_two']; ?></td>
                                            <td><?php echo $re['colistin_suphate_three']; ?></td>
                                            <td><?php echo $re['colistin_suphate_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>GENTICIN</td>
                                            <td><?php echo $re['genticin_one']; ?></td>
                                            <td><?php echo $re['genticin_two']; ?></td>
                                            <td><?php echo $re['genticin_three']; ?></td>
                                            <td><?php echo $re['genticin_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>ARITHROMYCINE</td>
                                            <td><?php echo $re['arithromycine_one']; ?></td>
                                            <td><?php echo $re['arithromycine_two']; ?></td>
                                            <td><?php echo $re['arithromycine_three']; ?></td>
                                            <td><?php echo $re['arithromycine_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>CEFTAZIDIME</td>
                                            <td><?php echo $re['ceftazidime_one']; ?></td>
                                            <td><?php echo $re['ceftazidime_two']; ?></td>
                                            <td><?php echo $re['ceftazidime_three']; ?></td>
                                            <td><?php echo $re['ceftazidime_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>CIPROFLOXACIN</td>
                                            <td><?php echo $re['ciprofloxacin_one']; ?></td>
                                            <td><?php echo $re['ciprofloxacin_two']; ?></td>
                                            <td><?php echo $re['ciprofloxacin_three']; ?></td>
                                            <td><?php echo $re['ciprofloxacin_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>OFLOXACIN(TARVID)</td>
                                            <td><?php echo $re['ofloxacin_one']; ?></td>
                                            <td><?php echo $re['ofloxacin_two']; ?></td>
                                            <td><?php echo $re['ofloxacin_three']; ?></td>
                                            <td><?php echo $re['ofloxacin_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>CEFTRIAOXONE</td>
                                            <td><?php echo $re['ceftriaoxone_one']; ?></td>
                                            <td><?php echo $re['ceftriaoxone_two']; ?></td>
                                            <td><?php echo $re['ceftriaoxone_three']; ?></td>
                                            <td><?php echo $re['ceftriaoxone_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>ZINNAT</td>
                                            <td><?php echo $re['zinnat_one']; ?></td>
                                            <td><?php echo $re['zinnat_two']; ?></td>
                                            <td><?php echo $re['zinnat_three']; ?></td>
                                            <td><?php echo $re['zinnat_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>ROCEPHINE</td>
                                            <td><?php echo $re['rocephine_one']; ?></td>
                                            <td><?php echo $re['rocephine_two']; ?></td>
                                            <td><?php echo $re['rocephine_three']; ?></td>
                                            <td><?php echo $re['rocephine_four']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>UNASYM</td>
                                            <td><?php echo $re['unasym_one']; ?></td>
                                            <td><?php echo $re['unasym_two']; ?></td>
                                            <td><?php echo $re['unasym_three']; ?></td>
                                            <td><?php echo $re['unasym_four']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <h3>S = SENSITIVITY</h3>
                                <h3>R = RESISTANT</h3>
                            <?php
                            }
                        }
                        else
                        {}
                    } 
                    else
                    {}
                }

                function showSingleClinicalChemistry($testRef, $appointmentNumber)
                {
                    include 'fabinde.php';
                    $chemistrySpecimen = "";
                    $bicarbonate = "";
                    $chloride = "";
                    $sodium = "";
                    $potassium = "";
                    $sgpt = "";
                    $sgot = "";
                    $alkalinePhosphatase = "";
                    $amylase = "";
                    $acidphosphataseTotal = "";
                    $acidphosphataseProtactic = "";
                    $uricAcid = "";
                    $cholesterol = "";
                    $albumin = "";
                    $protein;
                    $bilirubinTotal = "";
                    $bilirubinDirect = "";
                    $urea = "";
                    $tryglyceride = "";
                    $ggt = "";
                    $ldl = "";
                    $hdlCholesterol = "";
                    $creatinine = "";
                    $inorganicPhosphorous = "";
                    $iron = "";
                    $calcium = "";
                    $ck = "";
                    $bloodSugarFasting = "";
                    $bloodSugarRandom = "";
                    $hbAlcNonDiabetic = "";
                    $hbAlcUncontrolledDiabetic = "";
                    $bloodfast = "";
                    $bloodhalfHour = "";
                    $bloodOneHour = "";
                    $bloodOneAndHalfHour = "";
                    $bloodTwoHour = "";
                    $bloodTwoAndHalfHour = "";
                    $urineFast = "";
                    $urineHalfHour = "";
                    $urineOneHour = "";
                    $urineOneAndHalfHour = "";
                    $urineTwoHour = "";
                    $urineTwoAndHalfHour = "";
                    $csfGlucose = "";
                    $csfProtein = "";
                    $urinePh = "";
                    $urineProtein = "";
                    $urineGlucose = "";
                    $urineBilirubin = "";
                    $urineLeucocytes = "";
                    $urineBlood = "";
                    $urineAppearance = "";
                    $urineMicroscop = "";
                    $urineSrGr = "";
                    $urineNitrite = "";
                    $urineKetones = "";
                    $urineUrobilnogen = "";
                    $testStatus = "";

                    $getResult = mysqli_query($con, "SELECT * FROM clinical_chemistry WHERE test_type='$testRef' AND appointment_number='$appointmentNumber'");
                    if (mysqli_num_rows($getResult) >= 1) {
                        while ($feeds = mysqli_fetch_assoc($getResult)) {
                            $chemistrySpecimen = $feeds['specimen'];
                            $bicarbonate = $feeds['bicarbonate'];
                            $chloride = $feeds['chloride'];
                            $sodium = $feeds['sodium'];
                            $potassium = $feeds['potassium'];
                            $sgpt = $feeds['sgpt'];
                            $sgot = $feeds['sgot'];
                            $alkalinePhosphatase = $feeds['alkaline_phosphate'];
                            $amylase = $feeds['amylase'];
                            $acidphosphataseTotal = $feeds['acid_phosphatase_total'];
                            $acidphosphataseProtactic = $feeds['acid_phosphatase_prostatic'];
                            $uricAcid = $feeds['uric_acid'];
                            $cholesterol = $feeds['cholesterol'];
                            $albumin = $feeds['albumin'];
                            $protein = $feeds['protein'];
                            $bilirubinTotal = $feeds['bilirubin_total'];
                            $bilirubinDirect = $feeds['bilirubin_direct'];
                            $urea = $feeds['urea'];
                            $tryglyceride = $feeds['tryglyceride'];
                            $ggt = $feeds['ggt'];
                            $ldl = $feeds['ldl'];
                            $hdlCholesterol = $feeds['hdl_cholesterol'];
                            $creatinine = $feeds['creatanine'];
                            $inorganicPhosphorous = $feeds['inorganic_phosphorous'];
                            $iron = $feeds['iron'];
                            $calcium = $feeds['calcium'];
                            $ck = $feeds['ck'];
                            $bloodSugarFasting = $feeds['blood_sugar_fasting'];
                            $bloodSugarRandom = $feeds['blood_sugar_random'];
                            $hbAlcNonDiabetic = $feeds['hb_alc_none_diabetic'];
                            $hbAlcUncontrolledDiabetic = $feeds['hb_alc_uncontrolled_diabetic'];
                            $bloodfast = $feeds['gtt_blood_fasting'];
                            $bloodhalfHour = $feeds['gtt_blood_half_hour'];
                            $bloodOneHour = $feeds['gtt_blood_one_hour'];
                            $bloodOneAndHalfHour = $feeds['gtt_blood_onehalf_hour'];
                            $bloodTwoHour = $feeds['gtt_blood_two_hour'];
                            $bloodTwoAndHalfHour = $feeds['gtt_blood_twohalf_hour'];
                            $urineFast = $feeds['gtt_urine_fasting'];
                            $urineHalfHour = $feeds['gtt_urine_half_hour'];
                            $urineOneHour = $feeds['gtt_urine_one_hour'];
                            $urineOneAndHalfHour = $feeds['gtt_urine_onehalf_hour'];
                            $urineTwoHour = $feeds['gtt_urine_two_hour'];
                            $urineTwoAndHalfHour = $feeds['gtt_urine_twohalf_hour'];
                            $csfGlucose = $feeds['csf_glucose'];
                            $csfProtein = $feeds['csf_protein'];
                            $urinePh = $feeds['urine_ph'];
                            $urineProtein = $feeds['urine_protein'];
                            $urineGlucose = $feeds['urine_glucose'];
                            $urineBilirubin = $feeds['urine_bilirubin'];
                            $urineLeucocytes = $feeds['urine_leucocyte'];
                            $urineBlood = $feeds['urine_blood'];
                            $urineAppearance = $feeds['urine_appearance'];
                            $urineMicroscop = $feeds['urine_microscopy'];
                            $urineSrGr = $feeds['urine_srgr'];
                            $urineNitrite = $feeds['urine_nitrite'];
                            $urineKetones = $feeds['urine_ketone'];
                            $urineUrobilnogen = $feeds['urine_urobilnogen'];
                            $testComment = $feeds['result_comment'];
                        }
                        ?>
                            <div class="text-center">
                                <h3>CHEMISTRY TEST RESULT</h3>
                            </div>
                            <div class="text-center">
                                <h3><?php echo testNames($testRef); ?></h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5>SPECIMEN COLLECTED: <strong><?php echo strtoupper($chemistrySpecimen); ?></strong></h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>PARAMETER</th>
                                            <th>RESULTS</th>
                                            <th>NORMAL VALUES (S.I UNITS)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bicarbonate</td>
                                            <td><?php echo $bicarbonate; ?></td>
                                            <td>21 - 28 mmol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Chloride</td>
                                            <td><?php echo $chloride; ?></td>
                                            <td>95 - 110 mmol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Sodium</td>
                                            <td><?php echo $sodium; ?></td>
                                            <td>135 - 145 mmol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Potassium</td>
                                            <td><?php echo $potassium; ?></td>
                                            <td>3.5 - 5.5 mmol/l</td>
                                        </tr>
                                        <tr>
                                            <td>SGPT</td>
                                            <td><?php echo $sgpt; ?></td>
                                            <td>0 - 40 u/l</td>
                                        </tr>
                                        <tr>
                                            <td>SGOT</td>
                                            <td><?php echo $sgot; ?></td>
                                            <td>0 - 40 u/l</td>
                                        </tr>
                                        <tr>
                                            <td>Alkaline Phosphatase</td>
                                            <td><?php echo $alkalinePhosphatase; ?></td>
                                            <td>50 - 250 u/l <br> (adult) 150-600u/l (Neonate)</td>
                                        </tr>
                                        <tr>
                                            <td>Amylase</td>
                                            <td><?php echo $amylase; ?></td>
                                            <td>22 - 100 u/l</td>
                                        </tr>
                                        <tr>
                                            <td>Acid Phosphatase (Total)</td>
                                            <td><?php echo $acidphosphataseTotal; ?></td>
                                            <td>up to 11.0 u/l (37<sup>0</sup>C)</td>
                                        </tr>
                                        <tr>
                                            <td>Acid Phosphatase (prostatic)</td>
                                            <td><?php echo $acidphosphataseProtactic; ?></td>
                                            <td>up to 4.0 u/l (37<sup>0</sup>C)</td>
                                        </tr>
                                        <tr>
                                            <td>Uric Acid</td>
                                            <td><?php echo $uricAcid; ?></td>
                                            <td>142 - 416 umol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Cholesterol</td>
                                            <td><?php echo $cholesterol; ?></td>
                                            <td>3.89 - 6.48 mmol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Albumin</td>
                                            <td><?php echo $albumin; ?></td>
                                            <td>34 - 52 gm/l</td>
                                        </tr>
                                        <tr>
                                            <td>Protein</td>
                                            <td><?php echo $protein; ?></td>
                                            <td>66 - 88 gm/l</td>
                                        </tr>
                                        <tr>
                                            <td>Bilirubin Total</td>
                                            <td><?php echo $bilirubinTotal; ?></td>
                                            <td>0 - 17 umol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Bilirubin Direct</td>
                                            <td><?php echo $bilirubinDirect; ?></td>
                                            <td>0 - 4.3 umol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Urea</td>
                                            <td><?php echo $urea; ?></td>
                                            <td>1.66 - 9.1 mmol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Triglyceride</td>
                                            <td><?php echo $tryglyceride; ?></td>
                                            <td>0.52 - 1.95</td>
                                        </tr>
                                        <tr>
                                            <td>GGT</td>
                                            <td><?php echo $ggt; ?></td>
                                            <td>Up to 450 u/l</td>
                                        </tr>
                                        <tr>
                                            <td>LDL</td>
                                            <td><?php echo $ldl; ?></td>
                                            <td>
                                                < 4.0 mmol/l</td>
                                        </tr>
                                        <tr>
                                            <td>HDL Cholesterol</td>
                                            <td><?php echo $hdlCholesterol; ?></td>
                                            <td>Men 0.91 - 1.43 mmol/l<br>Women 1.17 - 1.69 mmol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Creatinine</td>
                                            <td><?php echo $creatinine; ?></td>
                                            <td>44 106 umol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Inorganic Phosphorous</td>
                                            <td><?php echo $inorganicPhosphorous; ?></td>
                                            <td>Adult 0.81 - 1.45 umol/l<br>Children 1.20 - 2.26 umol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Iron</td>
                                            <td><?php echo $iron; ?></td>
                                            <td>Men 10.6 - 28.3 umol/l<br>Women 6.6 - 26.0 umol/l<br>37 - 145mg%</td>
                                        </tr>
                                        <tr>
                                            <td>Calcium</td>
                                            <td><?php echo $calcium; ?></td>
                                            <td>2.02 2.60 mmol/l</td>
                                        </tr>
                                        <tr>
                                            <td>CK</td>
                                            <td><?php echo $ck; ?></td>
                                            <td>Men 0 - 270 u/l<br>Women 0 - 150 u/l</td>
                                        </tr>
                                        <tr>
                                            <td>Blood Sugar (Fasting)</td>
                                            <td><?php echo $bloodSugarFasting; ?></td>
                                            <td>3.35 - 5.75 mmol/l</td>
                                        </tr>
                                        <tr>
                                            <td>Blood Sugar (Random)</td>
                                            <td><?php echo $bloodSugarRandom; ?></td>
                                            <td>up to 9.44 mmol/l</td>
                                        </tr>
                                        <tr>
                                            <td>HbAlc (Non diabetics)</td>
                                            <td><?php echo $hbAlcNonDiabetic; ?></td>
                                            <td>6.0 - 8.3 %</td>
                                        </tr>
                                        <tr>
                                            <td>(Uncontrolled Diabetics)</td>
                                            <td><?php echo $hbAlcUncontrolledDiabetic; ?></td>
                                            <td>> 10.0%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <br>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5 class="text-center"><strong>GTT (mmol/L)</strong></h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>Mg/d1</th>
                                            <th>Fasting</th>
                                            <th><span>&#189;</span> hr</th>
                                            <th>1 hr</th>
                                            <th>1<span>&#189;</span> hr</th>
                                            <th>2 hr</th>
                                            <th>2<span>&#189;</span> hr</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Blood</td>
                                            <td><?php echo $bloodfast; ?></td>
                                            <td><?php echo $bloodhalfHour; ?></td>
                                            <td><?php echo $bloodOneHour; ?></td>
                                            <td><?php echo $bloodOneAndHalfHour; ?></td>
                                            <td><?php echo $bloodTwoHour; ?></td>
                                            <td><?php echo $bloodTwoAndHalfHour; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Urine</td>
                                            <td><?php echo $urineFast; ?></td>
                                            <td><?php echo $urineHalfHour; ?></td>
                                            <td><?php echo $urineOneHour; ?></td>
                                            <td><?php echo $urineOneAndHalfHour; ?></td>
                                            <td><?php echo $urineTwoHour; ?></td>
                                            <td><?php echo $urineTwoAndHalfHour; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>CSF</th>
                                            <th>RESULT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Glucose (45 - 85) mmol/l</td>
                                            <td><?php echo $csfGlucose; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Protein Total (15 - 45)<br>(10 - 45) mmol/l</td>
                                            <td><?php echo $urineProtein; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <br>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5 class="text-center"><strong>URINE</strong></h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>PARAMETERS</th>
                                            <th>RESULT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>pH</td>
                                            <td><?php echo $urinePh; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Protein</td>
                                            <td><?php echo $urineProtein; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Glucose</td>
                                            <td><?php echo $urineGlucose; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bilirubin</td>
                                            <td><?php echo $urineBilirubin; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Leucocytes</td>
                                            <td><?php echo $urineLeucocytes; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Blood</td>
                                            <td><?php echo $urineBlood; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Appearance</td>
                                            <td><?php echo $urineAppearance; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Microscopy</td>
                                            <td><?php echo $urineMicroscop; ?></td>
                                        </tr>
                                        <tr>
                                            <td>SR. Gr</td>
                                            <td><?php echo $urineSrGr; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nitrite</td>
                                            <td><?php echo $urineNitrite; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ketones</td>
                                            <td><?php echo $urineKetones; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Urobilinogen</td>
                                            <td><?php echo $urineUrobilnogen; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                    } else {
                    }
                }

                function showSingleMicroBiology($testRef, $appointmentNumber)
                {
                    include 'fabinde.php';

                    $microBiologySpecimen = "";
                    $protein = "";
                    $glucose = "";
                    $ketone = "";
                    $appearance = "";
                    $microscopy = "";
                    $bilirubin = "";
                    $urobilinogen = "";
                    $nitrites = "";
                    $leucocytes = "";
                    $blood = "";
                    $saltyphd = "";
                    $saltyphDs = "";
                    $salparatypha = "";
                    $salparatyphAs = "";
                    $salparatyphb = "";
                    $salparatyphBs = "";
                    $salparatyphc = "";
                    $salparatyphCs = "";
                    $testRemarks = "";
                    $macroscopy = "";
                    $microscopy_other = "";
                    $cultureAndSerology = "";
                    $urinePhValue = "";
                    $spgr = "";

                    $select = mysqli_query($con, "SELECT * FROM microbiology WHERE test_type='$testRef' AND appointment_number='$appointmentNumber'");
                    if (mysqli_num_rows($select) >= 1) {
                        while ($result = mysqli_fetch_assoc($select)) {
                            $microBiologySpecimen = $result['specimen'];
                            $urinePhValue = $result['urine_ph'];
                            $spgr = $result['spgr'];
                            $protein = $result['protein'];
                            $glucose = $result['glucose'];
                            $ketone = $result['ketone'];
                            $appearance = $result['appearance'];
                            $microscopy = $result['microscopy'];
                            $bilirubin = $result['bilirubin'];
                            $urobilinogen = $result['urobilinogen'];
                            $nitrites = $result['nitrites'];
                            $leucocytes = $result['leucocyte'];
                            $blood = $result['blood'];
                            $saltyphd = $result['saltyphh'];
                            $saltyphDs = $result['saltypho'];
                            $salparatypha = $result['salparatyphia_smallah'];
                            $salparatyphAs = $result['salparatyphi_bigao'];
                            $salparatyphb = $result['salparatyphia_smallbh'];
                            $salparatyphBs = $result['salparatyphi_bigbo'];
                            $salparatyphc = $result['salparatyphia_smallch'];
                            $salparatyphCs = $result['salparatyphia_bigch'];
                            $testRemarks = $result['microbiology_comment'];
                            $macroscopy = $result['macroscopy'];
                            $microscopy_other = $result['microscopy_result'];
                            $cultureAndSerology = $result['culture_serology'];
                        }
                        ?>
                            <div class="text-center">
                                <h3>MICROBIOLOGY TEST RESULT</h3>
                            </div>
                            <div class="text-center">
                                <h3><?php echo testNames($testRef); ?></h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5>SPECIMEN COLLECTED: <strong><?php echo strtoupper($microBiologySpecimen); ?></strong></h5>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title d-inline-block">URINE</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="col-lg-8 offset-lg-2">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-striped custom-table">
                                                        <thead>
                                                            <tr>
                                                                <th>PARAMETER</th>
                                                                <th>RESULTS</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>PH</td>
                                                                <td><?php echo $urinePhValue; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SP.Gr.</td>
                                                                <td><?php echo $spgr; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Protein</td>
                                                                <td><?php echo $protein; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Glucose</td>
                                                                <td><?php echo $glucose; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ketones</td>
                                                                <td><?php echo $ketone; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Appearance</td>
                                                                <td><?php echo $appearance; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Microscopy</td>
                                                                <td><?php echo $microscopy; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Bilirubin</td>
                                                                <td><?php echo $bilirubin; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Urobilinogen</td>
                                                                <td><?php echo $urobilinogen; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nitrites</td>
                                                                <td><?php echo $nitrites; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Leucocytes</td>
                                                                <td><?php echo $leucocytes; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Blood</td>
                                                                <td><?php echo $blood; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title d-inline-block">WIDAL TEST</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="col-lg-8 offset-lg-2">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-striped custom-table">
                                                        <thead>
                                                            <th>SALMONELLA ORGANISMS</th>
                                                            <th>.</th>
                                                            <th>"H"<br>ANTIBODY TITRE</th>
                                                            <th>.</th>
                                                            <th>"O"<br>ANTIBODY TITRE</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>SAL. TYPH</td>
                                                                <td>d</td>
                                                                <td><?php echo $saltyphd; ?></td>
                                                                <td>D</td>
                                                                <td><?php echo $saltyphDs; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SAL. PARATYPHI</td>
                                                                <td>a</td>
                                                                <td><?php echo $salparatypha; ?></td>
                                                                <td>A</td>
                                                                <td><?php echo $salparatyphAs; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SAL. PARATYPHI</td>
                                                                <td>b</td>
                                                                <td><?php echo $salparatyphb; ?></td>
                                                                <td>B</td>
                                                                <td><?php echo $salparatyphBs; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SAL. PARATYPHI</td>
                                                                <td>c</td>
                                                                <td><?php echo $salparatyphc; ?></td>
                                                                <td>C</td>
                                                                <td><?php echo $salparatyphCs; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="invoice-info" style="margin-top:30px;">
                                                <h5>Comment</h5>
                                                <p class="text-muted"> <?php echo $testRemarks; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <th>OTHER SAMPLES</th>
                                            <th>RESULT</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>MACROSCOPY</td>
                                                <td><?php echo $macroscopy; ?></td>
                                            </tr>
                                            <tr>
                                                <td>MICROSCOPY</td>
                                                <td><?php echo $microscopy_other; ?></td>
                                            </tr>
                                            <tr>
                                                <td>CULTURE/SEROLOGY</td>
                                                <td><?php echo $cultureAndSerology; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        <?php
                    } else {
                    }
                }

                function showOther($tts,$appointmentNumber)
                {
                    include 'fabinde.php';
                    $test_type = "";
                    $test_specimen = "";
                    $test_result = "";
                    $unit_of_measure = "";
                    $clinical_diagnosis = "";

                    $select = mysqli_query($con,"SELECT * FROM other_result WHERE appointment_number='$appointmentNumber' AND test_type='$tts' ");
                    if(mysqli_num_rows($select) >= 1)
                    {
                        while($result = mysqli_fetch_assoc($select))
                        {
                        ?>
                            <div class="text-center">
                                <h3><?php echo strtoupper(testNames($testRef)); ?> TEST RESULT</h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5>SPECIMEN COLLECTED: <strong><?php echo strtoupper($result['test_specimen']); ?></strong></h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <tead>
                                        <th>TEST</th>
                                        <th>RESULT</th>
                                        <th>S.I Unit</th>
                                    </tead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo testNames($testRef); ?></td>
                                            <td><?php echo $result['test_result']; ?></td>
                                            <td><?php echo $result['unit_of_measure']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="invoice-info" style="margin-top:30px;">
                                <h5>Clinical Diagnosis</h5>
                                <p class="text-muted"> <?php echo $result['clinical_diagnosis']; ?></p>
                            </div>
                        <?php
                        }
                    }
                    else
                    {}
                }

                function showSingleSemenAnalysis($testRef, $appointmentNumber)
                {
                    include 'fabinde.php';
                    $semenSpecimenSample = "";
                    $dateOfSample = "";
                    $abstenaceDuration = "";
                    $ejaculationInterval = "";
                    $appearance = "";
                    $liquefaction = "";
                    $consistency = "";
                    $volume = "";
                    $rapidLinearProgression = "";
                    $nonLinearProgression = "";
                    $nonLinearProgressionMotility = "";
                    $immotile = "";
                    $viability = "";
                    $concentrationSpermCount = "";
                    $spermatozoalml = "";
                    $percentageNormalHeadMorphology = "";
                    $percentageLargeOvalHeadMophology = "";
                    $percentagePyriformHeadMorphology = "";
                    $percenatgeTaperingHeadMorphology = "";
                    $percenatgeAmorphousHeadMorphology = "";
                    $percenatgeDoubleHeadMorphology = "";
                    $percenatgePinHeadMorphology = "";
                    $percenatgeRoundHeadMorphology = "";
                    $percentageNormalMidpieceMorphology = "";
                    $percentageAbnormalMidpieceMorphology = "";
                    $percentageCytoplasmicMidpieceMorphology = "";
                    $percentageNormalTailMorphology = "";
                    $percentageAbnormalTailMorphology = "";
                    $agglutination = "";
                    $yesAgglutination = "";
                    $microscopy = "";
                    $comment = "";

                    $select = mysqli_query($con, "SELECT * FROM semen_analysis WHERE test_type='$testRef' AND appointment_number='$appointmentNumber'");
                    if (mysqli_num_rows($select) >= 1) {
                        while ($result = mysqli_fetch_assoc($select)) {
                            $semenSpecimenSample = $result['specimen'];
                            $dateOfSample = $result['date_of_sample'];
                            $abstenaceDuration = $result['duration_of_abstenance'];
                            $ejaculationInterval = $result['ejaculation_analysis_interval'];
                            $appearance = $result['appearance'];
                            $liquefaction = $result['liquefaction'];
                            $consistency = $result['consistency'];
                            $volume = $result['volume'];
                            $semenPH = $result['semen_ph'];
                            $rapidLinearProgression = $result['rapid_linear_progression'];
                            $nonLinearProgression = $result['non_linear_progression'];
                            $nonLinearProgressionMotility = $result['progressive_motility'];
                            $immotile = $result['immotile'];
                            $viability = $result['viability'];
                            $concentrationSpermCount = $result['concentration'];
                            $spermatozoalml = $result['spermatozoa_lml'];
                            $percentageNormalHeadMorphology = $result['morphology_head_normal'];
                            $percentageLargeOvalHeadMophology = $result['morphology_head_large_oval'];
                            $percentagePyriformHeadMorphology = $result['morphology_head_pyriform'];
                            $percenatgeTaperingHeadMorphology = $result['morphology_head_tapering'];
                            $percenatgeAmorphousHeadMorphology = $result['morphology_head_amorphous'];
                            $percenatgeDoubleHeadMorphology = $result['morphology_head_double'];
                            $percenatgePinHeadMorphology = $result['morphology_head_pin'];
                            $percenatgeRoundHeadMorphology = $result['morphology_head_round'];
                            $percentageNormalMidpieceMorphology = $result['morphology_midpiece_normal'];
                            $percentageAbnormalMidpieceMorphology = $result['morphology_midpiece_abnormal'];
                            $percentageCytoplasmicMidpieceMorphology = $result['morphology_midpiece_cytoplasmic'];
                            $percentageNormalTailMorphology = $result['morphology_tail_normal'];
                            $percentageAbnormalTailMorphology = $result['morphology_tail_abnormal'];
                            $agglutination = $result['agglutination'];
                            $yesAgglutination = $result['yes_agglutination'];
                            $microscopy = $result['microscopy'];
                            $comment = $result['test_comment'];
                        }
                        ?>
                            <div class="text-center">
                                <h3>SEMEN ANALYSIS RESULT</h3>
                            </div>
                            <div class="text-center">
                                <h3><?php echo testNames($testRef); ?></h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5>SPECIMEN COLLECTED: <strong><?php echo strtoupper($semenSpecimenSample); ?></strong></h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>PARAMETER</th>
                                            <th>RESULTS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Date Of Sample</td>
                                            <td><?php echo $dateOfSample; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Duration Of Abstenance</td>
                                            <td><?php echo $abstenaceDuration; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Interval Between Ejaculation & Start Of Analysis</td>
                                            <td><?php echo $ejaculationInterval; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Appearance</td>
                                            <td><?php echo $appearance; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Liquefaction</td>
                                            <td><?php echo $liquefaction; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Consistency</td>
                                            <td><?php echo $consistency; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Volume</td>
                                            <td><?php echo $volume; ?></td>
                                        </tr>
                                        <tr>
                                            <td>pH</td>
                                            <td><?php echo $semenPH; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Viability (% live)</td>
                                            <td><?php echo $viability; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Concentration (Sperm Count)</td>
                                            <td><?php echo $concentrationSpermCount; ?></td>
                                        </tr>
                                        <tr>
                                            <td>(Sperm Count) per Spermatozoa lml</td>
                                            <td><?php echo $spermatozoalml; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Agglutination</td>
                                            <td><?php echo $agglutination; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Agglutination (if yes)</td>
                                            <td><?php echo $yesAgglutination; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Microscopy</td>
                                            <td><?php echo $microscopy; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <h3>Motility (100 Spermatozoa)</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>PARAMETER</th>
                                            <th>RESULTS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Rapid Linear Progession</td>
                                            <td><?php echo $rapidLinearProgression; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Non-Linear Progression</td>
                                            <td><?php echo $nonLinearProgression; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Non-Progressive Motility</td>
                                            <td><?php echo $nonLinearProgressionMotility; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Immotile</td>
                                            <td><?php echo $immotile; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <h3><strong>Mophology</strong></h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5>a. Head</strong></h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>PARAMETER</th>
                                            <th>RESULTS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>% Normal</td>
                                            <td><?php echo $percentageNormalHeadMorphology; ?></td>
                                        </tr>
                                        <tr>
                                            <td>% Large Oval</td>
                                            <td><?php echo $percentageLargeOvalHeadMophology; ?></td>
                                        </tr>
                                        <tr>
                                            <td>% Pyriform</td>
                                            <td><?php echo $percentagePyriformHeadMorphology; ?></td>
                                        </tr>
                                        <tr>
                                            <td>% Tapering</td>
                                            <td><?php echo $percenatgeTaperingHeadMorphology; ?></td>
                                        </tr>
                                        <tr>
                                            <td>% Amorphous</td>
                                            <td><?php echo $percenatgeAmorphousHeadMorphology; ?></td>
                                        </tr>
                                        <tr>
                                            <td>% Double</td>
                                            <td><?php echo $percenatgeDoubleHeadMorphology; ?></td>
                                        </tr>
                                        <tr>
                                            <td>% Pin</td>
                                            <td><?php echo $percenatgePinHeadMorphology; ?></td>
                                        </tr>
                                        <tr>
                                            <td>% Round</td>
                                            <td><?php echo $percenatgeRoundHeadMorphology; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5>a. Midpiece(Neck)</strong></h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>PARAMETER</th>
                                            <th>RESULTS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>% Normal</td>
                                            <td><?php echo $percentageNormalMidpieceMorphology; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Abnormal</td>
                                            <td><?php echo $percentageAbnormalMidpieceMorphology; ?></td>
                                        </tr>
                                        <tr>
                                            <td>% Cytoplasmic Droplet</td>
                                            <td><?php echo $percentageCytoplasmicMidpieceMorphology; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5>a. Tail</strong></h5>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>PARAMETER</th>
                                            <th>RESULTS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>% Normal</td>
                                            <td><?php echo $percentageNormalTailMorphology; ?></td>
                                        </tr>
                                        <tr>
                                            <td>% Abnormal</td>
                                            <td><?php echo $percentageAbnormalTailMorphology; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="invoice-info" style="margin-top:30px;">
                                <h5>Comment</h5>
                                <p class="text-muted"> <?php echo $comment; ?></p>
                            </div>
                            <?php
                        } else {
                        }
                    }

                    function showHomonalAssays($testRef, $appointmentNumber)
                    {
                        include 'fabinde.php';
                        $select = mysqli_query($con, "SELECT * FROM homonal_assays WHERE appointment_number='$appointmentNumber' ");
                        if (mysqli_num_rows($select) >= 1) {
                            while ($result = mysqli_fetch_assoc($select)) 
                            {
                            ?>
                                <div class="text-center">
                                    <h3>HOMONAL ASSAYS TEST RESULT</h3>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6 m-b-20">
                                        <h5>SPECIMEN COLLECTED: <strong><?php echo strtoupper($result['specimen']); ?></strong></h5>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped custom-table">
                                        <thead>
                                            <th>PARAMETERS</th>
                                            <th>RESULT</th>
                                            <th>NORMAL VALUES(S.I Unit)</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Progesterone</td>
                                                <td><?php echo $result['progesterone']; ?></td>
                                                <td>
                                                    <?php echo strtoupper("FEMALE:"); ?>
                                                    <br>
                                                    Follicula phase: 0.2 - 2.0 ng/ml<br>
                                                    Ovulatory phase: 0.7 - 3.5 ng/ml<br>
                                                    Leutal phase: 3.0 - 30 ng/ml<br>
                                                    Postmenopausal: 0.1 - 0.9 ng/ml<br>
                                                    < 12 weeks of pregnancy: 11.0 - 53 ng/ml<br>
                                                    12<sup>th</sup> - 24<sup>th</sup> weeks of pregnancy: 21.5 - 83.3 ng/ml<br>
                                                    <?php echo strtoupper("MALE:"); ?> 0.2 - 1.5 ng/ml
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>LH</td>
                                                <td><?php echo $result['lh']; ?></td>
                                                <td>
                                                    <?php echo strtoupper("FEMALE:"); ?><br>
                                                    Follicula phase: 2.95 - 13.65 m/(u/mL)<br>
                                                    Ovulatory period: 13.65 - 95.75 m/(u/mL)<br>
                                                    Leutal period: 1.25 - 11.0 m/(u/mL)<br>
                                                    Menopause period: 8.24 - 55.23 m/(u/mL)<br>
                                                    <?php echo strtoupper("MALE:"); ?> 1.70 - 8.60 m/(u/mL)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>FSH</td>
                                                <td><?php echo $result['fsh']; ?></td>
                                                <td>
                                                    <?php echo strtoupper("FEMALE:"); ?><br>
                                                    Follicula phase: 4.46 - 12.43 m/(u/mL)<br>
                                                    Ovulatory period: 4.88 - 20.96 m/(u/mL)<br>
                                                    Leutal phase: 1.96 - 7.70 m/(u/mL)<br>
                                                    Menopause phase: 22.7 - 130 m/(u/mL)<br>
                                                    <?php echo strtoupper("MALE:"); ?> 1.50 - 12.40 m/(u/mL)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Estradiol</td>
                                                <td><?php echo $result['estradiol']; ?></td>
                                                <td>
                                                    <?php echo strtoupper("FEMALE:"); ?><br>
                                                    Follicula phase: 12 - 262 pg/mL<br>
                                                    Ovulatory phase: 40 - 396 pg/mL<br>
                                                    Leutal phase: 21 - 386 pg/mL<br>
                                                    Menopause: < 190 pg/mL<br>
                                                    First tamester: 145 - 2988 pg/mL<br>
                                                    Second tamester: < 1502 pg/mL<br>
                                                    <?php echo strtoupper("MALE:"); ?> < 85 pg/mL
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>prolactin</td>
                                                <td><?php echo $result['prolactin']; ?></td>
                                                <td>
                                                    <?php echo strtoupper("FEMALE:"); ?> 4.60 - 25.07 ng/mL(non gestation) <br>
                                                    <?php echo strtoupper("MALE:"); ?> 3.45 - 17.42 ng/mL
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Testosterone</td>
                                                <td><?php echo $result['testosterone']; ?></td>
                                                <td>
                                                    <?php echo strtoupper("MALE:"); ?><br>
                                                    20 - 49yrs: 1.91 - 8.41 ng/mL <br>
                                                    <span>&#8805;</span> 50yrs: 1.61 - 8.01 ng/mL <br>
                                                    <?php echo strtoupper("FEMALE:"); ?> <br>
                                                    20 - 49yrs: <span>&#8804;</span> 0.80 ng/mL <br>
                                                    <span>&#8805;</span> 50yrs: 1.61 - 0.71 ng/mL
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PSA</td>
                                                <td><?php echo $result['psa']; ?></td>
                                                <td>
                                                    < 4 ng/mL <br>
                                                    <span>&#8805;</span> 4 ng/mL(Risk of Prostate Cancer)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>HBA1C</td>
                                                <td><?php echo $result['hbalc']; ?></td>
                                                <td> < 6.5% </td>
                                            </tr>
                                            <tr>
                                                <td>B-hCG</td>
                                                <td><?php echo $result['bhcg']; ?></td>
                                                <td>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped custom-table">
                                                            <thead>
                                                                <th>weeks of pregnancy</th>
                                                                <th>range(m/u / mL)</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>5.8 - 71.2</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>
                                                                    <td>9.5 - 750</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5</td>
                                                                    <td>217 - 7,138</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>6</td>
                                                                    <td>158 - 31,795</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>7</td>
                                                                    <td>3697 - 163,563</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>8</td>
                                                                    <td>32,065 - 149,571</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>9</td>
                                                                    <td>63,803 - 151,410</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>10</td>
                                                                    <td>46,509 - 186,577</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>12</td>
                                                                    <td>27,832 - 210,612</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>14</td>
                                                                    <td>13,950 - 62,530</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>15</td>
                                                                    <td>12,039 - 70,971</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>16</td>
                                                                    <td>9,040 - 56,451</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>17</td>
                                                                    <td>8,175 - 55,868</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>18</td>
                                                                    <td>8,099 - 58,176</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="invoice-info" style="margin-top:30px;">
                                <h5>Clinical Daignosis</h5>
                                <p class="text-muted"> <?php echo $result['clinical_diagnostics']; ?></p>
                            </div>
                            <?php
                            }
                        }
                    }

                    function showSingleLaboratory($testRef, $appointmentNumber)
                    {
                        include 'fabinde.php';
                        $laboratorySpecimen = "";
                        $laboratoryReport = "";

                        $select = mysqli_query($con, "SELECT * FROM clinical_laboratory WHERE test_type='$testRef' AND appointment_number='$appointmentNumber' ");
                        if (mysqli_num_rows($select) >= 1) {
                            while ($res = mysqli_fetch_assoc($select)) {
                                $laboratorySpecimen = $res['specimen'];
                                $laboratoryReport = $res['test_report'];
                            }
                            ?>
                            <div class="text-center">
                                <h3>LABORATORY TEST RESULT</h3>
                            </div>
                            <div class="text-center">
                                <h3><?php echo testNames($testRef); ?></h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 m-b-20">
                                    <h5>SPECIMEN COLLECTED: <strong><?php echo strtoupper($laboratorySpecimen); ?></strong></h5>
                                </div>
                            </div>
                            <div class="invoice-info" style="margin-top:30px;">
                                <h5>REPORT</h5>
                                <p class="text-muted"> <?php echo $laboratoryReport ?></p>
                            </div>
                    <?php
                        } else {
                        }
                    }
                    ?>