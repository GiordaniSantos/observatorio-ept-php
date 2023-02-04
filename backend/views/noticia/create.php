<?php

use yii\bootstrap5\Tabs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Noticia $model */

$this->title = 'Create Noticia';
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Tabs::widget([
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
                'label' => 'Anexos',
                'linkOptions' => ['data-toggle' => ""],
                'headerOptions' => ['class' => 'disabled'],
                'items'=>[
                    [
                        'label'=>'Imagens',
                        'encode'=>false,
                        'content' => $this->render('_formArquivos', [
                            'model' => $model,
                            'tipo' => \common\models\Arquivo::TIPO_IMAGEM
                        ])
                    ],
                    [
                        'label'=>'Documentos',
                        'encode'=>false,
                        'content' => $this->render('_formArquivos', [
                            'model' => $model,
                            'tipo' => \common\models\Arquivo::TIPO_DOCUMENTO
                        ])
                    ],
                ],
            ],
        ],
    ]);
    ?>

</div>
