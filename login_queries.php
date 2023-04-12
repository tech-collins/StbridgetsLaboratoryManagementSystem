<?php
session_start();
include 'fabinde.php';

if(isset($_POST["inputUsername"]))
{
    $db_pass = "";
    $login_status = "";
    $username = mysqli_real_escape_string($con,$_POST["inputUsername"]);
    $userPass = mysqli_real_escape_string($con,$_POST["inputPassword"]);
    $hashPass = password_hash($userPass, PASSWORD_DEFAULT);
    $db_pass = "";
    $status = "";
    $staff_interface = "";
    $staff_name = "";
    
    $seen = "";
    $status = "";

    $query = mysqli_query($con,"SELECT * FROM staff_access WHERE username='$username'");
    if(mysqli_num_rows($query) >= 1)
    {
        $seen = "email found";
        while($re = mysqli_fetch_assoc($query))
        {
            $db_pass = $re['staff_password'];
            $status = $re['username'];
            $staff_interface = $re['staff_interface'];
            $staff_name = $re['staff_name'];
        }
        if(password_verify($userPass,$db_pass))
        {
            $_SESSION["username"] = $username ;
            $_SESSION["staff_interface"] = $staff_interface;
            $_SESSION["staff_name"] = $staff_name;
            echo"login successful";
            if($staff_interface == "admin")
            {
                echo "<script>window.location.href = 'admin/index.php'</script>";
                header('location:admins/index.php');
            }
            elseif($staff_interface == "scientist")
            {
                echo "<script>window.location.href = 'scientist/index.php'</script>";
                header('location:scientist/index.php');
            }
            elseif($staff_interface == "reception")
            {
                echo "<script>window.location.href = 'reception/index.php'</script>";
                header('location:reception/index.php');
            }
        }
        else
        {
            $login_status =  "user password not correct";
            header("location:index.php?status=$login_status");
        }
    }
    else
    {
        $login_status =  "username not found')";
        header("location:index.php?status=$login_status");
    }
}

?>