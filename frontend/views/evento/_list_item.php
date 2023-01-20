<?
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
?>
<div class="">
    <div class="row">
        <div class="col-ce1-24 col-ce3-12 col-tb2-12 text-left padding30">
            <a href="<?=Url::to(['evento/view', 'id' => $model->id, 'slug' => $model->slug])?>"><h4><strong>
                <h4><strong><?=$model->titulo?></strong></h4><hr />  
                <?php if($model->data_inicio): ?>
                    Data: <?=Yii::$app->formatter->asDate($model->data_inicio,'long');?><br />
                <?php endif ?>
                <?php if($model->local): ?>
                    Local: <?=Yii::$app->formatter->asNText($model->local)?><br />
                <?php endif ?>
                <?php if($model->resumo): ?>
                    <?=Yii::$app->formatter->asNText($model->resumo)?>
                <?php endif ?>
            </a>
        </div>
    </div>
</div>
<?php
if (isset($index)) {
    if(++$index == $count){
        return;
    }    
}
?>