<?php
namespace app\business\services;

use app\business\services\interfaces\IFileUploaderService;
use app\models\FileModel;

class FileUploaderService implements IFileUploaderService
{
    public function saveFileInfoToDb($password, $expires, $path)
    {
        $file = new FileModel();
        $file->password = $password;
        $file->expires = $expires;
        $file->path = $path;
        $file->save();
        return $file->id;
    }

    public function getFile($id)
    {
        return FileModel::findOne($id);
    }
}