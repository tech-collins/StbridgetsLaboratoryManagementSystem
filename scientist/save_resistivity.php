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
                /**if(isset($_GET["appN"]))
                { 
                    $patientNames = mysqli_real_escape_string($con,$_GET["patientName"]);
                    $pat_ref = mysqli_real_escape_string($con,$_GET["ref"]);
                    $appointNum = mysqli_real_escape_string($con,$_GET["appN"]);
                    $today = mysqli_real_escape_string($con,$_GET["today"]);**/
                    $patientNames = "Eze Onyema Collins";
                    $pat_ref = "LABPT-0220";
                    $appointNum = "APT-04-22-2022-0";
                    $today = "04-22-2022 12:41:20";
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
                                                        <input class="form-control" type="text" name="penicillinOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="penicillinTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="penicillinThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="penicillinFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>AMPICILLIN</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ampicillinOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ampicillinTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ampicillinThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ampicillinFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>STREPTOMYCIN</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="streptomycinOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="streptomycinTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="streptomycinThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="streptomycinFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CHLORAMPENICOL</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="chlorampenicolOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="chlorampenicolTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="chlorampenicolThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="chlorampenicolFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>TETRACYCLINE</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="tetracyclineOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="tetracyclineTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="tetracyclineThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="tetracyclineFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ERYTHTOMYCINE</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="erythtomycineOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="erythtomycineTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="erythtomycineThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="erythtomycineFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>SEPTRIN</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="septrinOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="septrinTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="septrinThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="septrinFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CLOXACILLIN</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="cloxacillinOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="cloxacillinTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="cloxacillinThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="cloxacillinFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CONTRIMOXAZOLE</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="contrimoxazoleOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="contrimoxazoleTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="contrimoxazoleThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="contrimoxazoleFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>FURADANTINE</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="furadantineOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="furadantineTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="furadantineThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="furadantineFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>NALIDIXIC ACID</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="nalidixicAcidOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="nalidixicAcidTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="nalidixicAcidThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="nalidixicAcidFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>COLISTIN SULPHATE</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="colistinSulphateOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="colistinSulphateTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="colistinSulphateThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="colistinSulphateFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>GENTICIN</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="genticinOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="genticinTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="genticinThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="genticinFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ARITHROMYCINE</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="arithromycineOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="arithromycineTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="arithromycineThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="arithromycineFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CEFTAZIDIME</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ceftazidimeOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ceftazidimeTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ceftazidimeThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ceftazidimeFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CIPROFLOXACIN</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ciprofloxacinOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ciprofloxacinTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ciprofloxacinThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ciprofloxacinFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>OFLOXACIN(TARVID)</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ofloxacintarvidOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ofloxacintarvidTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ofloxacintarvidThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ofloxacintarvidFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CEFTRIAOXONE</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ceftriaoxoneOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ceftriaoxoneTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ceftriaoxoneThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="ceftriaoxoneFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ZINNAT</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="zinnatOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="zinnatTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="zinnatThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="zinnatFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ROCEPHINE</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="rocephineOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="rocephineTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="rocephineThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="rocephineFour">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>UNASYM</td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="unasymOne">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="unasymTwo">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="unasymThree">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                        <input class="form-control" type="text" name="unasymFour">
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
                /**}
                else
                {}**/
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