<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use common\widgets\FileView;
use kartik\file\FileInput;
use timurmelnikov\widgets\LoadingOverlayPjax as Pjax;

if (!isset($attribute)){
    $attribute = ($tipo == \common\models\Arquivo::TIPO_DOCUMENTO) ? 'files' : 'images';
}

$modelName = lcfirst($model->formName());
$pjaxFormId = "form-{$modelName}-arquivos-{$tipo}";
$pjaxGridId = "grid-{$modelName}-arquivos-{$tipo}";
$js = <<<JS

jQuery("#{$pjaxFormId}").on("pjax:success", function() {
    jQuery.pjax.reload({container:"#{$pjaxGridId}"});
});

jQuery("#{$pjaxFormId}").on("pjax:error", function(event, xhr, textStatus, errorThrown, options) {
    console.log(xhr.responseText);
    return false;
});

jQuery("#{$pjaxFormId}").on("pjax:complete", function(event, xhr) {
    if (xhr.status != 200){
        swal(xhr.statusText);
    }
});
JS;

$this->registerJs($js,\yii\web\View::POS_READY);

?>
<section>
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <br />
            <?=Html::tag('legend', $model->getAttributeLabel($attribute))?>
            <?php Pjax::begin(['id' => $pjaxFormId]) ?>
            <?php $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                    'data-pjax' => true
                ],
            ])?>      
            <?= $form->field($model, $attribute.'[]')->label(false)->widget(FileInput::classname(), [
                'options' => [
                    'accept' => ($tipo == \common\models\Arquivo::TIPO_IMAGEM) ? 'image/*' : 'application/*',
                    'multiple' => true
                ],
                'language' => 'pt',
                'pluginOptions' => [
                    'previewFileType' => 'any',
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => true,
                    'browseClass' => 'btn btn-success',
                    'uploadClass' => 'btn btn-success',
                    'removeClass' => 'btn btn-danger'
                ]
            ])?>
            <?php ActiveForm::end() ?>
            <?php Pjax::end() ?> 
        </div>
    </div>  

    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <br /><br /><legend>Anexos</legend>
            <div class="tabela-anexos">
            <?=$this->render('//commons/_gridArquivos', [
                'dataProvider' => $model->getDataProviderArquivos($tipo, ['order' => 'posicao']),
                'pjaxGridId' => $pjaxGridId,
                'model' => $model,
                'tipo' => $tipo
            ])?>
            </div>
        </div>
    </div>    
</section>