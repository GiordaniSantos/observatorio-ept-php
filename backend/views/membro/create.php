<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Membro $model */

$this->title = 'Criar Membro';
$this->params['breadcrumbs'][] = ['label' => 'Membros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membro-create  margin110T">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
