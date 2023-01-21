<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projeto".
 *
 * @property int $project_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $members
 * @property string|null $financiers
 * @property string $createdAt
 * @property string $updatedAt
 * @property int|null $curriculumId
 *
 * @property Curriculo $curriculum
 */
class Projeto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projeto';
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
            [['title', 'description', 'members', 'financiers'], 'string'],
            [['title'], 'required'],
            [[ 'destaque'], 'boolean'],
            [['createdAt', 'updatedAt', 'data_publicacao'], 'safe'],
            [['curriculumId'], 'integer'],
            [['curriculumId'], 'exist', 'skipOnError' => true, 'targetClass' => Curriculo::class, 'targetAttribute' => ['curriculumId' => 'curriculum_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'title' => 'Titulo',
            'description' => 'Descrição',
            'members' => 'Membros',
            'destaque' => 'Destaque',
            'data_publicacao' => 'Data de publicação',
            'financiers' => 'Financiadores',
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
