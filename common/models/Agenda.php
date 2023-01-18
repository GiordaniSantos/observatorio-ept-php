<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "agenda".
 *
 * @property int $schedule_id
 * @property string|null $date
 * @property string|null $description
 * @property string|null $external_link
 * @property string $createdAt
 * @property string $updatedAt
 */
class Agenda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agenda';
    }

        /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['date', 'description', 'external_link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'schedule_id' => 'Schedule ID',
            'date' => 'Data',
            'description' => 'Descrição',
            'external_link' => 'Link',
            'createdAt' => 'Data criação',
            'updatedAt' => 'Data modificação',
        ];
    }
}
