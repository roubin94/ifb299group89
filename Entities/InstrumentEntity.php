<?php

class InstrumentEntity
{
    public $number;
    public $name;
    public $Model;
    public $type;
    public $price;
    public $image;
    public $quality;
    public $availibility;

    function __construct($number, $name, $Model, $type, $price, $image, $quality, $availibility) {
        $this->number = $number;
        $this->name = $name;
        $this->Model = $Model;
        $this->type = $type;
        $this->price = $price;
        $this->image = $image;
        $this->quality = $quality;
        $this->availibility = $availibility;
    }

}

?>
