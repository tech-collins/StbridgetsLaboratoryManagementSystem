<?php

function displayEditHeamatology($testRef, $appointNum,$patientNames,$pat_ref)
{
    include 'fabinde.php';
    $findEdith = mysqli_query($con,"SELECT * FROM haematology WHERE appointment_number='$appointNum'");
    if(mysqli_num_rows($findEdith) >= 1)
    {
        while($result = mysqli_fetch_assoc($findEdith))
        {
            ?>
    
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="update_result.php">
                        <div class="row">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Specimen <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="haematologySpecimen" value="<?php echo $result["specimen"]; ?>" required>
                                    <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                                    <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                                    <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                                    <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>PCV (%) <span class="text-danger">*</span> NA(30 - 54)</label>
                                    <input class="form-control" type="text" name="pcv" value="<?php echo $result["pcv"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>HB(g/dl) NA(12 - 16g/dl)</label>
                                    <input class="form-control" type="text" name="hb" value="<?php echo $result["hb"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>TLC(X10 9/L) NA(4.1 - 11)</label>
                                    <input class="form-control" type="text" name="tlc" value="<?php echo $result["tlc"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>NEUTROPHILS(%) NA(40 - 75)</label>
                                    <input class="form-control" type="text" name="neutrophils" value="<?php echo $result["neutrophils,"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>LYMPHOCYTES(%) NA(25 - 40)</label>
                                    <input class="form-control" type="text" name="lymphocytes" value="<?php echo $result["lymphocytes"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>EOSINOPHILS(%) NA(0 - 7)</label>
                                    <input class="form-control" type="text" name="eosinophils" value="<?php echo $result["eosinophils"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>MONOCYTES(%) NA(2 - 20)</label>
                                    <input class="form-control" type="text" name="monocytes" value="<?php echo $result["monocytes"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>BASEOPHILS(%) NA(0 - 1)</label>
                                    <input class="form-control" type="text" name="baseophils" value="<?php echo $result["baseophils"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>PLATELETS(X10 9/L) NA(140 - 400)</label>
                                    <input class="form-control" type="text" name="platelets" value="<?php echo $result["plateletes"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>RBC(X10<sup>12/L</sup>) NA(4.8 - 5.5)</label>
                                    <input class="form-control" type="text" name="rbc" value="<?php echo $result["rbc"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>RETICS(%) NA(0 - 2)</label>
                                    <input class="form-control" type="text" name="retics" value="<?php echo $result["retics"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>MCV(FL) NA(80 - 95)</label>
                                    <input class="form-control" type="text" name="mcv" value="<?php echo $result["mcv"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>MCHC(g/dl) NA(30 - 35)</label>
                                    <input class="form-control" type="text" name="mchc" value="<?php echo $result["mchc"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>MCH(pg) NA(27 - 32)</label>
                                    <input class="form-control" type="text" name="mch" value="<?php echo $result["mch"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>BLEEDING TIME(mins) NA(2 - 7)</label>
                                    <input class="form-control" type="text" name="bleedingTime" value="<?php echo $result["bleeding_time"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>CLOTHING TIME(mins) NA(5 - 11)</label>
                                    <input class="form-control" type="text" name="clothing" value="<?php echo $result["clothing_time"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>PROTROMBIN TIME(secs) NA(10 - 14)</label>
                                    <input class="form-control" type="text" name="protrombin" value="<?php echo $result["protrobim"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>TROMBIN TIME(secs) NA(13 - 15)</label>
                                    <input class="form-control" type="text" name="trombinTime" value="<?php echo $result["trombim_time"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>PTTK(secs) NA(35 - 43)</label>
                                    <input class="form-control" type="text" name="pttk" value="<?php echo $result["pttk"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>LE CELLS(%)</label>
                                    <input class="form-control" type="text" name="leCells" value="<?php echo $result["le_cells"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>ESR(mm/hr) NA(M-3 - 15 , F-4-7)</label>
                                    <input class="form-control" type="text" name="esr" value="<?php echo $result["esr"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>BLOOD GROUP</label>
                                    <input class="form-control" type="text" name="bloodGroup" value="<?php echo $result["blood_group"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>HB GENOTYPE</label>
                                    <input class="form-control" type="text" name="hbGenotype" value="<?php echo $result["hb_genotype"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>MALARIA PARASITES</label>
                                    <input class="form-control" type="text" name="malariaParasite" value="<?php echo $result["malaria_parasites"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>MICRO-FILARIA</label>
                                    <input class="form-control" type="text" name="microFilaria" value="<?php echo $result["micro_filaria"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>DIRECT COMBS TEST</label>
                                    <input class="form-control" type="text" name="directCombs" value="<?php echo $result["direct_combs_test"]; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>INDIRECT COMBS TEST</label>
                                    <input class="form-control" type="text" name="indirectCombs" value="<?php echo $result["indirect_comb_test"]; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="mt-3">Clinical Diagnostics</label>
                                <textarea name="clinical_diagnostics" class="form-control" id="testRemarks" style="width: 840px; height:300px; resize: none;" placeholder=""><?php echo $result["clinical_diagnostics"]; ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="mt-3">Scientist Remark</label>
                                <textarea name="testRemarks" class="form-control" id="testRemarks" style="width: 840px; height:300px; resize: none;" placeholder=""><?php echo $result["scientist_remarks"]; ?></textarea>
                            </div>
                        </div>
        
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                        </div>
                </div>
                </form>
            </div>
        <?php
        }
    }
}

