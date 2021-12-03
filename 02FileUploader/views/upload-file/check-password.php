<?php use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


<!--message on wrong password -->
<?php if(Yii::$app->session->hasFlash('message')):?>
    <div class="alert alert-dismissible alert-danger mt-3">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo Yii::$app->session->getFlash('message');?>
    </div>
<?php endif;?>


<form method="post" action="check-password">
    <label class="mt-3" for="passwordInput">This file is under protection! Enter your secret password: </label>
    <input type="text" name="passwordField" class="form-control" id="passwordInput" aria-describedby="emailHelp" placeholder="Enter password">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <input type="hidden" name="password" value="<?= $password ?>">

    <button type="submit" class="btn btn-dark mt-3">Check</button>
</form>


