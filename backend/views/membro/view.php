<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Membro $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Membros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="membro-view margin110T">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'member_id' => $model->member_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'member_id' => $model->member_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que quer deletar esse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'member_id',
            'name',
            'institution',
            'link_curriculum',
            'createdAt',
            'updatedAt',
        ],
    ]) ?>

</div>
