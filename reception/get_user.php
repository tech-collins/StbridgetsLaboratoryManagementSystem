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

if (isset($_POST["phone_id"])) {
    $app_number =  $_POST["phone_id"];
    $testStatus = "finish";
    $sstColor = "";
    $search = mysqli_query($con, "SELECT * FROM appointments WHERE phone_no='$app_number' AND appointment_status='$testStatus' ");
    if ($search) {
        while ($result = mysqli_fetch_array($search)) {
            if($result['appointment_status'] == "finish")
            {
                $sstColor = "green";
            }
            elseif($result['appointment_status'] == "sample collected")
            {
                $sstColor = "orange";
            }
            else
            {
                $sstColor = "red";
            }
            echo "
            <tr>
                <td><img width='28' height='28' src='assets/img/user.jpg' class='rounded-circle m-r-5' alt=''>" . $result['patient_name'] . "</td>
                <td>" . $result['dob'] . "</td>
                <td>" . $result['gender'] . "</td>
                <td>" . substr($result['appointment_date'], 0, -8) . "</td>
                <td>" . $result['appointment_no'] . "</td>
                <td><span class='custom-badge status-".$sstColor."'>" . $result['appointment_status'] . "</span></td>
                <td class='text-right'>
                    <div class='dropdown dropdown-action'>
                        <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                        <div class='dropdown-menu dropdown-menu-right'>
                            <a class='dropdown-item' href='all_result_view.php?ref=". $result['patient_ref_no'] ."&appointmentNo=".$result['appointment_no']."'><i class='fa fa-pencil m-r-5'></i> View</a>
                        </div>
                    </div>
                </td>
            </tr>

            ";
        }
    }
}

if (isset($_POST["status_id"])) {
    $app_number =  $_POST["status_id"];
    $search = mysqli_query($con, "SELECT * FROM patients WHERE phone_number='$app_number'");
    if ($search) {
        while ($result = mysqli_fetch_array($search)) {
            echo "
            <tr>
                <td>" . $result['patient_ref_number'] . "</td>
                <td><img width='28' height='28' src='assets/img/user.jpg' class='rounded-circle m-r-5' alt=''>" . $result['patient_surname']." ".$result['patient_firstname'] . "</td>
                <td>" . $result['age'] . "</td>
                <td>" . $result['gender'] . "</td>
                <td>" . $result['address'] . "</td>
                <td>" . $result['date_registered'] . "</td>
                <td>" . $result['city'] . "</td>
                <td>" . $result['patient_state'] . "</td>
                <td class='text-right'>
                    <div class='dropdown dropdown-action'>
                        <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                        <div class='dropdown-menu dropdown-menu-right'>
                            <a class='dropdown-item' href='view_patient.php?ref=" . $result['patient_ref_number'] . "'><i class='fa fa-pencil m-r-5'></i> View</a>
                        </div>
                    </div>
                </td>
            </tr>

            ";
        }
    }
}


if (isset($_POST["appointment_id"])) {
    $app_number =  $_POST["appointment_id"];
    $sstColor = "";
    $search = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_no='$app_number'");
    if ($search) {
        while ($result = mysqli_fetch_array($search)) {
            if($result['appointment_status'] == "finish")
            {
                $sstColor = "green";
            }
            elseif($result['appointment_status'] == "sample collected")
            {
                $sstColor = "blue";
            }
            else
            {
                $sstColor = "red";
            }
            echo "
            <tr>
                <td>" . $result['appointment_no'] . "</td>
                <td><img width='28' height='28' src='assets/img/user.jpg' class='rounded-circle m-r-5' alt=''>" . $result['patient_name'] . "</td>
                <td>" . $result['dob'] . "</td>
                <td>" . $result['gender'] . "</td>
                <td>" . $result['test_category'] . "</td>
                <td>" . substr($result['appointment_date'], 0, -8) . "</td>
                <td>" . substr($result['appointment_date'], 12, -3) . "</td>
                <td><span class='custom-badge status-".$sstColor."'>" . $result['appointment_status'] . "</span></td>
                <td class='text-right'>
                    <div class='dropdown dropdown-action'>
                        <a href='#' class='action-icon dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-ellipsis-v'></i></a>
                        <div class='dropdown-menu dropdown-menu-right'>
                            <a class='dropdown-item' href='view-appointment.php?ref=".$result['patient_ref_no']."&appN=".$result['appointment_no']."'><i class='fa fa-pencil m-r-5'></i> View</a>
                        </div>
                    </div>
                </td>
            </tr>

            ";
        }
    }
}


?>