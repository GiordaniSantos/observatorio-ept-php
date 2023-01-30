<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var common\models\Membro $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="membro-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'institution')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'link_curriculum')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                'options' => ['accept' => ['application/*','image/*']],
                'language' => 'pt',
                'pluginOptions' => [
                    'previewFileType' => 'any',
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                ]
            ]);
            ?>
        </div>
    </div>
<br>
    <?php if (!$model->isNewRecord):?>
        <fieldset>
            <legend>Arquivo (Anexo)</legend>

            <?php yii\widgets\Pjax::begin(['id' => 'grid-arquivo-membro']) ?>
            <div class="grid-arquivo-membro row">
                <?= $this->render('_gridArquivo',['dataProvider' => $model->dataProviderArquivo]) ?>
            </div>
            <?php yii\widgets\Pjax::end() ?>
        </fieldset>
    <?php endif ?>

<br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
