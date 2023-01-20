<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
?>
<a href="<?=Url::to(['view','id' => $model->id])?>" title="<?=$model->titulo?>" class="d-block" data-pjax="0">
    <div class="box-evento">
        <div class="col texto">
            <h4><strong><?=$model->titulo?></strong></h4> 
            <?php if($model->data_inicio): ?>
                Data: <?=Yii::$app->formatter->asDate($model->data_inicio,'long');?><br />
            <?php endif ?>
            <?php if($model->local): ?>
                Local: <?=Yii::$app->formatter->asNText($model->local)?><br />
            <?php endif ?>
            <?php if($model->resumo): ?>
                <?=Yii::$app->formatter->asNText($model->resumo)?>
            <?php endif ?>
            <div class="tarja"></div>
        </div>
    </div>
</a>