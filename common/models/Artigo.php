<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "artigo".
 *
 * @property int $article_id
 * @property string|null $authors
 * @property string|null $title
 * @property int|null $data_publicacao
 * @property string|null $dissemination_vehicle
 * @property string|null $access_link
 * @property string $createdAt
 * @property string $updatedAt
 * @property int|null $curriculumId
 *
 * @property Curriculo $curriculum
 */
class Artigo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'artigo';
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
            [['curriculumId'], 'integer'],
            [['title'], 'required'],
            [['createdAt', 'updatedAt', 'data_publicacao'], 'safe'],
            [['descricao'], 'string'],
            [['resumo'], 'string', 'max' => 512],
            [[ 'destaque'], 'boolean'],
            [['authors', 'title', 'dissemination_vehicle', 'access_link'], 'string', 'max' => 255],
            [['curriculumId'], 'exist', 'skipOnError' => true, 'targetClass' => Curriculo::class, 'targetAttribute' => ['curriculumId' => 'curriculum_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'article_id' => 'Article ID',
            'authors' => 'Autor(es)',
            'title' => 'Titulo',
            'resumo' => 'Resumo',
            'descricao' => 'Descrição',
            'destaque' => 'Destaque',
            'data_publicacao' => 'Data de publicação',
            'dissemination_vehicle' => 'Veiculo de disseminação',
            'access_link' => 'Link',
            'createdAt' => 'Data criação',
            'updatedAt' => 'Data modificação',
            'curriculumId' => 'Curriculum ID',
        ];
    }

    /**
     * Gets query for [[Curriculum]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculum()
    {
        return $this->hasOne(Curriculo::class, ['curriculum_id' => 'curriculumId']);
    }
}