function displayEditOther($tests,$appnum,$patientNames,$pat_ref)
{
    include 'fabinde.php';
    $editOther = mysqli_query($con,"SELECT * FROM other_result WHERE appointment_number='$appnum' AND test_type='$tests' ");
    if(mysqli_num_rows($editOther) >= 1)
    {
        while($res = mysqli_fetch_assoc($editOther))
        {
        ?>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="update_result.php">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Specimen <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="otherSpecimenSample" value="<?php echo $res['test_specimen']; ?>" required>
                                    <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                                    <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                                    <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                                    <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Test Result</label> 
                                    <input class="form-control" type="text" name="otherResult" value="<?php echo $res['test_result']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Unit Of Measurement <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="otherUnitMeasurement" value="<?php echo $res['unit_of_measure']; ?>" >
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label>Clinical Diagnostics</label>
                                <textarea name="otherClinicalDiagnostics" class="form-control" id="diagnostics"  style="width: 800px; height:200px; resize: none;"><?php echo $res['clinical_diagnosis']; ?></textarea>
                                </div> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        }
    }
    else
    {}
}

function displayEditChemistry($testRef, $appointNum,$patientNames,$pat_ref)
{
    include 'fabinde.php';
    $editchemistry = mysqli_query($con,"SELECT * FROM clinical_chemistry WHERE appointment_number='$appointNum' ");
    if(mysqli_num_rows($editchemistry) >= 1)
    {
        while($result = mysqli_fetch_assoc($editchemistry))
        {
            ?>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form method="post" action="update_result.php">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Specimen <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="chemistrySpecimen" value="<?php echo $result['specimen']; ?>" required>
                            <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                            <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                            <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                            <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Bicarbonate   (21-25 mmol/l)</label> 
                            <input class="form-control" type="text" name="bicarbonate" value="<?php echo $result['bicarbonate']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Chloride   (95-110 mmol/l)</label>
                            <input class="form-control" type="text" name="chloride" value="<?php echo $result['chloride']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Sodium   (135-145 mmol/l)</label>
                                <input type="text" class="form-control" name="sodium" value="<?php echo $result['sodium']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Potassium   (3.5-5.5 mmol/l)</label>
                                <input type="text" class="form-control" name="potassium" value="<?php echo $result['potassium']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>SGPT   (0-40 u/l)</label>
                                <input type="text" class="form-control" name="sgpt" value="<?php echo $result['sgpt']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>SGOT   (0-40 u/l)</label>
                                <input type="text" class="form-control" name="sgot" value="<?php echo $result['sgot']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ALKALINE PHOSPHATASE   (50-250 ul/l, Adult 150-600 u/l)</label>
                                <input type="text" class="form-control" name="alkalinePhosphatase" value="<?php echo $result['alkaline_phosphate']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>AMYLASE   (22-100 u/l)</label>
                                <input type="text" class="form-control" name="amylase" value="<?php echo $result['amylase']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ACID PHOSPHATASE(total)   (up to 11.0 u/l)(37<sup>o</sup>)</label>
                                <input type="text" class="form-control" name="acidphosphataseTotal" value="<?php echo $result['acid_phosphatase_total']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ACID PHOSPHATASE(prostatic)   (up to 4.0u/l)(37<sup>o</sup>C)</label>
                                <input type="text" class="form-control" name="acidphosphataseProtactic" value="<?php echo $result['acid_phosphatase_prostatic']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>URIC ACID   (142-416 Umol/l)</label>
                                <input type="text" class="form-control" name="uricAcid" value="<?php echo $result['uric_acid']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CHOLESTEROL   (3.89-6.48 mmol/l)</label>
                                <input type="text" class="form-control" name="cholesterol" value="<?php echo $result['cholesterol']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ALBUMIN   (34-52 gm/l)</label>
                                <input type="text" class="form-control" name="albumin" value="<?php echo $result['albumin']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>PROTEIN   (66-88 gm/l)</label>
                                <input type="text" class="form-control" name="protein" value="<?php echo $result['protein']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BILIRUBIN Total   (0-17 umol/l)</label>
                                <input type="text" class="form-control" name="bilirubinTotal" value="<?php echo $result['bilirubin_total']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BILIRUBIN Direct   (0-4.3 umol/l)</label>
                                <input type="text" class="form-control" name="bilirubinDirect" value="<?php echo $result['bilirubin_direct']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>UREA   (1.66-9.1 mmol/l)</label>
                                <input type="text" class="form-control" name="urea" value="<?php echo $result['urea']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>TRYGLYCERIDE   (0.52-1.95 mmol/l)</label>
                                <input type="text" class="form-control" name="tryglyceride" value="<?php echo $result['tryglyceride']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>GGT   (up to 450u/l)</label>
                                <input type="text" class="form-control" name="ggt" value="<?php echo $result['ggt']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>LDL   (< 4.0 mmol/l)</label>
                                <input type="text" class="form-control" name="ldl" value="<?php echo $result['ldl']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>HDL CHOLESTEROL   (Men = 0.91-1.43 mmol/l; Women = 1.17-1.69 mmol/l)</label>
                                <input type="text" class="form-control" name="hdlCholesterol" value="<?php echo $result['hdl_cholesterol']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CREATININE   (44-106 umol/l)</label>
                                <input type="text" class="form-control" name="creatinine" value="<?php echo $result['creatanine']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>INORGANIC PHOSPHOROUS   (Adult = 0.81-1.45 umol/l; Children = 1.20-2.26 umol/l)</label>
                                <input type="text" class="form-control" name="inorganicPhosphorous" value="<?php echo $result['inorganic_phosphorous']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>IRON   (Men = 10.6-28.3 mmol/l; Women = 6.6-26.0 umol/l 37-145mg%)</label>
                                <input type="text" class="form-control" name="iron" value="<?php echo $result['iron']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CALCIUM   (2.02-2.60 mmol/l)</label>
                                <input type="text" class="form-control" name="calcium" value="<?php echo $result['calcium']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CK   (Men = 0-270 u/l; Women = 0-150 u/l)</label>
                                <input type="text" class="form-control" name="ck" value="<?php echo $result['ck']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BLOOD SUGAR Fasting   (3.35-5.75 mmol/l)</label>
                                <input type="text" class="form-control" name="bloodSugarFasting" value="<?php echo $result['blood_sugar_fasting']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BLOOD SUGAR Random   (up to 9.44 mmol/l)</label>
                                <input type="text" class="form-control" name="bloodSugarRandom" value="<?php echo $result['blood_sugar_random']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>HbAlc Non-Diabetic   (6.0-8.3 %)</label>
                                <input type="text" class="form-control" name="hbAlcNonDiabetic" value="<?php echo $result['hb_alc_none_diabetic']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>HbAlc Uncontrolled Diabetics   (> 10.0 %)</label>
                                <input type="text" class="form-control" name="hbAlcUncontrolledDiabetic" value="<?php echo $result['hb_alc_uncontrolled_diabetic']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card" style="background-color: rgb(240, 234, 214);">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">GTT(mmol/L)</h4>
                            </div>
                                <div class="card-body p-0">
                                    <!-- <div class="col-lg-8 offset-lg-2"> -->
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-striped custom-table datatable mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Mg/d1</th>
                                                            <th class="text-center">Fasting</th>
                                                            <th class="text-center"><span>&#189;</span> hr</th>
                                                            <th class="text-center">1 hr</th>
                                                            <th class="text-center">1 <span>&#189;</span> hr</th>
                                                            <th class="text-center">2 hr</th>
                                                            <th class="text-center">2 <span>&#189;</span> hr</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Blood</td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="bloodfast" value="<?php echo $result['gtt_blood_fasting']; ?>">
                                                                </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="bloodhalfHour" value="<?php echo $result['gtt_blood_half_hour']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="bloodOneHour" value="<?php echo $result['gtt_blood_one_hour']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="bloodOneAndHalfHour" value="<?php echo $result['gtt_blood_onehalf_hour']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="bloodTwoHour" value="<?php echo $result['gtt_blood_two_hour']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="bloodTwoAndHalfHour" value="<?php echo $result['gtt_blood_twohalf_hour']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Urine</td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineFast" value="<?php echo $result['gtt_urine_fasting']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineHalfHour" value="<?php echo $result['gtt_urine_half_hour']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineOneHour" value="<?php echo $result['gtt_urine_one_hour']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineOneAndHalfHour" value="<?php echo $result['gtt_urine_onehalf_hour']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineTwoHour" value="<?php echo $result['gtt_urine_two_hour']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineTwoAndHalfHour" value="<?php echo $result['gtt_urine_twohalf_hour']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr class="mt-5">
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped custom-table datatable mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th >CSF</th>
                                                            <th>RESULT</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Glucose(45-85) mmol/l</td>
                                                            <td>
                                                                <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="csfGlucose" value="<?php echo $result['csf_glucose']; ?>">
                                                                </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Protein Total(15-45)<br>(10-45) mmol/l</td>
                                                            <td>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="csfProtein"value="<?php echo $result['csf_protein']; ?>">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card" style="background-color: rgb(240, 234, 214);">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">URINE</h4>
                            </div>
                                <div class="card-body p-0">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>PH</label>
                                                        <input type="text" class="form-control" name="urinePh" value="<?php echo $result['urine_ph']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>PROTEIN</label>
                                                        <input type="text" class="form-control" name="urineProtein" value="<?php echo $result['urine_protein']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>GLUCOSE</label>
                                                        <input type="text" class="form-control" name="urineGlucose" value="<?php echo $result['urine_glucose']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>BILIRUBIN</label>
                                                        <input type="text" class="form-control" name="urineBilirubin" value="<?php echo $result['urine_bilirubin']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>LEUCOCYTES</label>
                                                        <input type="text" class="form-control" name="urineLeucocytes" value="<?php echo $result['urine_leucocyte']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>BLOOD</label>
                                                        <input type="text" class="form-control" name="urineBlood" value="<?php echo $result['urine_blood']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>APPEARANCE</label>
                                                        <input type="text" class="form-control" name="urineAppearance" value="<?php echo $result['urine_appearance']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>MICROSCOPY</label>
                                                        <input type="text" class="form-control" name="urineMicroscopy" value="<?php echo $result['urine_microscopy']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>SR. Gr</label>
                                                        <input type="text" class="form-control" name="urineSrGr" value="<?php echo $result['urine_srgr']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>NITRITE</label>
                                                        <input type="text" class="form-control" name="urineNitrite" value="<?php echo $result['urine_nitrite']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>KETONES</label>
                                                        <input type="text" class="form-control" name="urineKetones" value="<?php echo $result['urine_ketone']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>UROBILNOGEN</label>
                                                        <input type="text" class="form-control" name="urineUrobilnogen" value="<?php echo $result['urine_urobilnogen']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                    <div class="form-group">
                        <label class="mt-3">Clinical Diagnostics</label>
                        <textarea name="comment" class="form-control" id="testRemarks" style="width: 840px; height:300px; resize: none;"><?php echo $result['result_comment']; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                </div>
        </div>
        </form>
    </div>
<?php
        }
    }
    else
    {}
}

