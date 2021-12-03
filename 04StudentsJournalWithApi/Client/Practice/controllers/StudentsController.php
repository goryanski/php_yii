<?php
namespace app\controllers;
use app\business\services\StudentsService;
use app\models\students\StudentModel;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class StudentsController extends Controller {
    private $studentsService;
    public function __construct($id, $module, StudentsService $studentsService)
    {
        parent::__construct($id, $module);
        $this->studentsService = $studentsService;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'show-student', 'delete-student', 'add-student', 'edit-student'],
                'rules' => [
                    [
                        'actions' => ['index',  'show-student'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => ['index', 'show-student', 'delete-student', 'add-student', 'edit-student'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ]
        ];
    }

    public function actionIndex() {
        $students = $this->studentsService->getAllStudents();
        return $this->render('index', [
            'students' => $students
        ]);
    }


    // Delete
    public function actionDeleteStudent($id) {
        $student = $this->studentsService->deleteStudent($id);
        if($student) {
            Yii::$app->getSession()->setFlash('message', 'Student was removed successfully!');
            return $this->redirect(['index']);
        }
    }


    // Add
    public function actionAddStudent() {
        $model = new StudentModel(0, '', '', 0, 0, '');
        $groups = $this->getGroups();
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model->load($request->post());
            if($model->validate()) {
                $model->groupName = $_POST['groupName'];
                $this->studentsService->addStudent($model);
                Yii::$app->getSession()->setFlash('message', 'Student was added successfully!');
                return $this->redirect(['index']);
            }
        }
        return $this->render('change-students', [
            'student' => $model,
            'groups' => $groups,
            'way' => 'add'
        ]);
    }


    // Edit
    public function actionEditStudent($id) {
        $student =  $this->studentsService->getStudentFullInfo($id);
        $groups = $this->getGroups();
        $request = Yii::$app->request;

        if ($request->isPost) {
            $student->load($request->post());
            if($student->validate()) {
                $this->studentsService->editStudent($student);
                Yii::$app->getSession()->setFlash('message', 'Student was edited successfully!');
                return $this->redirect(['index']);
            }
        }
        return $this->render('change-students', [
            'student' => $student,
            'groups' => $groups,
            'way' => 'edit'
        ]);
    }


    // Show
    public function actionShowStudent($id) {
        $student =  $this->studentsService->getStudentFullInfo($id);

        return $this->render('show-student', [
            'student' => $student
        ]);
    }

    private function getGroups() {
        $groups =  $this->studentsService->getGroups();
        $names = [];
        foreach ($groups as $group) {
            $name = $group->name;
            array_push($names, $name);
        }
        return $names;
    }
}