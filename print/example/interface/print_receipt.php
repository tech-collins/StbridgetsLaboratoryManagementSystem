<?php
/* Change to the correct path if you copy this example! */
require __DIR__ . '/../../vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
set_include_path('C:/wamp64/www/stbridget/fabinde.php');

/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 *
 * Use a WindowsPrintConnector with the share name to print.
 *
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 *
 *  echo "Hello World" > testfile
 *  copy testfile "\\%COMPUTERNAME%\Receipt Printer"
 *  del testfile
 */
function testing()
 {
    try {
        // Enter the share name for your USB printer here
        //$connector = null;
        $connector = new WindowsPrintConnector("XP-58C");
    
        /* Print a "Hello world" receipt" */
        $printer = new Printer($connector);
    
        $printer -> text("St Bridget Radiological Centre!\n");
        $printer -> text("No 4 Iyobosa Street, Off New Lago Road!\n");
        $printer -> text("Test Payment Receipt!\n");
        $printer -> text("!=======================!\n");
        $printer -> text("please print larger page to confirm things for me !\n");
        $printer -> text("please!\n");
        $printer -> cut();
        
        /* Close printer */
        $printer -> close();
    } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
    }
 }


function letsPrint($name)
{
    try{
        $connector = new WindowsPrintConnector("XP-58C on Desktop-2uqctl7");

        /* Print a "Hello world" receipt" */
        $printer = new Printer($connector);
        /*$printer -> text("St Bridget Radiological Centre!\n");
        $printer -> text("No 4 Iyobosa Street, Off New \n Lagos Road, Benin City\n");
        $printer -> text("Test Payment Receipt!\n");
        $printer -> text("!=======================!\n");*/
        $printer -> text($name);
        //$printer -> text("please!\n");
        
        $printer -> cut();
        $printer -> close();
    }
    catch(Exception $f)
    {
        echo "Couldn't print to this printer: " . $f -> getMessage() . "\n";
    }
}

?>
