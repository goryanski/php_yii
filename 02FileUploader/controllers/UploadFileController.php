<?php

namespace app\controllers;

use app\business\services\FileUploaderService;
use app\models\UploadForm;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class UploadFileController extends Controller
{
    private $fileService;
    public function __construct($id, $module, FileUploaderService $fileService)
    {
        parent::__construct($id, $module);
        $this->fileService = $fileService;
    }

    public function actionIndex() {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                // file is uploaded successfully
                //$password = $_POST['password'] == '' ? '0' : $_POST['password'];
                $password = $_POST['password'];
                $expires = $_POST['expires'] == 7 || $_POST['expires'] < 1 ?  7 : $_POST['expires'];
                $newPath = $model->path;
                $fileId = $this->fileService->saveFileInfoToDb($password, $expires, $newPath);
                Yii::$app->getSession()->setFlash('message',
                    "File uploaded successfully! <a href='../upload-file/show-file?id=$fileId'>super-mega-storage.com/your-file</a>");
                return $this->redirect(['site/index']);
            }
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionShowFile($id) {
        $file = $this->fileService->getFile($id);
        if($file->password === '') {
            return $this->render('success-page');
        }
        else {
            return $this->render('check-password', ['password' => $file->password]);
        }
    }

    public function actionCheckPassword() {
          if($_POST['passwordField'] === $_POST['password'])  {
              return $this->render('success-page');
          }
          else {
              Yii::$app->getSession()->setFlash('message',
                  'Wrong password');
              return $this->render('check-password', ['password' => $_POST['password']]);
          }
    }
}