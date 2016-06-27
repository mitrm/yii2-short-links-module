<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel mitrm\links\models\search\ShortLinksClickSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клики по коротким ссылкам';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="page-title"><?= Html::encode($this->title) ?></h3>
<div class="portlet light short-links-click-index">
	<div class="portlet-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['width' => '80px'],
            ],
            [
                'attribute' => 'short_links_id',
                'options' => ['width' => '150px'],
                'format' => 'html',
                'value' => function ($model) {
                    return $model->shortLinks->link;
                },
            ],
            [
                'attribute' => 'created_at',
                'options' => ['width' => '150px'],
                'value' => function ($model) {
                    return date('d.m.Y H:i', $model->created_at);
                },
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'dateFormat' => 'php:d.m.Y',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ]),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

	</div>
</div>


