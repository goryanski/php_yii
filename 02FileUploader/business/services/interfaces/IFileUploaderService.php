<?php
namespace app\business\services\interfaces;

interface IFileUploaderService
{
    public function saveFileInfoToDb($password, $expires, $path);
}