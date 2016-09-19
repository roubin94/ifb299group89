<?php

require ("Entities/TeacherEntity.php");

//Contains database related code for the Teacher page.
class TeacherModel {

    //Get all teacher types from the database and return them in an array.
    function GetTeacherTypes() {
        require 'Credentials.php';

        //Open connection and Select database.   
        $link = mysqli_connect($host, $user, $passwd) or die(mysql_error());
        mysqli_select_db($link, $database);
        $result = mysqli_query($link, "SELECT DISTINCT type FROM teachers") or die(mysql_error());
        $types = array();

        //Get data from database.
        while ($row = mysqlI_fetch_array($result)) {
            array_push($types, $row[0]);
        }

        //Close connection and return result.
        mysqli_close($link);
        return $types;
    }

    //Get teacherEntity objects from the database and return them in an array.
    function GetTeacherByType($type) {
        require 'Credentials.php';

        //Open connection and Select database.     
        $link = mysqli_connect($host, $user, $passwd) or die(mysql_error);
        mysqli_select_db($link, $database);

        $query = "SELECT * FROM teachers WHERE type LIKE '$type'";
        $result = mysqli_query($link, $query) or die(mysql_error());
        $teacherArray = array();

        //Get data from database.
        while ($row = mysqli_fetch_array($result)) {
            $name = $row[1];
            $gender = $row[2];
            $age = $row[3];
            $language = $row[4];
            $type = $row[5];
            $instrument = $row[6];
            $email = $row[7];
            $availbility = $row[8];
            $image = $row[9];

            //Create teacher objects and store them in an array.
            $teacher = new TeacherEntity(-1, $name, $gender, $age, $language, $type, $instrument, $email, $availbility, $image);
            array_push($teacherArray, $teacher);
        }
        //Close connection and return result
        mysqli_close($link);
        return $teacherArray;
    }

}

?>
