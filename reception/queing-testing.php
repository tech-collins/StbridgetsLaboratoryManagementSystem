<?php
include 'fabinde.php';
$dd = "pending";

?>

<!DOCTYPE html>
<html lang="en">

<head>

<script src="assets/js/jquery-3.2.1.min.js"></script>

<script>
/*$.document.ready(function(){
    $('#div_refresh').load("test.php");
    setInterval(function(){
        $('#div_refresh').load("test.php");
    },3000);
});*/
</script>

<script type="text/javascript">
$(document).ready(function(){
  refreshTable();
});

function refreshTable(){
    $('#div_refresh').load('test.php', function(){
       setTimeout(refreshTable, 3000);
    });
}
</script>



</head>
<body>
    <div id="div_refresh">

    </div>
</body>
</html>