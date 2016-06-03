<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel mitrm\links\models\search\ShortLinksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Short Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="page-title"><?= Html::encode($this->title) ?></h3>
<div class="portlet light short-links-index">
	<div class="portlet-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить Short Links', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'link:ntext',
            'token:ntext',
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


