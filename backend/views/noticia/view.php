<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Noticia $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="noticia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que deseja deletar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'authors:ntext',
            'title:ntext',
            'description:ntext',
            'data_publicacao',
            'createdAt',
            'updatedAt',
        ],
    ]) ?>

    <fieldset>
        <br /><br /><legend>Anexos</legend>
        <div class="tabela-anexos nomargin">
            <?=$this->render('//commons/_gridArquivos', [
                'dataProvider' => $model->getDataProviderArquivos(\common\models\Arquivo::TIPO_DOCUMENTO, ['order' => 'posicao']),
                'pjaxGridId' => "pjaxGridDocumento{$model->id}",
                'model' => $model,
                'tipo' => \common\models\Arquivo::TIPO_DOCUMENTO
            ])?>
        </div>

        <br /><br /><legend>Imagens</legend>
        <div class="tabela-anexos nomargin">
            <?=$this->render('//commons/_gridArquivos', [
                'dataProvider' => $model->getDataProviderArquivos(\common\models\Arquivo::TIPO_IMAGEM),
                'pjaxGridId' => "pjaxGridImagem{$model->id}",
                'model' => $model,
                'tipo' => \common\models\Arquivo::TIPO_IMAGEM
            ])?>
        </div>
    </fieldset>


</div>
