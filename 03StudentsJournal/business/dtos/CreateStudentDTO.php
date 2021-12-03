<?php
namespace app\business\dtos;

class CreateStudentDTO {
    public $firstName;
    public $lastName;
    public $age;
    public $rating;

    function __construct($firstName, $lastName, $age, $rating)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->rating = $rating;
    }
}