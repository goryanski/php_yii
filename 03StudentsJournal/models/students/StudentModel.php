<?php
namespace app\models\students;
use yii\db\ActiveRecord;

class StudentModel extends ActiveRecord {
    public $id;
    public $firstName;
    public $lastName;
    public $age;
    public $rating;

//    public static function tableName()
//    {
//        return 'students';
//    }


    public function rules()
    {
        return [
            [['firstName', 'lastName', 'age', 'rating'], 'required'],
            ['firstName', 'match', 'pattern' => '/^[a-zA-Z]{3,16}$/', 'message' => 'FirstName must be 3-16 symbols, English language, only letters'],
            ['lastName', 'match', 'pattern' => '/^[a-zA-Z]{3,16}$/', 'message' => 'LastName must be 3-16 symbols, English language, only letters'],
            ['age', 'integer', 'max' => 60, 'min' => 16],
            ['rating', 'integer', 'max' => 1000, 'min' => 0]
        ];
    }
}