<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tese".
 *
 * @property int $thesis_id
 * @property string|null $title
 * @property string|null $institution
 * @property string|null $publishing_company
 * @property string|null $author
 * @property string|null $description
 * @property string|null $access_link
 * @property string $createdAt
 * @property string $updatedAt
 * @property int|null $curriculumId
 *
 * @property Curriculo $curriculum
 */
class Tese extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tese';
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
            [['title', 'description'], 'string'],
            [['title'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['curriculumId'], 'integer'],
            [['institution', 'publishing_company', 'author', 'access_link'], 'string', 'max' => 255],
            [['curriculumId'], 'exist', 'skipOnError' => true, 'targetClass' => Curriculo::class, 'targetAttribute' => ['curriculumId' => 'curriculum_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'thesis_id' => 'Thesis ID',
            'title' => 'Titulo',
            'institution' => 'Instituição',
            'publishing_company' => 'Companhia de publicação',
            'author' => 'Autor',
            'description' => 'Descrição',
            'access_link' => 'Link',
            'createdAt' => 'Data de criação',
            'updatedAt' => 'Data de modificação',
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
