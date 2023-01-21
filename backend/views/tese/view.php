<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Tese $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Teses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tese-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'thesis_id' => $model->thesis_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'thesis_id' => $model->thesis_id], [
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
            'thesis_id',
            'title:ntext',
            'institution',
            'publishing_company',
            'author',
            'resumo',
            'data_publicacao:Date',
            'description:ntext',
            'destaque:boolean',
            'access_link',
            'createdAt',
            'updatedAt',
            'curriculumId',
        ],
    ]) ?>

</div>
