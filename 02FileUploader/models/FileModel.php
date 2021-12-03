<?php
namespace app\models;
use yii\db\ActiveRecord;

/* DB init
CREATE TABLE files (
	id INT AUTO_INCREMENT PRIMARY KEY,
    path VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    expires INT NOT NULL DEFAULT 0
);
*/

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property string $path
 * @property string $password
 * @property int $expires
 */
class FileModel extends ActiveRecord
{
    public static function tableName()
    {
        return 'files';
    }
}