function displayEditHomonalAssays($testRef, $appointNum,$patientNames,$pat_ref)
{
    include 'fabinde.php';

    $homonalSpecimen = "";
    $progesterone = "";
    $lh = "";
    $fsh = "";
    $estradio = "";
    $prolactin = "";
    $testosterone = "";
    $psa = "";
    $hbalc = "";
    $bhcg = "";
    $clinical_diagnostics = "";

    $editSearch = mysqli_query($con,"SELECT * FROM homonal_assays WHERE appointment_number='$appointNum' ");
    if(mysqli_num_rows($editSearch) >= 1)
    {
        while($result= mysqli_fetch_assoc($editSearch))
        {
            $homonalSpecimen = $result['specimen'];
            $progesterone = $result['progesterone'];
            $lh = $result['lh'];
            $fsh = $result['fsh'];
            $estradio = $result['estradiol'];
            $prolactin = $result['prolactin'];
            $testosterone = $result['testosterone'];
            $psa = $result['psa'];
            $hbalc = $result['hbalc'];
            $bhcg = $result['bhcg'];
            $clinical_diagnostics = $result['clinical_diagnostics'];
        }
        ?>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post" action="update_result.php">
                        <div class="row">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                                    <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                                    <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                                    <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                                </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Specimen <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="homonalSpecimenSample" value="<?php echo $homonalSpecimen; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Progesterone</label>
                                    <input class="form-control" type="text" name="progesterone" value="<?php echo $progesterone; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>LH</label>
                                    <input type="text" class="form-control" name="lh" value="<?php echo $lh; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>FSH</label>
                                    <input type="text" class="form-control" name="fsh" value="<?php echo $fsh; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Estradiol</label>
                                    <input type="text" class="form-control" name="estradiol" value="<?php echo $estradio; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Prolactin</label>
                                    <input type="text" class="form-control" name="prolcatin" value="<?php echo $prolactin; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Testosterone</label>
                                    <input type="text" class="form-control" name="testosterone" value="<?php echo $testosterone; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>PSA</label>
                                    <input type="text" class="form-control" name="psa" value="<?php echo $psa; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>HBA1C</label>
                                    <input type="text" class="form-control" name="hbalc" value="<?php echo $hbalc; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>BHCG</label>
                                    <input type="text" class="form-control" name="bhcg" value="<?php echo $bhcg; ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Clinical Diagnostics</label>
                                    <textarea name="clinical_diagnostics" class="form-control" id="diagnostics"  style="width: 800px; height:200px; resize: none;" value=""><?php echo $clinical_diagnostics; ?></textarea>
                                </div>
                            </div>
                        </div>
        
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                        </div>
                </div>
                </form>
            </div>
<?php
    }
}

