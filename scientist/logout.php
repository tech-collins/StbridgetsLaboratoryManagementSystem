<?php

unset($_SESSION["username"]);
unset($_SESSION["staff_interface"]);

session_destroy();

header("location:../index.php");


?>

