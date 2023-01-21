<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Noticia $model */

$this->title = 'Atualizar Noticia: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'news_id' => $model->news_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="noticia-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
