<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "membro".
 *
 * @property int $member_id
 * @property string|null $name
 * @property string $institution
 * @property string|null $link_curriculum
 * @property string $createdAt
 * @property string $updatedAt
 */
class Membro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'membro';
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
            [['institution'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['name', 'institution', 'link_curriculum'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'member_id' => 'Member ID',
            'name' => 'Nome',
            'institution' => 'Instituição vinculada',
            'link_curriculum' => 'Link para o curriculo',
            'createdAt' => 'Data criação',
            'updatedAt' => 'Data modificação',
        ];
    }
}
