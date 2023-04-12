<?php 
include 'fabinde.php';

if(isset($_POST["haematologySpecimen"]))
{
    $patientNames = mysqli_real_escape_string($con,$_POST["patientName"]);
    $pat_ref = mysqli_real_escape_string($con,$_POST["refNumber"]);
    $testRef = mysqli_real_escape_string($con,$_POST["testType"]);
    $appointNum = mysqli_real_escape_string($con,$_POST["appointmentNumber"]);
    $haematologySpecimen = mysqli_real_escape_string($con,$_POST["haematologySpecimen"]);
    $pcv = mysqli_real_escape_string($con,$_POST["pcv"]);
    $hb = mysqli_real_escape_string($con,$_POST["hb"]);
    $tlc = mysqli_real_escape_string($con,$_POST["tlc"]);
    $neutrophils = mysqli_real_escape_string($con,$_POST["neutrophils"]);
    $lymphocytes = mysqli_real_escape_string($con,$_POST["lymphocytes"]);
    $eosinophils = mysqli_real_escape_string($con,$_POST["eosinophils"]);
    $monocytes = mysqli_real_escape_string($con,$_POST["monocytes"]);
    $baseophils = mysqli_real_escape_string($con,$_POST["baseophils"]);
    $platelets = mysqli_real_escape_string($con,$_POST["platelets"]);
    $rbc = mysqli_real_escape_string($con,$_POST["rbc"]);
    $retics = mysqli_real_escape_string($con,$_POST["retics"]);
    $mcv = mysqli_real_escape_string($con,$_POST["mcv"]);
    $mchc = mysqli_real_escape_string($con,$_POST["mchc"]);
    $mch = mysqli_real_escape_string($con,$_POST["mch"]);
    $bleedingTime = mysqli_real_escape_string($con,$_POST["bleedingTime"]);
    $clothing = mysqli_real_escape_string($con,$_POST["clothing"]);
    $protrombin = mysqli_real_escape_string($con,$_POST["protrombin"]);
    $trombinTime = mysqli_real_escape_string($con,$_POST["trombinTime"]);
    $pttk = mysqli_real_escape_string($con,$_POST["pttk"]);
    $leCells = mysqli_real_escape_string($con,$_POST["leCells"]);
    $esr = mysqli_real_escape_string($con,$_POST["esr"]);
    $bloodGroup = mysqli_real_escape_string($con,$_POST["bloodGroup"]);
    $hbGenotype = mysqli_real_escape_string($con,$_POST["hbGenotype"]);
    $malariaParasite = mysqli_real_escape_string($con,$_POST["malariaParasite"]);
    $microFilaria = mysqli_real_escape_string($con,$_POST["microFilaria"]);
    $directCombs = mysqli_real_escape_string($con,$_POST["directCombs"]);
    $testRemarks = mysqli_real_escape_string($con,$_POST["testRemarks"]);
    $indirect_comb_test = mysqli_real_escape_string($con,$_POST["indirectCombs"]);
    $clinical_diagnostics = mysqli_real_escape_string($con,$_POST["clinical_diagnostics"]);
    $test_status = "updated";
    $clinician = $_SESSION["staff_name"];
    $date = date('d-m-Y');
    $today = "";
    $update = mysqli_query($con,"UPDATE haematology SET specimen='".$haematologySpecimen."', date_updated='".$date."', pcv='".$pcv."', hb='".$hb."', tlc='".$tlc."', neutrophils='".$neutrophils."', lymphocytes='".$lymphocytes."', eosinophils='".$eosinophils."', monocytes='".$monocytes."', baseophils='".$baseophils."', plateletes='".$platelets."', rbc='".$rbc."', retics='".$retics."', mcv='".$mcv."',mchc='".$mchc."', mch='".$mch."', bleeding_time='".$bleedingTime."', clothing_time='".$clothing."', protrobim='".$protrombin."', trombim_time='".$trombinTime."', pttk='".$pttk."', le_cells='".$leCells."',esr='".$esr."', blood_group='".$bloodGroup."', hb_genotype='".$hbGenotype."', malaria_parasites='".$malariaParasite."', micro_filaria='".$microFilaria."', direct_combs_test='".$directCombs."',indirect_comb_test='".$indirect_comb_test."', scientist_remarks='".$testRemarks."', clinical_diagnostics='".$clinical_diagnostics."' WHERE appointment_number='".$appointNum."' ");
    if($update)
    {
        $returnMessage = "test result edited succesfully";
        //header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage");
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage");
    }
    else
    {
        $returnMessage = "test result NOT edited successfully....!";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage&test=$testRef");
    }
}