function displayEditMicroBiology($testRef, $appointNum,$patientNames,$pat_ref)
{
    include 'fabinde.php';

    $microBiologySpecimen = "";
    $urinePhValue = "";
    $spgr = "";
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

    $editmicro = mysqli_query($con,"SELECT * FROM microbiology WHERE appointment_number='$appointNum' ");
    if(mysqli_num_rows($editmicro) >= 1)
    {
        while($result = mysqli_fetch_assoc($edithmicro))
        {

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
            $clinician = $_SESSION["staff_name"];
        }
        ?>
    <div class="row">
        <form method="post" action="update_result.php">
            <div class="col-sm-12">
                <div class="card" style="background-color: rgb(240, 234, 214);">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">URINE</h4>
                        <div class="card-body p-0">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Specimen Collected</label>
                                            <input class="form-control" type="text" name="microBiologySpecimen" value="<?php echo $microBiologySpecimen; ?>" required>
                                            <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                                            <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                                            <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                                            <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>PH</label>
                                            <input class="form-control" type="text" name="urinePhValue" value="<?php echo $urinePhValue; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>SP.Gr.</label>
                                            <input class="form-control" type="text" name="spgr" value="<?php echo $spgr; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Protein</label>
                                            <input class="form-control" type="text" name="protein" value="<?php echo $protein; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Glucose</label>
                                            <input class="form-control" type="text" name="glucose" value="<?php echo $glucose; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Ketone</label>
                                            <input class="form-control" type="text" name="ketone" value="<?php echo $ketone; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Appearance</label>
                                            <input class="form-control" type="text" name="appearance" value="<?php echo $appearance; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Microscopy</label>
                                            <input class="form-control" type="text" name="microscopy" value="<?php echo $microscopy; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Bilirubin</label>
                                            <input class="form-control" type="text" name="bilirubin" value="<?php echo $bilirubin; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Urobilinogen</label>
                                            <input class="form-control" type="text" name="urobilinogen" value="<?php echo $urobilinogen; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Nitrites</label>
                                            <input class="form-control" type="text" name="nitrites" value="<?php echo $nitrites; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Leucocytes</label>
                                            <input class="form-control" type="text" name="leucocytes" value="<?php echo $leucocytes; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Blood</label>
                                            <input class="form-control" type="text" name="blood" value="<?php echo $blood; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card" style="background-color: rgb(240, 234, 214);">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">WIDAL</h4>
                        <div class="card-body p-0">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table datatable mb-0">
                                            <thead>
                                                <tr>
                                                    <th>SALMONELLA<br>ORGANISMS</th>
                                                    <th>.</th>
                                                    <th>"H" ANTIBODY TITRE</th>
                                                    <th>.</th>
                                                    <th>"O" ANTIBODY TITRE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>SAL. TYPH</td>
                                                    <td>d</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="saltyphd" value="<?php echo $saltyphd; ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>D</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="saltyphDs" value="<?php echo $saltyphDs; ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>SAL. PARATYPHI</td>
                                                    <td>a</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="salparatypha" value="<?php echo $salparatypha; ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>A</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="salparatyphAs" value="<?php echo $salparatyphAs; ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>SAL. PARATYPHI</td>
                                                    <td>b</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="salparatyphb" value="<?php echo $salparatyphb; ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>B</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="salparatyphBs" value="<?php echo $salparatyphBs; ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>SAL. PARATYPHI</td>
                                                    <td>c</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="salparatyphc" value="<?php echo $salparatyphc; ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>C</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="salparatyphCs" value="<?php echo $salparatyphCs; ?>">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-12 mt-2">
                                        <div class="form-group">
                                            <label>Comment</label>
                                                <div class="form-group">
                                                <textarea name="comment" class="form-control" id="testRemarks"  style="width: 800px; height:100px; resize: none;"><?php echo $testRemarks; ?></textarea>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><h3><b>OTHER SAMPLES</b></h3></label>
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>MACROSCOPY</label>
                                            <input class="form-control" type="text" name="macroscopy" value="<?php echo $macroscopy; ?>">
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>MICROSCOPY</label>
                                            <input class="form-control" type="text" name="microscopy_other" value="<?php echo $microscopy_other; ?>">
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>CULTURE/SEROLOGY</label>
                                            <textarea name="cultureAndSerology" class="form-control" id="cultureAndSerology"  style="width: 500px; height:200px; resize: none;"><?php echo $cultureAndSerology; ?></textarea>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                </div>
        </form>
    </div>
<?php
    }
    else
    {}
}

