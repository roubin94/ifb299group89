<?php
    session_start();

    // Page Title
    $title = "PMA - Instrument List";

    require 'Controller/InstrumentController.php';
    $instrumentController = new InstrumentController();

    if(isset($_POST['types']))
    {
        //Fill page with instruments of the selected type
        $instrumentTables = $instrumentController->CreateInstrumentTables($_POST['types']);
    }
    else 
    {
        //Page is loaded for the first time, no type selected -> Fetch all types
        $instrumentTables = $instrumentController->CreateInstrumentTables('%');
    }

    // Content
    include "header.php";
    echo $instrumentController->CreateInstrumentDropdownList(). $instrumentTables;
    include "footer.php";
    
    