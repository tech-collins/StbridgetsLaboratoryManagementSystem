<?php
include 'fabinde.php';

function showAge($dfb)
{
    $birth_date = strtotime($dfb);
    $now = time();
    $age = $now - $birth_date;
    $new_age = intval($age / 60 / 60 / 24 / 365.25);
    return $new_age;
    //$dd = stripos(".",$a,0 );
    //$new_age = substr($a,$dd);
}

if(isset($_POST["status_id"]))
{
    $app_number =  $_POST["status_id"];
    $search = mysqli_query($con,"SELECT * FROM patients WHERE phone_number='$app_number'");
    if($search)
    {
        while($result = mysqli_fetch_array($search))
        {

                echo"
                <tr>
                    <td>".$result['patient_ref_number']."</td>
                    <td><img width='28' height='28' src='assets/img/user.jpg' class='rounded-circle m-r-5' alt=''>".$result['patient_surname']." ".$result['patient_firstname']."</td>
                    <td>".substr($result['date_registered'],0,-8)."</td>
                    <td>".$result['gender']."</td>
                    <td>".$result['age']."</td>
                    <td>".$result['address']."</td>
                    <td>".$result['city']."</td>
                    <td>".$result['patient_state']."</td>
                    <td class='text-right'>
                        <div class='dropdown dropdown-action'>
                            <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                            <div class='dropdown-menu dropdown-menu-right'>
                                <a class='dropdown-item' href='view_patient.php?ref=".$result['patient_ref_number']."'><i class='fa fa-pencil m-r-5'></i> View</a>
                            </div>
                        </div>
                    </td>
                </tr>
    
                ";
        }
    }
    else
    {
        echo "patient NOT found...";
    }
}

if(isset($_POST["reference_id"]))
{
    $sample = "sample collected";
    $ref = mysqli_real_escape_string($con,$_POST["reference_id"]);
    $search_pat = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_no='$ref'");
    if($search_pat)
    {
        while($result = mysqli_fetch_array($search_pat))
        {
            if($result['appointment_status'] == "pending")
            {
                echo"
                <tr>
                    <td>".$result['appointment_no']."</td>
                    <td><img width='28' height='28' src='assets/img/user.jpg' class='rounded-circle m-r-5' alt=''>".$result['patient_name']."</td>
                    <td>".$result['dob']."</td>
                    <td>".$result['gender']."</td>
                    <td>".$result['test_category']."</td>
                    <td>".substr($result['appointment_date'],0,-8)."</td>
                    <td>".substr($result['appointment_date'],12,-3)."</td>
                    <td><span class='custom-badge status-blue'>".$result['appointment_status']."</span></td>
                    <td class='text-right'>
                        <div class='dropdown dropdown-action'>
                            <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                            <div class='dropdown-menu dropdown-menu-right'>
                            <a class='dropdown-item' href='view-appointment.php?ref=".$result['patient_ref_no']."&appN=".$result['appointment_no']."&today=".$result['appointment_date']."'><i class='fa fa-pencil m-r-5'></i> view</a>
                            <a class='dropdown-item' href='#' onclick='queueStatus('".$result['id']."','sample collected')'><i class='fa fa-pencil m-r-5'></i> accept</a>
                            </div>
                        </div>
                    </td>
                </tr>
    
                ";
            }
            elseif($result['appointment_status'] == "sample collected")
            {
                echo"
                <tr>
                    <td>".$result['appointment_no']."</td>
                    <td><img width='28' height='28' src='assets/img/user.jpg' class='rounded-circle m-r-5' alt=''>".$result['patient_name']."</td>
                    <td>".$result['dob']."</td>
                    <td>".$result['gender']."</td>
                    <td>".$result['test_category']."</td>
                    <td>".substr($result['appointment_date'],0,-8)."</td>
                    <td>".substr($result['appointment_date'],12,-3)."</td>
                    <td><span class='custom-badge status-orange'>".$result['appointment_status']."</span></td>
                    <td class='text-right'>
                        <div class='dropdown dropdown-action'>
                            <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                            <div class='dropdown-menu dropdown-menu-right'>
                            <a class='dropdown-item' href='view-appointment.php?ref=".$result['patient_ref_no']."&appN=".$result['appointment_no']."&today=".$result['appointment_date']."'><i class='fa fa-pencil m-r-5'></i> view</a>
                                <a class='dropdown-item' href='record_result.php?ref=".$result['patient_ref_no']."'><i class='fa fa-pencil m-r-5'></i> capture result</a>
                            </div>
                        </div>
                    </td>
                </tr>
    
                ";
            }
            else
            {
                echo"
                <tr>
                    <td>".$result['appointment_no']."</td>
                    <td><img width='28' height='28' src='assets/img/user.jpg' class='rounded-circle m-r-5' alt=''>".$result['patient_name']."</td>
                    <td>".$result['dob']."</td>
                    <td>".$result['gender']."</td>
                    <td>".$result['test_category']."</td>
                    <td>".substr($result['appointment_date'],0,-8)."</td>
                    <td>".substr($result['appointment_date'],12,-3)."</td>
                    <td><span class='custom-badge status-green'>".$result['appointment_status']."</span></td>
                    <td class='text-right'>
                        <div class='dropdown dropdown-action'>
                            <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                            <div class='dropdown-menu dropdown-menu-right'>
                            <a class='dropdown-item' href='view-appointment.php?ref=".$result['patient_ref_no']."&appN=".$result['appointment_no']."&today=".$result['appointment_date']."'><i class='fa fa-pencil m-r-5'></i> view</a>
                            </div>
                        </div>
                    </td>
                </tr>
    
                ";
            }


        }
    }
    else
    {
        echo $ref."patient NOT found...";
    }
}

if(isset($_POST["phone_id"]))
{
    $app_number =  $_POST["phone_id"];
    $search = mysqli_query($con,"SELECT * FROM appointments WHERE phone_no='$app_number'");
    if($search)
    {
        while($result = mysqli_fetch_array($search))
        {
            echo"
            <tr>
                <td>".$result['appointment_no']."</td>
                <td><img width='28' height='28' src='assets/img/user.jpg' class='rounded-circle m-r-5' alt=''>".$result['patient_name']."</td>
                <td>".showAge($result['dob'])."</td>
                <td>".$result['gender']."</td>
                <td>".$result['test_category']."</td>
                <td>".substr($result['appointment_date'],0,-8)."</td>
                <td>".substr($result['appointment_date'],12,-3)."</td>
                <td><button><span class='custom-badge status-red'>".$result['appointment_status']."</span></button></td>
                <td class='text-right'>
                    <div class='dropdown dropdown-action'>
                        <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                        <div class='dropdown-menu dropdown-menu-right'>
                            <a class='dropdown-item' href='view-appointment.php?ref='".$result['patient_ref_no']."'><i class='fa fa-pencil m-r-5'></i> View</a>
                            <a class='dropdown-item' href='#' onclick='removeAppointment('".$result['id']."')' data-toggle='' data-target=''><i class='fa fa-trash-o m-r-5'></i> Delete</a>
                        </div>
                    </div>
                </td>
            </tr>

            ";

        }
    }
    else
    {
        echo "patient NOT found...";
    }
}
?>