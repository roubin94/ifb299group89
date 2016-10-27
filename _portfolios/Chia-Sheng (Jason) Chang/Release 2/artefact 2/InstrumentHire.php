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

        <label for='duration'>Hire Duration: </label>
        <input type='text' class='inputField' name='duration' /><br/>

        <input type='submit' value='Submit'>
        </fieldset>
        </form>";
    }
    
    if(isset($_POST["duration"]) && $_POST["duration"] != 0)
    {
        $price = $instrument->price;
        preg_match('/\$([0-9]+[\.]*[0-9]*)/', $price, $match);
        $Price = $match[1];
        $duration = $_POST["duration"];
        $total = $Price*$duration;
        $Pay = 1;
        
        $Payment ="<form action='' method='post'>
        <fieldset>
        
        <strong> Total Price: $$total</br></br>
            
        <label for=''>Name on Card: </label>
        <input type='text' class='inputField' name='Cardname' /><br/>
        
        <strong>Card Type:
        <select name='Type'>
            <option value =''>Select...</option>
            <option value ='Visa'>Visa</option>
            <option value ='MasterCard'>MasterCard</option>
        </select><br
        
        <label for=''>Card Number: </label>
        <input type='text' class='inputField' name='Cardnumber' /><br/>
        
        <label for=''>Expiry: </label>
        <input type='text' class='inputField' name='Month' />
        <input type='text' class='inputField' name='Year' /><br/>
        
        <label for=''>CCV: </label>
        <input type='text' class='inputField' name='CCV' /><br/>

        <input type='submit' value='Submit'>
        </fieldset>
        </form>";
    }
    
    if(isset($_POST["Cardname"]))
    {
        if($_POST["Type"] != 'Select...')
        {
            if(isset($_POST["Cardnumber"]))
            {
                if(isset($_POST["Month"]))
                {
                    if(isset($_POST["Year"]))
                    {
                        if(isset($_POST["CCV"]))
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
                            header("Refresh:0");
                        }
                    }
                }
            }
        }
        
    }
}
// Content
    include "header.php";
    echo $result;
    if(isset($content))
    {
        echo $content;
    }
    if(isset($Pay) && $Pay == 1)
    {
        echo $Payment;    
    }
    
    include "footer.php";
    
?>
