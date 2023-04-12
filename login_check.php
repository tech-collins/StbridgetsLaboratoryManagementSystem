<?php
session_start();

if(isset($_SESSION["username"]) && isset($_SESSION["staff_interface"]))
{}
else
{
    session_destroy();
    header("location:index.php");
}
?>