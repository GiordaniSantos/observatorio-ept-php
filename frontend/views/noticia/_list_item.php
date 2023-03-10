<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
use common\models\Arquivo;
?>

<div class="box-lista-noticia">
    <a href="<?=Url::to(['noticia/view', 'id' => $model->id])?>" class="d-block" data-pjax="0">
        <div class="row">
            <div class="col-12 nopadding imagem-lista">
                <?php if($model->getImagemCapa('noticiaArquivos','id_noticia',Arquivo::VERSION_LARGE, false)):?>
                    <?=Html::img($model->getImagemCapa('noticiaArquivos','id_noticia',Arquivo::VERSION_LARGE),['width'=>'100%','alt' => '']);?>
                <?php else:?>
                    <?=Html::img("@web/images/indisponivel.jpg", ['width' => '100%', 'title' => $model->title])?>
                <?php endif?>	   
            </div>
            <div class="col texto texto-noticia">
                <h4><strong><?=$model->title?></strong></h4><hr />
                <?php if($model->data_publicacao): ?>
                    <?=Yii::$app->formatter->asDate($model->data_publicacao,'long');?>
                <?php endif ?>
                <?php if($model->resumo): ?>
                    <p><?=mb_strimwidth(Yii::$app->formatter->asNtext(strip_tags($model->resumo)), 0, 150, " ...")?></p>
                <?php endif ?>
                <div class="tarja"></div>
            </div>
        </div>
    </a>
</div>