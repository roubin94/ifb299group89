<?php
    session_start();

    // Page Title
    $title = "PMA - Instrument Catalogue";

    // Defining variables and setting them to be empty.
    $result = '';
    $content = '';
    
    require './Controller/InstrumentController.php';

    if(isset($_GET["num"]))
    {
        // Check if logged in as student before proceeding.
        if (!isset($_SESSION['student_id'])) {
            $content = 'You must be logged in as a student to hire an instrument.';
        }
        
        else {    
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
                                    <th style = 'text-align:right'>Availability: </th>
                                    <td>$instrument->availibility</td>
                                </tr>
                             </table>";

            if($instrument->availibility == "available")
            {
                $content ="<form action='' method='post'>
                <fieldset>
                <legend>Hire This Instrument</legend>

                <p>Hire Duration (Months)<br/>
                <input type='text' class='inputField' name='duration' /><p>

                <input type='submit' value='Next'>
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

                $content ="<form action='' method='post'>
                <fieldset>
                <legend>Hire This Instrument</legend>

                <p><b>Total Price:</b> $$total</p>

                <p>Please enter your credit card details below.</p>

                <p>Cardholder's Name<br />
                <input type='text' class='inputField' name='Cardname' /></p>

                <p>Card Type<br />
                <select name='Type'>
                    <option value =''>Select...</option>
                    <option value ='Visa'>Visa</option>
                    <option value ='MasterCard'>MasterCard</option>
                </select></p>

                <p>Card Number<br />
                <input type='text' class='inputField' name='Cardnumber' /></p>

                <p>Expiry Date (Month, Year)<br />
                <input type='text' class='inputField' name='Month' />
                <input type='text' class='inputField' name='Year' /></p>

                <p>Security Code (CVV)<br />
                <input type='text' class='inputField' name='CCV' /></p>

                <input type='submit' value='Hire'>
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
    }

    // Redirect to instrument catalogue if an instrument has not been selected.
    else {
        header("location: instruments.php");
    }

    // Content
    include "header.php";
    
    echo $result;
    echo $content;
    
    include "footer.php";