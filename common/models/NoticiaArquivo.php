<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "noticia_arquivo".
 *
 * @property integer $id
 * @property integer $id_noticia
 * @property integer $id_arquivo
 * @property string $tipo
 * @property boolean $capa
 *
 * @property Arquivo $idArquivo
 * @property Noticia $idNoticia
 */
class NoticiaArquivo extends \common\models\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'noticia_arquivo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_noticia', 'id_arquivo'], 'integer'],
            [['capa'], 'boolean'],
            [['tipo'], 'string', 'max' => 10],
            [['id_arquivo'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Arquivo::className(),
                'targetAttribute' => ['id_arquivo' => 'id']
            ],
            [['id_noticia'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Noticia::className(),
                'targetAttribute' => ['id_noticia' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_noticia' => Yii::t('app', 'Noticia'),
            'id_arquivo' => Yii::t('app', 'Arquivo'),
            'tipo' => Yii::t('app', 'Tipo'),
            'capa' => Yii::t('app', 'Capa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArquivo()
    {
        return $this->hasOne(Arquivo::className(), ['id' => 'id_arquivo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticia()
    {
        return $this->hasOne(Noticia::className(), ['id' => 'id_noticia']);
    }

    public function getUploadModelName()
    {
        return $this->noticia->uploadModelName;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->capa === true) {
            $this->updateAll(['capa' => false],
                'id_noticia = :id_noticia AND id_arquivo != :id_arquivo',
                [
                    ':id_noticia' => $this->id_noticia,
                    ':id_arquivo' => $this->id_arquivo
                ]
            );
        }
    }

}
