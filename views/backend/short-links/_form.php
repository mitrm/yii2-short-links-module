<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model mitrm\links\models\ShortLinks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="short-links-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-6'>
        <?= $form->field($model, 'link')->textarea(['rows' => 6]) ?>
    </div>

    <div class='col-md-6'>
        <?= $form->field($model, 'short')->textarea(['rows' => 6]) ?>
    </div>

    <div class='col-md-6'>
        <?= $form->field($model, 'count_click')->textInput() ?>
    </div>

    <div class='col-md-6'>
        <?= $form->field($model, 'table')->textInput(['maxlength' => 250]) ?>
    </div>

    <div class='col-md-6'>
        <?= $form->field($model, 'field_id')->textInput() ?>
    </div>

    <div class='col-md-6'>
        <?= $form->field($model, 'user_id')->textInput() ?>
    </div>

    <div class='col-md-6'>
        <?= $form->field($model, 'created_at')->textInput() ?>
    </div>

    <div class='col-md-6'>
        <?= $form->field($model, 'updated_at')->textInput() ?>
    </div>


    <?php if(!$model->isNewRecord):?>
        <div class="clearfix"></div>
        <div class='col-md-12  margin-top-20'>
            Дата создания: <?= date('d.m.Y H:i', $model->created_at)?>
            <br>
            Дата обновления: <?= date('d.m.Y H:i', $model->updated_at)?>
        </div>
    <?php  endif;?>
    <div class="clearfix"></div>
    <div class="form-group margin-top-20">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
