<?php
use app\widgets\StudentCardWidget;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<?php StudentCardWidget::begin([
    'firstName' => $student->firstName,
    'lastName' => $student->lastName,
    'age' => $student->age,
    'rating' => $student->rating,
    'theme' => 'special'
    //'theme' => 'default'
]);
?>
<div class="text-center mt-5">
    <?= Html::a('Show other students', Url::to('@web/students/index', true),  ['class' => 'btn btn-dark']) ?>
</div>
<?php StudentCardWidget::end(); ?>
