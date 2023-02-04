<?php 

use timurmelnikov\widgets\LoadingOverlayPjax as Pjax;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

use common\models\Arquivo;


/// Get version file
if ($tipo == Arquivo::TIPO_IMAGEM && ArrayHelper::keyExists(Arquivo::VERSION_ORIGINAL, $model->imageVersions)){
    $version = Arquivo::VERSION_ORIGINAL;
} else if ($tipo == Arquivo::TIPO_IMAGEM && ArrayHelper::keyExists(Arquivo::VERSION_LARGE, $model->imageVersions)){
    $version = Arquivo::VERSION_LARGE;
} else if ($tipo == Arquivo::TIPO_IMAGEM && ArrayHelper::keyExists(Arquivo::VERSION_MID, $model->imageVersions)){
    $version = Arquivo::VERSION_MID;
} else if ($tipo == Arquivo::TIPO_IMAGEM && ArrayHelper::keyExists(Arquivo::VERSION_SMALL, $model->imageVersions)){
    $version = Arquivo::VERSION_SMALL;
} 
else {
    $version = '';
}

// Configure Columns
$columns = [
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'legenda',
        'editableOptions' => function ($model) use ($pjaxGridId) {
            return [
                'options' => ['id' => "{$pjaxGridId}-{$model->id}-legenda"],
                'formOptions' => ['action' => ['arquivo/update']],
                'valueIfNull' => $model->nome_original,
            ];
        }
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'data_publicacao',
        'value' => function ($model_file) {
            return $model_file->getDataExtenso('data_publicacao', 'dd/MM/yyyy');
        },
        'editableOptions' => function ($model) use ($pjaxGridId) {
            return [
                'inputType' => GridView::FILTER_DATE,
                'options' => ['id' => "{$pjaxGridId}-{$model->id}-data_publicacao"],
                'formOptions' => ['action' => ['arquivo/update']],
            ];
        }
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'posicao',
        'visible' => $dataProvider->getCount() > 1,
        'editableOptions' => function ($model) use ($pjaxGridId) {
            return [
                'options' => [
                    'type' => 'number',
                    'id' => "{$pjaxGridId}-{$model->id}-posicao"
                ],
                'formOptions' => ['action' => ['arquivo/update']]
            ];
        }
    ],
    [
        'format' => 'raw',
        'visible' => $tipo == Arquivo::TIPO_DOCUMENTO,
        'value' => function ($model_file) use ($model, $version) {
            return Html::a(Icon::show('file-download'), $model_file->getFileUrl($model->uploadModelName, $version), [
                'title' => Yii::t('app', 'Download'),
                'data-pjax' => 0,
                'download' => true
            ]);
        }
    ],
    [
        'format' => 'raw',
        'visible' => $tipo == Arquivo::TIPO_IMAGEM,
        'value' => function ($model_file) use ($model, $version) {
            $url = $model_file->getFileUrl($model->uploadModelName, $version);
            
            $img = Html::img($url, [
                'width' => '150px',
            ]);

            return Html::a($img, $url, [
                'data-pjax' => '0',
                'target' => '_blank'
            ]);
        }
    ],
    [
        'class' => 'dynamikaweb\grid\ActionColumn',
        'template' => '{delete}',
        'controller' => 'arquivo',
        'modelClass' => $model->tableName(),
        'pjax' => "#{$pjaxGridId}"
    ],
]?>

<!---- INICIO BLOCO GRIDVIEW <?=$tipo?> ---->
<?= GridView::widget([
    'pjax' => true,
    'condensed' => true,
    'responsive' => true,
    'responsiveWrap' => true,
    'showHeader' => true,
    'showPageSummary' => false,
    'showFooter' => false,
    'dataProvider' => $dataProvider,
    'columns' => $columns,
    'id' => $pjaxGridId
])?>