<?php

use yii\helpers\Html;

?>

<?=Html::beginTag('a', [
    'href' => $model_file->getFileUrl($model->uploadModelName),
    'class' => 'btn-anexos',
    'target' => '_blank',
    'title' => $model_file->getPrettyName(50),
    'download' => false,
    'data-pjax' => '0',
])?>
<i class="fas fa-caret-right"></i>
<?php if ($model_file->legenda): ?>
<strong><?=$model_file->getPrettyName(50)?></strong><br />
<?php else : ?>
<strong><?=$model_file->nome_original?></strong><br />
<?php endif ?>
<?=($model_file->dataExtenso)?"<small>(Publicado em {$model_file->dataExtenso})</small>":"" ?>
<?=Html::endTag('a')?>