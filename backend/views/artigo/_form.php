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
            <?= $form->field($model, 'year')->widget(DateControl::class, [
                'type' => DateControl::FORMAT_DATETIME
            ])?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'dissemination_vehicle')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <?= $form->field($model, 'access_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'curriculumId')->textInput() ?>
<br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