if(isset($_POST["chemistrySpecimen"]))
{
    $patientNames = mysqli_real_escape_string($con,$_POST["patientName"]);
    $pat_ref = mysqli_real_escape_string($con,$_POST["refNumber"]);
    $appointNum = mysqli_real_escape_string($con,$_POST["appointmentNumber"]);
    $testRef = mysqli_real_escape_string($con,$_POST["testType"]);
    $chemistrySpecimen = mysqli_real_escape_string($con,$_POST["chemistrySpecimen"]);
    $bicarbonate = mysqli_real_escape_string($con,$_POST["bicarbonate"]);
    $chloride = mysqli_real_escape_string($con,$_POST["chloride"]);
    $sodium = mysqli_real_escape_string($con,$_POST["sodium"]);
    $potassium = mysqli_real_escape_string($con,$_POST["potassium"]);
    $sgpt = mysqli_real_escape_string($con,$_POST["sgpt"]);
    $sgot = mysqli_real_escape_string($con,$_POST["sgot"]);
    $alkalinePhosphatase = mysqli_real_escape_string($con,$_POST["alkalinePhosphatase"]);
    $amylase = mysqli_real_escape_string($con,$_POST["amylase"]);
    $acidphosphataseTotal = mysqli_real_escape_string($con,$_POST["acidphosphataseTotal"]);
    $acidphosphataseProtactic = mysqli_real_escape_string($con,$_POST["acidphosphataseProtactic"]);
    $uricAcid = mysqli_real_escape_string($con,$_POST["uricAcid"]);
    $cholesterol = mysqli_real_escape_string($con,$_POST["cholesterol"]);
    $albumin = mysqli_real_escape_string($con,$_POST["albumin"]);
    $protein = mysqli_real_escape_string($con,$_POST["protein"]);
    $bilirubinTotal = mysqli_real_escape_string($con,$_POST["bilirubinTotal"]);
    $bilirubinDirect = mysqli_real_escape_string($con,$_POST["bilirubinDirect"]);
    $urea = mysqli_real_escape_string($con,$_POST["urea"]);
    $tryglyceride = mysqli_real_escape_string($con,$_POST["tryglyceride"]);
    $ggt = mysqli_real_escape_string($con,$_POST["ggt"]);
    $ldl = mysqli_real_escape_string($con,$_POST["ldl"]);
    $hdlCholesterol = mysqli_real_escape_string($con,$_POST["hdlCholesterol"]);
    $creatinine = mysqli_real_escape_string($con,$_POST["creatinine"]);
    $inorganicPhosphorous = mysqli_real_escape_string($con,$_POST["inorganicPhosphorous"]);
    $iron = mysqli_real_escape_string($con,$_POST["iron"]);
    $calcium = mysqli_real_escape_string($con,$_POST["calcium"]);
    $ck = mysqli_real_escape_string($con,$_POST["ck"]);
    $bloodSugarFasting = mysqli_real_escape_string($con,$_POST["bloodSugarFasting"]);
    $bloodSugarRandom = mysqli_real_escape_string($con,$_POST["bloodSugarRandom"]);
    $hbAlcNonDiabetic = mysqli_real_escape_string($con,$_POST["hbAlcNonDiabetic"]);
    $hbAlcUncontrolledDiabetic = mysqli_real_escape_string($con,$_POST["hbAlcUncontrolledDiabetic"]);
    $bloodfast = mysqli_real_escape_string($con,$_POST["bloodfast"]);
    $bloodhalfHour = mysqli_real_escape_string($con,$_POST["bloodhalfHour"]);
    $bloodOneHour = mysqli_real_escape_string($con,$_POST["bloodOneHour"]);
    $bloodOneAndHalfHour = mysqli_real_escape_string($con,$_POST["bloodOneAndHalfHour"]);
    $bloodTwoHour = mysqli_real_escape_string($con,$_POST["bloodTwoHour"]);
    $bloodTwoAndHalfHour = mysqli_real_escape_string($con,$_POST["bloodTwoAndHalfHour"]);
    $urineFast = mysqli_real_escape_string($con,$_POST["urineFast"]);
    $urineHalfHour = mysqli_real_escape_string($con,$_POST["urineHalfHour"]);
    $urineOneHour = mysqli_real_escape_string($con,$_POST["urineOneHour"]);
    $urineOneAndHalfHour = mysqli_real_escape_string($con,$_POST["urineOneAndHalfHour"]);
    $urineTwoHour = mysqli_real_escape_string($con,$_POST["urineTwoHour"]);
    $urineTwoAndHalfHour = mysqli_real_escape_string($con,$_POST["urineTwoAndHalfHour"]);
    $csfGlucose = mysqli_real_escape_string($con,$_POST["csfGlucose"]);
    $csfProtein = mysqli_real_escape_string($con,$_POST["csfProtein"]);
    $urinePh = mysqli_real_escape_string($con,$_POST["urinePh"]);
    $urineProtein = mysqli_real_escape_string($con,$_POST["urineProtein"]);
    $urineGlucose = mysqli_real_escape_string($con,$_POST["urineGlucose"]);
    $urineBilirubin = mysqli_real_escape_string($con,$_POST["urineBilirubin"]);
    $urineLeucocytes = mysqli_real_escape_string($con,$_POST["urineLeucocytes"]);
    $urineBlood = mysqli_real_escape_string($con,$_POST["urineBlood"]);
    $urineAppearance = mysqli_real_escape_string($con,$_POST["urineAppearance"]);
    $urineMicroscopy = mysqli_real_escape_string($con,$_POST["urineMicroscopy"]);
    $urineSrGr = mysqli_real_escape_string($con,$_POST["urineSrGr"]);
    $urineNitrite = mysqli_real_escape_string($con,$_POST["urineNitrite"]);
    $urineKetones = mysqli_real_escape_string($con,$_POST["urineKetones"]);
    $urineUrobilnogen = mysqli_real_escape_string($con,$_POST["urineUrobilnogen"]);
    $clinician = $_SESSION["staff_name"];
    $testStatus = "updated";
    $comments = mysqli_real_escape_string($con,$_POST["comment"]);;
    $date = date('d-m-Y');
    $today = "";

    $update = mysqli_query($con,"UPDATE clinical_chemistry SET date_updated='".$date."', specimen='".$chemistrySpecimen."', bicarbonate='".$bicarbonate."', chloride='".$chloride."', sodium='".$sodium."', potassium='".$potassium."', sgpt='".$sgpt."', sgot='".$sgot."', alkaline_phosphate='".$alkalinePhosphatase."', amylase='".$amylase."', acid_phosphatase_total='".$acidphosphataseTotal."', acid_phosphatase_prostatic='".$acidphosphataseProtactic."', uric_acid='".$uricAcid."', cholesterol='".$cholesterol."', albumin='".$albumin."', protein='".$protein."', bilirubin_total='".$bilirubinTotal."', bilirubin_direct='".$bilirubinDirect."', urea='".$urea."', tryglyceride='".$tryglyceride."', ggt='".$ggt."', ldl='".$ldl."', hdl_cholesterol='".$hdlCholesterol."', creatanine='".$creatinine."',inorganic_phosphorous='".$inorganicPhosphorous."', iron='".$iron."', calcium='".$calcium."', ck='".$ck."', blood_sugar_fasting='".$bloodSugarFasting."', blood_sugar_random='".$bloodSugarRandom."', hb_alc_none_diabetic='".$hbAlcNonDiabetic."', hb_alc_uncontrolled_diabetic='".$hbAlcUncontrolledDiabetic."', gtt_blood_fasting='".$bloodfast."', gtt_blood_half_hour='".$bloodhalfHour."', gtt_blood_one_hour='".$bloodOneHour."', gtt_blood_onehalf_hour='".$bloodOneAndHalfHour."', gtt_blood_two_hour='".$bloodTwoHour."', gtt_blood_twohalf_hour='".$bloodTwoAndHalfHour."', gtt_urine_fasting='".$urineFast."', gtt_urine_half_hour='".$urineHalfHour."', gtt_urine_one_hour='".$urineOneHour."', gtt_urine_onehalf_hour='".$urineOneAndHalfHour."', gtt_urine_two_hour='".$urineTwoHour."', gtt_urine_twohalf_hour='".$urineTwoAndHalfHour."',csf_glucose='".$csfGlucose."', csf_protein='".$csfProtein."', urine_ph='".$urinePh."', urine_protein='".$urineProtein."', urine_glucose='".$urineGlucose."', urine_bilirubin='".$urineBilirubin."', urine_leucocyte='".$urineLeucocytes."', urine_blood='".$urineBlood."', urine_appearance='".$urineAppearance."', urine_microscopy='".$urineMicroscopy."', urine_srgr='".$urineSrGr."', urine_nitrite='".$urineNitrite."',urine_ketone='".$urineKetones."', urine_urobilnogen='".$urineUrobilnogen."', result_comment='".$comments."', clinician='".$clinician."' WHERE appointment_number='".$appointNum."' ");
    if($update)
    {
        $returnMessage = "test result edited succesfully";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage");
    }
    else
    {
        $returnMessage = "test result NOT edited successfully....!";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage&test=$testRef");
    }
}

