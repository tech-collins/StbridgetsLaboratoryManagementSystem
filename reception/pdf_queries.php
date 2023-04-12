<?php
require 'fpdf/fpdf.php';

class PDFS extends FPDF
{
function displayHaematologyPdf($testRef,$appointmentNo)
{
    include 'fabinde.php';

    $patientName = "";
    $age = "";
    $gender = "";
    $doctor = "";
    $hospitalName = "";
    $dateAppointment = "";
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
    $indirectCombs = "";
    $testRemarks = "";
    $clinical_diagnostics = "";

    $checkAppointment = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointmentNo' ");
    if(mysqli_num_rows($checkAppointment) >= 1)
    {
        while($result = mysqli_fetch_assoc($checkAppointment))
        {
            $patientName = $result['patient_name'];
            $age = $result['dob'];
            $gender = $result['gender'];
            //$doctor = $result['doctor_name'];
            $hospitalName = $result['hospital_name'];
            $dateAppointment = $result['appointment_date'];
        }
    }
    else
    {}

    $checkTest = mysqli_query($con,"SELECT * FROM haematology WHERE appointment_number='$appointmentNo' AND test_type='$testRef'");
    if(mysqli_num_rows($checkTest))
    {
        while($res = mysqli_fetch_assoc($checkTest))
        {
            $haematologySpecimen = $res['specimen'];
            $pcv = $res['pcv'];
            $hb = $res['hb'];
            $tlc = $res['tlc'];
            $neutrophils = $res['neutrophils'];
            $lymphocytes = $res['lymphocytes'];
            $eosinophils = $res['eosinophils'];
            $monocytes = $res['monocytes'];
            $baseophils = $res['baseophils'];
            $platelets = $res['plateletes'];
            $rbc = $res['rbc'];
            $retics = $res['retics'];
            $mcv =$res['mcv'];
            $mchc =$res['mchc'];
            $mch = $res['mch'];
            $bleedingTime = $res['bleeding_time'];
            $clothing = $res['clothing_time'];
            $protrombin = $res['protrobim'];
            $trombinTime = $res['trombim_time'];
            $pttk = $res['pttk'];
            $leCells = $res['le_cells'];
            $esr = $res['esr'];
            $bloodGroup = $res['blood_group'];
            $hbGenotype = $res['hb_genotype'];
            $malariaParasite = $res['malaria_parasites'];
            $microFilaria = $res['micro_filaria'];
            $directCombs = $res['direct_combs_test'];
            $indirectCombs = $res['indirect_comb_test'];
            $testRemarks = $res['scientist_remarks'];
            $clinical_diagnostics = $res['clinical_diagnostics'];
            $doctor = $res['clinician'];
        }
    }
    else
    {}

//$this = new FPDF('p','mm','A4');
$this->AddPage();
$this->SetFont('Arial','B',14);
$this->Cell(55,10,'',0);
$this->Cell(20,5,'Saint Bridget\'s Diagnostic Service ',0,1);
$this->SetFont('Arial','',10);
$this->Cell(45,10,'',0);
$this->Cell(20,5,'No 4 Iyobosa Street,Off New Lagos Road,Benin City, Edo State.',0,1);
$this->Cell(55,10,'',0);
$this->Cell(20,5,'Tel No: 09155283008, 08051112578, 07030151491',0,1);
$date = date("F j, Y,");
$this->Image('assets/img/stbridget.jpg',10,10,30);
$this->Cell(30,10,'',0,1);
$this->Cell(150);
    $this->Cell(30,10,'Test Result',0,1);
    $this->SetFont('Arial','',10);
    $this->Cell(150);
    $this->Cell(30,10,$date,0,1);
    $this->Cell(150);
    $this->Cell(30,10,'',0,1);
    $this->Cell(55,10,'',0);
    $this->SetTextColor(220,50,50);
    $this->Cell(20,5,'HAEMATOLOGIST TEST RESULT FORM',0,1);
    $this->SetTextColor(0,0,0);
    $this->Cell(30,5,'',0,1);

    $this->Cell(25,6,'FULLNAME',1);
    $this->Cell(167,6,$patientName,1,1);
    $this->Cell(25,6,'AGE',1);
    $this->Cell(20,6,$age,1);
    $this->Cell(15,6,'SEX',1);
    $this->Cell(40,6,$gender,1);
    $this->Cell(45,6,'APPOINTMENT NUMBER',1);
    $this->Cell(47,6,$appointmentNo,1,1);

    $this->Cell(25,6,'CLINICIAN',1);
    $this->Cell(40,6,$doctor,1);
    $this->Cell(24,6,'SPECIMENN',1);
    $this->MultiCell(37,6,$haematologySpecimen,1);
    $this->Cell(30,6,'DATE RECEIVED',1);
    $this->Cell(36,6,$dateAppointment,1,1);

    $this->Cell(40,6,'CLINICAL DIAGNOSES',1);
    $this->MultiCell(152,6,$clinical_diagnostics,1,1);

    $this->Cell(30,5,'',0,1);

    $this->Cell(35,7,'TESTS',1);
    $this->Cell(20,7,'UM',1);
    $this->Cell(20,7,'RESULT',1);
    $this->Cell(20,7,'NA',1);
    $this->Cell(42,7,'TESTS',1);
    $this->Cell(17,7,'UM',1);
    $this->Cell(18,7,'RESULT',1);
    $this->Cell(20,7,'NA',1,1);
    
    $this->Cell(35,7,'PCV',1);
    $this->Cell(20,7,'%',1);
    $this->Cell(20,7,$pcv,1);
    $this->Cell(20,7,'30 - 54',1);
    $this->Cell(42,7,'BLEEDING TIME',1);
    $this->Cell(17,7,'mins',1);
    $this->Cell(18,7,$bleedingTime,1);
    $this->Cell(20,7,'2 - 7',1,1);

    $this->Cell(35,7,'HB',1);
    $this->Cell(20,7,'g/dl',1);
    $this->Cell(20,7,$hb,1);
    $this->Cell(20,7,'12 - 16d/dl',1);
    $this->Cell(42,7,'CLOTTING TIME',1);
    $this->Cell(17,7,'mins',1);
    $this->Cell(18,7,$clothing,1);
    $this->Cell(20,7,'5 - 11',1,1);

    $this->Cell(35,7,'TLC',1);
    $this->Cell(20,7,'X10 9/L',1);
    $this->Cell(20,7,$tlc,1);
    $this->Cell(20,7,'4.1 - 11',1);
    $this->Cell(42,7,'PROTROMBIN TIME',1);
    $this->Cell(17,7,'secs',1);
    $this->Cell(18,7,$protrombin,1);
    $this->Cell(20,7,'10 - 14',1,1);

    $this->Cell(35,7,'NEUTROPHILS',1);
    $this->Cell(20,7,'%',1);
    $this->Cell(20,7,$neutrophils,1);
    $this->Cell(20,7,'40 - 75',1);
    $this->Cell(42,7,'TROMBIN TIME',1);
    $this->Cell(17,7,'secs',1);
    $this->Cell(18,7,$trombinTime,1);
    $this->Cell(20,7,'13 - 15',1,1);

    $this->Cell(35,7,'LYMPHOCYTES',1);
    $this->Cell(20,7,'%',1);
    $this->Cell(20,7,$lymphocytes,1);
    $this->Cell(20,7,'25 - 40',1);
    $this->Cell(42,7,'PTTK',1);
    $this->Cell(17,7,'secs',1);
    $this->Cell(18,7,$pttk,1);
    $this->Cell(20,7,'35 - 43',1,1);

    $this->Cell(35,7,'EOSINOPHILS',1);
    $this->Cell(20,7,'%',1);
    $this->Cell(20,7,$eosinophils,1);
    $this->Cell(20,7,'0 - 7',1);
    $this->Cell(42,7,'LE CELLS',1);
    $this->Cell(17,7,'%',1);
    $this->Cell(18,7,$leCells,1);
    $this->Cell(20,7,'',1,1);

    $this->Cell(35,7,'MONOCYTES',1);
    $this->Cell(20,7,'%',1);
    $this->Cell(20,7,$monocytes,1);
    $this->Cell(20,7,'2 - 20',1);
    $this->Cell(42,7,'ESR',1);
    $this->Cell(17,7,'mm/hr',1);
    $this->Cell(18,7,$esr,1);
    $this->Cell(20,7,'M-3-5,F-4-7',1,1);

    $this->Cell(35,7,'BASEOPHUILS',1);
    $this->Cell(20,7,'%',1);
    $this->Cell(20,7,$baseophils,1);
    $this->Cell(20,7,'0 - 1',1);
    $this->Cell(42,7,'MALARIA PARASITES',1);
    $this->Cell(55,7,$malariaParasite,1,1);
    //$this->Cell(20,7,'',1);
    //$this->Cell(20,7,'',1,1);

    $this->Cell(35,7,'PLATELETS',1);
    $this->Cell(20,7,'X10 9/L',1);
    $this->Cell(20,7,$platelets,1);
    $this->Cell(20,7,'140 - 400',1);
    $this->Cell(42,7,'MICRO-FILARIA',1);
    $this->Cell(55,7,$microFilaria,1,1);
    //$this->Cell(20,7,'',1);
    //$this->Cell(20,7,'',1,1);

    $this->Cell(35,7,'RBC',1);
    $this->Cell(20,7,'X10 12/L',1);
    $this->Cell(20,7,$rbc,1);
    $this->Cell(20,7,'4.8 - 5.5',1);
    $this->Cell(42,7,'DIRECT COMBS TEST',1);
    $this->Cell(55,7,$directCombs,1,1);
    //$this->Cell(20,7,'',1);
    //$this->Cell(20,7,'',1,1);

    $this->Cell(35,7,'RETICS',1);
    $this->Cell(20,7,'%',1);
    $this->Cell(20,7,$retics,1);
    $this->Cell(20,7,'0 - 2',1);
    $this->Cell(42,7,'INDIRECT COMBS TEST',1);
    $this->Cell(55,7,$indirectCombs,1,1);
    //$this->Cell(20,7,'',1);
    //$this->Cell(20,7,'',1,1);

    $this->Cell(35,7,'MCV',1);
    $this->Cell(20,7,'FL',1);
    $this->Cell(20,7,$mcv,1);
    $this->Cell(20,7,'80 - 95',1);
    $this->Cell(42,7,'',1);
    $this->Cell(55,7,'',1,1);
    //$this->Cell(20,7,'',1);
    //$this->Cell(20,7,'',1,1);

    $this->Cell(35,7,'MCHC',1);
    $this->Cell(20,7,'g/dl',1);
    $this->Cell(20,7,$mchc,1);
    $this->Cell(20,7,'30 - 35',1);
    $this->Cell(42,7,'',1);
    $this->Cell(55,7,'',1,1);
    //$this->Cell(20,7,'',1);
    //$this->Cell(20,7,'',1,1);

    $this->Cell(35,7,'MCH',1);
    $this->Cell(20,7,'pg',1);
    $this->Cell(20,7,$mch,1);
    $this->Cell(20,7,'27 - 32',1);
    $this->Cell(42,7,'',1);
    $this->Cell(55,7,'',1,1);
    //$this->Cell(20,7,'',1);
    //$this->Cell(20,7,'',1,1);

    $this->Cell(35,7,'BLOOD GROUP',1);
    $this->Cell(20,7,'',1);
    $this->Cell(20,7,$bloodGroup,1);
    $this->Cell(20,7,'',1);
    $this->Cell(42,7,'',1);
    $this->Cell(55,7,'',1,1);
    //$this->Cell(20,7,'',1);
    //$this->Cell(20,7,'',1,1);

    $this->Cell(35,7,'HB GENOTYPE',1);
    $this->Cell(20,7,'',1);
    $this->Cell(20,7,$hbGenotype,1);
    $this->Cell(20,7,'',1);
    $this->Cell(42,7,'',1);
    $this->Cell(55,7,'',1,1);
    
    $this->Cell(20,7,'FILM COMMENTS',0,1);
    $this->MultiCell(0,5,$testRemarks);
    //$this->Cell(100,7,$testRemarks,0,1);
	$this->Ln();

    //$this->Output();
}

function displayMicrobiologyPdf($testRef,$appointmentNo)
{
    include 'fabinde.php';

    $patientName = "";
    $age = "";
    $gender = "";
    $doctor = "";
    $hospitalName = "";
    $dateAppointment = "";
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

    $checkAppointment = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointmentNo' ");
    if(mysqli_num_rows($checkAppointment) >= 1)
    {
        while($result = mysqli_fetch_assoc($checkAppointment))
        {
            $patientName = $result['patient_name'];
            $age = $result['dob'];
            $gender = $result['gender'];
            //$doctor = $result['doctor_name'];
            $hospitalName = $result['hospital_name'];
            $dateAppointment = $result['appointment_date'];
        }
    }
    else
    {}

    $select = mysqli_query($con, "SELECT * FROM microbiology WHERE test_type='$testRef' AND appointment_number='$appointmentNo'");
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
                            $doctor = $result['clinician'];
                        }
                    } 

    //$this = new FPDF('p','mm','A4');
    $this->AddPage();
    $this->SetFont('Arial','B',14);
    $this->Cell(55,10,'',0);
    $this->Cell(20,5,'Saint Bridget\'s Diagnostic Service ',0,1);
    $this->SetFont('Arial','',10);
    $this->Cell(45,10,'',0);
    $this->Cell(20,5,'No 4 Iyobosa Street,Off New Lagos Road,Benin City, Edo State.',0,1);
    $this->Cell(55,10,'',0);
    $this->Cell(20,5,'Tel No: 09155283008, 08051112578, 07030151491',0,1);
    $date = date("F j, Y,");
    $this->Image('assets/img/stbridget.jpg',10,10,30);
    $this->Cell(30,10,'',0,1);
    $this->Cell(150);
        $this->Cell(30,10,'Test Result',0,1);
        $this->SetFont('Arial','',10);
        $this->Cell(150);
        $this->Cell(30,10,$date,0,1);
        $this->Cell(150);
        $this->Cell(30,10,'',0,1);
        $this->Cell(55,10,'',0);
        $this->SetTextColor(220,50,50);
        $this->Cell(20,5,'MICROBIOLOGY TEST RESULT FORM',0,1);
        $this->SetTextColor(0,0,0);
        $this->Cell(30,5,'',0,1);
    
        $this->Cell(25,6,'FULLNAME',1);
        $this->Cell(167,6,$patientName,1,1);
        $this->Cell(25,6,'AGE',1);
        $this->Cell(20,6,$age,1);
        $this->Cell(15,6,'SEX',1);
        $this->Cell(40,6,$gender,1);
        $this->Cell(45,6,'APPOINTMENT NUMBER',1);
        $this->Cell(47,6,$appointmentNo,1,1);
    
        $this->Cell(25,6,'CLINICIAN',1);
        $this->Cell(40,6,$doctor,1);
        $this->Cell(24,6,'SPECIMENN',1);
        $this->MultiCell(37,6,$microBiologySpecimen,1);
        $this->Cell(30,6,'DATE RECEIVED',1);
        $this->Cell(36,6,$dateAppointment,1,1);
    
        $this->Cell(30,2,'',0,1);
        $this->Cell(90,10,'',0);
        $this->Cell(20,5,'URINE',0,1);

        $this->Cell(30,6,'PH',1);
        $this->Cell(66,6,$urinePhValue,1);
        $this->Cell(30,6,'SP.Gr.',1);
        $this->Cell(66,6,$spgr ,1,1);

        $this->Cell(30,6,'Bilirubin',1);
        $this->Cell(66,6,$bilirubin,1);
        $this->Cell(30,6,'Protein',1);
        $this->Cell(66,6,$protein,1,1);

        $this->Cell(30,6,'Urobilinogen',1);
        $this->Cell(66,6,$urobilinogen,1);
        $this->Cell(30,6,'Glucose',1);
        $this->Cell(66,6,$glucose,1,1);

        $this->Cell(30,6,'Nitrites',1);
        $this->Cell(66,6,$nitrites,1);
        $this->Cell(30,6,'Ketones',1);
        $this->Cell(66,6,$ketone,1,1);

        $this->Cell(30,6,'Leucocytes',1);
        $this->Cell(66,6,$leucocytes,1);
        $this->Cell(30,6,'Appearance',1);
        $this->Cell(66,6,$appearance,1,1);

        $this->Cell(30,6,'Blood',1);
        $this->Cell(66,6,$blood,1);
        $this->Cell(30,6,'Microscopy',1);
        $this->Cell(66,6,$microscopy,1,1);

        $this->Cell(30,2,'',0,1);
        $this->Cell(85,10,'',0);
        $this->Cell(20,5,'WIDAL TEST',0,1);

        $this->Cell(60,6,"Salmonella Organisms",1);
        $this->Cell(66,6,' AntiBody Titre - "H" ',1);
        $this->Cell(66,6,' AntiBody Titre - "O"',1,1);

        $this->Cell(60,6,"SAL. TYPH",1);
        $this->Cell(66,6,'d: '.$saltyphd,1);
        $this->Cell(66,6,'D: '.$saltyphDs,1,1);

        $this->Cell(60,6,"SAL. PARATYPHI",1);
        $this->Cell(66,6,'a: '.$salparatypha,1);
        $this->Cell(66,6,'A: '.$salparatyphAs,1,1);

        $this->Cell(60,6,"SAL. PARATYPHI",1);
        $this->Cell(66,6,'b: '.$salparatyphb,1);
        $this->Cell(66,6,'B: '.$salparatyphBs,1,1);

        $this->Cell(60,6,"SAL. PARATYPHI",1);
        $this->Cell(66,6,'c: '.$salparatyphc,1);
        $this->Cell(66,6,'C: '.$salparatyphCs,1,1);

        $this->Cell(25,6,'Comment',1);
        $this->MultiCell(167,6,$testRemarks,1,1);

        $this->Cell(30,2,'',0,1);

        $this->Cell(30,6,'MACROSPCOPY:',0,1);
        $this->Cell(162,10,$macroscopy,0,1);

        $this->Cell(30,6,'MICROSCOPY:',0,1);
        $this->Cell(162,10,$microscopy_other,0,1);

        $this->Cell(40,6,'CULTURE/SEROLOGY:',0,1);
        $this->MultiCell(152,5,$cultureAndSerology,0,1);

        $this->Cell(152,30,'',0,1);

        $this->Cell(40,6,'Medical Lab Scientist',0,1);


        //$this->Output();
}

