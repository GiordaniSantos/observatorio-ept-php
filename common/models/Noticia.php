<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "noticia".
 *
 * @property int $id
 * @property string|null $authors
 * @property string|null $title
 * @property string|null $description
 * @property string|null $date
 * @property string $createdAt
 * @property string $updatedAt
 */
class Noticia extends BaseModel
{
    public $modelUploadMap = [
        'table' => 'noticia_arquivo',
        'reference' => 'noticiaArquivos',
        'field' => 'id_noticia'
    ];

    public $images = [];
    public $files = [];

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
            'id' => 'News ID',
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

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticiaArquivos()
    {
        return $this->hasMany(NoticiaArquivo::className(), ['id_noticia' => 'id']);
    }

    public function getArquivos()
    {
        return $this->hasMany(Arquivo::className(), ['id' => 'id_arquivo'])
            ->viaTable(NoticiaArquivo::tableName(), ['id_noticia' => 'id']);
    }

    public function saveFiles()
    {
        $tipos = ['images','files'];
        
        foreach ($tipos as $attribute) {
            
            $this->$attribute = \yii\web\UploadedFile::getInstances($this, $attribute);
            
            if (empty($this->$attribute)) {
                continue;
            }
            
            $connection = Yii::$app->db;
            
            foreach($this->$attribute as $file) {
                
                $transaction = $connection->beginTransaction();
                try {
                    
                    $arquivo = new Arquivo();
                    $arquivo->modelClass = $this->tableName();
                    
                    if (!$arquivo->load($file)) {
                        throw new \Exception('Não foi possível carregar o arquivo.');
                    }

                    if ($arquivo->tipo == self::TIPO_IMAGEM) {
                        $arquivo->posicao = Arquivo::getMaxPositionImage('noticia_arquivo','id_noticia',$this->id) + 1;
                    }

                    if (!$arquivo->save()) {
                        foreach ($arquivo->getErrors() as $error) {
                            $error = is_array($error) ? current($error) : $error;
                            throw new \Exception($error);
                        }
                    }

                    if (!$arquivo->upload()) {
                        throw new \Exception('Não foi possível fazer upload do arquivo.');
                    }

                    $noticiaArquivo = new NoticiaArquivo();
                    $noticiaArquivo->id_noticia = $this->id;
                    $noticiaArquivo->id_arquivo = $arquivo->id;
                    $noticiaArquivo->tipo = $arquivo->tipo;

                    if (!$noticiaArquivo->save()) {
                        foreach ($noticiaArquivo->getErrors() as $error) {
                            $error = is_array($error) ? current($error) : $error;
                            throw new \Exception($error);
                        }
                    }
                    $transaction->commit();
                    
                } catch (\Exception $e) {
                    Yii::error(get_class().' - '.$e->getMessage());
                    Yii::error('ERRO '.$e->getTraceAsString());
                    $transaction->rollBack();
                }
            }
        }
        return true;
    }

    public function beforeDelete()
    {
        $arquivos = $this->arquivos;
        if ($arquivos) {

            foreach ($arquivos as $arquivo) {
                $arquivo->modelClass = $this->tableName();
                try {
                    $arquivo->delete();
                } catch (\Exception $e) {
                    Yii::error(get_class().': '.$e->getMessage());
                }
            }
        }
        return parent::beforeDelete();
    }
    
}
