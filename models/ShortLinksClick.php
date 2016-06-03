<?php

namespace mitrm\links\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "short_links_click".
 *
 * @property integer $id
 * @property integer $short_links_id
 * @property integer $created_at
 *
 * @property ShortLinks $shortLinks
 */
class ShortLinksClick extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'short_links_click';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_links_id', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'short_links_id' => 'Short Links ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShortLinks()
    {
        return $this->hasOne(ShortLinks::className(), ['id' => 'short_links_id']);
    }
    
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                ],
            ],

        ];
    }
    

}