function displayChemistryPdf($testRef,$appointmentNo)
{
    include 'fabinde.php';

    $patientName = "";
    $age = "";
    $gender = "";
    $doctor = "";
    $hospitalName = "";
    $dateAppointment = "";
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
    $protein = "";
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

    $checkAppointment = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointmentNo' ");
    if(mysqli_num_rows($checkAppointment) >= 1)
    {
        while($result = mysqli_fetch_assoc($checkAppointment))
        {
            $patientName = $result['patient_name'];
            $age = $result['dob'];
            $gender = $result['gender'];
            //$doctor = $result['doctor_name'];
            $hospitalName = $result['hospital_name'];
            $dateAppointment = $result['appointment_date'];
        }
    }
    else
    {}

    $getResult = mysqli_query($con, "SELECT * FROM clinical_chemistry WHERE test_type='$testRef' AND appointment_number='$appointmentNo'");
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
            $doctor = $feeds['clinician'];
        }
    }
    else
    {}



    //$this = new FPDF('p','mm','A4');
    $this->AddPage();
    $this->SetFont('Arial','B',14);
    $this->Cell(55,10,'',0);
    $this->Cell(20,5,'Saint Bridget\'s Diagnostic Service ',0,1);
    $this->SetFont('Arial','',10);
    $this->Cell(45,10,'',0);
    $this->Cell(20,5,'No 4 Iyobosa Street,Off New Lagos Road,Benin City, Edo State.',0,1);
    $this->Cell(55,10,'',0);
    $this->Cell(20,5,'Tel No: 09155283008, 08051112578, 07030151491',0,1);
    $date = date("F j, Y,");
    $this->Image('assets/img/stbridget.jpg',10,10,30);
    $this->Cell(30,10,'',0,1);
    $this->Cell(150);
        $this->Cell(30,7,'Test Result',0,1);
        $this->SetFont('Arial','',9);
        $this->Cell(150);
        $this->Cell(30,7,$date,0,1);
        $this->Cell(30,2,'',0,1);
        $this->Cell(55,10,'',0);
        $this->SetTextColor(220,50,50);
        $this->Cell(20,5,'CLINICAL CHEMISTRY TEST RESULT FORM',0,1);
        $this->SetTextColor(0,0,0);
        $this->Cell(30,2,'',0,1);
    
        $this->Cell(25,5,'FULLNAME',1);
        $this->Cell(167,5,$patientName,1,1);
        $this->Cell(25,5,'AGE',1);
        $this->Cell(20,5,$age,1);
        $this->Cell(15,5,'SEX',1);
        $this->Cell(40,5,$gender,1);
        $this->Cell(45,5,'APPOINTMENT NUMBER',1);
        $this->Cell(47,5,$appointmentNo,1,1);

        $this->Cell(30,5,'DOCTOR SIGN',1);
        $this->Cell(35,5,'',1);
        $this->Cell(24,5,'SPECIMEN',1);
        $this->Cell(37,5,$chemistrySpecimen,1);
        $this->Cell(35,5,'DATE OF REQUEST',1);
        $this->Cell(31,5,$dateAppointment,1,1);
        $this->Cell(40,5,'CLINICAL DIAGNOSES',1);
        $this->MultiCell(152,5,$testComment,1,1);

        $this->Cell(50,6,'PARAMETERS',1);
        $this->Cell(45,6,'RESULTS',1);
        $this->Cell(97,6,'NORMAL VALUES (S.I UNITS)',1,1);

        $this->Cell(50,5,'Bicarbonate',1);
        $this->Cell(45,5,$bicarbonate,1);
        $this->Cell(97,5,'21 - 28 mmol/l',1,1);

        $this->Cell(50,5,'Chloride',1);
        $this->Cell(45,5,$chloride,1);
        $this->Cell(97,5,'95 - 110 mmol/l',1,1);

        $this->Cell(50,5,'Sodium',1);
        $this->Cell(45,5,$sodium,1);
        $this->Cell(97,5,'135 - 145 mmol/l',1,1);

        $this->Cell(50,5,'Potassium',1);
        $this->Cell(45,5,$potassium,1);
        $this->Cell(97,5,'3.5 - 5.5 mmol/l',1,1);

        $this->Cell(50,5,'SGPT',1);
        $this->Cell(45,5,$sgpt,1);
        $this->Cell(97,5,'0 - 40 u/l',1,1);

        $this->Cell(50,5,'SGOT',1);
        $this->Cell(45,5,$sgot,1);
        $this->Cell(97,5,'0 - 40 u/l',1,1);

        $this->Cell(50,5,'Alkaline Phosphatase',1);
        $this->Cell(45,5,$alkalinePhosphatase,1);
        $this->Cell(97,5,'50-250 u/l(adult) 150-600 u/l(Neonate)',1,1);

        $this->Cell(50,5,'Amylase',1);
        $this->Cell(45,5,$amylase,1);
        $this->Cell(97,5,'22 - 100 u/l',1,1);

        $this->Cell(50,5,'Acid Phosphatase (Total)',1);
        $this->Cell(45,5,$acidphosphataseTotal,1);
        $this->Cell(97,5,'up to 11.0 u/l (37 celsius)',1,1);

        $this->Cell(50,5,'Acid Phosphatase (prostatic)',1);
        $this->Cell(45,5,$acidphosphataseProtactic,1);
        $this->Cell(97,5,'up to 4. u/l (37 celsius)',1,1);

        $this->Cell(50,5,'Uric Acid',1);
        $this->Cell(45,5,$uricAcid,1);
        $this->Cell(97,5,'142 - 416 umol/l',1,1);

        $this->Cell(50,5,'Cholesterol',1);
        $this->Cell(45,5,$cholesterol,1);
        $this->Cell(97,5,'3.89 - 6.48',1,1);

        $this->Cell(50,5,'Albumin',1);
        $this->Cell(45,5,$albumin,1);
        $this->Cell(97,5,'34 - 52 gm/l',1,1);

        $this->Cell(50,5,'Protein',1);
        $this->Cell(45,5,$protein,1);
        $this->Cell(97,5,'66 - 88 gm/l',1,1);

        $this->Cell(50,5,'Bilirubin Total',1);
        $this->Cell(45,5,$bilirubinTotal,1);
        $this->Cell(97,5,'0 - 17 umol/l',1,1);

        $this->Cell(50,5,'Bilirubin Direct',1);
        $this->Cell(45,5,$bilirubinDirect,1);
        $this->Cell(97,5,'0 - 4.3 umol/l',1,1);

        $this->Cell(50,5,'Urea',1);
        $this->Cell(45,5,$urea,1);
        $this->Cell(97,5,'1.66 - 9.1 mmol/l',1,1);

        $this->Cell(50,5,'Triglyceride',1);
        $this->Cell(45,5,$tryglyceride,1);
        $this->Cell(97,5,'0.52 - 1.95 mmol/l',1,1);

        $this->Cell(50,5,'GGT',1);
        $this->Cell(45,5,$ggt,1);
        $this->Cell(97,5,'up to 450 u/l',1,1);

        $this->Cell(50,5,'LDL',1);
        $this->Cell(45,5,$ldl,1);
        $this->Cell(97,5,'<4.0 mmol/l',1,1);

        $this->Cell(50,5,'HDL Cholesterol',1);
        $this->Cell(45,5,$hdlCholesterol,1);
        $this->Cell(97,5,'Men= 0.91 - 1.43 mmol/l, Women=1.17 - 1.69 mmol/l',1,1);

        $this->Cell(50,5,'Creatanine',1);
        $this->Cell(45,5,$creatinine,1);
        $this->Cell(97,5,'44 - 106 umol/l',1,1);

        $this->Cell(50,5,'Inorganic Phosphorous',1);
        $this->Cell(45,5,$inorganicPhosphorous,1);
        $this->Cell(97,5,'Adult= 0.81 - 1.45 umol/l, Children= 1.20 - 2.26 umol/l',1,1);

        $this->Cell(50,5,'Iron',1);
        $this->Cell(45,5,$iron,1);
        $this->Cell(97,5,'Men= 10.6 - 28.3, Women=6.6 - 26.0umol/l (37 - 145mg%)',1,1);

        $this->Cell(50,5,'Calcium',1);
        $this->Cell(45,5,$calcium,1);
        $this->Cell(97,5,'2.02 - 2.60 mmol/l',1,1);

        $this->Cell(50,5,'CK',1);
        $this->Cell(45,5,$ck,1);
        $this->Cell(97,5,'Men= 0 - 270 u/l, Women= 0 - 150 u/l',1,1);

        $this->Cell(50,5,'Blood Sugar (Fasting)',1);
        $this->Cell(45,5,$bloodSugarFasting,1);
        $this->Cell(97,5,'3.35 - 5.75 mmol/l',1,1);

        $this->Cell(50,5,'Blood Sugar (Random)',1);
        $this->Cell(45,5,$bloodSugarRandom,1);
        $this->Cell(97,5,'up to 9.44 mmol/l',1,1);

        $this->Cell(50,5,'HbAlc (Non Diabetics)',1);
        $this->Cell(45,5,$hbAlcNonDiabetic,1);
        $this->Cell(97,5,'6.0 - 8.3 %',1,1);

        $this->Cell(50,5,'(Uncontrolled Diabetics)',1);
        $this->Cell(45,5,$hbAlcUncontrolledDiabetic,1);
        $this->Cell(97,5,'>10.0 %',1,1);

        $this->Cell(25,5,'',0);

        $this->Cell(20,5,'GTT(mmol/L)');

        $this->Cell(80,5,'',0);

        $this->Cell(20,5,'URINE',0,1);

        //gtt table headers

        $this->Cell(12,5,'Mg/d1',1);
        $this->Cell(12,5,'Fasting',1);
        $this->Cell(9,5,'1/2hr',1);
        $this->Cell(9,5,'1 hr',1);
        $this->Cell(15,5,'1 & 1/2hr',1);
        $this->Cell(9,5,'2 hr',1);
        $this->Cell(15,5,'2 & 1/2 hr',1);

        $this->Cell(18,5,'',0);

        //urine parameters values
        $this->Cell(17,5,'pH',1);  
        $this->Cell(12,5,$urinePh,1); 
        $this->Cell(19,5,'SR. Gr',1); 
        $this->Cell(12,5,$urineSrGr,1);  
        $this->Cell(18,5,'Protein',1);
        $this->Cell(12,5,$urineProtein,1,1);  

        //first gtt values
        $this->Cell(12,5,'Blood',1);
        $this->Cell(12,5,$bloodfast,1);
        $this->Cell(9,5,$bloodhalfHour,1);
        $this->Cell(9,5,$bloodOneHour,1);
        $this->Cell(15,5,$bloodOneAndHalfHour,1);
        $this->Cell(9,5,$bloodTwoHour,1);
        $this->Cell(15,5,$bloodTwoAndHalfHour,1);

        $this->Cell(18,5,'',0);

        //second urine parameters values
        $this->Cell(17,5,'Nitrite',1);  
        $this->Cell(12,5,$urineNitrite,1); 
        $this->Cell(19,5,'Glucose',1); 
        $this->Cell(12,5,$urineGlucose,1);  
        $this->Cell(18,5,'Ketones',1);
        $this->Cell(12,5,$urineKetones,1,1);

        //second gtt values
        $this->Cell(12,5,'Urine',1);
        $this->Cell(12,5,$urineFast,1);
        $this->Cell(9,5,$urineHalfHour,1);
        $this->Cell(9,5,$urineOneHour,1);
        $this->Cell(15,5,$urineOneAndHalfHour,1);
        $this->Cell(9,5,$urineTwoHour,1);
        $this->Cell(15,5,$urineTwoAndHalfHour,1);

        $this->Cell(18,5,'',0);

        //third urine parameters values
        $this->Cell(17,5,'Bilirubin',1);  
        $this->Cell(12,5,$urineBilirubin,1); 
        $this->Cell(19,5,'Urobilinogen',1); 
        $this->Cell(12,5,$urineUrobilnogen,1);  
        $this->Cell(18,5,'Leucocytes',1);
        $this->Cell(12,5,$urineLeucocytes,1,1);

        //csf and result header

        $this->Cell(41,5,'CSF',1);
        $this->Cell(40,5,'RESULT',1);

        $this->Cell(18,5,'',0);

        //fourth urine parameters values

        $this->Cell(17,5,'Blood',1);  
        $this->Cell(12,5,$urineBlood,1); 
        $this->Cell(19,5,'Appearance',1); 
        $this->Cell(12,5,$urineAppearance,1);  
        $this->Cell(18,5,'Microscopy',1);
        $this->Cell(12,5,$urineMicroscop,1,1);

        //csf and result values

        $this->Cell(41,5,'Glucose(45-85) mmol/l',1);
        $this->Cell(40,5,$csfGlucose,1,1);
        $this->Cell(52,5,'Protein Total(15-45),(10-45) mmol/l',1);
        $this->Cell(29,5,$csfProtein,1,1);
        $this->Cell(29,2,'',0,1);

        //$this->Output();
}

