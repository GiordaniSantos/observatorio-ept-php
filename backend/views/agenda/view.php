<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Agenda $model */

$this->title = $model->schedule_id;
$this->params['breadcrumbs'][] = ['label' => 'Agendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="agenda-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'schedule_id' => $model->schedule_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'schedule_id' => $model->schedule_id], [
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
            'schedule_id',
            'date',
            'description',
            'external_link',
            'createdAt',
            'updatedAt',
        ],
    ]) ?>

</div>
