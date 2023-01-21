<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;

/** @var yii\web\View $this */
/** @var common\models\Artigo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="artigo-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'authors')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'data_publicacao')->widget(DateControl::class, [
                'type' => DateControl::FORMAT_DATETIME
            ])?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'dissemination_vehicle')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'resumo')->textInput(['maxlength' => true]) ?>
        </div> 
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <?= $form->field($model, 'access_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'curriculumId')->textInput() ?>
<br>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'destaque')->checkbox() ?>
        </div>
    </div>
<br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
