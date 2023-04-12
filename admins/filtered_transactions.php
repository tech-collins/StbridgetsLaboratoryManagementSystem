<?php
include 'fabinde.php';


if(isset($_POST["from"]))
{
    echo $_POST["from"];
}
else
{
    echo "not set";
}
?>