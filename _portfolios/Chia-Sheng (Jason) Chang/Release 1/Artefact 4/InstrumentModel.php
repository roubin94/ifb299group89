<?php

require ("Entities/InstrumentEntity.php");

//Contains database related code for the Instrument page.
class InstrumentModel {

    //Get all instrument types from the database and return them in an array.
    function GetInstrumentTypes() {
        require 'Credentials.php';

        //Open connection and Select database.   
        $link = mysqli_connect($host, $user, $passwd) or die(mysql_error());
        mysqli_select_db($link, $database_a);
        $result = mysqli_query($link, "SELECT DISTINCT type FROM instruments") or die(mysql_error());
        $types = array();

        //Get data from database.
        while ($row = mysqlI_fetch_array($result)) {
            array_push($types, $row[0]);
        }

        //Close connection and return result.
        mysqli_close($link);
        return $types;
    }

    //Get instrumentEntity objects from the database and return them in an array.
    function GetInstrumentByType($type) {
        require 'Credentials.php';

        //Open connection and Select database.     
        $link = mysqli_connect($host, $user, $passwd) or die(mysql_error);
        mysqli_select_db($link, $database_a);

        $query = "SELECT * FROM instruments WHERE type LIKE '$type'";
        $result = mysqli_query($link, $query) or die(mysql_error());
        $instrumentArray = array();

        //Get data from database.
        while ($row = mysqli_fetch_array($result)) {
            $number = $row[0];
            $name = $row[1];
            $Model = $row[2];
            $type = $row[3];
            $price = $row[4];
            $image = $row[5];
            $quality = $row[6];;

            //Create instrument objects and store them in an array.
            $instrument = new InstrumentEntity($number, $name, $Model, $type, $price, $image, $quality);
            array_push($instrumentArray, $instrument);
        }
        //Close connection and return result
        mysqli_close($link);
        return $instrumentArray;
    }
    
    function GetInstrumentById($number)
    {
        require 'Credentials.php';

        //Open connection and Select database.     
        $link = mysqli_connect($host, $user, $passwd) or die(mysql_error);
        mysqli_select_db($link, $database_a);

        $query = "SELECT * FROM instruments WHERE number = $number";
        $result = mysqli_query($link, $query) or die(mysql_error());

        //Get data from database.
        while ($row = mysqli_fetch_array($result)) {
            $name = $row[1];
            $Model = $row[2];
            $type = $row[3];
            $price = $row[4];
            $image = $row[5];
            $quality = $row[6];;

            //Create instrument objects and store them in an array.
            $instrument = new InstrumentEntity($number, $name, $Model, $type, $price, $image, $quality);
        }
        //Close connection and return result
        mysqli_close($link);
        return $instrument;
    }
    
    function InsertInstrument(InstrumentEntity $instrument) {
        require 'Credentials.php';

        //Open connection and Select database.     
        $link = mysqli_connect($host, $user, $passwd) or die(mysql_error);
        $query = sprintf("INSERT INTO instruments
                          (name,Model,type, price,image,quality)
                          VALUES
                          ('%s','%s','%s','%s','%s','%s')",
                mysqli_real_escape_string($link,$instrument->name),
                mysqli_real_escape_string($link,$instrument->Model),
                mysqli_real_escape_string($link,$instrument->type),
                mysqli_real_escape_string($link,$instrument->price),
                mysqli_real_escape_string($link,"Images/instruments/" . $instrument->image),
                mysqli_real_escape_string($link,$instrument->quality));
        $this->PerformQuery($query);
    }
    
    function UpdateInstrument($number, InstrumentEntity $instrument) {
        require 'Credentials.php';

        //Open connection and Select database.     
        $link = mysqli_connect($host, $user, $passwd) or die(mysql_error);
        $query = sprintf("UPDATE instruments
                            SET name = '%s', Model = '%s', type = '%s', price = '%s',
                            image = '%s', quality = '%s'
                          WHERE number = $number",
                mysqli_real_escape_string($link,$instrument->name),
                mysqli_real_escape_string($link,$instrument->Model),
                mysqli_real_escape_string($link,$instrument->type),
                mysqli_real_escape_string($link,$instrument->price),
                mysqli_real_escape_string($link,"Images/instruments/" . $instrument->image),
                mysqli_real_escape_string($link,$instrument->quality));
                $this->PerformQuery($query);
    }
    
    function DeleteInstrument($number)
    {
        $query ="DELETE FROM instruments WHERE number = $number";
        $this->PerformQuery($query);
    }
    
    function PerformQuery($query)
    {
        //Open connection and select database.
        require('Credentials.php');
        $link = mysqli_connect($host, $user, $passwd) or die(mysql_error);
        mysqli_select_db($link, $database_a);
        
        //Execute query and close connection
        mysqli_query($link, $query) or die(mysql_error());
        mysqli_close($link);
    }
}

?>
