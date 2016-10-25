<?php

class hireEntity
{
    public $application_id;
    public $firstname;
    public $lastname;
    public $address1;
    public $address2;
    public $state;
    public $postcode;
    public $phonenumber;
    public $email;
    public $citizen;
    public $application;
    
    function __construct($application_id, $firstname, $lastname, $address1, $address2, $state, $postcode, $phonenumber, $email, $citizen, $application) {
        $this->application_id = $application_id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->state = $state;
        $this->postcode = $postcode;
        $this->phonenumber = $phonenumber;
        $this->email = $email;
        $this->citizen = $citizen;
        $this->application = $application;
    }

}

?>
