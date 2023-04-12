<?php
include 'fabinde.php';
/*function letsPrint()
{
    echo "<a href='https://www.google.com/' target='_blank'>Google</a>
    ";
?>
<script type="text/javascript">
       window.open('https://www.google.com/', '_blank');
    </script>
<?php
}

letsPrint();
*/
function testNameOnly($tst_ref)
{
    include 'fabinde.php';

    $test_details = "";

    $test_query = mysqli_query($con, "SELECT * FROM test_categories WHERE test_ref='$tst_ref'");
    if (mysqli_num_rows($test_query) >= 1) {
        while ($rest = mysqli_fetch_assoc($test_query)) {
            $test_details = $rest['test_type'];
        }
    }
    return $test_details;
}

function prizeOnly($reference)
{
    include 'fabinde.php';

    $amount = 0;
    $test_query = mysqli_query($con,"SELECT test_amount FROM test_categories WHERE test_ref='$reference'");
    while($results = mysqli_fetch_assoc($test_query))
        {
            $amount = intval($results['test_amount']);
        }

        return $amount;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Receipt example</title>
    <style>
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 355px;
        }

       img {
            width: 50px;
            height: 50px;
            margin-left: 50px;
            margin-right: 50px;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <img src="assets/img/stbridget.jpg" alt="Logo"><p class="centered">Saint Bridget Diagnostic Service
            <br>No. 4 Iyobosa Street Off new Lagos Road
            <br>Benin City, Edo State.
        </p>
    <?php
    if(isset($_GET["ref"]))
    {
        $patientNames = "";
        $thirdParty = "";
        $payment_status = "";
        $tests;
        $totalAmount = "";
        $test_appointment = mysqli_real_escape_string($con,$_GET["ref"]);
        $search = mysqli_query($con,"SELECT * FROM transactions WHERE appointment_no='$test_appointment'");
        if(mysqli_num_rows($search) >= 1)
        {
            $rawTest;
            while($result = mysqli_fetch_assoc($search))
            {
                $patientNames = $result['patient_name'];
                $payment_status = $result['transaction_payment'];
                $thirdParty = $result['third_party_payment'];
                $rawTest = unserialize($result['test_type']);
                $totalAmount = $result['amount'];
            }
?>
        <h5>Patient Name: <?php echo $patientNames; ?></h5>
        <h5>Appointment No: <?php echo $test_appointment; ?></h5>
        <h5>Date:   <script type="text/javascript">
                        var x = new Date();
                        document.write(x);
                    </script></h5>
<?php
            if(is_array($rawTest) && count($rawTest) >1)
            {
?>
        <table>
            <thead>
                <tr>
                    <th class="quantity">#</th>
                    <th class="description">Test</th>
                    <th class="price">Prize</th>
                </tr>
            </thead>
            <tbody>
<?php
$counter = 0;
                foreach($rawTest as $test)
                {
                    ++$counter;
?>
                <tr>
                    <td class="quantity"><?php echo $counter; ?></td>
                    <td class="description"><?php echo testNameOnly($test); ?></td>
                    <td class="price"><?php echo prizeOnly($test); ?></td>
                </tr>
<?php
                }
?>
                <tr>
                    <td class="quantity"></td>
                    <td class="description">TOTAL</td>
                    <td class="price"><?php echo $totalAmount; ?></td>
                </tr>
            </tbody>
        </table>
        <h5>Payment:<?php echo " ".  $payment_status; ?></h5>
        <?php 
        if($thirdParty != "no")
        {
            echo "<h5>Paying Company:".$thirdParty."</h5>";
        }
        ?>
        <p class="centered">Thanks for coming!
        </p>
<?php
            }
            else
            {
?>
        <table>
            <thead>
                <tr>
                    <th class="quantity">#</th>
                    <th class="description">Test</th>
                    <th class="price">Prize</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="quantity">1</td>
                    <td class="description"><?php echo testNameOnly($rawTest[0]); ?></td>
                    <td class="price"><?php echo prizeOnly($rawTest[0]); ?></td>
                </tr>
                <tr>
                    <td class="quantity"></td>
                    <td class="description">TOTAL</td>
                    <td class="price"><?php echo $totalAmount; ?></td>
                </tr>
            </tbody>
        </table>
        <h5>Payment:<?php echo $payment_status; ?></h5>
        <?php 
        if($thirdParty != "no")
        {
            echo "<h5>Paying Company:".$thirdParty."</h5>";
        }
        ?>
        <p class="centered">Thanks for your coming!
        </p>
<?php
            }

        }
    }
    else
    {
        echo "<h2><b> transaction not found</b></h2>";
    }
    ?>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <script src="script.js"></script>
</body>

<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>

</html>