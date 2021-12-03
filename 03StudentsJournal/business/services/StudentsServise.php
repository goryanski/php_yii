<?php
namespace app\business\services;
use app\business\dtos\CreateStudentDTO;
use app\business\dtos\EditStudentDTO;
use app\business\dtos\StudentDTO;
use app\database\repositories\StudentsRepository;
use app\models\students\StudentModel;
use yii\data\Pagination;

class StudentsServise {
    // for actionIndex
    public function getAllStudentsQuery() {
        $studentRepository = new StudentsRepository;
        return $studentRepository->getAllStudentsQuery();
    }
    public function getAllStudentsPagination() {
        $query = $this->getAllStudentsQuery();
        return new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
    }
    public function getAllStudents() {
        $query = $this->getAllStudentsQuery();
        $pagination = $this->getAllStudentsPagination();

        $students = $query->orderBy('lastName')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $studentsDTO = [];
        foreach ($students as $student) {
            $studentsDTO[] = new StudentDTO($student->id, $student->firstName, $student->lastName, $student->age, $student->rating);
        }
        return $studentsDTO;
    }



    // Delete
    public function deleteStudent($id) {
        $studentRepository = new StudentsRepository;
        return $studentRepository->deleteStudent($id);
    }


    // show
    public function getStudentShowModel($id) {
        $studentRepository = new StudentsRepository;
        $student = $studentRepository->getStudent($id);
        $studentDto = new StudentDTO($student->id, $student->firstName, $student->lastName, $student->age, $student->rating);
        return $this->convertShowDtoToModel($studentDto);
    }


    // edit
    public function getStudentEditModel($id) {
        $studentRepository = new StudentsRepository;
        $student = $studentRepository->getStudent($id);
        $studentDto = new EditStudentDTO($student->id, $student->firstName, $student->lastName, $student->age, $student->rating);
        return $this->convertEditDtoToModel($studentDto);
    }
    public function editStudent(StudentModel $student)
    {
        $studentDTO = new EditStudentDTO($student->id, $student->firstName, $student->lastName, $student->age, $student->rating);
        $studentRepository = new StudentsRepository;
        $studentRepository->editStudent($studentDTO);
    }



    // add
    public function addStudent(StudentModel $student) {
        $studentDTO = new CreateStudentDTO($student->firstName, $student->lastName, $student->age, $student->rating);
        $studentRepository = new StudentsRepository;
        $studentRepository->addStudent($studentDTO);
    }




    // map
    private function convertShowDtoToModel(StudentDTO $studentDto) {
        $model = new StudentModel();
        $model->firstName = $studentDto->firstName;
        $model->lastName = $studentDto->lastName;
        $model->age = $studentDto->age ;
        $model->rating = $studentDto->rating;
        return $model;
    }
    private function convertEditDtoToModel(EditStudentDTO $studentDto) {
        $model = new StudentModel();
        $model->id = $studentDto->id;
        $model->firstName = $studentDto->firstName;
        $model->lastName = $studentDto->lastName;
        $model->age = $studentDto->age ;
        $model->rating = $studentDto->rating;
        return $model;
    }
}
