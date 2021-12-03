<?php
namespace app\api\modules\v1\controllers;
use app\api\modules\v1\business\services\StudentsService;
use app\api\modules\v1\models\Student;
use app\api\modules\v1\repositories\StudentsRepository;
use phpDocumentor\Reflection\Types\Object_;
use yii\rest\ActiveController;

class StudentsController extends ActiveController
{
    private $studentsService;
    public function __construct($id, $module, StudentsService $studentsService)
    {
        parent::__construct($id, $module);
        $this->studentsService = $studentsService;
    }

    public $modelClass = 'app\api\modules\v1\models\Student';
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['delete'], $actions['create'], $actions['update']);
        return $actions;
    }

    // watch url rules: config/web.php => urlManager/rules

    // GET http://localhost/10/Practice10/Api/Practice/web/api/v1/students
    public function actionIndex() {
        return $this->studentsService->getAllStudentsFullInfo();
    }


    // DELETE http://localhost/10/Practice10/Api/Practice/web/api/v1/students?id=1
    public function actionDelete($id) {
        return $this->studentsService->deleteStudent($id);
    }


    // GET http://localhost/10/Practice10/Api/Practice/web/api/v1/students/groups
    public function actionGroups(): array
    {
        return $this->studentsService->getGroups();
    }


    // POST http://localhost/10/Practice10/Api/Practice/web/api/v1/students/add?firstName=model1&lastName=model2&age=22&rating=22&groupName=groupName1
    public function actionAdd($firstName, $lastName, $age, $rating, $groupName)
    {
        $this->studentsService->addStudent($firstName, $lastName, $age, $rating, $groupName);
    }


    // GET http://localhost/10/Practice10/Api/Practice/web/api/v1/students/getOne?id=2
    public function actionGet($id) {
        return $this->studentsService->GetStudent($id);
    }

    // POST http://localhost/10/Practice10/Api/Practice/web/api/v1/students/edit?id=11&firstName=model1&lastName=model2&age=22&rating=22&groupName=EE119
    public function actionEdit($id, $firstName, $lastName, $age, $rating, $groupName)
    {
        $this->studentsService->editStudent($id, $firstName, $lastName, $age, $rating, $groupName);
    }
}