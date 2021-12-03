<?php
namespace app\api\modules\v1\repositories;
use app\api\modules\v1\models\Group;
use app\api\modules\v1\models\Student;
use app\api\modules\v1\repositories\interfaces\IStudentsRepository;
use yii\debug\models\search\Db;

class StudentsRepository implements IStudentsRepository
{
    /**
     * @return Student[]
     */
    public function getAllStudentsFullInfo()
    {
        return Student::findBySql(
            'SELECT s.id, s.firstName, s.lastName, s.age, s.rating, s.groupId, g.id as idGroup, g.name 
                 FROM students as s
                 JOIN `groups` as g
                 ON g.id = s.groupId;'
        )->all();
    }

    public function deleteStudent($id)
    {
        return Student::findOne($id)->delete();
    }

    public function getGroups()
    {
        return Group::find()->all();
    }

    public function getGroupId($groupName)
    {
        return Group::findBySql(
            "SELECT g.id
                 FROM `groups` as g
                 WHERE g.name = '$groupName'"
        )->one();
    }

    public function addStudent($firstName, $lastName, $age, $rating, $groupId)
    {
        $student = new Student();
        $student->firstName = $firstName;
        $student->lastName = $lastName;
        $student->age = $age;
        $student->rating = $rating;
        $student->groupId = $groupId;
        $student->save();
    }

    public function getGroupName(int $groupId)
    {
        return Group::findOne($groupId);
    }

    public function GetStudent($id)
    {
        return Student::findOne($id);
    }
}
