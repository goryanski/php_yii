<?php
namespace app\business\services;
use app\business\dtos\CreateStudentDTO;
use app\business\dtos\EditStudentDTO;
use app\business\dtos\StudentDTO;
use app\business\services\interfaces\IStudentsService;
use app\database\repositories\StudentsRepository;
use app\models\students\GroupModel;
use app\models\students\StudentModel;
use yii\httpclient\Client;

class StudentsService implements IStudentsService{
    public function getAllStudents() {
        $data = [];
        $client = new Client();
        // set httpclient before (composer.json:21)
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('http://localhost/10/Practice10/Api/Practice/web/api/v1/students')
            ->send();

        if ($response->isOk) {
            $data = $response->data;
        }
        $studentModels = [];
        foreach ($data as $info) {
              $studentModel = new StudentModel(
                  $info['id'],
                  $info['firstName'],
                  $info['lastName'],
                  $info['age'],
                  $info['rating'],
                  $info['groupName']
              );
              array_push($studentModels, $studentModel);
        }
        return $studentModels;
    }

    // Delete
    public function deleteStudent($id) {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('DELETE')
            ->setUrl("http://localhost/10/Practice10/Api/Practice/web/api/v1/students?id=$id")
            ->send();

        return $response->data;
    }

    public function getGroups()
    {
        $data = [];
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl("http://localhost/10/Practice10/Api/Practice/web/api/v1/students/groups")
            ->send();

        if ($response->isOk) {
            $data = $response->data;
        }
        if(count($data) > 0) {
            $groups = [];
            foreach ($data as $info) {
                $group = new GroupModel($info['id'], $info['name']);
                array_push($groups, $group);
            }
            return $groups;
        }

        return $data;
    }

    public function addStudent(StudentModel $model)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl("http://localhost/10/Practice10/Api/Practice/web/api/v1/students/add?firstName=$model->firstName&lastName=$model->lastName&age=$model->age&rating=$model->rating&groupName=$model->groupName")
            ->send();
    }

    public function getStudentFullInfo($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl("http://localhost/10/Practice10/Api/Practice/web/api/v1/students/getOne?id=$id")
            ->send();

        $data =  $response->data;
        $studentModel = new StudentModel($data['id'], $data['firstName'], $data['lastName'],$data['age'], $data['rating'], $data['groupName']);
        return $studentModel;
    }

    public function editStudent(StudentModel $model)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl("http://localhost/10/Practice10/Api/Practice/web/api/v1/students/edit?id=$model->id&firstName=$model->firstName&lastName=$model->lastName&age=$model->age&rating=$model->rating&groupName=$model->groupName")
            ->send();
    }
}
