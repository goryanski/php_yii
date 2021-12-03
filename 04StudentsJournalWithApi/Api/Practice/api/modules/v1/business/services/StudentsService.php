<?php
namespace app\api\modules\v1\business\services;
use app\api\modules\v1\business\dtos\StudentFullInfoDTO;
use app\api\modules\v1\business\services\interfaces\IStudentsService;
use app\api\modules\v1\repositories\StudentsRepository;

class StudentsService implements IStudentsService
{
    private $studentsRepository;
    public function __construct(StudentsRepository $studentsRepository)
    {
        $this->studentsRepository = $studentsRepository;
    }
    public function getAllStudentsFullInfo()
    {
        $students = $this->studentsRepository->getAllStudentsFullInfo();

        $studentsDTO = [];
        foreach ($students as $student) {
            //$group11 = $student->groupId;
            $group = $this->studentsRepository->getGroupName($student->groupId);
            $studentDTO = new StudentFullInfoDTO(
                $student->id,
                $student->firstName,
                $student->lastName,
                $student->age,
                $student->rating,
                $group->name
            );
            array_push($studentsDTO, $studentDTO);
        }
        return $studentsDTO;
    }

    // Delete
    public function deleteStudent($id) {
        return $this->studentsRepository->deleteStudent($id);
    }

    public function getGroups()
    {
        return $this->studentsRepository->getGroups();
    }

    public function addStudent($firstName, $lastName, $age, $rating, $groupName)
    {
        $groupId = $this->studentsRepository->getGroupId($groupName)->primaryKey;
        $this->studentsRepository->addStudent($firstName, $lastName, $age, $rating, $groupId);
    }

    public function GetStudent($id)
    {
        $studentEntity = $this->studentsRepository->GetStudent($id);
        $group = $this->studentsRepository->getGroupName($studentEntity->groupId);
        $studentDTO = new StudentFullInfoDTO(
            $studentEntity->id,
            $studentEntity->firstName,
            $studentEntity->lastName,
            $studentEntity->age,
            $studentEntity->rating,
            $group->name
        );
        return $studentDTO;
    }

    public function editStudent($id, $firstName, $lastName, $age, $rating, $groupName)
    {
        $groupId = $this->studentsRepository->getGroupId($groupName)->primaryKey;
        $studentEntity = $this->studentsRepository->GetStudent($id);
        $studentEntity->firstName = $firstName;
        $studentEntity->lastName = $lastName;
        $studentEntity->age = $age;
        $studentEntity->rating = $rating;
        $studentEntity->groupId = $groupId;
        $studentEntity->save();
    }
}