<?php
namespace app\api\modules\v1;

//db init:
/*
CREATE TABLE Students(
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    age INT NOT NULL DEFAULT 0,
    rating INT NOT NULL DEFAULT 0,
    groupId INT NOT NULL DEFAULT 0
);
CREATE TABLE Groups(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);
INSERT INTO Groups(name)
   VALUES
   ('PV-303'), ('DD-11'), ('REW-12'), ('EE-119');
INSERT INTO Students(firstName, lastName, age, rating, groupId)
   VALUES
   ('Igor', 'Ivanov', 27, 121, 1),
   ('Vitya', 'Orlov', 19, 110, 2),
   ('Vita', 'Popova', 20, 120, 3),
   ('Oksana', 'Oleksandrova', 25, 100, 4),
   ('Tatya', 'Siniova', 21, 119, 1),
   ('Sveta', 'Ololova', 24, 115, 2);
*/
class Module extends \yii\base\Module
{
    public $defaultController = 'students';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\api\modules\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}