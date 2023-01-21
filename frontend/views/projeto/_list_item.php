<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
?>

<a href="<?=Url::to(['/projeto/view','id' => $model->project_id])?>" title="<?=$model->title?>">
    <div class="row box-lista">
        <div class="col texto">
            <h4><strong><?=$model->title?></strong></h4>
            <hr />
            <?php if($model->data_publicacao): ?>
                Data de publicacação: <?=Yii::$app->formatter->asDate($model->data_publicacao,'long');?><br>
            <?php endif ?>
            <?php if($model->description): ?>
                <?=mb_strimwidth(Yii::$app->formatter->asNtext(strip_tags($model->description)), 0, 512, " ...")?>
            <?php endif ?>
            <div class="tarja"></div>
        </div>
    </div>
</a>
<br><br>