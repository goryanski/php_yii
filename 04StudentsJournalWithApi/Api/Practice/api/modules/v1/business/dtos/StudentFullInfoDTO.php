<?php
namespace app\api\modules\v1\business\dtos;

class StudentFullInfoDTO
{
    public $id;
    public $firstName;
    public $lastName;
    public $age;
    public $rating;
    public $groupName;

    function __construct($id, $firstName, $lastName, $age, $rating, $groupName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->rating = $rating;
        $this->groupName = $groupName;
    }
}