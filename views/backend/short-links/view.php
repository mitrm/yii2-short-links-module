<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model mitrm\links\models\ShortLinks */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Short Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="page-title"><?= Html::encode($this->title) ?></h3>
 <div class="page-bar">
    <?         echo \mitrm\metronic\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]);   
    ?>
</div>
<div class="portlet light short-links-view">
	<div class="portlet-body">
   

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'link:ntext',
            'short:ntext',
            'count_click',
            'table',
            'field_id',
            'user_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>
	</div>
</div>

