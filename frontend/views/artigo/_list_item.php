<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
?>

<a href="<?=Url::to(['/artigo/view','id' => $model->article_id])?>" title="<?=$model->title?>">
    <div class="row box-lista">
        <div class="col texto">
            <h4><strong><?=$model->title?></strong></h4>
            <hr />
            <?php if($model->resumo): ?>
                <?=Yii::$app->formatter->asNtext($model->resumo)?>
            <?php endif ?>
            <div class="tarja"></div>
        </div>
    </div>
</a>
<br><br>