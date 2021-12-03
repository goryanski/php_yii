<?php
namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;
    public $path;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, txt, docx, rtf']
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->path = 'uploads/' . $this->file->baseName . '.' . $this->file->extension;
            $this->file->saveAs($this->path);
            return true;
        } else {
            return false;
        }
    }
}