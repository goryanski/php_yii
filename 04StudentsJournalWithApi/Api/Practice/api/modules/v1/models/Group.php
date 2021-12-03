<?php
namespace app\api\modules\v1\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "students".
 *
 * @property int $idGroup
 * @property string $name
 * @property Student[] $students
 */
class Group extends ActiveRecord
{
    public static function tableName()
    {
        return 'groups';
    }
//    public function getStudents()
//    {
//        return $this->hasMany(Student::class, ['id' => 'studentId']);
//    }
}