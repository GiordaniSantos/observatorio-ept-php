<?php

use yii\helpers\Html;
use kartik\datecontrol\DateControl;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Agenda $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="agenda-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'date')->widget(DateControl::class, [
                'type' => DateControl::FORMAT_DATETIME
            ])?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">           
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'external_link')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
<br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
