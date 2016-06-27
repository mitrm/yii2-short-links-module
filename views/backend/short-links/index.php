<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel mitrm\links\models\search\ShortLinksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Короткие ссылки';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="page-title"><?= Html::encode($this->title) ?></h3>
<div class="portlet light short-links-index">
	<div class="portlet-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            [
                'attribute' => 'link',

                'options' => ['width' => '150px'],
                'format' => 'html',
                'value' => function ($model) {
                    return substr ($model->link, 0,50) . ' ...';
                },
            ],
            [
                'attribute' => 'link',
                'label' => 'Короткая ссылка',
                'options' => ['width' => '150px'],
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a('http://'.Yii::$app->getModule('short_link')->domain.'/l/'.$model->token, 'http://'.Yii::$app->getModule('short_link')->domain.'/l/'.$model->token);
                },
            ],
            'count_click',
            //'table',
            // 'field_id',
            // 'user_id',
            'created_at:dateTime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

	</div>
</div>


