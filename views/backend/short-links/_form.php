<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mitrm\links\models\ShortLinksClick;

/* @var $this yii\web\View */
/* @var $model mitrm\links\models\ShortLinks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="short-links-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-6'>
        <?= $form->field($model, 'title')->textInput(['rows' => 6]) ?>
    </div>


    <div class='col-md-6'>
        <?= $form->field($model, 'token')->textInput(['rows' => 6]) ?>
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
        <?= $form->field($model, 'link')->textarea(['rows' => 6]) ?>
    </div>

    <?php if(!$model->isNewRecord):?>
        <div class="clearfix"></div>
        <div class='col-md-12  margin-top-20'>
            Ссылка: <?= Html::a('http://'.Yii::$app->getModule('short_link')->domain.'/l/'.$model->token, 'http://'.Yii::$app->getModule('short_link')->domain.'/l/'.$model->token);?>
            <br>
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

<?php if(!$model->isNewRecord):?>
    <?php
    $clicks = (new \yii\db\Query())
        ->select(['DATE_FORMAT(FROM_UNIXTIME(`created_at`), \'%d.%m.%Y\') AS `date`, COUNT(*) as `count_click`'])
        ->from(ShortLinksClick::tableName())
        ->indexBy('date')
        ->groupBy("date")
        ->orderBy('created_at')
        ->all();

    if($clicks) {

        foreach($clicks as $day => $click) {
            $temp = '';
            $temp['date'] = $day;
            $temp['click'] = empty($click['count_click']) ? 0 : $click['count_click'];
            $dataProvider[] = $temp;
        }

        $graphs = [
            [
                'balloonText' => '<span>Переходов: <b>[[value]]</b></span>',
                'title' => 'Переходов',
                'valueField' => 'click',
                'bulletSize' => 10,
                'lineThickness' => 2,
                'useLineColorForBulletBorder' => true,
                'bullet' => 'round',
                'bulletBorderAlpha' => 1,
                'bulletColor' => '#FFFFFF',
                'hideBulletsCount' => 100,
            ],
        ];

        $chartConfiguration = [
            'dataProvider' => $dataProvider,
            'type' => 'serial',
            'language' => 'ru',
            'dataDateFormat' => 'DD.MM.YYYY',
            'decimalSeparator' => '.',
            'thousandsSeparator' => ' ',
            'valueAxes' => [[
                'stackType' => 'none',
                'gridAlpha' => 0.07,
                'position' => 'left'
            ]],
            'graphs' => $graphs,
            'legend' => [
                'periodValueText' => 'Всего: [[value.sum]]',
                'equalWidths' => 'false',
                'position' => 'top',
                'valueAlign' => 'left',
                'valueWidth' => 100,
            ],
            'chartCursor' => [
                'cursorPosition' => 'mouse',
                'pan' => true,
                'valueLineEnabled' => true,
                'valueLineBalloonEnabled' => true
            ],
            'chartScrollbar' => [
                'graph' => 'g1',
                'scrollbarHeight' => 30
            ],

            'pathToImages' => 'http://www.amcharts.com/lib/3/images/',
            'categoryField' => 'date',
            'categoryAxis' => [
                'parseDates' => true,
                'dashLength' => 1,
                'minorGridEnabled' => true,
                'position' => 'top'
            ],

            'exportConfig' => [
                'menuTop' => '10px',
                'menuRight' => '10px',
                'menuItems' => [['icon' => '/lib/3/images/export.png', 'format' => 'png']]
            ],


        ];
        echo mitrm\amcharts\AmChart::widget([
            'chartConfiguration' => $chartConfiguration,
            'options' => ['id' => 'mitrm_chart_click'],
            'width' => '100%',
            'height' => '600px',
            'language' => 'ru',
            'zoomChart' => [
                'lenght_one' => 30,
                'lenght_two' => 1,
            ],
        ]);


    }



    ?>
<?php  endif;?>