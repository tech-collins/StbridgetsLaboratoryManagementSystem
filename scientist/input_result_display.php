<?php


function displayHeamatology($testRef, $appointNum,$patientNames,$pat_ref)
{
    include 'fabinde.php';
?>

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form method="post" action="save_result.php">
                <div class="row">
                <div class="col-sm-6">
                        <div class="form-group">
                            <label>Specimen <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="haematologySpecimen" required>
                            <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                            <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                            <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                            <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>PCV (%) <span class="text-danger">*</span> NA(30 - 54)</label>
                            <input class="form-control" type="text" name="pcv" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>HB(g/dl) NA(12 - 16g/dl)</label>
                            <input class="form-control" type="text" name="hb" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>TLC(X10 9/L) NA(4.1 - 11)</label>
                            <input class="form-control" type="text" name="tlc" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>NEUTROPHILS(%) NA(40 - 75)</label>
                            <input class="form-control" type="text" name="neutrophils" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>LYMPHOCYTES(%) NA(25 - 40)</label>
                            <input class="form-control" type="text" name="lymphocytes" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>EOSINOPHILS(%) NA(0 - 7)</label>
                            <input class="form-control" type="text" name="eosinophils" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>MONOCYTES(%) NA(2 - 20)</label>
                            <input class="form-control" type="text" name="monocytes" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BASEOPHILS(%) NA(0 - 1)</label>
                            <input class="form-control" type="text" name="baseophils" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>PLATELETS(X10 9/L) NA(140 - 400)</label>
                            <input class="form-control" type="text" name="platelets" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>RBC(X10<sup>12/L</sup>) NA(4.8 - 5.5)</label>
                            <input class="form-control" type="text" name="rbc" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>RETICS(%) NA(0 - 2)</label>
                            <input class="form-control" type="text" name="retics" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>MCV(FL) NA(80 - 95)</label>
                            <input class="form-control" type="text" name="mcv" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>MCHC(g/dl) NA(30 - 35)</label>
                            <input class="form-control" type="text" name="mchc" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>MCH(pg) NA(27 - 32)</label>
                            <input class="form-control" type="text" name="mch" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BLEEDING TIME(mins) NA(2 - 7)</label>
                            <input class="form-control" type="text" name="bleedingTime" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CLOTHING TIME(mins) NA(5 - 11)</label>
                            <input class="form-control" type="text" name="clothing" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>PROTROMBIN TIME(secs) NA(10 - 14)</label>
                            <input class="form-control" type="text" name="protrombin" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>TROMBIN TIME(secs) NA(13 - 15)</label>
                            <input class="form-control" type="text" name="trombinTime" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>PTTK(secs) NA(35 - 43)</label>
                            <input class="form-control" type="text" name="pttk" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>LE CELLS(%)</label>
                            <input class="form-control" type="text" name="leCells" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ESR(mm/hr) NA(M-3 - 15 , F-4-7)</label>
                            <input class="form-control" type="text" name="esr" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BLOOD GROUP</label>
                            <input class="form-control" type="text" name="bloodGroup" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>HB GENOTYPE</label>
                            <input class="form-control" type="text" name="hbGenotype" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>MALARIA PARASITES</label>
                            <input class="form-control" type="text" name="malariaParasite" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>MICRO-FILARIA</label>
                            <input class="form-control" type="text" name="microFilaria" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>DIRECT COMBS TEST</label>
                            <input class="form-control" type="text" name="directCombs" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>INDIRECT COMBS TEST</label>
                            <input class="form-control" type="text" name="indirectCombs" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="mt-3">Clinical Diagnostics</label>
                        <textarea name="clinical_diagnostics" class="form-control" id="testRemarks" style="width: 840px; height:300px; resize: none;"></textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="mt-3">Scientist Remark</label>
                        <textarea name="testRemarks" class="form-control" id="testRemarks" style="width: 840px; height:300px; resize: none;"></textarea>
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

function displayChemistry($testRef, $appointNum,$patientNames,$pat_ref)
{
    include 'fabinde.php';
?>

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form method="post" action="save_result.php">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Specimen <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="chemistrySpecimen" required>
                            <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                            <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                            <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                            <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Bicarbonate   (21-25 mmol/l)</label> 
                            <input class="form-control" type="text" name="bicarbonate" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Chloride   (95-110 mmol/l)</label>
                            <input class="form-control" type="text" name="chloride" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Sodium   (135-145 mmol/l)</label>
                                <input type="text" class="form-control" name="sodium" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Potassium   (3.5-5.5 mmol/l)</label>
                                <input type="text" class="form-control" name="potassium" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>SGPT   (0-40 u/l)</label>
                                <input type="text" class="form-control" name="sgpt" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>SGOT   (0-40 u/l)</label>
                                <input type="text" class="form-control" name="sgot" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ALKALINE PHOSPHATASE   (50-250 ul/l, Adult 150-600 u/l)</label>
                                <input type="text" class="form-control" name="alkalinePhosphatase" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>AMYLASE   (22-100 u/l)</label>
                                <input type="text" class="form-control" name="amylase" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ACID PHOSPHATASE(total)   (up to 11.0 u/l)(37<sup>o</sup>)</label>
                                <input type="text" class="form-control" name="acidphosphataseTotal" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ACID PHOSPHATASE(prostatic)   (up to 4.0u/l)(37<sup>o</sup>C)</label>
                                <input type="text" class="form-control" name="acidphosphataseProtactic" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>URIC ACID   (142-416 Umol/l)</label>
                                <input type="text" class="form-control" name="uricAcid" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CHOLESTEROL   (3.89-6.48 mmol/l)</label>
                                <input type="text" class="form-control" name="cholesterol" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>ALBUMIN   (34-52 gm/l)</label>
                                <input type="text" class="form-control" name="albumin" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>PROTEIN   (66-88 gm/l)</label>
                                <input type="text" class="form-control" name="protein" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BILIRUBIN Total   (0-17 umol/l)</label>
                                <input type="text" class="form-control" name="bilirubinTotal" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BILIRUBIN Direct   (0-4.3 umol/l)</label>
                                <input type="text" class="form-control" name="bilirubinDirect" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>UREA   (1.66-9.1 mmol/l)</label>
                                <input type="text" class="form-control" name="urea" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>TRYGLYCERIDE   (0.52-1.95 mmol/l)</label>
                                <input type="text" class="form-control" name="tryglyceride" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>GGT   (up to 450u/l)</label>
                                <input type="text" class="form-control" name="ggt" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>LDL   (< 4.0 mmol/l)</label>
                                <input type="text" class="form-control" name="ldl" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>HDL CHOLESTEROL   (Men = 0.91-1.43 mmol/l; Women = 1.17-1.69 mmol/l)</label>
                                <input type="text" class="form-control" name="hdlCholesterol" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CREATININE   (44-106 umol/l)</label>
                                <input type="text" class="form-control" name="creatinine" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>INORGANIC PHOSPHOROUS   (Adult = 0.81-1.45 umol/l; Children = 1.20-2.26 umol/l)</label>
                                <input type="text" class="form-control" name="inorganicPhosphorous" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>IRON   (Men = 10.6-28.3 mmol/l; Women = 6.6-26.0 umol/l 37-145mg%)</label>
                                <input type="text" class="form-control" name="iron" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CALCIUM   (2.02-2.60 mmol/l)</label>
                                <input type="text" class="form-control" name="calcium" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CK   (Men = 0-270 u/l; Women = 0-150 u/l)</label>
                                <input type="text" class="form-control" name="ck" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BLOOD SUGAR Fasting   (3.35-5.75 mmol/l)</label>
                                <input type="text" class="form-control" name="bloodSugarFasting" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>BLOOD SUGAR Random   (up to 9.44 mmol/l)</label>
                                <input type="text" class="form-control" name="bloodSugarRandom" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>HbAlc Non-Diabetic   (6.0-8.3 %)</label>
                                <input type="text" class="form-control" name="hbAlcNonDiabetic" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>HbAlc Uncontrolled Diabetics   (> 10.0 %)</label>
                                <input type="text" class="form-control" name="hbAlcUncontrolledDiabetic" required>
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
                                                                    <input type="text" class="form-control" name="bloodfast" required>
                                                                </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="bloodhalfHour" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="bloodOneHour" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="bloodOneAndHalfHour" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="bloodTwoHour" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="bloodTwoAndHalfHour" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Urine</td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineFast" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineHalfHour" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineOneHour" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineOneAndHalfHour" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineTwoHour" required>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="urineTwoAndHalfHour" required>
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
                                                                    <input type="text" class="form-control" name="csfGlucose" required>
                                                                </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Protein Total(15-45)<br>(10-45) mmol/l</td>
                                                            <td>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="csfProtein" required>
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
                                                        <input type="text" class="form-control" name="urinePh" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>PROTEIN</label>
                                                        <input type="text" class="form-control" name="urineProtein" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>GLUCOSE</label>
                                                        <input type="text" class="form-control" name="urineGlucose" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>BILIRUBIN</label>
                                                        <input type="text" class="form-control" name="urineBilirubin" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>LEUCOCYTES</label>
                                                        <input type="text" class="form-control" name="urineLeucocytes" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>BLOOD</label>
                                                        <input type="text" class="form-control" name="urineBlood" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>APPEARANCE</label>
                                                        <input type="text" class="form-control" name="urineAppearance" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>MICROSCOPY</label>
                                                        <input type="text" class="form-control" name="urineMicroscopy" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>SR. Gr</label>
                                                        <input type="text" class="form-control" name="urineSrGr" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>NITRITE</label>
                                                        <input type="text" class="form-control" name="urineNitrite" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>KETONES</label>
                                                        <input type="text" class="form-control" name="urineKetones" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>UROBILNOGEN</label>
                                                        <input type="text" class="form-control" name="urineUrobilnogen" required>
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
                        <textarea name="comment" class="form-control" id="testRemarks" style="width: 840px; height:300px; resize: none;"></textarea>
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

function displayMicroBiology($testRef, $appointNum,$patientNames,$pat_ref)
{
    include 'fabinde.php';
?>
    <div class="row">
        <form method="post" action="save_result.php">
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
                                            <input class="form-control" type="text" name="microBiologySpecimen" required>
                                            <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                                            <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                                            <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                                            <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>PH</label>
                                            <input class="form-control" type="text" name="urinePhValue" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>SP.Gr.</label>
                                            <input class="form-control" type="text" name="spgr" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Protein</label>
                                            <input class="form-control" type="text" name="protein" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Glucose</label>
                                            <input class="form-control" type="text" name="glucose" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Ketone</label>
                                            <input class="form-control" type="text" name="ketone" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Appearance</label>
                                            <input class="form-control" type="text" name="appearance" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Microscopy</label>
                                            <input class="form-control" type="text" name="microscopy" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Bilirubin</label>
                                            <input class="form-control" type="text" name="bilirubin" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Urobilinogen</label>
                                            <input class="form-control" type="text" name="urobilinogen" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Nitrites</label>
                                            <input class="form-control" type="text" name="nitrites" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Leucocytes</label>
                                            <input class="form-control" type="text" name="leucocytes" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Blood</label>
                                            <input class="form-control" type="text" name="blood" required>
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
                                                                <input class="form-control" type="text" name="saltyphd" required>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>D</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="saltyphDs" required>
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
                                                                <input class="form-control" type="text" name="salparatypha" required>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>A</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="salparatyphAs" required>
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
                                                                <input class="form-control" type="text" name="salparatyphb" required>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>B</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="salparatyphBs" required>
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
                                                                <input class="form-control" type="text" name="salparatyphc" required>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>C</td>
                                                    <td>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="salparatyphCs" required>
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
                                                <textarea name="comment" class="form-control" id="testRemarks"  style="width: 800px; height:100px; resize: none;"></textarea>
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
                                            <input class="form-control" type="text" name="macroscopy" required>
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>MICROSCOPY</label>
                                            <input class="form-control" type="text" name="microscopy_other" required>
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>CULTURE/SEROLOGY</label>
                                            <textarea name="cultureAndSerology" class="form-control" id="cultureAndSerology"  style="width: 500px; height:200px; resize: none;"></textarea>
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

function displaySemenAnalysis($testRef, $appointNum,$patientNames,$pat_ref)
{
    include 'fabinde.php';
?>

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form method="post" action="save_result.php">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Date Of Sample <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="dateOfSample" required>
                            <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                            <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                            <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                            <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Specimen <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="semenSpecimenSample" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Duration Of Abstenance</label>
                            <input class="form-control" type="text" name="abstenaceDuration" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Interval Between Ejaculation & Start Of Analysis(mins)</label>
                            <input type="text" class="form-control" name="ejaculationInterval" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Appearance</label>
                                <select class="form-control selectpicker select" data-live-search="true" name="appearance" required>
                                    <option value="Normal">Normal</option>
                                    <option value="Abnormal">Abnormal</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Liquefaction</label>
                                <select class="form-control selectpicker select" data-live-search="true" name="liquefaction" required>
                                    <option value="Normal">Normal</option>
                                    <option value="Abnormal">Abnormal</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Consistency</label>
                            <input type="text" class="form-control" name="consistency" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Volume</label>
                            <input type="text" class="form-control" name="volume" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>pH</label>
                            <input type="text" class="form-control" name="semenPH" required>
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
                                                <input type="text" class="form-control" name="rapidLinearProgression" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Non-Linear Progression</label>
                                                <input type="text" class="form-control" name="nonLinearProgression" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Non-Progressive Motility</label>
                                                <input type="text" class="form-control" name="nonLinearProgressionMotility" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Immotile</label>
                                                <input type="text" class="form-control" name="immotile" required>
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
                            <input type="text" class="form-control" name="viability" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Concentration(Sperm Count)</label>
                            <input type="text" class="form-control" name="concentrationSpermCount" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Spermatozoa lml</label>
                            <input type="text" class="form-control" name="spermatozoalml" required>
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
                                                <input type="text" class="form-control" name="percentageNormalHeadMorphology" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>% Large Oval</label>
                                                <input type="text" class="form-control" name="percentageLargeOvalHeadMophology" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>% Pyriform</label>
                                                <input type="text" class="form-control" name="percentagePyriformHeadMorphology" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>% Tapering</label>
                                                <input type="text" class="form-control" name="percenatgeTaperingHeadMorphology" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>% Amorphous</label>
                                                <input type="text" class="form-control" name="percenatgeAmorphousHeadMorphology" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>% Double</label>
                                                <input type="text" class="form-control" name="percenatgeDoubleHeadMorphology" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>% Pin</label>
                                                <input type="text" class="form-control" name="percenatgePinHeadMorphology" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>% Round</label>
                                                <input type="text" class="form-control" name="percenatgeRoundHeadMorphology" required>
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
                                                <input type="text" class="form-control" name="percentageNormalMidpieceMorphology" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>% Abnormal</label>
                                                <input type="text" class="form-control" name="percentageAbnormalMidpieceMorphology" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>% Cytoplasmic droplet</label>
                                                <input type="text" class="form-control" name="percentageCytoplasmicMidpieceMorphology" required>
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
                                                <input type="text" class="form-control" name="percentageNormalTailMorphology" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>% Abnormal</label>
                                                <input type="text" class="form-control" name="percentageAbnormalTailMorphology" required>
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
                                <select class="form-control selectpicker select" data-live-search="true" name="agglutination" required>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>if Yes(Agglutination)</label>
                            <input type="text" class="form-control" name="yesAgglutination" >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Microscopy</label>
                            <input type="text" class="form-control" name="microscopy" >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Clinical Diagnostics</label>
                            <textarea name="clinical_diagnostics" class="form-control" id="comment"  style="width: 500px; height:200px; resize: none;" required></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea name="comment" class="form-control" id="comment"  style="width: 500px; height:200px; resize: none;" required></textarea>
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

function displayLaboratories($testRef, $appointNum,$patientNames,$pat_ref)
{
    include 'fabinde.php';
?>

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form method="post" action="save_result.php">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>SPECIMEN RECEIVED <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="laboratorySpecimen" required>
                            <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                            <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                            <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
                            <input class="form-control" type="hidden" name="testType" value="<?php echo $testRef; ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label> REPORT<span class="text-danger">*</span></label>
                            <textarea name="laboratoryReport" class="form-control" id="report"  style="width: 550px; height:200px; resize: none;" required></textarea>
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

function displayHomonalAssays($tests, $appnum,$patientNames,$pat_ref)
{
    include 'fabinde.php';
    ?>
    
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post" action="save_result.php">
                    <div class="row">
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                                <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                                <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appnum; ?>" required>
                                <input class="form-control" type="hidden" name="testType" value="<?php echo $tests; ?>" required>
                            </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Specimen <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="homonalSpecimenSample" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Progesterone</label>
                                <input class="form-control" type="text" name="progesterone" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>LH</label>
                                <input type="text" class="form-control" name="lh" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>FSH</label>
                                <input type="text" class="form-control" name="fsh" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Estradiol</label>
                                <input type="text" class="form-control" name="estradiol" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Prolactin</label>
                                <input type="text" class="form-control" name="prolcatin" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Testosterone</label>
                                <input type="text" class="form-control" name="testosterone" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>PSA</label>
                                <input type="text" class="form-control" name="psa" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>HBA1C</label>
                                <input type="text" class="form-control" name="hbalc" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>BHCG</label>
                                <input type="text" class="form-control" name="bhcg" >
                            </div>
                        </div>
                        <hr>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Clinical Diagnostics</label>
                                <textarea name="clinical_diagnostics" class="form-control" id="diagnostics"  style="width: 800px; height:200px; resize: none;" required></textarea>
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
function displayOther($tests, $appnum,$patientNames,$pat_ref)
{
?>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post" action="save_result.php">
                    <div class="row">
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                                <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                                <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appnum; ?>" required>
                                <input class="form-control" type="hidden" name="testType" value="<?php echo $tests; ?>" required>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                <label>Specimen <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="otherSpecimenSample" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                <label>Test Result <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="otherResult" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                <label>Unit Of Measurement <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="otherUnitMeasurement">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label>Clinical Diagnostics</label>
                                <textarea name="otherClinicalDiagnostics" class="form-control" id="diagnostics"  style="width: 800px; height:200px; resize: none;"></textarea>
                                </div> 
                            </div>
                    </div>
                </form>
            </div>
        </div>
<?php
}
?>