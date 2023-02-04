<?php

use yii\bootstrap5\Tabs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Noticia $model */

$this->title = 'Atualizar Noticia: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="noticia-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?php
    echo Tabs::widget([
        'options' => [
            'class' => 'nav nav-tabs nav-justified'
        ],
        'items' => [
            [
                'label' => 'Notícia',
                'content' => $this->render('_form', [
                    'model' => $model,
                ]),
                'active' => true
            ],
            [
                'label'=>'Imagens',
                'encode'=>false,
                'content' => $this->render('//commons/_formArquivos', [
                    'model' => $model,
                    'tipo' => \common\models\Arquivo::TIPO_IMAGEM
                ])
            ],
            [
                'label'=>'Documentos',
                'encode'=>false,
                'content' => $this->render('//commons/_formArquivos', [
                    'model' => $model,
                    'tipo' => \common\models\Arquivo::TIPO_DOCUMENTO
                ])
            ],
        ],
    ]);
    ?>

</div>