if(isset($_POST["microBiologySpecimen"]))
{
    $patientNames = mysqli_real_escape_string($con,$_POST["patientName"]);
    $pat_ref = mysqli_real_escape_string($con,$_POST["refNumber"]);
    $appointNum = mysqli_real_escape_string($con,$_POST["appointmentNumber"]);
    $testRef = mysqli_real_escape_string($con,$_POST["testType"]);
    $microBiologySpecimen = mysqli_real_escape_string($con,$_POST["microBiologySpecimen"]);
    $urinePhValue = mysqli_real_escape_string($con,$_POST["urinePhValue"]);
    $spgr = mysqli_real_escape_string($con,$_POST["spgr"]);
    $protein = mysqli_real_escape_string($con,$_POST["protein"]);
    $glucose = mysqli_real_escape_string($con,$_POST["glucose"]);
    $ketone = mysqli_real_escape_string($con,$_POST["ketone"]);
    $appearance = mysqli_real_escape_string($con,$_POST["appearance"]);
    $microscopy = mysqli_real_escape_string($con,$_POST["microscopy"]);
    $bilirubin = mysqli_real_escape_string($con,$_POST["bilirubin"]);
    $urobilinogen = mysqli_real_escape_string($con,$_POST["urobilinogen"]);
    $nitrites = mysqli_real_escape_string($con,$_POST["nitrites"]);
    $leucocytes = mysqli_real_escape_string($con,$_POST["leucocytes"]);
    $blood = mysqli_real_escape_string($con,$_POST["blood"]);
    $saltyphd = mysqli_real_escape_string($con,$_POST["saltyphd"]);
    $saltyphDs = mysqli_real_escape_string($con,$_POST["saltyphDs"]);
    $salparatypha = mysqli_real_escape_string($con,$_POST["salparatypha"]);
    $salparatyphAs = mysqli_real_escape_string($con,$_POST["salparatyphAs"]);
    $salparatyphb = mysqli_real_escape_string($con,$_POST["salparatyphb"]);
    $salparatyphBs = mysqli_real_escape_string($con,$_POST["salparatyphBs"]);
    $salparatyphc = mysqli_real_escape_string($con,$_POST["salparatyphc"]);
    $salparatyphCs = mysqli_real_escape_string($con,$_POST["salparatyphCs"]);
    $testRemarks = mysqli_real_escape_string($con,$_POST["testRemarks"]);
    $macroscopy = mysqli_real_escape_string($con,$_POST["macroscopy"]);
    $microscopy_other = mysqli_real_escape_string($con,$_POST["microscopy_other"]);
    $cultureAndSerology = mysqli_real_escape_string($con,$_POST["cultureAndSerology"]);
    $clinician = $_SESSION["staff_name"];
    $test_status = "updated";
    $date = date('d-m-Y');
    $today = "";

    $update = mysqli_query($con,"UPDATE  microbiology SET date_updated='".$date."',specimen='".$microBiologySpecimen."',urine_ph='".$urinePhValue."',spgr='".$spgr."',protein='".$protein."',glucose='".$glucose."',ketone='".$ketone."',appearance='".$appearance."',microscopy='".$microscopy."',bilirubin='".$bilirubin."',urobilinogen='".$urobilinogen."',nitrites='".$nitrites."',leucocyte='".$leucocytes."',blood='".$blood."',saltyphh='".$saltyphd."',saltypho='".$saltyphDs."',salparatyphia_smallah='".$salparatypha."',salparatyphi_bigao='".$salparatyphAs."',salparatyphia_smallbh='".$salparatyphb."',salparatyphi_bigbo='".$salparatyphBs."',salparatyphia_smallch='".$salparatyphc."',salparatyphia_bigch='".$salparatyphCs."',microbiology_comment='".$testRemarks."',macroscopy='".$macroscopy."',microscopy_result='".$microscopy_other."',culture_serology='".$cultureAndSerology."',clinician='".$clinician." WHERE appointment_number='".$appointNum."' ");
    if($update)
    {
        $returnMessage = "test result edited succesfully";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage");
    }
    else
    {
        $returnMessage = "test result NOT edited successfully....!";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage&test=$testRef");
    }
}

