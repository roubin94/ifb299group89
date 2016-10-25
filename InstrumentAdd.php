<?php
    session_start();

    require './Controller/InstrumentController.php';
    $instrumentController = new InstrumentController();

    // Page Title
    $title = "PMA - Add Instrument to Catalogue";

    // Check if logged in as staff member before proceeding.
    if (!isset($_SESSION['staff_id'])) {
        $content = 'You are not logged in as a staff member.';
    }
    
    else if (isset($_GET["update"]))
    {
        $instrument = $instrumentController->GetInstrumentById($_GET["update"]);

        $content ="<form action='' method='post'>
        <fieldset>
            <legend>Add a new Instrument</legend>
            <label for='name'>Name: </label>
            <input type='text' class='inputField' name='name' value='$instrument->name' /><br/>

            <label for='Model'>Model: </label>
            <input type='text' class='inputField' name='Model' value='$instrument->Model'/><br/>

            <label for='type'>Type: </label>
            <select class='inputField' name='type'>
                <option value='%'>All</option>"
            .$instrumentController->CreateOptionValues($instrumentController->GetInstrumentTypes()).
            "</select><br/>

            <label for='price'>Price: </label>
            <input type='text' class='inputField' name='price' value='$instrument->price'/><br/>

            <label for='image'>Image: </label>
            <select class='inputField' name='image'>"
            .$instrumentController->GetImages().
            "</select></br>

            <label for='quality'>Review: </label>
            <textarea cols='70' rows='12' name='quality'>$instrument->quality</textarea></br>

            <label for='availibility'>Availibility: </label>
            <input type='text' class='inputField' name='availibility' value='$instrument->availibility'/><br/>

            <input type='submit' value='Submit'>
        </fieldset>
    </form>";
    }
    else 
    {
    $content ="<form action='' method='post'>
        <fieldset>
            <legend>Add a new Instrument</legend>
            <label for='name'>Name: </label>
            <input type='text' class='inputField' name='name' /><br/>

            <label for='Model'>Model: </label>
            <input type='text' class='inputField' name='Model' /><br/>

            <label for='type'>Type: </label>
            <select class='inputField' name='type'>
                <option value='%'>All</option>"
            .$instrumentController->CreateOptionValues($instrumentController->GetInstrumentTypes()).
            "</select><br/>

            <label for='price'>Price: </label>
            <input type='text' class='inputField' name='price' /><br/>

            <label for='image'>Image: </label>
            <select class='inputField' name='image'>"
            .$instrumentController->GetImages().
            "</select></br>

            <label for='quality'>Review: </label>
            <textarea cols='70' rows='12' name='quality'></textarea></br>

            <label for='availibility'>Availibility: </label>
            <input type='text' class='inputField' name='availibility' /><br/>

            <input type='submit' value='Submit'>
        </fieldset>
    </form>";    
    }

    if(isset($_GET["update"]))
    {
        if(isset($_POST["name"]))
        {
            $instrumentController->UpdateInstrument($_GET["update"]);
            header("Refresh:0");
        }
    }
    else
    {
        if(isset($_POST["name"]))
        {
            $instrumentController->InsertInstrument();
            header("Refresh:0");
        }
    }

    // Content
    include "header.php";
    echo $content;
    include "footer.php";