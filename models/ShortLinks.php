<?php

namespace mitrm\links\models;

use Yii;

/**
 * This is the model class for table "short_links".
 *
 * @property integer $id
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
            'link' => 'Link',
            'token' => 'token',
            'count_click' => 'Count Click',
            'table' => 'Table',
            'field_id' => 'Field ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

    /**
     * @brief Создание короткой ссылки
     * @param $link
     * @return string
     */
    public static function saveLink($link)
    {
        $model = new ShortLinks();
        $model->link = $link;
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
