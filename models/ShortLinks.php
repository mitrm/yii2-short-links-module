<?php

namespace mitrm\links\models;

use Yii;
use yii\validators\UrlValidator;

/**
 * This is the model class for table "short_links".
 *
 * @property integer $id
 * @property string $title
 * @property string $link
 * @property string $token
 * @property integer $count_click
 * @property string $table
 * @property integer $field_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ShortLinksClick[] $clicks
 */
class ShortLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'short_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link'], 'string'],
            [['count_click', 'field_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['table'], 'string', 'max' => 250],
            [['token'], 'string', 'max' => 250],
            [['title'], 'string', 'max' => 250],
            [['token'], 'unique'],
            [['count_click'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Ссылка',
            'token' => 'Token',
            'title' => 'Анкор',
            'count_click' => 'Количество кликов',
            'table' => 'Таблица',
            'field_id' => 'ID записи',
            'user_id' => 'Пользователь',
            'created_at' => 'Создано',
            'updated_at' => 'Обнолвено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClick()
    {
        return $this->hasMany(ShortLinksClick::className(), ['short_links_id' => 'id']);
    }
    
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

     public function beforeSave($insert)
     {
         if (parent::beforeSave($insert)) {
             if($insert) {
                 $this->token = uniqid();
             }
             return true;
         } else {
             return false;
         }
     }


    public static function generationFullLink($link, $title='')
    {
        $validator = new UrlValidator();

        if (!$validator->validate($link, $error)) {
            $error = 'Укажите верную ссылку, пример http://site.ru/link';
        } else {
            return 'http://'.Yii::$app->getModule('short_link')->domain.'/l/'.self::saveLink($link, $title);
        }
        return false;
    }

    /**
     * @brief Создание короткой ссылки
     * @param $link
     * @param $title
     * @return string
     */
    public static function saveLink($link, $title='')
    {
        $model = new ShortLinks();
        $model->link = $link;
        $model->title = $title;
        if($model->save()) {
            return $model->token;
        }
        Yii::error([
            'msg' => 'Ошибка создания короткой ссылки',
            'data' => [
                'error' => $model->errors,
                'method' => __METHOD__
            ],
        ]);
        return false;
    }

    public static function findByToken($token)
    {
        $model = ShortLinks::find()
            ->where(['token' => $token])
            ->one();
        if($model) {
            $click = new ShortLinksClick();
            $click->short_links_id = $model->id;
            if(!$click->save()) {
                Yii::error([
                    'msg' => 'Ошибка записи статистики клика',
                    'data' => [
                        'error' => $model->errors,
                        'method' => __METHOD__
                    ],
                ]);
            }
            $model->count_click += 1;
            $model->save();
            return $model->link;
        }
        return false;
    }

}
