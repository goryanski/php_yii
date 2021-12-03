<?php
namespace app\api\modules\v1\repositories\interfaces;

interface IStudentsRepository
{
    public function getAllStudentsFullInfo();
    public function deleteStudent($id);
}