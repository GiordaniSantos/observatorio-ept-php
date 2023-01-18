<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\TeseSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tese-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'thesis_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'institution') ?>

    <?= $form->field($model, 'publishing_company') ?>

    <?= $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'access_link') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <?php // echo $form->field($model, 'curriculumId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
