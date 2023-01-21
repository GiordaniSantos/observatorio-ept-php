<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "noticia".
 *
 * @property int $news_id
 * @property string|null $authors
 * @property string|null $title
 * @property string|null $description
 * @property string|null $date
 * @property string $createdAt
 * @property string $updatedAt
 */
class Noticia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticia';
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
            [['authors', 'title', 'description'], 'string'],
            [['data_publicacao', 'createdAt', 'updatedAt'], 'safe'],
            [[ 'destaque', 'principal'], 'boolean'],
            [['resumo'], 'string', 'max' => 512],
            [['title'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'authors' => 'Autor(es)',
            'title' => 'Titulo',
            'resumo' => 'Resumo',
            'destaque' => 'Destaque?',
            'principal' => 'Principal?',
            'description' => 'Descrição',
            'data_publicacao' => 'Data de publicação',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }
}
