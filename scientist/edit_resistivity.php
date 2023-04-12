<?php
session_start();
include 'login_check.php';
include 'fabinde.php';
include 'test_dictionary.php';

$insert_status = "";

?>

<!DOCTYPE html>
<html lang="en">


<!-- add-patient24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>St Bridget - Laboratory Management System</title>
    <link rel="stylesheet" href="stackpath/bootstrap.min.css">
    <link rel="stylesheet" href="stackpath/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper" style="background-color: rgb(240, 234, 214);">
        <?php
        include 'header.php';
        include 'side-bar.php';
        ?>
        <div class="page-wrapper">
            <div class="content" style=" box-shadow: 0 1px 2px rgba(0,0,0,0.07), 
                0 2px 4px rgba(0,0,0,0.07), 
                0 4px 8px rgba(0,0,0,0.07), 
                0 8px 16px rgba(0,0,0,0.07),
                0 16px 32px rgba(0,0,0,0.07), 
                0 32px 64px rgba(0,0,0,0.07);">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Enter Resistivity Result</h4>
                    </div>
                    <div style="align-content: center;"><?php echo $insert_status; ?></div>
                </div>
                <?php
                if(isset($_GET["appN"]))
                { 
                    $patientNames = mysqli_real_escape_string($con,$_GET["patientName"]);
                    $pat_ref = mysqli_real_escape_string($con,$_GET["ref"]);
                    $appointNum = mysqli_real_escape_string($con,$_GET["appN"]);
                    $today = mysqli_real_escape_string($con,$_GET["today"]);

                    $penicillinOne = "";
                    $penicillinTwo = "";
                    $penicillinThree = "";
                    $penicillinFour = "";
                    $amicillinOne = "";
                    $amicillinTwo = "";
                    $amicillinThree = "";
                    $amicillinFour = "";
                    $streptomycinOne = "";
                    $streptomycinTwo = "";
                    $streptomycinThree = "";
                    $streptomycinFour = "";
                    $chlorampenicolOne = "";
                    $chlorampenicolTwo = "";
                    $chlorampenicolThree = "";
                    $chlorampenicolFour = "";
                    $tetracyclineOne = "";
                    $tetracyclineTwo = "";
                    $tetracyclineThree = "";
                    $tetracyclineFour = "";
                    $erythtomycineOne = "";
                    $erythtomycineTwo = "";
                    $erythtomycineThree = "";
                    $erythtomycineFour = "";
                    $septrinOne = "";
                    $septrinTwo = "";
                    $septrinThree = "";
                    $septrinFour = "";
                    $cloxacillinOne = "";
                    $cloxacillinTwo = "";
                    $cloxacillinThree = "";
                    $cloxacillinFour = "";
                    $contrimoxazoleOne = "";
                    $contrimoxazoleTwo = "";
                    $contrimoxazoleThree = "";
                    $contrimoxazoleFour = "";
                    $furadantineOne = "";
                    $furadantineTwo = "";
                    $furadantineThree = "";
                    $furadantineFour = "";
                    $nalidixicAcidOne = "";
                    $nalidixicAcidTwo = "";
                    $nalidixicAcidThree = "";
                    $nalidixicAcidFour = "";
                    $colistinSulphateOne = "";
                    $colistinSulphateTwo = "";
                    $colistinSulphateThree = "";
                    $colistinSulphateFour = "";
                    $genticinOne = "";
                    $genticinTwo = "";
                    $genticinThree = "";
                    $genticinFour = "";
                    $arithromycineOne = "";
                    $arithromycineTwo = "";
                    $arithromycineThree = "";
                    $arithromycineFour = "";
                    $ceftazidimeOne = "";
                    $ceftazidimeTwo = "";
                    $ceftazidimeThree = "";
                    $ceftazidimeFour = "";
                    $ciprofloxacinOne = "";
                    $ciprofloxacinTwo = "";
                    $ciprofloxacinThree = "";
                    $ciprofloxacinFour = "";
                    $ofloxacintarvidOne = "";
                    $ofloxacintarvidTwo = "";
                    $ofloxacintarvidThree = "";
                    $ofloxacintarvidFour = "";
                    $ceftriaoxoneOne = "";
                    $ceftriaoxoneTwo = "";
                    $ceftriaoxoneThree = "";
                    $ceftriaoxoneFour = "";
                    $zinnatOne = "";
                    $zinnatOne = "";
                    $zinnatOne = "";
                    $zinnatOne = "";
                    $rocephineOne = "";
                    $rocephineTwo = "";
                    $rocephineThree = "";
                    $rocephineFour = "";
                    $unasymOne = "";
                    $unasymTwo = "";
                    $unasymThree = "";
                    $unasymFour = "";

                    $search = mysqli_query($con,"SELECT * FROM resistivity WHERE appointment_number='$appointNum' ");
                    if(mysqli_num_rows($search) >= 1)
                    {
                        while($res = mysqli_fetch_assoc($search))
                        {
                            $penicillinOne = $res['penicillinOne'];
                            $penicillinTwo = $res['penicillinTwo'];
                            $penicillinThree = $res['penicillinThree'];
                            $penicillinFour = $res['penicillinFour'];
                            $amicillinOne = $res['amicillinOne'];
                            $amicillinTwo = $res['amicillinTwo'];
                            $amicillinThree = $res['amicillinThree'];
                            $amicillinFour = $res['amicillinFour'];
                            $streptomycinOne = $res['streptomycinOne'];
                            $streptomycinTwo = $res['streptomycinTwo'];
                            $streptomycinThree = $res['streptomycinThree'];
                            $streptomycinFour = $res['streptomycinFour'];
                            $chlorampenicolOne = $res['chlorampenicolOne'];
                            $chlorampenicolTwo = $res['chlorampenicolTwo'];
                            $chlorampenicolThree = $res['chlorampenicolThree'];
                            $chlorampenicolFour = $res['chlorampenicolFour'];
                            $tetracyclineOne = $res['tetracyclineOne'];
                            $tetracyclineTwo = $res['tetracyclineTwo'];
                            $tetracyclineThree = $res['tetracyclineThree'];
                            $tetracyclineFour = $res['tetracyclineFour'];
                            $erythtomycineOne = $res['erythtomycineOne'];
                            $erythtomycineTwo = $res['erythtomycineTwo'];
                            $erythtomycineThree = $res['erythtomycineThree'];
                            $erythtomycineFour = $res['erythtomycineFour'];
                            $septrinOne = $res['septrinOne'];
                            $septrinTwo = $res['septrinTwo'];
                            $septrinThree = $res['septrinThree'];
                            $septrinFour = $res['septrinFour'];
                            $cloxacillinOne = $res['cloxacillinOne'];
                            $cloxacillinTwo = $res['cloxacillinTwo'];
                            $cloxacillinThree = $res['cloxacillinThree'];
                            $cloxacillinFour = $res['cloxacillinFour'];
                            $contrimoxazoleOne = $res['contrimoxazoleOne'];
                            $contrimoxazoleTwo = $res['contrimoxazoleTwo'];
                            $contrimoxazoleThree = $res['contrimoxazoleThree'];
                            $contrimoxazoleFour = $res['contrimoxazoleFour'];
                            $furadantineOne = $res['furadantineOne'];
                            $furadantineTwo = $res['furadantineTwo'];
                            $furadantineThree = $res['furadantineThree'];
                            $furadantineFour =$res['furadantineFour'];
                            $nalidixicAcidOne = $res['nalidixicAcidOne'];
                            $nalidixicAcidTwo = $res['nalidixicAcidTwo'];
                            $nalidixicAcidThree = $res['nalidixicAcidThree'];
                            $nalidixicAcidFour = $res['nalidixicAcidFour'];
                            $colistinSulphateOne = $res['colistinSulphateOne'];
                            $colistinSulphateTwo = $res['colistinSulphateTwo'];
                            $colistinSulphateThree = $res['colistinSulphateThree'];
                            $colistinSulphateFour = $res['colistinSulphateFour'];
                            $genticinOne = $res['genticinOne'];
                            $genticinTwo = $res['genticinTwo'];
                            $genticinThree = $res['genticinThree'];
                            $genticinFour = $res['genticinFour'];
                            $arithromycineOne = $res['arithromycineOne'];
                            $arithromycineTwo = $res['arithromycineTwo'];
                            $arithromycineThree = $res['arithromycineThree'];
                            $arithromycineFour = $res['arithromycineFour'];
                            $ceftazidimeOne = $res['ceftazidimeOne'];
                            $ceftazidimeTwo = $res['ceftazidimeTwo'];
                            $ceftazidimeThree = $res['ceftazidimeThree'];
                            $ceftazidimeFour = $res['ceftazidimeFour'];
                            $ciprofloxacinOne = $res['ciprofloxacinOne'];
                            $ciprofloxacinTwo = $res['ciprofloxacinTwo'];
                            $ciprofloxacinThree = $res['ciprofloxacinThree'];
                            $ciprofloxacinFour = $res['ciprofloxacinFour'];
                            $ofloxacintarvidOne = $res['ofloxacintarvidOne'];
                            $ofloxacintarvidTwo = $res['ofloxacintarvidTwo'];
                            $ofloxacintarvidThree = $res['ofloxacintarvidThree'];
                            $ofloxacintarvidFour = $res['ofloxacintarvidFour'];
                            $ceftriaoxoneOne = $res['ceftriaoxoneOne'];
                            $ceftriaoxoneTwo = $res['ceftriaoxoneTwo'];
                            $ceftriaoxoneThree = $res['ceftriaoxoneThree'];
                            $ceftriaoxoneFour = $res['ceftriaoxoneFour'];
                            $zinnatOne = $res['zinnatOne'];
                            $zinnatTwo = $res['zinnatTwo'];
                            $zinnatThree = $res['zinnatThree'];
                            $zinnatFour = $res['zinnatFour'];
                            $rocephineOne = $res['rocephineOne'];
                            $rocephineTwo = $res['rocephineTwo'];
                            $rocephineThree = $res['rocephineThree'];
                            $rocephineFour = $res['rocephineFour'];
                            $unasymOne = $res['unasymOne'];
                            $unasymTwo = $res['unasymTwo'];
                            $unasymThree = $res['unasymThree'];
                            $unasymFour = $res['unasymFour'];
                        }
                        ?>
                        <div class="row">
                                <form method="post" action="save_result.php">
                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                        <input class="form-control" type="hidden" name="patientName" value="<?php echo $patientNames; ?>" required>
                                        <input class="form-control" type="hidden" name="refNumber" value="<?php echo $pat_ref; ?>" required>
                                        <input class="form-control" type="hidden" name="today" value="<?php echo $today; ?>" required>
                                        <input class="form-control" type="hidden" name="appointmentNumber" value="<?php echo $appointNum; ?>" required>
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
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="penicillinOne" value="<?php echo $penicillinOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="penicillinTwo" value="<?php echo $penicillinTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="penicillinThree" value="<?php echo $penicillinThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="penicillinFour" value="<?php echo $penicillinFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>AMPICILLIN</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ampicillinOne" value="<?php echo $amicillinOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ampicillinTwo" value="<?php echo $amicillinTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ampicillinThree" value="<?php echo $amicillinThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ampicillinFour" value="<?php echo $amicillinFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>STREPTOMYCIN</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="streptomycinOne" value="<?php echo $streptomycinOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="streptomycinTwo" value="<?php echo $streptomycinTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="streptomycinThree" value="<?php echo $streptomycinThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="streptomycinFour" value="<?php echo $streptomycinFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>CHLORAMPENICOL</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="chlorampenicolOne" value="<?php echo $chlorampenicolOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="chlorampenicolTwo" value="<?php echo $chlorampenicolTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="chlorampenicolThree" value="<?php echo $chlorampenicolThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="chlorampenicolFour" value="<?php echo $chlorampenicolFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>TETRACYCLINE</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="tetracyclineOne" value="<?php echo $tetracyclineOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="tetracyclineTwo" value="<?php echo $tetracyclineTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="tetracyclineThree" value="<?php echo $tetracyclineThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="tetracyclineFour" value="<?php echo $tetracyclineFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ERYTHTOMYCINE</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="erythtomycineOne" value="<?php echo $erythtomycineOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="erythtomycineTwo" value="<?php echo $erythtomycineTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="erythtomycineThree" value="<?php echo $erythtomycineThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="erythtomycineFour" value="<?php echo $erythtomycineFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>SEPTRIN</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="septrinOne" value="<?php echo $septrinOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="septrinTwo" value="<?php echo $septrinTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="septrinThree" value="<?php echo $septrinThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="septrinFour" value="<?php echo $septrinFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>CLOXACILLIN</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="cloxacillinOne" value="<?php echo $cloxacillinOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="cloxacillinTwo" value="<?php echo $cloxacillinTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="cloxacillinThree" value="<?php echo $cloxacillinThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="cloxacillinFour" value="<?php echo $cloxacillinFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>CONTRIMOXAZOLE</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="contrimoxazoleOne" value="<?php echo $contrimoxazoleOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="contrimoxazoleTwo" value="<?php echo $contrimoxazoleTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="contrimoxazoleThree" value="<?php echo $contrimoxazoleThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="contrimoxazoleFour" value="<?php echo $contrimoxazoleFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>FURADANTINE</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="furadantineOne" value="<?php echo $furadantineOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="furadantineTwo" value="<?php echo $furadantineTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="furadantineThree" value="<?php echo $furadantineThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="furadantineFour" value="<?php echo $furadantineFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>NALIDIXIC ACID</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="nalidixicAcidOne" value="<?php echo $nalidixicAcidOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="nalidixicAcidTwo" value="<?php echo $nalidixicAcidTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="nalidixicAcidThree" value="<?php echo $nalidixicAcidThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="nalidixicAcidFour" value="<?php echo $nalidixicAcidFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>COLISTIN SULPHATE</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="colistinSulphateOne" value="<?php echo $colistinSulphateOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="colistinSulphateTwo" value="<?php echo $colistinSulphateTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="colistinSulphateThree" value="<?php echo $colistinSulphateThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="colistinSulphateFour" value="<?php echo $colistinSulphateFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>GENTICIN</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="genticinOne" value="<?php echo $genticinOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="genticinTwo" value="<?php echo $genticinTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="genticinThree" value="<?php echo $genticinThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="genticinFour" value="<?php echo $genticinFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ARITHROMYCINE</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="arithromycineOne" value="<?php echo $arithromycineOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="arithromycineTwo" value="<?php echo $arithromycineTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="arithromycineThree" value="<?php echo $arithromycineThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="arithromycineFour" value="<?php echo $arithromycineFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>CEFTAZIDIME</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ceftazidimeOne" value="<?php echo $ceftazidimeOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ceftazidimeTwo" value="<?php echo $ceftazidimeTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ceftazidimeThree" value="<?php echo $ceftazidimeThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ceftazidimeFour" value="<?php echo $ceftazidimeFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>CIPROFLOXACIN</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ciprofloxacinOne" value="<?php echo $ciprofloxacinOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ciprofloxacinTwo" value="<?php echo $ciprofloxacinTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ciprofloxacinThree" value="<?php echo $ciprofloxacinThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ciprofloxacinFour" value="<?php echo $ciprofloxacinFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>OFLOXACIN(TARVID)</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ofloxacintarvidOne" value="<?php echo $ofloxacintarvidOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ofloxacintarvidTwo" value="<?php echo $ofloxacintarvidTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ofloxacintarvidThree" value="<?php echo $ofloxacintarvidThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ofloxacintarvidFour" value="<?php echo $ofloxacintarvidFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>CEFTRIAOXONE</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ceftriaoxoneOne" value="<?php echo $ceftriaoxoneOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ceftriaoxoneTwo" value="<?php echo $ceftriaoxoneTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ceftriaoxoneThree" value="<?php echo $ceftriaoxoneThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="ceftriaoxoneFour" value="<?php echo $ceftriaoxoneFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ZINNAT</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="zinnatOne" value="<?php echo $zinnatOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="zinnatTwo" value="<?php echo $zinnatTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="zinnatThree" value="<?php echo $zinnatThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="zinnatFour" value="<?php echo $zinnatFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ROCEPHINE</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="rocephineOne" value="<?php echo $rocephineOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="rocephineTwo" value="<?php echo $rocephineTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="rocephineThree" value="<?php echo $rocephineThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="rocephineFour" value="<?php echo $rocephineFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>UNASYM</td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="unasymOne" value="<?php echo $unasymOne;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="unasymTwo" value="<?php echo $unasymTwo;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="unasymThree" value="<?php echo $unasymThree;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                <input class="form-control" type="text" name="unasymFour" value="<?php echo $unasymFour;?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="m-t-20 text-center">
                                        <button class="btn btn-primary submit-btn" type="submit" name="submit" style="background-color: rgba(12, 184, 182, 0.91);">save</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    else
                    {} 
                }
                else
                {}
                ?>
            </div>
        </div>
    </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="stackpath/popper.js@1.14.3/popper.min.js"></script>
    <script src="stackpath/popper.js@1.14.3/bootstrap.min.js"></script>
    <script src="stackpath/popper.js@1.14.3/bootstrap-select.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="myscript.js"></script>
</body>


<!-- add-patient24:07-->

</html>