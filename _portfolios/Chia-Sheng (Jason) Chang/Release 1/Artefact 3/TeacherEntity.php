<?php

class TeacherEntity
{
    public $teacher_id;
    public $name;
    public $gender;
    public $age;
    public $language;
    public $type;
    public $instrument;
    public $email;
    public $availability;
    public $image;
    
    function __construct($teacher_id, $name, $gender, $age, $language, $type, $instrument, $email, $availbility, $image) {
        $this->teacher_id = $teacher_id;
        $this->name = $name;
        $this->gender = $gender;
        $this->age = $age;
        $this->language = $language;
        $this->type = $type;
        $this->instrument = $instrument;
        $this->email = $email;
        $this->availability = $availbility;
        $this->image = $image;
    }   
}

?>
