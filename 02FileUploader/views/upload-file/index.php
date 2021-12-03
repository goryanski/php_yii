<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <label for="passwordInput">Password (is not necessary)</label>
    <input type="text" name="password" class="form-control" id="passwordInput" aria-describedby="emailHelp" placeholder="Enter password">
    <label for="expiresInput" class="mt-3">Expires (count days. default = 7)</label>
    <input type="number" name="expires" class="form-control" id="expiresInput" aria-describedby="emailHelp" value="7">

    <button class="btn btn-dark mt-3">Upload</button>

<?php ActiveForm::end() ?>