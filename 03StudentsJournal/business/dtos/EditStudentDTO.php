<?php
namespace app\business\dtos;

class EditStudentDTO {
    public $id;
    public $firstName;
    public $lastName;
    public $age;
    public $rating;

    function __construct($id, $firstName, $lastName, $age, $rating)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->rating = $rating;
    }
}