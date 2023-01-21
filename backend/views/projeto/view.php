<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Projeto $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="projeto-view margin110T">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'project_id' => $model->project_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'project_id' => $model->project_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que quer deletar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_id',
            'title:ntext',
            'description:ntext',
            'data_publicacao:Date',
            'members:ntext',
            'financiers:ntext',
            'destaque:boolean',
            'createdAt',
            'updatedAt',
            'curriculumId',
        ],
    ]) ?>

</div>
