<?php
/* Change to the correct path if you copy this example! */
require __DIR__ . '/../../vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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
try {
    // Enter the share name for your USB printer here
    //$connector = null;
    $connector = new WindowsPrintConnector("XP-58C");
    $tux = EscposImage::load("../stbridget.jpg", false);

    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    /*$printer -> graphics($tux);
    $printer -> graphics($tux, Printer::IMG_DOUBLE_WIDTH);
    $printer -> graphics($tux, Printer::IMG_DOUBLE_HEIGHT);*/
    $printer -> text("Hello World!\n");
    $printer -> text("please print larger page to confirm things for me !\n");
    $printer -> text("please!\n");
    $printer -> cut();
    
    /* Close printer */
    $printer -> close();
} catch (Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