if(isset($_POST["semenSpecimenSample"]))
{
    $patientNames = mysqli_real_escape_string($con,$_POST["patientName"]);
    $pat_ref = mysqli_real_escape_string($con,$_POST["refNumber"]);
    $appointNum = mysqli_real_escape_string($con,$_POST["appointmentNumber"]);
    $testRef = mysqli_real_escape_string($con,$_POST["testType"]);
    $semenSpecimenSample = mysqli_real_escape_string($con,$_POST["semenSpecimenSample"]);
    $dateOfSample = mysqli_real_escape_string($con,$_POST["dateOfSample"]);
    $abstenaceDuration = mysqli_real_escape_string($con,$_POST["abstenaceDuration"]);
    $ejaculationInterval = mysqli_real_escape_string($con,$_POST["ejaculationInterval"]);
    $appearance = mysqli_real_escape_string($con,$_POST["appearance"]);
    $semenPH = mysqli_real_escape_string($con,$_POST["semenPH"]);
    $liquefaction = mysqli_real_escape_string($con,$_POST["liquefaction"]);
    $consistency = mysqli_real_escape_string($con,$_POST["consistency"]);
    $volume = mysqli_real_escape_string($con,$_POST["volume"]);
    $rapidLinearProgression = mysqli_real_escape_string($con,$_POST["rapidLinearProgression"]);
    $nonLinearProgression = mysqli_real_escape_string($con,$_POST["nonLinearProgression"]);
    $nonLinearProgressionMotility = mysqli_real_escape_string($con,$_POST["nonLinearProgressionMotility"]);
    $immotile = mysqli_real_escape_string($con,$_POST["immotile"]);
    $viability = mysqli_real_escape_string($con,$_POST["viability"]);
    $concentrationSpermCount = mysqli_real_escape_string($con,$_POST["concentrationSpermCount"]);
    $spermatozoalml = mysqli_real_escape_string($con,$_POST["spermatozoalml"]);
    $percentageNormalHeadMorphology = mysqli_real_escape_string($con,$_POST["percentageNormalHeadMorphology"]);
    $percentageLargeOvalHeadMophology = mysqli_real_escape_string($con,$_POST["percentageLargeOvalHeadMophology"]);
    $percentagePyriformHeadMorphology = mysqli_real_escape_string($con,$_POST["percentagePyriformHeadMorphology"]);
    $percenatgeTaperingHeadMorphology = mysqli_real_escape_string($con,$_POST["percenatgeTaperingHeadMorphology"]);
    $percenatgeAmorphousHeadMorphology = mysqli_real_escape_string($con,$_POST["percenatgeAmorphousHeadMorphology"]);
    $percenatgeDoubleHeadMorphology = mysqli_real_escape_string($con,$_POST["percenatgeDoubleHeadMorphology"]);
    $percenatgePinHeadMorphology = mysqli_real_escape_string($con,$_POST["percenatgePinHeadMorphology"]);
    $percenatgeRoundHeadMorphology = mysqli_real_escape_string($con,$_POST["percenatgeRoundHeadMorphology"]);
    $percentageNormalMidpieceMorphology = mysqli_real_escape_string($con,$_POST["percentageNormalMidpieceMorphology"]);
    $percentageAbnormalMidpieceMorphology = mysqli_real_escape_string($con,$_POST["percentageAbnormalMidpieceMorphology"]);
    $percentageCytoplasmicMidpieceMorphology = mysqli_real_escape_string($con,$_POST["percentageCytoplasmicMidpieceMorphology"]);
    $percentageNormalTailMorphology = mysqli_real_escape_string($con,$_POST["percentageNormalTailMorphology"]);
    $percentageAbnormalTailMorphology = mysqli_real_escape_string($con,$_POST["percentageAbnormalTailMorphology"]);
    $agglutination = mysqli_real_escape_string($con,$_POST["agglutination"]);
    $yesAgglutination = mysqli_real_escape_string($con,$_POST["yesAgglutination"]);
    $microscopy = mysqli_real_escape_string($con,$_POST["microscopy"]);
    $comment = mysqli_real_escape_string($con,$_POST["comment"]);
    $clinical_diagnostics = mysqli_real_escape_string($con,$_POST["clinical_diagnostics"]);
    $clinician = $_SESSION["staff_name"];
    $test_status = "updated";
    $date = date('d-m-Y');
    $today = "";

    $update = mysqli_query($con,"UPDATE semen_analysis SET update_date='".$date."', specimen='".$semenSpecimenSample."', date_of_sample='".$dateOfSample."', duration_of_abstenance='".$abstenaceDuratio."', ejaculation_analysis_interval='".$ejaculationInterval."', appearance='".$appearance."', liquefaction='".$liquefaction."',consistency='".$consistency."', volume='".$volume."', semen_ph='".$semenPH."', rapid_linear_progression='".$rapidLinearProgression."', non_linear_progression='".$nonLinearProgression."',progressive_motility='".$nonLinearProgressionMotility."', immotile='".$immotile."', viability='".$viability."', concentraton='".$concentrationSpermCount."', spermatozoa_lml='".$spermatozoalml."', morphology_head_normal='".$percentageNormalHeadMorphology."', morphology_head_large_oval='".$percentageLargeOvalHeadMophology."', morphology_head_pyriform='".$percentagePyriformHeadMorphology."', morphology_head_tapering='".$percenatgeTaperingHeadMorphology."', morphology_head_amorphous='".$percenatgeAmorphousHeadMorphology."', morphology_head_double='".$percenatgeDoubleHeadMorphology."', morphology_head_pin='".$percenatgePinHeadMorphology."', morphology_head_round='".$percenatgeRoundHeadMorphology."', morphology_midpiece_normal='".$percentageNormalMidpieceMorphology."',morphology_midpiece_abnormal='".$percentageAbnormalMidpieceMorphology."', morphology_midpiece_cytoplasmic='".$percentageCytoplasmicMidpieceMorphology."', morphology_tail_normal='".$percentageNormalTailMorphology."', morphology_tail_abnormal='".$percentageAbnormalTailMorphology."',agglutination='".$agglutination."', yes_agglutination='".$yesAgglutination."', microscopy='".$microscopy."',test_comment='".$comment."', clinician='".$clinician."',clinical_diagnostics='".$clinical_diagnostics."' WHERE appointment_number='".$appointNum."' ");
    if($update)
    {
        $returnMessage = "test result edited succesfully";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage");
    }
    else
    {
        $returnMessage = "test result NOT edited successfully....!";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage&test=$testRef");
    }
}

