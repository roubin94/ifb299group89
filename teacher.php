<?php

// Page Title
$title = "Pinelands Music Academy - Teacher List";

require 'Controller/TeacherController.php';
$teacherController = new TeacherController();

if(isset($_POST['types']))
{
    //Fill page with teachers of the selected type
    $teacherTables = $teacherController->CreateTeacherTables($_POST['types']);
}
else 
{
    //Page is loaded for the first time, no type selected -> Fetch all types
    $teacherTables = $teacherController->CreateTeacherTables('%');
}

// Content
include "header.php";
echo $teacherController->CreateTeacherDropdownList(). $teacherTables;
include "footer.php";