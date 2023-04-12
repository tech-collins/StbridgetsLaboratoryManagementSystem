<?php

if(isset($_SESSION["username"]) && $_SESSION["staff_interface"] == "reception")
{}
else
{
    unset($_SESSION["username"]);
    unset($_SESSION["staff_interface"]);
    session_destroy();
    header("location:../index.php");
}
?>