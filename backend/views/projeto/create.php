<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Projeto $model */

$this->title = 'Create Projeto';
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projeto-create margin110T">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
