<?php

namespace common\models;

use Yii;
use yii\base\Exception;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;
use common\components\helper\ImageHelper;

/**
 * This is the model class for table "arquivo".
 *
 * @property integer $id
 * @property string $arquivo
 * @property string $tipo_mime
 * @property string $tamanho
 * @property string $tipo
 * @property string $legenda

 */
class Arquivo extends \common\models\BaseModel
{

    public $ano;
    public $file;
    public $image;

    private $cacheId;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'arquivo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['arquivo'], 'required'],
            [['tamanho'], 'number'],
            [['data_criacao','data_modificacao'], 'safe'],
            [['data_publicacao'], 'date', 'format' => 'php:d/m/Y'],
            [['ativo'], 'boolean'],
            [['posicao'],'integer'],
            [['arquivo','nome_original'], 'string', 'max' => 100],
            [['image','file','cropInfo'], 'safe'],
            [['image'], 'image',
                'extensions'=>'jpg, jpeg, gif, png',
                'maxSize'=>($this->maxImageSize * 1024 * 1024),
                'maxFiles' => $this->maxFiles,
                'tooBig' => 'Tamanho máximo '.$this->maxImageSize.' MB'
            ],
            [['file'], 'file',
                'mimeTypes' => ['application/*','image/*','audio/*','video/*'],
                //'extensions'=>'jpg, jpeg, gif, png, pdf, doc, docx, xls, xlsx, txt, ppt, odf, odt',
                'maxSize'=>($this->maxFileSize * 1024 * 1024),
                'maxFiles' => $this->maxFiles,
                //'tooBig' => 'Tamanho máximo '.$this->maxFileSize.' MB'
            ],
            [['modelClass','ano'],'safe'],
            [['tipo'], 'string', 'max' => 2],
            [['legenda','tipo_mime'], 'string', 'max' => 150],
        ];
    }
    
    function attributes()
    {
        $attributes = parent::attributes();
        $attributes[] = 'file';
        $attributes[] = 'image';
        return $attributes;
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_original' => 'Nome Original',
            'arquivo' => 'Arquivo',
            'tipo_mime' => 'Tipo Mime',
            'tamanho' => 'Tamanho',
            'tipo' => 'Tipo',
            'legenda' => 'Legenda',
            'data_criacao' => 'Data Criação',
            'data_modificacao' => 'Data Modificação',
            'data_publicacao' => 'Data Publicação',
            'ativo' => 'Ativo',
            'posicao' => 'Posição',
        ];
    }
    

    public function getMembro()
    {
        return $this->hasOne(Membro::className(), ['id_arquivo' => 'id']);
    }


    public static function getCategoriaList()
    {
        return \yii\helpers\ArrayHelper::map(ArquivoCategoria::find()
            ->orderBy(['nome'=>'ASC'])
            ->all(),'id','nome');
    }

    public function beforeDelete()
    {
        $this->cacheId = $this->id;
        return parent::beforeDelete();
    }
    
    public function afterDelete()
    {
        parent::afterDelete();
        try {
            \yii\helpers\FileHelper::removeDirectory($this->uploadPath);
        } catch (\Exception $e) {
            Yii::error(get_class().': '.$e->getMessage());
        }
    }

    public function getFileUrl($modelClass = null,$version = null)
    {
        $this->modelClass = ($modelClass) ? $modelClass : $this->modelClass;
        $prefix = ($version) ? $version : '';

        return '/observatorio-ept/frontend/web/uploads/'.$this->modelClass.'/'.$this->id.'/'.$prefix.$this->arquivo;
    }

    public function getUploadPath()
    {
        $id = ($this->id) ? $this->id : $this->cacheId;
        return \Yii::getAlias('@uploads').'/'.$this->modelClass.'/'.$id.'/';
    }

    public function upload()
    {   
        ini_set ('memory_limit', '-1');
        ini_set ('max_execution_time', '300');

        try {
            
            $file = (empty($this->file)) ? $this->getFileUploaded() : $this->file;
            
            if (empty($file)) {
                throw new Exception ('Não existe arquivo para upload');
            }
            
            $file = (is_array($file)) ? current($file) : $file;
            
            $tempFile = [];
            $tempFile[] = $file->tempName;

            if (!is_dir($this->uploadPath)) {
                mkdir($this->uploadPath, 0775, true);
            }

            if ($this->tipo == self::TIPO_IMAGEM) {
                
                if ($this->cropInfo) {
                    
                    $cropInfo = \yii\helpers\Json::decode($this->cropInfo);
                    
                    if ($cropInfo['width'] != null && $cropInfo['height'] != null) {
                        $imageCrop = ImageHelper::cropImage($file,$cropInfo);
                        $file->tempName = $imageCrop;
                    }
                }

                $options = [];
                $options['quality'] = $this->imageQuality;
                $ext = explode(".", $file->name);
                $options['extension'] = end($ext);

                foreach (array_keys($this->imageVersions) as $version) {

                    if ($version == self::VERSION_ORIGINAL) {
                        $file->saveAs($this->uploadPath.'/'.self::VERSION_ORIGINAL.$this->arquivo);
                        continue;
                    }else if ($version == self::VERSION_LARGE) {
                        $file->saveAs($this->uploadPath.'/'.self::VERSION_LARGE.$this->arquivo);
                        continue;
                    }else if ($version == self::VERSION_MID) {
                        $file->saveAs($this->uploadPath.'/'.self::VERSION_MID.$this->arquivo);
                        continue;
                    }else if ($version == self::VERSION_SMALL) {
                        $file->saveAs($this->uploadPath.'/'.self::VERSION_SMALL.$this->arquivo);
                        continue;
                    }

                }
                
            } else {
                $file->saveAs($this->uploadPath.'/'.$this->arquivo);
            }

            return true;
            
        } catch (Exception $e) {
            Yii::error(get_class().': '.$e->getMessage());
        }
        
        return false;
    }
    
    public function load($data, $formName = null)
    {
        $this->file = (!is_array($data)) ? [$data] : $data;
        $file = null;

        $data = (is_array($data)) ? current($data) : $data;

        if ($data instanceof UploadedFile) {
            $file = $data;
        } else if (parent::load($data,$formName)) {
            $file = $this->getFileUploaded();
        }
        
        if (empty($file)) {
            return false;
        }

        $file = (is_array($file)) ? current($file) : $file;
        
        $this->nome_original = $file->name;
        $ext = explode(".", $file->name);
        $ext = end($ext);
        $this->tipo_mime = $file->type;
        $this->tamanho = $file->size;
        $this->arquivo = Yii::$app->security->generateRandomString() . ".{$ext}";
        $this->ativo = true;
        $this->tipo = (@getimagesize($file->tempName)) ? self::TIPO_IMAGEM : self::TIPO_DOCUMENTO;

        return true;
    }
    
    public function getFileUploaded()
    {
        $this->file = UploadedFile::getInstances($this, 'file');
        
        if (empty($this->file)) {
            $this->image = UploadedFile::getInstances($this, 'image');
        }
        
        return (empty($this->file)) ? $this->image : $this->file;
    }
    
    public function getFormattedFileSize()
    {
        $label = array( 'B', 'kB', 'MB', 'GB', 'TB', 'PB' );
        for( $i = 0; $this->tamanho >= 1024 && $i < ( count( $label ) -1 ); $this->tamanho /= 1024, $i++ );
        return( round( $this->tamanho, 2 ) . " " . $label[$i] );
    }
    
    public function getFileIcon()
    {
        if ($this->nome_original) {

            $ext = explode(".", $this->nome_original);
            $ext = end($ext);
            
            $icon = 'file-';
            
            if ($ext == 'pdf') {
                return $icon.'pdf-o';
            }
            
            if ($ext == 'xls' || $ext == 'xlsx') {
                return $icon.'excel-o';
            }
            
            if ($ext == 'doc' || $ext == 'docx') {
                return $icon.'word-o';
            }
            
            if ($ext == 'ppt' || $ext == 'pptx') {
                return $icon.'powerpoint-o';
            }
            
            if ($ext == 'mp3') {
                return $icon.'audio-o';
            }
            
            if ($ext == 'mp4' || $ext == 'flv') {
                return $icon.'video-o';
            }
            
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
                return $icon.'image-o';
            }
            
            if ($ext == 'txt') {
                
            }
            
            return $icon.'text-o';
        }
    }


    public function afterFind()
    {
        parent::afterFind();

        if ($this->data_publicacao) {
           $ext = explode('/',$this->data_publicacao);
           $this->ano = end($ext); 
        }
    }

    public function getAno()
    {
        if (!$this->data_publicacao) {
            return null;
        }
        
        $ext = explode('/',$this->data_publicacao);
        return end($ext);
    }

    public function getPrettyName($maxLength = 30)
    {
        $descricao = trim($this->legenda);
        $nomeOriginal = $this->nome_original;

        $nome = ($descricao) ? $descricao : $nomeOriginal;

        if (strlen($nome) > $maxLength){
            $nome = substr($nome,0,$maxLength).'... '.$this->extensao;
        }

        return $nome;
    }

    public function getExtensao()
    {
        $ext = explode(".", $this->nome_original);
        return end($ext);
    }

    public static function getMaxPositionImage($relationTableName, $relationTableId, $relationTableIdValue)
    {
        $sql = <<<SQL
SELECT MAX(posicao)
  FROM arquivo
  WHERE id IN (SELECT id_arquivo
    FROM {$relationTableName}
    WHERE {$relationTableId} = :relation_id AND tipo = :tipo
  )
SQL;

        return Yii::$app->db->createCommand($sql)
            ->bindValues([
                ':relation_id' => $relationTableIdValue,
                ':tipo' => self::TIPO_IMAGEM
            ])
            ->queryScalar();
    }

    public static function getMinPositionImage($relationTableName, $relationTableId, $relationTableIdValue)
    {
        $sql = <<<SQL
SELECT MIN(posicao)
  FROM arquivo
  WHERE id IN (SELECT id_arquivo
    FROM {$relationTableName}
    WHERE {$relationTableId} = :relation_id AND tipo = :tipo
  )
SQL;

        return Yii::$app->db->createCommand($sql)
            ->bindValues([
                ':relation_id' => $relationTableIdValue,
                ':tipo' => self::TIPO_IMAGEM
            ])
            ->queryScalar();
    }

}
