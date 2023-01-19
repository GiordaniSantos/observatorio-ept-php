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
class Evento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evento';
    }

            /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'createdAtAttribute' => 'data_criacao',
                'updatedAtAttribute' => 'data_modificacao',
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
            [['titulo', 'data_inicio', 'data_fim'], 'required'],
            [['descricao'], 'string'],
            [['data_inicio', 'data_fim'], 'safe'],
            [[ 'destaque'], 'boolean'],
            [['titulo'], 'string', 'max' => 256],
            [['resumo'], 'string', 'max' => 512],
            [['local'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'titulo' => Yii::t('app', 'Título'),
            'local' => Yii::t('app', 'Local'),
            'resumo' => Yii::t('app', 'Resumo'),
            'descricao' => Yii::t('app', 'Descrição'),
            'data_inicio' => Yii::t('app', 'Data de começo'),
            'data_fim' => Yii::t('app', 'Data de encerramento'),
            'destaque' => Yii::t('app', 'Destaque?'),
            'data_criacao' => Yii::t('app', 'Data Criação'),
            'data_modifacao' => Yii::t('app', 'Data Modifação'),
        ];
    }
}
