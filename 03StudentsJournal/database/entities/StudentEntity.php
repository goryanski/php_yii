<?php

namespace app\database\entities;
use yii\db\ActiveRecord;

class StudentEntity extends ActiveRecord {
    /**
     * This is the model class for table "students".
     *
     * @property int $id
     * @property string $firstName
     * @property string $lastName
     * @property int $age
     * @property int $rating
     */
    public static function tableName()
    {
        return 'students';
    }
}