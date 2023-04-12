<?php
	//$dbServer = 'localhost';
  $dbServer = '127.0.0.1';
	$dbUsername = 'root';
	$dbPassword = '';
	$dbDatabase = 'BRIDGET_DB';

    $con = mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbDatabase);
    

    // Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();

  mysqli_close($con);
  exit();
}
