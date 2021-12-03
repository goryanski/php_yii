<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <p><a class="btn btn-lg btn-success" href="../upload-file">Upload file</a></p>
    </div>

    <!--message on success action -->
    <?php if(Yii::$app->session->hasFlash('message')):?>
        <div class="alert alert-dismissible alert-success mt-3">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>
</div>
