<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$bntName = $way === 'add' ? 'Add' : 'Save';
?>

<h1 class="mt-5"><?= $way === 'add' ? 'Add' : 'Change' ?> student</h1>

<?php
    $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
    ]) ?>
    <?= $form->field($student, 'firstName') ?>
    <?= $form->field($student, 'lastName') ?>
    <?= $form->field($student, 'age')->textInput(['type' => 'number']) ?>
    <?= $form->field($student, 'rating')->textInput(['type' => 'number']) ?>
    <?php if($way === 'edit'):?>
        <?= $form->field($student, 'id')->hiddenInput()->label('') // - do not show label?>
    <?php endif;?>

    <div class="form-group">
        <?= Html::submitButton($bntName, ['class' => 'btn btn-dark']) ?>
    </div>
<?php ActiveForm::end() ?>