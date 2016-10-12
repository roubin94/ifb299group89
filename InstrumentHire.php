<?php
session_start();
$title = "Instrument Hire";
require './Controller/InstrumentController.php';


if(isset($_GET["num"]))
{
    $instrumentController = new InstrumentController();
    $instrument = $instrumentController->GetInstrumentById($_GET["num"]);
    
    $result = "<table class = 'instrumentTable'>
                        <tr>
                            <th rowspan='8' width = '200px'><img runat = 'server' src = '$instrument->image' /></th>
                            <th width = '150px' style = 'text-align:right' >Name: </th>
                            <td>$instrument->name</td>
                        </tr>
                        <tr>
                            <th style = 'text-align:right'>Model: </th>
                            <td>$instrument->Model</a></td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Family: </th>
                            <td>$instrument->type</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Price per Month: </th>
                            <td>$instrument->price</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Quality: </th>
                            <td>$instrument->quality</td>
                        </tr>
                        
                        <tr>
                            <th style = 'text-align:right'>Availibility: </th>
                            <td>$instrument->availibility</td>
                        </tr>
                     </table>";
    
    if($instrument->availibility == "available")
    {
        $content ="<form action='' method='post'>
        <fieldset>

        <label for='availibility'>Hire Duration: </label>
        <input type='text' class='inputField' name='availibility' /><br/>

        <input type='submit' value='Submit'>
        </fieldset>
        </form>";
    }
    
    if(isset($_POST["availibility"]))
    {
        $number = $_GET["num"];
        $name = $instrument->name;
        $Model = $instrument->Model;
        $type = $instrument->type;
        $price = $instrument->price;
        $image = $instrument->image;
        $quality = $instrument->quality;
        $availibility = "unavailable";

        $instrument = new InstrumentEntity($number, $name, $Model,$type, $price, $image, $quality, $availibility);
        $instrumentModel = new InstrumentModel();
        $instrumentModel->UpdateInstrumentHire($number,$instrument);
    }
}
// Content
    include "header.php";
    echo $result;
    if(isset($content))
    {
        echo $content;
    }
    include "footer.php";
?>
