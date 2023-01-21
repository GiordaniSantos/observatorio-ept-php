<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;

?>
<div class="row box-lista">
    <div class="col-4 nopadding imagem-lista-membro">
        <?=Html::img("@web/images/indisponivel.jpg", ['alt' => $model->name])?>        
    </div>
    <div class="col-8 texto">
        <h4><strong><?=$model->name?></strong></h4>
        <hr />   
        <?php if($model->institution): ?>
            Instituição de vínculo: <?=$model->institution?><br>
        <?php endif ?>
        <?php if($model->link_curriculum): ?>
            <br><br>
            <a href=<?=$model->link_curriculum?> class="btn-padrao fixo">Link para o currículo</a>
        <?php endif ?>
        <div class="tarja"></div>
    </div>
</div>
<br>
