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

    $insert = mysqli_query($con,"INSERT INTO haematology(patient_name,ref_number,test_type,appointment_number,test_status,specimen,date_updated,pcv,hb,tlc,neutrophils,lymphocytes,eosinophils,monocytes,baseophils,plateletes,rbc,retics,mcv,mchc,mch,bleeding_time,clothing_time,protrobim,trombim_time,pttk,le_cells,esr,blood_group,hb_genotype,malaria_parasites,micro_filaria,direct_combs_test,indirect_comb_test,scientist_remarks,clinician,clinical_diagnostics) VALUES('$patientNames','$pat_ref','$testRef','$appointNum','$test_status','$haematologySpecimen','$date','$pcv','$hb','$tlc','$neutrophils','$lymphocytes','$eosinophils','$monocytes','$baseophils','$platelets','$rbc','$retics','$mcv','$mchc','$mch','$bleedingTime','$clothing','$protrombin','$trombinTime','$pttk','$leCells','$esr','$bloodGroup','$hbGenotype','$malariaParasite','$microFilaria','$directCombs','$indirect_comb_test','$testRemarks','$clinician','$clinical_diagnostics')");
    if($insert)
    {
        $returnMessage = "test result inserted successfully";
        $testNumber;
        $check = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointNum'");
        if(mysqli_num_rows($check) >= 1)
        {
            while($result = mysqli_fetch_assoc($check))
            {
                $testNumber = $result['total_test'];
            }
            if(intval($testNumber) >= 1)
            {
                $testNumber = intval($testNumber) - 1 ;
                if(intval($testNumber) == 0)
                {
                    $status = "finish";
                    $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        //header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                        header("location:save_resistivity.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today&patientName=$patientNames");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED to finish";
                        //header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                        header("location:save_resistivity.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today&patientName=$patientNames");
                    }
                }
                else
                {
                    $update = mysqli_query($con,"UPDATE appointments SET total_test='".$testNumber."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        //header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                        header("location:save_resistivity.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today&patientName=$patientNames");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED";
                        //header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                        header("location:save_resistivity.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today&patientName=$patientNames");
                    }
                }
            }
            elseif(intval($testNumber) == 0)
            {
                $status = "finish";
                $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                if($update)
                {
                    //header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    header("location:save_resistivity.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today&patientName=$patientNames");
                }
                else
                {
                    $returnMessage = "appointment table NOT UPDATED too finish";
                    //header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    header("location:save_resistivity.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today&patientName=$patientNames");
                }
            }
        }
        else
        {}
    }
    else
    {
        $returnMessage = "test result NOT inserted....something happened";
        header("location:input_result.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&test=$tests");
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
    {
        $returnMessage = "resistivity result inserted successfully";
        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
    }
    else
    {
        $returnMessage = "resistivity result NOT inserted successfully";
        header("location:save_resistivity.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
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

    $insert = mysqli_query($con,"INSERT INTO clinical_chemistry(patient_name,ref_number,appointment_number,test_status,date_updated,specimen,test_type,bicarbonate,chloride,sodium,potassium,sgpt,sgot,alkaline_phosphate,amylase,acid_phosphatase_total,acid_phosphatase_prostatic,uric_acid,cholesterol,albumin,protein,bilirubin_total,bilirubin_direct,urea,tryglyceride,ggt,ldl,hdl_cholesterol,creatanine,inorganic_phosphorous,iron,calcium,ck,blood_sugar_fasting,blood_sugar_random,hb_alc_none_diabetic,hb_alc_uncontrolled_diabetic,gtt_blood_fasting,gtt_blood_half_hour,gtt_blood_one_hour,gtt_blood_onehalf_hour,gtt_blood_two_hour,gtt_blood_twohalf_hour,gtt_urine_fasting,gtt_urine_half_hour,gtt_urine_one_hour,gtt_urine_onehalf_hour,gtt_urine_two_hour,gtt_urine_twohalf_hour,csf_glucose,csf_protein,urine_ph,urine_protein,urine_glucose,urine_bilirubin,urine_leucocyte,urine_blood,urine_appearance,urine_microscopy,urine_srgr,urine_nitrite,urine_ketone,urine_urobilnogen,result_comment,clinician) VALUES('$patientNames','$pat_ref','$appointNum','$testStatus','$date','$chemistrySpecimen','$testRef','$bicarbonate','$chloride','$sodium','$potassium','$sgpt','$sgot','$alkalinePhosphatase','$amylase','$acidphosphataseTotal','$acidphosphataseProtactic','$uricAcid','$cholesterol','$albumin','$protein','$bilirubinTotal','$bilirubinDirect','$urea','$tryglyceride','$ggt','$ldl','$hdlCholesterol','$creatinine','$inorganicPhosphorous','$iron','$calcium','$ck','$bloodSugarFasting','$bloodSugarRandom','$hbAlcNonDiabetic','$hbAlcUncontrolledDiabetic','$bloodfast','$bloodhalfHour','$bloodOneHour','$bloodOneAndHalfHour','$bloodTwoHour','$bloodTwoAndHalfHour','$urineFast','$urineHalfHour','$urineOneHour','$urineOneAndHalfHour','$urineTwoHour','$urineTwoAndHalfHour','$csfGlucose','$csfProtein','$urinePh','$urineProtein','$urineGlucose','$urineBilirubin','$urineLeucocytes','$urineBlood','$urineAppearance','$urineMicroscopy','$urineSrGr','$urineNitrite','$urineKetones','$urineUrobilnogen','$comments','$clinician')");
    if($insert)
    {
        $returnMessage = "test result inserted successfully";
        $testNumber;
        $check = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointNum'");
        if(mysqli_num_rows($check) >= 1)
        {
            while($result = mysqli_fetch_assoc($check))
            {
                $testNumber = $result['total_test'];
                $today = $result['appointment_date'];
            }
            if(intval($testNumber) >= 1)
            {
                $testNumber = intval($testNumber) - 1 ;
                if(intval($testNumber) == 0)
                {
                    $status = "finish";
                    $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED too finish";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
                else
                {
                    $update = mysqli_query($con,"UPDATE appointments SET total_test='".$testNumber."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
            }
            elseif(intval($testNumber) == 0)
            {
                $status = "finish";
                $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                if($update)
                {
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
                else
                {
                    $returnMessage = "appointment table NOT UPDATED too finish";
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
            }
        }
        else
        {}
    }
    else
    {
        $returnMessage = "test result NOT inserted....something happened";
        header("location:input_result.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&test=$tests");
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

    $insert = mysqli_query($con,"INSERT INTO microbiology(patient_name,ref_number,test_status,date_updated,specimen,appointment_number,test_type,urine_ph,spgr,protein,glucose,ketone,appearance,microscopy,bilirubin,urobilinogen,nitrites,leucocyte,blood,saltyphh,saltypho,salparatyphia_smallah,salparatyphi_bigao,salparatyphia_smallbh,salparatyphi_bigbo,salparatyphia_smallch,salparatyphia_bigch,microbiology_comment,macroscopy,microscopy_result,culture_serology,clinician) VALUES('$patientNames','$pat_ref','$test_status','$date','$microBiologySpecimen','$appointNum','$testRef','$urinePhValue','$spgr','$protein','$glucose','$ketone','$appearance','$microscopy','$bilirubin','$urobilinogen','$nitrites','$leucocytes','$blood','$saltyphd','$saltyphDs','$salparatypha','$salparatyphAs','$salparatyphb','$salparatyphBs','$salparatyphc','$salparatyphCs','$testRemarks','$macroscopy','$microscopy_other','$cultureAndSerology','$clinician')");
    if($insert)
    {
        $returnMessage = "test result inserted successfully";
        $testNumber;
        $check = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointNum'");
        if(mysqli_num_rows($check) >= 1)
        {
            while($result = mysqli_fetch_assoc($check))
            {
                $testNumber = $result['total_test'];
                $today = $result['appointment_date'];
            }
            if(intval($testNumber) >= 1)
            {
                $testNumber = intval($testNumber) - 1 ;
                if(intval($testNumber) == 0)
                {
                    $status = "finish";
                    $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED too finish";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
                else
                {
                    $update = mysqli_query($con,"UPDATE appointments SET total_test='".$testNumber."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
            }
            elseif(intval($testNumber) == 0)
            {
                $status = "finish";
                $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                if($update)
                {
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
                else
                {
                    $returnMessage = "appointment table NOT UPDATED too finish";
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
            }
        }
        else
        {}
    }
    else
    {
        $returnMessage = "test result NOT inserted....something happened";
        header("location:input_result.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&test=$tests");
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

    $insert = mysqli_query($con,"INSERT INTO semen_analysis(patient_name,ref_number,appointment_number,test_type,test_status,update_date,specimen,date_of_sample,duration_of_abstenance,ejaculation_analysis_interval,appearance,liquefaction,consistency,volume,semen_ph,rapid_linear_progression,non_linear_progression,progressive_motility,immotile,viability,concentraton,spermatozoa_lml,morphology_head_normal,morphology_head_large_oval,morphology_head_pyriform,morphology_head_tapering,morphology_head_amorphous,morphology_head_double,morphology_head_pin,morphology_head_round,morphology_midpiece_normal,morphology_midpiece_abnormal,morphology_midpiece_cytoplasmic,morphology_tail_normal,morphology_tail_abnormal,agglutination,yes_agglutination,microscopy,test_comment,clinician,clinical_diagnostics) VALUES('$patientNames','$pat_ref','$appointNum','$testRef','$test_status','$date','$semenSpecimenSample','$dateOfSample','$abstenaceDuration','$ejaculationInterval','$appearance','$liquefaction','$consistency','$volume','$semenPH','$rapidLinearProgression','$nonLinearProgression','$nonLinearProgressionMotility','$immotile','$viability','$concentrationSpermCount','$spermatozoalml','$percentageNormalHeadMorphology','$percentageLargeOvalHeadMophology','$percentagePyriformHeadMorphology','$percenatgeTaperingHeadMorphology','$percenatgeAmorphousHeadMorphology',$percenatgeDoubleHeadMorphology','$percenatgePinHeadMorphology','$percenatgeRoundHeadMorphology','$percentageNormalMidpieceMorphology','$percentageAbnormalMidpieceMorphology','$percentageCytoplasmicMidpieceMorphology','$percentageNormalTailMorphology','$percentageAbnormalTailMorphology','$agglutination','$yesAgglutination','$microscopy','$comment','$clinician',''$clinical_diagnostics)");
    if($insert)
    {
        $returnMessage = "test result inserted successfully";
        $testNumber;
        $check = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointNum'");
        if(mysqli_num_rows($check) >= 1)
        {
            while($result = mysqli_fetch_assoc($check))
            {
                $testNumber = $result['total_test'];
                $today = $result['appointment_date'];
            }
            if(intval($testNumber) >= 1)
            {
                $testNumber = intval($testNumber) - 1 ;
                if(intval($testNumber) == 0)
                {
                    $status = "finish";
                    $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED too finish";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
                else
                {
                    $update = mysqli_query($con,"UPDATE appointments SET total_test='".$testNumber."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
            }
            elseif(intval($testNumber) == 0)
            {
                $status = "finish";
                $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                if($update)
                {
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
                else
                {
                    $returnMessage = "appointment table NOT UPDATED too finish";
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
            }
        }
        else
        {}
    }
    else
    {
        $returnMessage = "test result NOT inserted....something happened";
        header("location:input_result.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&test=$tests");
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

    $insert = mysqli_query($con,"INSERT INTO clinical_laboratory(patient_name,ref_number,appointment_number,test_type,test_status,date_updated,specimen,test_report,clinician) VALUES('$patientNames','$pat_ref','$appointNum','$testRef','$test_status','$date','$laboratorySpecimen','$laboratoryReport','$clinician')");
    if($insert)
    {
        $returnMessage = "test result inserted successfully";
        $testNumber;
        $check = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointNum'");
        if(mysqli_num_rows($check) >= 1)
        {
            while($result = mysqli_fetch_assoc($check))
            {
                $testNumber = $result['total_test'];
                $today = $result['appointment_date'];
            }
            if(intval($testNumber) >= 1)
            {
                $testNumber = intval($testNumber) - 1 ;
                if(intval($testNumber) == 0)
                {
                    $status = "finish";
                    $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED too finish";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
                else
                {
                    $update = mysqli_query($con,"UPDATE appointments SET total_test='".$testNumber."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
            }
            elseif(intval($testNumber) == 0)
            {
                $status = "finish";
                $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                if($update)
                {
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
                else
                {
                    $returnMessage = "appointment table NOT UPDATED too finish";
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
            }
        }
        else
        {}
    }
    else
    {
        $returnMessage = "test result NOT inserted....something happened";
        header("location:input_result.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&test=$tests");
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

    $insert = mysqli_query($con,"INSERT INTO homonal_assays(patient_name,patient_ref_number,appointment_number,specimen,progesterone,lh,fsh,estradiol,prolactin,testosterone,psa,hbalc,bhcg,clinical_diagnostics,clinician) VALUES('$patientNames','$pat_ref','$appointNum','$homonalSpecimen','$progesterone','$lh','$fsh','$estradio','$prolcatin','$testosterone','$psa','$hbalc','$bhcg','$clinical_diagnostics','$clinician')");
    if($insert)
    {
        $returnMessage = "test result inserted successfully";
        $testNumber;
        $check = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointNum'");
        if(mysqli_num_rows($check) >= 1)
        {
            while($result = mysqli_fetch_assoc($check))
            {
                $testNumber = $result['total_test'];
                $today = $result['appointment_date'];
            }
            if(intval($testNumber) >= 1)
            {
                $testNumber = intval($testNumber) - 1 ;
                if(intval($testNumber) == 0)
                {
                    $status = "finish";
                    $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED too finish";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
                else
                {
                    $update = mysqli_query($con,"UPDATE appointments SET total_test='".$testNumber."' WHERE appointment_no='".$appointNum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
            }
            elseif(intval($testNumber) == 0)
            {
                $status = "finish";
                $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appointNum."' ");
                if($update)
                {
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
                else
                {
                    $returnMessage = "appointment table NOT UPDATED too finish";
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
            }
        }
        else
        {}
    }
    else
    {
        $returnMessage = "test result NOT inserted....something happened";
        header("location:input_result.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&test=$tests");
    }
}

if(isset($_POST["otherSpecimenSample"]))
{
    include 'fabinde.php';

    $patientNames = mysqli_real_escape_string($con,$_POST["patientName"]);
    $pat_ref = mysqli_real_escape_string($con,$_POST["refNumber"]);
    $appnum = mysqli_real_escape_string($con,$_POST["appointmentNumber"]);
    $tests = mysqli_real_escape_string($con,$_POST["testType"]);
    $otherSpecimenSample = mysqli_real_escape_string($con,$_POST["otherSpecimenSample"]);
    $otherResult = mysqli_real_escape_string($con,$_POST["otherResult"]);
    $otherUnitMeasurement = mysqli_real_escape_string($con,$_POST["otherUnitMeasurement"]);
    $otherClinicalDiagnostics = mysqli_real_escape_string($con,$_POST["otherClinicalDiagnostics"]);
    $clinician = $_SESSION["staff_name"];
    $test_status = "updated";
    $date = date('d-m-Y');
    $today = "";

    $insert = mysqli_query($con,"INSERT INTO other_result(patient_name,patient_ref,appointment_number,test_type,test_specimen,test_result,unit_of_measure,clinical_diagnosis,clinician,date_updated) VALUES('$patientNames','$pat_ref','$appnum','$tests','$otherSpecimenSample','$otherResult','$otherUnitMeasurement','$otherClinicalDiagnostics','$clinician','$date')");
    if($insert)
    {
        $returnMessage = "test result inserted successfully";
        $testNumber;
        $check = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appnum'");
        if(mysqli_num_rows($check) >= 1)
        {
            while($result = mysqli_fetch_assoc($check))
            {
                $testNumber = $result['total_test'];
                $today = $result['appointment_date'];
            }
            if(intval($testNumber) >= 1)
            {
                $testNumber = intval($testNumber) - 1 ;
                if(intval($testNumber) == 0)
                {
                    $status = "finish";
                    $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appnum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED too finish";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
                else
                {
                    $update = mysqli_query($con,"UPDATE appointments SET total_test='".$testNumber."' WHERE appointment_no='".$appnum."' ");
                    if($update)
                    {
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                    else
                    {
                        $returnMessage = "appointment table NOT UPDATED";
                        header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                    }
                }
            }
            elseif(intval($testNumber) == 0)
            {
                $status = "finish";
                $update = mysqli_query($con,"UPDATE appointments SET appointment_status='".$status."' WHERE appointment_no='".$appnum."' ");
                if($update)
                {
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
                else
                {
                    $returnMessage = "appointment table NOT UPDATED too finish";
                    header("location:view-appointment.php?ref=$pat_ref&appN=$appointNum&message=$returnMessage&today=$today");
                }
            }
        }
        else
        {}
    }
    else
    {}
}
?>