function displaySemenPdf($testRef,$appointmentNo)
{
    include 'fabinde.php';

    $patientName = "";
    $age = "";
    $gender = "";
    $doctor = "";
    $hospitalName = "";
    $dateAppointment = "";
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
    $clinician = "";
    $clinical_diagnostics = "";

    $checkAppointment = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointmentNo' ");
    if(mysqli_num_rows($checkAppointment) >= 1)
    {
        while($result = mysqli_fetch_assoc($checkAppointment))
        {
            $patientName = $result['patient_name'];
            $age = $result['dob'];
            $gender = $result['gender'];
            $doctor = $result['doctor_name'];
            $hospitalName = $result['hospital_name'];
            $dateAppointment = $result['appointment_date'];
        }
    }
    else
    {}

    $select = mysqli_query($con, "SELECT * FROM semen_analysis WHERE test_type='$testRef' AND appointment_number='$appointmentNo'");
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
            $clinician = $result['clinician'];
            $clinical_diagnostics = $result['clinical_diagnostics'];
        }
    }
    else
    {}

    //$this = new FPDF('p','mm','A4');
    $this->AddPage();
    $this->SetFont('Arial','B',14);
    $this->Cell(55,10,'',0);
    $this->Cell(20,5,'Saint Bridget\'s Diagnostic Service ',0,1);
    $this->SetFont('Arial','',10);
    $this->Cell(45,10,'',0);
    $this->Cell(20,5,'No 4 Iyobosa Street,Off New Lagos Road,Benin City, Edo State.',0,1);
    $this->Cell(55,10,'',0);
    $this->Cell(20,5,'Tel No: 09155283008, 08051112578, 07030151491',0,1);
    $date = date("F j, Y,");
    $this->Image('assets/img/stbridget.jpg',10,10,30);
    $this->Cell(30,10,'',0,1);
    $this->Cell(150);
        $this->Cell(30,7,'Test Result',0,1);
        $this->SetFont('Arial','',9);
        $this->Cell(150);
        $this->Cell(30,7,$date,0,1);
        $this->Cell(30,2,'',0,1);
        $this->Cell(55,10,'',0);
        $this->SetTextColor(220,50,50);
        $this->Cell(20,5,'SEMEN ANALYSIS REPORT FORM',0,1);
        $this->SetTextColor(0,0,0);
        $this->Cell(30,2,'',0,1);
    
        $this->Cell(25,5,'FULLNAME',1);
        $this->Cell(167,5,$patientName,1,1);
        $this->Cell(25,5,'AGE',1);
        $this->Cell(20,5,$age,1);
        $this->Cell(15,5,'SEX',1);
        $this->Cell(40,5,$gender,1);
        $this->Cell(45,5,'APPOINTMENT NUMBER',1);
        $this->Cell(47,5,$appointmentNo,1,1);

        $this->Cell(35,5,'CLINICIAN i/c CASE',1);
        $this->Cell(35,5,$clinician,1);
        $this->Cell(40,5,'CLINICAL DIAGNOSES',1);
        $this->MultiCell(82,5,$clinical_diagnostics,1,1);

        $this->Cell(82,2,'',0,1);

        $this->Cell(96,6,'PARAMETERS',1);
        $this->Cell(96,6,'RESULTS',1,1);

        $this->Cell(96,6,'Date Of Sample',1);
        $this->Cell(96,6,$dateOfSample,1,1);

        $this->Cell(96,6,'Duration Of Abstenance',1);
        $this->Cell(96,6,$abstenaceDuration,1,1);

        $this->Cell(96,6,'Interval Between Ejaculation and start of Analysis(Mins)',1);
        $this->Cell(96,6,$ejaculationInterval,1,1);

        $this->Cell(96,6,'Appearance',1);
        $this->Cell(96,6,$appearance,1,1);

        $this->Cell(96,6,'Liquefaction',1);
        $this->Cell(96,6,$liquefaction,1,1);

        $this->Cell(96,6,'Consistency',1);
        $this->Cell(96,6,$consistency,1,1);

        $this->Cell(96,6,'Volume (nl)',1);
        $this->Cell(96,6,$volume,1,1);

        $this->Cell(96,6,'pH',1);
        $this->Cell(96,6,$semenPH,1,1);

        $this->Cell(96,6,'Motility (100 Spermatozoa)',0,1);

        $this->Cell(96,6,'Rapid Linear Progression',1);
        $this->Cell(96,6,$rapidLinearProgression,1,1);

        $this->Cell(96,6,'Non-Linear Progression',1);
        $this->Cell(96,6,$nonLinearProgression,1,1);

        $this->Cell(96,6,'Non-Progressive Motility',1);
        $this->Cell(96,6,$nonLinearProgressionMotility,1,1);

        $this->Cell(96,6,'Immotile',1);
        $this->Cell(96,6,$immotile,1,1);

        $this->Cell(96,6,'Viability (% live)',1,1);
        $this->Cell(96,6,$viability,1,1);

        $this->Cell(96,6,'Concentration (Sperm Count) 10 Spermatozoa lml',1);
        $this->Cell(48,6,$concentrationSpermCount,1);
        $this->Cell(48,6,$spermatozoalml,1,1);

        $this->Cell(96,6,'Morphology - Head',0,1);

        $this->Cell(48,6,'% Normal',1);
        $this->Cell(48,6,$percentageNormalHeadMorphology,1);
        $this->Cell(48,6,'% Large Oval',1);
        $this->Cell(48,6,$percentageLargeOvalHeadMophology,1,1);

        $this->Cell(48,6,'% Pyriform',1);
        $this->Cell(48,6,$percentagePyriformHeadMorphology,1);
        $this->Cell(48,6,'Tapering',1);
        $this->Cell(48,6,$percenatgeTaperingHeadMorphology,1,1);

        $this->Cell(48,6,'% Amorphous',1);
        $this->Cell(48,6,$percenatgeAmorphousHeadMorphology,1);
        $this->Cell(48,6,'% Double',1);
        $this->Cell(48,6,$percenatgeDoubleHeadMorphology,1,1);

        $this->Cell(48,6,'% Pin',1);
        $this->Cell(48,6,$percenatgePinHeadMorphology,1);
        $this->Cell(48,6,'% Round',1);
        $this->Cell(48,6,$percenatgeRoundHeadMorphology,1,1);

        $this->Cell(96,6,'Morphology - Middlepiece (neck)',0,1);

        $this->Cell(32,6,'% Normal',1);
        $this->Cell(32,6,$percentageNormalMidpieceMorphology,1);
        $this->Cell(32,6,'% Abnormal',1);
        $this->Cell(32,6,$percentageAbnormalMidpieceMorphology,1);
        $this->Cell(34,6,'% Cytoplasmic Droplet',1);
        $this->Cell(30,6,$percentageCytoplasmicMidpieceMorphology,1,1);

        $this->Cell(96,6,'Morphology - Tail',0,1);

        $this->Cell(96,6,'% Normal',1);
        $this->Cell(96,6,$percentageNormalTailMorphology,1,1);

        $this->Cell(96,6,'% Abnormal',1);
        $this->Cell(96,6,$percentageAbnormalTailMorphology,1,1);

        $this->Cell(48,6,'Aglutination',1);
        $this->Cell(48,6,$agglutination,1);
        $this->Cell(48,6,'If Yes',1);
        $this->Cell(48,6,$yesAgglutination,1,1);

        $this->Cell(96,6,'Microscopy',1);
        $this->Cell(96,6,$microscopy,1,1);

        $this->Cell(48,6,'COMMENT',0,1);
        $this->MultiCell(48,6,$comment);

        //$this->Output();
}

