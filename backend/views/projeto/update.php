<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Projeto $model */

$this->title = 'Atualizar Projeto: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'project_id' => $model->project_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projeto-update margin110T">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
