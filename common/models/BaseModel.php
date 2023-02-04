<?php

namespace common\models;

use Yii;
use yii\base\Exception;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class BaseModel extends \yii\db\ActiveRecord
{
    const TIPO_IMAGEM = 'I';
    const TIPO_DOCUMENTO = 'D';
    
    const TIPO_ANEXO_ANO = 'A';
    const TIPO_ANEXO_ORDEM = 'O';
    
    const VERSION_ORIGINAL = 'original_';
    const VERSION_LARGE = 'maior_';
    const VERSION_MID = 'media_';
    const VERSION_SMALL = 'thumb_';

    public $maxImageSize = 50;
    public $maxFileSize = 50;
    public $maxFiles = 20;

    public static $noFilePath = '@web/images/indisponivel.png';

    public $modelClass;

    public $imageVersions = [
        self::VERSION_LARGE => [1200,600],
        self::VERSION_MID => [500,250],
        self::VERSION_SMALL => [200,100]
    ];

    public $imageQuality = 90;
    public $cropInfo;

    public $order = ['id' => SORT_DESC];
    public $pageSize = 20;

    public static $fileExtensions = 'doc, docx, pdf, txt, ppt, pptx, odt, xls, xlsx, rar, zip, kit';
    
    public $modelUploadMap = [
        'reference' => '',
        'field' => '',
    ];


    public function getUploadModelName()
    {
        return $this->tableName();
    }



   
    public function getGalleryItems($relation, $field, $options = [])
    {
        $version = ArrayHelper::getValue($options, 'version', Arquivo::VERSION_LARGE);
        $clover = ArrayHelper::getValue($options, 'clover', true);

        $arquivos = Arquivo::find()->joinWith($relation)->where([
            $relation . '.' . $field => $this->id,
            'arquivo.tipo' => Arquivo::TIPO_IMAGEM
        ])->orderBy(['(case when capa is true then 0 else arquivo.posicao end)' => SORT_ASC])->all();

        if (empty($arquivos)) {
            return [];
        }        

        if (!$clover) { //Remove a primeira imagem caso ela ja esteja sendo usada como capa na mesma página
            array_shift($arquivos);
        }

        $gallery = [];

        foreach ($arquivos as $arquivo) {
            $filePath = $arquivo->getFileUrl($this->uploadModelName, $version);
            $gallery[] = (object) [
                'link' => $filePath,
                'legenda' => $arquivo->legenda,
            ];
        }

        return $gallery;
    }

    public function getImagemCapa($relation, $field, $version = Arquivo::VERSION_MID)
    {
        if (!$this->$relation) {
            return null;
        }

        $arquivo = Arquivo::find()->joinWith($relation)->where([
            $relation . '.' . $field => $this->id,
            'arquivo.tipo' => Arquivo::TIPO_IMAGEM
        ])->orderBy(['(case when capa is true then 0 else arquivo.posicao end)' => SORT_ASC])->one();

        if (!$arquivo) {
            return null;
        }

        return $arquivo->getFileUrl($this->uploadModelName, $version);
    }

    public function getDataProviderArquivos($tipo = null, $options = [])
    {
        $order = ArrayHelper::getValue($options, 'order', 'extract(year from arquivo.data_publicacao) desc, arquivo.data_publicacao asc, arquivo.posicao desc');
        $reference = ArrayHelper::getValue($this->modelUploadMap, 'reference', null);
        $field = ArrayHelper::getValue($this->modelUploadMap, 'field', null);
        $query = Arquivo::find()
            ->andWhere(["{$reference}.{$field}" => $this->id])
            ->andFilterWhere(["{$reference}.tipo" => $tipo])
            ->joinWith("{$reference}")
            ->orderBy($order);

        return new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
    }

    public function hasFile($tipo = null)
    {
        $reference = isset($this->modelUploadMap['reference']) ? $this->modelUploadMap['reference'] : null;
        $field = isset($this->modelUploadMap['field']) ? $this->modelUploadMap['field'] : null;

        if (empty($reference)) {
            return false;
        }

        if (empty($field)) {
            return false;
        }

        $where = [$reference . '.' . $field => $this->id];

        if ($tipo) {
            $where['arquivo.tipo'] = $tipo;
        }

        $count = Arquivo::find()
            ->joinWith($reference)
            ->where($where)
            ->count();

        if (!$count || $count == 0) {
            return false;
        }

        return true;
    }

    public function getImages($relation, $field, $options = [])
    {
        $arquivos = Arquivo::find()->joinWith($relation)->where([
            $relation . '.' . $field => $this->id,
            'arquivo.tipo' => Arquivo::TIPO_IMAGEM
        ])->orderBy('arquivo.posicao ASC')->all();

        if (empty($arquivos)) {
            return null;
        }

        $version = (isset($options['version'])) ? $options['version'] : Arquivo::VERSION_LARGE;
        $imgOptions = (isset($options['imgOptions'])) ? $options['imgOptions'] : [];

        $images = [];
        foreach ($arquivos as $arquivo) {
            $imgOptions['title'] = $arquivo->legenda;
            $filePath = $arquivo->getFileUrl($this->uploadModelName, $version);
            $images[] = Html::img($filePath, $imgOptions);
        }

        return $images;
    }

    public function getGridColumns($searchModel = null)
    {
        return [];
    }

        /**
     * @see yii\i18n\Formatter
     * @return string
     */
    public function getDataExtenso($attribute = 'data_publicacao', $format = 'long')
    {
        return Yii::$app->formatter->asDate($this->$attribute, $format);
    }

    public function saveFile($uploadAttribute = 'file', $fileAttribute = 'id_arquivo')
    {
        $this->$uploadAttribute = \yii\web\UploadedFile::getInstances($this, $uploadAttribute);

        if (empty($this->$uploadAttribute)) {
            return false;
        }

        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {

            $arquivo = new Arquivo();
            $arquivo->imageVersions = $this->imageVersions;
            $arquivo->modelClass = $this->uploadModelName;

            if ($arquivo->load($this->$uploadAttribute) && $arquivo->save()) {

                if ($arquivo->upload()) {

                    $arquivoAtual = $this->arquivo;
                    if (!empty($arquivoAtual)) {
                        $arquivoAtual->modelClass = $this->uploadModelName;
                        $arquivoAtual->delete();
                    }

                    $this->$fileAttribute = $arquivo->id;
                    $this->update(false, [$fileAttribute]);

                } else {
                    throw new Exception('Erro ao fazer upload do arquivo.');
                }
            } else {
                foreach($arquivo->getErrors() as $error) {
                    throw new Exception(current($error));
                }
            }
            $transaction->commit();
            return true;

        } catch (Exception $e) {
            Yii::error(get_class().' - '.$e->getMessage());
            $transaction->rollBack();
        }

        return false;
    }

    public function getFile($version = self::VERSION_SMALL,$options = [])
    {
        if (!isset($options['class'])) {
            $options['class'] = ['img-thumbnail'];
        }

        $arquivo = (array_key_exists('fileModel',$options)) ? $options['fileModel'] : $this->arquivo;

        if (!$arquivo) {
            return null;
        }

        $file = $arquivo->getFileUrl($this->uploadModelName,$version);
        $fileBig = $arquivo->getFileUrl($this->uploadModelName,
            ($version !== Arquivo::VERSION_ORIGINAL) ? Arquivo::VERSION_LARGE: Arquivo::VERSION_ORIGINAL);


        $linkContent = \yii\helpers\Html::img($file,[
            'class' => $options['class']
        ]);

        return \yii\helpers\Html::a($linkContent,$fileBig,[
            'target' => '_blank',
            'title' => $arquivo->nome_original,
        ]);
    }

    public function getFileName($fileModel = 'arquivo')
    {
        if (!isset($this->$fileModel)) {
            return null;
        }

        $arquivo = $this->$fileModel;

        if (!$arquivo) {
            return null;
        }

        return $arquivo->nome_original.' ('.$arquivo->formattedFileSize.')';
    }

    public function getAnexos($relation,$field,$id_arquivo_categoria = null)
    {
        if (!$this->$relation) {
            return new \yii\data\ArrayDataProvider();
        }
        
        $where = [
            $relation.'.'.$field => $this->id,
            'arquivo.tipo' => Arquivo::TIPO_DOCUMENTO,
            'arquivo.id_arquivo_categoria' => $id_arquivo_categoria
        ];
    
        $order = 'arquivo.posicao ASC,arquivo.data_publicacao desc';
    
        if (isset($this->tipo_anexo)) {
            switch($this->tipo_anexo) {
                case self::TIPO_ANEXO_ANO:
                    $order = 'extract(year from arquivo.data_publicacao) desc, arquivo.data_publicacao desc,arquivo.posicao ASC';
                    break;
                case self::TIPO_ANEXO_ORDEM:
                    $order = 'arquivo.posicao ASC,arquivo.data_publicacao desc';
                    break;
            }
        }
    
        $arquivos = Arquivo::find()
            ->joinWith($relation)
            ->where($where)
            ->orderBy($order)
            ->all();
    
        if (empty($arquivos)) {
            return new \yii\data\ArrayDataProvider();
        }
    
        $data = [];
    
        if (isset($this->tipo_anexo) && $this->tipo_anexo == self::TIPO_ANEXO_ANO) {
        
            foreach ($arquivos as $key => $arquivo) {
            
                if (!isset($data[$arquivo->ano])) {
                    $data[$arquivo->ano] = [];
                }
                array_push($data[$arquivo->ano], $arquivo);
            }
        } else {
            $data = $arquivos;
        }
    
        return new \yii\data\ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
    }
    
}
