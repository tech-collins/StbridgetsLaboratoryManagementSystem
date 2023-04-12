<?php

echo substr(date('d-m-Y'),6)."<br>";
echo date("F j, Y, g:i a")."<br>";   // October 30, 2019, 10:42 pm
echo date("D M j G:i:s T Y")."<br>"; // Wed Oct 30 22:42:18 UTC 2019
echo date("Y-m-d H:i:s")."<br>"; 
echo gmdate("M d Y H:i:s")."<br>";
echo '<script type="text/javascript">
var x = new Date()
document.write(x)
</script>';

if(isset($_GET["ref"]))
{
    echo $_GET["ref"];
}

/*
	$query = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_status='$dd'");
		if ($query) {
			while ($result = mysqli_fetch_assoc($query)) {
                echo $result['patient_name']."<br>";
                echo $result['test_category']."<br>";
                echo $result['gender']."<br>";
                echo $result['payment']."<br>";
                echo"<hr>";
            }
        }
        echo date('h:i:s');

if(isset($_POST['testName']))
{
    $tst = $_POST['testName'];
    echo count($_POST['testName']);
    $test_number = count($_POST['testName']);

    for ($i=0; $i < $test_number; $i++)
    {
        echo $tst[$i];
    }

    foreach ($_POST['testName']as $selectedOption){
        echo $selectedOption."\n";
    }
    
}*/
$appointmentnumber = 8;
?>
<script type="text/javascript">
    <?php 
    echo "var refs = '$appointmentnumber';"
?>

  var dd = parseInt(refs) *2;
  document.getElementById('finalTotal').innerHTML = dd;

       
    </script>

<html>
    <head>
        <title>testing</title>
    </head>
    <body>
        <div id="finalTotal"></div>
    </body>
</html>