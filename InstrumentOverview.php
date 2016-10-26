<?php
session_start();

    // Page Title
    $title = "PMA - Manage Instrument Catalogue";

    include './Controller/InstrumentController.php';
    $instrumentController = new InstrumentController();

    $content = $instrumentController->CreateOverviewTable();

    if(isset($_GET["delete"]))
    {
        $instrumentController->DeleteInstrument($_GET["delete"]);
    }

    // Content
        include "header.php";
        echo $content . "<p><a href='Management.php'>Back</a><p/>";
        include "footer.php";