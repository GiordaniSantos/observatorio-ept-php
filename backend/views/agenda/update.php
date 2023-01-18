<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Agenda $model */

$this->title = 'Atualizar Agenda: ' . $model->schedule_id;
$this->params['breadcrumbs'][] = ['label' => 'Agendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->schedule_id, 'url' => ['view', 'schedule_id' => $model->schedule_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agenda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
