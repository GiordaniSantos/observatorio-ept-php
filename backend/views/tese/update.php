<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tese $model */

$this->title = 'Atualizar Tese: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Teses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'thesis_id' => $model->thesis_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tese-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
