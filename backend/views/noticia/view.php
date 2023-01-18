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
        <?= Html::a('Atualizar', ['update', 'news_id' => $model->news_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'news_id' => $model->news_id], [
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
            'news_id',
            'authors:ntext',
            'title:ntext',
            'description:ntext',
            'date',
            'createdAt',
            'updatedAt',
        ],
    ]) ?>

</div>
