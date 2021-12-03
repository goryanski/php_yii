<?php
namespace app\api\modules\v1\models;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property int $age
 * @property int $rating
 * @property int $groupId
 * @property Group $group
 */
class Student extends ActiveRecord
{
    public static function tableName()
    {
        return 'students';
    }
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'age', 'rating', 'groupId'], 'required']
        ];
    }

//    public function getGroup()
//    {
//        return $this->hasOne(Group::class, ['groupId' => 'idGroup']);
//    }
}