<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tese $model */

$this->title = 'Criar Tese';
$this->params['breadcrumbs'][] = ['label' => 'Teses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tese-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
