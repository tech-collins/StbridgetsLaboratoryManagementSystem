<?php
include 'fabinde.php';

if(isset($_POST["staffName"]))
{
    $staff_name = mysqli_real_escape_string($con,$_POST["staffName"]);
    $staff_username = mysqli_real_escape_string($con,$_POST["staffUsername"]);
    $staff_password = mysqli_real_escape_string($con,$_POST["staffPassword"]);
    $staff_interface = mysqli_real_escape_string($con,$_POST["staffInterface"]);
    $hashPass = password_hash($staff_password, PASSWORD_DEFAULT);
    $login_status = "enable";

    $insert = mysqli_query($con,"INSERT INTO staff_access(username,staff_pasword,staff_name,staff_interface,login_status) VALUES('$staff_username','$hashPass','$staff_name','$staff_interface','$login_status')");
    if($insert)
    {
        echo "'user added successfully";
    }
    else
    {
        echo "user not added..somethng went wrong'";
    }
}

if(isset($_POST["enableId"]))
{
    $thId = mysqli_real_escape_string($con,$_POST["enableId"]);
    $enable = "enable";
    $update = mysqli_query($con,"UPDATE staff_access SET login_status='".$enable."' WHERE id='".$thId."' ");
    if($update)
    {
        echo "login details enabled...!!!";
    }
    else
    {
        echo "'login details NOT enabled...something went wrong!!!";
    }
}

if(isset($_POST["disableId"]))
{
    $thId = mysqli_real_escape_string($con,$_POST["disableId"]);
    $disable = "disable";
    $update = mysqli_query($con,"UPDATE staff_access SET login_status='".$disable."' WHERE id='".$thId."' ");
    if($update)
    {
        echo "<script>alert('login details disabled...!!!');</script>";
    }
    else
    {
        echo "<script>alert('login details NOT disabled...something went wrong!!!');</script>";
    }
}

if(isset($_POST["removeId"]))
{
    $thId = mysqli_real_escape_string($con,$_POST["removeId"]);
    $delete = mysqli_query($CON, "DELETE FROM staff_access WHERE id='$thId'");
    if($delete)
    {
        echo "<script>alert('login details deleted...!!!');</script>";
    }
    else
    {
        echo "<script>alert('login details NOT deleted...something went wrong!!!');</script>";
    }
}
?>