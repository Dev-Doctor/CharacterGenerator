<?php
class Gender {
    private $gender;

    function __construct() {
        $this->gender = rand(0, 1);
      }

    function GetGenderNumber() {
        return $this->gender;
    }

    function SetGender($gn) {
        $this->gender = $gn;
    }

    function GetGender() {
        if($this->gender) {
            return "male";
        } 
        return "female";
    }
}
