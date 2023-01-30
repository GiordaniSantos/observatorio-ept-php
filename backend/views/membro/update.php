<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Membro $model */

$this->title = 'Atualizar Membro: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Membros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="membro-update margin110T">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
