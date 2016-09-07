<?php

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

//Output page data
$title = "Pinelands Music School - Teacher List";
$content = $teacherController->CreateTeacherDropdownList(). $teacherTables;

include 'Template.php';
?>
