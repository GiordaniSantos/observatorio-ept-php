<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Artigo $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Artigos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="artigo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'article_id' => $model->article_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'article_id' => $model->article_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'article_id',
            'authors',
            'title',
            'data_publicacao:DateTime',
            'dissemination_vehicle',
            'access_link',
            'destaque:boolean',
            'createdAt:DateTime',
            'updatedAt:DateTime',
            'curriculumId',
        ],
    ]) ?>

</div>
