<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model mitrm\links\models\ShortLinks */

$this->title = 'Create ';
$this->params['breadcrumbs'][] = ['label' => 'Short Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="page-title"><?= Html::encode($this->title) ?></h3>
<div class="page-bar">
    <?= \yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]);   
    ?>
</div>
<div class="portlet light short-links-create">
	<div class="portlet-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

	</div>
</div>