function displayEditSemenAnalysis($testRef, $appointNum,$patientNames,$pat_ref)
{
    include 'fabinde.php';
    
    $semenSpecimenSample = "";
    $dateOfSample = "";
    $abstenaceDuration = "";
    $ejaculationInterval = "";
    $appearance = "";
    $semenPH = "";
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
    $percenatgeDoubleHeadMorphology =  "";
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
    $clinical_diagnostics = "";
    $editSemen = mysqli_query($con,"SELECT * FROM semen_analysis WHERE appointment_number='$appointNum' ");
    if(mysqli_num_rows($editSemen) >= 1)
    {
        while($result = mysqli_fetch_assoc($editSemen))
        {

            $semenSpecimenSample = $result['specimen'];
            $dateOfSample = $result['date_of_sample'];
            $abstenaceDuration = $result['duration_of_abstenance'];
            $ejaculationInterval = $result['ejaculation_analysis_interval'];
            $appearance = $result['appearance'];
            $semenPH = $result['semen_ph'];
            $liquefaction = $result['liquefaction'];
            $consistency = $result['consistency'];
            $volume = $result['volume'];
            $rapidLinearProgression = $result['rapid_linear_progression'];
            $nonLinearProgression = $result['non_linear_progression'];
            $nonLinearProgressionMotility = $result['progressive_motility'];
            $immotile = $result['immotile'];
            $viability = $result['viability'];
            $concentrationSpermCount = $result['concentraton'];
            $spermatozoalml = $result['spermatozoa_lml'];
            $percentageNormalHeadMorphology = $result['morphology_head_normal'];
            $percentageLargeOvalHeadMophology = $result['morphology_head_large_oval'];
            $percentagePyriformHeadMorphology = $result['morphology_head_pyriform'];
            $percenatgeTaperingHeadMorphology = $result['morphology_head_tapering'];
            $percenatgeAmorphousHeadMorphology = $result['morphology_head_amorphous'];
            $percenatgeDoubleHeadMorphology =  $result['morphology_head_double'];
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
            $clinical_diagnostics = $result['clinical_diagnostics'];
        }
        ?>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post" action="update_result.php">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date Of Sample <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="dateOfSample" value="<?php echo $dateOfSample; ?>" required>
                                <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                                <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                                <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                                <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Specimen <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="semenSpecimenSample" value="<?php echo $semenSpecimenSample; ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Duration Of Abstenance</label>
                                <input class="form-control" type="text" name="abstenaceDuration" value="<?php echo $abstenaceDuration; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Interval Between Ejaculation & Start Of Analysis(mins)</label>
                                <input type="text" class="form-control" name="ejaculationInterval" value="<?php echo $ejaculationInterval; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Appearance</label>
                                    <select class="form-control selectpicker select" data-live-search="true" name="appearance" value="<?php echo $appearance; ?>">
                                        <option value="Normal">Normal</option>
                                        <option value="Abnormal">Abnormal</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Liquefaction</label>
                                    <select class="form-control selectpicker select" data-live-search="true" name="liquefaction" value="<?php echo $liquefaction; ?>">
                                        <option value="Normal">Normal</option>
                                        <option value="Abnormal">Abnormal</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Consistency</label>
                                <input type="text" class="form-control" name="consistency" value="<?php echo $consistency; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Volume</label>
                                <input type="text" class="form-control" name="volume" value="<?php echo $volume; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>pH</label>
                                <input type="text" class="form-control" name="semenPH" value="<?php echo $semenPH; ?>">
                            </div>
                        </div>
                        <div class="card" style="background-color: rgb(240, 234, 214);">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">MOTILITY(100 Spermatozoa)</h4>
                                <div class="card-body p-0">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Rapid Linear Progression</label>
                                                    <input type="text" class="form-control" name="rapidLinearProgression" value="<?php echo $rapidLinearProgression; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Non-Linear Progression</label>
                                                    <input type="text" class="form-control" name="nonLinearProgression" value="<?php echo $nonLinearProgression; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Non-Progressive Motility</label>
                                                    <input type="text" class="form-control" name="nonLinearProgressionMotility" value="<?php echo $nonLinearProgressionMotility; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Immotile</label>
                                                    <input type="text" class="form-control" name="immotile" value="<?php echo $immotile; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Viability(% live)</label>
                                <input type="text" class="form-control" name="viability" value="<?php echo $viability; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Concentration(Sperm Count)</label>
                                <input type="text" class="form-control" name="concentrationSpermCount" value="<?php echo $concentrationSpermCount; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Spermatozoa lml</label>
                                <input type="text" class="form-control" name="spermatozoalml" value="<?php echo $spermatozoalml; ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="card" style="background-color: rgb(240, 234, 214);">
                            <div class="card-header">
                                <h3 class="card-title d-inline-block">MORPHOLOGY</h3><br>
                            </div>
                                <h4 class="card-title d-inline-block mx-5">a. Head</h4>
                                <div class="card-body p-0">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>% Normal</label>
                                                    <input type="text" class="form-control" name="percentageNormalHeadMorphology" value="<?php echo $percentageNormalHeadMorphology; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>% Large Oval</label>
                                                    <input type="text" class="form-control" name="percentageLargeOvalHeadMophology" value="<?php echo $percentageLargeOvalHeadMophology; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>% Pyriform</label>
                                                    <input type="text" class="form-control" name="percentagePyriformHeadMorphology" value="<?php echo $percentagePyriformHeadMorphology; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>% Tapering</label>
                                                    <input type="text" class="form-control" name="percenatgeTaperingHeadMorphology" value="<?php echo $percenatgeTaperingHeadMorphology; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>% Amorphous</label>
                                                    <input type="text" class="form-control" name="percenatgeAmorphousHeadMorphology" value="<?php echo $percenatgeAmorphousHeadMorphology; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>% Double</label>
                                                    <input type="text" class="form-control" name="percenatgeDoubleHeadMorphology" value="<?php echo $percenatgeDoubleHeadMorphology; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>% Pin</label>
                                                    <input type="text" class="form-control" name="percenatgePinHeadMorphology" value="<?php echo $percenatgePinHeadMorphology; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>% Round</label>
                                                    <input type="text" class="form-control" name="percenatgeRoundHeadMorphology" value="<?php echo $percenatgeRoundHeadMorphology; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-12">
                        <div class="card" style="background-color: rgb(240, 234, 214);">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">b. Midpiece(Neck)</h4>
                                <div class="card-body p-0">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>% Normal</label>
                                                    <input type="text" class="form-control" name="percentageNormalMidpieceMorphology" value="<?php echo  $percentageNormalMidpieceMorphology; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>% Abnormal</label>
                                                    <input type="text" class="form-control" name="percentageAbnormalMidpieceMorphology" value="<?php echo $percentageAbnormalMidpieceMorphology; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>% Cytoplasmic droplet</label>
                                                    <input type="text" class="form-control" name="percentageCytoplasmicMidpieceMorphology" value="<?php echo $percentageCytoplasmicMidpieceMorphology; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-12">
                        <div class="card" style="background-color: rgb(240, 234, 214);">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">c. Tail</h4>
                                <div class="card-body p-0">
                                    <!-- <div class="col-lg-8 offset-lg-2"> -->
                                        <div class="row"> 
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>% Normal</label>
                                                    <input type="text" class="form-control" name="percentageNormalTailMorphology" value="<?php echo $percentageNormalTailMorphology; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>% Abnormal</label>
                                                    <input type="text" class="form-control" name="percentageAbnormalTailMorphology" value="<?php echo $percentageAbnormalTailMorphology; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Agglutination</label>
                                    <select class="form-control selectpicker select" data-live-search="true" name="agglutination" value="<?php echo $agglutination; ?>">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>if Yes(Agglutination)</label>
                                <input type="text" class="form-control" name="yesAgglutination" value="<?php echo $yesAgglutination; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Microscopy</label>
                                <input type="text" class="form-control" name="microscopy" value="<?php echo $microscopy; ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Clinical Diagnostics</label>
                                <textarea name="clinical_diagnostics" class="form-control" id="comment"  style="width: 500px; height:200px; resize: none;"><?php echo $clinical_diagnostics; ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea name="comment" class="form-control" id="comment"  style="width: 500px; height:200px; resize: none;" required><?php echo $comment; ?></textarea>
                            </div>
                        </div>
                    </div>
    
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                    </div>
            </div>
            </form>
        </div>
    <?php
    }
}

function displayEditLaboratories($testRef, $appointNum,$patientNames,$pat_ref)
{
    include 'fabinde.php';

    $laboratorySpecimen = "";
    $laboratoryReport = "";

    $editLab = mysqli_query($con,"SELECT * FROM clinical_laboratory WHERE appointment_number='$appointNum' ");
    if(mysqli_num_rows($editLab) >= 1)
    {
        while($result = mysqli_fetch_assoc($editLab))
        {
            $laboratorySpecimen = $result['specimen'];
            $laboratoryReport = $result['test_report'];
        }
        ?>

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form method="post" action="update_result.php">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>SPECIMEN RECEIVED <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="laboratorySpecimen" value="<?php echo $laboratorySpecimen; ?>" required>
                            <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                            <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                            <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                            <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label> REPORT<span class="text-danger">*</span></label>
                            <textarea name="laboratoryReport" class="form-control" id="report"  style="width: 550px; height:200px; resize: none;" required><?php echo $laboratoryReport; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                </div>
        </div>
        </form>
    </div>
<?php
    }
    else
    {}
} 
?>