<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model mitrm\links\models\ShortLinks */

$this->title = 'Редактирование: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Короткие ссылки', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>

<h3 class="page-title"><?= Html::encode($this->title) ?></h3>
<div class="page-bar">
    <?= \yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]);   
    ?>
</div>
<div class="portlet light short-links-update">
	<div class="portlet-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

	</div>
</div>


