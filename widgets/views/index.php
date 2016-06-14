<?php

use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * @var $this \yii\web\View;
 */

?>


<?php Modal::begin([
     'header' => 'Укоротить ссылку',
     'toggleButton' => $toggleButton,
 ]); ?>

<form action="<?= Url::toRoute(['/short_link/short-links/new'])?>" method="post" class="js_short_link_form">
    <div class="row">
        <div class="col-md-6">
            <?= Html::input('text', 'title', '' ,['class' => 'form-control', 'placeholder' => 'Название'])?>
        </div>
        <div class="col-md-6">
            <?= Html::input('text', 'link', '' ,['class' => 'form-control', 'placeholder' => 'Ссылка'])?>
        </div>
    </div>
    <div class="clearfix" style="margin-top: 15px;"></div>
    <div class="clearfix" style="margin-top: 15px;"></div>
    <div class="4">
        <?= Html::submitButton('Отправить', ['class' => 'js_short_link_form_submit pull-right btn btn-primary'])?>
    </div>
    <div class="clearfix"></div>
    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken)?>
</form>

<div class="js_short_link_content" style="display: none; margin-top: 30px;">
    <?= Html::input('textarea', 'short_link', '' ,['class' => 'form-control js_short_link_result', 'placeholder' => 'Короткая ссылка'])?>
</div>


<?php Modal::end();?>
