<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "membro".
 *
 * @property int $id
 * @property string|null $name
 * @property string $institution
 * @property string|null $link_curriculum
 * @property string $createdAt
 * @property string $updatedAt
 */
class Membro extends BaseModel
{
    public $file;
    public $cacheFile;

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
            [['file'], 'file',
                'mimeTypes' => ['application/*','image/*','audio/*','video/*'],
                'maxSize'=>($this->maxFileSize * 1024 * 1024),
                'maxFiles' => $this->maxFiles,
                'tooBig' => 'Tamanho máximo '.($this->maxFileSize * 1024 * 1024).' MB'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Member ID',
            'file' => 'Arquivo',
            'name' => 'Nome',
            'institution' => 'Instituição vinculada',
            'link_curriculum' => 'Link para o curriculo',
            'createdAt' => 'Data criação',
            'updatedAt' => 'Data modificação',
        ];
    }

    public function getArquivo()
    {
        return $this->hasOne(Arquivo::className(), ['id' => 'id_arquivo']);
    }
    

    public function getDataProviderArquivo()
    {
        $query = Arquivo::find()
            ->where(['id' => $this->id_arquivo]);
        
        return new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
    }

    public function beforeDelete()
    {
        if ($this->arquivo) {
            $this->cacheFile = $this->arquivo;
        }
        return parent::beforeDelete();
    }
    
    public function afterDelete()
    {
        parent::afterDelete();
        
        $arquivo = $this->cacheFile;
        if ($arquivo) {
            $arquivo->modelClass = $this->tableName();
            try {
                $arquivo->delete();
            } catch (\Exception $e) {
                Yii::error(get_class().': '.$e->getMessage());
            }
        }
    }
}