if(isset($_POST["laboratorySpecimen"]))
{
    $patientNames = mysqli_real_escape_string($con,$_POST["patientName"]);
    $pat_ref = mysqli_real_escape_string($con,$_POST["refNumber"]);
    $appointNum = mysqli_real_escape_string($con,$_POST["appointmentNumber"]);
    $testRef = mysqli_real_escape_string($con,$_POST["testType"]);
    $laboratorySpecimen = mysqli_real_escape_string($con,$_POST["laboratorySpecimen"]);
    $laboratoryReport = mysqli_real_escape_string($con,$_POST["laboratoryReport"]);
    $clinician = $_SESSION["staff_name"];
    $test_status = "updated";
    $date = date('d-m-Y');
    $today = "";

    $update = mysqli_query($con,"UPDATE clinical_laboratory SET 
    date_updated='".$date."', specimen='".$laboratorySpecimen."', test_report='".$laboratoryReport."', clinician='".$clinician."' WHERE appointment_number='".$appointNum."' ");
    if($update)
    {
        $returnMessage = "test result edited succesfully";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage");
    }
    else
    {
        $returnMessage = "test result NOT edited successfully....!";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage&test=$testRef");
    }
}

if(isset($_POST["homonalSpecimenSample"]))
{
    $patientNames = mysqli_real_escape_string($con,$_POST["patientName"]);
    $pat_ref = mysqli_real_escape_string($con,$_POST["refNumber"]);
    $appointNum = mysqli_real_escape_string($con,$_POST["appointmentNumber"]);
    $testRef = mysqli_real_escape_string($con,$_POST["testType"]);
    $homonalSpecimen = mysqli_real_escape_string($con,$_POST["homonalSpecimenSample"]);
    $progesterone = mysqli_real_escape_string($con,$_POST["progesterone"]);
    $lh = mysqli_real_escape_string($con,$_POST["lh"]);
    $fsh = mysqli_real_escape_string($con,$_POST["fsh"]);
    $estradio = mysqli_real_escape_string($con,$_POST["estradio"]);
    $prolcatin = mysqli_real_escape_string($con,$_POST["prolcatin"]);
    $testosterone = mysqli_real_escape_string($con,$_POST["testosterone"]);
    $psa = mysqli_real_escape_string($con,$_POST["psa"]);
    $hbalc = mysqli_real_escape_string($con,$_POST["hbalc"]);
    $bhcg = mysqli_real_escape_string($con,$_POST["bhcg"]);
    $clinical_diagnostics = mysqli_real_escape_string($con,$_POST["clinical_diagnostics"]);
    $clinician = $_SESSION["staff_name"];
    $test_status = "updated";
    $date = date('d-m-Y');
    $today = "";

    $update = mysqli_query($con,"UPDATE homonal_assays SET specimen='".$homonalSpecimen."', progesterone='".$progesterone."', lh='".$lh."', fsh='".$fsh."', estradiol='".$estradio."', prolactin='".$prolcatin."', testosterone='".$testosterone."', psa='".$psa."', hbalc='".$hbalc."', bhcg='".$bhcg."', clinical_diagnostics='".$clinical_diagnostics."' WHERE appointment_number='".$appointNum."' ");
    if($update)
    {
        $returnMessage = "test result edited succesfully";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage");
    }
    else
    {
        $returnMessage = "test result NOT edited successfully....!";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage&test=$testRef");
    }
}

if(isset($_POST["otherSpecimenSample"]))
{
    include 'fabinde.php';

    $patientNames = mysqli_real_escape_string($con,$_POST["patientName"]);
    $pat_ref = mysqli_real_escape_string($con,$_POST["refNumber"]);
    $appointNum = mysqli_real_escape_string($con,$_POST["appointmentNumber"]);
    $testRef = mysqli_real_escape_string($con,$_POST["testType"]);
    $otherSpecimenSample = mysqli_real_escape_string($con,$_POST["otherSpecimenSample"]);
    $otherResult = mysqli_real_escape_string($con,$_POST["otherResult"]);
    $otherUnitMeasurement = mysqli_real_escape_string($con,$_POST["otherUnitMeasurement"]);
    $otherClinicalDiagnostics = mysqli_real_escape_string($con,$_POST["otherClinicalDiagnostics"]);
    $test_status = "updated";
    $date = date('d-m-Y');
    
    $update = mysqli_query($con,"UPDATE other_result SET test_specimen='".$otherSpecimenSample."',test_result='".$otherResult."', unit_of_measure='".$otherUnitMeasurement."', clinical_diagnosis='".$otherClinicalDiagnostics."', date_updated='".$date."' WHERE appointment_number='".$appointNum."' ");
    if($update)
    {
        $returnMessage = "test result edited succesfully";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage");
    }
    else
    {
        $returnMessage = "test result NOT edited successfully....!";
        header("location:all_result_view.php?ref=$pat_ref&appointmentNo=$appointNum&message=$returnMessage&test=$testRef");
    }
}

if(isset($_POST["penicillinOne"]))
{
    $patientNames = mysqli_real_escape_string($con,$_POST["patientName"]);
    $pat_ref = mysqli_real_escape_string($con,$_POST["refNumber"]);
    $appointNum = mysqli_real_escape_string($con,$_POST["appointmentNumber"]);
    $today = mysqli_real_escape_string($con,$_POST["today"]);
    $penicillinOne = mysqli_real_escape_string($con,$_POST["penicillinOne"]);
    $penicillinTwo = mysqli_real_escape_string($con,$_POST["penicillinTwo"]);
    $penicillinThree = mysqli_real_escape_string($con,$_POST["penicillinThree"]);
    $penicillinFour = mysqli_real_escape_string($con,$_POST["penicillinFour"]);
    $amicillinOne = mysqli_real_escape_string($con,$_POST["ampicillinOne"]);
    $amicillinTwo = mysqli_real_escape_string($con,$_POST["ampicillinTwo"]);
    $amicillinThree = mysqli_real_escape_string($con,$_POST["ampicillinThree"]);
    $amicillinFour = mysqli_real_escape_string($con,$_POST["ampicillinFour"]);
    $streptomycinOne = mysqli_real_escape_string($con,$_POST["streptomycinOne"]);
    $streptomycinTwo = mysqli_real_escape_string($con,$_POST["streptomycinTwo"]);
    $streptomycinThree = mysqli_real_escape_string($con,$_POST["streptomycinThree"]);
    $streptomycinFour = mysqli_real_escape_string($con,$_POST["streptomycinFour"]);
    $chlorampenicolOne = mysqli_real_escape_string($con,$_POST["chlorampenicolOne"]);
    $chlorampenicolTwo = mysqli_real_escape_string($con,$_POST["chlorampenicolTwo"]);
    $chlorampenicolThree = mysqli_real_escape_string($con,$_POST["chlorampenicolThree"]);
    $chlorampenicolFour = mysqli_real_escape_string($con,$_POST["chlorampenicolFour"]);
    $tetracyclineOne = mysqli_real_escape_string($con,$_POST["tetracyclineOne"]);
    $tetracyclineTwo = mysqli_real_escape_string($con,$_POST["tetracyclineTwo"]);
    $tetracyclineThree = mysqli_real_escape_string($con,$_POST["tetracyclineThree"]);
    $tetracyclineFour = mysqli_real_escape_string($con,$_POST["tetracyclineFour"]);
    $erythtomycineOne = mysqli_real_escape_string($con,$_POST["erythtomycineOne"]);
    $erythtomycineTwo = mysqli_real_escape_string($con,$_POST["erythtomycineTwo"]);
    $erythtomycineThree = mysqli_real_escape_string($con,$_POST["erythtomycineThree"]);
    $erythtomycineFour = mysqli_real_escape_string($con,$_POST["erythtomycineFour"]);
    $septrinOne = mysqli_real_escape_string($con,$_POST["septrinOne"]);
    $septrinTwo = mysqli_real_escape_string($con,$_POST["septrinTwo"]);
    $septrinThree = mysqli_real_escape_string($con,$_POST["septrinThree"]);
    $septrinFour = mysqli_real_escape_string($con,$_POST["septrinFour"]);
    $cloxacillinOne = mysqli_real_escape_string($con,$_POST["cloxacillinOne"]);
    $cloxacillinTwo = mysqli_real_escape_string($con,$_POST["cloxacillinTwo"]);
    $cloxacillinThree = mysqli_real_escape_string($con,$_POST["cloxacillinThree"]);
    $cloxacillinFour = mysqli_real_escape_string($con,$_POST["cloxacillinFour"]);
    $contrimoxazoleOne = mysqli_real_escape_string($con,$_POST["contrimoxazoleOne"]);
    $contrimoxazoleTwo = mysqli_real_escape_string($con,$_POST["contrimoxazoleTwo"]);
    $contrimoxazoleThree = mysqli_real_escape_string($con,$_POST["contrimoxazoleThree"]);
    $contrimoxazoleFour = mysqli_real_escape_string($con,$_POST["contrimoxazoleFour"]);
    $furadantineOne = mysqli_real_escape_string($con,$_POST["furadantineOne"]);
    $furadantineTwo = mysqli_real_escape_string($con,$_POST["furadantineTwo"]);
    $furadantineThree = mysqli_real_escape_string($con,$_POST["furadantineThree"]);
    $furadantineFour = mysqli_real_escape_string($con,$_POST["furadantineFour"]);
    $nalidixicAcidOne = mysqli_real_escape_string($con,$_POST["nalidixicAcidOne"]);
    $nalidixicAcidTwo = mysqli_real_escape_string($con,$_POST["nalidixicAcidTwo"]);
    $nalidixicAcidThree = mysqli_real_escape_string($con,$_POST["nalidixicAcidThree"]);
    $nalidixicAcidFour = mysqli_real_escape_string($con,$_POST["nalidixicAcidFour"]);
    $colistinSulphateOne = mysqli_real_escape_string($con,$_POST["colistinSulphateOne"]);
    $colistinSulphateTwo = mysqli_real_escape_string($con,$_POST["colistinSulphateTwo"]);
    $colistinSulphateThree = mysqli_real_escape_string($con,$_POST["colistinSulphateThree"]);
    $colistinSulphateFour = mysqli_real_escape_string($con,$_POST["colistinSulphateFour"]);
    $genticinOne = mysqli_real_escape_string($con,$_POST["genticinOne"]);
    $genticinTwo = mysqli_real_escape_string($con,$_POST["genticinTwo"]);
    $genticinThree = mysqli_real_escape_string($con,$_POST["genticinThree"]);
    $genticinFour = mysqli_real_escape_string($con,$_POST["genticinFour"]);
    $arithromycineOne = mysqli_real_escape_string($con,$_POST["arithromycineOne"]);
    $arithromycineTwo = mysqli_real_escape_string($con,$_POST["arithromycineTwo"]);
    $arithromycineThree = mysqli_real_escape_string($con,$_POST["arithromycineThree"]);
    $arithromycineFour = mysqli_real_escape_string($con,$_POST["arithromycineFour"]);
    $ceftazidimeOne = mysqli_real_escape_string($con,$_POST["ceftazidimeOne"]);
    $ceftazidimeTwo = mysqli_real_escape_string($con,$_POST["ceftazidimeTwo"]);
    $ceftazidimeThree = mysqli_real_escape_string($con,$_POST["ceftazidimeThree"]);
    $ceftazidimeFour = mysqli_real_escape_string($con,$_POST["ceftazidimeFour"]);
    $ciprofloxacinOne = mysqli_real_escape_string($con,$_POST["ciprofloxacinOne"]);
    $ciprofloxacinTwo = mysqli_real_escape_string($con,$_POST["ciprofloxacinTwo"]);
    $ciprofloxacinThree = mysqli_real_escape_string($con,$_POST["ciprofloxacinThree"]);
    $ciprofloxacinFour = mysqli_real_escape_string($con,$_POST["ciprofloxacinFour"]);
    $ofloxacintarvidOne = mysqli_real_escape_string($con,$_POST["ofloxacintarvidOne"]);
    $ofloxacintarvidTwo = mysqli_real_escape_string($con,$_POST["ofloxacintarvidTwo"]);
    $ofloxacintarvidThree = mysqli_real_escape_string($con,$_POST["ofloxacintarvidThree"]);
    $ofloxacintarvidFour = mysqli_real_escape_string($con,$_POST["ofloxacintarvidFour"]);
    $ceftriaoxoneOne = mysqli_real_escape_string($con,$_POST["ceftriaoxoneOne"]);
    $ceftriaoxoneTwo = mysqli_real_escape_string($con,$_POST["ceftriaoxoneTwo"]);
    $ceftriaoxoneThree = mysqli_real_escape_string($con,$_POST["ceftriaoxoneThree"]);
    $ceftriaoxoneFour = mysqli_real_escape_string($con,$_POST["ceftriaoxoneFour"]);
    $zinnatOne = mysqli_real_escape_string($con,$_POST["zinnatOne"]);
    $zinnatTwo = mysqli_real_escape_string($con,$_POST["zinnatTwo"]);
    $zinnatThree = mysqli_real_escape_string($con,$_POST["zinnatThree"]);
    $zinnatFour = mysqli_real_escape_string($con,$_POST["zinnatFour"]);
    $rocephineOne = mysqli_real_escape_string($con,$_POST["rocephineOne"]);
    $rocephineTwo = mysqli_real_escape_string($con,$_POST["rocephineTwo"]);
    $rocephineThree = mysqli_real_escape_string($con,$_POST["rocephineThree"]);
    $rocephineFour = mysqli_real_escape_string($con,$_POST["rocephineFour"]);
    $unasymOne = mysqli_real_escape_string($con,$_POST["unasymOne"]);
    $unasymTwo = mysqli_real_escape_string($con,$_POST["unasymTwo"]);
    $unasymThree = mysqli_real_escape_string($con,$_POST["unasymThree"]);
    $unasymFour = mysqli_real_escape_string($con,$_POST["unasymFour"]);

        $insert = mysqli_query($con,"INSERT INTO resistivity(patient_ref,appointment_number,penicilin_one,penicilin_two,penicilin_three,penicilin_four,ampicillin_one,ampicillin_two,ampicillin_three,ampicillin_four,streptomycin_one,streptomycin_two,streptomycin_three,streptomycin_four,chlorampenicol_one,chlorampenicol_two,chlorampenicol_three,chlorampenicol_four,tetracycline_one,tetracycline_two,tetracycline_three,tetracycline_four,erithtomycine_one,erithtomycine_two,erithtomycine_three,erithtomycine_four,septrin_one,septrin_two,septrin_three,septrin_four,cloxacilin_one,cloxacilin_two,cloxacilin_three,cloxacilin_four,contrimoxazole_one,contrimoxazole_two,contrimoxazole_three,contrimoxazole_four,furadantine_one,furadantine_two,furadantine_three,furadantine_four,nalidixic_acid_one,nalidixic_acid_two,nalidixic_acid_three,nalidixic_acid_four,colistin_suphate_one,colistin_suphate_two,colistin_suphate_three,colistin_suphate_four,genticin_one,genticin_two,genticin_three,genticin_four,arithromycine_one,arithromycine_two,arithromycine_three,arithromycine_four,ceftazidime_one,ceftazidime_two,ceftazidime_three,ceftazidime_four,ciprofloxacin_one,ciprofloxacin_two,ciprofloxacin_three,ciprofloxacin_four,ofloxacin_one,ofloxacin_two,ofloxacin_three,ofloxacin_four,ceftriaoxone_one,ceftriaoxone_two,ceftriaoxone_three,ceftriaoxone_four,zinnat_one,zinnat_two,zinnat_three,zinnat_four,rocephine_one,rocephine_two,rocephine_three,rocephine_four,unasym_one,unasym_two,unasym_three,unasym_four) VALUES('$pat_ref','$appointNum','$penicillinOne','$penicillinTwo','$penicillinThree','$penicillinFour','$amicillinOne','$amicillinTwo','$amicillinThree','$amicillinFour','$streptomycinOne','$streptomycinTwo','$streptomycinThree','$streptomycinFour','$chlorampenicolOne','$chlorampenicolTwo','$chlorampenicolThree','$chlorampenicolFour','$tetracyclineOne','$tetracyclineTwo','$tetracyclineThree','$tetracyclineFour','$erythtomycineOne','$erythtomycineTwo','$erythtomycineThree','$erythtomycineFour','$septrinOne','$septrinTwo','$septrinThree','$septrinFour','$cloxacillinOne','$cloxacillinTwo','$cloxacillinThree','$cloxacillinFour','$contrimoxazoleOne','$contrimoxazoleTwo','$contrimoxazoleThree','$contrimoxazoleFour','$furadantineOne','$furadantineTwo','$furadantineThree','$furadantineFour','$nalidixicAcidOne','$nalidixicAcidTwo','$nalidixicAcidThree','$nalidixicAcidFour','$colistinSulphateOne','$colistinSulphateTwo','$colistinSulphateThree','$colistinSulphateFour','$genticinOne','$genticinTwo','$genticinThree','$genticinFour','$arithromycineOne','$arithromycineTwo','$arithromycineThree','$arithromycineFour','$ceftazidimeOne','$ceftazidimeTwo','$ceftazidimeThree','$ceftazidimeFour','$ciprofloxacinOne','$ciprofloxacinTwo','$ciprofloxacinThree','$ciprofloxacinFour','$ofloxacintarvidOne','$ofloxacintarvidTwo','$ofloxacintarvidThree','$ofloxacintarvidFour','$ceftriaoxoneOne','$ceftriaoxoneTwo','$ceftriaoxoneThree','$ceftriaoxoneFour','$zinnatOne','$zinnatTwo','$zinnatThree','$zinnatFour','$rocephineOne','$rocephineTwo','$rocephineThree','$rocephineFour','$unasymOne','$unasymTwo','$unasymThree','$unasymFour')");
    if($insert)
    {}
}
?>