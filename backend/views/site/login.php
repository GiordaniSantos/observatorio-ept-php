<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>
<section class="row justify-content-center">
    <div class="box-login col-12 text-center">
        <div class="mt-5 offset-lg-3 col-lg-6">
            <?=Html::img('@web/images/Logo.png',['alt' => 'Observatório Ifsul', 'width' => '70%'])?>
            <br><br>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    
                <?= $form->field($model, 'password')->passwordInput() ?>
    
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"col-12 padding-memorizar\">{input}&nbsp;&nbsp;{label}</div>\n<div class=\"col-lg-12\">{error}</div>",
                ])  ?>
                <br>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>
    
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
