<?php
namespace app\database\repositories;

//use app\models\students\StudentModel;
use app\business\dtos\CreateStudentDTO;
use app\business\dtos\EditStudentDTO;
use app\database\entities\StudentEntity;


class StudentsRepository {
    public function getAllStudentsQuery() {
        return StudentEntity::find();
    }
    public function deleteStudent($id) {
        return StudentEntity::findOne($id)->delete();
    }
    public function getStudent($id) {
        return StudentEntity::findOne($id);
    }
    public function addStudent(CreateStudentDTO $student) {
        $studentEntity = new StudentEntity();
        $studentEntity->firstName = $student->firstName;
        $studentEntity->lastName = $student->lastName;
        $studentEntity->age = $student->age;
        $studentEntity->rating = $student->rating;
        $studentEntity->save();
    }

    public function editStudent(EditStudentDTO $studentDTO)
    {
        $studentEntity = StudentEntity::findOne($studentDTO->id);
        $studentEntity->firstName = $studentDTO->firstName;
        $studentEntity->lastName = $studentDTO->lastName;
        $studentEntity->age = $studentDTO->age;
        $studentEntity->rating = $studentDTO->rating;
        $studentEntity->save();
    }
}