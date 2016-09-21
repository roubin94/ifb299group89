<?php

session_start();
$title = "Manage instrument objects";

include './Controller/InstrumentController.php';
$instrumentController = new InstrumentController();

$content = $instrumentController->CreateOverviewTable();

if(isset($_GET["delete"]))
{
    $instrumentController->DeleteInstrument($_GET["delete"]);
}
           
// Content
    include "header.php";
    echo $content;
    include "footer.php";
?>
