<?php
namespace app\controllers;
use app\business\services\StudentsServise;
use yii\web\Controller;
use app\models\students\StudentModel;
use yii\data\Pagination;
use Yii;

// db init
/*
    CREATE TABLE Students(
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstName VARCHAR(50) NOT NULL,
            lastName VARCHAR(50) NOT NULL,
            age INT NOT NULL DEFAULT 0,
            rating INT NOT NULL DEFAULT 0
    );
     INSERT INTO Students(firstName, lastName, age, rating)
        VALUES
        ('Igor', 'Ivanov', 27, 121),
        ('Vitya', 'Orlov', 19, 110),
        ('Vita', 'Popova', 20, 120),
        ('Oksana', 'Oleksandrova', 25, 100),
        ('Tatya', 'Siniova', 21, 119),
        ('Sveta', 'Ololova', 24, 115);
*/

class StudentsController extends Controller {
    public function actionIndex() {
        $studentsService = new StudentsServise();
        $pagination = $studentsService->getAllStudentsPagination();
        $students = $studentsService->getAllStudents();

        return $this->render('index', [
            'students' => $students,
            'pagination' => $pagination
        ]);
    }



    // Delete
    public function actionDeleteStudent($id) {
        $studentsService = new StudentsServise();
        $student = $studentsService->deleteStudent($id);

        // if $student was deleted - show a message about it on index page
        if($student) {
            Yii::$app->getSession()->setFlash('message', 'Student was removed successfully!');
            return $this->redirect(['index']);
        }
    }



    // Show
    public function actionShowStudent($id) {
        $studentsService = new StudentsServise();
        $student = $studentsService->getStudentShowModel($id);

        return $this->render('show-student', [
            'student' => $student
        ]);
    }



    // Add
    public function actionAddStudent() {
        $model = new StudentModel();
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model->load($request->post());
            if($model->validate()) {
                $studentsService = new StudentsServise();
                $studentsService->addStudent($model);
                Yii::$app->getSession()->setFlash('message', 'Student was added successfully!');
                return $this->redirect(['index']);
            }
        }
        return $this->render('change-students', [
            'student' => $model,
            'way' => 'add'
        ]);
    }



    // Edit
    public function actionEditStudent($id) {
        $studentsService = new StudentsServise();
        $student = $studentsService->getStudentEditModel($id);
        //$student = $studentsService->map()

        //$student = StudentModel::findOne($id);
        $request = Yii::$app->request;

        if ($request->isPost) {
            $student->load($request->post());
            if($student->validate()) {
                $studentsService->editStudent($student);
                Yii::$app->getSession()->setFlash('message', 'Student was edited successfully!');
                return $this->redirect(['index']);
            }
        }
        return $this->render('change-students', [
            'student' => $student,
            'way' => 'edit'
        ]);
    }
}