function displayLaboratoryPdf($testRef,$appointmentNo)
{
    include 'fabinde.php';

    $patientName = "";
    $age = "";
    $gender = "";
    $doctor = "";
    $hospitalName = "";
    $dateAppointment = "";
    $laboratorySpecimen = "";
    $laboratoryReport = "";

    $checkAppointment = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$appointmentNo' ");
    if(mysqli_num_rows($checkAppointment) >= 1)
    {
        while($result = mysqli_fetch_assoc($checkAppointment))
        {
            $patientName = $result['patient_name'];
            $age = $result['dob'];
            $gender = $result['gender'];
            $doctor = $result['doctor_name'];
            $hospitalName = $result['hospital_name'];
            $dateAppointment = $result['appointment_date'];
        }
    }
    else
    {}

    $select = mysqli_query($con,"SELECT * FROM clinical_laboratory WHERE test_type='$testRef' AND appointment_number='$appointmentNo' ");
    if(mysqli_num_rows($select) >= 1)
    {
        while($res = mysqli_fetch_assoc($select))
        {
            $laboratorySpecimen = $res['specimen'];
            $laboratoryReport = $res['test_report'];
        }
    }
    else
    {}

    //$this = new FPDF('p','mm','A4');
    $this->AddPage();
    $this->SetFont('Arial','B',14);
    $this->Cell(55,10,'',0);
    $this->Cell(20,5,'Saint Bridget\'s Diagnostic Service ',0,1);
    $this->SetFont('Arial','',10);
    $this->Cell(45,10,'',0);
    $this->Cell(20,5,'No 4 Iyobosa Street,Off New Lagos Road,Benin City, Edo State.',0,1);
    $this->Cell(55,10,'',0);
    $this->Cell(20,5,'Tel No: 09155283008, 08051112578, 07030151491',0,1);
    $date = date("F j, Y,");
    $this->Image('assets/img/stbridget.jpg',10,10,30);
    $this->Cell(30,10,'',0,1);
    $this->Cell(150);
        $this->Cell(30,7,'Test Result',0,1);
        $this->SetFont('Arial','',9);
        $this->Cell(150);
        $this->Cell(30,7,$date,0,1);
        $this->Cell(30,2,'',0,1);
        $this->Cell(55,10,'',0);
        $this->SetTextColor(220,50,50);
        $this->Cell(20,5,'CLINICAL LABORATORIES REPORT',0,1);
        $this->SetTextColor(0,0,0);
        $this->Cell(30,2,'',0,1);
    
        $this->Cell(25,5,'FULLNAME',1);
        $this->Cell(167,5,$patientName,1,1);
        $this->Cell(25,5,'AGE',1);
        $this->Cell(20,5,$age,1);
        $this->Cell(15,5,'SEX',1);
        $this->Cell(40,5,$gender,1);
        $this->Cell(45,5,'APPOINTMENT NUMBER',1);
        $this->Cell(47,5,$appointmentNo,1,1);

        $this->Cell(35,5,'CLINICIAN i/c CASE',1);
        $this->Cell(157,5,$doctor,1,1);
        $this->Cell(35,5,'CLINIC/HOSPITAL',1);
        $this->Cell(157,5,$hospitalName,1,1);

        $this->Cell(17,5,'',0,1);

        $this->Cell(36,5,'SPECIMEN RECEIVED');
        $this->Cell(156,10,$laboratorySpecimen,1,1);

        $this->Cell(17,5,'',0,1);

        $this->Cell(30,5,'RESULT:',0,1);
        $this->MultiCell(30,5,$laboratoryReport,0,1);

        $this->Cell(30,20,'',0,1);

        $this->Cell(30,5,'DATE RECEIVED:');

        $this->Cell(45,5,'');

        $this->Cell(30,5,'SCIENTIEST SIGNATURE');

        $this->Cell(50,5,'');

        $this->Cell(30,5,'DATE REPORTED',0,1);

        //$this->Output();
}
}

?>